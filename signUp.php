<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <link href="hw1.css" rel="stylesheet">
        <title>Runner++: Create Account</title>
        <link rel="apple-touch-icon" sizes="180x180" href="favicon_package_v0/apple-touch-icon.png">
        <link rel="icon" type="image/png" sizes="32x32" href="favicon_package_v0/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="16x16" href="favicon_package_v0/favicon-16x16.png">
        <link rel="manifest" href="favicon_package_v0/site.webmanifest">
        <link rel="mask-icon" href="favicon_package_v0/safari-pinned-tab.svg" color="#5bbad5">
        <meta name="msapplication-TileColor" content="#da532c">
        <meta name="theme-color" content="#ffffff">
    </head>
    <body>
    <div class="container">
        <div class="header">
            <h1>Create Account</h1><img src="csub_logo.png" alt="logo" />
        </div>

        <form mame="emailSignUp" action="/form/submit" method="post">
            <div class="column">
                <div class="nameEntry">
                    <label for="fname">First Name:</label>
                    <input type="text" id="textbox" name="fname" />
                    <br />

                    <label for="lname">Last Name:</label>
                    <input type="text" id="textbox" name="lname" />
                    <br />

                    <label for="uname">Username:</label>
                    <input type="text" id="textbox" name="uname" />
                    <br />

                    <label for="phone">Phone Number:</label>
                    <input type="text" id="textbox" name="phone" />
                    <br />

                    <label for="email">Email:</label>
                    <input type="text" id="textbox" name="email" />
                    <br />

                    <label for="position">Position:</label>
                    <select id="position" name="position">
                        <option value="student/faculty">Student/Faculty</option>
                        <option value="employee">Employee</option>
                    </select>
                    <br />
              
                    <label for="password">New Password:</label>
                    <input type="password" id="myPassword" name="password">
                    <br />

                    <label for="password">Re-Enter Password:</label>
                    <input type="password" id="myPassword" name="password">
                    <br />

                    <input type="checkbox" onclick="showPassword()" style="font-size: 12px;">Show Password
                    <br />
    
                    <button type="button">Submit</button>
                </div>
            </div>
        </form>

        <script src="hw1.js"></script>
    </div>
    </body>
</html>
