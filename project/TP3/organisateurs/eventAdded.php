<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
                      "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title>eventAdded</title>
        <link rel="stylesheet" type="text/css" href="../css/style.css">
        <link href='http://fonts.googleapis.com/css?family=Lora' rel='stylesheet' type='text/css'>
    </head>
    <body>
       
        <?php
            
            
            echo "<img src='../img/DoodleUdem.png' alt='some_text'>";
            echo "<p>L'&eacute;v&eacute;nement a &eacute;t&eacute; ajout&eacute;</p>";
            header(
            $plage = array();
            foreach($_POST['selection'] as $value) 
            {               
                $plage[] = $value;
            }
            print_r($plage);
            echo $plage[0];
            
        ?>        
    </body>
</html>