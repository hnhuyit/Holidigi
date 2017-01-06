(function($) {
	$(document).ready(function(){
		$('.fusion-main-menu .menu-item-has-children').each(function(){
			$(this).append('<span href="#" aria-haspopup="true" class="fusion-open-submenu"></span>');
			
		});
		$('.attorney-item .attorney-profile .our-information').each(function() {
		  	var content = $(this).html();
		  	var maxLength = 80;
		  	var trimmedString = content.substr(0, maxLength);
		  	trimmedString = trimmedString.substr(0, Math.min(trimmedString.length, trimmedString.lastIndexOf(" ")));
		  	$(this).empty();
		  	$(this).append(trimmedString +' ... ');
		});
	});
	$('.wpcf7-not-valid-tip').live({"mouseenter": function () {
	        jQuery(this).animate({opacity:0},500,function(){
	            jQuery(this).remove();
	        });
    	},"mouseleave": function(){}   
     
    });

	$('.wpcf7-form-control').on("click", function () {
	    jQuery(this).removeClass('border-valid');
	    jQuery(this).next().animate({opacity:0},500,function(){
	        jQuery(this).next().remove();
	    });
	});
	$(window).resize(function(){
		
	});
	$(window).load(function(){
		jQuery('.ajax-loader').prop('title', 'Houston Personal Injury & Auto Accident Attorneys');
	});

})(jQuery);