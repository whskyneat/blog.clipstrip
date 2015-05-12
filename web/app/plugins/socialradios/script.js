function scriptc(a,b){
  var __d=document;
  var __h = __d.getElementsByTagName("head")[0];
  var s = __d.createElement("script");
  s.setAttribute("src", a);
  s.id = b;
  __h.appendChild(s);
}
	function prevent_event_handler(handler, event, scripts) {
		var location = handler.attr('href');
		//console.log(window.location.host);
		var pat = /^https?:\/\//i;
		
    	if (location) {

			if (location.search( window.location.host ) != -1  || !pat.test(location)) {
				
				if ( location.search('wp-admin') == -1 || location.search('http://') == -1 ) {
				console.log(location);
					var height = ($(window).height() - 150) / 2;
					var width = ($(window).width() - 150) / 2;
					$('body').prepend('<img style="width: 150px; height:150px; margin: auto; display: block; z-index: 9999999; position:absolute; margin:'+height+'px '+width+'px;" class="loading" src="/wp-content/plugins/socialradios/loading.gif">');
					window.scrollTo(0, 0);
					event.preventDefault();
					$('.dd_outer').hide();
					get_ajax_prevent(location, scripts);
				} else {
    				window.location  = location;
    			}
    		} else {
    			window.open(location, '_blank');
    		} 
    	}
	}
	function get_ajax_prevent(location, scripts) {
		if (!location) return;

		var socialradios_id = '#socialradios';
		var html = 'some_text';
		$.ajax({
			url: location,
			type: 'get',
			data: {
				// action: 'list',
				// page: page_id
			},
			dataType: 'html',

			success: function (resp) {
				if (resp.error) {
					return;
				}
				$('.loading').remove();
				var html = $(resp);
					var History = window.History; 
				    if ( !History.enabled ) {
				        return false;
				    }
				    History.Adapter.bind(window,'statechange',function(){ 
				        var State = History.getState(); 
				        
				    });
				    History.pushState(location, $(html).filter('title').text() , location); 




				 	var content_body = [];
				
				html.filter('#socialradios').prevAll().filter('header, footer, div, aside, nav').each( function() {
				 	  content_body.push($(this).get(0).outerHTML) ;
				 	});
				content_body.reverse();
				$('#socialradios').prevAll().filter('header, footer, div, aside:not(#socialradios)').remove();
				$('body').prepend( content_body );

				html.filter('script').each( function() {
				 	  //script = ;
   						eval($(this).text());
				 	});
			},

			error: function () {
				return;
			}
		});

	}