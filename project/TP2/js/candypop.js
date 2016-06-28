var $totalPoints=0;
$(document).ready(function(){
    var mouseX, mouseY;
    $(document).mousemove(function(e) {
        mouseX = e.pageX;
        mouseY = e.pageY;
    }).mouseover();
  $("#jeu").append(createGrcolor()); //On crée la grille de jeu 
  $("input").keyup(function () { 
        this.value = this.value.replace(/[^0-9]/g,''); //si on la valeur n'ai pas compris dans [0...9] on le supprime
        $totalPoints=0; //si on a changer la taille on reinitialise le score et la grille de jeu
        HideToolTip();
        $("#result").text("0");
        $("#jeu").empty();
        $("#jeu").append(createGrcolor());
    });
});

function createGrcolor(){
    var $table = $("<table border='2'/>");  
    for (var i=0; i<$("#r").val(); i++){
        var $tr = createRow();
        $table.append($tr);
    }
    return $table;
    
}

function createRow(){
    var $tr = $("<tr/>");
    for (var i=0; i<$("#c").val(); i++){
      var $td = $("<td/>").addClass("unselected").click(select); //Nous avons 2 classes pour chaques case : selected et unselected
      var rand =  random1to5();  //nous cherchons un nombre compris entre 1 et 5 pour choisir au hasard l'image
      rand = Math.floor(rand);
      
      switch(rand){
          case 1:
                $td.attr("color","bleu"); 
                break;
          case 2:
                $td.attr("color","jaune");
                break;
          case 3:
                $td.attr("color","rouge");
                break;
          case 4:
                $td.attr("color","vert");
                break;
          case 5:
                $td.attr("color","magenta");
                break;
      }
      $tr.append($td);
    }
    return $tr;
}

function select(event){
        if ($(this).hasClass("unselected") && $(this).attr('color')!="dontTreat"){ //Pour commencer la selection il faut que l'objet soit non-selectionner et qu'il soit traitable 
            HideToolTip();
            unselectAll(); 
            propagation($(this),'none'); //fonction qui va propager la selection au voisin du meme 'color'
            var $num = 0;
            $('.selected').each(function(index, value){
              $num++;
            });
            $num = $num*($num-1);
            if($num>0){
                $('#sp').text($num);
                $('#sp').css("left", event.pageX+10);
                $('#sp').css("top", event.pageY-10);
                ShowToolTip();
            }
            
        }else{
            if($(this).attr('color')!="dontTreat"){
                deleteSelected(); 
                unselectAll();
                HideToolTip();
            }else{
               unselectAll();
                HideToolTip(); 
            }
        }
}

function propagation(cell,provenance){
    if(provenance!='none')cell.attr("class","selected");  //on commence la propagation par changer la class par selected
    var $color = cell.attr('color'); //on initialise la couleur de la cellule 
    var $droite = getCell("droite", cell); //on initialise grâce à la fonction getCell les cellules voisines (haut bas droite gauche) 
    var $gauche = getCell("gauche", cell); // Si le voisin n'éxiste pas la fonction getCell retourne -1
    var $haut = getCell("haut", cell);  
    var $bas = getCell("bas", cell);
    
    switch(provenance){
        case 'none': //dans le cas ou on vient de selectionner la case on va regarder dans toute les directions !
        /*condition de propagation:
        *1)doit être un element dom (!=-1)
        * 2)doit être de class unselected
        * 3)son attribut 'color' doit être le même que celle de la cellule actuelle
        */
            var isPropagated = false;
            if($droite!=-1 && $droite.hasClass('unselected') && $droite.attr('color')==$color){
                propagation($droite,"gauche"); 
                isPropagated = true;
            }
            if($gauche!=-1 && $gauche.hasClass('unselected') && $gauche.attr('color')==$color){
                propagation($gauche,"droite");
                isPropagated = true;
            }
            if($haut!=-1 && $haut.hasClass('unselected') && $haut.attr('color')==$color){
               propagation($haut,"bas");
               isPropagated = true;
            }
            if($bas!=-1 && $bas.hasClass('unselected') && $bas.attr('color')==$color){
                propagation($bas,"haut");
                isPropagated = true;
            }
            if(isPropagated)cell.attr("class","selected");
            break;
        case 'haut': //si on vient de la case du haut on va regarder la case de droite, de gauche et du bas !
            if($droite!=-1 && $droite.hasClass('unselected') && $droite.attr('color')==$color)propagation($droite,'gauche');
            if($gauche!=-1 && $gauche.hasClass('unselected') && $gauche.attr('color')==$color)propagation($gauche,'droite');
            if($bas!=-1 && $bas.hasClass('unselected') && $bas.attr('color')==$color)propagation($bas,'haut');
            break;
        case 'bas':
            if($droite!=-1 && $droite.hasClass('unselected') && $droite.attr('color')==$color)propagation($droite,'gauche');
            if($gauche!=-1 && $gauche.hasClass('unselected') && $gauche.attr('color')==$color)propagation($gauche,'droite');
            if($haut!=-1 && $haut.hasClass('unselected') && $haut.attr('color')==$color)propagation($haut,'bas');
            break;
        case 'droite':
            if($haut!=-1 && $haut.hasClass('unselected') && $haut.attr('color')==$color)propagation($haut,'bas');
            if($bas!=-1 && $bas.hasClass('unselected') && $bas.attr('color')==$color)propagation($bas,'haut');
            if($gauche!=-1 && $gauche.hasClass('unselected') && $gauche.attr('color')==$color)propagation($gauche,'droite');
            break;
        case 'gauche':
            if($droite!=-1 && $droite.hasClass('unselected') && $droite.attr('color')==$color)propagation($droite,'gauche');
            if($haut!=-1 && $haut.hasClass('unselected') && $haut.attr('color')==$color)propagation($haut,'bas');
            if($bas!=-1 && $bas.hasClass('unselected') && $bas.attr('color')==$color)propagation($bas,'haut');
            break;
    }
}

function getCell(position, cell){
        var $parent = cell.parent(); //parent (tr)
        var $parentTable = $parent.parent(); //parent du parent (table)
        var $ligneNum = $parent.index()+1; //numero de la ligne
        var $colonneNum = cell.index()+1; //numero de la colonne
        
        switch(position){
           case "droite":  
                if($colonneNum<$('#c').val()){ //on cherche la valeur l'color de la cellule de droite SI elle existe, sinon on retourne '-1'
                    return $parent.children().eq($colonneNum);
                }else{
                    return -1;
                };
                break;
                
            case 'gauche':
                if($colonneNum>1){ //on cherche la valeur l'color de la cellule de gauche SI elle existe, sinon on retourne '-1'
                    return $parent.children().eq($colonneNum-2);
                }else{
                    return -1;
                };
                break;
                
            case 'haut':
                if($ligneNum>1){
                    return $parentTable.children().eq($ligneNum-2).children().eq($colonneNum-1);   
                }else{
                    return -1;
                };
                break;
                
            case 'bas':
                if($ligneNum<$('#r').val()){
                   return $parentTable.children().eq($ligneNum).children().eq($colonneNum-1);   
                }else{
                    return -1;
                };
                break;
        }
};

function unselectAll(){ //fonction qui permet de deselectionner tout les elements du tableau
    $('td').each(function(index, value){
      $(this).attr('class','unselected');
    });
}

function deleteSelected(){
    var $num = 0;
    $('.selected').each(function(index, value){
      $num++;
      $(this).attr('color','dontTreat'); //si un element est vcolorer on doit s'assurer qu'il ne soit plus traiter dans la selection !
      $(this).empty();
      sink($(this)); // fonction qui permet de faire couler les element au dessus de l'element
    });
    $totalPoints+=$num*($num-1);
    $('#result').empty();
    $('#result').append($totalPoints);
    HideToolTip();
    
};

function random1to5(){
    return Math.random() * (5 - 1) + 1;
};

function sink(cell){ 
    var $parent = cell.parent();
    var $parentTable = $parent.parent();
    var $ligne = $parent.index();
    var $colonne = cell.index();
    if($ligne>0){
        var $cellTop = $parentTable.children().eq($ligne-1).children().eq($colonne).clone(true)
        var $tempCell = cell.clone(true);
        cell.replaceWith($cellTop); 
        $parentTable.children().eq($ligne-1).children().eq($colonne).replaceWith($tempCell);
        sink($parentTable.children().eq($ligne-1).children().eq($colonne));
    }
}
function ShowToolTip(){
    $('#sp').css("position", "visible");
    $('#sp').css("visibility", "visible");
    
}
function HideToolTip(){
    $('#sp').css("visibility", "hidden");
}


