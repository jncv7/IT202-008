<?php
 session_start();
// set ready to use those session varaiables BOI

$user = $_SESSION['user'];
// let the user Join a Club

// get club name from POST
$clubname = $_POST['clubname'];

// the user to a club (yes they can join multiple clubs)
require("config.php");
$connection_string = "mysql:host=$dbhost;dbname=$dbdatabase;charset=utf8mb4";
try {
    $db = new PDO($connection_string, $dbuser, $dbpass);

 //   $stmt->prepare(
 //       "SELECT * FROM `ClubAndMembers` WHERE `Club` LIKE '$clubname'"
 //   );
 //   $stmt->execute();
 //   if($stmt->rowCount() == 0){ // if nothing comes back
        // if the club doesnt exist give the person a warning or message
 //       echo "<script type = 'text/javascript'>
  //          alert ('This club doesn't exist!');
  //          </script>";
   // }else {
         // insert a new person into a club that already exist 
         $join->prepare("
         INSERT INTO `ClubAndMembers` (`Member`, `Club`) VALUES ('$user', '$clubname');
         ");
         $join->execute();
         echo "You Joined the club " . $clubname;  

   // }
    


   
    


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
        <title>Join a CLUB!</title>

    </head>
    <body>
        <!--[if lt IE 7]>
            <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="#">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->


        <p>
            This page is for if you want to join a club
        </p>
        <!-- Ask for what club they would like to join-->
        <form name="joinClub" method="POST">
            <label for="clubname">Club Name: </label>
            <input type="text" id="clubname" name="clubname" placeholder="Enter Desired Club to Join"/>
        </form>

        
        <script src="" async defer></script>
    </body>
</html>