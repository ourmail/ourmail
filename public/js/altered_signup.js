$(function() {
	// ************** I N I T I A L I Z E *******************
	"use strict"
	Parse.$ = jQuery;
	Parse.initialize("9syVLvZdcJKZD9uAlCoYMKwjtmWxPHFhD4DdYKcN", "HH4p0QrjdzsO74KsoLhhhUZnPYDwExnZ8o9CCAeN"); 
	
	function firstnameTest(input) {
		if(input == "") {
			$('#error_firstname').css('display', 'block');
			return false;
		}
		else {
			$('#error_firstname').css('display', 'none');
			return true;
		}
	}
	
	function lastnameTest(input) {
		if(input == "") {
			$('#error_lastname').css('display', 'block');
			return false;
		}
		else {
			$('#error_lastname').css('display', 'none');
			return true;
		}
	}
	
	function emailTest(input) {
		if(input == "") {
			$('#error_emailblank').css('display', 'block');
			$('#error_emailinvalid').css('display', 'none');
			return false;
		}
		else if(!(input.indexOf("@") > 0)) {
			// Quick and easy check, checking the exact guidelines is far too long, and javascript validation can be bypassed just by turning off javascript in your browser (although not in this case, because javascript will be needed for the button as well).
			$('#error_emailblank').css('display', 'none');
			$('#error_emailinvalid').css('display', 'block');
			return false;
		}
		else {
			$('#error_emailblank').css('display', 'none');
			$('#error_emailinvalid').css('display', 'none');
			return true;
		}
	}
	
	function usernameTest(input) {
		if(input == "") {
			$('#error_usernameblank').css('display', 'block');
			$('#error_usernamelength').css('display', 'none');
			return false;
		}
		else if (input.length < 5 || input.length > 20) {
			$('#error_usernamelength').css('display', 'block');
			$('#error_usernameblank').css('display', 'none');
			return false;
		}
		else {
			$('#error_usernameblank').css('display', 'none');
			$('#error_usernamelength').css('display', 'none');
			return true;
		}
	}
	
	function answerTest(input) {
		if(input == "") {
			$('#error_answerblank').css('display', 'block');
			return false;
		}
		else {
			$('#error_answerblank').css('display', 'none');
			return true;
		}
	}
	
	function passwordTest(input) {
		if(input == "") {
			$('#error_passwordblank').css('display', 'block');
			$('#error_passwordlength').css('display', 'none');
			$('#error_passwordcontent').css('display', 'none');
			return false;
		}
		else if (input.length < 6) {
			$('#error_passwordlength').css('display', 'block');
			$('#error_passwordblank').css('display', 'none');
			$('#error_passwordcontent').css('display', 'none');
			return false;
		}
		else if (!input.match(/[A-Z]/g) || !input.match(/[a-z]/g) || !input.match(/[0-9]/g)){
			$('#error_passwordlength').css('display', 'none');
			$('#error_passwordblank').css('display', 'none');
			$('#error_passwordcontent').css('display', 'block');
			return false;
		}
		else {
			$('#error_passwordblank').css('display', 'none');
			$('#error_passwordlength').css('display', 'none');
			$('#error_passwordcontent').css('display', 'none');
			return true;
		}
	}
	
	$('#firstname').blur(function() { return firstnameTest(this.value); });
	
	$('#lastname').blur(function() { return lastnameTest(this.value); });
	
	$('#email').blur(function() { return emailTest(this.value); });
	
	$('#username').blur(function() { return usernameTest(this.value); });
	
	$('#security_answer').blur(function() { return answerTest(this.value); });
	
	$('#password').blur(function() { return passwordTest(this.value); });
	
	// ******************** S I G N U P ************************
	
	$('#submit').click(function() {
		var firstnameTestResult = firstnameTest($('#firstname').val());
		var lastnameTestResult = lastnameTest($('#lastname').val());
		var emailTestResult = emailTest($('#email').val());
		var usernameTestResult = usernameTest($('#username').val());
		var answerTestResult = answerTest($('#security_answer').val());
		var passwordTestResult = passwordTest($('#password').val());
		
		
		if(firstnameTestResult && lastnameTestResult && emailTestResult && usernameTestResult && answerTestResult && passwordTestResult) {
			console.log("success");
			var newUser = new Parse.User();
			newUser.set("firstName", $('#firstname').val());
			newUser.set("lastName", $("#lastname").val());
			newUser.set("username", $("#username").val());
			newUser.set("password", $("#password").val());
			newUser.set("email", $("#email").val());
			newUser.signUp(null, {
				success: function(newUser) {
					Parse.User.logOut();
					console.log("signup success.");
					window.location.href = 'index.php'; // go to index page for login
				},
				error: function(newUser, error) {
					// 202 == duplicate username
					// 125 == invalid email address
					if(error.code == 202) {
						$('#error_usernameduplicate').css('display', 'block');
					}
					else if (error.code == 125) {
						$('#error_emailinvalid').css('display', 'block');
					}
					else {
						alert("Parse Error(" + error.code + "): " + error.message);
					}					
				}
			});
			
		}
		else {
			console.log("failure");
		}
	});	
});