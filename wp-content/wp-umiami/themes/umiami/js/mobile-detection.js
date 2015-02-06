jQuery(document).ready(function() {

    // Check to see if if the user agent is from a mobile device

    if( /Android|webOS|iPhone|iPod|CriOS|Opera Mobi|BlackBerry/i.test(navigator.userAgent) ) {
	// The UI for choosing the mobile site or not
	jQuery('body').prepend('<div id="mobile_site_question"><p>Would you like to use the mobile site?</p>'
			  
			  + '<div class="mobi_button" id="ok_mobile">Ok</div><div class="mobi_button" id="no_mobile">No</div><div><img src="http://library.miami.edu/wp-content/themes/umiami/images/mobile.png" alt="View Mobile Website" title="View Mobile Website"><a style=" margin-left: 1%; margin-top: 4%; line-height: 27px; color: white; text-decoration: underline; " href="http://m.library.miami.edu">m.library.miami.edu</div></div>');
	jQuery('div#mobile_site_question').css ({
	    "background":"#f37421",
	    "color":"#fff",
	    "padding":"1%",
	    "margin":"-5px",
	    "padding-left":"4%"
	}); 
	jQuery('div.mobi_button').css({ 
	    "width": "6%",
	    "margin": "2%",
	    "text-align": "center",
	    "padding": "1%",
	    "background":"#333",
	    "margin-left":"0",
	    "display" :"inline-block",
	    
	});

	// Button behavior 

	jQuery('div#ok_mobile').on('click', function() {

	    window.location.replace("http://m.library.miami.edu/");

	});

	jQuery('div#no_mobile').on('click', function() {

	    jQuery('div#mobile_site_question').remove();

	});
	
    } else {

    }

});
