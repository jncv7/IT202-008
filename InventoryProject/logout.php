<!DOCTYPE html>


<head>
    <meta charset="utf-8">
    <meta name="LogOut Page" content="This page is to logout LLOL">
    <title>Logout</title>
    <!-- <link rel="stylesheet" href="logoutScreen.css"> -->


    <style>
        #message {
            text-align: center;
            color: white;
            font-size: 42px;


        }

        #notif {
            text-align: center;
            font-size: 20px;
            color: lightblue;
        }
    </style>
</head>

<body style="background-color: blue">
    <div id="container">

        <div id="message">
            <p>
                Thank you for playing this game!
            </p>
        </div>

        <div id="notif">
            <p>
                This page will redirect you in 10 seconds ...
            </p>

        </div>






    </div>



</body>

</html>



<?php

//starts a session
session_start();
session_unset();

//kills the session

session_destroy();

// echo "See you later!";
// echo var_export($_SESSION, true);

//get session cookie and delete/clear it for this session
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    //clones then destroys since it makes it's lifetime 
    //negative (in the past)
    setcookie(
        session_name(),
        '',
        time() - 42000,
        $params["path"],
        $params["domain"],
        $params["secure"],
        $params["httponly"]
    );
}



// redirect the user to the login page
// it will auto redirect after 10 seconds
header('Refresh: 10, URL = https://web.njit.edu/~jcv7/it202008/InventoryProject/login.php');

?>