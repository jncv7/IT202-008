<?php


/**The goal is to create a table in the servers 
 * where you will have the following inputs
 * 1. Will have a user name
 * 2. will have a password
 * 3. will have a clan name
 * 4. will have an id number
 */


ini_set ('display_errors',1);
error_reporting(E_ALL);
// gives what is needed to log into the servers
require ("config.php");

$connection_string = "mysql:host=$dbhost;dbname=$dbdatabase;charset=utf8mb4";

try {
    // create the new db
    $db = new PDO ($connection_string, $dbuser, $dbpass);
    $stmt = $db-> prepare ("CREATE TABLE IF NOT EXISTS `ProjectAlpha`
    (
        `id` int auto_increment not null,
        `username` varchar (30) not null unique,
        `clan` varchar (15) not null unique,
        `password` varchar (60) not null
    )");

    // executing the newly made command
    $stmt-> execute ();

    
    
} catch (Exeception $e) {
    
}

?>