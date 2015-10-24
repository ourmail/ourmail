Parse.initialize("9syVLvZdcJKZD9uAlCoYMKwjtmWxPHFhD4DdYKcN", "HH4p0QrjdzsO74KsoLhhhUZnPYDwExnZ8o9CCAeN"); 

function test()
{
	console.log("heyyyyyy");
	console.log(Parse.User.current());

}

function send_email_request()
{
	var security_ans = document.passwordform.security_answer.value;

	var cur_user = Parse.User.current();

	// checking if the security question is right
	if (security_ans != cur_user.get("securityAnswer"))
	{
		alert("Error: Incorrect answer to security question!")
		document.passwordform.security_answer.focus();
        return false;
	}

    Parse.User.requestPasswordReset("email@example.com", {
  	success: function() {
  	// Password reset request was sent successfully
  	},
  	error: function(error) {
    	// Show the error message somewhere
    	alert("Error: " + error.code + " " + error.message);
  	}
	});

	//console.log("hello");
	//console.log(cur_user.get("username"));
	//console.log(cur_user.get("securityAnswer")); 
}



function checkEmptyFields()
{
    if (document.passwordform.email.value == "")
    {
        alert("Please enter an email address!");
        document.passwordform.email.focus() ;
        return false;
    }
    
  
    if (document.passwordform.security_answer.value == "")
    {
        alert("Please enter a security answer!");
        document.passwordform.security_answer.focus();
        return false;
    }
    
    return true;
}

function emailVerify()
{
    var email = document.passwordform.email.value;
    var check = /.+@.+\..+/i;

    console.log(email.match(check));

    if(email.match(check))
    {
        return true;
    }
    else
    {
        alert("Invalid e-mail")
        return false;
    }
}

function security_check()
{
	// calling empty field checker
    if (checkEmptyFields() == false)
        return false;

    if (emailVerify() == false)
        return false;

    send_email_request();

    return true;
}