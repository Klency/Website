<?php 
        session_start();
        if ($_SESSION['name']=='') {
           header( 'location:../LoginPage.php' );
           echo "Vous devez etre connect&eacute;";
        }
        else{
            $link = mysql_connect("mysql.iro.umontreal.ca" , "bressonm", "8ThkbsxR5b8ffZ")or die("Connexion failed<br/>");
            mysql_select_db("bressonm_TP3")or die(" cette base de donn&eacute;es n'existe pas<br/>");
            
            list($eventName, $id) = split('/',(isset($_POST['eventName']))?$_POST['eventName']:NULL);
            
            mysql_query("delete from Event where (id=".$id.");");
            mysql_query("delete from EventParticipant where (id=".$id.");");
            mysql_query("delete from EventPlage where (id=".$id.");");
          
           // header("Location : viewEvents.php");
            header( 'location:eventChoice.php' );
        }
        
?>