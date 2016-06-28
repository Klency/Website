$(document).ready(function(){
   
   $("#loginButton").click(check);
   $("#username").keypress(function(e){
        var code = e.keyCode || e.which;
        if(code == 13) { //Enter keycode
          //Do something
          check();
        }
   });
   $("#password").keypress(function(e){
        var code = e.keyCode || e.which;
        if(code == 13) { //Enter keycode
          //Do something
          check();
        }
   });
});

function check(){
   var username = $("#username").val();
   var password = $("#password").val();
   if( username =='' || password ==''){
        $("#failAlert").text("Vous devez renter un nom d'utilisateur/mot de passe");
   }else{
        $("#failAlert").text("");
        $.post("connexion.php", { username : username, password : password},
        function(isMember) {
            
            if(isMember == "0"){
                $("#failAlert").text("bienvenu "+username);
                $("#loginButtonload").load('session.php');
            }
            
            else if(isMember == "1"){
                 $("#failAlert").text("mauvais mot de passe");
            }
            
            else if(isMember == "2"){
                 $("#failAlert").text("mauvais username");
            }
            
            else{
                $("#failAlert").text("Erreur");
            }
        });
   }
}