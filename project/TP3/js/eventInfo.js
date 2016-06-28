var plages = []; 
var value = 0; 

$(document).ready(function(){
    $(function() {
        $( "#datepicker" ).datepicker();
        $( "#datepicker" ).datepicker("option", "minDate", 0);
      });
      
      $( "#ajout").click(function(){
          var date = printDate(); 
          var debut = $( "#debut option:selected" ).text();
          var fin = $( "#fin option:selected" ).text();
          
          if(date == ""){
              $( "#error" ).text("Veuillez entrer une date"); 
          }else{
             if($( "#fin option:selected" ).index()<=$( "#debut option:selected" ).index()){
                 $( "#error" ).text("L'heure de fin est égale ou inférieure à l'heure de début"); 
             }else{
                var exists = false; 
                for (i = 0; i<plages.length; i++){
                    if(plages[i].date == date){
                        if(plages[i].debut == debut){
                           if(plages[i].fin == fin){
                               exists = true;
                               break; 
                           }
                       }
                   }
                }
                if (exists){
                   $( "#error" ).text("Cette plage horaire existe déja."); 
                }else{
                   $( "#error" ).text(""); 
                   var plage = date + " :" + debut + " - " + fin; //format d'affichage 
                   var valeur = date + "&" + debut + "&" + fin;    //format pour le parsing dans la BDD
                   $( "#selection" ).append("<option value=" + valeur + ">" + plage + "</option>");
                   plages.push({date:date, debut:debut, fin:fin, value:valeur});
                   value++; 
                }
             }
          }
      })
      
      $( "#supprimer" ).click(function(){
            var selected = $( "#selection option:selected" ); 
            
            var selectedValues = []; 
            selected.each(function(i, select){ 
              selectedValues[i] = $(select).val(); 
            });
            selected.remove(); 
            for (i = 0; i<selectedValues.length; i++){
                for (j = 0; j<plages.length; j++){
                     if(plages[j].value == selectedValues[i]){
                        plages.splice(j,1);    
                     }
                }
            }
            $( "#error" ).text("Plages supprimées"); 
      })
      
      
      
    });
    
    function selectAll(){
         $('#selection option').prop('selected', true); 
         //permet de selectionner toute les plage horaire avant de passer a la prochaine etape
    }
    
    function printDate(){
        var date = $( "#datepicker" ).datepicker( "getDate" );
        if (date==null) return ""; 
        var day = date.getDate();
        var month = date.getMonth();
        var year = date.getFullYear();
        
        return  day + "/" + month + "/" + year; 
    }
    
    function isValidForm(){
        selectAll();
        if($('#selection option').size()==0)return false;
        else return true;
    }