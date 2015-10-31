<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once 'PHP-Lite-ContextIO/class.contextio.php';

//API Key and Secret. Found in the context IO Developers Settings
define('CONSUMER_KEY', 'ru1j2q2s');
define('CONSUMER_SECRET', '0OuLf0mllrvwaPAQ');

define('USER_EMAIL', 'ourmailorg@gmail.com');

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
$mail_accounts=$lud['email_accounts'];
print "<br />id: \n";
print  $lud['id'];
foreach($mail_accounts as $maccount){
	print "<br />";
	$label=$maccount['label'];
	$eaf=$ctxio->listEmailAccountFolders($usr_id, array(
		'label' => $label
	));
	if ($eaf === false) {
	    	throw new exception("Unable to fetch folders");
	} else {
		$eafd=$eaf->getData();
		foreach($eafd as $folder){
	        print "<br />";
            print($folder['name']);
            $msg=$ctxio->listMessages($usr_id,array(
                'label' => $label,
                'folder' => $folder,
            ));
            if ($msg === false) {
                throw new exception("Unable to fetch messages");
            } else {
                $msgd=$msg->getData();
                print "<br />";
                print_r(msgd);
            }
		}
	}
}

?>
