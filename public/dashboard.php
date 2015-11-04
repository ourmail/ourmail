<?php

// Include the ui functions file
require 'uifunctions.php';

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

// Start Timer
//$start = microtime(true);

// Get cached imapinfo
$imapinfo = $mem->get("imapinfo");
if ($imapinfo) {
    //echo "found cached version";
} else {
    //echo "No matching key found.  I'll add that now!";
    buildImapInfo($imapinfo, $ctxio);
    $mem->set('imapinfo',$imapinfo) or die ("Unable to store data in memcached.");
}

// TIme taken to get imap info
// $time_elapsed_secs = microtime(true) - $start;
// print ("<br />Total Time taken to get imapinfo is: " . $time_elapsed_secs . "<br />");
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
// Print all mailboxes on the left side.
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
// Print mailbox messages on the right side
refresh_mailbox();
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
