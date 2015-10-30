<?
//include context.io library
require_once './class.contextio.php';

//define your API key and secret - find this https://console.context.io/#settings
define('CONSUMER_KEY', '7yo7pcfm');
define('CONSUMER_SECRET', 'aub4jk9WF9zL1OL2');

// instantiate the contextio object
$contextio = new ContextIO(CONSUMER_KEY, CONSUMER_SECRET);

// get a list of users and print the response data out
$r = $contextio->listUsers();
print_r($r->getData());

// many calls are based for a User - you can define a USER_ID to make these calls
// the USER_ID is returned in either the listUsers call or the getUser call
// you can also get this from the interactive console
define('USER_ID', 'A CONTEXTIO USER ID');

// You also need to know the EMAIL_ACCOUNT_LABEL and FOLDER to list messages.
$r = $contextio->listEmailAccounts(USER_ID);
print_r($r->getData());

// You can see all the folders in an email account using the listEmailAccountFolders method
define('LABEL', 'AN EMAIL ACCOUNT LABEL');
$params = array('label'=>LABEL);
$r = $contextio->listEmailAccountFolders(USER_ID, $params);
print_r($r);

// Now that you know the USER_ID, LABEL, and FOLDER you can list messages
define('FOLDER', 'A FOLDER NAME');
$params = array('label'=>LABEL, 'folder'=>FOLDER);
$r = $contextio->listMessages(USER_ID, $params);
print_r($r);
?>
