   jQuery(document).ready(function() {
	if( jQuery(window).width() > 767) {
	   jQuery('.nav li.dropdown').hover(function() {
		   jQuery(this).addClass('open');
	   }, function() {
		   jQuery(this).removeClass('open');
	   }); 
	   jQuery('.nav li.dropdown-menu').hover(function() {
		   jQuery(this).addClass('open');
	   }, function() {
		   jQuery(this).removeClass('open');
	   }); 
	}
	jQuery('.nav').find('.fa-angle-down').each(function(){
		jQuery(this).on('click', function(){
			if( jQuery(window).width() < 768) {
				jQuery(this).parent().next().slideToggle();
			}
			return false;
		});
	});
	});
	
	/* for menu in responsive */
jQuery(document).ready(function() {
		jQuery(window).scroll(function () {
		if( jQuery(window).width() > 768) {
			if (jQuery(this).scrollTop() > 220) {
			jQuery('.menu').addClass('sticky-head');
			}
			else {
		jQuery('.menu').removeClass('sticky-head');
		}
		}
			else {
			if (jQuery(this).scrollTop() > 250) {
				jQuery('.menu').addClass('sticky-head');
			}else {
		jQuery('.menu').removeClass('sticky-head');
		}
			}				
		});
		});
	
	
		 /* /* for scroll arrow */
	 var amountScrolled = 300;
jQuery(window).scroll(function() {
	if ( jQuery(window).scrollTop() > amountScrolled ) {
		jQuery('a.back-to-top').fadeIn('slow');
	} else {
		jQuery('a.back-to-top').fadeOut('slow');
	}
});

jQuery('a.back-to-top').click(function() {
	jQuery('html, body').animate({
		scrollTop: 0
	}, 700);
	return false;
});


	jQuery(document).ready(function(){
		// set up hover panels
		// although this can be done without JavaScript, we've attached these events
		// because it causes the hover to be triggered when the element is tapped on a touch device
		jQuery('.hover').hover(function(){
			jQuery(this).addClass('flip');
		},function(){
			jQuery(this).removeClass('flip');
		});
	});
	
	

function myFunction() {
    var x = document.getElementById("myTopnav");
    if (x.className === "topnav") {
        x.className += " responsive";
    } else {
        x.className = "topnav";
    }
}
