<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
                      "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title>eventChoice</title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js" type="text/javascript"></script>
        <link href='http://fonts.googleapis.com/css?family=Lora' rel='stylesheet' type='text/css'>
        <script src="../js/eventChoice.js" type="text/javascript"></script>
        <link rel="stylesheet" type="text/css" href="../css/style.css">
        <link rel="stylesheet" type="text/css" href="../css/tableau.css">
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
            }
            
            list($eventName, $id, $conf, $error) = split('/',(isset($_POST['eventName']))?$_POST['eventName']:NULL);
            if($error=="error"){
                header( 'location:participation.php' );
            }
            echo "<h1>$eventName</h1>"; 
            
        ?>
        <div>
        <form action="confirmChoice.php" method="post">  
        <?php 
                
                
                $_SESSION['eventId']=$id;
                $user = ucwords(strtolower($_SESSION['name'])); 
                
                $isUser = -1;  
                
                
                $plages = array();
               $info = mysql_query("select * from EventPlage where (id='".$id."');");
               $nbPlage = mysql_num_rows($info);
               if($nbPlage>0){
                    while($row = mysql_fetch_assoc($info)) {
                        $indexInDate = inDate($row['Date'], $plages);
                        if($indexInDate != -1){
                            array_push($plages[$indexInDate][1], $row['Debut']." &agrave; ".$row['Fin']);
                        }else{
                            $plages[] = array($row['Date'],array($row['Debut']." &agrave; ".$row['Fin']));
                        }
                    }
                }
              
                function inDate($d, $p){
                    $count = count($p); 
                    $return = -1;
                    for ($i = 0; $i < $count; $i++){
                        if($d == $p[$i][0]){
                            $return = $i; 
                        } 
                    }
                    return $return;
                };
               
                // -1 = pas de réponses 
                // 0 = pas dispo
                // 1 = dispo 
                $participants = array();
               $info = mysql_query("select * from EventParticipant where (id='".$id."');");
               $nbParticipant = mysql_num_rows($info);
               if($nbParticipant>0){
                    while($row = mysql_fetch_assoc($info)) {
                        $temp = str_split($row['Plage']);
                        if($conf !='public'){
                            if(ucwords(strtolower($row['Part'])) != $user){
                                $hiddenPlage = str_repeat("a",count($temp));
                                $hiddenPlageArray = str_split($hiddenPlage);
                                $participants[] = array("* * * * *",$temp);
                            }else{
                                $participants[] = array(ucwords(strtolower($row['Part'])),$temp);
                            }
                        }else{
                            $participants[] = array(ucwords(strtolower($row['Part'])),$temp);
                        }
                    }
                }
                
                echo '<table width="400" cellspacing="2" cellpadding="4">';
                
                echo '<tr><th rowspan="2"></th>';
                
                $count = count($plages); 
                for ($i = 0; $i< $count; $i++){
                    $colspan = count($plages[$i][1]);
                    $date = $plages[$i][0]; 
                    echo "<th colspan=$colspan class='date'>$date</th>";  
                }
                echo '</tr>';
                
                echo '<tr>'; 
                for ($i = 0; $i< $count; $i++){
                    $nPlages = count($plages[$i][1]);
                    for ($j = 0; $j < $nPlages; $j++){
                        $plage = $plages[$i][1][$j];
                        echo "<td class='plage'>$plage</td>"; 
                    }
                }
                echo '</tr>';
                $nCol = count($participants[0][1]);
                $nParticipants = count($participants);
                for ($i = 0; $i< $nParticipants; $i++){
                    $name = $participants[$i][0];
                    if (ucwords(strtolower($name)) != $user){ 
                        echo "<tr><td class='name'>$name</td>";
                        for ($j = 0; $j < $nCol; $j++){
                            $choice = $participants[$i][1][$j]; 
                            echo "<td class='$choice'></td>"; 
                        }
                        echo "</tr>";
                    }else{
                        $isUser = $i; 
                    } 
                }
                $noChoice = 0; 
                if ($participants[$isUser][1][0] == "a") $noChoice = 1; 
                 
                echo "<tr id='userChoice'><td class='name'>$user</td>";
                    for ($j = 0; $j < $nCol; $j++){
                        if ($noChoice == 1){
                            $choice = "n"; 
                        }else{
                            $choice = $participants[$isUser][1][$j];
                        }
                        echo "<td class='$choice'></td>"; 
                    }
                echo "</tr>";
                echo '</table>';
            ?>
            <!-- Contient un string binaire (1 = attendind, 0 = not attending) qui sera envoyé --> 
            <input type="hidden" id="confirmation" name="confirmation" value="">
            <input type="submit" name="confirmPlages" value="Confirmer"/>
         </form> 
         <br/>
            <form action="participation.php" method="get">
                   <input type="submit" value="retour" name="Retour" />
            </form>    
        </div>
    </body>
</html>