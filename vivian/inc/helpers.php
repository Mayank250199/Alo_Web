<?php if ( ! defined( 'ABSPATH' ) ) { die(); }
/**
 * Helper functions and classes with static methods for usage in theme
 */

/**
* ----------------------------------------------------------------------------------------
*    ACF
* ----------------------------------------------------------------------------------------
*/

/**
 * Return a custom field stored by the Advanced Custom Fields plugin 
 */

if ( !function_exists( 'fw_vivian_get_field' ) ) {
	function fw_vivian_get_field( $key, $id=false, $default='' ) {
		global $post;
		$key = trim( filter_var( $key, FILTER_SANITIZE_STRING ) );
		$result = '';

		if ( function_exists( 'get_field' ) ) {

			if ( isset( $post->ID ) && !$id )
				$field_object = get_field_object($key) ;
			else
				$field_object = get_field_object($key, $id );

			if ( isset( $post->ID ) && !$id )
				$result = get_field( $key );
			else
				$result = get_field( $key, $id );

			if ( $result == '' ) // If ACF enabled but key is undefined, return default
				$result = $default;

		} else {
			$result = $default;
		}
		return $result;
	}
}

if ( !function_exists( 'fw_vivian_the_field' ) ) {
	function fw_vivian_the_field( $key, $id=false, $default='' ) {

		$value = fw_vivian_get_field($key, $id, $default);

		if( is_array($value) ) {

			$value = @implode( ', ', $value );

		}

		echo $value;
	}
}

if ( !function_exists( 'fw_vivian_get_sub_field' ) ) {
	function fw_vivian_get_sub_field( $key, $default='' ) {
		if ( function_exists( 'get_sub_field' ) &&  get_sub_field( $key ) )  
			return get_sub_field( $key );
		else 
			return $default;
	}
}

if ( !function_exists( 'fw_vivian_the_sub_field' ) ) {
	function fw_vivian_the_sub_field( $key, $default='' ) {
		$value = fw_vivian_get_sub_field( $key, $default );
		echo $value;
	}
}

if ( !function_exists( 'fw_vivian_has_sub_field' ) ) {
	function fw_vivian_has_sub_field( $key, $id=false ) {
		if ( function_exists('has_sub_field') )
			return has_sub_field( $key, $id );
		else
			return false;
	}
}

if ( !function_exists( 'fw_vivian_have_rows' ) ) {
	function fw_vivian_have_rows( $key, $id=false ) {
		if ( function_exists('have_rows') )
			return have_rows( $key, $id );
		else
			return false;
	}
}

/**
* ----------------------------------------------------------------------------------------
*    Unyson
* ----------------------------------------------------------------------------------------
*/

/**
 *  Get Unyson option
 */

if ( !function_exists( 'fw_vivian_get_option' ) ) {
	function fw_vivian_get_option($option_id, $default_value = false) {
		if ( function_exists( 'fw_get_db_settings_option' ) ) {
			return fw_get_db_settings_option($option_id, $default_value);
		}

		return $default_value;
	}
}

/**
 *  Print typography CSS
 */

if ( !function_exists( 'fw_vivian_typography_css' ) ) {
	function fw_vivian_typography_css($field) {

		$output = '';
		$pattern = '/(\d+)|(regular|italic)/i';


		if ( isset($field['family']) ) {
			$output .= 'font-family: ' . $field['family'] . ';';
			$output .= "\r\n";
		}

		if ( isset($field['google_font']) ) {
			preg_match_all($pattern, $field['variation'], $matches);
		} else {
			preg_match_all($pattern, $field['style'], $matches);
		}

		if ( $matches[0] ) {
			foreach ($matches[0] as $value) {
				if ( $value == 'italic' ) {
					$output .= 'font-style: ' . $value . ';';
					$output .= "\r\n";
				} else if ( $value == 'regular' ) {
					$output .= 'font-style: normal;';
					$output .= "\r\n";
				} else {
					$output .= 'font-weight: ' . $value . ';';
					$output .= "\r\n";
				}
			}
		}

		return $output;

	}
}

/**
*  Get remote Google Fonts
*/

if (!function_exists('fw_vivian_get_remote_fonts')) :
	function fw_vivian_get_remote_fonts($include_from_google) {
		/**
		 * Get remote fonts
		 * @param array $include_from_google
		 */
		if ( ! sizeof( $include_from_google ) ) {
			return '';
		}

		$html = "<link href='//fonts.googleapis.com/css?family=";

		foreach ( $include_from_google as $font => $styles ) {
			$html .= str_replace( ' ', '+', $font ) . ':' . implode( ',', $styles['variants'] );

			$last_name = end($include_from_google);
			if($last_name !== $styles){
			   $html .= '%7C'; // not the last element
			}
		}

		$html .= "' rel='stylesheet' type='text/css'>";

		return $html;
	}
    endif;


/**
 *  Populate an array with social icons and titles
 */

if ( !function_exists( 'fw_vivian_get_social_medias' ) ) {
	function fw_vivian_get_social_medias() {
		$social_titles = array(
			'facebook'    => esc_html__( 'Facebook URL:', 'vivian' ),
			'twitter'    => esc_html__( 'Twitter URL:', 'vivian' ),
			'behance'    => esc_html__( 'Behance URL:', 'vivian' ),
			'dribbble'    => esc_html__( 'Dribbble URL:', 'vivian' ),
			'pinterest'    => esc_html__( 'Pinterest URL:', 'vivian' ),
			'instagram'    => esc_html__( 'Instagram URL:', 'vivian' ),
			'500px px500'    => esc_html__( '500px URL:', 'vivian' ),
			'google-plus'    => esc_html__( 'Google+ URL:', 'vivian' ),
			'linkedin'    => esc_html__( 'LinkedIn URL:', 'vivian' ),
			'flickr'    => esc_html__( 'Flickr URL:', 'vivian' ),
			'youtube'    => esc_html__( 'Youtube URL:', 'vivian' ),
			'vimeo-square'    => esc_html__( 'Vimeo URL:', 'vivian' ),
			'tumblr'    => esc_html__( 'Tumblr URL:', 'vivian' ),
			'medium'    => esc_html__( 'Medium URL:', 'vivian' )
			);

		return $social_titles;
	}
}

/**
 *  Generate Unyson option fields
 */

if ( !function_exists( 'fw_vivian_get_social_option' ) ) {
	function fw_vivian_get_social_option() {

		$social_titles = fw_vivian_get_social_medias();

		foreach ($social_titles as $key => $value) {

			$social_options[$key] = array(
				'label' => $value,
				'type'  => 'text',
				'value' => ''
				);
		}

		return $social_options;
	}
}

/**
* ----------------------------------------------------------------------------------------
*    Theme
* ----------------------------------------------------------------------------------------
*/

/**
*  Generating Isotope Category Names
*/

if ( !function_exists( 'fw_vivian_isotope_categories' ) ) {
	function fw_vivian_isotope_categories($value){
		return 'isotope-category-' . $value;
	}
}


/**
*  Prev / Next Pagination
*/

if ( ! function_exists( 'fw_vivian_paging_nav' ) ) : 
	/**
	 * Display navigation to next/previous set of posts when applicable.
	 */ 
{
	function fw_vivian_paging_nav( $wp_query = null ) {

		if ( ! $wp_query ) {
			$wp_query = $GLOBALS['wp_query'];
		}

		// Don't print empty markup if there's only one page.
		if ( $wp_query->max_num_pages < 2 ) {
			return;
		}

		$paged        = get_query_var( 'paged' ) ? intval( get_query_var( 'paged' ) ) : 1;

		$pagenum_link = html_entity_decode( get_pagenum_link() );
		$query_args   = array();
		$url_parts    = explode( '?', $pagenum_link );

		if ( isset( $url_parts[1] ) ) {
			wp_parse_str( $url_parts[1], $query_args );
		}

		$pagenum_link = remove_query_arg( array_keys( $query_args ), $pagenum_link );
		$pagenum_link = trailingslashit( $pagenum_link ) . '%_%';

		$format = $GLOBALS['wp_rewrite']->using_index_permalinks() && ! strpos( $pagenum_link,
			'index.php' ) ? 'index.php/' : '';
		$format .= $GLOBALS['wp_rewrite']->using_permalinks() ? user_trailingslashit( 'page/%#%',
			'paged' ) : '?paged=%#%';

		// Set up paginated links.
		$links = paginate_links( array(
			'base'      => $pagenum_link,
			'format'    => $format,
			'total'     => $wp_query->max_num_pages,
			'current'   => $paged,
			'mid_size'  => 1,
			'add_args'  => array_map( 'urlencode', $query_args ),
			'prev_text' => esc_html__( '&larr; Previous', 'vivian' ),
			'next_text' => esc_html__( 'Next &rarr;', 'vivian' ),
			) );

		if ( $links ) :

			?>
		<nav class="navigation paging-navigation" role="navigation">
			<div class="posts-pagination loop-pagination">
				<?php echo esc_html($links); ?>
			</div>
			<!-- .pagination -->
		</nav><!-- .navigation -->
		<?php
		endif;
	}
}
endif;

/**
*  Comments
*/

if ( !function_exists( 'fw_vivian_comments' ) ) {
	function fw_vivian_comments($comment, $args, $depth) {

		$GLOBALS['comment'] = $comment; ?>

		<li <?php comment_class(); ?> id="comment-<?php comment_ID() ?>">
			<article class="comment-content">
				<div class="media">
					<div class="media-left">
						<figure class="comment-avatar">
							<?php
							$avatar_size = 50;
							echo get_avatar($comment, $avatar_size); ?>
						</figure>

					</div><!-- end media-left -->
					<div class="media-body comment-body">
						<header class="comment-header">

							<h5 class="comment-author"><?php comment_author_link(); ?></h5>
							<span class="comment-meta"><a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>"><?php comment_date(); ?> - <?php comment_time(); ?></a><?php edit_comment_link(esc_html__('[Edit]', 'vivian'),'  ','') ?> &middot; <?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?></span>
						</header>
						<div class="comment-main-content">
							<?php if ( $comment->comment_approved == 0 ) : ?>

								<p class="awaiting-moderation alert"><?php esc_html_e('Your comment is awaiting moderation', 'vivian'); ?></p>

							<?php endif; ?>

							<?php comment_text(); ?>
						</div>

					</div><!-- end media-body -->
				</div><!-- end media -->
				
			</article>

		<?php

	}
}

/**
*  Get Parent Portfolio
*/

if( !function_exists( 'fw_vivian_parent_portfolio_id' ) ) {
	function fw_vivian_parent_portfolio_id() {
		global $post;
		$single_project_id = get_the_ID();

		$args = array(
			'post_type' => 'page',
			'posts_per_page' => -1,
			'meta_key'   => '_wp_page_template',
			'meta_query' => array(
				'relation' => 'OR',
				array(
					'key'     => '_wp_page_template',
					'value'   => 'template-portfolio.php',
				),
				array(
					'key'     => '_wp_page_template',
					'value'   => 'template-vertical-shift.php',
				),
				array(
					'key'     => '_wp_page_template',
					'value'   => 'template-fullscreen-slider.php',
				)
			),
		);


		$portfolios_query = new WP_Query($args);

		$found = false;

		if ( !$found && $portfolios_query->have_posts()) : while ($portfolios_query->have_posts()) : $portfolios_query->the_post();
			$temp_post = $post;
			$portfolio_id = get_the_ID();


			if ( get_page_template_slug() == 'template-portfolio.php' ) {
				/* Hidden Portfolio Categories */
				$hidden_cats = fw_vivian_get_field('hide_categories');

				if( !empty($hidden_cats[0]['category']) ) {
					$hidden_cats_ids = array();
					foreach( $hidden_cats as $cat) {
						array_push($hidden_cats_ids, $cat['category']->term_id);
					}
				}

				$args = array(
					'post_type' => 'portfolio',
					'posts_per_page' => -1
					);

				if( !empty($hidden_cats[0]['category']) ) {
					$args['tax_query'] = array(array(
						'taxonomy' => 'portfolio_category',
						'field' => 'term_id',
						'terms' => $hidden_cats_ids,
						'operator' => 'NOT IN'
					));
				}

				$portfolio_query = new WP_Query($args);

				if ($portfolio_query->have_posts()) : while  ($portfolio_query->have_posts()) : $portfolio_query->the_post();

					if ( get_the_ID() == $single_project_id ){
							$found = true;
							$found_portfolio_id = $portfolio_id;
						}

				endwhile;
				endif;
				// returns to previous query - wp_reset_postdata() returns to MAIN query
				$post = $temp_post;

			}

			

			if ( !$found && get_page_template_slug() != 'template-portfolio.php' && fw_vivian_get_field('selected_projects') ) {
				$portfolio_objects = fw_vivian_get_field('selected_projects');
				if( $portfolio_objects ) {
					foreach( $portfolio_objects as $project) {
						if ( $project->ID == $single_project_id ){
							$found = true;
							$found_portfolio_id = $portfolio_id;
						}
					}
				}
			}

		
		endwhile; endif;

		wp_reset_postdata();

		if ( isset($found_portfolio_id) ) {
			return $found_portfolio_id;
		} else {
			return false;
		}

		
	}
}



/**
*  Single Portfolio Navigation
*/

if( !function_exists( 'fw_vivian_single_portfolio_nav' ) ) {

	function fw_vivian_single_portfolio_nav($parent_portfolio_id){
	
		if ( get_field('hide_categories', $parent_portfolio_id) ) {

			$exclude_cats = get_field('hide_categories', $parent_portfolio_id);

			$args = array(
				'post_type' => 'portfolio',
				'posts_per_page' => -1
			);

			if( !empty($exclude_cats[0]['category']) ) {
				$exclude_cats_ids = array();
				foreach( $exclude_cats as $cat) {
					array_push($exclude_cats_ids, $cat['category']->term_id);
				}


				$args['tax_query'] = array(array(
					'taxonomy' => 'portfolio_category',
					'field' => 'term_id',
					'terms' => $exclude_cats_ids,
					'operator' => 'NOT IN'
				));
			}

		} elseif ( get_field('selected_projects', $parent_portfolio_id) ) {
			$portfolio_objects = get_field('selected_projects', $parent_portfolio_id);

			$portfolio_ids = array();
			foreach( $portfolio_objects as $project) {
				array_push($portfolio_ids, $project->ID);
			}

			$args = array(
				'post_type' => 'portfolio',
				'post__in' => $portfolio_ids,
				'posts_per_page' => -1
			);
		}

			$projects_query = new WP_Query($args);

			$projects_ids = array();

			if ($projects_query->have_posts()) : while ($projects_query->have_posts()) : $projects_query->the_post();
			
				array_push($projects_ids, get_the_ID());
				
			endwhile; endif;
			wp_reset_postdata();
			

			$key = array_search( get_the_ID(), $projects_ids); //gets the position of the current project from all the projects in the portfolio page
			?>
			<div class="single-portfolio-nav">
			<?php
			if ( $key == 0 && array_key_exists( $key+1, $projects_ids) ) { ?>
				<a href="<?php echo get_permalink( $projects_ids[$key+1] ); ?>" class="arrow-left"></a>
				<?php if ( $parent_portfolio_id ) : ?>
				<a href="<?php echo get_permalink($parent_portfolio_id) ;?>" class="back-to-portfolio"><i class="fa fa-th-large"></i></a>
				<?php endif; ?>
				<div class="spn-offset"></div>
			<?php 
			} elseif ( array_key_exists( $key+1, $projects_ids) && array_key_exists( $key-1, $projects_ids) ) { ?>
				<a href="<?php echo get_permalink( $projects_ids[$key+1] ); ?>" class="arrow-left"></a>
				<?php if ( $parent_portfolio_id ) : ?>
				<a href="<?php echo get_permalink($parent_portfolio_id) ;?>" class="back-to-portfolio"><i class="fa fa-th-large"></i></a>
				<?php endif; ?>
				<a href="<?php echo get_permalink( $projects_ids[$key-1] ); ?>" class="arrow-right"></a>
			<?php
			} elseif ( array_key_exists( $key-1, $projects_ids) ) { ?>
				<div class="spn-offset"></div>
				<?php if ( $parent_portfolio_id ) : ?>
				<a href="<?php echo get_permalink($parent_portfolio_id) ;?>" class="back-to-portfolio"><i class="fa fa-th-large"></i></a>
				<?php endif; ?>
				<a href="<?php echo get_permalink( $projects_ids[$key-1] ); ?>" class="arrow-right"></a>
			<?php
			} elseif ( $parent_portfolio_id ) { ?>
				<div class="spn-offset"></div>
				<a href="<?php echo get_permalink($parent_portfolio_id) ;?>" class="back-to-portfolio"><i class="fa fa-th-large"></i></a>
				<div class="spn-offset"></div>
			<?php
			}
			?>
			</div>
			<?php


	}
}

/**
*  Popular Blog Posts
*/

if ( !function_exists( 'fw_vivian_count_post_views' ) ) {
	function fw_vivian_count_post_views($postID) {
		$count_key = 'fw_vivian_post_views_count';
		$count = get_post_meta($postID, $count_key, true);
		if ( $count=='' ) {
			$count = 0;
			delete_post_meta($postID, $count_key);
			add_post_meta($postID, $count_key, '0');
		} else {
			$count++;
			update_post_meta($postID, $count_key, $count);
		}
	}
}


/**
*  Callbacks
*/

if ( !function_exists( 'fw_vivian_list_pings' ) ) {
	function fw_vivian_list_pings($comment, $args, $depth) {

		$GLOBALS['comment'] = $comment; ?>

		<li <?php comment_class('pingback'); ?> id="comment-<?php comment_ID() ?>">
			<article class="comment-content">
				<header class="ping-header">
					<h5 class="comment-author"><?php _e('Pingback:', 'vivian'); ?></h5>
					<span class="comment-meta"><?php edit_comment_link(__('[Edit]', 'vivian'),'  ','') ?></span>
				</header>
				<?php comment_author_link(); ?>
			</article>
		</li>
		<?php
	}
}