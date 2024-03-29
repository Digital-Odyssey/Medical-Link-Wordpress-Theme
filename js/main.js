(function($) {
	
	'use strict';
	
	var isMobile = {
		Android: function() {
			return navigator.userAgent.match(/Android/i);
		},
		BlackBerry: function() {
			return navigator.userAgent.match(/BlackBerry/i);
		},
		iOS: function() {
			return navigator.userAgent.match(/iPhone|iPad|iPod/i);
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
	
	var appointmentFormActive = false,
	autoCollapseAppointmentForm = true,
	activeMap = '',
	latLong = '';

	
	$(document).ready(function(e) {
		
		// global
		var Modernizr = window.Modernizr;
		
		// support for CSS Transitions & transforms
		var support = Modernizr.csstransitions && Modernizr.csstransforms;
		var support3d = Modernizr.csstransforms3d;
		// transition end event name and transform name
		// transition end event name
		var transEndEventNames = {
								'WebkitTransition' : 'webkitTransitionEnd',
								'MozTransition' : 'transitionend',
								'OTransition' : 'oTransitionEnd',
								'msTransition' : 'MSTransitionEnd',
								'transition' : 'transitionend'
							},
		transformNames = {
						'WebkitTransform' : '-webkit-transform',
						'MozTransform' : '-moz-transform',
						'OTransform' : '-o-transform',
						'msTransform' : '-ms-transform',
						'transform' : 'transform'
					};
					
		if( support ) {
			this.transEndEventName = transEndEventNames[ Modernizr.prefixed( 'transition' ) ] + '.PMMain';
			this.transformName = transformNames[ Modernizr.prefixed( 'transform' ) ];
			//console.log('this.transformName = ' + this.transformName);
		}
		
		if (typeof wordpressOptionsObject !== 'undefined'){
			
			if(wordpressOptionsObject.displayAppointmentFormBeneathSlider === 'yes'){
				autoCollapseAppointmentForm = false;				
			}
			
		}
		
		
	/* ==========================================================================
	   Accordion functionality
	   ========================================================================== */
	   
	   if( $('.pm-accordion-link').length > 0 ){
		
			if( wordpressOptionsObject.multiExpandAccordion === 'on' ) {
				
				$('a[data-toggle="collapse"]').on('click',function(){
				
					var objectID=$(this).attr('href');
					
					if($(objectID).hasClass('in')) {
						
						$(objectID).collapse('hide');
						
					} else{
						
						$(objectID).collapse('show');
						
					}
				});
				
			}
		
			
			
			if( $('.pm-expand-all').length > 0 ) {
				
				$('.pm-expand-all').on('click',function(e){
                        
					e.preventDefault();
					
					var id = $(this).attr('id'),
					idNum = id.substring(id.lastIndexOf("-")+1);
					//console.log(idNum);
											
					$('a[data-toggleById="collapse'+idNum+'"]').each(function(){
						
						var objectID=$(this).attr('href');
						if($(objectID).hasClass('in')===false) {
							 $(objectID).collapse('show');
						}
						
					});
					
				});
				
			}
			
			if( $('.pm-collapse-all').length > 0 ) {
				
				$('.pm-collapse-all').on('click',function(e){
					
					e.preventDefault();
					
					var id = $(this).attr('id'),
					idNum = id.substring(id.lastIndexOf("-")+1);
					//console.log(idNum);
				
					$('a[data-toggleById="collapse'+idNum+'"]').each(function(){
						var objectID=$(this).attr('href');
						$(objectID).collapse('hide');
					});
					
				});
				
			}
		   
	   }	
		
		
		
	/* ==========================================================================
	   AJAX based filtering for Knowledge base
	   ========================================================================== */
	   if ( $('#pm-ln-glossary-search').length > 0 ) {
		   
		   var $keyCounter = 0;
		   
		   $("#pm-ln-glossary-search").keyup(function(){
			   
			   var textLength = $("#pm-ln-glossary-search").val().length;

			   
			   if(textLength > 3){
				   
				   $("#pm-ln-glossary-search-results-container").show();
				   
				   $.post( pulsarajax.ajaxurl, { //defined in functions.php file
						action:"pm_ln_search_knowledge_base", //PHP function to be called in WordPress
						search : $(this).val(), //$_POST being passed to PHP function
				   }, function( response ) {
						//console.log(response);
						methods.knowledge_base_list(response);
				   }, "json");
				   
			   } else {
					$("#pm-ln-glossary-search-results-container").hide();   
			   }
        
				
			});
			
			$('#pm-ln-glossary-search-results-close').click(function(e) {
				
				e.preventDefault();
				
				$("#pm-ln-glossary-search-results-container").hide();   
				
			});
		   
	   }

		
	/* ==========================================================================
	   Timetable shortcode interaction
	   ========================================================================== */
	   if( $('.pm-timetable-container').length > 0 ){
		   
		   //Add active class to first accordion item
		   $('.pm-timetable-container').each(function(index, element) {
            
				$(this).find('.pm-timetable-accordion-panel:first').addClass('active');
			
        	});
		   
		   //Click functionality
		   $('.pm-accordion-horizontal').click(function(e) {
			  
			  e.preventDefault();
			  
			  var parentAccordion = $(this).data('collapse'),
			  targetPanel = $(this).data('panel');
			  
			  //console.log('expand ' + targetPanel + ' in parent accordion ' + parentAccordion);
			  
			  $('#'+parentAccordion).find('.pm-timetable-accordion-panel').each(function(index, element) {
					$(this).removeClass('active');
              });
			  
			  $('#'+targetPanel).addClass('active');
			   
		   });
		   
	   }//endif
		
	/* ==========================================================================
	   Panels carousel
	   ========================================================================== */
	   if ( $('#pm-interactive-panels-owl').length > 0 ){
			
			//Activate Own Carousel
			$("#pm-interactive-panels-owl").owlCarousel({
			
				 // Most important owl features
				items : 3,
				itemsCustom : false,
				itemsDesktop : [1200,3],
				itemsDesktopSmall : [991,2],
				itemsTablet: [767,1],
				itemsTabletSmall: [720,1],
				itemsMobile : [320,1],
				singleItem : false,
				itemsScaleUp : false,
				 
				//Basic Speeds
				slideSpeed : 800,
				paginationSpeed : 800,
				rewindSpeed : 1000,
				 
				//Autoplay
				autoPlay : false,
				stopOnHover : false,
				 
				// Responsive
				responsive: true,
				responsiveRefreshRate : 200,
				responsiveBaseWidth: window,
				 
				// CSS Styles
				baseClass : "owl-carousel",
				theme : "owl-theme",
				 
				//Lazy load
				lazyLoad : false,
				lazyFollow : true,
				lazyEffect : "fade",
				 
				//Auto height
				autoHeight : true,
				 
				//Mouse Events
				dragBeforeAnimFinish : true,
				mouseDrag : true,
				touchDrag : true,
				 
			});
			
		}
		
	/* ==========================================================================
	   Appointment form location selection
	   ========================================================================== */
		if($('#pm_app_form_country').length > 0){
			
			var defaultItem = $('#pm_app_form_locations').clone();
		   
		   $('#pm_app_form_country').change(function(e) {
           
		   		var country = $(this).val();
				
				if( country !== 'default' ) {
					
					$('#pm_app_form_locations').attr('disabled', 'disabled');
					
					$.post(pulsarajax.ajaxurl, {action:'pm_ln_load_locations', nonce:pulsarajax.nonce, country:country}, function(data, status){
					
						if( status === 'success' ) {
													
							$('#pm_app_form_locations').html('');
							$('#pm_app_form_locations').append(data);
							
							$('#pm_app_form_locations').removeAttr('disabled');
							
						} else {
							//failed	
						}
						
					});
					
				} else {
										
					$('#pm_app_form_locations_container').html('');
					$('#pm_app_form_locations_container').append(defaultItem);
					$('#pm_app_form_locations').attr('disabled', 'disabled');
					
				}
		    
           });
			   
	   }
		
		
	/* ==========================================================================
	   Knowledge base widget lists
	   ========================================================================== */
	   if($('#pm-knowledge-centre-category-list').length > 0){
		   
		   $('#pm-knowledge-centre-category-list').change(function(e) {
           
		   		var index = $('#pm-knowledge-centre-category-list option:selected').index();
		   
		   		if(index > 0) {
					document.location.href = $(this).val();
				}				
		    
           });
			   
	   }
	   
	   if($('#pm-knowledge-centre-tag-list').length > 0){
		   
		   $('#pm-knowledge-centre-tag-list').change(function(e) {
           
		   		var index = $('#pm-knowledge-centre-tag-list option:selected').index();
		   
		   		if(index > 0) {
					document.location.href = $(this).val();
				}				
		    
           });
			   
	   }
		
	/* ==========================================================================
	   Glossary order filter
	   ========================================================================== */
		if($('#pm-glossary-filter').length > 0){
			
			var pathname = window.location.pathname;
			
			$('#pm-glossary-filter').bind('change', function () { // bind change event to select
			
				var value = $(this).val(); // get selected value
				
				var checkGlossaryIndex = methods.getURLParameter('glossary_index');
				var checkGlossarySearch = methods.getURLParameter('glossary_search');
				
				if(checkGlossaryIndex){
					
					
						window.location = pathname +'/?glossary_index='+checkGlossaryIndex+'&order='+ value; // redirect
					
					
				} else if(checkGlossarySearch) {
					
						window.location = pathname +'/?glossary_search='+checkGlossarySearch+'&order='+ value; // redirect
				
				} else {
					
					
						window.location = pathname +'/?order='+ value; // redirect
					
					
				};
				
				
				return false;
			});
			
		};
		
	/* ==========================================================================
	   Remove empty paragraph tags
	   ========================================================================== */
		$('p').each(function() {
			var $this = $(this);
			if($this.html().replace(/\s|&nbsp;/g, '').length == 0)
				$this.remove();
		});
		
	/* ==========================================================================
	   Delete post navigation li if empty
	   ========================================================================== */
	   if( $('.pm-post-navigation').length > 0 ){
		   
		   $('.pm-post-navigation li:empty').remove();
		   
	   }
	   
	/* ==========================================================================
	   Search entry
	   ========================================================================== */
		
		var $searchSubmit = $('#pm-search-submit');
		$searchSubmit.live('click', function(e) {
			$('#pm-searchform').submit();
			e.preventDefault();	
		});
		
		var $glossarySearchSubmit = $('#pm-glossary-search-submit');
		$glossarySearchSubmit.live('click', function(e) {
			$('#pm-glossary-searchform').submit();
			e.preventDefault();	
		});
		
		var $searchSubmitPage = $('#pm-search-submit-page');
		$searchSubmitPage.live('click', function(e) {
			$('#search-form-page').submit();
			e.preventDefault();	
		});
		
		//Sidebar
		if($('.pm-sidebar-search-icon-btn').length > 0){
			var $submitBtn = $('.pm-sidebar-search-icon-btn');
			//alert($submitBtn.attr('id'));
			$submitBtn.live('click', function(e) {
				$('#searchform').submit();
				e.preventDefault();	
			});
		}
		
		
	/* ==========================================================================
	   Main menu interaction
	   ========================================================================== */
		if( $('.pm-nav').length > 0 ){
						
			//superfish activation
			$('.pm-nav').superfish({
				delay: 0,
				animation: {opacity:'show',height:'show'},
				speed: 300,
				dropShadows: false,
			});
						
			$('.sf-sub-indicator').html('<i class="fa ' + wordpressOptionsObject.dropMenuIndicator + '"></i>');
			
			$('.sf-menu ul .sf-sub-indicator').html('<i class="fa ' + wordpressOptionsObject.dropMenuIndicator + '"></i>');
						
		};
		
	/* ==========================================================================
	   Append footer title dividers and span wrapper
	   ========================================================================== */
		
		if( $('.pm-widget-footer').length > 0 ){
            
			//wrap span around first word only of each title			
			$('.pm-widget-footer h6').each(function(){
				
				var $this = $(this);
    			$this.html($this.html().replace(/^(\w+)/, '<span>$1</span>'));

			});
			
			//insert divider after H6 title elements			
			$('<div class="pm-fat-footer-title-divider"></div>').insertAfter('.pm-widget-footer h6');
			
        };	
		
		
	/* ==========================================================================
	   Append nav icons
	   ========================================================================== */
		if( $('.pm-home-button').length > 0 ){
            
			var aTag = $('.pm-home-button').find('a');
			
			aTag.empty();
			aTag.addClass('fa fa-home');
			
			
        };	
		
		
	/* ==========================================================================
	   Appointment Form button
	   ========================================================================== */
	   
		if( $('.pm-appointment-form-button').length > 0 ){
						
			var $formBtn = $('.pm-appointment-form-button').find('a');
			
			
			if (autoCollapseAppointmentForm === false) {
						
				//scroll to form beneath slider
				$formBtn.click(function(e) {
					
					e.preventDefault();	
					
					$('html, body').animate({
						scrollTop: $('#pm-appointment-form-container').offset().top - 80
					}, 1000);		
					
					appointmentFormActive = true;
					methods.displayAppointmentForm();		
					
				});
				
			} else {
			
				$formBtn.click(function(e) {
				
					e.preventDefault();
					
					if(!appointmentFormActive){
						
						appointmentFormActive = true;
						methods.displayAppointmentForm();
						
					} else {
					
						appointmentFormActive = false;
						methods.hideAppointmentForm();
						
					}	
				
				});
			
			}//end of if
			
		}
		
		$('#pm-close-appointment-form').click(function(e) {
			e.preventDefault();
			methods.hideAppointmentForm();
		});
				
		
	/* ==========================================================================
	   Initialize animations
	   ========================================================================== */
		//runParallax();
		animateMilestones();
		animateProgressBars();
		animatePieCharts();
		setDimensionsPieCharts();
		
		
	/* ==========================================================================
	   Initialize WOW plugin for element animations
	   ========================================================================== */
		if( $(window).width() > 991 ){
			if( $('.wow').length > 0 ){
				new WOW().init();
			}
		}
		
		
	/* ==========================================================================
	   Woocommerce add bootstrap wrapper around product archive navigation
	   ========================================================================== */
	   if($('.woocommerce-pagination').length > 0){
		   $('.woocommerce-pagination').wrap('<div class="col-lg-12" />');
	   }
		
		
	/* ==========================================================================
	   Woocommerce add to cart icon
	   ========================================================================== */
	   
	   /*if($('.pm-add-to-cart-btn').length > 0){
		   
		   
		   $('.pm-add-to-cart-btn').each(function(index, element) {
           
		   		var $this = $(this);
				
				if( $this.hasClass('product_type_variable') ) {
				    $this.addClass('variable');
			    }
		    
           });
		  
		  $('.pm-add-to-cart-btn').on('click', function(e) {
			
				var $this = $(this);
				
				if(!$this.hasClass('product_type_variable')) {
					
					if(!$this.hasClass('add_to_cart_disabled')) {
					
						var productID = $this.data('product_id');
				
						var post = '.post-' + productID;
						$(post).find('.pm-added-to-cart-icon').addClass('in_cart');
						
						//Update nav cart total
						var productPrice = $(post).find('.amount').html();
						var productPriceStripped1 = productPrice.replace("$", "");
						var productPriceStrippedFinal = productPriceStripped1.replace(",", "");
		
						var navCartTotal = $('.pm-nav-cart-total').find('span').html();
						var navCartTotalStripped1 = navCartTotal.replace("$", "");
						var navCartTotalStrippedFinal = navCartTotalStripped1.replace(",", "");
						
						var newCartTotal = parseFloat(productPriceStrippedFinal) + parseFloat(navCartTotalStrippedFinal);
						
						$('.pm-nav-cart-total').find('span').html('$' + Number(newCartTotal).toFixed(2));
						
						//Update nav cart count
						var itemCount = $('.pm-nav-cart-item-count').html();
						var newItemCount = Number(itemCount) + 1;
						
						$('.pm-nav-cart-item-count').html(newItemCount);
						
						e.preventDefault();
						
					}					
					
				}//end if
				
				
		  });
		   
	   }*/
		
		
		
	/* ==========================================================================
	   Woocommerce Star rating
	   ========================================================================== */
		if( $('.comment-form-rating').length > 0 ){
			
			$('.comment-form-rating .stars span a').append('<i class="fa fa-star"></i>');
			
			$('.comment-form-rating .stars span a').on('click mousedown', function(e) {
				
				e.preventDefault();
				
				var $this = $(this);
				
				//remove previous active attribute to all a tags so we dont catch it
				$('.comment-form-rating .stars span a').removeClass('active');
				$('.comment-form-rating .stars span a i').removeClass('activated');
				
				var className = $this.attr('class');
				var currentStarIndex = className.substring(className.lastIndexOf("-") + 1);
				//console.log("currentStarIndex = " + currentStarIndex);
				
				for( var i = 0; i <= currentStarIndex; i++){
					
					var $currStar = '.star-' + i;
					$($currStar).find('i').addClass('activated');
					
				}
				
			});
			
		}
		
	/* ==========================================================================
	   Woocommerce Star rating widget
	   ========================================================================== */
		if( $('.widget_recent_reviews').length > 0 ){
			
			$('.widget_recent_reviews .product_list_widget li').each(function(index, element) {
                
				var $ratingDiv = $(element).find('.star-rating');
				var rating = $(element).find('.star-rating span strong').html();
				
				$ratingDiv.html('<ul class="pm-widget-star-rating" id="pm-widget-star-rating-'+index+'"></ul>');
				
				for (var i = 1; i <= 5; i++) {
										
					if( i > parseInt(rating) ){
						$('#pm-widget-star-rating-'+index+'').append('<li><i class="fa fa-star inactive"></i></li>');
					} else {
						$('#pm-widget-star-rating-'+index+'').append('<li><i class="fa fa-star"></i></li>');
					}
										
				}
				
            });
						
		}
		
	/* ==========================================================================
	   Woocommerce product details page star rating
	   ========================================================================== */
		if( $('.woocommerce-product-rating').length > 0 ){
			
			var $ratingDiv = $('.woocommerce-product-rating').find('.star-rating');
			
			var rating = $ratingDiv.find('span strong').html();
			
			$ratingDiv.html('<ul class="pm-widget-star-rating" id="pm-widget-star-rating-single"></ul>');
			
			for (var i = 1; i <= 5; i++) {
									
				if( i > parseInt(rating) ){
					$('#pm-widget-star-rating-single').append('<li><i class="fa fa-star inactive"></i></li>');
				} else {
					$('#pm-widget-star-rating-single').append('<li><i class="fa fa-star"></i></li>');
				}
									
			}
						
		}
		
	/* ==========================================================================
	   Store item main img
	   ========================================================================== */
	   if( $(".pm-woocomm-item-thumb-container").length > 0 ){
			   
			$(".pm-woocomm-item-thumb-container").hover(function(e) {
				
				var $this = $(this),
				span = $this.find('span'),
				icon = $this.find('i');
				
				 span.css({
					'height' : '100%' 
				 });
				 
				 icon.css({
					'opacity' : 1 
				 });
				
			}, function(e) {
				
				var $this = $(this),
				span = $this.find('span'),
				icon = $this.find('i');
				
				span.css({
					'height' : 0 
				 });
				 
				 icon.css({
					'opacity' : 0 
				 });
				
			});
			   
	   }
		
		
	/* ==========================================================================
	   Store item thumbs
	   ========================================================================== */
	   if( $(".pm-woocomm-item-thumbs").length > 0 ){
			
			$(".pm-woocomm-item-thumbs").children().each(function(index, element) {
				
				 var $this = $(element),
				 span = $this.find('span'),
				 icon = $this.find('i');
				 
				 $this.hover(function(e) {
					 
					 span.css({
						'height' : 200 
					 });
					 
					 icon.css({
						'opacity' : 1 
					 });
					 
				 }, function(e) {
					 
					 span.css({
						'height' : 0 
					 });
					 
					 icon.css({
						'opacity' : 0 
					 });
					 
				 });
				
			});
			
	   }
		
		
	/* ==========================================================================
	   Add rollover features to Flicker widget
	   ========================================================================== */
	   if( $('.flickr_badge_image').length > 0 ){
	   	
			var flickrATag = $('.flickr_badge_image').find('a');
			flickrATag.prepend('<span></span><i class="fa fa-search-plus"></i>');
		
	   }
	   
    /* ==========================================================================
	   Print page
	   ========================================================================== */
		if( $('#pm-print-btn').length > 0 ){
			var printBtn = $('#pm-print-btn');
			printBtn.click(function() {
				window.print();
				return false;	
			});
		}
		
	/* ==========================================================================
	   animateMilestones
	   ========================================================================== */
	
		function animateMilestones() {
	
			$(".milestone:in-viewport").each(function() {
				
				var $t = $(this);
				var	n = $t.find(".milestone-value").attr("data-stop");
				var	r = parseInt($t.find(".milestone-value").attr("data-speed"));
					
				if (!$t.hasClass("already-animated")) {
					$t.addClass("already-animated");
					$({
						countNum: $t.find(".milestone-value").text()
					}).animate({
						countNum: n
					}, {
						duration: r,
						easing: "linear",
						step: function() {
							$t.find(".milestone-value").text(Math.floor(this.countNum));
						},
						complete: function() {
							$t.find(".milestone-value").text(this.countNum);
						}
					});
				}
				
			});
	
		}
		
	/* ==========================================================================
	   animateProgressBars
	   ========================================================================== */
	
		function animateProgressBars() {
				
			$(".pm-progress-bar .pm-progress-bar-outer:in-viewport").each(function() {
				
				var $t = $(this),
				progressID = $t.attr('id'),
				numID = progressID.substr(progressID.lastIndexOf("-") + 1),
				targetDesc = '#pm-progress-bar-desc-' + numID,
				$target = $(targetDesc).find('span'),
				$diamond = $(targetDesc).find('.pm-progress-bar-diamond'),
				dataWidth = $t.attr("data-width");
								
				
				if (!$t.hasClass("already-animated")) {
					
					$t.addClass("already-animated");
					$t.animate({
						width: dataWidth + "%"
					}, 2000);
					$target.animate({
						"left" : dataWidth + "%",
						"opacity" : 1
					}, 2000);
					$diamond.animate({
						"left" : dataWidth + "%",
						"opacity" : 1
					}, 2000);
					
				}
				
			});
	
		}
		
	
		
	/* ==========================================================================
	   Store item thumbs
	   ========================================================================== */
	   if( $(".pm-woocomm-item-thumbs").length > 0 ){
			
			$(".pm-woocomm-item-thumbs").children().each(function(index, element) {
				
				 var $this = $(element),
				 span = $this.find('span'),
				 icon = $this.find('i');
				 
				 $this.hover(function(e) {
					 
					 span.css({
						'height' : 150 
					 });
					 
					 icon.css({
						'opacity' : 1 
					 });
					 
				 }, function(e) {
					 
					 span.css({
						'height' : 0 
					 });
					 
					 icon.css({
						'opacity' : 0 
					 });
					 
				 });
				
			});
			
	   }
		
		
	/* ==========================================================================
	   Store post item
	   ========================================================================== */
	   if( $(".pm-store-post-info-container").length > 0 ){
		   
			$(".pm-store-post-info-container").each(function(index, element) {
				
				
				
				 var $this = $(element),
				 expandBtn = $this.find('.pm-store-post-expander'),
				 overlay = $this.find('.pm-store-post-info-overlay'),
				 tags = $this.find('.pm-store-post-tags'),
				 closeBtn = $this.find('.pm-close-btn'),
				 isActive = false;
				 
				 expandBtn.click(function(e) {
					 
					 e.preventDefault();
					 
					 overlay.css({
						'top' : 0
					 });
					 
					 tags.css({
						'bottom' : -100
					 });
					 
					 
				 });	
				 
				 closeBtn.click(function(e) {
					 
					 e.preventDefault();
					 
					 overlay.css({
						'top' : 310
					 });
					 
					 tags.css({
						'bottom' : 0
					 });
					 
					 
				 });			 
				
			});
			   
	   }
		
	/* ==========================================================================
	   Staff post item
	   ========================================================================== */
	   methods.initializeStaffPosts();
	   
	/* ==========================================================================
	   Gallery post item
	   ========================================================================== */
	   methods.initializeGalleryItems();
		
	/* ==========================================================================
	   Testimonials carousel (homepage)
	   ========================================================================== */
	   if( $("#pm-testimonials-carousel").length > 0 ){
			  			  
			$("#pm-testimonials-carousel").PMTestimonials({
				speed : 500,
				slideShow : true,
				slideShowSpeed : wordpressOptionsObject.testimonialCarouselSpeed,
				controlNav : false,
				arrows : true	
			});
			   
	   }
	   
	   
	/* ==========================================================================
	   postItems shortcode carousel
	   ========================================================================== */
	   if( $("#pm-postItems-carousel").length > 0 ){
		   
		    var postOwlNews = $("#pm-postItems-carousel");
			
			
			postOwlNews.owlCarousel({
				
				items : 3, //10 items above 1000px browser width
				itemsDesktop : [5000,3],
				itemsDesktopSmall : [991,2],
				itemsTablet: [767,2],
				itemsTabletSmall: [720,1],
				itemsMobile : [320,1],
				
				//Playback
				autoPlay : parseInt(wordpressOptionsObject.autoPlay) === 0 ? false : wordpressOptionsObject.autoPlay,
				//autoPlay : 0,
				slideSpeed : 200,
				stopOnHover : true,
				paginationSpeed : 800,
				
				//Pagination
				pagination : false,
				paginationNumbers: false,
				
		   });
		   
		   // Custom Navigation Events
		   if( $('#pm-owl-news-next-services').length > 0 ) {
			   
			   $("#pm-owl-news-next-services").click(function(){
					postOwlNews.trigger('owl.next');
				});
				$("#pm-owl-news-prev-services").click(function(){
					postOwlNews.trigger('owl.prev');
				});
			   
		   }
		   
	   }
	   
	   
	/* ==========================================================================
	   services shortcode carousel
	   ========================================================================== */
	   if( $("#pm-servicesPosts-carousel").length > 0 ){
		   
		    var postOwl = $("#pm-servicesPosts-carousel");
			
			postOwl.owlCarousel({
				
				items : 3, //10 items above 1000px browser width
				itemsDesktop : [5000,3],
				itemsDesktopSmall : [991,2],
				itemsTablet: [767,2],
				itemsTabletSmall: [720,1],
				itemsMobile : [320,1],
				
				//Playback
				autoPlay : parseInt(wordpressOptionsObject.autoPlay) === 0 ? false : wordpressOptionsObject.autoPlay,
				//autoPlay : 0,
				slideSpeed : 200,
				stopOnHover : true,
				paginationSpeed : 800,
				
				//Pagination
				pagination : false,
				paginationNumbers: false,
				
		   });
		   
		   // Custom Navigation Events
		   if( $('#pm-owl-next-services').length > 0 ) {
			   
			   $("#pm-owl-next-services").click(function(){
					postOwl.trigger('owl.next');
				});
				$("#pm-owl-prev-services").click(function(){
					postOwl.trigger('owl.prev');
				});
			   
		   }
			
		   
	   }
	   
		
	/* ==========================================================================
	   Brand carousel (homepage)
	   ========================================================================== */
	   if( $("#pm-brands-carousel").length > 0 ){
		   
		    var owl = $("#pm-brands-carousel");
			var isPlaying = false;
		   
		    owl.owlCarousel({
				
				items : 4, //10 items above 1000px browser width
				itemsDesktop : [5000,4],
				itemsDesktopSmall : [991,2],
				itemsTablet: [767,2],
				itemsTabletSmall: [720,1],
				itemsMobile : [320,1],
				
				//Pagination
				pagination : false,
				paginationNumbers: false,
				
		   });
		   
		    // Custom Navigation Events
			$(".pm-owl-next").click(function(){
				owl.trigger('owl.next');
			})
			$(".pm-owl-prev").click(function(){
				owl.trigger('owl.prev');
			})
			
				
			$("#pm-owl-play").click(function(){
				
				if(!isPlaying){
					isPlaying = true;
					$(this).removeClass('fa fa-play').addClass('fa fa-stop');
					owl.trigger('owl.play',3000); //owl.play event accept autoPlay speed as second parameter
				} else {
					isPlaying = false;
					$(this).removeClass('fa fa-stop').addClass('fa fa-play');
					owl.trigger('owl.stop');
				}
				
				
			});
			
		   
	   }
		
	/* ==========================================================================
	   Flexslider (homepage)
	   ========================================================================== */
	   if( $("#pm-flexslider-home").length > 0 ){
		   
		   $("#pm-flexslider-home").flexslider({
				animation:"slide", 
				controlNav: false, 
				directionNav: true, 
				animationLoop: true, 
				slideshow: false, 
				arrows: true, 
				touch: false, 
				prevText : "", 
				nextText : "",
				start : function() {
					$('.flex-direction-nav').find('li').eq(0).append('<div class="flex-prev-shadow" />');
					$('.flex-direction-nav').find('li').eq(1).append('<div class="flex-next-shadow" />');
				},
			});
		   
	   }
		
	/* ==========================================================================
	   PrettyPhoto activation
	   ========================================================================== */
	   methods.loadPrettyPhoto();	  
	   
	/* ==========================================================================
	   MeanMenu (mobile menu)
	   ========================================================================== */
	    $('#pm-main-navigation').meanmenu({
			/*meanMenuContainer: '#pm-mobile-menu-container',*/
			meanScreenWidth : 	"980",
			meanRevealPositionDistance: "0",
			meanShowChildren: true,
			meanExpandableChildren: true,
			meanExpand: "+",
			meanMenuCloseSize: "18px"
		});

		
	/* ==========================================================================
	   Testimonials widget
	   ========================================================================== */
	   if( $('.pm-testimonials-widget-quotes').length > 0 ){
		   
		    $('.pm-testimonials-widget-quotes').PMTestimonials({
				speed : 450,
				slideShow : true,
				slideShowSpeed : 6000,
				controlNav : false,
				arrows : true
			});
		   
	   }
		
	/* ==========================================================================
	   Homepage slider
	   ========================================================================== */
		if($('#pm-slider').length > 0){
						
			$('#pm-slider').PMSlider({
				speed : wordpressOptionsObject.slideSpeed, //get parameter fron wp
				easing : 'ease',
				loop : wordpressOptionsObject.slideLoop == 'true' ? true : false, //get parameter fron wp
				controlNav : wordpressOptionsObject.enableControlNav == 'true' ? true : false, //false = no bullets / true = bullets / 'thumbnails' activates thumbs //get parameter fron wp
				controlNavThumbs : true,
				animation : wordpressOptionsObject.animationType, //get parameter fron wp
				fullScreen : false,
				slideshow : wordpressOptionsObject.enableSlideShow == 'true' ? true : false, //get parameter fron wp
				slideshowSpeed : wordpressOptionsObject.slideShowSpeed, //get parameter fron wp
				pauseOnHover : wordpressOptionsObject.pauseOnHover == 'true' ? true : false, //get parameter fron wp
				arrows : wordpressOptionsObject.showArrows == 'true' ? true : false, //get parameter fron wp
				fixedHeight : wordpressOptionsObject.fixedHeight == 'true' ? true : false,
				fixedHeightValue : wordpressOptionsObject.sliderHeight,
				touch : true,
				progressBar : false
			});
			
		}
		
	/* ==========================================================================
	   animatePieCharts
	   ========================================================================== */
	
		function animatePieCharts() {
	
			if(typeof $.fn.easyPieChart != 'undefined'){
	
				$(".pm-pie-chart:in-viewport").each(function() {
		
					var $t = $(this);
					var n = $t.parent().width();
					var r = $t.attr("data-barSize");
					
					if (n < r) {
						r = n;
					}
					
					$t.easyPieChart({
						animate: 1300,
						lineCap: "square",
						lineWidth: $t.attr("data-lineWidth"),
						size: r,
						barColor: $t.attr("data-barColor"),
						trackColor: $t.attr("data-trackColor"),
						scaleColor: "transparent",
						onStep: function(from, to, percent) {
							$(this.el).find('.pm-pie-chart-percent span').text(Math.round(percent));
						}
		
					});
					
				});
				
			}
	
		}
		
	/* ==========================================================================
	   setDimensionsPieCharts
	   ========================================================================== */
		
		function setDimensionsPieCharts() {
	
			$(".pm-pie-chart").each(function() {
	
				var $t = $(this);
				var n = $t.parent().width();
				var r = $t.attr("data-barSize");
				
				if (n < r) {
					r = n;
				}
				
				$t.css("height", r);
				$t.css("width", r);
				$t.css("line-height", r + "px");
				
				$t.find("i").css({
					"line-height": r + "px",
					"font-size": r / 3
				});
				
			});
	
		}
		
	/* ==========================================================================
	   Detect page scrolls on buttons
	   ========================================================================== */
		if( $('.pm-page-scroll').length > 0 ){
			
			$('.pm-page-scroll').click(function(e){
								
				e.preventDefault();
				var $this = $(e.target);
				var sectionID = $this.attr('href');
				
				
				$('html, body').animate({
					scrollTop: $(sectionID).offset().top - 80
				}, 1000);
				
			});
			
		}
		
	
		
	/* ==========================================================================
	   Datepicker
	   ========================================================================== */
	   if($("#pm_app_form_date").length > 0){
		   $("#pm_app_form_date").datepicker();
	   }
	   
	/* ==========================================================================
	   Isotope activation (Gallery and staff templates)
	   ========================================================================== */
	   if($("#pm-isotope-item-container").length > 0){
		  
		  $('#pm-isotope-item-container').imagesLoaded( function(){
			$('#pm-isotope-item-container').isotope({
			  itemSelector : '.isotope-item',
			});
			$('.isotope-item').css({
			  opacity : 1,
			});
		  });
		  
	   }
	   
	/* ==========================================================================
	   Isotope filter activation
	   ========================================================================== */
		$('.pm-isotope-filter-system').children().each(function(i,e) {
						
			if(i > 0){
				
				delay(e, 1);
				$(e).css({
					'visibility' : 'visible'	
				});
				//add click functionality
				$(e).find('a').click(function(e) {
					
					e.preventDefault();
					
					$('.pm-isotope-filter-system').children().find('a').removeClass('current');
					$(this).addClass('current');
					
					var id = $(this).attr('id');
					$('#pm-isotope-item-container').isotope({ filter: '.'+$(this).attr('id') });
					
				});
				
			}
						
			
		});
		
		var offset = 50;
		
		//must be declared at top level or immediately after a function call in "strict mode"
		function delay(element, opacity) {
			setTimeout(function(){
				$(element).animate({
					opacity: opacity, 
				}, 150);
			}, $(element).index() * offset)
		}
	   
		
	/* ==========================================================================
	   Isotope menu expander (mobile only)
	   ========================================================================== */
	   if($('.pm-isotope-filter-system-expand').length > 0){
		   
		   var totalHeight = 0;
		   
		   $('.pm-isotope-filter-system-expand').click(function(e) {
			   
			   var $this = $(this),
			   $parentUL = $this.parent('ul');
			   			   
			   //get the height of the total li elements
			   $parentUL.children('li').each(function(index, element) {
					totalHeight += $(this).height() + 5;
			   });
			   			   
			   if( !$parentUL.hasClass('expanded') ){
				   
				    //expand the menu
					$parentUL.addClass('expanded');
				   				  
				    $parentUL.css({
					  "height" : totalHeight	  
				    });
					
					$this.find('i').removeClass('fa-angle-down').addClass('fa-close');
				   
			   } else {
				
					//close the menu
					$parentUL.removeClass('expanded');
				   				  
				    $parentUL.css({
					  "height" : 94
				    });
					
					$this.find('i').removeClass('fa-close').addClass('fa-angle-down');
									   
			   }
			   
			   //reset totalheight
			   totalHeight = 0;
			   
		   });
		   
		   
		   $('.pm-isotope-filter-system').children().each(function(i,e) {
						
				if(i > 0){
					
					//add click functionality
					$(e).find('a').click(function(e) {
						
						e.preventDefault();
											
						
						if( $(window).width() < 991 ){
							//Capture parent li index for list reordering
							var listItem = $(this).closest('li');
							var listItemIndex = $(this).closest('li').index();
							console.log( "Index: " +  listItemIndex );
							
							//$('.pm-isotope-filter-system').insertAfter(listItem, $('.pm-isotope-filter-system').find("li").index(0));
							
							$('.pm-isotope-filter-system').find("li").eq(0).after(listItem);
						}
											
					});
					
				}
							
				
			});
		   
		   
	   }//end of if
	   
	   
	/* ==========================================================================
	   Ajax load more - Custom post types
	   ========================================================================== */
	   if($('#pm-load-more').length > 0){
						
			var morebutton = $('#pm-load-more'),
			section = morebutton.attr('name'),
			//container = 'pm-isotope-'+section+'-container',
			container = 'pm-isotope-item-container',
			btntext = morebutton.find('span').text(),
			page = 1;
									
			//alert($('#'+container).height());
		
			morebutton.click(function(e){
				
				e.preventDefault();
				page++;
				
				//morebutton.removeClass('fa fa-cloud-download').addClass('fa fa-spinner fa-spin');
				morebutton.find('span').text(pulsarajax.loading);//retrieved from localize script in functions.php
				//morebutton.find('i').removeClass('fa fa-cloud-download').addClass('fa fa-cog fa-spin').css({borderLeft:'0px'});
				
				$.post(pulsarajax.ajaxurl, {action:'pm_ln_load_more', nonce:pulsarajax.nonce, page:page, section:section}, function(data){
					
					var content = $(data.content);
					
					$(content).imagesLoaded(function(){
						
						$('#'+container).append(content).isotope('insert',content); //appended or insert (insert appends and filters the new items)
												
						//$('.pm-load-more-status').text('Loading...');
						//morebutton.find('span').append('<i class="fa fa-cloud-download"></i>');
						//morebutton.find('i').removeClass('fa fa-cog fa-spin').addClass('fa fa-cloud-download').css({borderLeft:'1px solid black'});
						
						//methods.resetHoverPanels();
						
						var numItems = $('div.isotope-item').length; 
						$('.pm-load-more-container-current-count strong').text(numItems);
						
						if(section == 'galleries'){
							//reset prettyPhoto for new isotope items
							methods.loadPrettyPhoto();
							methods.initializeGalleryItems();
						}
						
						if(section == 'staff'){
							//reset prettyPhoto for new isotope items
							methods.initializeStaffPosts();
						}

						
					});
					
					if(page >= data.pages){
						
						//all data has loaded, hide the Load More button
						//morebutton.fadeOut('slow');
						morebutton.css({ 'opacity' : '0', 'visibility' : 'hidden' });
						morebutton.unbind( "click" );
						morebutton.click(function(e) {
							e.preventDefault();
						});
						
					} else {
						//More items can be loaded, restore text on button
						morebutton.find('span').text(btntext);//retrieved from localize script in functions.php
					}
					
				},'json');
				
			});
			
		}
		
		
	/* ==========================================================================
	   Language Selector drop down
	   ========================================================================== */
		if($('.pm-dropdown.pm-language-selector-menu').length > 0){
			$('.pm-dropdown.pm-language-selector-menu').on('mouseover', methods.dropDownMenu).on('mouseleave', methods.dropDownMenu);
		}
		
	/* ==========================================================================
	   Filter system drop down
	   ========================================================================== */
		if($('.pm-dropdown.pm-filter-system').length > 0){
			$('.pm-dropdown.pm-filter-system').on('mouseover', methods.dropDownMenu).on('mouseleave', methods.dropDownMenu);
		}
		
	/* ==========================================================================
	   Categories system drop down
	   ========================================================================== */
		if($('.pm-dropdown.pm-categories-menu').length > 0){
			$('.pm-dropdown.pm-categories-menu').on('mouseover', methods.dropDownMenu).on('mouseleave', methods.dropDownMenu);
		}
		

		
	/* ==========================================================================
	   Checkout expandable forms
	   ========================================================================== */
		if ($('#pm-returning-customer-form-trigger').length > 0){
			
			var $returningFormExpanded = false;
			
			$('#pm-returning-customer-form-trigger').on('click', function(e) {
				
				e.preventDefault();
				
				if( !$returningFormExpanded ) {
					$returningFormExpanded = true;
					$('#pm-returning-customer-form').fadeIn(700);
					
				} else {
					$returningFormExpanded = false;
					$('#pm-returning-customer-form').fadeOut(300);
				}
				
			});
			
		}
		
		if ($('#pm-promotional-code-form-trigger').length > 0){
			
			var $promotionFormExpanded = false;
			
			$('#pm-promotional-code-form-trigger').on('click', function(e) {
				
				e.preventDefault();
				
				if( !$promotionFormExpanded ) {
					$promotionFormExpanded = true;
					$('#pm-promotional-code-form').fadeIn(700);
					
				} else {
					$promotionFormExpanded = false;
					$('#pm-promotional-code-form').fadeOut(300);
				}
				
			});
			
		}

				
	/* ==========================================================================
	   isTouchDevice - return true if it is a touch device
	   ========================================================================== */
	
		function isTouchDevice() {
			return !!('ontouchstart' in window) || ( !! ('onmsgesturechange' in window) && !! window.navigator.maxTouchPoints);
		}
				
		
		//dont load parallax on mobile devices
		function runParallax() {
			
			//enforce check to make sure we are not on a mobile device
			if( !isMobile.any()){
							
				//stellar parallax
				$.stellar({
				  horizontalOffset: 0,
				  verticalOffset: 0,
				  horizontalScrolling: false,
				});
				
				$('.pm-parallax-panel').stellar();
				
								
			}
			
		}//end of function
		
	/* ==========================================================================
	   Checkout form - Account password activation
	   ========================================================================== */
	   
	   if( $('#pm-create-account-checkbox').length > 0){
			  			
			$('#pm-create-account-checkbox').change(function(e) {
				
				if( $('#pm-create-account-checkbox').is(':checked') ){
					
					$('#pm-checkout-password-field').fadeIn(500);
					
				} else {
					$('#pm-checkout-password-field').fadeOut(500);	
				}
				
			});
			   
	   }
	   
	/* ==========================================================================
	   Locations Template Country select
	   ========================================================================== */
	   
	   if( $('#pm_countries_filter_system').length > 0){
		   
		   $('#pm_countries_filter_system').change(function(e) {
			  
			  var val = $(this).val();
			  
			  var url = window.location.href,
			  baseUrl = url.split('?')[0],
			  fullPath = baseUrl + '?location='+val+'';
			  //alert(fullPath);
			  
			  window.location.assign(fullPath);	 
			   
		   });
		   
	   }
	   
	/* ==========================================================================
	   Locations Google map
	   ========================================================================== */
	   
	   if( $('.pm-location-googleMap').length > 0){
		   
		   var targetMap = $('.pm-location-googleMap'),
		   target_id = targetMap.data('id'),
		   target_mapType = targetMap.data('mapType'),
		   target_zoom = targetMap.data('mapZoom'),
		   target_latitude = targetMap.data('latitude'),
		   target_longitude = targetMap.data('longitude'),
		   target_message = targetMap.data('message');
		
		   methods.initializeGoogleMap(target_id, target_latitude, target_longitude, target_zoom, target_mapType, target_message);
		   
	   }
	   
	/* ==========================================================================
	   Google map reset for tabs
	   ========================================================================== */
		if( $('.pm-nav-tabs').length > 0){
			
			$('.pm-nav-tabs').children().find('a').click(function(e) {
				
				var targetId = $(this).attr('href');
				
				var targetMap = $(targetId).find('.googleMap');
				
				if(targetMap.length > 0){
					
					var id = targetMap.data('id'),
					mapType = targetMap.data('mapType'),
					zoom = targetMap.data('mapZoom'),
					latitude = targetMap.data('latitude'),
					longitude = targetMap.data('longitude'),
					message = targetMap.data('message');
					
					methods.initializeGoogleMap(id, latitude, longitude, zoom, mapType, message);
					
					$(this).on('shown.bs.tab', function(e){
						google.maps.event.trigger(activeMap, 'resize');
						activeMap.setCenter(latLong)
					});
					
				}
				
				//alert();
				
			});
			
		}
		
	/* ==========================================================================
	   Conact page google map interaction
	   ========================================================================== */
	   if( $(".pm-google-map-container").length > 0 ){
		   
		   $( '.pm-google-map-container' ).each(function(index, element) {
				
				var $this = $(element),
				container = $this.find('.pm-googleMap'),
				id = container.attr('id'),
				mapType = container.data('mapType'),
				zoom = container.data('mapZoom'),
				latitude = container.data('latitude'),
				longitude = container.data('longitude'),
				message = container.data('message');
												
				methods.initializeGoogleMap(id, latitude, longitude, zoom, mapType, message);
			
        	}); 			
			
			
	   }
	   
	 /* ==========================================================================
	   Accordion and Tabs
	   ========================================================================== */
	   
	    $('#accordion').collapse({
		  toggle: false
		})
	    $('#accordion2').collapse({
		  toggle: false
		})
	   
		if($('.panel-title').length > 0){
			
			var $prevItem = null;
			var $currItem = null;
			
			$('.pm-accordion-link').click(function(e) {
				
				var $this = $(this);
				
				if($prevItem == null){
					$prevItem = $this;
					$currItem = $this;
				} else {
					$prevItem = $currItem;
					$currItem = $this;
				}				
				
				//reset Google map if found
				var targetId = $this.attr('href');
					
				var targetMap = $(targetId).find('div').find('.googleMap');
				
				if(targetMap.length > 0){
										
					var id = targetMap.data('id'),
					mapType = targetMap.data('mapType'),
					zoom = targetMap.data('mapZoom'),
					latitude = targetMap.data('latitude'),
					longitude = targetMap.data('longitude'),
					message = targetMap.data('message');
									
					methods.initializeGoogleMap(id, latitude, longitude, zoom, mapType, message);
					
					$(targetId).on('shown.bs.collapse', function(e){
						google.maps.event.trigger(activeMap, 'resize');
						activeMap.setCenter(latLong)
					});
					
				}
				
				if( $currItem.attr('href') != $prevItem.attr('href') ) {
										
					//toggle previous item
					if( $prevItem.parent().find('i').hasClass('fa fa-minus') ){
						$prevItem.parent().find('i').removeClass('fa fa-minus').addClass('fa fa-plus');
					}
					
					$currItem.parent().find('i').removeClass('fa fa-plus').addClass('fa fa-minus');
					
				} else if($currItem.attr('href') == $prevItem.attr('href')) {
										
					//else toggle same item
					if( $currItem.parent().find('i').hasClass('fa fa-minus') ){
						$currItem.parent().find('i').removeClass('fa fa-minus').addClass('fa fa-plus');
					} else {
						$currItem.parent().find('i').removeClass('fa fa-plus').addClass('fa fa-minus');
					}
						
				} else {
					
					//console.log('toggle current item');
					$currItem.parent().find('i').removeClass('fa fa-plus').addClass('fa fa-minus');
					
				}
				
				
			});

			
		}
		
		//tab menu
		if($('.nav-tabs').length > 0){
			
			//actiavte first tab of tab menu
			$('.nav-tabs a:first').tab('show');
			$('.nav.nav-tabs li:first-child').addClass('active');
			$('.pm-tab-content div:first-child').addClass('active');
		}
		
	/* ==========================================================================
	   Back to top button
	   ========================================================================== */
		$('#pm-back-top').click(function () {
			$('body,html').animate({
				scrollTop: 0
			}, 800);
			return false;
		});

		
	/* ==========================================================================
	   When the window is scrolled, do
	   ========================================================================== */
		$(window).scroll(function () {
			
			animateMilestones();
			animateProgressBars();
			animatePieCharts();
			
			if( $(window).width() > 991 ){
				
				//Close request appointment if expanded
				
				if (autoCollapseAppointmentForm === true){
					
					if(appointmentFormActive){
					
						appointmentFormActive = false;
						methods.hideAppointmentForm();
						
					}
					
				} 
				
			}
			
			//toggle back to top btn
			if ($(this).scrollTop() > 50) {
								
				if( support ) {
					$('#pm-back-top').css({ bottom : 5 });
				} else {
					$('#pm-back-top').animate({ bottom : 5 });
				}
			} else {
				if( support ) {
					$('#pm-back-top').css({ bottom : -150 });
				} else {
					$('#pm-back-top').animate({ bottom : -150 });
				}
			}
			
						
			//toggle fixed nav
			if(wordpressOptionsObject.stickyNav == 'on') {
				
				//apply sticky nav on desktop resolutions
				if( $(window).width() > 991 ){
					
					var fixedPosition = 0;
					
					if(wordpressOptionsObject.enableMicroMenu == 'on') {
						fixedPosition = 190;
					} else {
						fixedPosition = 132;
					}
				
					if ($(this).scrollTop() > fixedPosition) {
						
						$('.pm-nav-container').addClass('fixed');
										
					} else {
						
						$('.pm-nav-container').removeClass('fixed');
											
					}
				
				}
				
			}
			
						
		});
		
	/* ==========================================================================
	   Detect page scrolls on buttons
	   ========================================================================== */
		if( $('.pm-page-scroll').length > 0 ){
			
			$('.pm-page-scroll').click(function(e){
								
				e.preventDefault();
				var $this = $(e.target);
				var sectionID = $this.attr('href');
				
				
				$('html, body').animate({
					scrollTop: $(sectionID).offset().top - 80
				}, 1000);
				
			});
			
		}

	
	/* ==========================================================================
	   Back to top button
	   ========================================================================== */
		$('#pm-back-to-top').click(function () {
			$('body,html').animate({
				scrollTop: 0
			}, 800);
			return false;
		});
		
	/* ==========================================================================
	   Accordion menu
	   ========================================================================== */
		if($('#accordionMenu').length > 0){
			$('#accordionMenu').collapse({
				toggle: false,
				parent: false,
			});
		}
		
		
	/* ==========================================================================
	   Tab menu
	   ========================================================================== */
		if($('.pm-nav-tabs').length > 0){
			//actiavte first tab of tab menu
			$('.pm-nav-tabs a:first').tab('show');
			$('.pm-nav-tabs li:first-child').addClass('active');
		}

	/* ==========================================================================
	   Parallax check
	   ========================================================================== */
		var $window = $(window);
		var $windowsize = 0;
		
		function checkWidth() {
			$windowsize = $window.width();
			if ($windowsize < 980) {
				//if the window is less than 980px, destroy parallax...
				$.stellar('destroy');
			} else {
				runParallax();	
			}
		}
		
		// Execute on load
		checkWidth();
		// Bind event listener
		$(window).resize(checkWidth);

		
	/* ==========================================================================
	   Window resize call
	   ========================================================================== */
		$(window).resize(function(e) {
			methods.windowResize();
		});

		
	/* ==========================================================================
	   Tooltips
	   ========================================================================== */
		if( $('.pm_tip').length > 0 ){
			$('.pm_tip').PMToolTip();
		}
		if( $('.pm_tip_static_bottom').length > 0 ){
			$('.pm_tip_static_bottom').PMToolTip({
				floatType : 'staticBottom'
			});
		}
		if( $('.pm_tip_static_top').length > 0 ){
			$('.pm_tip_static_top').PMToolTip({
				floatType : 'staticTop'
			});
		}
		
	/* ==========================================================================
	   TinyNav
	   ========================================================================== */
		$(".pm-footer-navigation").tinyNav();
		
			
	}); //end of document ready

	
	/* ==========================================================================
	   Options
	   ========================================================================== */
		var options = {
			dropDownSpeed : 100,
			slideUpSpeed : 200,
			slideDownTabSpeed: 50,
			changeTabSpeed: 200,
		}
	
	/* ==========================================================================
	   Methods
	   ========================================================================== */
		var methods = {
			
			displayAppointmentForm : function(e) {
							
				var formContainer = $("#pm-appointment-form-container");
				
				var container = formContainer.find('.container');
				
				formContainer.css({
					'height' : container.height() + 70,
					'padding' : '20px 0',
					'borderTop' : '1px solid #34ceda',
					'borderBottom' : '1px solid #34ceda' 
				});
				
			},
			
			hideAppointmentForm : function(e) {
				
				var formContainer = $("#pm-appointment-form-container");
				
				formContainer.css({
					'height' : 0,
					'padding' : '0',
					'borderTop' : '0px solid #34ceda' ,
					'borderBottom' : '0px solid #34ceda' 
				});
				
			},

			
			dropDownMenu : function(e){  
					
				var body = $(this).find('> :last-child');
				var head = $(this).find('> :first-child');
				
				if (e.type == 'mouseover'){
					body.fadeIn(options.dropDownSpeed);
				} else {
					body.fadeOut(options.dropDownSpeed);
				}
				
			},
			
			initializeGalleryItems : function(e) {
				
				if( $(".pm-gallery-post-item-container").length > 0 ){
					
					if( !$(".pm-gallery-post-item-container").hasClass('single-post') ){
						
						$(".pm-gallery-post-item-container").each(function(index, element) {
						
							 var $this = $(element),
							 expandBtn = $this.find('.pm-gallery-item-expander'),
							 excerpt = $this.find('.pm-gallery-item-excerpt'),
							 isActive = false;
							 
							 expandBtn.click(function(e) {
								 
								 e.preventDefault();
								 
								 if(!isActive){
									 
									 isActive = true
									 
									 expandBtn.removeClass('fa fa-plus').addClass('fa fa-close');
									 
									 excerpt.css({
										'top' : 0
									 });
															 
									 
								 } else {
									
									isActive = false;
									
									expandBtn.removeClass('fa fa-close').addClass('fa fa-plus');
									
									excerpt.css({
										'top' : 400
									});
															 
								 }
								 
								 
							 });				 
							
						});
						
					}
					   
			   }
				
			},
			
				
			loadPrettyPhoto : function() {
				
				if( $("a[data-rel^='prettyPhoto']").length > 0 ){
		  							
					$("a[data-rel^='prettyPhoto']").prettyPhoto({
						animation_speed: wordpressOptionsObject.ppAnimationSpeed.toString(), /* fast/slow/normal */
						slideshow: wordpressOptionsObject.ppSlideShowSpeed, /* false OR interval time in ms */
						autoplay_slideshow: wordpressOptionsObject.ppAutoPlay == 'false' ? false : true, /* true/false */
						opacity: 0.80, /* Value between 0 and 1 */
						show_title: wordpressOptionsObject.ppShowTitle == 'false' ? false : true, /* true/false */
						social_tools: wordpressOptionsObject.ppSocialTools == 'false' ? false : '<div class="pp_social"><div class="twitter"><a href="http://twitter.com/share" class="twitter-share-button" data-count="none">Tweet</a><script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script></div><div class="facebook"><iframe src="http://www.facebook.com/plugins/like.php?locale=en_US&href='+location.href+'&amp;layout=button_count&amp;show_faces=true&amp;width=500&amp;action=like&amp;font&amp;colorscheme=light&amp;height=23" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:500px; height:23px;" allowTransparency="true"></iframe></div></div>', /* true/false */
						//allow_resize: true, /* Resize the photos bigger than viewport. true/false */
						//default_width: 640,
						//default_height: 480,
						counter_separator_label: '/', /* The separator for the gallery counter 1 "of" 2 */
						theme: wordpressOptionsObject.ppColorTheme.toString(), /* light_rounded / dark_rounded / light_square / dark_square / facebook */
						horizontal_padding: 20, /* The padding on each side of the picture */
						hideflash: true, /* Hides all the flash object on a page, set to TRUE if flash appears over prettyPhoto */
						wmode: 'opaque', /* Set the flash wmode attribute */
						autoplay: true, /* Automatically start videos: True/False */
						modal: false, /* If set to true, only the close button will close the window */
						deeplinking: true, /* Allow prettyPhoto to update the url to enable deeplinking. */
						overlay_gallery: true, /* If set to true, a gallery will overlay the fullscreen image on mouse over */
						keyboard_shortcuts: true, /* Set to false if you open forms inside prettyPhoto */
						changepicturecallback: function(){}, /* Called everytime an item is shown/changed */
						
					});
					
				}
				
			},
			
			initializeStaffPosts : function(e) {

				if( $(".pm-staff-profile-container").length > 0 ){
			
					$(".pm-staff-profile-container").each(function(index, element) {
						
						 var $this = $(element),
						 expandBtn = $this.find('.pm-staff-profile-expander'),
						 quoteBox = $this.find('.pm-staff-profile-quote'),
						 socialIcons = $this.find('.pm-staff-profile-icons'),
						 isActive = false;
						 
						 expandBtn.on('click', function(e) {
							 							 
							 var href = $(this).attr('href');
							 
							 if(href == '#') {
								 
								 e.preventDefault();
								 
								 if(!isActive){
								 
									 isActive = true
									 
									 expandBtn.removeClass('fa fa-plus').addClass('fa fa-close');
									 
									 quoteBox.css({
										'top' : 0
									 });
									 
									 socialIcons.css({
										'opacity' : 0,
										'right' : -70
									 });
									 
									 
								 } else {
									
									isActive = false;
									
									expandBtn.removeClass('fa fa-close').addClass('fa fa-plus');
									
									quoteBox.css({
										'top' : 290
									});
									 
									socialIcons.css({
										'opacity' : 1,
										'right' : 15
									});
									 
								 }
								 
							 }
							 
						 });				 
						
					});
					   
			   }

			},
			
			initializeGoogleMap : function(id, latitude, longitude, mapZoom, mapType, message) {
				
				  var myLatlng = new google.maps.LatLng(latitude,longitude);
				  latLong = myLatlng;
				  var myOptions = {
					center: myLatlng, 
					zoom: 13,
					mapTypeId: google.maps.MapTypeId.mapType
				  };
				  
				  //alert(document.getElementById(id).getAttribute('id'));
				  
				  //clear the html div first
				  document.getElementById(id).innerHTML = "";
				  
				  var map = new google.maps.Map(document.getElementById(id), myOptions);
				  		 
				  var contentString = message;
				  var infowindow = new google.maps.InfoWindow({
					  content: contentString
				  });
				   
				  var marker = new google.maps.Marker({
					  position: myLatlng
				  });
				   
				  google.maps.event.addListener(marker, "click", function() {
					  infowindow.open(map,marker);
				  });
				   
				  marker.setMap(map);
				  
				  activeMap = map;
				
			},
			
			knowledge_base_list : function(result){

				$("#pm-ln-glossary-search-results").html(""); //clear the element first
				
				//console.log('result = ' + result)
				
				if(result == ''){
					$("#pm-ln-glossary-search-results").append('<div class="pm_ln_knowledge_base_row"><p style="margin:0px; padding:0px; line-height:14px; font-size:13px;">'+ wordpressOptionsObject.ajaxSearchResult +'</p></div>');	
				} else {
					
					$.each(result, function(i, val) {
					
						if(val){
							$("#pm-ln-glossary-search-results").append('<div class="pm_ln_knowledge_base_row">\n\
							 <a href="'+val.guid+'">\n\
							 '+val.title+'\n\
							 </a>\n\
							 </div>');
						} 
				
					}); 
					
				}
				  
			},
			
			
			getURLParameter : function(name) {
			  return decodeURIComponent((new RegExp('[?|&]' + name + '=' + '([^&;]+?)(&|#|;|$)').exec(location.search)||[,""])[1].replace(/\+/g, '%20'))||null;
			},

					
			windowResize : function() {
				//resize calls
			},
			
		};
		
	
	
})(jQuery);

