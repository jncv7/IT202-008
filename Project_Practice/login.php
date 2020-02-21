  
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

if (isset ($_POST ['email']) && ($_POST ['password'] && !empty ($_POST['password'])))
    {
    
    $pass = $_POST ['password'];
    $email = $_POST ['email'];
    
    // do some hashing to protect your files
   // $pass = password_hash($pass, PASSWORD_BCRYPT);
    //echo "<br> $pass <br>";

    
    // now, you have too do the config file stuff

    require("config.php");
    $connection_string = "mysql:host=$dbhost;dbname=$dbdatabase;charset=utf8mb4";
    
    try{
    
      $db = new PDO($connection_string, $dbuser, $dbpass);
        $stmt = $db->prepare("SELECT id, password from `USER` where email = :email LIMIT 1");


      $params = array (
        ":email"=> $email
      );
      
      $stmt-> execute($params);


      $result = $stmt-> fetch(PDO::FETCH_ASSOC);

      if ($result) {
          $userpassword = $result ['password'];
          // well you need some code here mateeeeeeeeeeeee

          if (password_verify($userpassword, $pass)) {
              echo "You are logged in!";
          }else {
              echo "You are not logged in!";
          }

      }else {
          echo "Failed to log in";
      }

      echo "<pre>" . var_export($stmt->errorInfo(), true) . "</pre>";
	
    
    }catch(Exception $e){
      echo $e->getMessage();
      exit ();
    
    }
   
  
    
}

?>