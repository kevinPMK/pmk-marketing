

(function( $ ) {


    /*----------------------------------------------------------------
    Search Toggle
    ----------------------------------------------------------------*/

    $('.sub-menu__search-toggle').on('click', function () {
        $('.sub-menu__search-wrap').addClass('sub-menu__search-wrap--open');
        $('.sub-menu__search-field').focus();
    });

    $('.sub-menu__search-close').on('click', function () {
        $('.sub-menu__search-wrap').removeClass('sub-menu__search-wrap--open');
        $('.sub-menu__search-field').val('');
    });

    $('.sub-page-hero, .animated-element, .slide__full-image, .home-hero, .slide, .feature-grid, .slide-faq__group, .slide-faq__conclusion, .search-results__conclusion, .blog-card, .blog-overview-hero, .team-list, .team-card').waypoint (function(){
        $(this.element).addClass('animated');
    }, {
        triggerOnce: true,
        offset: '90%'
    });


    /*----------------------------------------------------------------
    Mobile Menu Toggle
    ----------------------------------------------------------------*/

    var $button = $('.mobile-menu-toggle');
    var $menu = $('.mobile-menu');
    var isMenuOpen = false;

    var openMenu = function(){
        isMenuOpen = true;
        $button.attr('aria-expanded', isMenuOpen).addClass('active');
        $button.unbind('click', openMenu);
        $menu.addClass('opening');
        setTimeout(function(){
            $menu.addClass('opened');
            setTimeout(function(){
                $menu.removeClass('opening');
                $button.bind('click', closeMenu);
            }, 200);
        }, 5);
    };

    var closeMenu = function(){
        isMenuOpen = false;
        $button.attr('aria-expanded', isMenuOpen).removeClass('active');
        $button.unbind('click', closeMenu);
        $menu.addClass('closing');
        setTimeout(function(){
            $menu.removeClass('closing');
            $menu.removeClass('opened');
            $button.bind('click', openMenu);
        }, 200);
    };


    $button.on('click', openMenu);



    /*----------------------------------------------------------------
    Sticky Header
    ----------------------------------------------------------------*/

    /*
    var rafTimer;
    window.onscroll = function (event) {
        cancelAnimationFrame(rafTimer);
        rafTimer = requestAnimationFrame(toggleHeaderFloating);
    };

    function toggleHeaderFloating() {
        // does cause layout/reflow: https://git.io/vQCMn


    }
    */



    /*----------------------------------------------------------------
    Parallax Scrolling
    ----------------------------------------------------------------*/



    function draw() {
        requestAnimationFrame(draw);
        // Drawing code goes here
        scrollEvent();
    }
    draw();

	function scrollEvent(){

        viewportTop = $(window).scrollTop();
        heroHeight = $('.hero').height();

	    if(!is_touch_device()){
	        windowHeight = $(window).height();
	        viewportBottom = windowHeight+viewportTop;
            if(viewportTop <= windowHeight){
    	        $('[data-parallax="true"]').each(function(){
    	            distance = viewportTop * $(this).attr('data-speed');
    	            if($(this).attr('data-direction') === 'up'){ sym = '-'; } else { sym = ''; }
    	            $(this).css('transform','translate3d(0, ' + sym + distance +'px,0)');
    	        });
            }
        }

        if (viewportTop > '300') {
            document.body.classList.add('mobile-flip');
        } else {
            document.body.classList.remove('mobile-flip');
        }

        if (viewportTop > heroHeight - 250) {
            document.body.classList.add('nav-hide');
        } else {
            document.body.classList.remove('nav-hide');
        }

        if (viewportTop > (heroHeight - 100)) {
            document.body.classList.add('nav-prep-transition');
        } else {
            document.body.classList.remove('nav-prep-transition');
        }

        if (viewportTop > (heroHeight + 50)) {
            document.body.classList.add('nav-stuck');
        } else {
            document.body.classList.remove('nav-stuck');
        }

        if (viewportTop > (heroHeight*2) ) {
            document.body.classList.add('nav-focus-cta');
        } else {
            document.body.classList.remove('nav-focus-cta');
        }

	}

	function is_touch_device() {
	  return 'ontouchstart' in window // works on most browsers
	      || 'onmsgesturechange' in window; // works on ie10
	}


    /*----------------------------------------------------------------
    Scroll More
    ----------------------------------------------------------------*/

    $(".scroll-more").click(function() {
        $('html, body').animate({
            scrollTop: window.outerHeight - 72
        }, 800);
    });


    /*----------------------------------------------------------------
    Defer Image Loading
    ----------------------------------------------------------------*/

    window.addEventListener('load', function(){
        var allimages= document.getElementsByTagName('img');
        for (var i=0; i<allimages.length; i++) {
            if (allimages[i].getAttribute('data-src')) {
                allimages[i].setAttribute('src', allimages[i].getAttribute('data-src'));
            }
        }
    }, false);


    /*----------------------------------------------------------------
    Other
    ----------------------------------------------------------------*/

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



	// Set properties of navigation.
	function setNavProps() {

		navigationOffset = $navigation.offset().top;
		currentWindowHeight = $( window ).height();
        navigationScrollCap = navigationOffset + navigationMarginWidth;
        navigationOuterHeight = $navigation.outerHeight();

	}

	// Make navigation 'stick'.

    /*--

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

    --*/


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

    /*

	$( document ).ready( function() {

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


        */


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

    if($('.watch-video-button').length > 0){
    	$(".watch-video-button").YouTubePopUp();
    }


})( jQuery );
