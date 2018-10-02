jQuery(document).ready(function($){

	"use strict";

	/**
	 * ----------------------------------------------------------------------------------------
	 *    GLOBALS
	 * ----------------------------------------------------------------------------------------
	 */

	var $window = $(window);
	var $document = $(document);
	var $body = $('body');
	var $footer = $('.footer');
	var isMobile = false;

	var $mainContent = $( '.MAIN-CONTENT' );

	// Navigation
	var $navSticky = $('.is-nav-sticky');

	var initBgSegmentsFunction = false;
	
	if( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {
		isMobile = true;
	}


	/**
	* ----------------------------------------------------------------------------------------
	*    JS Checker
	* ----------------------------------------------------------------------------------------
	*/

	document.documentElement.className = document.documentElement.className.replace("no-js","js");

	/**
	* ----------------------------------------------------------------------------------------
	*    Fixes Bug on iOS that stops hovered elements from hiding when tapped outside
	* ----------------------------------------------------------------------------------------
	*/

	if ( isMobile ) {
		$body.css('cursor', 'pointer');
	}

	/**
	* ----------------------------------------------------------------------------------------
	*    GLOBAL Functions
	* ----------------------------------------------------------------------------------------
	*/

	/**
	* Returns a random integer between min (inclusive) and max (inclusive)
	* Using Math.round() will give you a non-uniform distribution!
	*/
	function getRandomInt(min, max) {
	    return Math.floor(Math.random() * (max - min + 1)) + min;
	}

	/**
	*  Shade Color
	*/
	function shadeColor(color, percent) {   
		var f=parseInt(color.slice(1),16),t=percent<0?0:255,p=percent<0?percent*-1:percent,R=f>>16,G=f>>8&0x00FF,B=f&0x0000FF;
		return "#"+(0x1000000+(Math.round((t-R)*p)+R)*0x10000+(Math.round((t-G)*p)+G)*0x100+(Math.round((t-B)*p)+B)).toString(16).slice(1);
	}

	/**
	*  Converts rgba(xxx, xxx, xxx, x) to hex
	*/
	function hexc(colorval) {
		var parts = colorval.match(/^rgba*\((\d+),\s*(\d+),\s*(\d+)(?:,\s*(?:\d+)*.*(?:\d+)*)*\)$/);
		if (!parts) {
			return;
		}
		delete(parts[0]);
		for (var i = 1; i <= 3; ++i) {
			parts[i] = parseInt(parts[i]).toString(16);
			if (parts[i].length == 1) parts[i] = '0' + parts[i];
		}
		return '#' + parts.join('');
	}

	/**
	*  Checks of color is dark
	*/
	function isColorDark(hexColor){
		var c = hexColor.substring(1);      // strip #
		var rgb = parseInt(c, 16);   // convert rrggbb to decimal
		var r = (rgb >> 16) & 0xff;  // extract red
		var g = (rgb >>  8) & 0xff;  // extract green
		var b = (rgb >>  0) & 0xff;  // extract blue

		var luma = 0.2126 * r + 0.7152 * g + 0.0722 * b; // per ITU-R BT.709

		if (luma < 40) {
		    return true;
		}
		return false;
	}


	/**
	*  Scroll in View
	*/
	$.fn.inView = function() {
		var $this = this;
		var docViewTop = $window.scrollTop();
		var docViewBottom = docViewTop + $window.height();
		var elemTop = $this.offset().top;
		var elemBottom = elemTop + $this.height() + 160;
		if ( ((docViewTop <= elemBottom) && (docViewBottom >= elemTop)) || (isMobile == true) ) {
			return true;
		}
		else {
			return false;
		}
	}


	/**
	*  Get Parent Background
	*/
	$.fn.getParentBG = function() {

		var $this = this;

		if ( $this.children('.bg-color').length ) {
			return $this.children('.bg-color').css("background-color");
		}
		
		// Is current element's background color set?
		var color = $this.css("background-color");
		if ( color == 'transparent' ) {
			color = 'rgba(0, 0, 0, 0)';
		}
		if ( color !== 'rgba(0, 0, 0, 0)' ) {
			// if so then return that color
			return color;
		}

		// are you at the body element?
		if ($this.is("body")) {
			// return known 'false' value
			return false;
		} else {
			// call getParentBG with parent item
			return $this.parent().getParentBG();
		}

	}
	

	/**
	* ----------------------------------------------------------------------------------------
	*    Activate and Reset anim- Animations
	* ----------------------------------------------------------------------------------------
	*/

 	$.fn.activateAnimations = function() {

 		var self = this;

		self.find('*').filter(function(){

			if (typeof this.className == 'string') {
				var classes = this.className.split(' ');
				var found = false;

				if ( classes ) {
					for (var i = 0, len = classes.length; i < len; i++) {
						if (/^anim-/.test(classes[i])) found = true;
						if (/^anim-onload/.test(classes[i])) return false;
					}
					if (found == true) {
						return true;
					}
				}
			}
			
			return false; 
		}).each(function(){
			$(this).addClass('anim-activated');
		})

	};



 	$.fn.resetAnimations = function() {

 		var self = this;

		self.find('*').filter(function(){

			if (typeof this.className == 'string') {
				var classes = this.className.split(' ');
				var found = false;

				if ( classes ) {
					for (var i = 0, len = classes.length; i < len; i++) {
						if (/^anim-/.test(classes[i])) found = true;
						if (/^anim-onload/.test(classes[i])) return false;
					}
					if (found == true) {
						return true;
					}
				}
			}
			
			return false;
		}).each(function(){
			$(this).removeClass('anim-activated');
		})

	};



	/**
	* ----------------------------------------------------------------------------------------
	*   Set Background Image or Color
	* ----------------------------------------------------------------------------------------
	*/

	function setBgImage(){
		var $bgimage = $('.bg-image');
		$bgimage.each(function(){
			var $this = $(this);
			var bgimage = $this.data('bg-image')
			if ( $this.css('background-image') != 'url("' + bgimage + '")' ) {
				$this.css('background-image', 'url("' + bgimage + '")' );
			}
			
		})

		var $bgColor = $('.bg-color');
		$bgColor.each(function(){
			var $this = $(this);
			var bgColor = $this.data('bg-color');
			if ( $this.css('background-color') != bgColor ) {
				$this.css('background-color', bgColor);
			}
			var opacity = $this.data('opacity');
			if ( typeof $this.data('opacity') != 'undefined' && $this.css('opacity') != opacity ) {
				$this.css('opacity', opacity);
			}
		})
	}

	setBgImage();

	$window.on('refreshisotope', function(e){
		setBgImage();
	});


	/**
	* ----------------------------------------------------------------------------------------
	*    Remove Empty Paragraphs
	* ----------------------------------------------------------------------------------------
	*/

	$('p').filter(function(){
		return !$.trim($(this).html());
	}).remove();

	/**
	* ----------------------------------------------------------------------------------------
	*    Preloader
	* ----------------------------------------------------------------------------------------
	*/

	var $preloader = $('.Preloader');
	function showPreloader() {

		if ( $preloader.length != 0 ) {
			$window.load(function() {

				setTimeout(function(){
					blockRevealInit();
					$preloader.fadeOut(280);
					$preloader.remove();
					// Automatically show elements with anim-onload class
					setTimeout(function(){
						$('.anim-onload').each(function(){
							var $this = $(this);
							$this.addClass('anim-activated');
						})
					}, 250)
				}, 0)

				// Show if theme takes too much time to load
				setTimeout(function(){
					if ( $preloader.is(':visible') ) {
						blockRevealInit();
						$preloader.fadeOut(280);
						$preloader.remove();
						setTimeout(function(){
							$('.anim-onload').each(function(){
								var $this = $(this);
								$this.addClass('anim-activated');
							})
						}, 250)
					}
				}, 5000)
				
			});
		} else {
			setTimeout(function(){
				blockRevealInit();
				// Automatically show elements with anim-onload class
				setTimeout(function(){
					$('.anim-onload').each(function(){
						var $this = $(this);
						$this.addClass('anim-activated');
					})
				}, 250)
			}, 0)

		}
	}

	showPreloader();


	/**
	* ----------------------------------------------------------------------------------------
	*    Block Reveal Effect
	* ----------------------------------------------------------------------------------------
	*/
	
	function blockRevealInit() {
		document.body.classList.remove('loading');

		var divs = document.querySelectorAll('.is-block-reveal'), i;
		
		for (i = 0; i < divs.length; ++i) {

			var randomShade = getRandomInt(-70, 60)

			var color = shadeColor(vivian.mainColor, randomShade/100);

			var revealBlock = new RevealFx(divs[i], {
				revealSettings : {
					bgcolor: color,
					onCover: function(contentEl, revealerEl) {
						contentEl.style.opacity = 1;
					}
				}
			});
			revealBlock.reveal();

		}
	}

	/**
	* ----------------------------------------------------------------------------------------
	*    Isotope
	* ----------------------------------------------------------------------------------------
	*/

	var isotopeCols = 0;

 	var itemGutter = 0;

	var startIsotopemethods = {
        init : function(options) {


        	var $this = (this);

        	$this.startIsotope('setOptions');

		 	var isotopeType = $this.data('isotope-type');

		 	if ( isotopeType == null ) {
		 		isotopeType = 'masonry';
		 	}
		 	
		 	itemGutter = $this.data('isotope-gutter');

			// Fires Layout when all images are loaded
			$this.imagesLoaded( function() {
				$this.show();

				// Isotope Init
				$this.isotope({
					transitionDuration: '.3s',
					layoutMode: isotopeType,
					masonry: {
						gutter: itemGutter
					},
				});

				if ( $this.hasClass('is-lightbox-gallery') ) {
					$this.isotope( 'on', 'layoutComplete', function() {
						setTimeout(function(){
							initSimpleLightbox();
						}, 0)
					});
				}

				$window.trigger('refreshisotope');
			});


			// Set the items width on resize
			// $window.on('resize refreshisotope', function (){
			$window.on('refreshisotope', function (){
				$this.startIsotope('refresh');
			});


        },
        setOptions : function(){

	        var $this = $(this);

			$this.imagesLoaded(function(){

				// SET ISOTOPE GUTTER AND SPACINGS
		 		$this.width($this.parent().width() + 1); 

		 		if( typeof($this.data('isotope-gutter')) != 'undefined' && $this.data('isotope-gutter') !== null && $this.data('isotope-gutter') != 0 ) {

		 			$this.css({
		 				'margin-right' : - itemGutter + 'px',
		 				'margin-top' : itemGutter + 'px',
		 			})

		 			$this.children().css({
		 				'margin-bottom' : itemGutter + 'px',
		 				'overflow' : 'hidden'
		 			})

		 		}

		 		// SET ISOTOPE COLUMNS

		 		var windowWidth = window.innerWidth;

		 		if ( windowWidth <= 478 ) {
		 			if(typeof $this.data('isotope-cols-xs') != 'undefined') {
		 				isotopeCols = $this.data('isotope-cols-xs');
		 			} else {
		 				isotopeCols = 1;
		 			}
		 		}
		 		else if ( windowWidth <= 767 ) {
		 			if(typeof $this.data('isotope-cols-xs') != 'undefined') {
		 				isotopeCols = $this.data('isotope-cols-xs');
		 			} else if(typeof $this.data('isotope-cols-sm') != 'undefined') {
		 				isotopeCols = $this.data('isotope-cols-sm');
		 			} else if ( $this.data('isotope-cols') == 1){
		 				isotopeCols = 1;
		 			} else {
		 				isotopeCols = 2;
		 			}
		 		} else if ( windowWidth < 992 ) {
		 			if(typeof $this.data('isotope-cols-sm') != 'undefined') {
		 				isotopeCols = $this.data('isotope-cols-sm');
		 			} else if ( $this.data('isotope-cols') > 2 ) {
		 				isotopeCols = $this.data('isotope-cols') - 1;
		 			} else {
		 				isotopeCols = $this.data('isotope-cols');
		 			}

		 		} else {
		 			if ( typeof $this.data('isotope-cols') == 'undefined' ) {
		 				isotopeCols = 3;
		 			} else {
		 				isotopeCols = $this.data('isotope-cols');
		 			}

		 		}

		 		if ( isotopeCols >= 2 ) {
		 			// $this.children().not('.isotope-item-width-2').css('width', Math.floor($this.width() / isotopeCols - itemGutter) + 'px' );
		 			$this.children().not('.isotope-item-width-2').css('width', Math.floor(($this.width() - (itemGutter * (isotopeCols - 1))) / isotopeCols) + 'px' );
		 			$this.children('.isotope-item-width-2').css('width', Math.floor(($this.width() / isotopeCols) * 2 - 2) + 'px' );
		 		} else {
		 			$this.children().css('width', $this.width() / isotopeCols - 1 + 'px' );
		 		}

		 		if( $this.data('isotope-square') == true ) {
		 			var itemsHeight = $this.children().not('.isotope-item-width-2').width();
		 			$this.children().css('height', itemsHeight + 'px' );
		 		}

		 		if ( $this.find('.is-aspectratio').length > 0 ) {

		 			var elWidth = $this.find('.is-aspectratio').width();

		 			$this.find('.is-aspectratio').each(function(){
			 			var $el = $(this);
			 			var height = 0;
			 			var landscapeHeight = 0;

			 			if ( $el.hasClass('ar_4_3') ) {
			 				height = elWidth / 1.333 ;
			 			}
			 			if ( $el.hasClass('ar_1_1') ) {
			 				height = elWidth;
			 			}
			 			if ( $el.hasClass('ar_3_2') ) {
			 				height = elWidth / 1.5;
			 			}
			 			if ( $el.hasClass('ar_16_9') ) {
			 				height = elWidth / 1.777;
			 			}
			 			if ( $el.hasClass('ar_3_1') ) {
			 				height = elWidth / 3 ;
			 			}

			 			if ( $el.hasClass('ar_3_4') ) {
			 				height = elWidth / 0.75;
			 			}
			 			if ( $el.hasClass('ar_2_3') ) {
			 				height = elWidth / 0.666;
			 			}
			 			if ( $el.hasClass('ar_9_16') ) {
			 				height = elWidth / 0.5625;
			 			}
			 			if ( $el.hasClass('ar_1_3') ) {
			 				height = elWidth / 0.333;
			 			}

			 			// searches if there are landcape items
			 			landscapeHeight = $this.find('.is-autox-landscape').height();

			 			// checks if the current item is portrait
			 			if ( $el.hasClass('is-autox-portrait') ) {
			 				// if landscapeHeight is greater than 0, it means that there is at least one landscape image
			 				if ( landscapeHeight > 0 ) {
			 					//
			 					// tuk moje bi trqbva da se promeni na:
			 					// $el.height(Math.floor(height + $this.data('isotope-gutter')));	
			 					// poneje dva puti zavurta isotope, vtoriqt pyt sa tochno ichisleni height-a na tozi element, no ne i na landscape elementa
			 					$el.height(Math.floor(landscapeHeight*2 + $this.data('isotope-gutter')));	
			 				} else {
			 					$el.height(Math.floor(height));	
			 				}

			 			} else {
			 				$el.height(Math.floor(height));
			 			}

			 		})
		 		}

			}) //imagesLoaded

	 	},
	 	refresh : function(){
 			var $this = $(this);
 			var windowWidth = window.innerWidth;

				$this.startIsotope('setOptions');

 				if ( $this.hasClass('is-isotope-match-height') ) {
 					if ( windowWidth <= 478 ) {
 						$this.find('.is-matchheight').matchHeight({
 							remove: true,
 						});
 					} else {
 						$this.find('.is-matchheight').matchHeight({
 							byRow: false,
 						});
 					}
 				}

 				setTimeout(function(){
 					$this.isotope('layout'); 					
 				}, 100)

	 	}
    };


	$.fn.startIsotope = function(methodOrOptions) {
		if ( startIsotopemethods[methodOrOptions] ) {
			return startIsotopemethods[ methodOrOptions ].apply( this, Array.prototype.slice.call( arguments, 1 ));
		} else if ( typeof methodOrOptions === 'object' || ! methodOrOptions ) {
	        // Default to "init"
	        return startIsotopemethods.init.apply( this, arguments );
	    } else {
	    	$.error( 'Method ' +  methodOrOptions + ' does not exist on jQuery.startIsotope' );
	    }    
	};


	var $isotopeContainer = $('.is-isotope');

	$isotopeContainer.each(function(){
		var $this = $(this);

		$this.wrap( "<div class='is-resize-sensor'></div>" );
		$this.startIsotope();
	})


	function ResizeSensorTriggerRefreshIsotope(){
		$window.trigger('refreshisotope');

		// setTimeout(function(){
		// 	$window.trigger('refreshisotope');
		// }, 200)
	}

	var triggerRefreshIsotope;

	new ResizeSensor(jQuery('.is-resize-sensor'), function(){
		clearTimeout(triggerRefreshIsotope);
		triggerRefreshIsotope = setTimeout(ResizeSensorTriggerRefreshIsotope, 300);
	});

	/**
	* ----------------------------------------------------------------------------------------
	*    Isotope Filter
	* ----------------------------------------------------------------------------------------
	*/

	$document.on('click', '.is-isotope-filter a', function(e){
		e.preventDefault();
		$footer.removeClass('footer-bottom');
		var $this = $(this);
		var data_target = $this.parents('.is-isotope-filter').data('target');
		var $target = $(data_target);
		var selector = $this.attr('data-filter');
		$this.parents('.is-isotope-filter').find('.selected').removeClass('selected');
		$this.parent('li').addClass('selected');

		$target.isotope({ filter: selector });
		transformFooter();

		return false;

	});

	if ( $('.is-isotope-filter').data('hide-show-all') == '1' ) {
		$('.is-isotope-filter li:first-child a').trigger('click');
	}


	// Slicknav
	
	$('.is-slicknav').each(function(){
		var $this = $(this);
		var $color = $this.data('navigation-color');
		$this.find('.is-slicknav-navigation').slicknav({
			label: '',
			init: function(){
				var $logo = $('.is-slicknav-logo').clone();
				$('.slicknav_menu').prepend($logo);
				$('.slicknav_menu').addClass($color);
				$logo.removeClass('main-navigation-logo').addClass('slicknav_menu_logo');
				$('.slicknav_menu').addClass('font-subheading');
				$('.slicknav_menu .is-block-hover').removeClass('is-block-hover');
			}
		})
	})
	

	/**
	* ----------------------------------------------------------------------------------------
	*    Overlay Navigation Menu
	* ----------------------------------------------------------------------------------------
	*/

	var	$navTrigger = $('.is-trigger-overlay');
	var	$navOverlay = $('.is-nav-overlay');

	function navToggleOverlay() {
		var $this = $(this);

		$navTrigger.toggleClass('nav-overlay-is-open');

		if( $navOverlay.hasClass('nav-overlay-is-open' ) ) {
			$navOverlay.removeClass( 'nav-overlay-is-open' );
			$mainContent.removeClass( 'overlay-open' );
			$navOverlay.addClass( 'nav-overlay-is-closing' );
			$body.removeClass('overflow-h');
			var onEndTransitionFn = function( ev ) {
				$(this).unbind( 'transitionend webkitTransitionEnd oTransitionEnd', onEndTransitionFn );
				$navOverlay.removeClass( 'nav-overlay-is-closing' );
			};
			$navOverlay.on( 'transitionend webkitTransitionEnd oTransitionEnd', onEndTransitionFn );
		}
		else if( !$navOverlay.hasClass('nav-overlay-is-closing' ) ) {
			$navOverlay.addClass( 'nav-overlay-is-open' );
			$mainContent.addClass( 'overlay-open' );
		}
	}

	$navTrigger.on( 'click', navToggleOverlay );


	$navOverlay.on('click', function(e) {

		var $this = $(this);

		// if clicked on the link and it has "sub-menu-expanded" classes (only way to have it is if touched before that on mobile)
		if ( !$(e.target).hasClass('sub-menu-expanded') && !$(e.target).parents('.sub-menu-expanded').length > 0 ) {
			$this.find('.sub-menu-expanded').removeClass('sub-menu-expanded');
		}

		//if clicked outside the nav menu items
		if (e.target.id != 'main-navigation-menu' && $(e.target).parents('#main-navigation-menu').length == 0) {
			navToggleOverlay();
		}
	});

	function autoScrollText($text){

		var delay = 1500;
		var distance = $text.width() - $text.closest('li').width() + 20;
		var duration = distance / 21 < 2 ? 2 : distance / 21; // sets minimum value for duration to be 2

		if ( $text.parents('.sub-menu').siblings('.sub-menu-expanded').length > 0 ) {
			setTimeout(function(){
				$text.css({
					'-webkit-transition' : duration + 's',
					'transition' : duration + 's',
					'-webkit-transform' : 'translateX(-' + distance + 'px)',
					'transform' : 'translateX(-' + distance + 'px)'
				});
			}, delay)
			
			setTimeout(function(){ 
				$text.css({
					'-webkit-transition' : duration + 's',
					'transition' : duration + 's',
					'-webkit-transform' : 'translateX(0px)',
					'transform' : 'translateX(0px)'
				});
			}, duration  * 1000 + delay );
			
			setTimeout(function(){ 
				autoScrollText($text);
			}, duration  * 1000 * 2 + delay);
		}


	}


	$navOverlay.find('ul li a').on('touchstart', function(e){

		var $this = $(this);

		if ( $this.next('.sub-menu').length > 0 && !$this.hasClass('sub-menu-expanded') ) {
			e.preventDefault();
			$this.addClass('sub-menu-expanded');

			$this.siblings('.sub-menu').find('a span').each(function(){
				var $span = $(this);

				if ( $span.width() > $span.closest('li').width() + 20 ) {
					autoScrollText($span);		
				}
			})

		}
	})

	

	/**
	* ----------------------------------------------------------------------------------------
	*    Perfect Scrollbar
	* ----------------------------------------------------------------------------------------
	*/

	var $perfectScrollbars = '';

	function initPerfectScrollbar(){

		if ($perfectScrollbars != '') {
			$perfectScrollbars.perfectScrollbar('destroy');
		}

		$perfectScrollbars = $('.is-perfect-scrollbar');

		$perfectScrollbars.perfectScrollbar({
			minScrollbarLength: 25,
			maxScrollbarLength: 25,
			scrollYMarginOffset: 0,
			suppressScrollX: true
		});

		$('.is-perfect-scrollbar:not(.vertical-shift-content)').each(function(){

			var $this = $(this);
			var bgColor = $this.getParentBG();
			if ( bgColor) {

				var bgColorHex = hexc(bgColor);
				if (!bgColorHex) {
					return;
				}
				if ( isColorDark(bgColorHex) ) {
					$this.find('.ps-scrollbar-y').css('border-color', '#fff');
					$this.find('.ps-scrollbar-y-rail').css('border-left', '3px solid #fff');
				} else {
					$this.find('.ps-scrollbar-y').css('border-color', '#000');
					$this.find('.ps-scrollbar-y-rail').css('border-left', '3px solid #000');
				}
			}
		})

		$('.is-perfect-scrollbar').each(function(){

			var $this = $(this);
			var bgColor = $this.getParentBG();

			if ( bgColor) {
				$this.find('.ps-scrollbar-y').css('background-color', bgColor);
			}
		})

	}

	initPerfectScrollbar();

	$window.on('throttledresize',function(){
		$('.is-perfect-scrollbar').perfectScrollbar('update');	
	});

	/**
	* ----------------------------------------------------------------------------------------
	*    Navigation Menu
	* ----------------------------------------------------------------------------------------
	*/


	var $navOffset = $('.is-nav-offset');
	var $socialNavOffset = $('.is-social-nav-offset')
	var $navHorizontal = $('.main-navigation-container-horizontal');
	var currentScrollTop = $window.scrollTop();
	var lastScrollTop = 0;

	function stickyNav() {
		var delta = 5;
		var windowWidth = window.innerWidth;
		var navStickyHeight = $navSticky.innerHeight();

		if ( $('.slicknav_menu').is(':visible') && $('.is-mobile-fullscreen').length == 0 ) {
			$navOffset.css('padding-top', $('.is-slicknav-logo').innerHeight());
		} else {
			$navOffset.css('padding-top', '0');
		}

		// Navigation Social Icons Position
		if ( $('.slicknav_menu').is(':visible') ) {
			if ( $socialNavOffset.length != 0 ) {
				$socialNavOffset.css('top', $('.is-slicknav-logo').innerHeight() + 10);
			}
		} else {
			if ( $socialNavOffset.length != 0 ) {
				$socialNavOffset.css('top', '');
			}
		}

		if ( Math.abs(lastScrollTop - currentScrollTop) <= delta || !$navSticky.is(':visible')) {
			return;
		}
		
		if ( currentScrollTop > lastScrollTop && currentScrollTop > navStickyHeight && $navSticky.find('.nav-overlay-is-open').length != 1 ) {
			$navSticky.removeClass('nav-down').addClass('nav-up');
		} 
		else if ( currentScrollTop + $window.height() < $document.height() ) {
			$navSticky.removeClass('nav-up').addClass('nav-down');
		}
	}

	stickyNav();

	$window.on('scroll', function(e){
		setTimeout(function(){
			currentScrollTop = $(this).scrollTop();
			stickyNav();
			lastScrollTop = currentScrollTop;
		}, 340);
	});
	$window.on('resize', function(e){
		currentScrollTop = $(this).scrollTop();
		stickyNav();
		lastScrollTop = currentScrollTop;
	});

	/**
	* ----------------------------------------------------------------------------------------
	*    Transform Footer
	* ----------------------------------------------------------------------------------------
	*/

	function transformFooter(){
		
		$footer.removeClass('footer-bottom');

		if ( ($body.height() > $window.height() && !$body.hasClass('page-template-template-curtain') ) || 
			( $body.hasClass('page-template-template-curtain') && window.innerWidth < 1200 ) ) {

			$footer.addClass('footer-bottom');
		
		} else {
			$footer.removeClass('footer-bottom');
		}

	}

	transformFooter();
	
	$window.on('throttledresize refreshisotope', function(e){
		transformFooter();
	});


	/**
	* ----------------------------------------------------------------------------------------
	*    Parallax
	* ----------------------------------------------------------------------------------------
	*/

	function parallaxScroll(){
		var windowWidth = window.innerWidth;

		if ( windowWidth < 992 || isMobile ) {
			$('.is-parallax').each(function(){
				var $this = $(this);
				$this.css('background-position', '');
			});
			$('.is-floating').each(function(){
				var $this = $(this);
				$this.css({
					'-webkit-transform' : '',
					'-ms-transform' : '',
					'transform' : ''
				});
			});
			return;
		}

		var docViewTop = $window.scrollTop();
		var docViewBottom = docViewTop + $window.height();

		$('.is-parallax').each(function(){
			var $this = $(this);

			var top = 0;
			top = docViewBottom - $this.offset().top;

			if ( $this.offset().top <= $window.scrollTop() + $window.height() + 200 ) {
				$this.css('background-position', 'left 50% ' + 'top ' + ( 110 - top * 0.08) + '%');
			} else {
				$this.css('background-position', 'left 50% top 100%');
			}		

		})

		$('.is-floating').each(function(){
			var $this = $(this);
			var top = 0;
			if ( $this.inView() ) {
				top = docViewBottom - $this.offset().top;
				var translateY = 100 - (top * 0.18);
				$this.css({
					'-webkit-transform' : 'translateY(' + translateY + 'px)',
					'-ms-transform' : 'translateY(' + translateY + 'px)',
					'transform' : 'translateY(' + translateY + 'px)'
				});
			}
		})
	}

	parallaxScroll();

	$window.on('scroll throttledresize', function(e){
		parallaxScroll();
	});


	/**
	* ----------------------------------------------------------------------------------------
	*    Portfolio Load More
	* ----------------------------------------------------------------------------------------
	*/

	var portfolioPaged = 1;

	function portfolioLoadMore($target){

		$target.addClass('load-more-disabled');
		portfolioPaged++;

		var $spinner = $('<div class="LoadMoreIcon"><i class="fa fa-circle-o-notch fa-spin"></i></div>');
		$target.after($spinner);
		
		var ajax_data = {
			nonce: vivian.nonce,
			paged: portfolioPaged,
			load_more: true
		}

		$.post(document.URL, ajax_data, function(data){

			var data_markup = $(data);

			$spinner.hide();
			
			if( data_markup.find('.is-load-more-result').children().length ) {

				var $result = $(data_markup.find('.is-load-more-result').children());

				$target.append($result).isotope('appended', $result);

				$target.imagesLoaded(function(){

					$window.trigger('refreshisotope');

					setTimeout(function(){
						$target.find('.opacity-0').removeClass('opacity-0');
					}, 600);
				})


				if ( !data_markup.find('.is-load-more-result').data('last-page') ) {					
					$target.removeClass('load-more-disabled');
				}

			}

		});
	}

	function inViewPortfolioBottom() {
		$('.is-portfolio-load-more').not('.load-more-disabled').each(function(){
			var $this = $(this);
			if ( $window.height() + $window.scrollTop() >= $this.offset().top + $this.height() - 100 ) {
				portfolioLoadMore($this);
			}
		})
	}

	inViewPortfolioBottom();

	$window.on('throttledresize refreshisotope scroll', function(){
		inViewPortfolioBottom();
	});


	/**
	* ----------------------------------------------------------------------------------------
	*    Blog Load More
	* ----------------------------------------------------------------------------------------
	*/

	var blogPaged = 1;

	function blogLoadMore($button) {

		blogPaged++;
		
		var $spinner = $('<div class="LoadMoreIcon"><i class="fa fa-circle-o-notch fa-spin"></i></div>');
		$button.after($spinner);
		$button.hide();

		var ajax_data = {
			nonce: vivian.nonce,
			paged: blogPaged,
			load_more: true
		}

		$.post(document.URL, ajax_data, function(data){

			var data_markup = $(data);
			var $ajaxIsotope = $('.is-blog-ajax-content');
			var $result;

			$spinner.hide();

			if ( data_markup.find('.is-load-more-result').children().length ) {
				$result = $(data_markup.find('.is-load-more-result').children());
			} else if ( data_markup.siblings('.is-load-more-result').children().length ) {
				$result = $(data_markup.siblings('.is-load-more-result').children());
			}

			if( $result ) {

				if ( $('.BlogGrid').length > 0 ) {
					$ajaxIsotope.append($result).isotope('appended', $result);
				} else if ( $('.swiper-wrapper.is-blog-ajax-content').length > 0 ) {
					mySwiperFullscreen.appendSlide($result);
					mySwiperFullscreen.slideNext();
				} else {
					$('.BlogLoadMore').before($result);
				}

				$('.is-blog-ajax-content').imagesLoaded(function(){
					$window.trigger('refreshisotope');

					$('.is-blog-ajax-content').find('.Excerpt.opacity-0').removeClass('opacity-0');

				})

				if ( data_markup.find('.is-load-more-result').data('last-page') || data_markup.siblings('.is-load-more-result').data('last-page') ) {
					$button.hide();
					$swiperSliderFullscreen.addClass('is-last-page');
				}
				else {
					$button.show();
					$button.trigger('mouseleave');
				}

				checkLastPost($swiperSliderFullscreen);
				loadParallax();

			} else {
				$button.hide();
			}

		});

	}

	$('.is-blog-load-more').on('click', function(e){
		e.preventDefault();
		blogLoadMore($(this));
	})


	/**
	* ----------------------------------------------------------------------------------------
	*    Check Last Post
	* ----------------------------------------------------------------------------------------
	*/

	function checkLastPost($target){
		if ( $target.find('.ExcerptFullscreen').length > 0 ) {
			var $activeSlide = $target.find('.swiper-slide-active');
			var $nextSlidesCount = $activeSlide.nextAll().length;
			if ( $nextSlidesCount == ($target.data('items') - 1) && !$target.hasClass('is-last-page') ) {
				$target.find('.swiper-content-next').css('display', 'none');
				$target.find('.is-blog-load-more').css('display', 'inline-block');
			} else {
				$target.find('.swiper-content-next').css('display', 'inline-block');
				$target.find('.is-blog-load-more').css('display', 'none');
			}
		}
		else {
			return;
		}
	}


	/**
	* ----------------------------------------------------------------------------------------
	*    Simple Lightbox
	* ----------------------------------------------------------------------------------------
	*/

	var $lightboxes = '';

	var lightbox = [];
	var $lightboxImages = '';

	function initSimpleLightbox(){

		var arrayLength = lightbox.length;
		for (var i = 0; i < arrayLength; i++) {
			lightbox[i].destroy();
		}

		$('.is-lightbox-gallery').each(function(){
			var $this = $(this);
			$lightboxImages = $this.find('*:visible a');

			lightbox.push(new $.SimpleLightbox({
				$items: $lightboxImages,
				nextBtnClass: ' arrow-right',
				prevBtnClass: ' arrow-left',
				prevBtnCaption: '',
				nextBtnCaption: '',
				videoRegex: new RegExp(/youtube.com|vimeo.com|.ogv|.mp4|.webm/),
			}));

		});

	}
	
	setTimeout(function(){
		initSimpleLightbox();
	}, 100)


	/**
	* ----------------------------------------------------------------------------------------
	*    Swiper Slider
	* ----------------------------------------------------------------------------------------
	*/

	var $paginationType = $('.swiper-pagination');
	var $swiperSliderFullscreen = $('.is-swiper-container-fullscreen');
	var $swiperSliderPortfolio = $('.is-swiper-container-portfolio');
	var $swiperSliderFixed = $('.is-swiper-container-fixed');
	var $swiperMobileItems = $swiperSliderFullscreen.data('items');
	var $swiperTabletItems = $swiperMobileItems;
	if ( $swiperMobileItems != 'auto' ) {
		$swiperTabletItems = Math.ceil($swiperMobileItems / 2);
		$swiperMobileItems = 1;
	}
	var swiperOptions = {
		speed: 800,
		parallax: true,
		// Optional parameters
		autoplay: $swiperSliderFullscreen.data('speed'),
		direction: $swiperSliderFullscreen.data('direction'),
		loop: $swiperSliderFullscreen.data('enable-loop'),
		slidesPerView: $swiperSliderFullscreen.data('items'),
		spaceBetween: $swiperSliderFullscreen.data('space-between'),
		loopedSlides: $swiperSliderFullscreen.data('slides-count'),
		// If we need pagination
		pagination: '.swiper-pagination',
		paginationType: $paginationType.data('pagination'),
		paginationFractionRender: function (swiper, currentClassName, totalClassName) {
			return '<span class="' + currentClassName + '"></span>' +
			'<span class="swiper-pagination-divider"></span>' +
			'<span class="' + totalClassName + '"></span>';
		},
		paginationClickable: true,
		nextButton: '.swiper-content-next',
		prevButton: '.swiper-content-prev',
		keyboardControl: true,
		mousewheelControl: $swiperSliderFullscreen.data('mousewheel'),
		breakpoints: {
			// when window width is <= 991px
			991: {
				slidesPerView: $swiperTabletItems,
				spaceBetween: $swiperSliderFullscreen.data('space-between') / 2,
			},
			// when window width is <= 767px
			767: {
				slidesPerView: $swiperMobileItems,
				spaceBetween: 0,
			},
		},
		'onInit': function(Swiper){
			$swiperSliderFullscreen.find('.swiper-slide-active').activateAnimations();
			if ( $swiperSliderFullscreen.data('direction') == 'vertical' || $swiperSliderFullscreen.data('items') == '1' ) {
				createBackgroundSegments();
			}
			checkLastPost($swiperSliderFullscreen);
		},
		'onTransitionEnd': function(Swiper){
			$swiperSliderFullscreen.find('.swiper-slide-active').activateAnimations();
			$swiperSliderFullscreen.find('.swiper-slide:not(.swiper-slide-active)').resetAnimations();
			checkLastPost($swiperSliderFullscreen);
			if ( $swiperSliderFullscreen.data('items') == '1' || $swiperSliderFullscreen.data('direction') == 'vertical' ) {
				createBackgroundSegments();
				removeBackgroundSegments();
			}

		},
		
	}

	var mySwiperFullscreen = new Swiper ($swiperSliderFullscreen, swiperOptions);
	var mySwiperFixed = new Swiper ($swiperSliderFixed, {
		speed: 800,
		// Optional parameters
		loop: true,
		// If we need pagination
		pagination: '.swiper-pagination',
		paginationClickable: true,
		keyboardControl: true,
		nextButton: '.arrow-right',
		prevButton: '.arrow-left',
		'onInit' : function(swiper){
			setTimeout(function(){
				initSimpleLightbox();
			}, 0)
		},
	});
	var mySwiperPortfolio = new Swiper ($swiperSliderPortfolio, {
		speed: 800,
		// Optional parameters
		loop: true,
		autoHeight: true,
		autoplay: $swiperSliderPortfolio.data('speed'),
		// If we need pagination
		pagination: '.swiper-pagination',
		paginationClickable: true,
		nextButton: '.arrow-right',
		prevButton: '.arrow-left',
		'onInit' : function(swiper){
			setTimeout(function(){
				initSimpleLightbox();
			}, 0)
		},
	});

	if ( $swiperSliderFullscreen.data('direction') == 'horizontal' && $swiperSliderFullscreen.data('enable-loop') && $swiperSliderFullscreen.data('items') == 'auto' ) {
		setTimeout(function(){
			mySwiperFullscreen.slideTo(0, 0);
			mySwiperFullscreen.update(true);
			if ( $swiperSliderFullscreen.data('speed') > 0 ) {
				mySwiperFullscreen.startAutoplay();
			}
		}, 10);
	}


	/**
	* ----------------------------------------------------------------------------------------
	*    Vertical Shift
	* ----------------------------------------------------------------------------------------
	*/

	var $swiperSliderHalfLeft = $('.vertical-shift-left > *');
	var $swiperSliderHalfRight = $('.vertical-shift-right > *');

	var enableScrollFlag = true;

	var mySwiperSliderHalfLeft = undefined;
	var mySwiperSliderHalfRight = undefined;

	var verticalShiftInizialized = false;

	function initVerticalShift() {
		if ( window.innerWidth < 992 ) {
			if ( typeof mySwiperSliderHalfLeft != 'undefined' ) {
				mySwiperSliderHalfLeft.destroy(true, true);
				mySwiperSliderHalfLeft = undefined;
			}

			if ( typeof mySwiperSliderHalfRight != 'undefined' ) {
				mySwiperSliderHalfRight.destroy(true, true);
				mySwiperSliderHalfRight = undefined;
			}

			verticalShiftInizialized = false
		} else if ( verticalShiftInizialized == false ) {
			mySwiperSliderHalfLeft = new Swiper ($swiperSliderHalfLeft, {
				speed: 1100,
				autoplay: $swiperSliderHalfLeft.data('speed'),
				direction: 'vertical',
				loop: false,
				mousewheelControl: false,
				paginationType: $('.swiper-pagination').data('pagination'),
				paginationFractionRender: function (swiper, currentClassName, totalClassName) {
					return '<span class="' + currentClassName + '"></span>' +
					'<span class="swiper-pagination-divider"></span>' +
					'<span class="' + totalClassName + '"></span>';
				},
				pagination: '.swiper-pagination',
				paginationClickable: true, 
				keyboardControl: false,
				simulateTouch: true,
				parallax: true,
				'onInit' : function(swiper) {
					$swiperSliderHalfLeft.find('.swiper-slide-active').activateAnimations();
					$swiperSliderHalfLeft.find('.swiper-slide:not(.swiper-slide-active)').resetAnimations();
				},
				'onTransitionStart' : function(swiper) {
					enableScrollFlag = false;
				},
				'onTransitionEnd' : function(swiper) {
					enableScrollFlag = true;

					$swiperSliderHalfLeft.find('.swiper-slide-active').activateAnimations();
					$swiperSliderHalfLeft.find('.swiper-slide:not(.swiper-slide-active)').resetAnimations();
				},
				'onSetTranslate' : function(swiper, translate) {
					if ( typeof mySwiperSliderHalfRight != 'undefined' ) {
						if ( translate != 0 && Math.abs(translate) % mySwiperSliderHalfRight.height != 0 ) {
							var rightSliderHeight = mySwiperSliderHalfRight.height * (mySwiperSliderHalfRight.slides.length - 1 );

							mySwiperSliderHalfRight.setWrapperTranslate( - rightSliderHeight - translate, 0, 0);
						} else {
							mySwiperSliderHalfRight.slideTo(swiper.slides.length - swiper.activeIndex - 1);
						}
					}

					
				},
			});

			mySwiperSliderHalfRight = new Swiper ($swiperSliderHalfRight, {
				speed: 1100,
				direction: 'vertical',
				loop: false,
				mousewheelControl: false,
				pagination: null,
				keyboardControl: false,
				// simulateTouch: false,
				parallax: true,
				'onInit' : function(swiper){
					swiper.slideTo(swiper.slides.length, 0);
					swiper.disableTouchControl();
				},
				'onTransitionEnd' : function() {
					$swiperSliderHalfRight.find('.swiper-slide-active').activateAnimations();
					$swiperSliderHalfRight.find('.swiper-slide:not(.swiper-slide-active)').resetAnimations();
				}
			});

			verticalShiftInizialized = true;
		}

	}


	$window.on('mousewheel DOMMouseScroll', function(event){

		if( typeof mySwiperSliderHalfLeft == 'undefined' || typeof mySwiperSliderHalfRight == 'undefined') return;

		if ( enableScrollFlag ) {
			if ( event.originalEvent.detail < 0 || event.originalEvent.wheelDelta > 0 ) { // scroll up
				mySwiperSliderHalfLeft.slidePrev(true);
			} else {  // scroll down
				mySwiperSliderHalfLeft.slideNext(true);
			}	
		}	
	});

	if ( $('.swiper-container-vertical-shift').length > 0 ) {
		initVerticalShift();
	}

	$window.on('throttledresize',function(){
		if ( $('.swiper-container-vertical-shift').length > 0 ) {
			initVerticalShift();
		}
	});

	/**
	* ----------------------------------------------------------------------------------------
	*    Fullscreen Slider Gallery Info Button
	* ----------------------------------------------------------------------------------------
	*/

	$('.is-mobile-info-btn').on('touchstart touchend', function(e) {
		//e.preventDefault();
		if ( $(this).hasClass('text-expanded') ) {
			$(this).removeClass('text-expanded');
		} else {
			$(this).addClass('text-expanded');
		}
	});

	/**
	* ----------------------------------------------------------------------------------------
	*    ` Content
	* ----------------------------------------------------------------------------------------
	*/
	
	var $swiperSlidingContentImages = $('.is-swiper-sliding-content-image');
	var $swiperSlidingContentText = $('.is-swiper-sliding-content-text');

	var mySwiperSlidingContentImages = undefined;
	var mySwiperSlidingContentText = undefined;

	function initSlidingContent(){
		if ( window.innerWidth < 992 ) {
			if ( typeof mySwiperSlidingContentImages != 'undefined' ) {
				mySwiperSlidingContentImages.destroy(true, true);
				mySwiperSlidingContentImages = undefined;
			}

			if ( typeof mySwiperSlidingContentText != 'undefined' ) {
				mySwiperSlidingContentText.destroy(true, true);
				mySwiperSlidingContentText = undefined;
			}

		} else {

			if ( typeof mySwiperSlidingContentImages == 'undefined' ) {
				mySwiperSlidingContentImages = new Swiper($swiperSlidingContentImages, {
					speed: 700,
					loop: true,
					mousewheelControl: true,
					keyboardControl: true,
					simulateTouch: false,
					parallax: true,
					nextButton: '.swiper-content-next',
					prevButton: '.swiper-content-prev',
					pagination: '.swiper-pagination',
					paginationType: 'fraction',
					paginationFractionRender: function (swiper, currentClassName, totalClassName) {
						return '<span class="' + currentClassName + '"></span>' +
						'<span class="swiper-pagination-divider"></span>' +
						'<span class="' + totalClassName + '"></span>';
					},
					'onSlideNextStart' : function(swiper) {
						if ( typeof mySwiperSlidingContentText != 'undefined' ) {
							mySwiperSlidingContentText.slideNext();
						}
					},
					'onSlidePrevStart' : function(swiper) {
						if ( typeof mySwiperSlidingContentText != 'undefined' ) {
							mySwiperSlidingContentText.slidePrev();
						}
					},
					'onTransitionEnd' : function() {
						setTimeout(function(){
							$swiperSlidingContentImages.find('.swiper-slide-active').activateAnimations();
							$swiperSlidingContentImages.find('.swiper-slide:not(.swiper-slide-active)').resetAnimations();
						}, 0)
					}
				}); 
			}

			if ( typeof mySwiperSlidingContentText == 'undefined' ) {
				mySwiperSlidingContentText = new Swiper($swiperSlidingContentText, {
					speed: 700,
					loop: true,
					mousewheelControl: false,
					keyboardControl: false,
					simulateTouch: false,
					loopedSlides: $swiperSlidingContentText.data('looped-slides'),
					effect: 'cube',
					cubeEffect: {
						shadow: false,
						slideShadows: false,
						shadowOffset: 20,
						shadowScale: 0
					},
					'onInit' : function() {
						setTimeout(function(){
							mySwiperSlidingContentText.disableTouchControl();
						}, 0)
					},
					'onTransitionEnd' : function() {
						initPerfectScrollbar();
						setTimeout(function(){
							$swiperSlidingContentText.find('.swiper-slide-active').activateAnimations();
							$swiperSlidingContentText.find('.swiper-slide:not(.swiper-slide-active)').resetAnimations();
						}, 0)
					}
				}); 
			}
			
		}
		
	}
	 

	if ( $('.SlidingContent').length > 0 ) {
		initSlidingContent();
	}

	$window.on('throttledresize',function(){
		if ( $('.SlidingContent').length > 0 ) {
			initSlidingContent();
		}
	});
	


	/**
	* ----------------------------------------------------------------------------------------
	*    Background Segments
	* ----------------------------------------------------------------------------------------
	*/

	var segmenter;
	var prevSlide = '';
	function removeBackgroundSegments() {
		if ( isMobile ) {
			return;
		}
		prevSlide = $( '.swiper-slide:not(.swiper-slide-active) .segmenter.has-segment-effect' );
		
		 if (prevSlide) {
		 	prevSlide.empty();
		 	prevSlide.removeClass('has-segment-effect');
		 }
	}

	function createBackgroundSegments() {
		var $preloader = $('.Preloader');
		if ( document.hasFocus() == false || initBgSegmentsFunction == true || isMobile || $preloader.length != 0 ) {
			return;
		}
		
		if ( $('.swiper-slide').length ) {
			segmenter = $( '.swiper-slide-active .segmenter:not(.has-segment-effect)' ).get(0);
		} else {
			segmenter = document.querySelector('.segmenter');
		}

		if (!segmenter) {
			clearInterval(checkFocusInterval);
			return;
		}

		var effectType = $(segmenter).data('effect');
		segmenter.classList.add('has-segment-effect');
		initBgSegmentsFunction = true;
		setTimeout(function() {
			switch(effectType) {
				case "effect-one":
					segmenter = new Segmenter(segmenter, {
						onReady: function() {
							segmenter.animate();
							initBgSegmentsFunction = false;
						}
					});
					break;
				case "effect-two":
					segmenter = new Segmenter(segmenter, {
						pieces: 4,
						animation: {
							duration: 1500,
							easing: 'easeInOutExpo',
							delay: 100,
							translateZ: 100
						},
						parallax: true,
						positions: [
						{top: 0, left: 0, width: 45, height: 45},
						{top: 55, left: 0, width: 45, height: 45},
						{top: 0, left: 55, width: 45, height: 45},
						{top: 55, left: 55, width: 45, height: 45}
						],
						onReady: function() {
							segmenter.animate();
							initBgSegmentsFunction = false;
						}
					});
					break;
				case "effect-three":
					segmenter = new Segmenter(segmenter, {
						pieces: 8,
						positions: [
						{top: 0, left: 0, width: 100, height: 100},
						{top: 0, left: 0, width: 100, height: 100},
						{top: 0, left: 0, width: 100, height: 100},
						{top: 0, left: 0, width: 100, height: 100},
						{top: 0, left: 0, width: 100, height: 100},
						{top: 0, left: 0, width: 100, height: 100},
						{top: 0, left: 0, width: 100, height: 100},
						{top: 0, left: 0, width: 100, height: 100}
						],
						shadows: false,
						parallax: true,
						parallaxMovement: {min: 10, max: 30},
						animation: {
							duration: 2500,
							easing: 'easeOutExpo',
							delay: 0,
							opacity: .1,
							translateZ: {min: 10, max: 25}
						},
						onReady: function() {
							segmenter.animate();
							initBgSegmentsFunction = false;
						}
					});
					break;
				case "effect-four":
					segmenter = new Segmenter(segmenter, {
						pieces: 9,
						positions: [
						{top: 30, left: 5, width: 40, height: 80},
						{top: 50, left: 25, width: 30, height: 30},
						{top: 5, left: 75, width: 40, height: 20},
						{top: 30, left: 45, width: 40, height: 20},
						{top: 45, left: 15, width: 50, height: 40},
						{top: 10, left: 40, width: 10, height: 20},
						{top: 20, left: 50, width: 30, height: 70},
						{top: 0, left: 10, width: 50, height: 60},
						{top: 70, left: 40, width: 30, height: 30}
						],
						animation: {
							duration: 2000,
							easing: 'easeInOutCubic',
							delay: 0,
							opacity: 1,
							translateZ: 85,
							translateX: {min: -20, max: 20},
							translateY: {min: -20, max: 20}
						},
						parallax: true,
						parallaxMovement: {min: 5, max: 10},
						onReady: function() {
							segmenter.animate();
							initBgSegmentsFunction = false;
						}
					});
					break;
				default:
					segmenter = new Segmenter(segmenter, {
						onReady: function() {
							segmenter.animate();
							initBgSegmentsFunction = false;
						}
					});
			}
		}, 300);
		clearInterval(checkFocusInterval);
	}

	var checkFocusInterval = setInterval(createBackgroundSegments, 1000);


	/**
	* ----------------------------------------------------------------------------------------
	*    Square Block
	* ----------------------------------------------------------------------------------------
	*/

	var $squareBlockSection = $('.SquareBlockSection');
	var $squareBlockGallery = $('.is-square-block-wrapper');
	var $foldingPanel = $('.is-folding-panel');
	var $foldContent = '';
	var $currentBlock = '';

	/* open folding content */
	$squareBlockGallery.on('click', 'a', function(event){
		var $this = $(this);
		if ($this.hasClass('is-square-block-link')) {
			$squareBlockGallery.addClass('is-clicked');
		} else {	
			event.preventDefault();
			$currentBlock = $this;
			openItemInfo($currentBlock);
		}
	});

	/* close folding content */
	$foldingPanel.on('click', '.is-square-block-close', function(event){
		event.preventDefault();
		toggleContent($currentBlock, false);
	});
	$squareBlockGallery.on('click', function(event){
		/* detect click on .square-block-wrapper::before when the .SquareBlockFoldingPanel is open */
		if($(event.target).is('.is-square-block-wrapper') && $('.fold-is-open').length > 0 ) toggleContent($currentBlock, false);
	})

	function openItemInfo(content) {
		/* check if mobile or desktop */
		var mq = squareBlocksMQ();
		if( $squareBlockGallery.offset().top > $window.scrollTop() && mq != 'mobile') {
			/* if content is visible above the .square-block-wrapper - scroll before opening the folding panel */
			$('body').animate({
				'scrollTop': $squareBlockGallery.offset().top
			}, 100, function(){ 
				toggleContent(content, true);
			});

		} else if( $squareBlockGallery.offset().top + $squareBlockGallery.height() < $window.scrollTop() + $window.height()  && mq != 'mobile' ) {
			/* if content is visible below the .square-block-wrapper - scroll before opening the folding panel */
			$('body').animate({
				'scrollTop': $squareBlockGallery.offset().top + $squareBlockGallery.height() - $window.height()
			}, 100, function(){ 
				toggleContent(content, true);
			});
		} else {
			toggleContent(content, true);
		}
	}

	function openFold(event){
		setTimeout(function(){
			$body.addClass('overflow-hidden');
			$foldingPanel.addClass('is-open');
			$squareBlockSection.addClass('fold-is-open');
		}, 100);
	};

	function toggleContent(content, bool) {
		if( bool ) {
			/* load and show new content */
			var foldingContent = $foldingPanel.find('.fold-content');
			foldingContent.html('');
			$currentBlock = content;
			$foldContent = $currentBlock.next('.block-fold-content').children()[0];
			console.log($currentBlock);
			console.log($foldContent);
			foldingContent.append($foldContent);
			openFold();
		} else {
			/* close the folding panel */
			if ( $currentBlock != '' && $foldContent != '' ) {
				// setTimeout(function(){
					$currentBlock.next('.block-fold-content').prepend($foldContent);
					$currentBlock = '';
					$foldContent = '';
				// }, 400);
			}
			var mq = squareBlocksMQ();
			$foldingPanel.removeClass('is-open');
			$squareBlockSection.removeClass('fold-is-open');
			
			if (mq == 'mobile' || $('.no-csstransitions').length > 0 ) {
				/* according to the mq, immediately remove the .overflow-hidden or wait for the end of the animation */
				$body.removeClass('overflow-hidden');
			} else {
				$squareBlockSection.find('.square-block-item').eq(0).one('webkitTransitionEnd otransitionend oTransitionEnd msTransitionEnd transitionend', function(){
					$body.removeClass('overflow-hidden');
					$squareBlockSection.find('.square-block-item').eq(0).off('webkitTransitionEnd otransitionend oTransitionEnd msTransitionEnd transitionend');
				});
			}

		}
	}

	function squareBlocksMQ() {
		/* retrieve the content value of .SquareBlockSection::before to check the actua mq */
		return window.getComputedStyle(document.querySelector('.SquareBlockSection'), '::before').getPropertyValue('content').replace(/"/g, "").replace(/'/g, "");
	}


	/**
	* ----------------------------------------------------------------------------------------
	*    Curtain
	* ----------------------------------------------------------------------------------------
	*/

	//change this value if you want to change the speed of the scale effect
	var	scaleSpeed = 0.3,
	//change this value if you want to set a different initial opacity for the .curtain-section-half-block
		boxShadowOpacityInitialValue = 0.7,
		curtainAnimating = false; 
	
	//check the media query 
	var MQ = window.getComputedStyle(document.querySelector('body'), '::before').getPropertyValue('content').replace(/"/g, "").replace(/'/g, "");
	$window.on('resize', function(){
		MQ = window.getComputedStyle(document.querySelector('body'), '::before').getPropertyValue('content').replace(/"/g, "").replace(/'/g, "");
	});

	//bind the animation to the window scroll event
	triggerCurtainAnimation();
	$window.on('scroll', function(){
		triggerCurtainAnimation();
		autoCorrectBlocks();
	});

	//move to next/previous section
    $document.keydown(function(event){
		if( event.which == '38' ) {
			prevSection();
			event.preventDefault();
		} else if( event.which == '40' ) {
			nextSection();
			event.preventDefault();
		}
	});

	function triggerCurtainAnimation(){
		if(MQ == 'desktop') {
			//if on desktop screen - animate sections
			(!window.requestAnimationFrame) ? animateSection() : window.requestAnimationFrame(animateSection);	

		} else {
			//on mobile - remove the style added by jQuery 
			$('.is-curtain-section').find('.curtain-section-block').removeAttr('style').find('.curtain-section-half-block').removeAttr('style');
		}
	}

	
	function animateSection () {
		var scrollTop = Math.ceil($window.scrollTop()),
			windowHeight = Math.ceil($window.height()),
			windowWidth = Math.ceil($window.width());

		var blockNumber = 0;

		$('.is-curtain-section').eq(0).addClass('is-visible');
		
		$('.is-curtain-section').each(function(){

			var actualBlock = $(this),
				offset = Math.ceil(scrollTop - Math.ceil(actualBlock.offset().top)),
				scale = 1,
				translate = windowWidth/2+'px',
				opacity,
				boxShadowOpacity;

			blockNumber++;

			if( offset >= -windowHeight && offset <= 0 ) {
				//move the two .curtain-section-half-block toward the center - no scale/opacity effect
				scale = 1,
				opacity = 1,
				translate = (windowWidth * 0.5 * (- offset/windowHeight)).toFixed(0)+'px';

			} else if( offset > 0 && offset <= windowHeight ) {
				//the two .curtain-section-half-block are in the center - scale the .curtain-section-block element and reduce the opacity
				translate = 0+'px',
				scale = (1 - ( offset * scaleSpeed/windowHeight)).toFixed(5),
				opacity = ( 1 - ( offset/windowHeight) ).toFixed(5);

			} else if( offset < -windowHeight ) {
				//section not yet visible
				scale = 1,
				translate = windowWidth/2+'px',
				opacity = 1;

			} else {
				//section not visible anymore
				opacity = 0;
			}
			
			boxShadowOpacity = parseInt(translate.replace('px', ''))*boxShadowOpacityInitialValue/20;
			
			//translate/scale section blocks
			scaleBlock(actualBlock.find('.curtain-section-block'), scale, opacity);

			var directionFirstChild = '-';
			var directionSecondChild = '+';

			if( blockNumber == 1 && parseInt(directionFirstChild+translate) > 0 && parseInt(directionSecondChild+translate) < 0 ) {
				translateBlock(actualBlock.find('.curtain-section-half-block').eq(0), '0', boxShadowOpacity);
				translateBlock(actualBlock.find('.curtain-section-half-block').eq(1), '0', boxShadowOpacity);
			} else if(actualBlock.find('.curtain-section-half-block')) {
				translateBlock(actualBlock.find('.curtain-section-half-block').eq(0), directionFirstChild+translate, boxShadowOpacity);
				translateBlock(actualBlock.find('.curtain-section-half-block').eq(1), directionSecondChild+translate, boxShadowOpacity);
			}

			//this is used to navigate through the sections
			if ( offset >= 0 && offset < windowHeight ) {
				$('.is-curtain-section.is-visible').removeClass('is-visible');
				actualBlock.addClass('is-visible');
			}

			$('.is-perfect-scrollbar').perfectScrollbar('update');	

		});
	}

	var autoScrollTimer;

	function autoCorrectBlocks(){

		if(MQ != 'desktop') {
			return;
		}

		var windowWidth = Math.ceil($window.width());
		var $currentBlock = $('.is-curtain-section.is-visible').find('.curtain-section-half-block').eq(0);
		var $nextBlock = $('.is-curtain-section.is-visible').next().find('.curtain-section-half-block').eq(0);

		if ( $nextBlock.length > 0 ) {

			clearTimeout(autoScrollTimer);

			autoScrollTimer = setTimeout(function(){
				
				var matrix = $nextBlock.eq(0).css('transform');

				if ( matrix ) {
					var values = matrix.match(/-?[\d\.]+/g);
					var x = values[4];

					if ( Math.abs(x) > 0 && Math.abs(x) < windowWidth / 4 ) {

						clearTimeout(autoScrollTimer);

						autoScrollTimer = setTimeout(function(){
							if ( !disableCurtainAutocorrect ) {
								nextSection();
							}
						}, 150);

					}

					if ( Math.abs(x) < windowWidth / 2 && Math.abs(x) > windowWidth / 4 ) {

						clearTimeout(autoScrollTimer);

						autoScrollTimer = setTimeout(function(){
							if ( !disableCurtainAutocorrect ) {
								prevSection();
							}
						}, 150);

					}

				}

			}, 200);
			
		}
	}

	function translateBlock(elem, value, shadow) {
		var position = Math.ceil(Math.abs(value.replace('px', '')));
		
		if( position >= Math.ceil($window.width())/2 ) {
			shadow = 0;	
		} else if ( position > 20 ) {
			shadow = boxShadowOpacityInitialValue;
		}

		elem.css({
			'-moz-transform': 'translateX(' + value + ')',
			'-webkit-transform': 'translateX(' + value + ')',
			'-ms-transform': 'translateX(' + value + ')',
			'-o-transform': 'translateX(' + value + ')',
			'transform': 'translateX(' + value + ')',
			'box-shadow' : '0px 0px 40px rgba(0,0,0,'+shadow+')'
		});
	}

	function scaleBlock(elem, value, opac) {
		elem.css({
		    '-moz-transform': 'scale(' + value + ')',
		    '-webkit-transform': 'scale(' + value + ')',
			'-ms-transform': 'scale(' + value + ')',
			'-o-transform': 'scale(' + value + ')',
			'transform': 'scale(' + value + ')',
			'opacity': opac
		});
	}


	function nextSection() {
		if (!curtainAnimating) {
			if ($('.is-curtain-section.is-visible').next().length > 0) smoothScroll($('.is-curtain-section.is-visible').next());
		}
	}

	function prevSection() {
		if (!curtainAnimating) {
			var currentSection = $('.is-curtain-section.is-visible');
			if( currentSection.length > 0 && Math.ceil($window.scrollTop()) != Math.ceil(currentSection.offset().top) ) {
				smoothScroll(currentSection);
			} else if( currentSection.prev().length > 0 && Math.ceil($window.scrollTop()) == Math.ceil(currentSection.offset().top) ) {
				smoothScroll(currentSection.prev('.is-curtain-section'));
			}
		}
	}

	function smoothScroll(target) {
		curtainAnimating = true;
        $('body,html').animate({'scrollTop': Math.ceil(target.offset().top)}, 500, function(){ curtainAnimating = false; });
	}


	function swapCurtainBlocks(target) {	
		var windowWidth = window.innerWidth;

		if ( windowWidth <= 1199 ) {
			$('.curtain-section-image').each(function(){
				var $this = $(this);
				var $prevEl = $this.prev()
				if ( $prevEl.hasClass('curtain-section-text') ) {
					$this.addClass('is-swapped');
					$this.insertBefore($prevEl);
				}
			})
		} else {
			$('.is-swapped').each(function(){
				var $this = $(this);
				var $nextEl = $this.next()
				if ( $nextEl.hasClass('curtain-section-text') ) {
					$this.removeClass('is-swapped');
					$nextEl.insertBefore($this);
				}
			})
			setTimeout(function(){
				autoCorrectBlocks();
			}, 0)
		}
		
	}

	swapCurtainBlocks();

	$window.on('resize', function(){
		swapCurtainBlocks();
	});


	// Used for the Curtain auto correct to not fire if the user has the mouse down
	var clickedOnScrollbar = function(mouseX){
		if( $(window).outerWidth() <= mouseX ){
			return true;
		}
	}
	
	var disableCurtainAutocorrect = false;

	$document.mousedown(function(e) {
		if ( e.which == 1 ) {
			if( clickedOnScrollbar(e.clientX) ){
				disableCurtainAutocorrect = true;
			}
		}
	}).mouseup(function(e) {
		if ( e.which == 1 ) {
			disableCurtainAutocorrect = false;
			autoCorrectBlocks();
		}	
	});

	$document.bind('mousewheel', function() {
		if (curtainAnimating ) {
	    	return false;
		}
	});


	/**
	* ----------------------------------------------------------------------------------------
	*    Post Share Buttons
	* ----------------------------------------------------------------------------------------
	*/

	$('.is-shareable .facebook').on('click', function(e){
		e.preventDefault();
		var postUrl = $(this).closest('.is-shareable').data('post-url');
		window.open('http://www.facebook.com/sharer.php?u=' + postUrl,'sharer','toolbar=0,status=0,width=626,height=436');
		return false;
	})

	$('.is-shareable .twitter').on('click', function(e){
		e.preventDefault();
		var postUrl = $(this).closest('.is-shareable').data('post-url');
		window.open('https://twitter.com/share?url=' + postUrl,'sharer','toolbar=0,status=0,width=626,height=436');
		return false;
	})

	$('.is-shareable .google-plus').on('click', function(e){
		e.preventDefault();
		var postUrl = $(this).closest('.is-shareable').data('post-url');
		window.open('https://plus.google.com/share?url=' + postUrl,'sharer','toolbar=0,status=0,width=626,height=436');
		return false;
	})

	$('.is-shareable .pinterest').on('click', function(e){
		e.preventDefault();
		var postUrl = $(this).closest('.is-shareable').data('post-url');
		var img = $('.SinglePostHeader .bg-image').data('bg-image');
		window.open('http://pinterest.com/pin/create/button/?url=' + postUrl + '&media=' + img,'sharer','toolbar=0,status=0,width=626,height=436');
		return false;
	})

	/**
	* ----------------------------------------------------------------------------------------
	*    Match Height
	* ----------------------------------------------------------------------------------------
	*/

	$('.is-matchheight').matchHeight({
		byRow: false
	});
	
	$('.is-matchheight-container .row, .is-matchheight-container .fw-row').each(function(){
		var $this = $(this);

		$this.find('[class^="fw-col-"], [class^="col-"]').matchHeight({
			byRow: false
		});
	})
		

	/**
	* ----------------------------------------------------------------------------------------
	*    Sticky Kit
	* ----------------------------------------------------------------------------------------
	*/

	var $stickyKit = $('.is-sticky-kit');

	var stickyKitDetached = true;

	function makeStatic($this) {
		$(this).parent().css('position', 'static');
	}

	function triggerStickyKit() {
		var windowWidth = window.innerWidth;

		if ( (windowWidth < 992 ) && !stickyKitDetached ) {
			$stickyKit.trigger("sticky_kit:detach");
			$stickyKit.off('sticky_kit:bottom', makeStatic());
			stickyKitDetached = true;
		} else if ( windowWidth >= 992 && stickyKitDetached ) {
			setTimeout(function(){
				$stickyKit.stick_in_parent();
				$stickyKit.on('sticky_kit:bottom', makeStatic());
				stickyKitDetached = false;
			}, 0)
		}
	}

	setTimeout(function(){
		if ( !isMobile ) {
			triggerStickyKit();
			$window.on('throttledresize', triggerStickyKit);
		}
	}, 0)


	/**
	* ----------------------------------------------------------------------------------------
	*    YTPlayer
	* ----------------------------------------------------------------------------------------
	*/

	var $ytPlayer = $(".is-ytplayer");

	$ytPlayer.YTPlayer();

	if ( isMobile ) {
		$('.FullscreenVideo .bg-color').hide();
		$ytPlayer.hide();
	} else {
		$('.FullscreenVideo .bg-color').show();
		$ytPlayer.show();
	}


	/**
	*  SVG Buttons
	*/

	var $rectButtons = $('.btn-svg');

	$rectButtons.each(function(){
		var $this = $(this);
		$this.find('rect').css({
			'stroke-dasharray'  : $(this).outerWidth() + ', ' + $(this).outerHeight(),
			'stroke-dashoffset' : 0,
			'-webkit-transition' : 'stroke-dashoffset 1s cubic-bezier(0.19, 1, 0.22, 1)',
			'transition' : 'stroke-dashoffset 1s cubic-bezier(0.19, 1, 0.22, 1)'
		})

	})

	$('.btn-svg').on('hover', function(){
			
			var $this = $(this);
			var hoveredRect = $this.find('rect');

			hoveredRect.css('stroke-dasharray', $this.outerHeight() + ', ' + $this.outerWidth());
			hoveredRect.css('stroke-dashoffset',  $this.outerWidth() + $this.outerHeight() + ( $this.outerHeight() / 2 ) );
		}
	)

	$('.btn-svg').on('mouseleave', function(){
			
			var $this = $(this);
			var hoveredRect = $this.find('rect');

			hoveredRect.css('stroke-dasharray', $this.outerWidth() + ', ' + $this.outerHeight());
			hoveredRect.css('stroke-dashoffset', 0);
		}
	)

	setTimeout(function(){
		$('.btn-svg').trigger('mouseleave');
	}, 0)


	/**
	* ----------------------------------------------------------------------------------------
	*    Parallax JS
	* ----------------------------------------------------------------------------------------
	*/

	function loadParallax(){
		var $parallaxContainer = $('.is-parallax-scene').not('.is-parallax-loaded');
		$parallaxContainer.each(function(){
			var $this = $(this);
			$this.parallax();
			$this.addClass('is-parallax-loaded');
		})
	}

	loadParallax();


})
