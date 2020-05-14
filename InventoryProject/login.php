<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <script src="loginFunc.js"></script>
    <title>Login to Inventory </title>
    <link rel="stylesheet" type="text/css" media="screen" href="loginScreen.css">
</head>

<body>
    <div id="message">
    
        <p>
            Hello! This is the login screen for the game!
            Please enter your username and password.
        </p>

    </div>
    <div id="loginStuff">

        <form name="loginForm" id="myForm" method="POST"
           onsubmit="return checkAll (this)" >
           
            <label for="username">Username: </label>
            <input type="username" id="username" name="username" placeholder="Enter Username" />

            <label for="pass">Password: </label>
            <input type="password" id="pass" name="password" placeholder="Enter Password" />

            <input type="submit" value="Login" />
        </form>

    </div>




</body>

</html>

<?php
include("header.html");

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// you need a session so that while the user is logged in, the can stay logged in
session_start();


//check if the username and password is here, and make sure that the 
//pass is NOT empty
if (
    isset($_POST['username']) &&
    isset($_POST['password']) &&
    !empty($_POST['password'])

) {
    // grab that information from the user
    $pass = $_POST['password'];
    $user = $_POST['username'];

    // go into the server and check those passwords

    require("config.php");
    $connection_string = "mysql:host=$dbhost;dbname=$dbdatabase;charset=utf8mb4";

    try {

        $db = new PDO($connection_string, $dbuser, $dbpass);

        // look for that users password from their username
        // note that the usernames should not be the same ...
        $stmt = $db->prepare("Select username, pwrd from `ProjectsTable` where username = :username");
        $params = array(":username" => $user);
        $stmt->execute($params);

        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        // echo "<pre>" . var_export($stmt->errorInfo(), true) . "</pre>";

        if ($result) {
            // so now you have the password from the server
            $userpassword = $result['pwrd'];

            //check the 2 passwords
            if (password_verify($pass, $userpassword)) {
                // $id = $result['id'];
                echo "You logged in " . $user . "! <br>";

                $_SESSION['SignedIn'] = 1; // 1 is signed in, otherwise its not
                $_SESSION['user'] = $user;
                //  echo "Session: <pre>" . var_export($_SESSION, true) . "</pre>";

            } else {

                echo "Failed to login, invalid password";
            }
        } else {
            echo "username does not exist";
        }
    } catch (Exception $e) {
        echo $e->getMessage();
        exit();
    }
}



?>