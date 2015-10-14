<?
session_start();
session_regenerate_id();

if(!isset($_SESSION['userauth'])) {
	header("Location: index.php");
}
?>
<!DOCTYPE HTML>
<html>
<body>
<div>
<a href="signout.php">Sign out</a>
</div>
</body>
</html>