<?php
// Helper Functions

//This function prints a folder to the side navbar
function print_folder($folder,$label){
    $output="<li>\n<a href=\"dashboard.php?label=" . rawurlencode($label) . "&folder=" .rawurlencode($folder) . "\">" .$folder . "</a>\n</li>\n";
    echo $output;
}

//This function prints a mailbox to the side navbar. It call print_folder to print folders contained in a mailbox.
function print_mailbox($account){
    $label=$account['label'];
    $username=$account['username'];

    echo "<li>\n<a>" .$username ."</a>\n<ul class=\"sidebar-brand\">\n";
    foreach($account['folders'] as $folder){
        print_folder($folder,$label);
    }       
    echo "</ul>\n</li>\n";
}

//This function prints all mailboxes
function print_all_mailboxes($accounts){
    foreach($accounts as $account){
        print_mailbox($account);
    }
}

// This function takes in a message object and prints it to the screen
function print_message($message){

$senderName=$message['addresses']['sender']['0']['name'];
$subject=$message['subject'];
$sendTimeSeconds=$message['sent_at'];
$sendDate=date('Y/m/d H:i:s', $sendTimeSeconds);

$message_html = <<<EOT
                        <table border="0" cellspacing="0" cellpadding="0" align="left" style="width:100%;margin:0 auto;background:#FFF;">
                            <tr>
                                <td colspan="5" style="padding:15px 0;">
                                    <h1 style="color:#000;font-size:24px;padding:0 15px;margin:0;">{$senderName}</h1>
                                </td>
                            </tr>
                            <tr>
                                <td style="width:15px;">&nbsp;</td>
                                <td style="width:375px;">
                                    {$subject}
                                </td>
                                <td style="width:15px;">&nbsp;</td>
                                <td style="width:180px;padding:0 0 0 0;">
                                    {$sendDate}
                                </td>
                                <td style="width:15px;">&nbsp;</td>
                            </tr>
                        </table>
EOT;

echo $message_html;
}

// This function takes list of message objects and prints them all
function print_all_messages($msgsd){
    foreach($msgsd as $msg){
        print_message($msg);
    }
}

// This function fetches messages and prints them all.
function get_messages_and_print($label,$folder){

    global $ctxio;
    global $imapinfo;

    // Get Messages
    $msgs=$ctxio->listMessages($imapinfo['id'],array(
        'label' => $label,
        'folder' => $folder,
    ));
    if ($msgs === false) {
        throw new exception("Unable to fetch messages");
    }

    // Get messages Data
    $msgsd=$msgs->getData();
    print_all_messages($msgsd);
}

// This function fetches the new mailbox based on whats folder is selected by the user.
function refresh_mailbox(){
    global $imapinfo;
    var_dump($imapinfo);
// FIXME. Do error checking for wrong variables passed.
    if (array_key_exists('label',$_GET) and array_key_exists('folder',$_GET)){
        $label=$_GET['label'];
        $folder=$_GET['folder'];
    } else {
        $label=$imapinfo['accounts']['0']['label'];
        $folder=$imapinfo['accounts']['0']['folders']['0'];
    }
    get_messages_and_print($label,$folder);
}

// Helper Functions end

// Include Context IO Library
require_once 'PHP-Lite-ContextIO/class.contextio.php';

// API Key and Secret. Get the Users email from Parse
define('CONSUMER_KEY', 'ru1j2q2s');
define('CONSUMER_SECRET', '0OuLf0mllrvwaPAQ');
define('USER_EMAIL', 'ourmailorg@gmail.com');
define('HOST', '192.168.33.10');
define('DEBUG', False);

// Get all the information regarding mailboxes from the contextio.

//Instantiate the contextio object
$ctxio = new ContextIO(CONSUMER_KEY, CONSUMER_SECRET);

// Start memcached server
$mem = new Memcached();
$mem->addServer("127.0.0.1", 11211);

// Get cached imapinfo
$imapinfo = $mem->get(USER_EMAIL);
if ($imapinfo) {
    //echo "found cached version";
} else {
    //echo "No matching key found.  Exiting.";
    header("Location: update_imap_info.php");
    die();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Ourmail Dashboard</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/simple-sidebar.css" rel="stylesheet">

    <link href="font-awesome/css/font-awesome.css" rel="stylesheet" type="text/css">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">


    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>
    <div id="wrapper">

        <!-- Sidebar -->
        <div id="sidebar-wrapper">
            <ul class="sidebar-nav">
              <ul class="nav nav-tabs">
                <li role="presentation" class="dropdown">
                  <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                    Mail box <span class="caret"></span>
                  </a>
                  <ul class="dropdown-menu">
                    <li class="sidebar-brand">
                      
                    </li>
                    <li class="sidebar-brand">
                      
                    </li>
                    <li class="sidebar-brand">
                      
                    </li> 
                  </ul>
                </li>
              </ul>
              <?php
                      // Print all mailboxes on the left side.
                  print_all_mailboxes($imapinfo['accounts']);
              ?>
              <!-- <?php
                      // Print all mailboxes on the left side.
                  print_all_mailboxes($imapinfo['accounts']);
              ?>
              <?php
                      // Print all mailboxes on the left side.
                  print_all_mailboxes($imapinfo['accounts']);
              ?>
               -->
            </ul>
        </div>
        <!-- /#sidebar-wrapper -->

        <!-- Page Content -->
        <div id="page-content-wrapper">
            <div class="header">
                <div class="searchMail">
                    <input type="text" class="form-control" placeholder="Text input">
                </div>
                <div class="navbar">
                <nav>
                  <ul class="pagination">
                    <li>
                      <a href="#" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                      </a>
                    </li>
                    <li><a href="#">1</a></li>
                    <li><a href="#">2</a></li>
                    <li><a href="#">3</a></li>
                    <li><a href="#">4</a></li>
                    <li><a href="#">5</a></li>
                    <li>
                      <a href="#" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                      </a>
                    </li>
                  </ul>
                </nav>
                </div>
            </div>
            <div class="container-fluid">
                  <?php
                  // Print mailbox messages on the right side
                  refresh_mailbox();
                  ?>
                      <!-- <div class="mailInfo">
                       <table>
                           <tr>
                               <td class="label "><i class="fa fa-check-square-o fa-2x"></i></td>
                               <td class="sender">Roger Lau</td>
                               <td class="mailCont">Reminder: You have been selected for the eBay Search Survery - Remember you have </td>
                               <td class="data">11/5/2015</td>
                           </tr>
                           <tr>
                               <td class="label "><i class="fa fa-check-square-o fa-2x"></i></td>
                               <td class="sender">Roger Lau</td>
                               <td class="mailCont">Reminder: You have been selected for the eBay Search Survery - Remember you have </td>
                               <td class="data">11/5/2015</td>
                           </tr>
                           <tr>
                               <td class="label "><i class="fa fa-check-square-o fa-2x"></i></td>
                               <td class="sender">Roger Lau</td>
                               <td class="mailCont">Reminder: You have been selected for the eBay Search Survery - Remember you have </td>
                               <td class="data">11/5/2015</td>
                           </tr>
                           <tr>
                               <td class="label "><i class="fa fa-check-square-o fa-2x"></i></td>
                               <td class="sender">Roger Lau</td>
                               <td class="mailCont">Reminder: You have been selected for the eBay Search Survery - Remember you have </td>
                               <td class="data">11/5/2015</td>
                           </tr>
                           <tr>
                               <td class="label "><i class="fa fa-check-square-o fa-2x"></i></td>
                               <td class="sender">Roger Lau</td>
                               <td class="mailCont">Reminder: You have been selected for the eBay Search Survery - Remember you have </td>
                               <td class="data">11/5/2015</td>
                           </tr>
                           <tr>
                               <td class="label "><i class="fa fa-check-square-o fa-2x"></i></td>
                               <td class="sender">Roger Lau</td>
                               <td class="mailCont">Reminder: You have been selected for the eBay Search Survery - Remember you have </td>
                               <td class="data">11/5/2015</td>
                           </tr>
                           <tr>
                               <td class="label "><i class="fa fa-check-square-o fa-2x"></i></td>
                               <td class="sender">Roger Lau</td>
                               <td class="mailCont">Reminder: You have been selected for the eBay Search Survery - Remember you have </td>
                               <td class="data">11/5/2015</td>
                           </tr>
                           <tr>
                               <td class="label "><i class="fa fa-check-square-o fa-2x"></i></td>
                               <td class="sender">Roger Lau</td>
                               <td class="mailCont">Reminder: You have been selected for the eBay Search Survery - Remember you have </td>
                               <td class="data">11/5/2015</td>
                           </tr>
                           <tr>
                               <td class="label "><i class="fa fa-check-square-o fa-2x"></i></td>
                               <td class="sender">Roger Lau</td>
                               <td class="mailCont">Reminder: You have been selected for the eBay Search Survery - Remember you have </td>
                               <td class="data">11/5/2015</td>
                           </tr>
                           <tr>
                               <td class="label "><i class="fa fa-check-square-o fa-2x"></i></td>
                               <td class="sender">Roger Lau</td>
                               <td class="mailCont">Reminder: You have been selected for the eBay Search Survery - Remember you have </td>
                               <td class="data">11/5/2015</td>
                           </tr>
                           <tr>
                               <td class="label "><i class="fa fa-check-square-o fa-2x"></i></td>
                               <td class="sender">Roger Lau</td>
                               <td class="mailCont">Reminder: You have been selected for the eBay Search Survery - Remember you have </td>
                               <td class="data">11/5/2015</td>
                           </tr>
                       </table>
                   </div>    -->
                <div class="row">

                    </div>
                </div>
            </div>
        </div>
        <!-- /#page-content-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- Parse Script -->
    <script src = "http://www.parsecdn.com/js/parse-latest.js"></script>

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <!-- Menu Toggle Script -->
<script>
$("#menu-toggle").click(function(e) {
    e.preventDefault();
    $("#wrapper").toggleClass("toggled");
});
</script>
    
    <!-- Dashboard Script -->
    <script src="js/dashboard.js"></script>
</body>
</html>
