<?php
include("header.html");

// have it so the player has to be logged in
session_start();
$check = $_SESSION['SignedIn'];
if ($check == 0) {
    header ("Location: login.php");
}
?>

<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <link rel= "stylesheet" type ="text/css" media = "screen" href="GotchaGame.css">
        <title>GOTCHA GAME</title>
        
    </head>
    <body>
        <p>
            Click the button to get an Item. <br>
           
        </p>
        

        <button onclick="randomNumbers(0,1000)">
        Press me!
        </button>

        <p1 id="NumGot"></p1>


 
        
        
    </body>
    <script src="GotchaGame.js"></script>
</html>


