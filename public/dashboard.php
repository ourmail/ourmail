<?php

function buildImapInfo(&$imapinfo, &$ctxio){

    $lu=$ctxio->listUsers(array(
        'email' => USER_EMAIL
    ));
    if ($lu === false) {
        throw new exception("Unable to get a connect token.");
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
define('DEBUG', False);

// Get all the information regarding mailboxes from the contextio.

$imapinfo=array(
    'useremail' => USER_EMAIL
);

//Instantiate the contextio object
$ctxio = new ContextIO(CONSUMER_KEY, CONSUMER_SECRET);


//$start = microtime(true);

var_dump($_GET);

/*
buildImapInfo($imapinfo, $ctxio);

//$time_elapsed_secs = microtime(true) - $start;
//print ("<br />Total Time taken is: " . $time_elapsed_secs);
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

     */
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
                    <a href="#">
                        
                    </a>
                </li>
                <li>
                    <a href="#">Dashboard</a>
                </li>
                <li>
                    <a href="#">Shortcuts</a>
                </li>
                <li>
                    <a href="#">Overview</a>
                </li>
                <li>
                    <a href="#">Events</a>
                </li>
                <li>
                    <a href="#">About</a>
                </li>
                <li>
                    <a href="#">Services</a>
                </li>
                <li>
                    <a href="#">Contact</a>
                </li>
            </ul>
        </div>
        <!-- /#sidebar-wrapper -->

        <!-- Page Content -->
        <div id="page-content-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1>Simple Sidebar</h1>
                        <p>This template has a responsive menu toggling system. The menu will appear collapsed on smaller screens, and will appear non-collapsed on larger screens. When toggled using the button below, the menu will appear/disappear. On small screens, the page content will be pushed off canvas.</p>
                        <p>Make sure to keep all page content within the <code>#page-content-wrapper</code>.</p>
                        <a href="#menu-toggle" class="btn btn-default" id="menu-toggle">Toggle Menu</a>
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
