jQuery( function ($) {

	"use strict";

    $('.getbowtied-call-to-action-table .table-section').on('click', function() {
        $(this).next().toggleClass('show');
    });
});
