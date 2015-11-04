<?php

//Helper Functions

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
        $username=$maccount['username'];

        //Store label
        $account['label']=$label;
        $account['username']=$username;
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
}

//Helper Function End

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

buildImapInfo($imapinfo, $ctxio);
$mem->set(USER_EMAIL,$imapinfo) or die ("Unable to store data in memcached.");

header("Location: dashboard.php");
die();

?>
