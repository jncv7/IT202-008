<?php
// this page will display the users inventory
session_start();
$check = $_SESSION['SignedIn'];
if ($check == 0) {
    header("Location: login.php");
}

include("header.html");

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
    $look = $db->prepare("
    SELECT * FROM `GlobalINV` WHERE `ItemOwner` = :o 
    ORDER BY `ItemValue` DESC
    ");
    $look->execute(array(':o' => $owner));
    $r = $look->fetchAll(PDO::FETCH_ASSOC); // fetchALL <<< gets everything


  //  echo "<pre>" . var_export($look->errorInfo(), true) . "</pre>"; // asking for sql errors
  //  echo "<pre>" . var_export ($r, true) . "</pre>";

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
<!--[if gt IE 8]><!-->
<html class="no-js">
<!--<![endif]-->

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
    <table width="50%">
        <tr>
            <td>Name</td>
            <td>ID</td>
            <td>Value</td>
            <td>Amount</td>
            <td>Rarity</td>
            <td>Owner</td>
            <td>Clubname</td>

        </tr>

        <?php foreach ($r as $col => $value) : ?>
            <div>
                <!--Anything in here will be repeated, so format it and the loop will allocate the data -->
                <?php
                    $ItemName = $value['ItemName'];
                    $ItemId = $value ['ItemID'];
                    $ItemValue = $value ['ItemValue'];
                    $ItemAmount = $value ['ItemAmount'];
                    $ItemR = $value ['ItemRarity'];
                    $ItemO = $value ['ItemOwner'];
                    $ItemC = $value ['ClubName'];


                    echo "
                    
                        <tr>
                            <th>'$ItemName</th>
                            <th>'$ItemId'</th>
                            <th>'$ItemValue'</th>
                            <th>'$ItemAmount'</th>
                            <th>'$ItemR'</th>
                            <th>'$ItemO'</th>
                            <th>'$ItemC'</th>
                        </tr>
                    
                    ";
                   // echo $col . " " . $value ['ItemName'];
                    //echo "        ";
                    //echo $col . " " . $value ['ItemID'];
                  //  echo "        ";
                  // echo $col . " " . $value ['ItemValue'];
                  //  echo "        ";
                  //  echo $col . " " . $value ['ItemAmount'];
                  //  echo "        ";
                  //  echo $col . " " . $value ['ItemRarity'];
                  //  echo "        ";
                  //  echo $col . " " . $value ['ItemOwner'];
                  //  echo "        ";
                  //  echo $col . " " . $value ['ClubName'];
                  //  echo "        ";

                ?>
            </div>
        <?php
        endforeach;
        ?>


    </table>

    <script src="" async defer></script>
</body>

</html>