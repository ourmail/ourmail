$(function() {
"use strict";
	Parse.$ = jQuery;
	Parse.initialize("9syVLvZdcJKZD9uAlCoYMKwjtmWxPHFhD4DdYKcN", "HH4p0QrjdzsO74KsoLhhhUZnPYDwExnZ8o9CCAeN"); 

	var Post = Parse.Object.extend("Post");

	// ************ C U R R E N T   U S E R *******************
	function displayCurrentUser() {
		if (Parse.User.current()) {
			console.log("Logged in by "+Parse.User.current().get("username"));
			$("#current-user").html("Current User is "+Parse.User.current().get("username"));
		}
		else {
			$("#current-user").html("Current User is no one.");
		}
	}
	
	displayCurrentUser();
	
	// ***************** L O G O U T ********************
	// when this runs, jquery creates an event listener for the function
	$("#logout").click(function(event) {
		Parse.User.logOut();
		displayCurrentUser();
		console.log("logout success.");
	})
	
	// ****************** L O G I N *************************
	
	$("#login").submit(function(event) {
		var user = new Parse.User();
		user.set("username", $("#loginUsername").val());
		user.set("password", $("#loginPassword").val());
		user.logIn({
			success: function(user) { //on success, user object is pass back to me
				console.log("login success."); 
				$.post('login.php', {'authentication' : true, 
									'email' : user.get('email'), 
									'username' : user.get('username'), 
									'firstname' : user.get('firstName'), 
									'lastname' : user.get('lastName')
									}, function(data) {
					if(data.success == true) {
						window.location.href = 'main.php'; // go to main page
					}
				}, 'json');
			},
			error: function(user, error) {
				console.log("Parse login error:" + error.message);
				alert("Parse Error (" + error.code + "): " + error.message);
			}
		});
	});
	
	// *********** A C C O U N T   M A N A G E M E N T **********
	$("#accountManagement").submit(function(event){
		event.preventDefault();
		
		var currentUser= Parse.User.current();
		if (currentUser){
			//change username and password
			currentUser.set("username", $("#newUsername").val());
			currentUser.set("email", $("#newEmail").val());
			//var ImapData = Parse.Object.extend("imapData");
			//var imapData = new ImapData();
			//imapData.set("email", {gmail : "jgoul004@ucr.edu"});
			//imapData.set("password", {gmail : "haha"});
			/*imapData.save(null, {
				success: function(data) {
					alert("success");
				},
				error: function(data, error) {
					alert(error.message);
				}
			});*/	
			
			//currentUser.set("imapData", imapData);
			currentUser.save({
				success: function(user) {
					displayCurrentUser();
					$.post('session_update.php', {'email' : user.get('email'), 
										'username' : user.get('username'), 
										'firstname' : user.get('firstName'), 
										'lastname' : user.get('lastName')
										}, function(data) {
						//alert(data);
						if(data.success == true) {
							window.location.href = 'main.php'; // go to main page
						}
						else {
							console.log('Error in session_update.php');
						}
					}, 'json');
				},
				error: function(user, error) {
					alert("Error: " + error.code + " " + error.message);
				}
			});

		} else {
			//show the signup or login page
			
		}
	});
});
