<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
                      "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title>confirmChoice</title>
        <link href='http://fonts.googleapis.com/css?family=Lora' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" type="text/css" href="../css/style.css">
    </head>
    <body>
        <p>
        <?php
           
            // Il va falloir parser le string recu (1 = attendind, 0 = not attending) et envoyer a la base de données 
            $link = mysql_connect("mysql.iro.umontreal.ca" , "bressonm", "8ThkbsxR5b8ffZ")
                        or die("Connexion failed<br/>");
            mysql_select_db("bressonm_TP3")
                        or die(" cette base de donn&eacute;es n'existe pas<br/>");
            
            session_start();
            $choices = (isset($_POST['confirmation']))?$_POST['confirmation']:NULL;
            $eventID = $_SESSION['eventId'];
            mysql_query("update EventParticipant set Plage = '".$choices."' where (id=".$eventID." AND Part='".$_SESSION['name']."');")or die(mysql_error());
            
            echo "<form method='post' action='participation.php' id='redirect_form'>
                   <input type='hidden' name='newChoice' value='Vos disponibilit&eacute;s ont &eacute;t&eacute; modifi&eacute;es avec succ&egrave;s'>
                   </form>
                   <script type='text/javascript'>
                      document.getElementById('redirect_form').submit();
                   </script>"; 
        ?>
        </p>
    </body>
</html>