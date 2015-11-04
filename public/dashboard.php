<?php

//Helper Functions

//This function prints a folder to the side navbar
function print_folder($folder,$label){
    $output="<li>\n<a href=\"dashboard.php?label=" . rawurlencode($label) . "&folder=" .rawurlencode($folder) . "\">" .$folder . "</a>\n</li>\n";
    echo $output;
}

//This function prints a mailbox to the side navbar. It call print_folder to print folders contained in a mailbox.
function print_mailbox($account_arr){
    $label=$account_arr['label'];

    echo "<li>\n<a>" .$label ."</a>\n<ul class=\"sidebar-brand\">\n";
    foreach($account_arr['folders'] as $folder){
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

//This function builds the imapinfo_object, which contains information about the users email accounts.
function buildImapInfo(&$imapinfo, &$ctxio){

    $lu=$ctxio->listUsers(array(
        'email' => USER_EMAIL
    ));
    if ($lu === false) {
        throw new exception("Unable to get the user.");
    }

    $lud = $lu->getData()[0];

    //Store User ID
    $usr_id=$lud['id'];
    $imapinfo['id']=$usr_id;
    $imapinfo['accounts']=array();

    //Iterate over mail accounts
    $mail_accounts=$lud['email_accounts'];
    foreach($mail_accounts as $maccount){

        $account=array();

        //Get Current Account Label
        $label=$maccount['label'];

        //Store label
        $account['label']=$label;
        $account['folders']=array();

        //Get mail account folders.
        $eaf=$ctxio->listEmailAccountFolders($usr_id, array(
            'label' => $label
        ));

        //Error checking for mail account folders
        if ($eaf === false) {
            throw new exception("Unable to fetch folders");
        } 

        $eafd=$eaf->getData();

        //Iterate over folders
        foreach($eafd as $folderdata){

            //Store Folders
            $folder=$folderdata['name'];
            array_push($account['folders'],$folder);
        }
        array_push($imapinfo['accounts'],$account);
    }
    var_dump($imapinfo);
}

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

print "Get is: ";
var_dump($_GET);
print "<br /><br />";

// Start memcached server
$mem = new Memcached();
$mem->addServer("127.0.0.1", 11211);

// Start Timer
$start = microtime(true);

// Get cached imapinfo
$imapinfo = $mem->get("imapinfo");
if ($imapinfo) {
    //echo "found cached version";
    var_dump($imapinfo);
} else {
    //echo "No matching key found.  I'll add that now!";
    buildImapInfo($imapinfo, $ctxio);
    $mem->set('imapinfo',$imapinfo) or die ("Unable to store data in memcached.");
}

// TIme taken to get imap info
$time_elapsed_secs = microtime(true) - $start;
print ("<br />Total Time taken is: " . $time_elapsed_secs . "<br />");

    /*
    $lu=$ctxio->listUsers(array(
        'email' => USER_EMAIL
    ));

    if ($lu === false) {
        throw new exception("Unable to get a connect token.");
    }
    else{
        $lud = $lu->getData()[0];
    }

    //Users Context IO ID
    $usr_id=$lud['id'];

    if (DEBUG){
        print "<br />id: ";
        print  $usr_id;
        print "<br />";
    }

    $mail_accounts=$lud['email_accounts'];
    foreach($mail_accounts as $maccount){

        //Get Current Account Label
        $label=$maccount['label'];
        if (DEBUG){
            print "<br />Label: ";
            print $label;
            print "<br />";
        }

        //Get mail account folders.
        $eaf=$ctxio->listEmailAccountFolders($usr_id, array(
            'label' => $label
        ));

        //Error checking for mail account folders
        if ($eaf === false) {
            throw new exception("Unable to fetch folders");
        } else {
            $eafd=$eaf->getData();
            foreach($eafd as $folderdata){

                $folder=$folderdata['name'];

                if (DEBUG){
                    print "<br />";
                    print($folder);
                    print "<br />";
                }

                // Get Messages
                $msgs=$ctxio->listMessages($usr_id,array(
                    'label' => $label,
                    'folder' => $folder,
                ));

                //Error cehcking for messages
                if ($msgs === false) {
                    throw new exception("Unable to fetch messages");
                } else {

                    // Get messages Data
                    $msgsd=$msgs->getData();

                    if (DEBUG){
                        print "<br />";
                        print_r($msgd);
                        print "<br />";
                    }

                    foreach($msgsd as $msg){

                        // Extract messsage id from message
                        $msgid=$msg['message_id'];

                        // Get actual message with the help of the message id
                        $message=$ctxio->getMessageBody($usr_id,array(
                            'label' => $label,
                            'folder' => $folder,
                            'message_id' => $msgid,
                            //'body_type' => "text/html",
                        ));

                        //Error checking for received message
                        if ($message === false) {
                            throw new exception("Unable to fetch messages");
                        } else {
                            // Get messages Data
                            $message_data=$message->getData();
                            if (DEBUG){
                                print ("<br />Subject: " . $msg['subject']);
                                print ("<br /> Body is : <br />" . $message_data['bodies']['1']['content'] );
                            }
                        }
                    }
                }
            }
        }
    }

    FIXME
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Simple Sidebar - Start Bootstrap Template</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/simple-sidebar.css" rel="stylesheet">

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
                <li class="sidebar-brand">
                    <a href="/dashboard.php">
                        Dashboard
                    </a>
                </li>

<?php
print_all_mailboxes($imapinfo['accounts']);
?>
            </ul>
        </div>
        <!-- /#sidebar-wrapper -->

        <!-- Page Content -->
        <div id="page-content-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">

<?php

$current_label=$imapinfo['accounts']['0']['label'];
$current_folder=$imapinfo['accounts']['0']['folders']['0'];
print "<br />" . $current_label . "<br />";
print "<br />" . $current_folder . "<br />";

// Get Messages
$msgs=$ctxio->listMessages($imapinfo['id'],array(
    'label' => $current_label,
    'folder' => $current_folder,
));
if ($msgs === false) {
    throw new exception("Unable to fetch messages");
}

// Get messages Data
$msgsd=$msgs->getData();

foreach($msgsd as $msg){
    var_dump($msg);
    // Extract messsage id from message
    // $msgid=$msg['message_id'];
}
?>
                    </div>
                </div>
            </div>
        </div>
        <!-- /#page-content-wrapper -->

    </div>
    <!-- /#wrapper -->

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

</body>

</html>

<?php
/* This code might be used later
 *
 // Get actual message with the help of the message id
 $message=$ctxio->getMessageBody($usr_id,array(
     'label' => $label,
     'folder' => $folder,
     'message_id' => $msgid,
     //'body_type' => "text/html",
 ));

//Error checking for received message
if ($message === false) {
    throw new exception("Unable to fetch messages");
                        } else {
                            // Get messages Data
                            $message_data=$message->getData();
                            if (DEBUG){
                                print ("<br />Subject: " . $msg['subject']);
                                print ("<br /> Body is : <br />" . $message_data['bodies']['1']['content'] );
                            }
                        }
 */
?>
