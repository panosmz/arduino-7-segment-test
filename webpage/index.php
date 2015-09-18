<?php include "base.php" ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<!--
Displays a message on the connected arduino.
©2015 Panos Mazarakis 
Open-source - released under GNU Licence.
https://github.com/panosmz/arduinoledtest
-->
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title>Arduino_App</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="style.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
        <script src="js/arduinoapp.min.js"></script>
    </head>
    <body>
            <?php
            $self = $_SERVER['PHP_SELF'];
            $ipaddress = ("$_SERVER[REMOTE_ADDR]");

            $connect = mysql_connect($dbhost,$dbuser,$dbpass) or die ('Unable to connect to the database server at this time.');
            mysql_select_db($dbname,$connect) or die ('Unable to connect to the database server at this time.');
            session_start();

            include('post.php');

            ?>

        <div id="app">
            <header>
                <div id="header-left">
                    <h1><a href="http://83.212.118.5:86/">Arduino_App</a></h1>
                    <p>A simple app, that displays the submitted text to a connected Arduino UNO.</p>
                </div>
                <div id="header-right">
                <?php
                if(!empty($_SESSION['LoggedIn']) && !empty($_SESSION['Username']))
                {
                    ?>

                    <ul><li>Logged in as <code><?=$_SESSION['Username']?></code>. <a href="logout.php">Logout</a></li></ul>

                    <?php
                }
                else
                {
                    ?>
                    <ul>
                        <li><a href="login.php">Login</a></li>
                        <li><a href="register.php">Register</a></li>
                    </ul>

                    <?php
                }  
                ?>
                </div>
            </header>

            <div id="current-prev">The message being displayed is:</div>
            <?php 
            $query = "SELECT * FROM shouts ORDER BY id DESC";
            $result = @mysql_query("$query") or die ('error1');

            $row = mysql_fetch_array($result);
            $epost = stripslashes($row['post']);

            echo('<div id="current-mess"><p>'.$epost.'</p></div>');

            ?>
            
            <div id="current-text">____</div>

            <div id="submit-text">Submit text here:</div>
            <div id="shout-app">
            <div id="submit-form">
            <form action="<?php $self ?>" method="post">
                <input type="text" id="input-text" name="post" size="40" maxlength="15"></input>
                <div id="remaining-char" style="color: gray;">0/15</div>
                <input type="submit" name="Send" value="Send" />
             </form>
             <div id="shouts">
             <?php 
                    $query = "SELECT shouts.id, users.Username, shouts.post, shouts.time FROM shouts INNER JOIN users ON shouts.user=users.UserID ORDER BY id DESC";
                    $result = @mysql_query("$query") or die ('errorsql');

                    while($row = mysql_fetch_array($result)) {
                        $name = stripslashes($row['Username']);
                        $post = stripslashes($row['post']);
                        $posttime = stripcslashes($row['time']);

                        echo ('<div class="shout-post-container"><p class="shout-name">'.$name.' says: </p><p class="shout-post">'.$post.'</p>
                               <p class="shout-time">'.$posttime.'</p></div>');
                    }

             ?>
             </div>
             </div>
             </div>

            <footer>
                <p>© Panos Mazarakis 2015. Open-source - released under GNU Licence. <a href="https://github.com/panosmz/arduinoledtest">View on GitHub</a>.</p>
            </footer>
        </div>
    </body>
</html>
