$max = 10;
$min = 1;
$input_mod = 0;


$(function(){
  
//
//numberOfActivities field spec--------------------------
  $('#nbrOfActivities').focus(function(){
    $(this).attr("placeholder", '');
  });
  $('#nbrOfActivities').blur(function(){
    $(this).attr("placeholder", "Number of activities");
  });
  $('#nbrOfActivities').attr("min", $min);
  $('#nbrOfActivities').attr("max", $max);
  $('#nbrOfActivities').keypress(function(e){
    if ( e.which == 13 ) return false;
  });
//---------------------------------------------------------



//Permet de changer le theme du code
//TODO: amélioration pour switcher entre les css contenuent dans un dissier acceuil. 
//change theme---------------------------------------------
// $('#change_theme').click(function(){
//     if($('#style').attr('href') == 'style.css')
//       $('#style').attr('href', 'style2.css');
//     else if($('#style').attr('href') == 'style2.css')
//       $('#style').attr('href', 'style.css');
// });

$('#change_theme').click(function(){
    if($('#style').attr('style') == '1')
    {
      $('body').css({"background":"linear-gradient(to right, #25c481, #25b7c4)"});
      $('.tlb_header').css({"background-color": "rgba(255,255,255,0.3)"});
      $('.tlb_content').css({"border": "1px solid rgba(255,255,255,0.3)"});
      $('.td').css({"border-bottom": "solid 1px rgba(255,255,255,0.1)"});
      $('#style').attr('style', '1');
    }
    else if($('#style').attr('style') == '0')
    {
      $('body').css({"background":"#fff}"});
      $('.tlb_header').css({"background-color": "rgba(0,0,0,0.3)"});
      $('.tlb_content').css({"border": "1px solid rgba(0,0,0,0.3)"});
      $('.td').css({"border-bottom": "solid 1px rgba(0,0,0,0.1)"});
      $('#style').attr('style', '0');
    }
});

// $('#change_theme').toggle(
//   function(){
//     $('body').css({"background":"-webkit-linear-gradient(left, #25c481, #25b7c4)"});
//     $('body').css({"background":"linear-gradient(to right, #25c481, #25b7c4)"});
//   },
//   function(){
//     $('body').css({"background":"#fff"});
//   }
// );

$('.event_user_input').hide();
$div_input_on = false;

$('.addEvent').click(function(){
  if(!$div_input_on)
  {
    $input_mod = 1;
    $('.event_user_input').fadeIn();
    $div_input_on = true;
  }else
  {
    $('.event_user_input').fadeOut();
    $div_input_on = false;
  }
});



//---------------------------------------------------------

//---------------------------------------------------------

//---------------------------------------------------------

//---------------------------------------------------------

//---------------------------------------------------------

//---------------------------------------------------------

//---------------------------------------------------------
//---------------------------------------------------------






});

