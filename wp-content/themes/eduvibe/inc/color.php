<?php
if( ! function_exists( 'eduvibe_custom_color_styles' ) ) :
	function eduvibe_custom_color_styles() {
	    $custom_css = '';

		if( eduvibe_get_config( 'custom_color', false ) ) :
			$primary_color = eduvibe_get_config( 'primary_color', '#3655C6' );
			$body_color    = eduvibe_get_config( 'body_color', '#021e40' );
			$custom_css .= "a, h1.site-title a, h1.site-title a:hover, h1.site-title a:active, h1.site-title a:focus, .eduvibe-course-content-right-side-wrapper .eduvibe-course-video-preview-popup,.eduvibe-single-course .course-content .course-price-wrap .course-price,.single-sfwd-courses .eduvibe-course-content-right-side-wrapper .eduvibe-course-meta-informations li:hover .eduvibe-course-feature-item-value,.eduvibe-single-course.course-style-five .course-content .course-meta ul li.course-five-cat a,.eduvibe-testimonial-slider-one .slick-arrow:hover,.eduvibe-testimonial-slider-one .eduvibe-testimonial-author .eduvibe-testimonial-eduvibe-testimonial-author-info-wrap .eduvibe-testimonial-author-info h5, .eduvibe-testimonial-slider-two .slick-arrow:hover, .eduvibe-testimonial-three-inner .testimonial-author .author-info h5, .eduvibe-single-service-two .service-icon i, .eduvibe-funfact-icon i, .eduvibe-wishlist-icon a.updating-icon:before, .eduvibe-wishlist-icon a.has-wish-listed:before, .eduvibe-single-course .course-content .course-price-wrap .price, .woocommerce-password-strength.good, body #profile-content-courses .lp-sub-menu li span, .eduvibe-single-service .service-content a, #learn-press-course .learn-press-course-wishlist.eduvibe-button-item:hover, .eduvibe-single-course .course-image .course-save .eduvibe-wishlist-icon:hover a:before, .has-theme-primary-color, .eduvibe-post-slider .slick-arrow:hover i, .eduvibe-single-course.course-style-three .course-list-item i, .eduvibe-single-course.course-style-three .course-enroll, .eduvibe-single-course.course-style-four .course-meta-info li i, .eduvibe-zoom-single-meta-info .join-links > a:hover, .eduvibe-social-share-icons-wrapper a, .eduvibe-event-two-single-item .event-inner:hover .eduvibe-button-item.eduvibe-button-type-fill, .eduvibe-button-item.eduvibe-button-type-fill:hover, .eduvibe-button-item.eduvibe-button-type-bordered, .post-password-form input[type=submit]:hover, .eduvibe-comments-area .eduvibe-comment-btn:hover, .eduvibe-comments-area .logged-in-as a, .eduvibe-services-two-slider .slick-arrow i, .eduvibe-course-cat-widget-each-item i, .widget_lp-widget-featured-courses .widget-footer a.pull-right:hover, .eduvibe-contact-form-single-item-content .eduvibe-contact-form-icon, .widget_lp-widget-recent-courses .widget-footer a.pull-right:hover, .widget_lp-widget-popular-courses .widget-footer a.pull-right:hover, .widget_eduvibecore_lp_courses_widget .eduvibe-recent-course-each-item .eduvibe-recent-course-price, .widget_eduvibecore_ld_courses_widget .eduvibe-recent-course-each-item .eduvibe-recent-course-price, .widget_eduvibecore_tl_courses_widget .eduvibe-recent-course-each-item .eduvibe-recent-course-price, .widget_products .product_list_widget li .woocommerce-Price-amount, .widget_top_rated_products .product_list_widget li .woocommerce-Price-amount, .eduvibe-course-slider-wrapper .slick-arrow:hover, .eduvibe-instructor-ticker-name a, .eduvibe-featured-event-wrapper .event-info i, .eduvibe-wishlist-icon span.ajaxload_wishlist:before, .eduvibe-wishlist-icon span.on:before, .eduvibe-single-course .course-image .course-save .eduvibe-wishlist-icon:hover span:before, .eduvibe-single-course .course-content .title a:hover, .eduvibe-single-course .course-content .course-price-wrap .course-price .price, body #profile-content-quizzes .lp-sub-menu li span, body .lp-tab-sections .section-tab.active span, .eduvibe-event-countdown .eduvibe-countdown-single-item .eduvibe-countdown-digit, .lp-single-course .eduvibe-course-content-right-side-wrapper .eduvibe-course-meta-informations li:hover .eduvibe-course-feature-item-value, .eduvibe-course-content-right-side-wrapper .eduvibe-course-video-preview-popup, .widget a:hover, .eduvibe-course-content-left-side-wrapper .course-curriculum ul.curriculum-sections .section-content .course-item.course-item-lp_quiz .section-item-link:before, .eduvibe-course-content-left-side-wrapper .course-curriculum ul.curriculum-sections .section-content .course-item.course-item-lp_lesson .section-item-link:before, .eduvibe-progressbar-active.elementor-widget-progress .elementor-title, .eduvibe-single-course.course-style-three .course-list-item i, .eduvibe-single-course.course-style-three .course-enroll, body #profile-content-settings button[type=button]:hover, body #profile-content-settings button[type=submit]:hover, body .learnpress-page #learn-press-profile-content .profile-recover-order .lp-button:hover, body .tutor-wrap .tutor-single-course-sidebar .tutor-price-preview-box .price, body .tutor-button.tutor-success:hover, .tutor-dashboard-content-inner .tutor-mycourses-stats a, body .tutor-course-enrolled-wrap p i, body .tutor-course-enrolled-wrap p span, body .plyr--full-ui input[type=range], body .tutor-course-topics-contents .tutor-course-title h4, body .tutor-custom-list-style li:before, .eduvibe-single-service .service-icon i, .learnpress .learn-press-checkout + a:hover, a.post-edit-link, blockquote.wp-block-quote, blockquote.wp-block-quote.is-style-large, .eduvibe-single-categories:hover .cate-icon, .eduvibe-single-course.course-style-five .course-content .course-meta ul li.course-five-cat a, #learn-press-checkout a, table.lp-list-table a, body .tutor-dashboard-permalinks a:active, .tutor-dashboard-permalinks a:before, .eduvibe-single-course.course-style-three .course-list-item i, .eduvibe-single-course.course-style-three .course-enroll, table.shop_table .product-remove a, table.shop_table>tbody>tr>td.product-remove a, .eduvibe-single-categories-two .cate-icon, .woocommerce-account .woocommerce-MyAccount-content a.eduvibe-my-account-dashborad-link, .eduvibe-tabs-wrapper.eduvibe-tabs-style-vertical .eduvibe-tab-title.active .eduvibe-tab-title-heading, blockquote.wp-block-quote p, blockquote.wp-block-quote.is-style-large p, .event-three-single-item-wrapper:hover .event-three-content h3.title, .event-three-single-item-wrapper:hover .event-three-content h3.title a { color: {$primary_color}; }";

			$custom_css .= "body .lp-list-table thead tr th, .eduvibe-single-course.course-style-four .course-price, .eduvibe-single-course.course-style-four .course-price > .price, .eduvibe-single-course.course-style-two .course-image .course-price, .eduvibe-single-course.course-style-three .course-price, .learnpress .learn-press-checkout + a, .eduvibe-course-ajax-search-result-area ul li a:hover, .eduvibe-single-course.course-style-three .price, body .tutor-single-course-meta ul li.tutor-social-share button:hover, .eduvibe-image-icon-box-one-carousel .slick-arrow:hover, .eduvibe-tabs-wrapper.eduvibe-tabs-style-horizontal .eduvibe-tab-title .eduvibe-tab-title-heading, .eduvibe-featured-instructor-details .eduvibe-instructor-details-info .eduvibe-instructor-social-info a:hover, .eduvibe-single-pricing-wrap .title-featured, .eduvibe-single-pricing:hover .pricing-head, .eduvibe-single-course.course-style-two .course-image .course-price, .eduvibe-single-course.course-style-three .course-price, .eduvibe-single-pricing:hover .pricing-footer a, .eduvibe-single-pricing.eduvibe-single-pricing-highlighted .pricing-head, .eduvibe-single-pricing.eduvibe-single-pricing-highlighted .pricing-footer a, .eduvibe-single-categories-two.default .categories-action-btn a, .eduvibe-single-categories .cate-icon, .eduvibe-single-categories:hover, .eduvibe-testimonial-three-inner:hover, .eduvibe-service-4-single-item.service-blue, .eduvibe-service-4-single-item, .eduvibe-single-service-two:hover, .eduvibe-single-service:hover, .eduvibe-event-two-single-item .event-inner:hover, .eduvibe-zoom-single-meta-info .join-links > a, .eduvibe-zoom-single-meta-info .dpn-zvc-timer, .eduvibe-single-event-countdown-content, .countdown-four, .eduvibe-default-button-yes.eduvibe-button-type-fill .elementor-button, .eduvibe-button-item.eduvibe-button-type-bordered:hover, .eduvibe-button-item.eduvibe-button-type-bordered span.dir-part, .eduvibe-button-item.eduvibe-button-type-fill, .post-password-form input[type=submit], .eduvibe-comments-area .eduvibe-comment-btn, p.eduvibe-cart-shop-page-link a, p.woocommerce-mini-cart__buttons .button.checkout, .eduvibe-mobile-menu-nav-wrapper, .eduvibe-header-area ul.eduvibe-navbar-nav .dropdown ul.eduvibe-dropdown-menu li:hover>a, .eduvibe-header-area .main-navigation ul.eduvibe-navbar-nav > li.current-menu-item > a:after, .eduvibe-header-area .main-navigation ul.eduvibe-navbar-nav > li:hover > a:after, .widget_lp-widget-featured-courses .widget-footer a.pull-right, .widget_lp-widget-recent-courses .widget-footer a.pull-right, .widget_lp-widget-popular-courses .widget-footer a.pull-right, .widget_product_search .woocommerce-product-search:after, .eduvibe-filter-course .filter-item:before, .eduvibe-single-lms-item .lms-icon, .eduvibe-course-slider-wrapper .slider-item:before, .eduvibe-course-slider-wrapper .slider-content-right, body #profile-content-settings button[type=button], body #profile-content-settings button[type=submit], body .learnpress-page #learn-press-profile-content .profile-recover-order .lp-button, .eduvibe-course-content-left-side-wrapper .eduvibe-author-social-info a:hover, a.eduvibe-social-icon-each-item, .eduvibe-single-course.course-style-two .course-image .course-price > .price, #learn-press-course .learn-press-course-wishlist.eduvibe-button-item, body #learn-press-user-profile #learn-press-profile-nav .tabs > li.active > a, body #learn-press-user-profile #learn-press-profile-nav .tabs > li.active > ul li.active > a, body #learn-press-user-profile #learn-press-profile-nav .tabs > li a:hover, body #learn-press-user-profile #learn-press-profile-nav .tabs > li:hover:not(.active) > a, body #learn-press-profile-nav .tabs>li:hover:not(.active)>a:hover, body #learn-press-user-profile #learn-press-profile-nav .tabs > li.active > a, .eduvibe-course-content-left-side-wrapper ul.learn-press-nav-tabs .course-nav.active a:after, .eduvibe-course-content-left-side-wrapper ul.learn-press-nav-tabs .course-nav a:hover:after, body .tutor-login-form-wrap input[type=submit], body .plyr--video .plyr__control:hover, body .plyr__control--overlaid, body .single_add_to_cart_button, body a.tutor-button, .tutor-button, body a.tutor-btn, .tutor-btn, body .tutor-login-form-wrap input[type=submit], body .tutor-course-enrolled-review-wrap .write-course-review-link-btn:hover, body .tutor-single-add-to-cart-box .tutor-enroll-form .tutor-course-enroll-wrap button, body .tutor-button.tutor-success, body .tutor-course-enrolled-review-wrap .write-course-review-link-btn, body .tutor-dashboard-permalinks li.active a, .eduvibe-timeline-circle:before, .woocommerce-info, .eduvibe-single-product-item a.button, .return-to-shop a.button.wc-backward, .eduvibe-single-product-item a.added_to_cart, .woocommerce-MyAccount-downloads-file.button, .woocommerce-orders-table__cell .woocommerce-button.button.view, .woocommerce-error, .woocommerce-info, .woocommerce-message, .woocommerce-tabs ul.tabs.wc-tabs li.active a:after, .woocommerce-tabs ul.tabs.wc-tabs li a:hover:after, p.no-comments, .woocommerce-account .woocommerce-MyAccount-navigation .is-active a, .woocommerce-account .woocommerce-MyAccount-navigation a:hover, .demo_store, .widget.widget_search form.search-form:after, .tutor-single-page-top-bar, blockquote.wp-block-quote:before { background-color: {$primary_color}; }";

			$custom_css .= "body .course-curriculum ul.curriculum-sections .section-content .course-item:before, .eduvibe-yoga-about-call .eduvibe-yoga-about-call-text, .eduvibe-tabs-wrapper.eduvibe-tabs-style-vertical .eduvibe-tab-title-heading:before, .has-theme-primary-background-color, .post-password-form input[type=submit], .eduvibe-comments-area .eduvibe-comment-btn, body .tutor-pagination-wrap span.current, body .tutor-pagination-wrap a:hover, body .learn-press-message.error:before, .widget_price_filter .ui-slider .ui-slider-handle, .widget_price_filter .ui-slider .ui-slider-range, body .learn-press-message:before, body #profile-content-courses .learn-press-message:before, .tutor-single-page-top-bar .tutor-single-lesson-segment button.course-complete-button:hover, nav.eduvibe-theme-page-links ul.pager li.active span, nav.eduvibe-theme-page-links ul.pager li:hover a, .eduvibe-pagination-wrapper .page-numbers .page-numbers.current, .eduvibe-pagination-wrapper .page-numbers .page-numbers:hover { background: {$primary_color}; }";

			$custom_css .= ".learnpress .learn-press-checkout + a, .eduvibe-timeline-circle, .eduvibe-featured-instructor-details .eduvibe-instructor-details-info .eduvibe-instructor-social-info a:hover, .eduvibe-single-pricing:hover .pricing-footer a, .eduvibe-single-service-two, .eduvibe-zoom-single-meta-info .join-links > a, .eduvibe-social-share-icons-wrapper a, .eduvibe-button-item.eduvibe-button-type-bordered:hover, .tutor-single-page-top-bar .tutor-single-lesson-segment button.course-complete-button:hover, .eduvibe-button-item.eduvibe-button-type-bordered, .eduvibe-button-item.eduvibe-button-type-fill, .widget_lp-widget-featured-courses .widget-footer a.pull-right, .widget_lp-widget-recent-courses .widget-footer a.pull-right, .widget_lp-widget-popular-courses .widget-footer a.pull-right, .eduvibe-course-content-left-side-wrapper .eduvibe-author-social-info a:hover, .woocommerce-additional-fields__field-wrapper textarea:focus, button:focus, input[type=button]:focus, input[type=reset]:focus, input[type=submit]:focus, select:focus, textarea:focus, input[type=text]:focus, input[type=email]:focus, input[type=url]:focus, input[type=password]:focus, input[type=search]:focus, input[type=number]:focus, input[type=tel]:focus, input[type=range]:focus, input[type=date]:focus, input[type=month]:focus, input[type=week]:focus, input[type=time]:focus, body #profile-content-settings button[type=button], body #profile-content-settings button[type=submit], body .tutor-button.tutor-success, body .tutor-button.tutor-success:hover, body .single_add_to_cart_button, body a.tutor-button, .tutor-button, body a.tutor-btn, .tutor-btn, body .tutor-progress-bar .tutor-progress-filled:after, body .learnpress-page #learn-press-profile-content .profile-recover-order .lp-button, input[type=datetime]:focus, input[type=datetime-local]:focus, input[type=color]:focus, #learn-press-course .learn-press-course-wishlist.eduvibe-button-item, textarea:focus, body .tutor-single-course-meta ul li.tutor-social-share button:hover , .eduvibe-mailchimp-subscribe-btn.eduvibe-button-item.eduvibe-button-type-fill:hover, .eduvibe-single-team-two:hover, .widget_product_search .woocommerce-product-search input[type=search]:focus, .widget_search .search-form input[type=search]:focus { border-color: {$primary_color}; }";

			$custom_css .= "body #profile-content-quizzes .lp-sub-menu li span, .eduvibe-course-ajax-search-result-area ul li a:hover { border-bottom-color: {$primary_color}; }";

			$custom_css .= ".eduvibe-post-hover-opacity-decrease .eduvibe-single-blog::before {
			    background: -o-linear-gradient(top, rgba(54, 85, 198, 0) 10%, {$primary_color} 85%);
			    background: -webkit-gradient(linear, left top, left bottom, color-stop(10%, rgba(54, 85, 198, 0)), color-stop(85%, {$primary_color}));
			    background: linear-gradient(180deg, rgba(54, 85, 198, 0) 10%, {$primary_color} 85%);
			}

			.eduvibe-blog-post-archive-style-1 .eduvibe-single-blog::before,
			.eduvibe-blog-post-archive-style-2 .eduvibe-single-blog::before,
			.eduvibe-post-hover-opacity-increase .eduvibe-single-blog::before,
			.eduvibe-post-hover-none .eduvibe-single-blog::before {
			    background: -o-linear-gradient(top, rgba(54, 85, 198, 0) 0%, {$primary_color} 150%);
			    background: -webkit-gradient(linear, left top, left bottom, from(rgba(54, 85, 198, 0)), color-stop(150%, {$primary_color}));
			    background: linear-gradient(180deg, rgba(54, 85, 198, 0) 0%, {$primary_color} 150%);
			}

			.eduvibe-blog-post-archive-style-1 .eduvibe-single-blog::after,
			.eduvibe-blog-post-archive-style-2 .eduvibe-single-blog::after,
			.eduvibe-post-slider .eduvibe-single-blog::before,
			.eduvibe-post-hover-opacity-increase .eduvibe-single-blog::after,
			.eduvibe-gallery-filter-single-item--image::after {
			    background: -o-linear-gradient(top, rgba(54, 85, 198, 0) 15%, {$primary_color} 100%);
			    background: -webkit-gradient(linear, left top, left bottom, color-stop(15%, rgba(54, 85, 198, 0)), to({$primary_color}));
			    background: linear-gradient(180deg, rgba(54, 85, 198, 0) 15%, {$primary_color} 100%);
			}

			.eduvibe-single-team::before {
			    background: -o-linear-gradient(top, rgba(54, 85, 198, 0) 15%, {$primary_color} 70%);
			    background: -webkit-gradient(linear, left top, left bottom, color-stop(15%, rgba(54, 85, 198, 0)), color-stop(70%, {$primary_color}));
			    background: linear-gradient(180deg, rgba(54, 85, 198, 0) 15%, {$primary_color} 70%);
			}

			.eduvibe-single-team-three .team-member-inner:before {
			    background: -webkit-gradient(linear, left bottom, left top, color-stop(23%, {$primary_color}), to(rgba(255, 255, 255, 0)));
			    background: -o-linear-gradient(bottom, {$primary_color} 23%, rgba(255, 255, 255, 0) 100%);
			    background: linear-gradient(to top, {$primary_color} 23%, rgba(255, 255, 255, 0) 100%);
			}


			.eduvibe-featured-event-wrapper .event-image-wrap:before {
			    background: -webkit-gradient(linear, right top, left top, from(rgba(255, 255, 255, 0)), color-stop(1%, rgba(255, 255, 255, 0.01)), to({$primary_color}));
			    background: -o-linear-gradient(right, rgba(255, 255, 255, 0) 0%, rgba(255, 255, 255, 0.01) 1%, {$primary_color} 100%);
			    background: linear-gradient(to left, rgba(255, 255, 255, 0) 0%, rgba(255, 255, 255, 0.01) 1%, {$primary_color} 100%);
			}

			.eduvibe-single-categories-three .course-category-inner:hover:before {
			    background: -webkit-gradient(linear, left bottom, left top, from({$primary_color}), color-stop(20.51%, rgba(74, 102, 204, 0.98)), to(rgba(255, 255, 255, 0)));
			    background: -o-linear-gradient(bottom, {$primary_color} 0%, rgba(74, 102, 204, 0.98) 20.51%, rgba(255, 255, 255, 0) 100%);
			    background: linear-gradient(to top, {$primary_color} 0%, rgba(74, 102, 204, 0.98) 20.51%, rgba(255, 255, 255, 0) 100%);
			}";

			$custom_css .= "button, input[type=button], input[type=reset], input[type=submit], select, textarea, input[type=text], input[type=email], input[type=url], input[type=password], input[type=search], input[type=number], input[type=tel], input[type=range], input[type=date], input[type=month], input[type=week], input[type=time], input[type=datetime], input[type=datetime-local], input[type=color], textarea, h1.entry-title a, h2.entry-title a, .eduvibe-main-content-inner .widget-area h2 a, .eduvibe-author-bio .eduvibe-author-details a, .widget ul li a, .widget a, .widget_product_search .woocommerce-product-search input::-webkit-input-placeholder, .widget_product_search .woocommerce-product-search input::placeholder, .widget.widget_search form.search-form input::-webkit-input-placeholder, .widget.widget_search form.search-form input::placeholder, .eduvibe-course-cat-widget-each-item, .widget_eduvibecore_lp_categories_widget .entry-title a:hover, .widget_eduvibecore_ld_categories_widget .entry-title a:hover, .widget_eduvibecore_recent_posts_widget .entry-title a:hover, .widget_eduvibecore_lp_courses_widget .entry-title a:hover, .widget_eduvibecore_ld_courses_widget .entry-title a:hover, .eduvibe-single-post .eduvibe-single-post-meta-info a, body .tutor-pagination-wrap span, body .tutor-pagination-wrap a, nav.eduvibe-theme-page-links ul.pager li span, nav.eduvibe-theme-page-links ul.pager li a, .eduvibe-pagination-wrapper .page-numbers .page-numbers, body .tutor-course-tags a, .eduvibe-single-event-category a, .eduvibe-woo-mini-cart-inner, .eduvibe-woo-mini-cart-icon-wrapper i, .eduvibe-mini-cart-product-name-quantity, .eduvibe-mini-cart-product-name-quantity a, a.remove_from_cart_button, .eduvibe-mini-cart-each-item .blockUI.blockOverlay::before, blockquote.wp-block-quote cite, h1, h2, h3, h4, h5, h6, body, button, input, select, optgroup, textarea, .eduvibe-single-service-two .service-title a, .eduvibe-service-4-single-item .service-btn, .eduvibe-single-course .course-content p, .eduvibe-featured-course-content p, .has-theme-tangaroa-color, .eduvibe-testimonial-slider-one .eduvibe-testimonial-author .eduvibe-testimonial-eduvibe-testimonial-author-info-wrap .eduvibe-testimonial-author-info .eduvibe-testimonial-author-social a, .eduvibe-single-testimonial-two .eduvibe-testimonial-content .eduvibe-testimonial-author-info .author-social a, .eduvibe-single-testimonial-two .eduvibe-testimonial-content .eduvibe-testimonial-author-info .author-social a:not(:last-child), .eduvibe-testimonial-three-inner .testimonial-author .author-info .author-social a, .eduvibe-single-team .team-content .name, .eduvibe-single-team .team-content .name a, .eduvibe-single-team-two .team-content .name, .eduvibe-single-team-two .team-content .name a, .eduvibe-single-team-two .team-content .team-social a, .eduvibe-single-team-three .team-member-name, .eduvibe-single-team-three .team-member-name a, .eduvibe-single-categories .cat-content .title, .eduvibe-single-categories .cat-content .title a, .eduvibe-single-categories a.eduvibe-cat-one-number, .eduvibe-single-categories-two.dark-blue-color .cate-icon, .eduvibe-single-team .team-content .contact-info span a, .eduvibe-event-two-single-item .event-location i, .eduvibe-image-icon-box-two .service-title a, .eduvibe-single-pricing .pricing-body ul li a, .eduvibe-single-pricing .pricing-footer a, .eduvibe-filter-course .filter-item:hover, .eduvibe-filter-course .filter-item.current, .eduvibe-featured-instructor-details .eduvibe-instructor-details-info .edurise-instructor-name a, .eduvibe-single-course.course-style-three .course-content .title a, .eduvibe-featured-event-wrapper .event-title a, .eduvibe-tabs-wrapper.eduvibe-tabs-style-vertical .eduvibe-tab-title-heading, .eduvibe-tabs-wrapper.eduvibe-tabs-style-vertical .eduvibe-tab-title-heading:hover, .eduvibe-instructor-ticker-social-icons a, .eduvibe-countdown-divider-enable .eduvibe-countdown-single-item:not(:last-child):after, .eduvibe-featured-course-content .label a, .eduvibe-featured-course-content .title a, .eduvibe-featured-course-content .course-meta li, .eduvibe-course-ajax-search-result-area ul li a, .eduvibe-section-subtitle-wrapper p, .eduvibe-section-title, .eduvibe-logged-in-user-logout-text a, .eduvibe-logged-out-user-wrapper a, body .ld-item-title, body .learndash-wrapper .ld-course-status.ld-course-status-not-enrolled .ld-course-status-label, body .learndash-wrapper .ld-course-status.ld-course-status-not-enrolled .ld-course-status-price, body .learndash-wrapper .ld-course-status.ld-course-status-not-enrolled .ld-course-status-action .ld-text, body .learndash-wrapper #ld-profile button.ld-icon-search.ld-icon, body .learndash-wrapper .ld-item-list .ld-item-list-item .ld-item-name, .eduvibe-course-author .content .course-instructor a, .eduvibe-single-course .course-content .course-meta ul li, .eduvibe-single-course .course-content .course-meta ul li a, .eduvibe-single-course .course-content .title a, body .learndash-wrapper .ld-tabs .ld-tabs-navigation .ld-tab, .eduvibe-single-course.course-style-two .course-content .course-meta ul li, .eduvibe-single-course.course-style-two .eduvibe-course-bottom-right, .eduvibe-event-two-single-item .title, .eduvibe-event-two-single-item .title a, body #profile-content-quizzes .lp-sub-menu li a, body #profile-content-settings .lp-tab-sections .section-tab a, body #profile-content-courses .lp-tab-sections .section-tab a, table.lp-list-table tbody tr, .eduvibe-course-author .content .course-instructor a, .eduvibe-single-course .course-content .course-meta ul li, .eduvibe-single-course .course-content .course-meta ul li a, .eduvibe-single-course .course-content .title a, .eduvibe-single-course.course-style-two .course-content .course-meta ul li, .eduvibe-single-course.course-style-three .course-content .title a, .eduvibe-course-content-left-side-wrapper ul.learn-press-nav-tabs .course-nav a:hover, .eduvibe-course-content-left-side-wrapper ul.learn-press-nav-tabs .course-nav.active a, .course-curriculum ul.curriculum-sections .section-content .course-item .item-name, .eduvibe-course-content-left-side-wrapper .course-curriculum ul.curriculum-sections .section-content .course-item .section-item-link, .eduvibe-course-content-left-side-wrapper .course-curriculum ul.curriculum-sections .section-content .course-item.course-item-lp_lesson .section-item-link, body #profile-content-courses .lp-sub-menu li, .eduvibe-course-content-left-side-wrapper .eduvibe-author-bio-name a, .tutor-dashboard-review-title a, .tutor-dashboard-permalinks a:focus, .tutor-dashboard-permalinks a:active, .tutor-dashboard-permalinks a, .eduvibe-course-author .content .course-instructor a, .tutor-course-archive-filters-wrap form.tutor-course-filter-form:after, .eduvibe-single-course .course-content .course-meta ul li, .eduvibe-single-course .course-content .course-meta ul li a, .eduvibe-single-course .course-content .title a, .eduvibe-single-course.course-style-two .course-content .course-meta ul li, .eduvibe-single-course.course-style-three .course-content .course-list-item, .eduvibe-single-course.course-style-three .course-content .title a, body h1.tutor-course-header-h1, body .tutor-segment-title, .tutor-single-course-segment .tutor-segment-title, body .tutor-full-width-course-top h4, body .tutor-full-width-course-top h5, body .tutor-full-width-course-top h6, body .tutor-review-individual-item .tutor-review-user-info a, body .tutor-wrap nav.course-enrolled-nav ul li.active a, body .tutor-course-avg-rating-total, body .tutor-single-course-rating .tutor-single-rating-count, body .tutor-wrap, body .tutor-single-course-meta ul li a, body .tutor-single-course-meta.tutor-lead-meta ul li span, body .single-instructor-wrap .instructor-name h3 a, body .tutor-single-course-meta ul li, body #profile-content-courses .lp-sub-menu li a, .eduvibe-single-product-main-content-wrapper .eduvibe-single-product-cart-wrapper input[type=number]::placeholder, .eduvibe-single-product-main-content-wrapper .entry-summary form.grouped_form.cart table .woocommerce-grouped-product-list-item__label a, .eduvibe-single-product-main-content-wrapper .eduvibe-single-product-cart-wrapper input[type=number], table.shop_table .quantity .eduvibe-single-product-cart-wrapper input[type=number], .eduvibe-single-product-main-content-wrapper .variations_form table .reset_variations, .woocommerce-tabs ul.tabs.wc-tabs li a:hover, .woocommerce-tabs ul.tabs.wc-tabs li.active a, table.shop_table>tbody>tr>td a, .woocommerce-form-login .lost_password a, .woocommerce-form-register .woocommerce-privacy-policy-link, .eduvibe-woocommerce-shop-top .eduvibe-woocommerce-shop-top-order form:after, .eduvibe-single-product-main-content-wrapper .product_meta .sku_wrapper .sku, .eduvibe-single-product-main-content-wrapper .product_meta .posted_in a, .eduvibe-single-product-main-content-wrapper .product_meta .tagged_as a, .eduvibe-event-two-single-item .event-meta i, .event-three-content h3.title a { color: {$body_color}; }";

			$custom_css .= ".eduvibe-single-categories-two.dark-blue-color .categories-action-btn a, .eduvibe-service-4-single-item.service-tang, p.woocommerce-mini-cart__buttons .button, p.eduvibe-cart-shop-page-link a { background-color: {$body_color} }";

			$custom_css .= "body #learn-press-profile-nav:before, body #learn-press-user-profile #learn-press-profile-nav .tabs > li ul, body .scrollbar-light>.scroll-element.scroll-y .scroll-bar, .eduvibe-footer-default-wrapper, .has-theme-tangaroa-background-color { background: {$body_color}; }";

			$custom_css .= ".eduvibe-image-glowing-effect-yes .elementor-image:before, .eduvibe-image-glowing-effect-yes .elementor-image:after, .eduvibe-single-pricing .pricing-footer a { border-color: {$body_color}; }";

			$custom_css .= "@media screen and (max-width: 480px) {
				body #learn-press-profile-nav:hover #profile-mobile-menu,
			    body #learn-press-profile-nav .tabs>li.active ul, 
			    body #learn-press-profile-nav .tabs>li.active a, 
			    body #learn-press-profile-nav .tabs>li:hover ul, 
			    body #learn-press-profile-nav .tabs>li:hover a,
			    body #learn-press-profile-nav .learn-press-tabs {
			        background-color: {$body_color};   
			    }

			    body #learn-press-user-profile #learn-press-profile-nav a#profile-mobile-menu,
			    body #learn-press-user-profile #learn-press-profile-nav a:hover {
			        background-color: {$body_color};
			    }
			}";
		endif;

		$custom_css = apply_filters( 'eduvibe_custom_color_style_css', $custom_css );    

	    wp_add_inline_style( 'eduvibe-main', $custom_css );

	}
endif;
add_action( 'wp_enqueue_scripts', 'eduvibe_custom_color_styles', 30 );