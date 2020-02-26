jQuery( function ($) {

	"use strict";

	$('.call-to-action-toggle, .call-to-action-canvas-overlay').on( 'click', function() {
		$('body').toggleClass('show-call-to-action-canvas');
	});

});
