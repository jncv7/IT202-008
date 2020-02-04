<?php
  
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require("config.php");
echo "DBUser: " .  $dbuser;
echo "\n\r";

$connection_string = "mysql:host=$dbhost;dbname=$dbdatabase;charset=utf8mb4";
echo time() . " "; // this is to show the time

try {
  
  $timeMade = time();
  $newTime = time();
  
  
  $db = new PDO($connection_string, $dbuser, $dbpass);
	echo "Should have connected";
	$stmt = $db->prepare("CREATE TABLE IF NOT EXISTS `USER` (
				`id` int auto_increment not null,
				`email` varchar(100) unique,
        `password` varchar (60) not null,
        `created time` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        `modi_time` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
				PRIMARY KEY (`id`)
				) CHARACTER SET utf8 COLLATE utf8_general_ci"
			);
      
	$stmt->execute();
   echo "<pre>" . var_export($stmt->errorInfo(), true) . "</pre>";

}
catch (Exception $e){

  echo $e->getMessage();
	exit("It didn't work");

}


?>