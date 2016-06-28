<?php 
    if (isset($_GET['source'])) { die(highlight_file(__FILE__, 1)); }
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
                      "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title>TP3</title>
        <link href='http://fonts.googleapis.com/css?family=Lora' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js" type="text/javascript"></script>
        <!-- <script src="tp3JS1.js" type="text/javascript"></script> -->
    </head>
    <body>
        <?php 
             
            $expected = array('username','password');
            foreach($expected as $name){
                $$name = (isset($_POST[$name]))?$_POST[$name]:NULL;
                //echo "test"; 
            }

            $server = 'localhost';
            $user = 'root';
            $pass = 'klency';
            $dbname = 'doodle';
           
                     
            $link = mysql_connect($server, $user, $pass) 
                        or die("Connexion failed<br/>");
            mysql_select_db($dbname)
                        or die(" cette base de données n'existe pas<br/>");
            $ADMIN = "admin";
            $result = mysql_query("select * from Member where(User = '".$username."');");
            $exist = mysql_num_rows($result);
            $val = mysql_fetch_array($result);
            $mdpVal = $val["password"];
            if($exist == 1){
                if($mdpVal == $password){
                    //echo "0";
                    echo "Bienvenue sur notre site"; 
                    session_start();
                    $_SESSION['name']=ucwords(strtolower($username));
                    header('Location: accueil.php');
                }
                else{
                    echo "<p>Mauvais mot de passe, veuillez <a href='LoginPage.php'>r&eacute;essayer</a></p>";                    
                }
            }
            else{
                    echo "<p>Username invalide, veuillez <a href='LoginPage.php'>r&eacute;essayer</a></p>"; 
            }
        ?>
    </body>
</html>