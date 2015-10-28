$(function() {
"use strict";
	Parse.$ = jQuery;

	Parse.initialize("21WjmmvR9bBPQi7sFjFVECL0tO1kETVsqtgHbJOA", "FeX6bK9Utc0fuBt9KpBqSzgFOskmHgHS04f2k6mC");
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
	$("#login").submit(function(event){
		event.preventDefault(); //prevent browser to refress and erase the js after the submit is pressed
		
		var username=$("#login-username").val();
		var password=$("#login-password").val();
		
		Parse.User.logIn(username, password, {
			success: function(user) { //on success, user object is pass back to me
				console.log("login success.");
				$.post('login.php', {'authentication' : true}, function(data) {
					if(data.success == true) {
						location.reload(true);
					}					
				}, 'json');
				displayCurrentUser();
			},
			error: function(user, error) {
				alert("Parse error(" + error.code + "): " + error.message);
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
			currentUser.save({
				success: function(user) {
					displayCurrentUser();
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
