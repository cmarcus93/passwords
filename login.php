<?php
require("include.php");

if($pageMode==="logout"){
    session_destroy();
    header("Location: index.php"); die();
}

if($pageMode=="login") {
    if (isset($_POST["username"]) && isset($_POST["username"])) {
        $username = trim($_POST["username"]);
        $password = trim($_POST["password"]);
        if (!empty($username) && !empty($password)) {
            //sanitise and stuff
            $user = getUser($username, $settings['ldap_staffou']);
            if (in_array($settings['ldap_resetsg'], $user['memberof'])) {
                if (ldapBind($user['samaccountname'], $password)) {
                    $_SESSION["loggedin"] = true;
                    $_SESSION["username"] = $username;
                    $_SESSION["name"] = $user['givenname'] . " " . $user['sn'];  
                }
            }
        }
    }
    header("location: index.php"); die(); 
}
?>
<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Students</title>
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4-4.1.1/jq-3.3.1/dt-1.10.20/b-1.6.1/fh-3.1.6/sl-1.3.1/datatables.min.css"/>
        <link rel="stylesheet" type="text/css" href="passwords.css"/>
    </head>
    <body>
        <div class="container logindiv" style="max-width: 300px;">
            <form class="form-signin" method="POST" action="login.php?mode=login">
                <label for="inputusername" class="sr-only">Username</label>
                <input type="text" name="username" id="inputusername" class="form-control" placeholder="Username" required autofocus autocomplete="off">
                <label for="inputPassword" class="sr-only">Password</label>
                <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Password" required autocomplete="off">
                <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
            </form>
        </div>
    </body>
</html>