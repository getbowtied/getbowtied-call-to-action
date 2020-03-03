jQuery( function ($) {

	"use strict";

	$.post(call_to_action_vars.ajaxurl, {
		action: 'check_cookie',
		data: {}
	}).done( function( response ) {
		if( response.data ) {
			setTimeout( function() {
				$('body').addClass('show-call-to-action-canvas');
			}, 2000 );
		}
	});

	$('.call-to-action-toggle, .call-to-action-canvas-overlay, .call-to-action-close').on( 'click', function() {
		$('body').toggleClass('show-call-to-action-canvas');

        $.post(call_to_action_vars.ajaxurl, {
            action: 'set_cookie',
            data: { 'is_canvas_open': $('body').hasClass('show-call-to-action-canvas') ? '1' : '0' }
        });
    });
});
