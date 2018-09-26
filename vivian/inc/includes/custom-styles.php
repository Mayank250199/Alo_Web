<?php 
function _action_vivian_custom_styles(){
	$color_main = esc_attr(fw_vivian_get_option('color_main'));
	$color_secondary = esc_attr(fw_vivian_get_option('color_secondary'));
	?>

	<?php
	$body_font = fw_vivian_get_option('body_font');
	$heading_font = fw_vivian_get_option('heading_font');
	$subheading_font = fw_vivian_get_option('subheading_font');

	ob_start();
	?>

	/* Typography */
	body {
		<?php echo fw_vivian_typography_css($body_font) ?>
	}

	h1,
	h2,
	h3,
	h4,
	h5,
	h6,
	.fw-table .heading-row,
	.fw-package .fw-heading-row,
	.font-heading {
		<?php echo fw_vivian_typography_css($heading_font) ?>;
	}

	.font-subheading {
		<?php echo fw_vivian_typography_css($subheading_font) ?>;
	}


	/* Main Color */
	a, a:focus {
		color: <?php echo $color_main ?>;
	}
	a.link-border {
		border-bottom: 2px solid <?php echo $color_main ?>; 
	}
	::-moz-selection {
		background: <?php echo $color_main ?>;
	}
	::selection {
		background: <?php echo $color_main ?>;
	}
	blockquote {
		border-color: <?php echo $color_main ?>;
	}
	blockquote .open-quote {
		color: <?php echo $color_main ?>; 
	}
	table td, table th {
		border-left: 1px solid <?php echo $color_main ?>; 
	}
	table tr {
		border: 1px solid <?php echo $color_main ?>; 
	}
	.SearchForm input:focus {
		border-bottom-color: <?php echo $color_main ?>; 
	}
	.field-text:hover label, .field-textarea:hover label {
		color: <?php echo $color_main ?>; 
	}
	.field-text input:focus, .field-text textarea:focus, .field-textarea input:focus, .field-textarea textarea:focus {
		border-bottom-color: <?php echo $color_main ?>; 
	}
	#ssd-nav-icon span {
		background-color: <?php echo $color_main ?>;
	}
	.main-navigation-menu-horizontal a:hover {
		color: <?php echo $color_main ?>; 
	}
	.main-navigation-menu-horizontal .current-menu-item > a {
		background-color: <?php echo $color_main ?>; 
	}
	.main-navigation-menu-horizontal .sub-menu .current-menu-item > a {
		background-color: <?php echo $color_main ?>; 
	}
	.main-navigation-menu-horizontal .menu-item-has-children > a > i {
		color: <?php echo $color_main ?>;
	}
	.navigation-social-wrapper a:first-child:before {
		background-color: <?php echo $color_main ?>; 
	}
	.slicknav_nav a:hover {
		background: <?php echo $color_main ?>;
	}
	@media only screen and (max-width: 1199px) {
		.NavigationSocial .navigation-social-wrapper a:last-child:before {
			background-color: <?php echo $color_main ?>; 
		} 
	}
	.SinglePostHeader .single-post-meta-categories a {
		border-bottom: 1px solid <?php echo $color_main ?>;
		color: <?php echo $color_main ?>; 
	}
	.SinglePostFooter .single-post-footer-share a {
		color: <?php echo $color_main ?>; 
	}
	.Excerpt.sticky .excerpt-content-wrapper:before {
		background-color: <?php echo $color_main ?>;
	}
	.BlogVertical .BlogLoadMore .btn-svg, .BlogGrid .BlogLoadMore .btn-svg {
		color: <?php echo $color_main ?>; 
	}
	.BlogVertical .BlogLoadMore .btn-svg rect, .BlogGrid .BlogLoadMore .btn-svg rect {
		stroke: <?php echo $color_main ?>; 
	}
	.BlogVertical .BlogLoadMore .btn-svg:hover, .BlogGrid .BlogLoadMore .btn-svg:hover {
		color: <?php echo $color_main ?>; 
	}
	.AdjacentPost .adjacent-post-meta .adjacent-post-text:after {
		background-color: <?php echo $color_main ?>; 
	}
	.comment-content .comment-header .comment-meta a:hover, .comment-content .comment-header .comment-meta a:active {
		color: <?php echo $color_main ?>; 
	}
	.CommentsArea .comment-reply-title small a {
		border-bottom: 1px solid <?php echo $color_main ?>; 
	}
	.btn:hover, .btn:active, .btn:active:focus {
		background: <?php echo $color_main ?>;
		border: 3px solid <?php echo $color_main ?>; 
	}
	.btn.btn-color, .btn.btn-color:focus, button[type='submit'], button[type='submit']:focus, input[type='submit'], input[type='submit']:focus {
		background: <?php echo $color_main ?>;
		border: 3px solid <?php echo $color_main ?>; 
	}
	.btn.btn-color:hover, .btn.btn-color:active, .btn.btn-color:active:focus, button[type='submit']:hover, button[type='submit']:active, button[type='submit']:active:focus, input[type='submit']:hover, input[type='submit']:active, input[type='submit']:active:focus {
	  	border: 3px solid <?php echo $color_main ?>;
	}
	.btn.btn-border, .btn.btn-border:focus {
		border: 3px solid<?php echo $color_main ?>;
	}

	.btn.btn-border:hover, .btn.btn-border:active, .btn.btn-border:active:focus {
		background: <?php echo $color_main ?>;
		border: 3px solid <?php echo $color_main ?>;
	}
	.btn.btn-solid:hover {
		background: <?php echo $color_main ?>;
	}
	.fw-accordion .fw-accordion-title:hover {
		border-color: <?php echo $color_main ?>; 
	}
	.fw-accordion .fw-accordion-title:before {
		color: <?php echo $color_main ?>;
		border: 4px solid <?php echo $color_main ?>;
	}
	.fw-accordion .fw-accordion-title.ui-state-active {
		border-color: <?php echo $color_main ?>; 
	}
	.fw-tabs-container .fw-tabs ul li .tabs-icon-selected {
		color: <?php echo $color_main ?>;
	}
	.fw-tabs-container .fw-tabs ul li.ui-state-active a:after {
		background-color: <?php echo $color_main ?>; 
	}
	.special-subtitle-center:before {
		background-color: <?php echo $color_main ?>; 
	}
	.special-subtitle-left:after {
		background-color: <?php echo $color_main ?>; 
	}
	.special-subtitle-right:after {
		background-color: <?php echo $color_main ?>; 
	}
	.highlight {
		background-color: <?php echo $color_main ?>;
	}
	.heading-big:first-letter, .heading-big .block-revealer__content:first-letter {
		color: <?php echo $color_main ?>;
		border: 1px solid <?php echo $color_main ?>; 
	}
	.overlay-color {
		background-color: <?php echo $color_main ?>; 
	}
	.is-block-hover {
		color: <?php echo $color_main ?>;
	}
	.is-block-hover:hover {
		color: <?php echo $color_main ?>; 
	}
	.is-block-hover::after {
		background: <?php echo $color_main ?>;
	}
	.swiper-pagination.swiper-pagination-fraction .swiper-pagination-current {
		color: <?php echo $color_main ?>; 
	}
	.swiper-pagination-progress .swiper-pagination-progressbar {
		background: <?php echo $color_main ?>; 
	}
	.FullscreenSlider .fullscreen-slider-image-info-wrapper .image-info h5:after {
		background-color: <?php echo $color_main ?>; 
	}
	.FullscreenSlider.swiper-container-vertical .swiper-slide:not(.swiper-slide-gallery):before {
		border-left: 2px dashed <?php echo $color_main ?>;
	}
	.FullscreenSlider.swiper-container-vertical .content-left .special-title:after, .FullscreenSlider.swiper-container-vertical .content-right .special-title:after {
		background-color: <?php echo $color_main ?>;
	}
	.SlidingContent .is-swiper-sliding-content-text .swiper-slide {
		box-shadow: inset 0 0 0 30px <?php echo $color_main ?>; 
	}
	.sliding-content-mobile-image-title {
		background-color: <?php echo $color_main ?>;
	}
	.vertical-shift-mobile-section-image .vertical-shift-mobile-section-text h5 {
		border-bottom: 2px solid <?php echo $color_main ?>; 
	}
	.vertical-shift-gallery-image-text h5:before {
		background-color: <?php echo $color_main ?>; 
	}
	.IconText i {
		color: <?php echo $color_main ?>;
	}
	.widget > ul li a:before {
		color: <?php echo $color_main ?>;
	}
	.widget .widget-title {
		border-bottom: 4px solid <?php echo $color_main ?>;
	}
	#wp-calendar #today {
		color: <?php echo $color_main ?>; 
	}
	.widget_tag_cloud .tagcloud a:hover {
		background-color: <?php echo $color_main ?>;
	}
	.about-me-widget-footer a:after {
		background-color: <?php echo $color_main ?>;
	}
	.about-me-widget-footer a:hover {
		color: <?php echo $color_main ?>; 
	}
	.widget_popular_posts .popular-posts-meta-extra {
		color: <?php echo $color_main ?>; 
	}


	/* Secondary Color */
	a:hover, a:active {
		color: <?php echo $color_secondary ?>;
	}
	hr {
		border-color: <?php echo $color_secondary ?>; 
	}
	.is-nav-overlay .menu-item-has-children > a > i {
		color: <?php echo $color_secondary ?>; 
	}
	.fw-accordion .fw-accordion-title {
		border-bottom: 1px solid <?php echo $color_secondary ?>; 
	}
	.overlay-color-2 {
		background-color: <?php echo $color_secondary ?>; 
	}
	.widget > ul li a:hover:before {
		color: <?php echo $color_secondary ?>; 
	}
	.tweet-time {
		color: <?php echo $color_secondary ?>; 
	}


	/* Custom CSS */

	<?php echo esc_attr(fw_vivian_get_option('custom_css'));

	$output_css = ob_get_clean();

	wp_add_inline_style( 'vivian_custom-css', $output_css );

}

add_action( 'wp_enqueue_scripts', '_action_vivian_custom_styles', 100 );
?>
