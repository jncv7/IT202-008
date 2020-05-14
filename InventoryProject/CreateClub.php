<?php

session_start();
include("header.html");

$check = $_SESSION['SignedIn'];
if ($check == 0) {
    header ("Location: login.php");
}

// put them into the tables for members and clubs
$clubname = $_POST['clubname']; // this works
$user=$_SESSION['user'];
echo " $clubname";

// now connect to the database, and input the user into that club
require("config.php");
    $connection_string = "mysql:host=$dbhost;dbname=$dbdatabase;charset=utf8mb4";
   try {
      $db = new PDO($connection_string, $dbuser, $dbpass);

       $stmt = $db->prepare("
       INSERT INTO `ClubAndMembers` (`Member`, `Club`) VALUES ('$user', '$clubname');
         ");
     $stmt->execute();
      // echo "Nice you joined " . "$clubname";

      
  } catch (Exception $e) {
       echo $e->getMessage();
        exit();
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
        <title>Create Your Own Club!</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="">
    </head>
    <body>
        <!--[if lt IE 7]>
            <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="#">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->

        <form name="newClub" method="POST">
            <label for="clubname">Club Name: </label>
            <input type="text" id="clubname" name="clubname" placeholder="Enter Name of Club"/>
            <p>
                Note: YOU WILL BE THE 1st MEMBER to Join the Club
            </p>

            <input type="submit" value="Create and Join">
        </form>
        
        <script src="" async defer></script>
    </body>
</html>