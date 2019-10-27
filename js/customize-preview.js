/**
 * File customize-preview.js.
 *
 * Instantly live-update customizer settings in the preview for improved user experience.
 */

(function( $ ) {

	// Collect information from customize-controls.js about which panels are opening.
	wp.customize.bind( 'preview-ready', function() {

		// Initially hide the theme option placeholders on load
		$( '.panel-placeholder' ).hide();

		wp.customize.preview.bind( 'section-highlight', function( data ) {

			// Only on the front page.
			if ( ! $( 'body' ).hasClass( 'procast_theme-front-page' ) ) {
				return;
			}

			// When the section is expanded, show and scroll to the content placeholders, exposing the edit links.
			if ( true === data.expanded ) {
				$( 'body' ).addClass( 'highlight-front-sections' );
				$( '.panel-placeholder' ).slideDown( 200, function() {
					$.scrollTo( $( '#panel1' ), {
						duration: 600,
						offset: { 'top': -70 } // Account for sticky menu.
					});
				});

			// If we've left the panel, hide the placeholders and scroll back to the top.
			} else {
				$( 'body' ).removeClass( 'highlight-front-sections' );
				// Don't change scroll when leaving - it's likely to have unintended consequences.
				$( '.panel-placeholder' ).slideUp( 200 );
			}
		});
	});
	
	//Header textfields
	wp.customize( 'headerPostsListSelector', function( value ) {
		value.bind( function( to ) {
			$( '#pro-cast-posts-selector li.activator' ).text( to );
		});
	});
	
	//Reviews textfields
	wp.customize( 'keyRating1Text', function( value ) {
		value.bind( function( to ) {
			$( '.pro-cast-review-rating-score-bar.level-one p' ).text( to );
		});
	});
	
	
	//Footer textfields
	wp.customize( 'newsletterFieldText', function( value ) {
		value.bind( function( to ) {
			$( '.pro-cast-newsletter-field' ).val( to );
		});
	});
		
	// Site title and description.
	wp.customize( 'blogname', function( value ) {
		value.bind( function( to ) {
			$( '.site-title a' ).text( to );
		});
	});
		
	wp.customize( 'blogdescription', function( value ) {
		value.bind( function( to ) {
			$( '.site-description' ).text( to );
		});
	});

	
	
	//Header Colors
	wp.customize( 'microNavColor', function( value ) {								
		value.bind( function( to ) {
			if ( 'blank' === to ) {
				//do nothing
			} else {	
				//alert(to);	
				$( '.pro-cast-header-row-wrapper-micro-nav' ).css({
					backgroundColor : to
				});	
				
				/*$( '.pro-cast-social-icons li' ).css({
					borderLeft : '1px solid' + to
					borderRight : '1px solid' + to
					borderBottom : '1px solid' + to
				});*/
				
				/*$( '.pro-cast-general-info' ).css({
					color : to
				});	*/
				
			}			
		});		
	});	
	//end Header Colors
	
	//Header slider options	
	
	wp.customize( 'headerPadding', function( value ) {								
		value.bind( function( to ) {			
			if ( 'blank' === to ) {
				//do nothing
			} else {
	
				$( 'header' ).css({
					paddingTop : to + 'px',
					paddingBottom : to  + 'px'
					//opacity : to / 100
				});				
			}			
		});		
	});
	
	wp.customize( 'subHeaderHeight', function( value ) {								
		value.bind( function( to ) {			
			if ( 'blank' === to ) {
				//do nothing
			} else {
	
				$( '.pm-sub-header-info' ).css({
					height : to + 'px',
					//opacity : to / 100
				});				
			}			
		});		
	});
	

	//Footer slider options	
	wp.customize( 'fatFooterPadding', function( value ) {								
		value.bind( function( to ) {			
			if ( 'blank' === to ) {
				//do nothing
			} else {
				$( '.pm-fat-footer' ).css({
					paddingTop : to + 'px',
					paddingBottom : to  + 'px'
					//opacity : to / 100
				});				
			}			
		});		
	});
	
	
	/*$( '.pro-cast-social-icons li' ).css({
		borderLeft : '1px solid' + to
		borderRight : '1px solid' + to
		borderBottom : '1px solid' + to
	});*/
	
	/*$( '.pro-cast-general-info' ).css({
		color : to
	});	*/
	
	//Global options
	wp.customize( 'primaryColor', function( value ) {								
		value.bind( function( to ) {
			if ( 'blank' === to ) {
				//do nothing
			} else {	
				//alert(to);	
				$( '.carousel-indicators li' ).css({
					border : '1px solid' + to
				});	
				
				$( '.carousel-indicators .active' ).css({
					backgroundColor : to
				});	
				
				$( '.carousel-indicators .active' ).css({
					backgroundColor : to
				});	
				
				$( '.carousel-control' ).css({
					backgroundColor : to
				});	
				
				$( '.checkout-button' ).css({
					backgroundColor : to
				});	
				
				$( '.button' ).css({
					backgroundColor : to
				});	
				
				$( '.remove' ).css({
					backgroundColor : to
				});	
				
				$( '.pm-services-post-icon i' ).css({
					color : to
				});	
				
				$( '.pm-services-post-icon' ).css({
					border : '3px solid' + to
				});
				
				$( '.pm-services-post-excerpt p a' ).css({
					color : to
				});	
				
				$( '.pm-form-textfield' ).css({
					color : to
				});	
				
				$( '.pm-form-textarea' ).css({
					color : to
				});	
				
				$( '.pm-required' ).css({
					color : to
				});	
				
				$( '.pm-icon-bundle' ).css({
					backgroundColor : to
				});	
				
				$( '.widget_shopping_cart_content .buttons .wc-forward' ).css({
					backgroundColor : to
				});	
				
				$( '.price_slider_amount .button' ).css({
					backgroundColor : to
				});	
				
				$( '.pm-tweet-list ul li a' ).css({
					color : to
				});
				
				$( '#pm-ln-glossary-search-results-container' ).css({
					border : '1px solid' + to
				});
				
				$( '#pm-ln-glossary-search-results-close' ).css({
					color : to
				});
				
				$( '.pm-single-news-post-icon i' ).css({
					color : to
				});
				
				$( '.single_add_to_cart_button' ).css({
					backgroundColor : to
				});
				
				$( '.single_variation .price .amount' ).css({
					color : to
				});
				
				$( '.widget_rss ul li a' ).css({
					color : to
				});
				
				$( '.pagination_multi li' ).css({
					backgroundColor : to,
					border : "3px solid" + to
				});
				
				$( '.pm-post-navigation li a' ).css({
					color : to
				});
				
				$( '.pm-square-btn.appointment-form' ).css({
					backgroundColor : to,
					border : "3px solid" + to
				});
				
				$( '.pm-single-post-like-btn' ).css({
					backgroundColor : to,
					border : "3px solid" + to
				});
				
				$( '.pm-header-info li p i' ).css({
					color : to
				});
				
				$( '.pm-footer-navigation li.current_page_item a' ).css({
					borderTop : "3px solid" + to
				});
				
				$( '.pm-footer-copyright-col a' ).css({
					color : to
				});
				
				$( '.pm-woocom-item-price' ).css({
					color : to
				});
				
				$( '.pm-store-post-tags' ).css({
					backgroundColor : to
				});
				
				$( '.pm-store-post-details-btn' ).css({
					backgroundColor : to
				});
				
				$( '.pm-store-post-quantity' ).css({
					color : to
				});
				
				$( '#pm-back-top' ).css({
					border : "3px solid" + to
				});
				
				$( '#pm-back-top i' ).css({
					color : to
				});
				
				$( '.pm-widget-footer .tagcloud a' ).css({
					backgroundColor : to
				});
				
				$( '.pm-sidebar-search-container' ).css({
					border : "1px solid" + to
				});
				
				$( '.pm-sidebar .widget_categories ul li' ).css({
					color : to
				});
				
				$( '.pm-sidebar .tweet_list li a' ).css({
					color : to
				});
				
				$( '.pm-widget-footer .tweet_list li a' ).css({
					color : to
				});
				
				$( '.pm-widget-footer .pm-recent-blog-posts .pm-date-published' ).css({
					color : to
				});
				
				$( '.pm_quick_contact_field.Light' ).css({
					border : "1px solid" + to
				});
				
				$( '.pm_quick_contact_textarea.Light' ).css({
					border : "1px solid" + to
				});
				
				$( '.pm-sidebar h6' ).css({
					backgroundColor : to
				});
				
				$( '.pm-standalone-news-post-icon' ).css({
					color : to,
					border : "3px solid" + to
				});
				
				$( '.pm-standalone-news-post-excerpt p a' ).css({
					color : to
				});
				
				$( '.pm-pagination li' ).css({
					backgroundColor : to,
					border : "3px solid" + to
				});
				
				$( '.pm-widget-footer h6 span' ).css({
					color : to
				});
				
				$( '.pm-fat-footer-title-divider' ).css({
					backgroundColor : to
				});
				
				$( '.pm_quick_contact_submit' ).css({
					backgroundColor : to
				});
				
				$( '.pm-single-news-post-avatar-icon' ).css({
					border : "3px solid" + to
				});
				
				$( '.pm-comment-form-textfield' ).css({
					borderBottom : "3px solid" + to
				});
				
				$( '.pm-comment-form-textarea' ).css({
					borderBottom : "3px solid" + to
				});
				
				$( '.pm-form-textfield-with-icon' ).css({
					border : "3px solid" + to
				});
				
				$( '.pm-ln-glossary-index li a.current' ).css({
					backgroundColor : to
				});
				
				$( '.pm-ln-glossary-index li a' ).css({
					borderBottom : "1px solid" + to,
					borderRight : "1px solid" + to,
					borderTop : "1px solid" + to
				});
				
				$( '.pm-glossary-filter' ).css({
					border : "1px solid" + to
				});
				
				$( '.pm-added-to-cart-icon' ).css({
					backgroundColor : to
				});
				
				$( '.page-numbers.current' ).css({
					backgroundColor : to,
					border : "1px solid" + to
				});
				
				$( '.woocommerce #respond input#submit' ).css({
					backgroundColor : to
				});
				
				$( '.woocommerce a.button' ).css({
					backgroundColor : to
				});
				
				$( '.woocommerce button.button' ).css({
					backgroundColor : to
				});
				
				$( '.woocommerce input.button' ).css({
					backgroundColor : to
				});
				
				$( '.woocommerce #respond input#submit.alt' ).css({
					backgroundColor : to
				});
				
				$( '.woocommerce a.button.alt' ).css({
					backgroundColor : to
				});
				
				$( '.woocommerce button.button.alt' ).css({
					backgroundColor : to
				});
				
				$( '.woocommerce input.button.alt' ).css({
					backgroundColor : to
				});
				
				$( '.product_meta > span > a' ).css({
					color : to
				});
				
				$( '.woocommerce div.product .woocommerce-tabs ul.tabs li' ).css({
					backgroundColor : to
				});
				
				$( '.woocommerce div.product form.cart .reset_variations' ).css({
					backgroundColor : to
				});
				
				$( '.pm-already-in-cart a' ).css({
					color : to
				});
				
				$( '.pm-square-btn.woocomm' ).css({
					backgroundColor : to,
					border : "3px solid" + to
				});
				
				$( '.pm-woocomm-tabs-column' ).css({
					backgroundColor : to
				});
				
				$( '.woocommerce-error' ).css({
					backgroundColor : to
				});
				
				$( '.woocommerce-info' ).css({
					color : to
				});
				
				$( '.pm-primary' ).css({
					color : to
				});
				
				$( '.pm-glossary-search-box' ).css({
					border : "1px solid" + to
				});
				
				$( '.pm-standalone-news-post-excerpt p a' ).css({
					color : to
				});
				
				$( '.btn.pm-owl-prev' ).css({
					backgroundColor : to
				});
				
				$( '.btn.pm-owl-next' ).css({
					backgroundColor : to
				});
				
				$( '.pm-testimonial-img-icon' ).css({
					border : "3px solid" + to
				});
				
				$( '.pm-staff-profile-icons li a' ).css({
					backgroundColor : to
				});
				
				$( '.pm-newsletter-form-container input[type="text"]' ).css({
					border : "1px solid" + to
				});
				
				$( '.pm-video-activator-btn' ).css({
					border : "3px solid" + to,
					color : to
				});
				
				$( '.pm-form-textfield' ).css({
					border : "1px solid" + to
				});
				
				$( '.pm-form-textarea' ).css({
					border : "1px solid" + to
				});
				
				$( '.pm-checkout-tabs > li a' ).css({
					backgroundColor : to
				});
				
				$( '.tinynav' ).css({
					border : "1px solid" + to
				});
				
				$( '.pm-isotope-filter-system-expand' ).css({
					backgroundColor : to
				});
				
				$( '.pm-header-info li p a' ).css({
					color : to
				});
				
				$( 'p a' ).css({
					color : to
				});
				
				$( 'blockquote a' ).css({
					color : to
				});
				
				$( '.pm-isotope-filter-system li a.current' ).css({
					borderBottom : "1px solid" + to
				});
				
				$( '.pm-gallery-item-btns li a' ).css({
					backgroundColor : to
				});
				
				$( '.pm-single-post-social-features' ).css({
					borderTop : "1px solid" + to
				});
				
				$( '.flex-direction-nav a' ).css({
					backgroundColor : convertHex(to, 80)
				});
				
				$( '.pm-services-post-overlay' ).css({
					backgroundColor : convertHex(to, 90)
				});
				
			}			
		});		
	});	
	
				
				
				
				
	wp.customize( 'secondaryColor', function( value ) {								
		value.bind( function( to ) {
			if ( 'blank' === to ) {
				//do nothing
			} else {	
				//alert(to);	
				$( '.mini_cart_item .remove' ).css({
					backgroundColor : to
				});	
				
				$( '.reset_variations' ).css({
					color : to
				});	
				
				$( '.pm_search_page_submit' ).css({
					backgroundColor : to
				});	
				
				$( '.sf-menu li.current-menu-item > a' ).css({
					backgroundColor : to
				});	
				
				$( '.pm_quick_contact_field.invalid_field' ).css({
					border : "1px solid" + to
				});
				
				$( '.pm_quick_contact_textarea.invalid_field' ).css({
					border : "1px solid" + to
				});
				
				$( '.pm-sidebar-link' ).css({
					color : to
				});
				
				$( '.pm-staff-profile-title' ).css({
					color : to
				});
				
				$( '.pm-pagination li.current' ).css({
					backgroundColor : to,
					border : "3px solid" + to
				});
				
				$( '.pm-pagination.pm-knowledge-base-pagination li.current' ).css({
					backgroundColor : to,
					border : "1px solid" + to
				});
				
				$( '.pm-sidebar-search-container i' ).css({
					color : to
				});
				
				$( '.pm-rounded-btn' ).css({
					backgroundColor : to,
				});
				
				$( '.pm-rounded-btn.transparent' ).css({
					color : to
				});
				
				$( '.pm-recent-blog-posts .pm-date-published' ).css({
					color : to
				});
				
				$( '.pm-woocomm-item-sale-tag' ).css({
					backgroundColor : to,
				});
				
				$( '.woocommerce ul.products li.product .price' ).css({
					color : to
				});
				
				$( '.woocommerce form .form-row.woocommerce-validated .select2-container' ).css({
					borderColor : to
				});
				
				$( '.woocommerce form .form-row.woocommerce-validated input.input-text' ).css({
					borderColor : to
				});
				
				$( '.woocommerce form .form-row.woocommerce-validated select' ).css({
					borderColor : to
				});
				
				$( '.comment-form-rating .stars span a i.activated' ).css({
					color : to
				});
				
				$( '.pm-rounded-submit-btn, #place_order' ).css({
					backgroundColor : to,
				});
				
				$( '.lost_reset_password input[type="submit"]' ).css({
					backgroundColor : to,
				});
				
				$( '.woocommerce .form-row input[type="submit"]' ).css({
					backgroundColor : to,
				});
				
				$( '.pm-icon-btn' ).css({
					backgroundColor : to,
				});
				
				$( '.pm-column-container-message' ).css({
					backgroundColor : to,
				});
				
				$( '.pm-secondary' ).css({
					color : to,
				});
				
				$( '.owl-item .pm-brand-item a' ).css({
					backgroundColor : to,
				});
				
				$( '.pm-staff-profile-expander' ).css({
					backgroundColor : to,
				});
				
				$( '.pm-newsletter-submit-btn' ).css({
					backgroundColor : to,
				});
				
				$( '.panel-title i' ).css({
					backgroundColor : to,
				});
				
				$( '.pm-form-textarea.invalid_field' ).css({
					border : "1px solid" + to
				});
				
				$( '.pm-form-textfield.invalid_field' ).css({
					border : "1px solid" + to
				});
				
				$( '.pm-checkout-tabs > li.active > a' ).css({
					backgroundColor : to,
				});
				
				$( '.pm-gallery-item-expander' ).css({
					backgroundColor : to,
				});
				
				$( '.pm-post-loaded-info li a' ).css({
					backgroundColor : to,
				});
				
				$( '.pm-related-blog-posts .pm-date' ).css({
					color : to,
				});
				
				$( '.pm-nav-tabs > li > a' ).css({
					backgroundColor : to,
				});
				
			}			
		});		
	});	
	
				
				
	wp.customize( 'offsetColor', function( value ) {								
		value.bind( function( to ) {
			if ( 'blank' === to ) {
				//do nothing
			} else {	
				//alert(to);	
				$( '.woocommerce span.onsale' ).css({
					backgroundColor : to
				});	
				
				$( '.woocommerce ul.products li.product .price' ).css({
					color : to,
				});
				
				$( '.woocommerce div.product .woocommerce-tabs ul.tabs li.active > a' ).css({
					backgroundColor : to
				});
				
				$( '.woocommerce .star-rating span' ).css({
					color : to,
				});
				
				$( '.woocommerce p.stars a' ).css({
					color : to,
				});
				
				$( '.woocommerce-review-link' ).css({
					color : to,
				});
				
				$( '.woocommerce form .form-row.woocommerce-invalid .select2-container' ).css({
					borderColor : to,
				});
				
				$( '.woocommerce form .form-row.woocommerce-invalid input.input-text' ).css({
					borderColor : to,
				});
				
				$( '.woocommerce form .form-row.woocommerce-invalid select' ).css({
					borderColor : to,
				});
				
				$( '.woocommerce form .form-row.woocommerce-invalid label' ).css({
					color : to,
				});
				
				$( '.woocommerce form .form-row .required' ).css({
					color : to,
				});
				
				$( '.woocommerce a.remove' ).css({
					backgroundColor : to
				});
				
				$( '.woocommerce-error' ).css({
					borderTop : "3px solid" + to
				});
				
				$( '.woocommerce-info' ).css({
					borderTop : "3px solid" + to
				});
				
				$( '.woocommerce-message' ).css({
					borderTop : "3px solid" + to
				});
				
				
			}			
		});		
	});	
	
	
	wp.customize( 'pageBackgroundColor', function( value ) {								
		value.bind( function( to ) {
			if ( 'blank' === to ) {
				//do nothing
			} else {	
				//alert(to);	
				$( 'body' ).css({
					backgroundColor : to
				});					
			}			
		});		
	});	
	
	wp.customize( 'boxedModeContainerColor', function( value ) {								
		value.bind( function( to ) {
			if ( 'blank' === to ) {
				//do nothing
			} else {	
				//alert(to);	
				$( '.pm-boxed-mode' ).css({
					backgroundColor : to
				});					
			}			
		});		
	});	
	
	wp.customize( 'tooltipColor', function( value ) {								
		value.bind( function( to ) {
			if ( 'blank' === to ) {
				//do nothing
			} else {	
				//alert(to);	
				$( '#pm_marker_tooltip' ).css({
					backgroundColor : to
				});					
			}			
		});		
	});	
	
	wp.customize( 'blockquote', function( value ) {								
		value.bind( function( to ) {
			if ( 'blank' === to ) {
				//do nothing
			} else {	
				//alert(to);	
				$( '#pm_marker_tooltip' ).css({
					borderLeft : "2px solid" + to
				});					
			}			
		});		
	});	
	

	
	wp.customize( 'dividerColor', function( value ) {								
		value.bind( function( to ) {
			if ( 'blank' === to ) {
				//do nothing
			} else {	
				//alert(to);	
				$( '.pm-column-title-divider.locations-template' ).css({
					borderTop : "1px solid" + to
				});
				
				$( '.shop_table thead' ).css({
					border : "1px solid" + to
				});
				
				$( '.woocommerce table.shop_table tbody th' ).css({
					borderTop : "1px solid" + to
				});
				
				$( '.woocommerce table.shop_table tfoot td' ).css({
					borderTop : "1px solid" + to
				});
				
				$( '.woocommerce table.shop_table tfoot th' ).css({
					borderTop : "1px solid" + to
				});
				
				$( '.select2-container--default .select2-selection--single' ).css({
					border : "1px solid" + to
				});
				
				$( '.product-categories li' ).css({
					borderBottom : "1px solid" + to
				});
				
				$( '.woocommerce .widget_shopping_cart .total' ).css({
					borderTop : "1px solid" + to
				});
				
				$( '.woocommerce.widget_shopping_cart .total' ).css({
					borderTop : "1px solid" + to
				});
				
				$( '.pm-trends-list li' ).css({
					borderBottom : "1px solid" + to
				});
				
				$( '.woocommerce .woocommerce-ordering select' ).css({
					border : "1px solid" + to
				});
				
				$( '.pro-cast-woocomm-header-divider' ).css({
					backgroundColor : to
				});
				
				$( '.pm-store-post-container' ).css({
					border : "1px solid" + to
				});
				
				$( '.pm-isotope-filter-system' ).css({
					borderBottom : "1px solid" + to
				});
				
				$( '.woocommerce #reviews #comment' ).css({
					border : "1px solid" + to
				});
				
				$( '.input-text.qty.text' ).css({
					border : "1px solid" + to
				});
				
				$( '.woocommerce #reviews #comments ol.commentlist li .comment-text' ).css({
					border : "1px solid" + to
				});
				
				$( '.woocommerce div.product form.cart .variations select' ).css({
					border : "1px solid" + to
				});
				
				$( '.woocommerce table.shop_table' ).css({
					border : "1px solid" + to
				});
				
				$( '.woocommerce table.shop_table td' ).css({
					border : "1px solid" + to
				});
				
				$( '.woocommerce form .form-row input.input-text' ).css({
					border : "1px solid" + to
				});
				
				$( '.woocommerce form .form-row textarea' ).css({
					border : "1px solid" + to
				});
				
				$( '.woocommerce form .form-row select' ).css({
					border : "1px solid" + to
				});
				
				$( '.pm-icon-bundle' ).css({
					border : "1px solid" + to,
					backgroundColor : to
				});
				
				$( '.single_variation' ).css({
					borderTop : "1px solid" + to
				});
				
				$( '.widget_nav_menu ul li .sub-menu' ).css({
					borderTop : "1px solid" + to
				});
				
				$( '.pm-nav-tabs' ).css({
					borderBottom : "1px solid" + to
				});
				
				$( '.pm-staff-profile-overlay-container.single-post' ).css({
					border : "1px solid" + to
				});
				
				$( '.pm-sub-header-breadcrumbs' ).css({
					borderBottom : "1px solid" + to,
					borderTop : "1px solid" + to
				});
				
				$( '.pm-post-navigation li' ).css({
					borderRight : "1px solid" + to
				});
				
				$( '.pm-divider.knowledgebase-post' ).css({
					backgroundColor : to
				});
				
				$( '.pm-page-share-options' ).css({
					borderTop : "1px solid" + to
				});
				
				$( '.pm-store-post-container' ).css({
					border : "1px solid" + to
				});
									
			}			
		});		
	});	
	
				
	//Header colors
	wp.customize( 'navDropDownBorderColor', function( value ) {								
		value.bind( function( to ) {
			if ( 'blank' === to ) {
				//do nothing
			} else {	
				//alert(to);	
				$( '.sf-menu ul li' ).css({
					borderBottom : "1px solid" + to
				});	
				
				$( '.sf-menu ul ul' ).css({
					borderLeft : "1px solid" + to
				});
				
				$( '.pm-dropmenu-active ul li' ).css({
					borderTop : "1px solid" + to
				});	
				
				$( '.sf-menu ul' ).css({
					borderTop : "1px solid" + to,
					borderBottom : "1px solid" + to
				});	
								
			}			
		});		
	});		
	
	wp.customize( 'microMenuBackgroundColor', function( value ) {								
		value.bind( function( to ) {
			if ( 'blank' === to ) {
				//do nothing
			} else {	
				//alert(to);	
				$( '.pm-sub-menu-container' ).css({
					backgroundColor : to
				});	
								
			}			
		});		
	});	
	
	wp.customize( 'mobileNavToggleColor', function( value ) {								
		value.bind( function( to ) {
			if ( 'blank' === to ) {
				//do nothing
			} else {	
				//alert(to);	
				$( '.mean-container a.meanmenu-reveal span' ).css({
					backgroundColor : to
				});	
				
				$( '.mean-container .mean-nav ul li a.mean-expand' ).css({
					color : to
				});	
				
				$( '.mean-container a.meanmenu-reveal' ).css({
					color : to
				});	
								
			}			
		});		
	});		
	
	wp.customize( 'subpageHeaderBackgroundColor', function( value ) {								
		value.bind( function( to ) {
			if ( 'blank' === to ) {
				//do nothing
			} else {	
				//alert(to);	
				$( '.pm-sub-header-container' ).css({
					backgroundColor : to
				});	
								
			}			
		});		
	});	
	
	wp.customize( 'searchFieldCategoryColor', function( value ) {								
		value.bind( function( to ) {
			if ( 'blank' === to ) {
				//do nothing
			} else {	
				//alert(to);	
				$( '.pm-search-field-container' ).css({
					border : "3px solid" + to
				});	
				
				$( '.pm-dropdown.pm-categories-menu' ).css({
					border : "3px solid" + to
				});	
				
				$( '.pm-dropdown.pm-categories-menu .pm-dropmenu-active ul li' ).css({
					border : "3px solid" + to
				});	
				
				$( '.pm-search-field-container a' ).css({
					color : to
				});	
				
				$( '.pm-dropdown.pm-categories-menu .pm-dropmenu i' ).css({
					color : to
				});	
								
			}			
		});		
	});	
	
	wp.customize( 'searchFieldCategoryTextColor', function( value ) {								
		value.bind( function( to ) {
			if ( 'blank' === to ) {
				//do nothing
			} else {	
				//alert(to);	
				$( '.pm-search-field' ).css({
					color : to
				});	
				
				$( '.pm-dropdown.pm-categories-menu .pm-menu-title' ).css({
					color : to
				});	
				
				$( '.pm-dropdown.pm-categories-menu .pm-dropmenu-active ul li a' ).css({
					color : to
				});	
								
			}			
		});		
	});	
	
	wp.customize( 'expandableDivColor', function( value ) {								
		value.bind( function( to ) {
			if ( 'blank' === to ) {
				//do nothing
			} else {	
				//alert(to);	
				$( '.pm-request-appointment-form' ).css({
					backgroundColor : to
				});	
								
			}			
		});		
	});	
	
	
	wp.customize( 'socialIconColor', function( value ) {								
		value.bind( function( to ) {
			if ( 'blank' === to ) {
				//do nothing
			} else {	
				//alert(to);	
				$( '.pm-social-navigation li a' ).css({
					color : to,
					border : "3px solid" + to
				});
				
				$( '.pm-single-post-social-icons li a' ).css({
					color : to,
					border : "2px solid" + to
				});	
				
				$( '.pm-page-social-icons li a' ).css({
					color : to,
					border : "2px solid" + to
				});	
							
			}			
		});		
	});	
	
	wp.customize( 'postTitleColor', function( value ) {								
		value.bind( function( to ) {
			if ( 'blank' === to ) {
				//do nothing
			} else {	
				//alert(to);	
				$( '.pm-standalone-news-post-overlay' ).css({
					backgroundColor : convertHex(to, 99)
				});
				
				$( '.pm-single-news-post-overlay' ).css({
					backgroundColor : convertHex(to, 99)
				});	
				
							
			}			
		});		
	});	
	
	wp.customize( 'authorCommentsBoxColor', function( value ) {								
		value.bind( function( to ) {
			if ( 'blank' === to ) {
				//do nothing
			} else {	
				//alert(to);	
				$( '.pm-author-column' ).css({
					backgroundColor : convertHex(to, 99)
				});
				
				$( '.pm-comments-column' ).css({
					backgroundColor : convertHex(to, 99)
				});
				
							
			}			
		});		
	});	
	
	wp.customize( 'authorDividerColor', function( value ) {								
		value.bind( function( to ) {
			if ( 'blank' === to ) {
				//do nothing
			} else {	
				//alert(to);	
				$( '.pm-author-divider' ).css({
					backgroundColor : convertHex(to, 99)
				});
				
							
			}			
		});		
	});	
	
	wp.customize( 'authorBorderColor', function( value ) {								
		value.bind( function( to ) {
			if ( 'blank' === to ) {
				//do nothing
			} else {	
				//alert(to);	
				$( '.pm-author-bio-img-bg' ).css({
					border : "5px solid" + to
				});
						
			}			
		});		
	});	
	
	wp.customize( 'accordionContentBgColor', function( value ) {								
		value.bind( function( to ) {
			if ( 'blank' === to ) {
				//do nothing
			} else {	
				//alert(to);	
				$( '.panel-collapse' ).css({
					backgroundColor : to
				});
				
							
			}			
		});		
	});	
	
	wp.customize( 'tabContentBgColor', function( value ) {								
		value.bind( function( to ) {
			if ( 'blank' === to ) {
				//do nothing
			} else {	
				//alert(to);	
				$( '.pm-tab-content' ).css({
					backgroundColor : to
				});
				
							
			}			
		});		
	});	
	
	wp.customize( 'data_table_title_color', function( value ) {								
		value.bind( function( to ) {
			if ( 'blank' === to ) {
				//do nothing
			} else {	
				//alert(to);	
				$( '.pm-workshop-table-title' ).css({
					backgroundColor : to
				});
				
							
			}			
		});		
	});	
	
	wp.customize( 'data_table_info_color', function( value ) {								
		value.bind( function( to ) {
			if ( 'blank' === to ) {
				//do nothing
			} else {	
				//alert(to);	
				$( '.pm-workshop-table-content' ).css({
					backgroundColor : to
				});		
			}			
		});		
	});	
	
	wp.customize( 'testimonials_carousel_color', function( value ) {								
		value.bind( function( to ) {
			if ( 'blank' === to ) {
				//do nothing
			} else {	
				//alert(to);	
				$( '.pm-testimonials-arrows a' ).css({
					color : to
				});
				
				$( '.pm-testimonial-img' ).css({
					border : "5px solid" + to
				});
				
							
			}			
		});		
	});	
	
	wp.customize( 'timetable_font_color', function( value ) {								
		value.bind( function( to ) {
			if ( 'blank' === to ) {
				//do nothing
			} else {	
				//alert(to);	
				$( '.pm-timetable-panel-content-body ul li' ).css({
					color : to
				});
				
				$( '.pm-timetable-panel-title a' ).css({
					color : to
				});
				
				$( '.pm-timetable-accordion-panel .pm-timetable-panel-heading a.pm-accordion-horizontal-open' ).css({
					color : to
				});
							
			}			
		});		
	});	
	
	wp.customize( 'timetable_border_color', function( value ) {								
		value.bind( function( to ) {
			if ( 'blank' === to ) {
				//do nothing
			} else {	
				//alert(to);	
				$( '.pm-timetable-panel-content-body ul li' ).css({
					borderBottom : "1px solid" + to
				});
							
			}			
		});		
	});	
	
	wp.customize( 'alert_warning_color', function( value ) {								
		value.bind( function( to ) {
			if ( 'blank' === to ) {
				//do nothing
			} else {	
				//alert(to);	
				$( '.alert-warning' ).css({
					backgroundColor : to
				});		
			}			
		});		
	});	
	
	wp.customize( 'alert_success_color', function( value ) {								
		value.bind( function( to ) {
			if ( 'blank' === to ) {
				//do nothing
			} else {	
				//alert(to);	
				$( '.alert-success' ).css({
					backgroundColor : to
				});		
			}			
		});		
	});	
	
	wp.customize( 'alert_danger_color', function( value ) {								
		value.bind( function( to ) {
			if ( 'blank' === to ) {
				//do nothing
			} else {	
				//alert(to);	
				$( '.alert-danger' ).css({
					backgroundColor : to
				});		
			}			
		});		
	});	
	
	wp.customize( 'alert_info_color', function( value ) {								
		value.bind( function( to ) {
			if ( 'blank' === to ) {
				//do nothing
			} else {	
				//alert(to);	
				$( '.alert-info' ).css({
					backgroundColor : to
				});		
			}			
		});		
	});	
	
	wp.customize( 'alert_notice_color', function( value ) {								
		value.bind( function( to ) {
			if ( 'blank' === to ) {
				//do nothing
			} else {	
				//alert(to);	
				$( '.alert-notice' ).css({
					backgroundColor : to
				});		
			}			
		});		
	});	
	
	wp.customize( 'sliderButtonColor', function( value ) {								
		value.bind( function( to ) {
			if ( 'blank' === to ) {
				//do nothing
			} else {	
				//alert(to);	
				$( '.pm-slide-btn' ).css({
					backgroundColor : to
				});		
			}			
		});		
	});	
	
	wp.customize( 'bulletColor', function( value ) {								
		value.bind( function( to ) {
			if ( 'blank' === to ) {
				//do nothing
			} else {	
				//alert(to);	
				$( '.pm-dots span.pm-currentDot' ).css({
					backgroundColor : to
				});		
			}			
		});		
	});	
	
	wp.customize( 'bulletBgColor', function( value ) {								
		value.bind( function( to ) {
			if ( 'blank' === to ) {
				//do nothing
			} else {	
				//alert(to);	
				$( '.pm-dots span' ).css({
					backgroundColor : to
				});		
			}			
		});		
	});	



	// Page layouts.
	/*wp.customize( 'page_layout', function( value ) {
		value.bind( function( to ) {
			if ( 'one-column' === to ) {
				$( 'body' ).addClass( 'page-one-column' ).removeClass( 'page-two-column' );
			} else {
				$( 'body' ).removeClass( 'page-one-column' ).addClass( 'page-two-column' );
			}
		} );
	} );*/
	
	//convertHex('#A7D136',50)
	function convertHex(hex,opacity){
		hex = hex.replace('#','');
		r = parseInt(hex.substring(0,2), 16);
		g = parseInt(hex.substring(2,4), 16);
		b = parseInt(hex.substring(4,6), 16);
	
		result = 'rgba('+r+','+g+','+b+','+opacity/100+')';
		return result;
	}

	// Whether a header image is available.
	function hasHeaderImage() {
		var image = wp.customize( 'header_image' )();
		return '' !== image && 'remove-header' !== image;
	}

	// Whether a header video is available.
	function hasHeaderVideo() {
		var externalVideo = wp.customize( 'external_header_video' )(),
			video = wp.customize( 'header_video' )();

		return '' !== externalVideo || ( 0 !== video && '' !== video );
	}

	// Toggle a body class if a custom header exists.
	/*$.each( [ 'external_header_video', 'header_image', 'header_video' ], function( index, settingId ) {
		wp.customize( settingId, function( setting ) {
			setting.bind(function() {
				if ( hasHeaderImage() ) {
					$( document.body ).addClass( 'has-header-image' );
				} else {
					$( document.body ).removeClass( 'has-header-image' );
				}

				if ( ! hasHeaderVideo() ) {
					$( document.body ).removeClass( 'has-header-video' );
				}
			} );
		} );
	} );*/

} )( jQuery );