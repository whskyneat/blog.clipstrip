// =============================================================================
// JS/X-SHORTCODES.JS
// -----------------------------------------------------------------------------
// Custom shortcode scripts for the X Shortcodes plugin.
// =============================================================================

// =============================================================================
// TABLE OF CONTENTS
// -----------------------------------------------------------------------------
//   01. Custom Shortcode Scripts
// =============================================================================

// Custom Shortcode Scripts
// =============================================================================

jQuery(document).ready(function($) {

  //
  // Parallax effect.
  //

  var windowObj    = $(window);
  var windowHeight = windowObj.height();
  var thisObj      = $(this);

  windowObj.resize(function() {
    windowHeight = windowObj.height();
  });

  $.fn.parallaxContentBand = function(xAxis, parallaxSpeed) {
    var thisObj = $(this);
    var contentBandFirstTop;

    thisObj.each(function(){
      contentBandFirstTop = thisObj.offset().top;
    });

    windowObj.resize(function() {
      thisObj.each(function() {
        contentBandFirstTop = thisObj.offset().top;
      });
    });

    function windowUpdate() {
      var windowPosition = windowObj.scrollTop();

      thisObj.each(function() {
        var contentBandOffsetTop = thisObj.offset().top;
        var contentBandHeight    = thisObj.outerHeight();

        if (contentBandOffsetTop + contentBandHeight < windowPosition || contentBandOffsetTop > windowPosition + windowHeight) {
          return;
        }

        thisObj.css('background-position', xAxis + ' ' + Math.floor((contentBandFirstTop - windowPosition) * parallaxSpeed) + 'px');
      });
    }

    windowObj.bind('scroll', windowUpdate).resize(windowUpdate);
    windowUpdate();
  };


  //
  // Waypoint: fade.
  //

  $('.x-column[data-fade="true"]').each(function() {
    $(this).waypoint(function() {
      if ($(this).data('fade-animation') === 'in-from-top') {
        $(this).animate({
          'opacity' : '1',
          'top'     : '0'
        }, 750, 'easeOutExpo');
      } else if ($(this).data('fade-animation') === 'in-from-left') {
        $(this).animate({
          'opacity' : '1',
          'left'    : '0'
        }, 750, 'easeOutExpo');
      } else if ($(this).data('fade-animation') === 'in-from-right') {
        $(this).animate({
          'opacity' : '1',
          'right'   : '0'
        }, 750, 'easeOutExpo');
      } else if ($(this).data('fade-animation') === 'in-from-bottom') {
        $(this).animate({
          'opacity' : '1',
          'bottom'  : '0'
        }, 750, 'easeOutExpo');
      } else {
        $(this).animate({ 'opacity' : '1' }, 750, 'easeOutExpo');
      }
    }, { offset : '65%', triggerOnce : true });
  });


  //
  // Waypoint: recent posts.
  //

  $('.x-recent-posts[data-fade="true"]').each(function() {
    $(this).waypoint(function() {
      $(this).find('a').each(function(i) {
        $(this).delay(i * 90).animate({ 'opacity' : '1' }, 750, 'easeOutExpo');
      });
      setTimeout(function() {
        $(this).addClass('complete');
      }, ($(this).find('a').length * 90) + 400);
    }, { offset : '75%', triggerOnce : true });
  });


  //
  // Waypoint: skill bar.
  //

  $('.x-skill-bar').each(function() {
    $(this).waypoint(function() {
      var percentage = $(this).data('percentage');
      $(this).find('.bar').animate({ 'width' : percentage }, 750, 'easeInOutExpo');
    }, { offset : '95%', triggerOnce : true });
  });


  //
  // Waypoint: counter.
  //

  $('.x-counter').each(function() {
    $(this).waypoint(function() {
      var numEnd   = $(this).data('num-end');
      var numSpeed = $(this).data('num-speed');
      $(this).find('.number').animateNumber({ 'number' : numEnd }, numSpeed);
    }, { offset : '85%', triggerOnce : true });
  });


  //
  // Ensure accordion collapse class.
  //

  $('.x-accordion-toggle[data-parent]').click(function() {
    $(this).closest('.x-accordion').find('.x-accordion-toggle:not(.collapsed)').addClass('collapsed');
  });


  //
  // Google maps.
  //

  if ( $('.x-google-map-inner').length > 0 ) {

    $('.x-google-map-inner').each(function(i,e) {

      var $map            = $(e);
      var $mapID          = $map.attr('id');
      var $mapLat         = $map.data('map-lat');
      var $mapLng         = $map.data('map-lng');
      var $mapCoordinates = new google.maps.LatLng($mapLat, $mapLng);
      var $mapDrag        = $map.data('map-drag');
      var $mapZoom        = parseInt($map.data('map-zoom'));
      var $mapZoomControl = $map.data('map-zoom-control');
      var $mapHue         = $map.data('map-hue');

      var mapStyles = [
        {
          featureType : 'all',
          elementType : 'all',
          stylers     : [
            { hue : ( $mapHue ) ? $mapHue : null }
          ]
        },
        {
          featureType : 'water',
          elementType : 'all',
          stylers     : [
            { hue : ( $mapHue ) ? $mapHue : null },
            { saturation : 0          },
            { lightness  : 50          }
          ]
        },
        {
          featureType : 'poi',
          elementType : 'all',
          stylers     : [
            { visibility : 'off' }
          ]
        }
      ];

      var mapOptions = { 
        scrollwheel            : false,
        draggable              : ( $mapDrag === true )        ? true : false, 
        zoomControl            : ( $mapZoomControl === true ) ? true : false,
        disableDoubleClickZoom : false,
        disableDefaultUI       : true,
        zoom                   : $mapZoom,
        center                 : $mapCoordinates,
        mapTypeId              : google.maps.MapTypeId.ROADMAP
      };

      var googleStyledMap = new google.maps.StyledMapType(mapStyles, {name : "Styled Map"});
      var googleMap       = new google.maps.Map(document.getElementById($mapID), mapOptions);
      googleMap.mapTypes.set('map_style', googleStyledMap);
      googleMap.setMapTypeId('map_style');

      setMarkers( googleMap, $mapID );

    });

  }

  function setMarkers( googleMap, googleMapID ) {

    var googleMarkers     = [];
    var googleInfoWindows = [];
    var mapContainerID    = $( '#' + googleMapID ).parent().attr('id');

    $( '#' + mapContainerID + ' .x-google-map-marker' ).each(function(i,e) {

      var $mapMarker            = $(e);
      var $mapMarkerLat         = $mapMarker.data('map-marker-lat');
      var $mapMarkerLng         = $mapMarker.data('map-marker-lng');
      var $mapMarkerCoordinates = new google.maps.LatLng($mapMarkerLat, $mapMarkerLng);
      var $mapMarkerImage       = $mapMarker.data('map-marker-image');
      var $mapMarkerInfo        = $mapMarker.data('map-marker-info');

      googleMarkers[i] = new google.maps.Marker({
        map             : googleMap,
        position        : $mapMarkerCoordinates,
        infoWindowIndex : i,
        icon            : $mapMarkerImage
      });

      googleInfoWindows[i] = new google.maps.InfoWindow({
        content  : $mapMarkerInfo,
        maxWidth : 200
      });

      google.maps.event.addListener(googleMarkers[i], 'click', function() {
        if ( $mapMarkerInfo ) {
          googleInfoWindows[i].open(googleMap, this);
        }
      });

    });

  }

});


jQuery(window).load(function() {

  //
  // Attach parallax handlers.
  //

  if (Modernizr.touch) {
    jQuery('.x-content-band.bg-image.parallax, .x-content-band.bg-pattern.parallax').css('background-attachment', 'scroll');
  } else {
    jQuery('.x-content-band.bg-image.parallax').each(function() {
       var id = jQuery(this).attr('id');
       jQuery('#' + id + ".parallax").parallaxContentBand('50%', 0.1);
    });
    jQuery('.x-content-band.bg-pattern.parallax').each(function() {
       var id = jQuery(this).attr('id');
       jQuery('#' + id + ".parallax").parallaxContentBand('50%', 0.3);
    });
  }

});