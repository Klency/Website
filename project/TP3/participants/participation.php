<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
                      "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title>selectEventChoice</title>
        <link href='http://fonts.googleapis.com/css?family=Lora' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" type="text/css" href="../css/style.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js" type="text/javascript"></script>
        <script src="../js/eventChoice.js" type="text/javascript"></script>
    </head>
    <body>
        <img src="../img/DoodleUdem.png" alt="some_text">
        <?php
            session_start();
                $link = mysql_connect("mysql.iro.umontreal.ca" , "bressonm", "8ThkbsxR5b8ffZ")or die("Connexion failed<br/>");
                mysql_select_db("bressonm_TP3") or die(" cette base de donn&eacute;es n'existe pas<br/>");
                
                if ($_SESSION['name']=='') {
                   header( "refresh:1;url=LoginPage.php" );
                   echo "Vous devez etre connect&eacute;";
                }
                else{
                   if($_SESSION['name']=='Admin'){
                         echo"<div id='menu'>
                        <ul id='onglets'>
                        <li><a href='../accueil.php'>Accueil</a></li>
                        <li><a>Participation</a></li>
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
                    <li><a>Participation</a></li>
                    <li><a href='../organisateurs/organisation.php'>Organisation</a></li>
                    <li><a href='../LoginPage.php'>Se d&eacute;connecter</a></li>
                    </ul>
                    </div>";
                    }
                }
                if($_POST['newChoice'] != "")echo "<p id='newChoice'>".$_POST['newChoice']."</p>";
        ?>
        <div>
            <form action="eventChoice.php" method="post">      
              <table width="400" border="0" cellspacing="2" cellpadding="0">
                 <tr>
                    <td>S&eacute;lectionez un &eacute;v&eacute;nement: </td>
                    <td>
                        <select name="eventName" id="eventName">
                            <?php
                                session_start();
                                $link = mysql_connect("mysql.iro.umontreal.ca" , "bressonm", "8ThkbsxR5b8ffZ") or die("Connexion failed<br/>");
                                mysql_select_db("bressonm_TP3") or die(" cette base de donn&eacute;es n'existe pas<br/>");
                                
                                $eventList = array();
                                $idEventList = array();
                                $confEventList = array();
                                $info = mysql_query("select ep.id, e.name, e.ConfLvl from EventParticipant as ep, Event as e where (Part='".$_SESSION['name']."' AND e.id=ep.id);");
                                $nbEvent = mysql_num_rows($info);
                                
                                if($nbEvent>0){
                                 $error = "googd";
                                      while($row = mysql_fetch_assoc($info)) {
                                          $idEventList[] = $row['id'];
                                          $eventList[] = $row['name'];
                                          $confEventList[] = $row['ConfLvl'];
                                      }
                                }else{
                                    echo "<option value='../../../error'>Vous n&rsquo;&ecirc;tes inscrits &agrave; aucun &eacute;v&eacute;nement</option>"; 
                                }
                                foreach ($eventList as $index=>$event) {
                                    echo "<option value='$event/".$idEventList[$index]."/".$confEventList[$index]."'>$event</option>"; 
                                }
                               
                            ?>
                        </select>
                    </td>    
                 </tr>
                 <tr>
                  <td><input type="submit" name="confirmEventName" value="OK" conclick=<?php echo "'validateMyForm(".$error.")' /></td>"; ?>
                 </tr>
              </table>
            </form>  
        </div>
    </body>
</html>