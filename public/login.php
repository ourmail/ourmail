<?
session_start();
if(isset($_POST['authentication'])) {
	if($_POST['authentication'] == true) {
		$_SESSION['userauth'] = true;
		$_SESSION['username'] = $_POST['username'];
		$_SESSION['email'] = $_POST['email'];
		$_SESSION['firstname'] = $_POST['firstname'];
		$_SESSION['lastname'] = $_POST['lastname'];
		
		$returnArray = array('success' => true);
		echo json_encode($returnArray);
	}	
}
?>