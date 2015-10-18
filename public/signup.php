<?
session_start();
session_regenerate_id();
if(isset($_SESSION['userauth'])) {
	header("Location: main.php");
}
?>

<!DOCTYPE html>
<html>

<head>
	<title>Sign up for OurMail!</title>
	<script src = "http://www.parsecdn.com/js/parse-latest.js"></script>
	<link rel = "stylesheet" type = "text/css" href = "signup.css">
	<link href='https://fonts.googleapis.com/css?family=Itim' rel='stylesheet' type='text/css'>
    <script src = "js/signup_script.js"></script>
</head>

<body>

	<div id = "header">
	<h1 align="center">Create your very own OurMail Account! It's fast and free!</h1>
	</div>

	<div>
	<p id = "sidetext">The power of email all in a single account.</p>

	<img id = "ioslogo" src="ios.png" alt = "IOS Mail Logo"> -->
	<img id = "gmaillogo" src="gmail.png" alt = "Gmail Logo">
	<img id = "yahoologo" src="yahoo.png" alt = "Yahoo Mail Logo">
	<img id = "outlooklogo" src="outlook.jpg" alt = "Outlook Logo"> 
	</div>

	<form name = "signupform" onsubmit = "return(validation());" >
		Name:<br>
		<input class = "name" type = "text" name = "firstname" placeholder = "First" >
		<input class = "name"type = "text" name = "lastname" placeholder = "Last" ><br><br>
    
    	Email Address:<br>
		<input class = "samebox" type = "text" name = "email" placeholder = "Email" autocomplete="on"><br><br>
	
		Username:<br>
		<input class = "samebox" type = "text" name = "username" placeholder = "Username" autocomplete="off"><br><br>

		Password:<br>
		<input class = "samebox" type = "password" name = "password" placeholder = "Password" autocomplete="off" ><br><br>

		Security Question (case sensitive):<br>
    	<select id = "dropbox" name = "security_questions">
    	<option value = "number_1 "> What was your mother's maiden name?</option>
    	<option value="saab">What was your childhood nickname?</option>
    	<option value="fiat">What school did you attend in 6th grade?</option>
    	<option value="audi">What was the model of your first car?</option>
    	</select>
    	<br><br>
    	
    	<input class = "samebox" type = "text" name = "security_answer" placeholder = "Answer" autocomplete="off" ><br><br>

		<input id = "submit" type="submit">
	</form>

</body>
</html>
