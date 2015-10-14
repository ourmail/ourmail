
Parse.initialize("9syVLvZdcJKZD9uAlCoYMKwjtmWxPHFhD4DdYKcN", "HH4p0QrjdzsO74KsoLhhhUZnPYDwExnZ8o9CCAeN");

var TestObject = Parse.Object.extend("TestObject");
var testObject = new TestObject();
  testObject.save({foo: "bar"}, {
  success: function(object) {
    console.log("Success")
  },
  error: function(model, error) {
    console.log("Fail")
  }
});

function checkEmptyFields()
{
    if (document.signupform.firstname.value == "")
    {
        alert("Please enter your first name!");
        document.signupform.firstname.focus() ;
        return false;
    }

    if (document.signupform.lastname.value == "")
    {
        alert("Please enter your last name!");
        document.signupform.lastname.focus() ;
        return false;
    }

    if (document.signupform.email.value == "")
    {
        alert("Please enter an email address!");
        document.signupform.email.focus() ;
        return false;
    }
    
    if (document.signupform.username.value == "")
    {
        alert("Please enter a username!");
        document.signupform.username.focus();
        return false;
    }
    
    if (document.signupform.password.value == "")
    {
        alert("Please enter a password!");
        document.signupform.password.focus();
        return false;
    }
    
     if (document.signupform.security_answer.value == "")
    {
        alert("Please enter a security answer!");
        document.signupform.security_answer.focus();
        return false;
    }
    
    return true;
}

function usernameVerify()
{
    // this is where the other validation begins
    if (document.signupform.username.value.length < 5)
    {
        alert("Please enter a username that is at least 5 characters long.");
        document.signupform.username.focus();
        document.signupform.username.value = "";
        return false;
    }
    
    if (document.signupform.username.value.length > 20)
    {
        alert("Please limit your username to 20 characters or less.");
        document.signupform.username.focus();
        document.signupform.username.value = "";
        return false;
    }

    return true;
}

function passwordLengthCheck()
{
    if (document.signupform.password.value.length < 8)
    {
        alert("Please create a password that is at least 8 characters.");
        document.signupform.password.focus();
        document.signupform.password.value = "";
        return false;
    }

    return true;
}

function passwordVerify()
{
    console.log("hello");
    var pass = document.signupform.password.value;

    console.log(pass);

    var letters = /[A-z]/g;
    
    if(pass.match(letters))
        var numLetters = pass.match(letters).length;
    
    else
        var numLetters = 0;
    
    var numbers = /[0-9]/g;
    
    if(pass.match(numbers))
        var numNumbers = pass.match(numbers).length;
    
    else
        var numNumbers = 0;
    
    console.log("Number of letters: " + numLetters);
    console.log("Number of numbers: " + numNumbers);
    
    if (numNumbers < 2 )
    {
        alert("Please create a password that contains at least 2 digits.");
        document.signupform.password.focus();
        document.signupform.password.value = "";
        return false;
    }
    
    if(numLetters < 1)
    {
        alert("Please include characters other than numbers in your password.");
        document.signupform.password.focus();
        document.signupform.password.value = "";
        return false;
    }
    
    return true;
}


function emailVerify()
{
    var email = document.signupform.email.value;
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


function validation()
{

    // calling empty field checker
    if (checkEmptyFields() == false)
        return false;

    // calling function to check username
    if (usernameVerify() == false)
        return false;

    // calling the function to check length of password
    if (passwordLengthCheck() == false)
        return false;    

    if (emailVerify() == false)
        return false;
    
    // this function is used to verify the password
    if (passwordVerify() == false)
        return false;
     
    return true;
}














