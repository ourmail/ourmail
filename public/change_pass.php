<?
session_start();
session_regenerate_id();

if(!isset($_SESSION['userauth'])) {
	header("Location: index.php");
}
?>
<!DOCTYPE html>
<html>

<head>
	<title>Change Password</title>

	<script src = "http://www.parsecdn.com/js/parse-latest.js"></script>

	<script src = "js/change_pass.js"></script>

</head>

<body>

	Please fill out this form to change your password.<br><br>

	Account Email:<br>
	<input type = "text" name = "email" placeholder = "Email" autocomplete="on"><br><br>

	<script>
        var question = Parse.User.current().get("security_question");
        
        if (question == "number_1")
            document.write("What was your mother's maiden name?");

        else if (question == "number_2")
            document.write("What was your childhood nickname?");

        else if (question == "number_3")
            document.write("What school did you attend in 6th grade?");

        else
            document.write("What was the model of your first car?");

    </script>
    	
    <input class = "samebox" type = "text" name = "security_answer" placeholder = "Answer" autocomplete="off" ><br><br>

    <input id = "submit" type="submit" onclick= security_check()>
    </form>

</body>

</html