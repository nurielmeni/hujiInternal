jQuery(document).on('click', '.nls-actions .pager .prev.enabled, .nls-actions .pager .next.enabled', function() {
    jQuery.post(
        // Defined in wp_localize_script
        // To get the ajax call handled through the 'admin-ajax.php'
        search_results_pager_script.ajaxurl, 
        {
            // The function that handle the ajax call and return the data to the browser
            action: 'search_results_pager_function',
            
            // Other data variables from browser to server
            offset: jQuery(this).attr('offset'),
            SelectedOptions: setSelectedSumoOptions
        }, 
        function(response) {
            console.log('Pager: ');
            jQuery('.nls-search-results-module').replaceWith(response);

            // Scroll to the beginning of the list
            
            window.scrollTo(0, jQuery("#header").height() - jQuery(".mob-menu-header-holder.mobmenu").first().height());
            // jQuery([document.documentElement, document.body]).animate({
            //     scrollTop: jQuery('#nls-search-results-new-search').offset().top
            // }, 500);
            // Call this function so the wp will inform the change to the post
            jQuery( document.body ).trigger( 'post-load' );
        }
    );
});
