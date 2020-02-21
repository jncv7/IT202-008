<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <script src = "regsFunc.js"></script>
        <link rel= "stylesheet" type ="text/css" media = "screen" href="regScreen.css">
        <title> Registration </title>
    </head>
    <body onload= "findFormsOnLoad();">

    <div id = "Header">
            <p>
                Account Creation <br>
                Please enter your desired Username and Password.
            </p>
    </div>

    <div id = "container">
            <div id = "form">

            <form name="regform" id="MyForm" method="POST" onsubmit = "return checkpassword(this)">   
                    <label for="username">Username: </label>
                    <input type="username" id="username" name="username" placeholder="Enter Username"/>
                    <label for="pass">Password: </label>
                    <input type="password" id="pass" name="password" placeholder="Enter password"/>
                    <label for="conf">Confirm Password: </label>
                    <input type="password" id="conf" name="confirm" placeholder="Enter password"/>
                    <input type="submit" value="Register"/>

                </form>
            </div>
    </div>    
    </body>
</html>

<?php
ini_set('display_errors',1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


// check if all the things by 'name' are filled
if 
(
    isset ($_POST['username']) &&
    isset ($_POST['password']) &&
    isset ($_POST['confirm'])
) {
    // get the passwords and make sure they are the same

    $pass = $_POST['password'];
    $conf = $_POST['confirm'];

    if ($pass == $conf) {
        echo "User is being registered!";

    }else {
        echo "Cannot register. Make sure everything is correct!";
        exit();
    }   

    // now hash the password
    $pass = password_hash ($pass, PASSWORD_BCRYPT);
   // echo "<br>$pass<br>";

    // now connect to the server and put it into the table
    require("config.php");
    $connection_string = "mysql:host=$dbhost;dbname=$dbdatabase;charset=utf8mb4";
    
    try {
        $db = new PDO($connection_string, $dbuser, $dbpass);
        // input the new username and the new hashed pass into the database
        // note the name of the database is ProjectsTable


        $stmt = $db->prepare 
        ("INSERT INTO `ProjectsTable`
            (username, pwrd) VALUES 
            (:username, :password)
        ");

        $username = $_POST['username'];

        $params = array(":username" => $username ,
                        ":password"=> $pass );

        $stmt->execute($params);
        echo " <br> User " . $username . " has been added to the system! <br>";


      //  echo "<pre>" . var_export($stmt->errorInfo(), true) . "</pre>";
        

        
    } catch (Exception $e) {
        echo $e->getMessage();
        exit();
    }
    



} 



?>