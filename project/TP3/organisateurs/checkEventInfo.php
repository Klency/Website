<?php
            $link = mysql_connect("mysql.iro.umontreal.ca" , "bressonm", "8ThkbsxR5b8ffZ")
                        or die("Connexion failed<br/>");
            mysql_select_db("bressonm_TP3")
                        or die(" cette base de donn&eacute;es n'existe pas<br/>");
            session_start();
            if ($_SESSION['name']=='') {
               header( 'location:../LoginPage.php' );
               echo "Vous devez etre connect&eacute;";
            }else{
                 $date = $_POST['date'];
                 $plages = array();
                foreach($_POST['selection'] as $value) 
                {               
                    $plages[] = $value;
                }
                if($plages[0]==""){
                    echo" <form method='post' action='eventInfo.php' id='redirect_form'>";
                    foreach ($_POST as $a => $b) {
                        echo "<input type='hidden' name='".htmlentities($a)."' value='".htmlentities($b)."'>";
                    };
                    echo "<input type='hidden' name='error' value='Vous devez rentrer une date'>
                    </form>
                    <script type='text/javascript'>
                        document.getElementById('redirect_form').submit();
                    </script>";  
                }else{
                   
                   $defaultPlage = str_repeat("a",count($plages));
                   $eventName = $_SESSION["tempEventName"];
                   $confidentialite = $_SESSION['tempEventConfidentialite'];
                   $participants = $_SESSION['tempEventParticipants'];
                   $organisateur = $_SESSION['name'];
                   
                   $query = mysql_query("select MAX(id) from Event");
                   $result = mysql_fetch_array($query);
                   $id = $result['MAX(id)'] +1;
                 
                   mysql_query("insert into Event (id, Name, Org, ConfLvl) values ('".$id."','".$eventName."','".$organisateur."','".$confidentialite."')") or die(mysql_error());
                   foreach($participants as $participant){
                        mysql_query("insert into EventParticipant values (".$id.",'".$participant."', '".$defaultPlage."')") or die(mysql_error());
                   }
                   
                   foreach($plages as $plage){
                        list($date, $debut, $fin)= split("&", $plage);
                        mysql_query("insert into EventPlage values (".$id.",'".$date."', '".$debut."', '".$fin."')") or die(mysql_error());
                   }
            
                   echo "<form method='post' action='newEvent.php' id='redirect_form'>
                   <input type='hidden' name='eventAdded' value='Votre &eacute;v&eacute;nement a &eacute;t&eacute; ajout&eacute; avec succ&egrave;s'>
                   </form>
                   <script type='text/javascript'>
                      document.getElementById('redirect_form').submit();
                   </script>"; 
                }
            }
            
        ?>  