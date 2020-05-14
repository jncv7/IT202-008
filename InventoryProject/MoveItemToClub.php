<?php

// move a users Item from their inventory to the Clubs inventory
session_start();
//variables go here

$check = $_SESSION['SignedIn'];
if ($check == 0) {
    header ("Location: login.php");
}

$user = $_SESSION['user'];
$targetClub = $_POST['clubname'];
$targetItem = $_POST['itemname'];


?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Move Item To Club Inventory</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="">
    </head>
    <body>
       <div id = "center Screen'">
       <h1>
            This is if you want to give your club or another club an Item
        </h1>

        <form name="ClubForm"  method="POST">

        <label for="Club Name">Club Name: </label>
        <input type="text" id = "clubname" name="clubname" placeholder="Target Club">

        <label for="ItemName">Name Of Item: </label>
        <input type="text" id = "itemname" name="itemname" placeholder="Target Item">

        <input type="submit" value="Join">
        

        </form>
       
       
       </div>
        <script src="" async defer></script>
    </body>
</html>