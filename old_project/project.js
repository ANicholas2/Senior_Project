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

