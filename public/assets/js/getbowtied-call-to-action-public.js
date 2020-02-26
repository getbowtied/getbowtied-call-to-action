jQuery( function ($) {

	"use strict";

	$('.call-to-action-toggle, .call-to-action-canvas-overlay, .call-to-action-close').on( 'click', function() {
		$('body').toggleClass('show-call-to-action-canvas');
	});

});
