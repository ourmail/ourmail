$(function() {
"use strict";
	Parse.$ = jQuery;

	Parse.initialize("9syVLvZdcJKZD9uAlCoYMKwjtmWxPHFhD4DdYKcN", "HH4p0QrjdzsO74KsoLhhhUZnPYDwExnZ8o9CCAeN");
	var Post = Parse.Object.extend("Post");
	
	function displayCurrentUser() {
		if (Parse.User.current()) {
			console.log("Logged in by "+Parse.User.current().get("username"));
			$("#current-user").html(Parse.User.current().get("username"));
		}
		else {
			$("#current-user").html("none");
		}
	}
	
	displayCurrentUser();
	
	//logout 
	// when this runs, jquery creates an event listener for the function
	$("#logout").click(function(event) {				
		Parse.User.logOut();
		displayCurrentUser();
		console.log("logout success.");
	});
	
	//submit action for login
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
				console.log("login error:"+error.message);
			}
		});
	});
});
