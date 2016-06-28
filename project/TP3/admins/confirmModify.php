<?php
            $link = mysql_connect("mysql.iro.umontreal.ca" , "bressonm", "8ThkbsxR5b8ffZ")
                        or die("Connexion failed<br/>");
            mysql_select_db("bressonm_TP3")
                        or die(" cette base de donn&eacute;es n'existe pas<br/>");
            session_start();
           // list($eventName, $id) = split('/',(isset($_POST['eventName2']))?$_POST['eventName2']:NULL);
            $eventName = isset($_POST['eventName'])?$_POST['eventName']:NULL;
            $id = isset($_POST['id'])?$_POST['id']:NULL;
            if ($_SESSION['name']=='') {
               header( 'location:../LoginPage.php' );
               echo "Vous devez etre connect&eacute;";
            }else{
                $plages = array();
                foreach($_POST['selection'] as $value) 
                {               
                    $plages[] = $value;
                }
                if($plages[0]==""){
                    echo" <form method='post' action='modifyEvent.php' id='redirect_form'>";
                    
                    echo "<input type='hidden' name='errorD' value='Vous devez rentrer une date'>
                           <input type='hidden' name='eventName' value='$eventName/$id'>
                    </form>
                    <script type='text/javascript'>
                        document.getElementById('redirect_form').submit();
                    </script>";  
                }else{
                    $participants = array();
                    foreach($_POST['participants'] as $value) 
                    {               
                       
                        $participants[] = $value;
                    }
                    array_push($participants, ucwords(strtolower($_SESSION['name'])));
                    //$defaultPlage = str_repeat("a",count($plages));
                    $confidentialite = $_POST['confidentialite'];
                    $organisateur = $_SESSION['name'];
                    
                    $memberList = array();
                    $plageMembreList = array();
                    $info = mysql_query("select Part, Plage from EventParticipant where(id=$id);");
                    $nbMember = mysql_num_rows($info);
                    if($nbMember>0){
                        while($row = mysql_fetch_assoc($info)) {
                            $memberList[] = $row["Part"];
                            $plageMembreList[] = $row["Plage"];
                        }
                    }
                    
                    mysql_query("update Event set Name='".$eventName."', ConfLvl='".$confidentialite."' where (id=".$id.");")or die(mysql_error());
                    
                    
                    mysql_query("delete from EventPlage where (id=".$id.");");
                        foreach($plages as $plage){
                            list($date, $debut, $fin)= split("&", $plage);
                            mysql_query("insert into EventPlage values (".$id.",'".$date."', '".$debut."', '".$fin."')") or die(mysql_error());
                        }
                    
                    $infoPlageNumber = mysql_query("select * from EventPlage where(id=$id);");
                    $nbPlages = mysql_num_rows($infoPlageNumber);
                    $defaultPlage = str_repeat("a", $nbPlages);
                    
                    
                    mysql_query("delete from EventParticipant where (id=".$id.");");
                    foreach($participants as $index=>$participant){
                        
                        if(in_array($participant, $memberList)){
                            $indexPlage = array_search($participant, $memberList);
                            if(strlen($plageMembreList[$indexPlage])!=strlen($nbPlages)){
                                $plageMembreList[$indexPlage] = $defaultPlage;
                             }
                           
                           // if(strlen($plageMembreList[$indexPlage])<$nbPlages)$plageMembreList[$indexPlage] += str_repeat("a", $nbPlages-strlen($plageMembreList[$indexPlage]));
                           // else if(strlen($plageMembreList[$indexPlage])>$nbPlages)$plageMembreList[$indexPlage] = substr($plageMembreList[$indexPlage], 0, $nbPlages);
                         
                           mysql_query("insert into EventParticipant values (".$id.",'".$participant."', '".$plageMembreList[$indexPlage]."');") or die(mysql_error());
                       
                        }else{
                           // echo $participant."wasn't a membre so his plage is default : ".$defaultPlage."<br/>";
                           mysql_query("insert into EventParticipant values (".$id.",'".$participant."', '".$defaultPlage."')") or die(mysql_error());
                        
                        }
                    }
                    
                    
                   
                       
                    header("Location: gestion.php");
             }   
            }
            
?>  