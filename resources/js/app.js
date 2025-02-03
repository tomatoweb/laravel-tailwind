import './bootstrap';
import $ from 'jquery'

$(function() {
  
  //$('body').prepend('<h1>' + welcome('Gary') + '</h1>');
  
  // on clicking user menu dropdown button
  $('#myCartDropdownButton1').on("click", function() {
    $('#myCartDropdown1').toggleClass('opacity-0 brol');
		//$('#myCartDropdown1 > a').toggleClass('pointer-events-auto pointer-events-none');
	});

  // on clicking outside of user menu dropdown button
  $('body').on("click", function(evt){    
    if(!$(evt.target).is('#myCartDropdownButton1')) {
      if(!$('#myCartDropdown1').hasClass('opacity-0')) {
        $('#myCartDropdown1').addClass('opacity-0');
        $('#myCartDropdown1 > a').removeClass('pointer-events-auto').addClass('pointer-events-none');
      }
    }
  });
  
})