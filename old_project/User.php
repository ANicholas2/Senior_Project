<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <link href="project.css" rel="stylesheet">
        <title>Runner++: User Account</title>
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
        
        <!-- <form name="emailSignup">
            <div class="column">
                <div class="nameEntry">
                    Email: <input type="text" id="textbox" name="email"><br />
                    Password: <input type="text" id="textbox" name="password"><br />
                </div>
            <input type="button" value="Log In" id="newButton" onClick="validateForm()"><br />
            </div>            
        </form> -->

        <form mame="emailLogIn" //action="/form/submit" //method="post">
            <div class="column">
                <div class="nameEntry">
                    <div class="header">
                        <h1>Runner++</h1><img src="csub_logo.png" alt="logo" />
                    </div>
                </div>
                <br />
                <div class="nameEntry">
                    <label for="firstName">First Name:</label>
                    <input type="text" id="textbox" name="firstName">
                    <br />
                    <label for="lastName">Last Name:</label>
                    <input type="text" id="textbox" name="lastName">
                    <br />
                    <label for="userName">Username:</label>
                    <input type="text" id="textbox" name="userName">
                    <br />
                    <button type="button" onclick="validateForm()">Save</button>
                    <br />
                </div>              
            </div>
        </form>
        <script src="project.js"></script>
    </div>
    </body>
</html>
