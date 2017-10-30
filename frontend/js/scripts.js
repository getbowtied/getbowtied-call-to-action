jQuery(function($) {

    "use strict";
    
    $(document).ready(function(){

		function getQueryVariable(variable)
		{
			var query = window.location.search.substring(1);
			var vars = query.split("&");
			for (var i=0;i<vars.length;i++) 
			{
				var pair = vars[i].split("=");
				if(pair[0] == variable){return pair[1];}
			}
			return '';
		}

		function getCookie(cname) {
		    var name = cname + "=";
		    var ca = document.cookie.split(';');
		    for(var i = 0; i <ca.length; i++) {
		        var c = ca[i];
		        while (c.charAt(0)==' ') {
		            c = c.substring(1);
		        }
		        if (c.indexOf(name) == 0) {
		            return c.substring(name.length,c.length);
		        }
		    }
		    return '';
		}
	    
	 	var utm_source   = getQueryVariable('utm_source');
	 	var utm_medium   = getQueryVariable('utm_medium');
	 	var utm_campaign = getQueryVariable('utm_campaign');

	 	// console.log(utm_source.length);

	 	if (utm_source.length)
	 	{
	 		// console.log(x);
		 	document.cookie = "utm_source=" +utm_source;
		 	document.cookie = "utm_medium=" +utm_medium;
		 	document.cookie = "utm_campaign=" +utm_campaign;
		}

	    var u1 =  getCookie('utm_source');
	    var u2 =  getCookie('utm_medium');
	    var u3 =  getCookie('utm_campaign');

	   // console.log(u1&&u2&&u3)
	   // console.log(u1);
	   // console.log(u1.length);

	 	if ( u1.length )
	 	{
	 		//console.log('wtf?');
	 		var the_href = $('.getbowtied_get_this_theme').attr('href');
	 		if (the_href.indexOf('?') > 0)
	 		{
				the_href += '&utm_source=' + getCookie('utm_source') + '&utm_medium=' + getCookie('utm_medium') + '&utm_campaign=' + getCookie('utm_campaign');
	 		}	
	 		else 
	 		{
		 		the_href += '?utm_source=' + getCookie('utm_source') + '&utm_medium=' + getCookie('utm_medium') + '&utm_campaign=' + getCookie('utm_campaign');
	 		}
	 		$('.getbowtied_get_this_theme').attr('href', the_href);
	 	}

    });

	 
});