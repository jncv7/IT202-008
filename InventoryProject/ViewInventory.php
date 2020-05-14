<?php
// this page will display the users inventory
session_start();


echo "<table style='border: solid 1px black;'>";
echo "<tr><th>Id</th><th>Firstname</th><th>Lastname</th></tr>";

class TableRows extends RecursiveIteratorIterator {
    function __construct($it) {
        parent::__construct($it, self::LEAVES_ONLY);
    }

    function current() {
        return "<td style='width: 150px; border: 1px solid black;'>" . parent::current(). "</td>";
    }

    function beginChildren() {
        echo "<tr>";
    }

    function endChildren() {
        echo "</tr>" . "\n";
    }
}


require("config.php");
$connection_string = "mysql:host=$dbhost;dbname=$dbdatabase;charset=utf8mb4";

try {
    $db = new PDO($connection_string, $dbuser, $dbpass); // connect to the blasted DB again

// i need to get into global inventory
// i need to look for all the items that belong to the user

$owner = $_SESSION['user']; // get the user name from the player
echo "hello " . "$owner";
//$owner = "test12345";
// look for all the items that belong to them and organize them by Item Value
//$search = "SELECT * FROM `GlobalINV` WHERE `ItemOwner` = '$owner' ORDER BY `ItemValue` DESC";
$look->prepare("
SELECT * FROM `GlobalINV` WHERE `ItemOwner` = '$owner' 
ORDER BY `ItemValue` DESC
");
$look->execute();

//$result = $look->fetch(PDO::FETCH_ASSOC);
$result = $look->setFetchMode(PDO::FETCH_ASSOC);

    foreach(new TableRows(new RecursiveArrayIterator($look->fetchAll())) as $k=>$v) {
        echo $v;
    }
//echo "<pre>" . var_export($result, true) . "</pre>";
//echo "<pre>" . var_export ($result, true) . "</pre>";

} catch (Exception $e) {
    echo $e->getMessage();
    exit();
}


// i need to display all those items




?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="">
    </head>
    <body>
        <!--[if lt IE 7]>
            <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="#">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
        
        <script src="" async defer></script>
    </body>
</html>