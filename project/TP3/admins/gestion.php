<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
                      "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title>TP3</title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js" type="text/javascript"></script>
        <link href='http://fonts.googleapis.com/css?family=Lora' rel='stylesheet' type='text/css'>
        <script src="../js/session.js" type="text/javascript"></script>
        <link href="../css/style.css" rel="stylesheet"></link>
    </head>
    <body>
        <img src="../img/DoodleUdem.png" alt="DoodleUdeM">
        <?php 
        session_start();
        if ($_SESSION['name']=='') {
           header( "refresh:1;url=../LoginPage.php" );
           echo "Vous devez etre connect&eacute;";
        }
        else{
            if($_SESSION['name']=='Admin'){
                 echo"<div id='menu'>
                <ul id='onglets'>
                <li><a href='accueil.php'>Accueil</a></li>
                <li><a href='../participants/participation.php'>Participation</a></li>
                <li><a href='../organisateurs/organisation.php'>Organisation</a></li>
                <li><a>Gestion</a></li>
                <li><a href='../LoginPage.php'>Se d&eacute;connecter</a></li>
                </ul>
                </div>";
                
           }
           else{
                $previousPage = $_SERVER["HTTP_REFERER"] ;
                header( "Location: $previousPage" );
            }
            $link = mysql_connect("mysql.iro.umontreal.ca" , "bressonm", "8ThkbsxR5b8ffZ")
                        or die("Connexion failed<br/>");
            mysql_select_db("bressonm_TP3")
                        or die(" cette base de donn&eacute;es n'existe pas<br/>");
            echo "<p>Liste des membres</p>";
            $memberList = mysql_query("select * from Member;");
            $nbMember = mysql_num_rows($memberList);
            if($nbMember>0){
                while($row = mysql_fetch_assoc($memberList)) {
                    echo "Nom: ".ucwords(strtolower($row["User"]))."<br>";
                }
            }
          }         
        ?>
        <br/>
        <div>
            <form action="eventView.php" method="post">      
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
                                $info = mysql_query("select e.id, e.name, e.ConfLvl from  Event as e");
                                $nbEvent = mysql_num_rows($info);
                                
                                if($nbEvent>0){
                                      while($row = mysql_fetch_assoc($info)) {
                                          $idEventList[] = $row['id'];
                                          $eventList[] = $row['name'];
                                          $confEventList[] = $row['ConfLvl'];
                                      }
                                }else{
                                    echo "<option value='../../../error'>Il n&rsquo;y a aucun &eacute;v&eacute;nement organis&eacute;</option>"; 
                                }
                                foreach ($eventList as $index=>$event) {
                                    echo "<option value='$event/".$idEventList[$index]."/".$confEventList[$index]."'>$event</option>"; 
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
