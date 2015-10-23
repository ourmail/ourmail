<?
session_start();
if(isset($_POST['authentication'])) {
	if($_POST['authentication'] == true) {
		$_SESSION['userauth'] = true;
		$returnArray = array('success' => true);
		echo json_encode($returnArray);
	}	
}
?>