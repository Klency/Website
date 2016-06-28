var choices = "";

$(document).ready(function(){

    $( "#userChoice td" ).click(function(){
        var e = $(this); 
        if (e.hasClass("n")){
            e.removeClass("n");
            e.addClass("o");
        }
		else if (e.hasClass("o")){
            e.removeClass("o");
            e.addClass("n");  
        }
        choices = "";
        changeValue(); 
    })
   
    changeValue();
});

function changeValue(){
    $( "#userChoice td" ).each(function() {
        var choice = $(this).attr('class'); 
        if (choice == "n") choices = choices + "n"; 
        if (choice == "o") choices = choices + "o";    
    })

    $( "#confirmation").val(choices);
}

function validateMyForm (test)
{
  
  if(test == "error")
  { 
    alert("validation failed false");
    returnToPreviousPage();
    return false;
  }

  alert("validations passed");
  return true;
}
