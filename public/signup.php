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
    <script src = "js/signup_script.js"></script>
</head>

<body>

<h1 align="center">Create your very own OurMail Account! It's fast and free!</h1>

<form name = "signupform" onsubmit = "return(validation());" >
	Name<br>
	<input type = "text" name = "firstname" placeholder = "First" >
	<input type = "text" name = "lastname" placeholder = "Last" ><br><br>
    
    Email Address<br>
	<input type = "text" name = "email" placeholder = "Email" autocomplete="on"><br><br>
	
	Username<br>
	<input type = "text" name = "username" placeholder = "Username" autocomplete="off"><br><br>

	Password<br>
	<input type = "password" name = "password" placeholder = "Password" autocomplete="off" ><br><br>

	Please choose a security question and provide an answer to that question (case sensitive)<br>
    <select name = "security_questions">
    <option value = "number_1 "> What was your mother's maiden name?</option>
    <option value="saab">What was your childhood nickname?</option>
    <option value="fiat">What school did you attend in 6th grade?</option>
    <option value="audi">What was the model of your first car?</option>
    </select>
    <input type = "text" name = "security_answer" placeholder = "Answer" autocomplete="off" ><br><br>


	<input type="submit">





</form>


</body>




</html>
