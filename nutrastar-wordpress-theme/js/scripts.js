
// ---------------------------
// Grant Imbo | grantimbo.com
// ---------------------------


$(function() {

	// animate a#link
	// $('a[href*="#"]:not([href="#"])').click(function() {
	// 	if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
	// 	  var target = $(this.hash);
	// 	  target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
	// 	  if (target.length) {
	// 	    $('html, body').animate({
	// 	      scrollTop: target.offset().top
	// 	    }, 1000);
	// 	    return false;
	// 	  }
	// 	}
	// });

	// scroll function
	$(window).on('scroll', function() {
	    scrollPosition = $(this).scrollTop();
	    if (scrollPosition >= 400) {
	         $('#toTop').addClass('active');
	    } else {
	        $('#toTop').removeClass('active');
	    }
	});


	// change link
	// $(window).on('load', function() {
	//     if (!$('body').hasClass("page-template-template-home")) {

	// 	    $('nav.navigation li a').each(function() {

	// 			var text = $(this).attr('href');

	// 			if(text.indexOf('#') > -1) {
	// 			  // console.log("no dash found.");
	// 				$(this).attr('href',"http://localhost/nutrastar/" + text);
	// 			}
	// 		});
	// 	};
	// });


	var toggleWrap = $('.toggle-wrap'),
		navigation = $('nav.navigation');

	// toggle nav
	toggleWrap.on('click', function(){
		navigation.toggleClass('active');
		toggleWrap.toggleClass('active');
	})

	// reset navigation if window is larger than 960 px
	$(window).resize(function() {
		if ($(window).width() > 720) {
		   toggleWrap.removeClass('active');
		   navigation.removeClass('active');
		}
	});



	console.log('-------------------------------');
	console.log('|    Written by Grant Imbo    |');
	console.log('-------------------------------');


});