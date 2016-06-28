<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
                      "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title>eventChoice</title>
        <link href='http://fonts.googleapis.com/css?family=Lora' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" type="text/css" href="../css/style.css">
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
                <li><a href='../organisateurs/organisation.php'>Organisation</a></li>
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
            <li><a href='../organisateurs/organisation.php'>Organisation</a></li>
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
            <form action="viewEvents.php" method="post">      
              <table width="500" border="0" cellspacing="2" cellpadding="0">
                 <tr>
                    <td>S&eacute;lectionnez un &eacute;v&eacute;nement: </td>
                    <td>
                        <select name="eventName" id="eventName">
                            <?php
                                $eventList = array();
                                $idEventList = array();
                                $info = mysql_query("select * from Event where (Org='".($_SESSION['name'])."');");
                                $nbEvent = mysql_num_rows($info);
                                if($nbEvent>0){
                                      while($row = mysql_fetch_assoc($info)) {
                                          $eventList[] = $row['Name'];
                                          $idEventList[] = $row['id'];
                                      }
                                }else{
                                    echo "<option value='../../error'>Vous n&rsquo;avez organis&eacute; aucun &eacute;v&eacute;nement</option>"; 
                                }
                                foreach ($eventList as $index=>$event) {
                                    echo "<option value='$event/".$idEventList[$index]."'>$event</option>"; 
                                }
                            ?>
                        </select>
                    </td>    
                 </tr>
                 <tr>
                   <td><input type="submit" name="confirmEventName" value="OK"/></td>
                 </tr>
              </table>
            </form>  
        </div>
    </body>
</html>