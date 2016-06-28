 <?php 
         session_start();
         // $link = mysql_connect("mysql.iro.umontreal.ca" , "bressonm", "8ThkbsxR5b8ffZ")or die("Connexion failed<br/>");
         // mysql_select_db("bressonm_TP3")or die(" cette base de donn&eacute;es n'existe pas<br/>");
          $server = 'localhost';
            $user = 'root';
            $pass = 'klency';
            $dbname = 'doodle';
           
                     
            $link = mysql_connect($server, $user, $pass) 
                        or die("Connexion failed<br/>");
            mysql_select_db($dbname)
                        or die(" cette base de données n'existe pas<br/>");
         $username = (isset($_POST['username']))?$_POST['username']:NULL;
         $password = (isset($_POST['password']))?$_POST['password']:NULL;
         $result = mysql_query("select User from Member where(User ='".$username."');");
         //Si le nom de l'evenement choisie est deja pris on retourne a la page precedente avec un post 'error'
         if(mysql_num_rows($result)!=0){
            echo" <form method='post' action='inscription.php' id='redirect_form'>";
            foreach ($_POST as $a => $b) {
                echo "<input type='hidden' name='".htmlentities($a)."' value='".htmlentities($b)."'>";
            };
            echo "<input type='hidden' name='error' value='Ce nom d&#039;utilisateur n&#039;est pas disponible'>
                  </form>
                  <script type='text/javascript'>
                      document.getElementById('redirect_form').submit();
                  </script>";   
          }else if($username==""){
                echo" <form method='post' action='inscription.php' id='redirect_form'>
                     <input type='hidden' name='error' value='Vous devez rentrer un nom d&#039;utilisateur'>
                     </form>
                     <script type='text/javascript'>
                         document.getElementById('redirect_form').submit();
                     </script>"; 
           }else if($password==""){
                echo" <form method='post' action='inscription.php' id='redirect_form'>
                     <input type='hidden' name='error' value='Vous devez rentrer un mot de passe'>
                     </form>
                     <script type='text/javascript'>
                         document.getElementById('redirect_form').submit();
                     </script>";   
          }else{
            
            echo "lol";
            mysql_query("insert into Member values ('".ucwords(strtolower($username))."', '".$password."');");
            $_SESSION['name']=ucwords(strtolower($username));
            header('Location: accueil.php');
                
                //La page est verifier : On met dans des variable de session nos information:
                /*$participants = array();
                foreach($_POST['participants'] as $value) {               
                    $participants[] = $value;
                }
                array_push($participants, $_SESSION['name']);
                $_SESSION["tempEventName"]="$eventName";
                $_SESSION['tempEventConfidentialite']=$_POST['confidentialite'];
                $_SESSION['tempEventParticipants']=$participants; 
                header( "Location: eventInfo.php" );*/
          }
            
        ?>