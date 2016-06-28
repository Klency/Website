<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
                      "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title>TP3</title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js" type="text/javascript"></script>
        <link href='http://fonts.googleapis.com/css?family=Lora' rel='stylesheet' type='text/css'>
        <script src="js/session.js" type="text/javascript"></script>
        <link href="css/style.css" rel="stylesheet"></link>
    </head>
    <body>
        <?php 
        session_start();
        if ($_SESSION['name']=='') {
           header( 'location:LoginPage.php' );
           echo "test";
        }
        else{
        echo '<img src="img/DoodleUdem.png" alt="DoodleUdeM">';
           if($_SESSION['name']=='Admin'){
                 echo"<div id='menu'>
                <ul id='onglets'>
                <li><a>Accueil</a></li>
                <li><a href='participants/participation.php'>Participation</a></li>
                <li><a href='organisateurs/organisation.php'>Organisation</a></li>
                <li><a href='admins/gestion.php'>Gestion</a></li>
                <li><a href='LoginPage.php'>Se d&eacute;connecter</a></li>
                </ul>
                </div>";
                
           }
           else{
            echo"<div id='menu'>
            <ul id='onglets'>
            <li><a>Accueil</a></li>
            <li><a href='participants/participation.php'>Participation</a></li>
            <li><a href='organisateurs/organisation.php'>Organisation</a></li>
            <li><a href='LoginPage.php'>Se d&eacute;connecter</a></li>
            </ul>
            </div>";
            }
            
            echo"<div class='center'>
                <p>Bienvenue "; 
            echo $_SESSION['name'];
            echo "</p> 
                <p>DoodleUdeM vous permet de simplifier vos rencontres d'&eacute;quipes !</p>
                <img src='img/cal.png' alt='calendrier'> 
                <form action='organisateurs/newEvent.php'>
                    <input type='submit' name='event' value='Cr&eacute;er un &eacute;v&eacute;nement'></input>
                </form>
            </div>";  
        }
        ?>   
    </body>
</html>
