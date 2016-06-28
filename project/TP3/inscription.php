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
        <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js" type="text/javascript"></script> -->
        <!-- <script src="tp3JS1.js" type="text/javascript"></script> -->
    </head>
    <body>
    <?php 
            session_start();
            if (session_status() != PHP_SESSION_NONE) {
                session_destroy();
            }
        ?>
        <img src="img/DoodleUdem.png" alt="some_text">
        <h1 >Page d&rsquo;inscription</h1>
        <br/>
        <h1 >Bienvenue sur notre syst&egrave;me d&#8217;organisation de r&eacute;unions</h1>
        <p>Pour vous inscrire, Veuillez vous rentrer pour vos informations</p>
        <?php 
            if($_POST['error'] != "")echo "<p id='error'>".$_POST['error']."</p>";
        ?>
        <p>Nom d'utilisateur</p> 
        <form action="checkInscription.php" method="post">
            <p><input name="username" type="text"/></p>
            <p>Mot de passe</p>
            <p><input name="password" type="password"/></p>
            <div><input type="submit" name="loginButton" value="S'inscrire"></input></div>
        </form>
        <br/>
        <form action="LoginPage.php" method="post">
            <div><input type="submit" name="loginButton" value="D&eacute;ja inscrit ?"></input></div>
        </form>
        <p id="failAlert"></p>
    </body>
</html>