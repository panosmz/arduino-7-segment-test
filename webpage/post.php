<!--
Displays a message on the connected arduino.
©2015 Panos Mazarakis 
Open-source - released under GNU Licence.
https://github.com/panosmz/arduinoledtest
-->
<?php       

            $unaccepted_words = array("α","β","γ","δ","ε","ζ","η","θ","ι","κ","λ","μ","ν","ξ","ο","π","ρ","σ","τ","υ","φ","χ","ψ","ω","ά","έ","ή","ί","ό","ύ","ώ","Α","Β",
                "Γ","Δ","Ε","Ζ","Η","Θ","Ι","Κ","Λ","Μ","Ν","Ξ","Ο","Π","Ρ","Σ","Τ","Υ","Φ","Χ","Ψ","Ω","Ά","Έ","Ή","Ί","Ό","Ύ","Ώ");

            if(isset($_POST['Send'])) {
                if(empty($_SESSION['Username'])) {
                    echo('<p class="error">You must login to post.</p>');
                } elseif (empty($_POST['post'])) {
                    echo('<p class="error">You didn\'t write anything.</p>');
                } else {
                    $name = htmlspecialchars(mysql_real_escape_string($_SESSION['Username'])); 
                    $post = htmlspecialchars(mysql_real_escape_string($_POST['post']));

                    if(!contains($post,$unaccepted_words)) {
                        $sql = "SELECT * FROM users WHERE Username='".$name."'";
                        $result = @mysql_query("$sql") or die ('error_name_not_found');

                        $row = mysql_fetch_array($result);
                        $usrid = stripslashes($row['UserID']);

                        $sql = "INSERT INTO shouts SET user='$usrid', post='$post', ipaddress='$ipaddress', time=CURRENT_TIMESTAMP";
                         
                            if (@mysql_query($sql)) {
                                echo('<p class="error success">Post successful!</p>');
                            } else {
                                echo('<p class="error">There was an unexpected error when submitting your post.</p>');
                            }
                        } else {
                            echo('<p class="error">Unaccepted message.</p>');
                        }
                }
            }


            function contains($str, array $arr)
            {
                foreach ($arr as $a) {
                    if (stripos($str,$a) !== false) return true;
                }
                return false;
            }

?>