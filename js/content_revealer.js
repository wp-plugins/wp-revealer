jQuery(document).ready(function($) {
  $('.reveal').each(function() {
    var time = parseInt($(this).attr('rel')) * 1000;
    var id = $(this).attr('id');
      setTimeout(function() {
	$('#' + id).show(); 
      }, time);
  });
});