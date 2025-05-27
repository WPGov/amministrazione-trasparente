(function($) {
    'use strict';

    $(document).ready(function() {
        // Handle click events
        $('.at-sezioni-expandable .at-sezioni-group-title').on('click', function(e) {
            e.preventDefault();
            const $item = $(this).closest('.at-sezioni-item');
            $item.toggleClass('expanded');
        });

        // Check URL hash on page load
        if (window.location.hash) {
            const targetId = window.location.hash.substring(1); // Remove the # character
            const $targetGroup = $('.at-sezioni-expandable .at-sezioni-group-title#' + targetId);
            
            if ($targetGroup.length) {
                $targetGroup.closest('.at-sezioni-item').addClass('expanded');
                
                // Smooth scroll to the expanded section
                setTimeout(function() {
                    $('html, body').animate({
                        scrollTop: $targetGroup.offset().top - 50 // 50px offset for better visibility
                    }, 500);
                }, 100);
            }
        }
    });
})(jQuery);