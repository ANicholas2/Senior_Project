<?php 

//require_once "nav.php";

include("connectToDB.php");
include("salthash.php");
//make sure connection to DB
if(mysqli_connect_errno()) {
	print("connection failed: %s\n", mysqli_connection_error());
	exit();
}

//insertion of user info
if($_SERVER["REQUEST_METHOD"]=="POST") {
	$fname = $_POST['fname'];
	$lname = $_POST['lname'];
	$uname = $_POST['uname'];
	$email = $_POST['email'];
	$pos = $_POST['pos'];
	$password = $_POST['password'];
	$passwordMatch = $_POST['passwordMatch'];

	$query = mysqli_query($db, "select email from User where email='".$email."'");
	if(mysqli_num_rows($query) != 0) {
		//already an account with inputted email
		echo '<span style="color:red;text-align:center;">Email is already in use</span>';
	}
	elseif(strlen($password) < 8 || strlen($password) > 16){
		//password not in correct length
		echo '<span style="color:red;text-align:center;">Please insert passworkd between 8 and 20 characters</span>';
	}
	elseif($password!=$passwordMatch) {
		//passwords dont match
		echo '<span style="color:red;text-align:center;">Passwords do not match</span>';
	}
	else {
		//create user with encrypted password
		$password=encrypt($password);
		if($pos == "student/faculty")
			$numPos = 0;
		if($pos == "employee")
			$numPos = 1;
		$query = "insert into User (fName, lName, uName, email, position, pass) values ('$fname', '$lname', '$uname', '$email', '$numPos', '$password');";
		if(mysqli_query($db, $query)) {
			header("Location: login.php");
		}
		else {
			echo '<span style="color:red;text-align:center;">Error in executing sql command</span>';
		}
	}
}

?>

<html lang="en">
    <head>
        <meta charset="utf-8">
        <link href="project.css" rel="stylesheet">
        <title>Runner++: Create Account</title>
        <link rel="apple-touch-icon" sizes="180x180" href="favicon_package_v0/apple-touch-icon.png">
        <link rel="icon" type="image/png" sizes="32x32" href="favicon_package_v0/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="16x16" href="favicon_package_v0/favicon-16x16.png">
        <link rel="manifest" href="favicon_package_v0/site.webmanifest">
        <link rel="mask-icon" href="favicon_package_v0/safari-pinned-tab.svg" color="#5bbad5">
        <meta name="msapplication-TileColor" content="#da532c">
        <meta name="theme-color" content="#ffffff">
    </head>


    <body class="text-center" style="background-color:#152530;">
    <div class="container-sm">
        <div class="header">
            <h1>Create Account</h1><img src="csub_logo.png" alt="logo">
            <br />
        </div>

        <form mame="emailSignUp" action="/form/submit" method="post">
            <div class="column">
                <div class="nameEntry">
                    <label for="fname" class="sr-only">First Name:</label>
                    <input type="text" name="fname" class="form-control" style="margin-bottom:20" placeholder="First Name" required="">
                    <br />

                    <label for="lname" class="sr-only">Last Name:</label>
                    <input type="text" name="lname" class="form-control" style="margin-bottom:20" placeholder="Last Name" required="">
                    <br />

                    <label for="uname" class="sr-only">Username:</label>
                    <input type="text" name="uname" class="form-control" style="margin-bottom:20" placeholder="Username" required="">
                    <br />

                    <label for="inputEmail" class-"sr-only">Email:</label>
                    <input type="email" name="email" class="form-control" style="margin-bottom:20" placeholder="Email" required="">
                    <br />

                    <label for="position">Position:</label>
                    <select id="position" name="position">
                        <option value="student/faculty">Student/Faculty</option>
                        <option value="employee">Employee</option>
                    </select>
                    <br />
              
                    <label for="inputPassword" class="sr-only">Password:</label>
                    <input name="password" name="password" type="password" onkeyup='check();' class="form-control" style="margin-bottom:20" placeholder="Password" required="">
                    <br />

                    <label for="reinsertPassword" class="sr-only">Re-Enter Password:</label>
		    <input type="password" name="passwordMatch" onkeyup='check();' class="form-control" style="margin-bottom:20" placeholder="Reinsert Password" required="">
                    <br />

                    <input type="checkbox" onclick="showPassword()" style="font-size: 12px;">Show Password
                    <br />
    
		    <button formaction="" class="btn btn-lg btn-primary btn-block" type="submit" onclick="return check();">Submit</button>
                </div>
            </div>
        </form>
        <script src="project.js"></script>
    </div>
    </body>
</html>
