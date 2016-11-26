jQuery(function($){
	
	//home page
	if ($('body').hasClass('page-id-246')) {
		setTimeout(function(){
			$('body').addClass('loaded');
		}, 5000)
	}
		
	//projects page
	if ($('body').hasClass('post-type-archive-project')) {
		
		//load
		var filter = '*';
		if (location.hash) {
			$('nav.sub a[href="' + location.hash + '"]').addClass('active');
			filter = '.' + location.hash.substr(1);
		} else {
			$('nav.sub a[href="#"]').addClass('active');
		}
		
		//grid
		var $grid = $('.projects');
		$grid.isotope({
			itemSelector: '.projects > a',
			layoutMode: 'fitRows',
			filter: filter
		});

		//click
		$('nav.sub').on('click', 'a', function(e){
			$('nav.sub a.active').removeClass('active');
			$(this).addClass('active');
			var href = $(this).attr('href').substr(1);
			if (!href.length) {
				href = '*';
			} else {
				href = '.' + href;
			}
			$grid.isotope({
				filter: href,
			});
		});
		
	}
	
	//affix width patch: https://github.com/twbs/bootstrap/issues/6350
	$('[data-clampedwidth]').each(function() {
	    var elem = $(this);
	    var parentPanel = elem.data('clampedwidth');
	    var resizeFn = function () {
	        var sideBarNavWidth = $(parentPanel).width() - parseInt(elem.css('paddingLeft')) - parseInt(elem.css('paddingRight')) - parseInt(elem.css('marginLeft')) - parseInt(elem.css('marginRight')) - parseInt(elem.css('borderLeftWidth')) - parseInt(elem.css('borderRightWidth'));
	        elem.css('width', sideBarNavWidth);
	    };
	
	    resizeFn();
	    $(window).resize(resizeFn);
	});
	
});