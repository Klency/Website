
   <?php 
         session_start();
         if ($_SESSION['name']=='') {
               header( 'location:../LoginPage.php' );
               echo "Vous devez etre connect&eacute;";
            }else{
                $link = mysql_connect("mysql.iro.umontreal.ca" , "bressonm", "8ThkbsxR5b8ffZ")
                               or die("Connexion failed<br/>");
                   mysql_select_db("bressonm_TP3")
                               or die(" cette base de donn&eacute;es n'existe pas<br/>");
                               
               $eventName = (isset($_POST['eventName']))?$_POST['eventName']:NULL;
               $result = mysql_query("select * from Event where(Name ='".$eventName."');");
                 
               //Si le nom de l'evenement choisie est deja pris on retourne a la page precedente avec un post 'error'
               if(mysql_num_rows($result)!=0){
                 echo" <form method='post' action='newEvent.php' id='redirect_form'>";
                       foreach ($_POST as $a => $b) {
                           echo "<input type='hidden' name='".htmlentities($a)."' value='".htmlentities($b)."'>";
                       };
                      echo "<input type='hidden' name='error' value='Ce nom d&#039;&eacute;v&eacute;nement n&#039;est pas disponible'>
                     </form>
                     <script type='text/javascript'>
                         document.getElementById('redirect_form').submit();
                     </script>";   
                }else if($eventName==""){
                echo" <form method='post' action='newEvent.php' id='redirect_form'>
                     <input type='hidden' name='error' value='Vous devez rentrer un nom d&#039;&eacute;v&eacute;nement'>
                     </form>
                     <script type='text/javascript'>
                         document.getElementById('redirect_form').submit();
                     </script>";  
                }else{
                   //La page est verifier : On met dans des variable de session nos information:
                   
                    $participants = array();
                        foreach($_POST['participants'] as $value) 
                        {               
                            $participants[] = $value;
                        }
                       array_push($participants, $_SESSION['name']);
                       $_SESSION["tempEventName"]="$eventName";
                       $_SESSION['tempEventConfidentialite']=$_POST['confidentialite'];
                       $_SESSION['tempEventParticipants']=$participants; 
                 header( "Location: eventInfo.php" );
                }
            }
        ?>