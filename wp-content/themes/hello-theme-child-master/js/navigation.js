( function($) {
    
    // Toggle mobile menu
    $(".toggle-mnu").click(function() {
        $(this).toggleClass("on");
        
        if ($(this).hasClass('on')) {
            $(".site-navigation.mobile").animate({
                width: 258
            });
        } else {
            $(".site-navigation.mobile").animate({
                width: 0
            });
        }
        
        return false;
    });

    $('.site-navigation.mobile li a').on('click', function() {
        $(".toggle-mnu").trigger('click');
    });
} )(jQuery);