jQuery(document).ready(function($) {


	$('.offside-users-alphabet-menu ul li a').click(function(event) {
		event.preventDefault();
		var target = $(this).attr('href');

		$('html,body').animate( {scrollTop: $(target).offset().top - 92 }, 'slow' );

	});





});