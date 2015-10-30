<?
//include context.io library
require_once 'PHP-Lite-ContextIO/class.contextio.php';

//API Key and Secret. Found in the context IO Developers Settings
define('CONSUMER_KEY', 'ru1j2q2s');
define('CONSUMER_SECRET', '0OuLf0mllrvwaPAQ');

//Instantiate the contextio object
$ctxio = new ContextIO(CONSUMER_KEY, CONSUMER_SECRET);

//Get a connect token
$r=$ctxio->addConnectToken(array(
    "callback_url" =>  "localhost/dashboard.php"
));

if ($r === false) {
    throw new exception("Unable to get a connect token.");
}
else{
    //redirect user to connect token UI
    $token = $r->getData();
    print $token['token'];
    $_SESSION['ContextIO-connectToken']=$token['token'];
    header("Location: ". $token['browser_redirect_url']);
}

?>
