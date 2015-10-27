$(function() {
"use strict";
	Parse.$ = jQuery;

	Parse.initialize("21WjmmvR9bBPQi7sFjFVECL0tO1kETVsqtgHbJOA", "FeX6bK9Utc0fuBt9KpBqSzgFOskmHgHS04f2k6mC");
	var Post = Parse.Object.extend("Post");

	// ************ P A R S E   V I E W *********************
	var LoginView = Parse.View.extend({
			template: Handlebars.compile($('#login-tpl').html()),
			events: {
				'submit .form-signin': 'login'
			},
			login: function(e) {
		 
				// Prevent Default Submit Event
				e.preventDefault();
		 
				// Get data from the form and put them into variables
				var data = $(e.target).serializeArray(),
					username = data[0].value,
					password = data[1].value;
		 
				// Call Parse Login function with those variables
				Parse.User.logIn(username, password, {
					// If the username and password matches
					success: function(user) {
						alert('Welcome!');
					},
					// If there is an error
					error: function(user, error) {
						console.log(error);
					}
				});
			},	
			render: function(){
				this.$el.html(this.template());
			}
		}),
		WelcomeView = Parse.View.extend({
			template: Handlebars.compile($('#welcome-tpl').html()),
			render: function(){
				var attributes = this.model.toJSON();
				this.$el.html(this.template(attributes));
			}
		});	
	
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
		event.preventDefault(); //prevent browser to refress and erase the js after the submit is pressed
		
		var user = new Parse.User();
		user.set("username", $("#loginUsername").val());
		user.set("password", $("#loginPassword").val());
		user.logIn({
			success: function(user) { //on success, user object is pass back to me
				location.reload();
				//window.location.href = '.html'; // go to main page
			},
			error: function(user, error) {
				console.log("login error:"+error.message);
				alert("Error: " + error.code + " " + error.message);
			}
		});
	});
	
	// ******************** S I G U P ************************
	$("#signup").submit(function(event){
		event.preventDefault();
		
		var newUser = new Parse.User();
		newUser.set("username", $("#signupUsername").val());
		newUser.set("password", $("#signupPassword").val());
		newUser.set("email", $("#signupEmail").val());
		user.signUp({
			success: function(user) {
				displayCurrentUser();
			},
			error: function(user, error) {
				console.log("signuperror:"+error.message);
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
