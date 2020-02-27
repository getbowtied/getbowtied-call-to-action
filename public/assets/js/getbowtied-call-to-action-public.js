jQuery( function ($) {

	"use strict";

	$('.call-to-action-toggle, .call-to-action-canvas-overlay, .call-to-action-close').on( 'click', function() {
		$('body').toggleClass('show-call-to-action-canvas');

        $.post(call_to_action_vars.ajaxurl, {
            action: 'set_cookie',
            data: { 'is_canvas_open': $('body').hasClass('show-call-to-action-canvas') ? '1' : '0' }
        });
    });
});
