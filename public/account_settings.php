<?
session_start();
session_regenerate_id();

if(!isset($_SESSION['userauth'])) {
	header("Location: index.php");
}
?>

<!DOCTYPE html>
<html>

<head>
	<title>Ourmail Account Settings</title>

	<script src = "http://www.parsecdn.com/js/parse-latest.js"></script>

	<link href="css/account_settings.css" rel="stylesheet">
</head>

<body>

	<form action = "newUsername.php">
		<input id = "uname" type = "submit" value = "Change Username">
	</form>

	<br>   

	<form action = "change_pass.php">
		<input id = "password" type = "submit" value = "Change Password">
	</form>

	







</body>

</html>