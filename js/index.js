$(function(){
      $('#home').click(function(){
   		
   		if($('#emailForm').hasClass("hidden"))
		{
			$('#emailForm').hide();
			$('#emailForm').removeClass("hidden");
			$('#emailForm').slideToggle();
		}
		else
   			$('#emailForm').slideToggle();
   	});
});