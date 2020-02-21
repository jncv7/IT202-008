<?php

// this is to check the data base

ini_set ('display_errors',1);

error_reporting (E_ALL);


// this will be hidden from github, but it will be visable to the admin aka you
require ("config.php");
echo "You have logged int!" . $dbuser;
echo "/n/r";

// this is to log into the db
$connection_string = "mysql:host=$dbhost;dbname=$dbdatabase;charset=utf8mb4";

try {

// this is to create the data base
    $db = new PDO($connection_string, $dbuser, $dbpass);
    echo "Should have connected";
    
    /**
     * This creates a table called catchingup
     * the id will be a int that counts up 
     * the user name will need to be a unique name in the table
     * the pin will be a 0 by defualt
     * the primary key is auto made
     */
	$stmt = $db->prepare("CREATE TABLE IF NOT EXISTS `CatchingUp` (
				`id` int auto_increment not null,
				`username` varchar(30) not null unique,
				`pin` int default 0,
				PRIMARY KEY (`id`)
				) CHARACTER SET utf8 COLLATE utf8_general_ci"
            );


    // and then execute the made stmt
    $stmt-> execute();

    //Now to put people into the table that was just made

    $stmt = $db-> prepare("INSERT INTO `CatchingUp`
                    (username,pin) VALUES
                    (:username, :pin)");
    
    $params = array(':username' => 'John_Doe',":pin" => 1234 );
    $stmt -> execute ($params);

    // This is being able to display what is in the table
    // to see what is in the database, you need to use a query

    echo "<br> This is using a Select Query <br>";
    $stmt = $db-> prepare("Select id, username FROM `CatchingUp`");
    $r = $stmt->execute();
    $results = $stmt->fetch (PDO::FETCH_ASSOC);
    
    // echo what you need to see the information
    echo "<pre>" . var_export($r, true) . "</pre>";
    echo "<pre>" . var_export ($results, true) . "</pre>";

    // this is updating via using a query
    echo "<br> this is updating one query <br>";
    $stmt = $db-> prepare ("UPDATE `CatchingUp` 
        set username = :username 
        Where id = :id");

    // we are changing the id of a user here and then 
    // displaying that change on the screen
    $r = $stmt-> execute (array (":username"=> 'John_Doe',  ":id"=> 41));
    
    echo "<pre>" . var_export($r, true) . "</pre>";
	echo "<pre>" . var_export($stmt->errorInfo(), true) . "</pre>";

    





            
} catch (Exception $e) {
    echo $e->getMessage();
    exit ("It did not work");
}

?>