<?
session_start();
if(isset($_POST['logout']) && $_POST['logout'] == true) {
	unset($_SESSION['userauth']);
	session_destroy();
	//header("Location: index.php");
	$returnArray = array('success' => true);
	echo json_encode($returnArray);
}

?>