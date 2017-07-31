

(function( $ ) {

	//KDM STUFF


    //Animate from top


    $('.sub-menu__search-toggle').on('click', function () {
        $('.sub-menu__search-wrap').addClass('sub-menu__search-wrap--open');
        $('.sub-menu__search-field').focus();
    });

    $('.sub-menu__search-close').on('click', function () {
        $('.sub-menu__search-wrap').removeClass('sub-menu__search-wrap--open');
        $('.sub-menu__search-field').val('');
    });

    $('.home-hero, .slide, .feature-grid, .slide-faq__group, .slide-faq__conclusion, .search-results__conclusion, .blog-card, .blog-overview-hero, .team-list, .team-card').waypoint (function(){
        $(this.element).addClass('animated');
    }, {
        triggerOnce: true,
        offset: '90%'
    });

    /*-- Toggle Mobile Menu --*/

    /*----------------------------------------------------------------
    Mobile Menu Toggle
    ----------------------------------------------------------------*/

    var $button = $('.mobile-menu-toggle');
    var $menu = $('.mobile-menu');
    var isMenuOpen = false;

    $button.on('click', function () {
        isMenuOpen = !isMenuOpen;
        $menu.toggleClass('active');
        $('body').toggleClass('scroll-locked');
        $button.attr('aria-expanded', isMenuOpen).toggleClass('active');
    });


    /*----------------------------------------------------------------
    Parallax Scrolling
    ----------------------------------------------------------------*/

    function isMobile() {
        return /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent);
    }

    if (!isMobile()) {
        function draw() {
            requestAnimationFrame(draw);
            // Drawing code goes here
            scrollEvent();
        }
        draw();
    }

	function scrollEvent(){
	    if(!is_touch_device()){
	        viewportTop = $(window).scrollTop();
	        windowHeight = $(window).height();
	        viewportBottom = windowHeight+viewportTop;

	        $('[data-parallax="true"]').each(function(){
	            distance = viewportTop * $(this).attr('data-speed');
	            if($(this).attr('data-direction') === 'up'){ sym = '-'; } else { sym = ''; }
	            $(this).css('transform','translate3d(0, ' + sym + distance +'px,0)');
	        });
	    }
	}

	function is_touch_device() {
	  return 'ontouchstart' in window // works on most browsers
	      || 'onmsgesturechange' in window; // works on ie10
	}


	// Variables and DOM Caching.
	var $body = $( 'body' ),

		//USED
		$navigation = $body.find( '.main-menu' ),
		$mobileToggle = $body.find( '.mobile-menu-toggle' ),
		$menuScrollDown = $body.find( '.scroll-more' ),
		navigationFixedClass = 'main-menu--fixed',
        mobileToggleFixedClass = 'mobile-menu-toggle--fixed',
		navigationCtaClass = 'main-menu--cta-focus',
		currentWindowHeight,
		navigationOffset,
        navigationMarginWidth = 40,
        navigationScrollCap,
        navigationcurrentMargin,
        navigationOuterHeight,



		//UNSURE
		$customHeader = $body.find( '.custom-header' ),
		$branding = $customHeader.find( '.site-branding' ),
		$navWrap = $navigation.find( '.wrap' ),
		$navMenuItem = $navigation.find( '.menu-item' ),
		$menuToggle = $navigation.find( '.menu-toggle' ),
		$sidebar = $body.find( '#secondary' ),
		$entryContent = $body.find( '.entry-content' ),
		$formatQuote = $body.find( '.format-quote blockquote' ),
		isFrontPage = $body.hasClass( 'twentyseventeen-front-page' ) || $body.hasClass( 'home blog' ),
		navigationHeight,
		navigationOuterHeight,
		navPadding,
		navMenuItemHeight,
		idealNavHeight,
		navIsNotTooTall,
		headerOffset,
		resizeTimer;

	/*
	$( 'a[href], area[href], input:not([disabled]), select:not([disabled]), textarea:not([disabled]), button:not([disabled]), iframe, object, embed, [tabindex], [contenteditable]', '.site-content-contain' ).filter( ':visible' ).focus( function() {
		if ( $navigation.hasClass( 'site-navigation-fixed' ) ) {
			var windowScrollTop = $( window ).scrollTop(),
				fixedNavHeight = $navigation.height(),
				itemScrollTop = $( this ).offset().top,
				offsetDiff = itemScrollTop - windowScrollTop;

			// Account for Admin bar.
			if ( $( '#wpadminbar' ).length ) {
				offsetDiff -= $( '#wpadminbar' ).height();
			}

			if ( offsetDiff < fixedNavHeight ) {
				$( window ).scrollTo( itemScrollTop - ( fixedNavHeight + 50 ), 0 );
			}
		}
	});
    */

	// Set properties of navigation.
	function setNavProps() {

		navigationOffset = $navigation.offset().top;
		currentWindowHeight = $( window ).height();
        navigationScrollCap = navigationOffset + navigationMarginWidth;
        navigationOuterHeight = $navigation.outerHeight();

	}

	// Make navigation 'stick'.

	function adjustScrollClass() {

		// Make sure we're not on a mobile screen.
		//if ( 'none' === $menuToggle.css( 'display' ) ) {

            if( $( window ).scrollTop() < navigationOffset ){
                $navigation.css({
                    marginLeft : navigationMarginWidth,
                    marginRight : navigationMarginWidth
                });
            }else if( $( window ).scrollTop() >= navigationOffset && $( window ).scrollTop() < navigationScrollCap ){
                navigationCurrentMargin = navigationMarginWidth - ($(window).scrollTop() - navigationOffset);
                $navigation.css({
                    marginLeft : navigationCurrentMargin,
                    marginRight : navigationCurrentMargin
                });
            }else if( $( window ).scrollTop() > navigationScrollCap ){
                $navigation.css({
                    marginLeft : 0,
                    marginRight : 0
                });
            }


			if ( $( window ).scrollTop() >= navigationOffset ) {
				$navigation.addClass( navigationFixedClass );
                $mobileToggle.addClass( mobileToggleFixedClass );
			} else {
				$navigation.removeClass( navigationFixedClass );
                $mobileToggle.removeClass( mobileToggleFixedClass );
			}

			if ( $( window ).scrollTop() >= currentWindowHeight ) {
				$navigation.addClass( navigationCtaClass );
			} else {
				$navigation.removeClass( navigationCtaClass );
			}

		//}

	}

	// Set margins of branding in header.
	function adjustHeaderHeight() {
		if ( 'none' === $menuToggle.css( 'display' ) ) {

			// The margin should be applied to different elements on front-page or home vs interior pages.
			if ( isFrontPage ) {
				$branding.css( 'margin-bottom', navigationOuterHeight );
			} else {
				$customHeader.css( 'margin-bottom', navigationOuterHeight );
			}

		} else {
			$customHeader.css( 'margin-bottom', '0' );
			$branding.css( 'margin-bottom', '0' );
		}
	}

	// Set icon for quotes.
	function setQuotesIcon() {
		//$( twentyseventeenScreenReaderText.quote ).prependTo( $formatQuote );
	}

	// Add 'below-entry-meta' class to elements.
	function belowEntryMetaClass( param ) {
		var sidebarPos, sidebarPosBottom;

		if ( ! $body.hasClass( 'has-sidebar' ) || (
			$body.hasClass( 'search' ) ||
			$body.hasClass( 'single-attachment' ) ||
			$body.hasClass( 'error404' ) ||
			$body.hasClass( 'twentyseventeen-front-page' )
		) ) {
			return;
		}

		sidebarPos       = $sidebar.offset();
		sidebarPosBottom = sidebarPos.top + ( $sidebar.height() + 28 );

		$entryContent.find( param ).each( function() {
			var $element = $( this ),
				elementPos = $element.offset(),
				elementPosTop = elementPos.top;

			// Add 'below-entry-meta' to elements below the entry meta.
			if ( elementPosTop > sidebarPosBottom ) {
				$element.addClass( 'below-entry-meta' );
			} else {
				$element.removeClass( 'below-entry-meta' );
			}
		});
	}

	/*
	 * Test if inline SVGs are supported.
	 * @link https://github.com/Modernizr/Modernizr/
	 */
	function supportsInlineSVG() {
		var div = document.createElement( 'div' );
		div.innerHTML = '<svg/>';
		return 'http://www.w3.org/2000/svg' === ( 'undefined' !== typeof SVGRect && div.firstChild && div.firstChild.namespaceURI );
	}

	/**
	 * Test if an iOS device.
	*/
	function checkiOS() {
		return /iPad|iPhone|iPod/.test(navigator.userAgent) && ! window.MSStream;
	}

	/*
	 * Test if background-attachment: fixed is supported.
	 * @link http://stackoverflow.com/questions/14115080/detect-support-for-background-attachment-fixed
	 */
	function supportsFixedBackground() {
		var el = document.createElement('div'),
			isSupported;

		try {
			if ( ! ( 'backgroundAttachment' in el.style ) || checkiOS() ) {
				return false;
			}
			el.style.backgroundAttachment = 'fixed';
			isSupported = ( 'fixed' === el.style.backgroundAttachment );
			return isSupported;
		}
		catch (e) {
			return false;
		}
	}

	// Fire on document ready.
	$( document ).ready( function() {

        /*-- Global Scroll To Link --*/

        $('.scroll-to-link').click( function( e ) {
            e.preventDefault();
            console.log(navigationOuterHeight);
            $( window ).scrollTo( $(this).attr('href'), {
                duration: 600,
                offset: { top: -navigationOuterHeight - 100 }
            });
        });

		// If navigation menu is present on page, setNavProps and adjustScrollClass.
		if ( $navigation.length ) {
			setNavProps();
			adjustScrollClass();
		}

		// If 'Scroll Down' arrow in present on page, calculate scroll offset and bind an event handler to the click event.
		if ( $menuScrollDown.length ) {

			if ( $( 'body' ).hasClass( 'admin-bar' ) ) {
				menuTop -= 32;
			}
			if ( $( 'body' ).hasClass( 'blog' ) ) {
				menuTop -= 30; // The div for latest posts has no space above content, add some to account for this.
			}
			if ( ! $navigation.length ) {
				navigationOuterHeight = 0;
			}

			$menuScrollDown.click( function( e ) {
				e.preventDefault();
				$( window ).scrollTo( '.site__content', {
					duration: 600,
					offset: { top: menuTop - navigationOuterHeight }
				});
			});
		}

		adjustHeaderHeight();
		setQuotesIcon();
		if ( true === supportsInlineSVG() ) {
			document.documentElement.className = document.documentElement.className.replace( /(\s*)no-svg(\s*)/, '$1svg$2' );
		}

		if ( true === supportsFixedBackground() ) {
			document.documentElement.className += ' background-fixed';
		}
	});

	// If navigation menu is present on page, adjust it on scroll and screen resize.
	if ( $navigation.length ) {

		// On scroll, we want to stick/unstick the navigation.
		$( window ).on( 'scroll', function() {
			adjustScrollClass();
			adjustHeaderHeight();
		});

		// Also want to make sure the navigation is where it should be on resize.
		$( window ).resize( function() {
			setNavProps();
			setTimeout( adjustScrollClass, 500 );
		});
	}

	$( window ).resize( function() {
		clearTimeout( resizeTimer );
		resizeTimer = setTimeout( function() {
			belowEntryMetaClass( 'blockquote.alignleft, blockquote.alignright' );
		}, 300 );
		setTimeout( adjustHeaderHeight, 1000 );
	});

	// Add header video class after the video is loaded.
	$( document ).on( 'wp-custom-header-video-loaded', function() {
		$body.addClass( 'has-header-video' );
	});


    /*-- YouTube Pop Up Player --*/
    // Copyright (c) 2016 - Qassim Hassan

    $.fn.YouTubePopUp = function(options) {

        var YouTubePopUpOptions = $.extend({
                autoplay: 1
        }, options );

        $(this).on('click', function (e) {

            var youtubeLink = $(this).attr("href");

            if( youtubeLink.match(/(youtube.com)/) ){
                var split_c = "v=";
                var split_n = 1;
            }

            if( youtubeLink.match(/(youtu.be)/) || youtubeLink.match(/(vimeo.com\/)+[0-9]/) ){
                var split_c = "/";
                var split_n = 3;
            }

            if( youtubeLink.match(/(vimeo.com\/)+[a-zA-Z]/) ){
                var split_c = "/";
                var split_n = 5;
            }

            var getYouTubeVideoID = youtubeLink.split(split_c)[split_n];

            var cleanVideoID = getYouTubeVideoID.replace(/(&)+(.*)/, "");

            if( youtubeLink.match(/(youtu.be)/) || youtubeLink.match(/(youtube.com)/) ){
                var videoEmbedLink = "https://www.youtube.com/embed/"+cleanVideoID+"?autoplay="+YouTubePopUpOptions.autoplay+"";
            }

            if( youtubeLink.match(/(vimeo.com\/)+[0-9]/) || youtubeLink.match(/(vimeo.com\/)+[a-zA-Z]/) ){
                var videoEmbedLink = "https://player.vimeo.com/video/"+cleanVideoID+"?autoplay="+YouTubePopUpOptions.autoplay+"";
            }

            $("body").append('<div class="video-popup video-popup--animation"><div class="video-popup__content"><button type="button" class="video-popup__close"><div class="bar bar1"></div><div class="bar bar2"></div></button><div class="video-responsive"><iframe src="'+videoEmbedLink+'" allowfullscreen></iframe></div></div></div>');
            $("body").addClass('scroll-locked');


            if( $('.video-popup').hasClass('video-popup--animation') ){
                setTimeout(function() {
                    $('.video-popup').removeClass("video-popup--animation");
                }, 100);
            }

            $(".video-popup, .video-popup--close").click(function(){
                $(".video-popup").addClass("video-popup--hide").delay(515).queue(function() { $(this).remove(); });
                $("body").removeClass('scroll-locked');
            });

            e.preventDefault();

        });

        $(document).keyup(function(e) {

            if ( e.keyCode == 27 ){
                $('.video-popup, .video-popup--close').click();
            }

        });

    };

    if($('#watch-video-button').length > 0){
    	$("#watch-video-button").YouTubePopUp();
    }

})( jQuery );
