<?
session_start();
session_regenerate_id();

if(!isset($_SESSION['userauth'])) {
	header("Location: index.php");
}

$output = '';
/*
if(isset($_POST['gmail-username']) && isset($_POST['gmail-password'])) {
	// Note: Does not do any attempts at authentication
	/// connect to gmail //
	echo "Attempting to connect to ".$_POST['gmail-username']."...<br>";
	$hostname = '{imap.gmail.com:993/imap/}INBOX';
	$username = $_POST['gmail-username'];
	$password = $_POST['gmail-password'];

	// try to connect
	$inbox = imap_open($hostname,$username,$password) or die('Cannot connect to Gmail: ' . imap_last_error());
	
	// grab emails 
	$emails = imap_search($inbox,'ALL');

	// if emails are returned, cycle through each...
	if($emails) {
		
		// begin output var
		$output = '';
		
		// put the newest emails on top
		rsort($emails);
		
		// for every email...
		foreach($emails as $email_number) {
			
			// get information specific to this email
			$overview = imap_fetch_overview($inbox,$email_number,0);
			$message = imap_fetchbody($inbox,$email_number,2);
			
			// output the email header information
			$output.= '<div class="toggler '.($overview[0]->seen ? 'read' : 'unread').'">';
			$output.= '<span class="subject">'.$overview[0]->subject.'</span> ';
			$output.= '<span class="from">'.$overview[0]->from.'</span>';
			$output.= '<span class="date">on '.$overview[0]->date.'</span>';
			$output.= '</div>';
			
			// output the email body
			$output.= '<div class="body">'.$message.'</div>';
		}
		
		//echo $output;
	} 
	
	// close the connection
	imap_close($inbox);
	
}
else {
	echo "No submission detected";
}
*/

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
		<form action="main.php" method="post" id="example-gmail-form">
			<input type="text" name="gmail-username" id="gmail-username">
			<input type="password" name="gmail-password" id="gmail-password">
			<input type="submit">
		</form>
	
		<button id="logout">Log Out</button>
	</div>
	
	<div>
	 <?=$output;?>
	</div> 
	
	<!-- jQuery -->
    <script src="js/jquery.js"></script>
	
    <!-- Parse -->
    <script src = "http://www.parsecdn.com/js/parse-latest.js"></script>
    
    <!-- Sign Out JavaScript -->
    <script src="js/logout.js"></script>
</body>
</html>