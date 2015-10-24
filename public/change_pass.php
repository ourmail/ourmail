<!DOCTYPE html>
<html>

<head>
	<title>Change Password</title>

	<script src = "http://www.parsecdn.com/js/parse-latest.js"></script>

	<script src = "js/change_pass.js"></script>

</head>

<body>

	<form name = "passwordform" onsubmit = "return(security_check());" >
	Please fill out this form to change your password.<br><br>

	Account Email:<br>
	<input type = "text" name = "email" placeholder = "Email" autocomplete="on"><br><br>

	Security Question (case sensitive):<br>
    <select name = "security_questions">
    <option value = "number_1 "> What was your mother's maiden name?</option>
    <option value = "number_2"> What was your childhood nickname?</option>
    <option value = "number_3"> What school did you attend in 6th grade?</option>
    <option value = "number_4"> What was the model of your first car?</option>
    </select>
    <br><br>
    	
    <input class = "samebox" type = "text" name = "security_answer" placeholder = "Answer" autocomplete="off" ><br><br>

    <input id = "submit" type="submit">
    </form>

</body>

</html