<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
                      "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title>newEvent</title>
        <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.3/themes/smoothness/jquery-ui.css" />
        <link href='http://fonts.googleapis.com/css?family=Lora' rel='stylesheet' type='text/css'>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js" type="text/javascript"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.3/jquery-ui.min.js" type="text/javascript"></script>
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
        
           if($_POST['eventAdded'] != "")echo "<p id='eventAdded'>".$_POST['eventAdded']."</p>";
        ?>
        <p>
        Veuillez choisir un nom d'&eacute;v&eacute;nement. Par la suite, s&eacute;lectionner les participants dans la liste. Appuyez sur le boutton Ctrl (Windows) / Command (Mac) pour s&eacute;lectioner plusieurs participants.
        </p>
        
        <div>
            <form action="checkNewEvent.php" method="post">      
              <table width="400" border="0" cellspacing="2" cellpadding="0">
                 <?php if($_POST['error']!="")echo "<tr> <small id='error'>".$_POST['error']."</small></tr>"?>
                 <tr>
                    <td>Nom de l'&eacute;v&eacute;nement : </td>
                    <td><input  type="text" name="eventName" value=""/></td>
                    
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
                            <select id="participants" name="participants[]" multiple>
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
                 <tr>
                     <td><input type="submit" name="confirmBasicInfo" value="Confirmer"/></td>
                 </tr>
                 
              </table>
            </form> 
        </div> 
        
     </body>
</html>