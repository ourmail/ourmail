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
	<!-- jQuery -->
    <script src="js/jquery.js"></script>
	<script src = "http://www.parsecdn.com/js/parse-latest.js"></script>

	<link href="css/bootstrap.min.css" rel="stylesheet">

    <link href="css/landing.css" rel="stylesheet">

	<link rel = "stylesheet" type = "text/css" href = "css/altered_signup.css">

    <script src = "js/altered_signup.js"></script>

    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body>

	<div class = "container-fluid" >
		<div id = "header">
			<h1 align="center">Create your very own OurMail Account! It's fast and free!</h1>
		</div>
		<div class = "row">
				<div class="Logo" >
					<h3 id = "sidetext">The power of email all in a single account.</h3>
					 <div class="col-xs-12 col-md-6">
					    <a href="" class="thumbnail">
					      <img src="img/signuplogos/gmail.png" alt="...">
					    </a>
					 </div>
					 <div class="col-xs-12 col-md-6">
					    <a href="" class="thumbnail">
					      <img src="img/signuplogos/gmail.png" alt="...">
					    </a>
					 </div>
					 <div class="col-xs-12 col-md-6">
					    <a href="" class="thumbnail">
					      <img src="img/signuplogos/gmail.png" alt="...">
					    </a>
					 </div>
					 <div class="col-xs-12 col-md-6">
					    <a href="" class="thumbnail">
					      <img src="img/signuplogos/gmail.png" alt="...">
					    </a>
					 </div>
				</div>			
		</div>
		<div class="Signup">
				<!--<form name = "signupform" onsubmit = "return(validation());" >-->
					Name:<br>
					<span class="error" id="error_firstname">You must enter a first name.<br></span>
					<span class="error" id="error_lastname">You must enter a last name.<br></span>
					<input class = "name" type = "text" id="firstname" name = "firstname" placeholder = "First" >
					<input class = "name"type = "text" id="lastname" name = "lastname" placeholder = "Last" ><br><br>
			    
			    	Email Address:<br>
					<span class="error" id="error_emailblank">You must enter an email address.<br></span>
					<span class="error" id="error_emailinvalid">You must enter a valid email address.<br></span>
					<input class = "samebox" type = "text" id="email" name = "email" placeholder = "Email" autocomplete="on"><br><br>
				
					Username:<br>
					<span class="error" id="error_usernameblank">You must enter a username.<br></span>
					<span class="error" id="error_usernamelength">Your username must be between 5 and 20 characters long.<br></span>
					<span class="error" id="error_usernameduplicate">That username is already taken.<br></span>
					<input class = "samebox" type = "text" id="username" name = "username" placeholder = "Username" autocomplete="off"><br><br>

					Password:<br>
					<span class="error" id="error_passwordblank">You must enter a password.<br></span>
					<span class="error" id="error_passwordlength">Your password must be at least 6 characters long.<br></span>
					<span class="error" id="error_passwordcontent">Your password contain at least 1 uppercase letter, 1 lowercase letter, and 1 number.<br></span>
					<input class = "samebox" type = "password" id="password" name = "password" placeholder = "Password" autocomplete="off" ><br><br>

					Security Question (case sensitive):<br>
			    	<select id = "dropbox" name = "security_questions">
						<option value = "number_1 "> What was your mother's maiden name?</option>
						<option value="saab">What was your childhood nickname?</option>
						<option value="fiat">What school did you attend in 6th grade?</option>
						<option value="audi">What was the model of your first car?</option>
			    	</select>
			    	<br><br>
					<span class="error" id="error_answerblank">You must enter an answer.<br></span>
			    	<input class = "samebox" type = "text" id="security_answer" name = "security_answer" placeholder = "Answer" autocomplete="off" ><br><br>
					<button id = "submit">Create Account</button>
				<!--</form>-->
		</div>
	</div>
	
</body>
</html>





