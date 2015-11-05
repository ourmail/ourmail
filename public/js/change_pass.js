Parse.initialize("9syVLvZdcJKZD9uAlCoYMKwjtmWxPHFhD4DdYKcN", "HH4p0QrjdzsO74KsoLhhhUZnPYDwExnZ8o9CCAeN"); 

function test()
{
	console.log("heyyyyyy");
	console.log(Parse.User.current());

}

function send_email_request()
{
	//var security_ans = document.passwordform.security_answer.value;

	var cur_user = Parse.User.current();
    console.log(cur_user);
    console.log(document.getElementsByName("email")[0].value);

    var u_Email = document.getElementsByName("email")[0].value;
    var sec_answer = document.getElementsByName("security_answer")[0].value;
    console.log(sec_answer);

	//checking if the security question is right
	if (sec_answer != cur_user.get("security_answer"))
	{
        alert("Error: Incorrect answer to security question!");
        document.passwordform.security_answer.focus();
        return false;
	}

    Parse.User.requestPasswordReset(u_Email, {
  	success: function() {
  	     alert("Password reset instructions were successfully sent to your email address.");
		 window.location.href = "main.php";
         return true;
  	},
  	error: function(error) {
    	// Show the error message somewhere
    	alert("Error: " + error.code + " " + error.message);
        return false;
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
    //if (checkEmptyFields() == false)
      //  return false;

    //if (emailVerify() == false)
      //  return false;

    //test();
    send_email_request();

    return true;
}