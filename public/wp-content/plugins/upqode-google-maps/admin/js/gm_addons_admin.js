/**
 * Visual composer Map
 * Admin
 * ==============================================
 *
 *  1. Autocomplete Address Form in Marker Shortcode
 *  2. Autocomplete Address Form in Map Shortcode
 *
 */
;(function ($, window, document, undefined) {
    "use strict";

    /**
     * 1. Autocomplete Address Form in Marker Shortcode
     */
    $( document ).on( 'focus', 'input.address', function (e) {
        var autocomplete = new google.maps.places.Autocomplete( $(this)[0] );
    });

    /**
     * 2. Autocomplete Address Form in Map Shortcode
     */
    $( document ).on( 'focus', 'input.search_input', function (e) {
        var autocomplete = new google.maps.places.Autocomplete( $(this)[0] );
    });

})(jQuery, window, document);
