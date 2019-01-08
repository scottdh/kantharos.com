jQuery.noConflict();

/* tooltip for socials init */

function tooltipInit() {

    jQuery("[data-toggle='tooltip']").tooltip();
}


/* link smooth scroll to top */
function scrollToTop(i) {
    if (i == 'show') {
        if (jQuery(this).scrollTop() != 0) {
            jQuery('#toTop').fadeIn();
        } else {
            jQuery('#toTop').fadeOut();
        }
    }
    if (i == 'click') {
        jQuery('#toTop').click(function () {
            jQuery('body,html').animate({scrollTop: 0}, 600);
            return false;
        });
    }
}


jQuery(document).ready(function () {
    scrollToTop('click');
    tooltipInit();
});

jQuery(window).resize(function () {
});

jQuery(window).scroll(function () {
    scrollToTop('show');
});



