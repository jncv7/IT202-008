  
<html>
	<head>
		<title>My Project - Register</title>
    <script>

    function findFormsOnLoad (){

      // now it is time to use the javascript knowlege

    let myForm = document.forms.regform;
    let mySameForm = document.getElementById ("myForm");
    console.log("Form by name", myForm);
    console.log("Form by id", mySameForm)

    }

    function verifyMyPass (form) {

      if (form.password.value != form.confirm.value) {
        alert ("They are not the same ... LUL")
        return false;
        
      }
      return true;
    }



    </script>
	</head>
	<body onload="findFormsOnLoad();">
		<!-- This is how you comment -->
   <!-- x -->
   <form name = "regForm" id = "myForm" method="POST"
                onsubmit = "return verifyMyPass (this)">
			<label for="email">Email: </label>
			<input type="email" id="email" name="email" placeholder="Enter Email"/>
			<label for="pass">Password: </label>
			<input type="password" id="pass" name="password" placeholder="Enter password"/>
			<label for="conf">Re Enter Pass: </label>
			<input type="password" id="conf" name="confirm"/>
			<input type="submit" value="Register"/>
      
		</form>
   
	</body>
</html>



<?php 


ini_set('display_errors',1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if(!empty($_REQUEST)){
	echo "Request:<pre>" . var_export($_REQUEST, true) . "</pre>";
}
if(!empty($_GET)){
	echo "GET:<pre>" . var_export($_GET, true) . "</pre>";
}
if(!empty($_POST)){
	echo "POST:<pre>" . var_export($_POST, true) . "</pre>";
}

if (isset ($_POST ['email']) 
    && ($_POST ['password'])
    && isset ($_POST ['confirm'])
    ){
    
    $pass = $_POST ['password'];
    $conf = $_POST ['confirm'];
    
    if ($pass = $conf){
      Echo "We are now registering the user";
      exit();
    }else {
      echo "There as been a problem. Sorry about that :( ";
      exit ();
    }

    // do some hashing to protect your files
    $pass = password_hash($pass, PASSWORD_BCRYPT);
    echo "<br> $pass <br>";

    
    // now, you have too do the config file stuff

    require("config.php");
    $connection_string = "mysql:host=$dbhost;dbname=$dbdatabase;charset=utf8mb4";
    
    try{
    
      $db = new PDO($connection_string, $dbuser, $dbpass);
    

      $stmt = $db->prepare("INSERT INTO `USER`
			(email, password) VALUES (:email, :password)");
      
      $email = $_POST['email'];

      $params = array (
        ":email"=> $email,
        ":password"=> $pass
      );
      
      $stmt-> execute($params);

      echo "<pre>" . var_export($stmt->errorInfo(), true) . "</pre>";
	
    
    }catch(Exception $e){
      echo $e->getMessage();
      exit ();
    
    }
   
  
    
}

?>