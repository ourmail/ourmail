<?
session_start();
if(isset($_SESSION['userauth']) && $_SESSION['userauth'] == true) {
	if(isset($_POST['email'])) {
		$_SESSION['email'] = $_POST['email'];
	}
	if(isset($_POST['username'])) {
		$_SESSION['username'] = $_POST['username'];
	}
	if(isset($_POST['firstname'])) {
		$_SESSION['firstname'] = $_POST['firstname'];
	}
	if(isset($_POST['lastname'])) {
		$_SESSION['lastname'] = $_POST['lastname'];
	}		
	$returnArray = array('success' => true);
	echo json_encode($returnArray);
}	
else {
	$returnArray = array('success' => false);
	echo json_encode($returnArray);
}
?>