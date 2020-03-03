jQuery( function ($) {

	"use strict";

	$.post(call_to_action_vars.ajaxurl, {
		action: 'check_cookie',
		data: {}
	}).done( function( response ) {
		if( response.data ) {
			$('body').addClass('show-call-to-action-canvas');
		}
	});

	$('.call-to-action-toggle, .call-to-action-close').on( 'click', function() {
		$('body').toggleClass('show-call-to-action-canvas');

        $.post(call_to_action_vars.ajaxurl, {
            action: 'set_cookie',
            data: { 'is_canvas_open': $('body').hasClass('show-call-to-action-canvas') ? '1' : '0' }
        });
    });

	$('.call-to-action-latest-layout-image, .call-to-action-layout-image').on( 'click', function(e) {
		e.preventDefault();

		$('body').toggleClass('show-call-to-action-canvas');

		$.post(call_to_action_vars.ajaxurl, {
            action: 'set_cookie',
            data: { 'is_canvas_open': $('body').hasClass('show-call-to-action-canvas') ? '1' : '0' }
        });

		var button = $(this);
		setTimeout(function(){ $(location).attr( 'href', button.attr('href') ); }, 350);
    });
});
