// =============================================================================
// JS/X-SHORTCODES-CALL-BODY.JS
// -----------------------------------------------------------------------------
// Function calls.
// =============================================================================

// =============================================================================
// TABLE OF CONTENTS
// -----------------------------------------------------------------------------
//   01. Function Calls
// =============================================================================

// Function Calls
// =============================================================================

jQuery(document).ready(function($) {

  $('[data-toggle="tooltip"]').tooltip({
    animation : true,
    html      : false
  });

  $('[data-toggle="popover"]').popover({
    animation : true,
    html      : false
  });

});



jQuery(window).load(function() {

  jQuery('.x-flexslider-featured-gallery').flexslider({
    controlNav   : false,
    selector     : '.x-slides > li',
    prevText     : '<i class="x-icon-chevron-left"></i>',
    nextText     : '<i class="x-icon-chevron-right"></i>',
    animation    : 'fade',
    easing       : 'easeInOutExpo',
    smoothHeight : true,
    slideshow    : false
  });

  jQuery('.x-flexslider-flickr').flexslider({
    controlNav   : false,
    selector     : '.x-slides > li',
    prevText     : '<i class="x-icon-chevron-left"></i>',
    nextText     : '<i class="x-icon-chevron-right"></i>',
    animation    : 'fade',
    easing       : 'easeInOutExpo',
    smoothHeight : true,
    slideshow    : false
  });

});