jQuery(document).ready(function($) {

	$('.offside-users-alphabet-menu ul li a').hide();

	$('.offside-users-alphabet-menu ul li a').click(function(event) {

		event.preventDefault();
		var target = $(this).attr('href');

		$('html,body').animate( {scrollTop: $(target).offset().top - 92 }, 'slow' );

	});


	$('.offside-users-alphabet-menu ul li').each(function(index, el) {
		$(this).hover(function() {
			$(this).find('a').show();
			$(this).stop().animate( {
				'width': '55px',
				'height': '30px'
			}, 'fast');
			/* Stuff to do when the mouse enters the element */
		
		}, function() {
			
			$(this).stop().animate( {
				'width': '25px',
				'height': '15px'
			}, 'fast');
			$(this).find('a').hide();
			/* Stuff to do when the mouse leaves the element */
		});


	});



});