 /* Begin---------------------------------------------------------------*/
(function($) {
	"use strict";
	var niteo = niteo || {};
	var dev = false;
	// declare variables for LoadContent
	var page = 2,
		loading = false,
		loadMore = true,
		$container = $('#main'),
		$grid = null,
		$lightbox = null;

	/* Init functions
	--------------------------------------------------------------------*/
	$( document ).ready(function() {

		if ( dev == true ) {
			$('#wpadminbar').css('display', 'none');
			$('html').attr('style', 'margin-top: 0px!important');
			niteo.overflow();
		}

		niteo.initial();
	});



	/* END of Init functions
	--------------------------------------------------------------------*/


	/* Declare functions
	--------------------------------------------------------------------*/
	niteo.initial = function() {
		niteo.mobileMenu();
		niteo.searchIcon();
		niteo.videoHeader();
		niteo.masonryLayout();
		niteo.inViewport();
		niteo.scrollPage();
		niteo.slickSlider();
		niteo.stickySlider();
		niteo.masonryGallery();
		niteo.scrollTop();
		niteo.lightbox();
		niteo.wooGallery();
		
	}

	niteo.scrollPage = function() {

		if ( !$('.no-header').length && !$('.no-sticky-menu').length ) {
			var $menu 			= $('.main-nav-container'),
				$header 		= $('.site-header');

			imagesLoaded( $header, function() {

				var bannerHeight = $('.video-banner').length ? $('.video-banner').height() : $('.wp-custom-header').height();

				var scalingLogo = ( $('.custom-logo').length && !$('.logo-over-hero').length ) ? true : false;
	 
				$(window).resize(function() {
					bannerHeight 	= $('.video-banner').length ? $('.video-banner').height() : $('.wp-custom-header').height();
				});

				$(window).scroll(function() {

					if ( true === scalingLogo ) {
						var scale = 1 - $(this).scrollTop() / 1000;

						scale = ( scale < 0.6 ) ? 0.6 : scale;

						$('.site-branding').css('transform', 'scale(' + scale + ')');	
					}
					
					if( $(this).scrollTop() > bannerHeight ) {
						$menu.addClass('sticky');
						$header.addClass('sticky');
					} else {
						$menu.removeClass('sticky');
						$header.removeClass('sticky');
					}

					if ( $(this).scrollTop() > 600 ) {
						$('.go-top').addClass('active');
					} else {
						$('.go-top').removeClass('active');
					}
				});
			})
			
		} else {

			if ( $('.go-top').length ) {
				$(window).scroll(function() {
					if ( $(this).scrollTop() > 600 ) {
						$('.go-top').addClass('active');
					} else {
						$('.go-top').removeClass('active');
					}
				});
			}

		}


	}

	niteo.masonryLayout = function() {

		if ( !$('body.masonry article').length ) {
		    return;
		}

		var $container 	= $('#main');

		$grid = $container.masonry({
			initLayout: false,
			itemSelector: 'article.multi-columns',
			gutter: 50,
		});

		// initialize Masonry after all images have loaded
		imagesLoaded( $container, function() {
			$grid.masonry();
		});


	}

	niteo.inViewport = function() {
		$('#main article').isInViewport(function(response, element){
			if ( response == true ) {
				$(element).addClass('in-viewport');

				// if last element is in viewport and still have posts to load
			    if ( 

					loadMore == true
					&& loading == false
					&& $('.ajax-load').length
					&& $('.type-post:not(.single-post)').length
					&& $(element).is(':last-of-type') ) {
						niteo.infScroll();
				}
			}
		});
	}

	niteo.infScroll = function() {
		loading = true;
		
		if ( loadMore == true ) {
			var cat = $('#main').data('cat');

			cat = (cat === undefined) ? '0' : cat;

			var data = {
				action: 'blogger_light_ajax_load_more',
				page: page,
				post_type: 'post',
				cat: cat,
			};

			$('.l-wrapper').addClass('active');

			$.ajax({
				type: 'POST',
				url:  ajaxurl,  
				data: data,
				success: function(result) {

					if( result.success && result.data != '' ) {
						page = page + 1;
						// loading = false;
						if (result.data == '') {
							loadMore = false;
						} 
						var $data = $(result.data);

						// if full layout design
						if ( !$('body.masonry').length ) {
							// append data
						    $container.append( $data );

						    // check for masonry Gallery
						    niteo.masonryGallery();

						    // register lightbox for new images
						    if ( $lightbox === null ) {
						    	niteo.lightbox();

						    } else {
						    	$lightbox.addImageLightbox( $( '.entry-content a') );
						    }

						    // ini slider
						    niteo.slickSlider();

						    // disable loading of new images
						    loading = false;
						    // update viewport
						    niteo.inViewport();

						    // remove loading animation
							$('.l-wrapper').removeClass('active');

						   // if masonry 2-columns layout, update it
						} else {

							imagesLoaded( $data , function() {
								$container.append( $data );
								$grid.masonry( 'appended', $data );

							    // disable loading of new images
							    loading = false;
							    // update viewport
							    niteo.inViewport();

							    // remove loading animation
								$('.l-wrapper').removeClass('active');

							});		
						}



					} else {
						loadMore = false;
						$('.l-wrapper').removeClass('active');
					}
				},

				error: function(xhr, status, error) {
						// var err = eval('(' + xhr.responseText + ')');
						console.log(xhr.responseText);
				}
			});
		} else {
			return;
		}
	}
		
	niteo.mobileMenu = function(){
		$('#site-navigation').slicknav({
			appendTo: '.main-nav-container',
			
		});
	};

	niteo.slickSlider = function() {
		if ( !$('.slick-slider:not(.slick-initialized)').length ) {
		    return;
		}

		$('.slick-slider:not(.slick-initialized)').slick({
			infinite: true,
			speed: 1500,
			slidesToShow: 1,
			dots: false,
			autoplay: true,
			autoplaySpeed: 5000,
			prevArrow: '<button type="button" class="slick-prev"><i class="fa fa-2x fa-angle-left" aria-hidden="true"></i></button>',
			nextArrow: '<button type="button" class="slick-next"><i class="fa fa-2x fa-angle-right" aria-hidden="true"></i></button>',
		});
	}

	niteo.stickySlider = function() {
		if ( $('li.sticky-post').length < 2 ) {
		    return;
		}

   		var $stickyContainer = $('.sticky-posts');

		imagesLoaded( $stickyContainer, { background: '.entry-feat.sticky' }, function() {

			$stickyContainer.slick({
				infinite: true,
				speed: 1000,
				slidesToShow: 1,
				dots: false,
				autoplay: true,
				autoplaySpeed: 7000,
				prevArrow: '<div class="slick-prev"><i class="fa fa-2x fa-long-arrow-left" aria-hidden="true"></i></div>',
				nextArrow: '<div class="slick-next"><i class="fa fa-2x fa-long-arrow-right" aria-hidden="true"></i></div>',
			});
		});


	}

	niteo.masonryGallery = function() {

        if ( !$('.masonry.gallery').length ) {
            return;
        }

		var $container = $('.masonry.gallery');

		var $gallery = $container.masonry({
			initLayout: false,
			itemSelector: '.masonry.gallery a',
			percentPosition: true,
			columnWidth: '.masonry.gallery a',
			gutter: 20,
		});
		// initialize Masonry after all images have loaded

		imagesLoaded( $container, function() {
			$gallery.masonry();
		});

	};

	niteo.scrollTop = function() {
	    $('.back-top-wrapper, .go-top').click(function(event) {
	        event.preventDefault();
	        $('html, body').animate({scrollTop: 0}, 500);
	        return false;
	    });
	}

    niteo.clickToggle = function(func1, func2) {
        var funcs = [func1, func2];
        this.data('toggleclicked', 0);
        this.click(function() {
            var data = $(this).data();
            var tc = data.toggleclicked;
            $.proxy(funcs[tc], this)();
            data.toggleclicked = (tc + 1) % 2;
        });
        return this;
    };

    niteo.videoHeader = function() {

        if ( !$('#header-video').length ) {
            return;
        }

    	if ( $('#header-video').data('video_type') == 'yt' ) {

	        var video = new vidim( '#header-video', {
	            src: $('#header-video').data('url'),
	            type: 'YouTube',
	            poster: $('#header-video').data('poster'),
	            quality: 'hd1080'
	            }
	        );	

    	} else {
	        var video = new vidim( '#header-video', {
	            src: [
	                {
	                  type: 'video/mp4',
	                  src: $('#header-video').data('url'),
	                },
	            ],
	            poster: $('#header-video').data('poster'),
	        });
    	}

    }

    niteo.searchIcon = function() {
        if ( !$('#search-overlay').length ) {
            return;
        }

        $('.menu-search a').on('click', function(e){
        	e.preventDefault();
        	$('#search-overlay').addClass('focus');
        	$('#search-overlay .input-search').focus();
        	setTimeout(function(){
        		$('body').css('overflow-y', 'hidden');
        	}, 100);
        	
        });

        $('#close-overlay').on('click', function(e){
        	e.preventDefault();
        	$('#search-overlay').removeClass('focus');
        	$('body').css('overflow-y', 'auto');
        });

    }

	niteo.lightbox = function() {

        if ( !$('.entry-content a img').length && !$('.widget_media_gallery a').length ) {
            return;
        }

		// ACTIVITY INDICATOR
		var instance = {}, 
		activityIndicatorOn = function() {
			$( '<div class="lightbox-spinner"></div>' ).appendTo( 'body' );
			
		},
		activityIndicatorOff = function(){
			$( '.lightbox-spinner' ).remove();
		},

		// OVERLAY
		overlayOn = function(){
			$( '<div id="imagelightbox-overlay"></div>' ).appendTo( 'body' );
			$( '#imagelightbox-overlay' ).fadeIn( 200, function() {
			    // Animation complete
			  });
		},
		overlayOff = function()	{
			$( '#imagelightbox-overlay' ).remove();
		},

		// CLOSE BUTTON
		closeButtonOn = function( instance ) {
	
			$( '<div id="lightbox-close" ><span class="line"></span><span class="line"></span></div>' ).appendTo( 'body' ).on( 'click touchend', function(){ $( this ).remove(); instance.quitImageLightbox(); return false; });
		},

		closeButtonOff = function()	{
			$( '#lightbox-close' ).remove();
		},

		// ARROWS
		arrowsOn = function( instance, selector ){
			var $arrows = $( '<div class="imagelightbox-arrow imagelightbox-arrow-left"></div><div class="imagelightbox-arrow imagelightbox-arrow-right"></div>' );

			$arrows.appendTo( 'body' );

			$arrows.on( 'click touchend', function( e )
			{
				e.preventDefault();

				var $this	= $( this ),
					$target	= $( selector + '[href="' + $( '#imagelightbox' ).attr( 'src' ) + '"]' ),
					index	= $target.index( selector );

				if( $this.hasClass( 'imagelightbox-arrow-left' ) )
				{
					index = index - 1;
					if( !$( selector ).eq( index ).length )
						index = $( selector ).length;
				}
				else
				{
					index = index + 1;
					if( !$( selector ).eq( index ).length )
						index = 0;
				}

				instance.switchImageLightbox( index );
				return false;
			});
		},

		arrowsOff = function()	{
			$( '.imagelightbox-arrow' ).remove();
		};

		// LIGHTBOX INSTANCES

		$lightbox = $( '.entry-content a').imageLightbox({
			onStart: 	 function() { overlayOn(); arrowsOn( $lightbox, '.entry-content a');$( '.imagelightbox-arrow' ).css( 'display', 'block' );  closeButtonOn ($lightbox);},
			onEnd:	 	 function() { arrowsOff(); overlayOff(); activityIndicatorOff(); closeButtonOff();},
			onLoadStart: function() { activityIndicatorOn();},
			onLoadEnd:	 function() { activityIndicatorOff();}
		});

		if ( $('.widget_media_gallery a').length ) {
			var $lightbox_widget = $( '.widget_media_gallery a' ).imageLightbox(
			{
				onStart: 	 function() { overlayOn(); arrowsOn( $lightbox_widget, '.widget_media_gallery a' );$( '.imagelightbox-arrow' ).css( 'display', 'block' );  closeButtonOn ($lightbox_widget);},
				onEnd:	 	 function() { arrowsOff();overlayOff(); activityIndicatorOff(); closeButtonOff();},
				onLoadStart: function() { activityIndicatorOn(); },
				onLoadEnd:	 function() { activityIndicatorOff(); }
			});
		}


	}; //end of lightbox

	niteo.wooGallery = function () {
        if ( !$('.woocommerce-product-gallery__image').length ) {
            return;
        }

        // preload image on hover
        $('.woocommerce-product-gallery__image:not(:first-of-type').one('mouseenter', function(e) {
        	var newSrc = $(this).children('a').attr('href');
        	$(new Image()).attr('src', '' + newSrc).load();
        });

        // change image on click
        $('.woocommerce-product-gallery__image').click(function(e) {
        	e.preventDefault();

        	var newSrc = $(this).children('a').attr('href');
        	var container = $('.woocommerce-product-gallery__image')[0];
        	$(container).find('img').attr('srcset', newSrc).attr('src', newSrc);
        });
	}

    niteo.overflow = function() {
		var docWidth = document.documentElement.offsetWidth;

		[].forEach.call(
		  document.querySelectorAll('*'),
		  function(el) {
		    if (el.offsetWidth > docWidth) {
		      console.log(el);
		    }
		  }
		);
    }


	/* Mobile check
	------------------------------------------------------------------- */
	var isMobile = {
	    Android: function() {
	        return navigator.userAgent.match(/Android/i);
	    },
	    BlackBerry: function() {
	        return navigator.userAgent.match(/BlackBerry/i);
	    },
	    iOS: function() {
	        return navigator.userAgent.match(/iPhone|iPod/i);
	    },
	    Opera: function() {
	        return navigator.userAgent.match(/Opera Mini/i);
	    },
	    Windows: function() {
	        return navigator.userAgent.match(/IEMobile/i);
	    },
	    any: function() {
	        return (isMobile.Android() || isMobile.BlackBerry() || isMobile.iOS() || isMobile.Opera() || isMobile.Windows());
	    }
	};

	var inCustomizer = $('#customize-preview', window.parent.document).length;

})(jQuery);	// EOF






