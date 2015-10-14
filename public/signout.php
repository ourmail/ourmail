<?
session_start();
unset($_SESSION['userauth']);
session_destroy();
header("Location: index.php");
?>