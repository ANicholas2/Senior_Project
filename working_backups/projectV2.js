/*function validateForm() {
    var validPassword = false; 
    var validEmail = false;
    //var nameCheck =  /^([a-zA-Z])+$/;
    var passwordCheck =  /^([a-zA-Z])+$/;
    var emailCheck = /^([a-z0-9-])+\@csub.edu$/;
    //var firstName = document.emailSignup.firstName;
    var password = document.emailLogIn.password;
    var emailValue = document.emailLogIn.email;

    if(emailValue.value == "" || !emailCheck.test(emailValue.value)) {
        console.log("error");
        alert("Invalid Information");
        document.getElementById("textbox").style.borderColor = "red";
    } else {
        validEmail = true;
        document.getElementById("textbox").style.borderColor;
    }

    if(password.value == "" || !passwordCheck.test(password.value)) {
        console.log("error");
        alert("Invalid Information");
        document.getElementById("myPassword").style.borderColor = "red";
    } else {
        validPassword = true;
        document.getElementById("myPassword").style.borderColor;
    }

    if (validPassword == true && validEmail == true) {
        document.emailLogIn.innerHTML = `<h2>THANK YOU!</h2>`;
    }
}

function showPassword() {
    var x = document.getElementById("myPassword");

    if (x.type === "password") {
      x.type = "text";
    } else {
      x.type = "password";
    }
}*/

/* Set the width of the sidebar to 250px (show it) */
function openNav() {
    document.getElementById("mySidepanel").style.width = "250px";
  }
  
  /* Set the width of the sidebar to 0 (hide it) */
  function closeNav() {
    document.getElementById("mySidepanel").style.width = "0";
  }

function createUser() {
	var first = document.getElementByID('fname').value;
	var last = document.getElementByID('lname').value;
	var user = document.getElementByID('uname').value;
	var e = document.getElementByID('email').value;
	var pos = document.getElementByID('position').value;
	var pw = document.getElementByID('myPassword').value;
	var repw = document.getElementByID('matchPassword').value;
	//if(pw == repw) {
		const mysql = require('mysql');
		const connection = mysql.createConnect({
			host: "localhost",
			user: "runnerpp",
			password: "Lurw01hoy", 
			database: "MariaDB"
		});
		connection.connect((err) => {
			if (err) { throw err; }
			console.log("database connection working");
		});

		connection.query("INSERT INTO 'User' (fName, lName, uName, email, position, pass) VALUES (first, last, user, e, pos, pw);", (err) => {
		if (err) {throw err; }
		console.log(results);
		});
		/*
		connnection.connect(function(err) {
			if (err) 
				throw err;
		connection.query = "INSERT INTO User (fName, lName, uName, email, position, pass) VALUES (first, last, user, e, pos, pw);";
		if (err) 
			throw err;
		console.log(result);
		});*/
	//});	
}
