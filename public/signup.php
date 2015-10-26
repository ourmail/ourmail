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

	<link href="css/bootstrap.min.css" rel="stylesheet">

    <link href="css/landing.css" rel="stylesheet">

	<link rel = "stylesheet" type = "text/css" href = "css/signup.css">

    <script src = "js/signup_script.js"></script>

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
		</div>
	</div>
</body>
</html>





