<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once 'PHP-Lite-ContextIO/class.contextio.php';

//API Key and Secret. Found in the context IO Developers Settings
define('CONSUMER_KEY', 'ru1j2q2s');
define('CONSUMER_SECRET', '0OuLf0mllrvwaPAQ');
define('USER_EMAIL', 'ourmailorg@gmail.com');
define('DEBUG', False);

//Instantiate the contextio object
$ctxio = new ContextIO(CONSUMER_KEY, CONSUMER_SECRET);

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
                        print ("<br />Subject: " . $msg['subject']);
                        print ("<br /> Body is : <br />" . $message_data['bodies']['1']['content'] );
                    }
                }
            }
		}
	}
}

?>
