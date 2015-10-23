$(function() {
"use strict";
	Parse.$ = jQuery;

	Parse.initialize("9syVLvZdcJKZD9uAlCoYMKwjtmWxPHFhD4DdYKcN", "HH4p0QrjdzsO74KsoLhhhUZnPYDwExnZ8o9CCAeN");
	var Post = Parse.Object.extend("Post");
	
	//logout 
	// when this runs, jquery creates an event listener for the function
	$("#logout").click(function(event) {				
		Parse.User.logOut();
		$.post('logout.php', {'logout' : true}, function(data) {
			if(data.success == true) {
				location.reload(true);
			}			
		}, 'json');
		console.log("logout success.");
	});
	
});