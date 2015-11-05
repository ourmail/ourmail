$(function() {
	Parse.initialize("9syVLvZdcJKZD9uAlCoYMKwjtmWxPHFhD4DdYKcN", "HH4p0QrjdzsO74KsoLhhhUZnPYDwExnZ8o9CCAeN"); 

	if(Parse.User.current())
	{
		var email = Parse.User.current().get("email");
		console.log("Current user's email: " + email);
		$.post('dashboard.php', {'email' : email});
	}else
	{
		console.log("Not logged in");
	}
});