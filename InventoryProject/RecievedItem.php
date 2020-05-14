<?php
session_start();
//echo "This is to test if we can change a JS value to a PHP value";
// echo "what you got was";
//echo "Number: ".$_GET['gotten']."<br>";
$_SESSION["RecentRoll"] = $_GET['gotten'];
$x = $_GET['gotten']; // this is the number that represents the rarity of an item
$tableName;
//$worth = $tableName;
/**
 * 1 is common
 * 2 is rare
 * 3 is SR
 * 4 is UR
 * 5 is SSR
 */

// make a new variable in session to store more recent item gotten from the player
if ($x == 1) {
    $tableName = "C";
   // echo "$worth";
    echo "You got a common Item";
    //echo "$worth";
} else if ($x == 2) {
    $tableName = "R";
    echo "you got a rare item";
} else if ($x == 3) {
    $tableName = "SR";
    echo "You got a Super rare item";
} else if ($x == 4) {
    $tableName = "UR";
    echo "You got an Ultra Rare Item";
} else if ($x == 5) {
    $tableName = "SSR";
    echo "YOU GOT A SUPER SUPER SUPER RARE ITEM";
}


require("config.php");
$connection_string = "mysql:host=$dbhost;dbname=$dbdatabase;charset=utf8mb4";

try {
    $db = new PDO($connection_string, $dbuser, $dbpass);
    // input the new username and the new hashed pass into the database
    // note the name of the database is dependant on the Item gotten and the player's inventory

    // -------------------------------------------------->
    // if the user doesnt have an inventory already,
    //make one now

   // $nameOfInv = $_SESSION['user'] . " INV";

   // $_SESSION['InventoryName'] = $nameOfInv;

   $owner = $_SESSION['user'];


    $itemAmt = 1;
    // find all the information of a item with the same worth
    $stmt = $db->prepare("
        SELECT * FROM `ItemDB` WHERE `Rarity` LIKE '$tableName'");
    $stmt->execute();

    // gets the found query and makes an array
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $ItemName = $result['Name']; // item name
    //echo "$ItemName";
    $ItemValue = $result['Value']; // item value
   // echo "$ItemValue";
    $ItemId = $result['ID']; // item's id
   // echo "$ItemId";

    /// ------------------>

    // now put that into the GlobalINV with the other needed Parameters
    // IT WORKS POGGERS

    // look to see if the user already has the item


        // if the user does not have this item, give it to them
        $putIn = $db->prepare("
        INSERT INTO `GlobalINV` 
        (`ItemName`, `ItemID`, `ItemValue`, `ItemAmount`, `ItemRarity`, `ItemOwner`, `ClubName`)
         VALUES 
         ('$ItemName', '$ItemId', '$ItemValue', '$itemAmt', '$tableName', '$owner','');
        ");
        $putIn->execute();




} catch (Exception $e) {
    echo $e->getMessage();
    exit();
}
?>