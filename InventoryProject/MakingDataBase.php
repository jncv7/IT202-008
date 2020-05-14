<?php



// Making a new server for the project 

/**
 * This will have a the basics for now 
 * take in the username
 * password (will want this to be hashed)
 */

 // THE TABLE HAS BEEN MADE


require ("config.php");
$connection_string = "mysql:host=$dbhost;dbname=$dbdatabase;charset=utf8mb4";

try {
    $db = new PDO($connection_string, $dbuser, $dbpass); // login stuff
    echo "These is something here!";
    $stmt = $db->prepare("CREATE TABLE IF NOT EXISTS `ProjectsTable` 
        (
        `id` int auto_increment not null,
        `username` varchar(30) not null unique,
        `pwrd` varchar (200) not null,
        PRIMARY KEY (`id`)
        )
         CHARACTER SET utf8 COLLATE utf8_general_ci"
    );

    //remember to execute what you prepare!
    $stmt->execute();

    // input a user to test

    echo "<br> Testing adding a new user <br> ";

    $stmt = $db->prepare(
        "INSERT INTO `ProjectsTable`
			(username, pwrd) VALUES
            (:username, :pwrd)");
    $params = array(":username"=> 'noble01', ":pwrd" => 'test123');
    $stmt->execute($params);
    
    echo "<br> This is using a Select Query <br>";
    $stmt = $db-> prepare("Select username, pwrd FROM `ProjectsTable`");
    $r = $stmt->execute();
    $results = $stmt->fetch (PDO::FETCH_ASSOC);
    
    
    // echo what you need to see the information
    echo "<pre>" . var_export($r, true) . "</pre>";
    echo "<pre>" . var_export ($results, true) . "</pre>";




} catch (Exception $e) {
    echo $e->getMessage();
    echo "Something broke.";
    exit("It didn't work");
}



?>