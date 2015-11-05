<?
session_start();
session_regenerate_id();

$firstname = 'unknown';
$lastname = 'unknown';
$email = 'unknown';
$username = 'unknown';

if(!isset($_SESSION['userauth'])) {
	header("Location: index.php");
}
else {
	$firstname = $_SESSION['firstname'];
	$lastname = $_SESSION['lastname'];
	$username = $_SESSION['username'];
	$email = $_SESSION['email'];
}
?>
<!DOCTYPE HTML>
<html lang="en">
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Ourmail</title>

    <link href="css/bootstrap.min.css" rel="stylesheet">

    <link href="css/landing.css" rel="stylesheet">

    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
</head>
<body>
	<div>
		<div>
		First Name: <?=$firstname;?><br>
		Last Name: <?=$lastname;?><br>
		Username: <?=$username;?><br>
		Email: <?=$email;?><br>
		</div>
		<a href="account_settings.php"><button id="account_settings">Account Settings</button></a>
		
		<a href="add_mailbox_ct.php"><button id="email_setup">Setup Email Account</button></a>
		
		<a href="dashboard.php"><button id="email_dashboard">Email Dashboard</button></a>
	
		<button id="logout">Log Out</button>
	</div>
	<!-- jQuery -->
    <script src="js/jquery.js"></script>
	
    <!-- Parse -->
    <script src = "http://www.parsecdn.com/js/parse-latest.js"></script>
    
    <!-- Sign Out JavaScript -->
    <script src="js/logout.js"></script>
</body>
</html>