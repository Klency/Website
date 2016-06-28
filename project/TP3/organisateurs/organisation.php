<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
                      "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title>organisation</title>
        <link rel="stylesheet" type="text/css" href="../css/style.css">
        <link href='http://fonts.googleapis.com/css?family=Lora' rel='stylesheet' type='text/css'>
    </head>
    <body>
        <img src="../img/DoodleUdem.png" alt="some_text">
        <?php 
        session_start();
        if ($_SESSION['name']=='') {
           header( 'location:../LoginPage.php' );
           echo "Vous devez etre connect&eacute;";
        }
        else{
           if($_SESSION['name']=='Admin'){
                 echo"<div id='menu'>
                <ul id='onglets'>
                <li><a href='../accueil.php'>Accueil</a></li>
                <li><a href='../participants/participation.php'>Participation</a></li>
                <li><a>Organisation</a></li>
                <li><a href='../admins/gestion.php'>Gestion</a></li>
                <li><a href='../LoginPage.php'>Se d&eacute;connecter</a></li>
                </ul>
                </div>";
                
           }
           else{
            echo"<div id='menu'>
            <ul id='onglets'>
            <li><a href='../accueil.php'>Accueil</a></li>
            <li><a href='../participants/participation.php'>Participation</a></li>
            <li><a>Organisation</a></li>
            <li><a href='../LoginPage.php'>Se d&eacute;connecter</a></li>
            </ul>
            </div>";
            }
            $link = mysql_connect("mysql.iro.umontreal.ca" , "bressonm", "8ThkbsxR5b8ffZ")
                        or die("Connexion failed<br/>");
            mysql_select_db("bressonm_TP3")
                        or die(" cette base de donn&eacute;es n'existe pas<br/>");
            
        }
        
        ?>
        <div>
            <table class='center'>
                <tr>
                    <td>
                        <form action="newEvent.php" method="get">
                            <input type="submit" value="Nouvel &eacute;v&eacute;nement" name="newEvent" />
                        </form>
                    </td>
                    <td>
                        <form action="eventChoice.php" method="get">
                            <input type="submit" value="Voir &eacute;v&eacute;nements existants" name="eventChoice" />
                        </form>
                    </td>
                </tr> 
            </table>
        </div>
    </body>
</html>