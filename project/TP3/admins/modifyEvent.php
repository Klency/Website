<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
                      "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title>newEvent</title>
        <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.3/themes/smoothness/jquery-ui.css" />
        <link href='http://fonts.googleapis.com/css?family=Lora' rel='stylesheet' type='text/css'>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js" type="text/javascript"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.3/jquery-ui.min.js" type="text/javascript"></script>
        <script src="../js/eventInfo.js" type="text/javascript"></script>
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
        
          list($eventName, $id) = split('/',(isset($_POST['eventName']))?$_POST['eventName']:NULL);
        ?>
        <p><h1>Modification</h1></p>
        
        <div>
            <form action="confirmModify.php" method="post">      
              <table width="400" border="0" cellspacing="2" cellpadding="0">
                 <?php if($_POST['errorP']!="")echo "<tr> <small id='error'>".$_POST['error']."</small></tr>"?>
                 <tr>
                    <td>Nom de l'&eacute;v&eacute;nement : </td>
                    <?php 
                        echo "<td><input  type='text' name='eventName' value='".$eventName."'/></td>
                            <td><input  type='hidden' name='id' value='$id'/></td>";
                    ?>
                    
                 </tr>
                    <td>Niveau de confidentialit&eacute;: </td>
                    <td>
                        <select name="confidentialite">
                          <option value="public">Public</option>
                          <option value="confidentiel">Confidentiel</option>
                        </select>
                    </td>    
                 <tr> 
                     <td>Participants : </td>
                        <td>
                            <select id="participants" name="participants[]" type="select-multiple" multiple>
                                <?php
                                     
                                     $memberList = array();
                                     $info = mysql_query("select * from Member;");
                                     $nbMember = mysql_num_rows($info);
                                     if($nbMember>0){
                                         while($row = mysql_fetch_assoc($info)) {
                                             if(ucwords(strtolower($row["User"])) != $_SESSION['name'])$memberList[] = $row["User"];
                                         }
                                     }
                                     foreach ($memberList as $participant) {
                                         echo "<option value='$participant'>".ucwords(strtolower($participant))."</option>"; 
                                    }
                                 ?>
                            </select>
                        </td>
                 </tr>  
              </table>
             <br/>
             <br/>
             <p>Attention, faire une modifications &agrave;	vos plages horaires entrainera une r&eacute;initialisation de celles-ci</p>
             
            <table width="400" border="0" cellspacing="2" cellpadding="2">
                  <?php 
                  if($_POST['errorD']!="")echo "<tr> <small id='error'>".$_POST['errorD']."</small></tr>";
                  
                  ?>
                 <tr>
                    <td>Date</td>
                    <td><input type="text" name="date" value="" id="datepicker"/></td>
                 </tr>
                 <tr>
                    <td>Heure de d&eacute;but</td>
                    <td>  
                      <select name="debut" id="debut">
                         <option>0:00</option>
                         <option>1:00</option>
                         <option>2:00</option>
                         <option>3:00</option>
                         <option>4:00</option>
                         <option>5:00</option>
                         <option>6:00</option>
                         <option>7:00</option>
                         <option>8:00</option>
                         <option>9:00</option>
                         <option>10:00</option>
                         <option>11:00</option>
                         <option selected="selected">12:00</option>
                         <option>13:00</option>
                         <option>14:00</option>
                         <option>15:00</option>
                         <option>16:00</option>
                         <option>17:00</option>
                         <option>18:00</option>
                         <option>19:00</option>
                         <option>20:00</option>
                         <option>21:00</option>
                         <option>22:00</option>
                         <option>23:00</option>
                       </select>
                     </td>
                     <td rowspan='2'><button id="ajout" type="button">Ajouter plage horaire</button></td>
                 </tr>
                  <tr>
                    <td>Heure de fin</td>
                    <td>  
                      <select name="fin" id="fin">
                         <option>0:00</option>
                         <option>1:00</option>
                         <option>2:00</option>
                         <option>3:00</option>
                         <option>4:00</option>
                         <option>5:00</option>
                         <option>6:00</option>
                         <option>7:00</option>
                         <option>8:00</option>
                         <option>9:00</option>
                         <option>10:00</option>
                         <option>11:00</option>
                         <option selected="selected">12:00</option>
                         <option>13:00</option>
                         <option>14:00</option>
                         <option>15:00</option>
                         <option>16:00</option>
                         <option>17:00</option>
                         <option>18:00</option>
                         <option>19:00</option>
                         <option>20:00</option>
                         <option>21:00</option>
                         <option>22:00</option>
                         <option>23:00</option>
                       </select>
                     </td>
                 </tr>
                 <tr>
                    <td>Plages horaire s&eacute;lectionn&eacute;es</td>
                    <td>  
                      <select name="selection[]" id="selection" type="select-multiple" multiple>
                      <?php
                            $plageList = array();
                            $valeurList = array();
                            $info = mysql_query("select * from EventPlage where(id=".$id.");");
                            $nbPlage = mysql_num_rows($info);
                            if($nbPlage>0){
                                while($row = mysql_fetch_assoc($info)) {
                                    $date = $row["Date"];
                                    $debut = $row["Debut"];
                                    $fin = $row["Fin"];
                                    $valeur = $date."&".$debut."&".$fin;
                                    $plage = $date." : ".$debut." - ".$fin;
                                    $plageList[] = $plage; 
                                    $valeurList[] = $valeur;
                                }
                            }
                            foreach ($valeurList as $index=>$valeur) {
                                echo "<option value='$valeur'>".$plageList[$index]."</option>"; 
                            }
                      ?>
                      </select>
                     </td>
                     <td><button id="supprimer" type="button">Supprimer plage(s) horaire(s)</button></td>
                 </tr>
               </tr>
              </table>
              <tr>
                <td><input type="submit" name="confirmEvent" value="Confirmer" onclick="selectAll()" /></td>
              </tr>
            </form>  
            <br/>
            <form action="eventView.php" method="post">
                    <?php
                    echo " <input type='hidden' value='$eventName/$id' name='eventName' />";
                    ?>
                    <input type='submit' value='Retour' name='Retour' />
            </form>
        </div> 
        
     </body>
</html>