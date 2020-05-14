<?php
session_start();
//echo "This is to test if we can change a JS value to a PHP value";
// echo "what you got was";
//echo "Number: ".$_GET['gotten']."<br>";
$owner = $_SESSION['user'];
include("header.html");



$_SESSION["RecentRoll"] = $_GET['gotten'];
$x = $_GET['gotten']; // this is the number that represents the rarity of an item
$tableName;
$check = $_SESSION['SignedIn'];
if ($check == 0) {
    header ("Location: login.php");
}

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



    // ----------------------Look for the Item they just got----------------------------->

    
    // find all the information of a item with the same worth
    $stmt = $db->prepare("
        SELECT * FROM `ItemDB` WHERE `Rarity` = :tablename ");
    $stmt->execute(array(':tablename' => $tableName ));

    // gets the found query and makes an array
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $ItemName = $result['Name']; // item name
    //echo "$ItemName";
    $ItemValue = $result['Value']; // item value
   // echo "$ItemValue";
    $ItemId = $result['ID']; // item's id
   // echo "$ItemId";

    // -------------------------------------------------->
    // if the user doesnt have an inventory already,
    //make one now

    $stmt = $db->prepare("
        SELECT count(1) as Total FROM `GlobalINV` WHERE `ItemName`=:itemname AND `ItemOwner`=:itemowner "
    );
    $stmt->execute(array(':itemname' => $ItemName,':itemowner' => $owner ));

   $result = $stmt->fetch(PDO::FETCH_ASSOC);

    

    if($result){
        $count = $result['Total'];
        //echo "$count";
        if($count >= 1){// if the user has the item already
 
            // get the old amount and the test of the variables for the update
            $seeOne = $db->prepare("
            SELECT * FROM `GlobalINV` WHERE `ItemRarity` = :tableName AND `ItemOwner` = :itemowner 
            ");
            $seeOne->execute(array(':tableName' => $tableName,':itemowner'=> $owner));
            $r = $seeOne->fetch(PDO::FETCH_ASSOC);

            // ------------------> how to make queries grabbed into ints?
            echo var_export($r, true);
            $itemAmt = (int)($r['ItemAmount']);
           // echo "This is what the query sees $itemAmt";
            //echo gettype($itemAmt);
            $newAMT = 1 + (int)$itemAmt;
            echo "$newAMT";

            // use that amount value to set the new amount
            $addOne = $db->prepare("
            UPDATE `GlobalINV` SET `ItemAmount` = :amount Where `ItemRarity` = :tablename and ItemOwner = :itemO
            ");
            $addOne->execute(array(':tablename'=> $tableName, ':amount' => $newAMT, ':itemO'=> $owner));

        }else{
            
            // the user does not have the item
            $itemAmt = 1;
            
            $putIn = $db->prepare("
            INSERT INTO `GlobalINV` 
            (`ItemName`, `ItemID`, `ItemValue`, `ItemAmount`, `ItemRarity`, `ItemOwner`, `ClubName`)
             VALUES 
             ('$ItemName', '$ItemId', '$ItemValue', '$itemAmt', '$tableName', '$owner','');
            ");
            $putIn->execute();
            
            

        }
    }


   


 

    /// ------------------>

    // now put that into the GlobalINV with the other needed Parameters
    // IT WORKS POGGERS

    // look to see if the user already has the item


        // if the user does not have this item, give it to them
     //   $putIn = $db->prepare("
     //   INSERT INTO `GlobalINV` 
     //   (`ItemName`, `ItemID`, `ItemValue`, `ItemAmount`, `ItemRarity`, `ItemOwner`, `ClubName`)
      //   VALUES 
     //    ('$ItemName', '$ItemId', '$ItemValue', '$itemAmt', '$tableName', '$owner','');
     //   ");
     //   $putIn->execute();




} catch (Exception $e) {
    echo $e->getMessage();
    exit();
}
?>