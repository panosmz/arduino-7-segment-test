<?php include "base.php"; ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<!--
Displays a message on the connected arduino.
©2015 Panos Mazarakis 
Open-source - released under GNU Licence.
https://github.com/panosmz/arduinoledtest
-->
<html xmlns="http://www.w3.org/1999/xhtml">  
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />  
 
<title>Arduino_App | Register</title>
<link rel="stylesheet" href="style.css"/>
</head>  
<body>  
<div id="register">
<?php
include ('base.php');

            $connect = mysql_connect($dbhost,$dbuser,$dbpass) or die ('Unable to connect to the database server at this time.');
            mysql_select_db($dbname,$connect) or die ('Unable to connect to the database server at this time.');
session_start();
if(!empty($_POST['username']) && !empty($_POST['password']))
{
    $username = mysql_real_escape_string($_POST['username']);
    $password = md5(mysql_real_escape_string($_POST['password']));
     
     $checkusername = mysql_query("SELECT * FROM users WHERE Username = '".$username."'");
      
     if(mysql_num_rows($checkusername) == 1)
     {
        echo "<h1>Error</h1>";
        echo "<p>Sorry, that username is taken. Please <a href=\"register.php\">try again</a>.</p>";
     }
     else
     {
        $registerquery = mysql_query("INSERT INTO users (Username, Password) VALUES('".$username."', '".$password."')");
        if($registerquery)
        {
            echo "<h1>Success</h1>";
            echo "<p>Your account was successfully created.</p>";
            echo "<meta http-equiv='refresh' content='=2;index.php' />";
        }
        else
        {
            echo "<h1>Error</h1>";
            echo "<p>Sorry, your registration failed. Please <a href=\"register.php\">try again</a>.</p>";    
        }       
     }
}
else
{
    ?>
     
   <h1>Register</h1>
     
   <p>Please enter your details below to register.</p>
     
    <form method="post" action="register.php" name="registerform" id="registerform">
    <fieldset>
        <label for="username">Username:</label><input type="text" name="username" id="username" /><br />
        <label for="password">Password:</label><input type="password" name="password" id="password" /><br />
        <input type="submit" name="register" id="registerButton" value="Register" />
    </fieldset>
    </form>
     
    <?php
}
?>
 
</div>
</body>
</html>