<?php
/**
 * Custom functions for our theme
 * Any and all functions for theme files, island of misfit functions
 * @package mit-ir
 * @since 0.0.1
 */

namespace MITIR;

/**
 * Echoes paginated nav links for archives, etc.
 * https://codex.wordpress.org/Function_Reference/paginate_links
 * https://allisontarr.com/2021/07/28/accessible-wordpress-pagination-with-numbers/
 *
 * @param [bool] $has_arrows, Output arrows or nay
 * @param [array] $block_data
 */
function numeric_nav( $has_arrows, $block_data ) {
	if( is_singular() && !$block_data ) {
			return;
	}

	$big = 999999999; // need an unlikely integer
	$translated = __( 'Page', 'provosto' ); // Supply translatable string
	// Default args for paginate_links, make it output a ul with numbered links
	$default_args = array(
		'type' => 'list',
		'format' => '?paged=%#%',
		'before_page_number' => '<span class="screen-reader-text">'.$translated.' </span>',
	);
	$merge_args = array();

	if( $block_data ) {
		$page_type = 'Updates';
		$max_page_num = intval( $block_data['max_pages'] );
		$current_page_num = intval( $block_data['current_page'] );

		$merge_args['base'] = get_permalink( get_page_by_path( 'updates' ) ) . '?paged=%#%#updates_archive';
		$merge_args['current'] = $current_page_num;
	} else {
		global $wp_query;

		/** Stop execution if there's only 1 page */
		if( $wp_query->max_num_pages <= 1 )
				return;

		$current_page_num = get_query_var( 'paged' ) ? absint( get_query_var( 'paged' ) ) : 1;
		$max_page_num = intval( $wp_query->max_num_pages );

		if( is_archive() ) {
			$page_type = 'Archive';
		} else {
			$page_type = 'Posts';
		}

		$merge_args['base'] = str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) );
		$merge_args['current'] = max( 1, get_query_var('paged') );
	}
	$merge_args['total'] = $max_page_num;

	if( !$has_arrows ) {
		$merge_args['prev_next'] = false;
	}

	if( $current_page_num == 1 ){
		$merge_args['end_size'] = 3;
	} else if( $current_page_num >= 2 && $max_page_num > ($current_page_num - 4)) {
		$merge_args['mid_size'] = 1;
		$merge_args['end_size'] = 3;
	} else {
		$merge_args['mid_size'] = 1;
		$merge_args['end_size'] = 2;
	}

	$args = array_merge( $default_args, $merge_args );
	$pagination = '<nav id="paginated_nav" class="page-navigation nav-paginated" role="navigation" aria-label="'.$page_type.' paginated navigation">' . paginate_links( $args ) . '</nav>';

	// Update ul with correct class
	$pagination = str_replace( '<ul class="page-numbers">', '<ul class="page-numbers nav-paginated__list">', $pagination );
	// Update li with classes for JS
	$pagination = str_replace( '<li>', '<li class="nav-paginated__item">', $pagination );
	// Update a with classes for JS
	$pagination = str_replace( '<a class="page-numbers"', '<a class="page-link nav-paginated__link"', $pagination );

	echo $pagination;
}

/**
 * Takes in the excerpt, trims it to a certain character count by the word
 * If longer than the desired length, returns as is.
 *
 * @param [string] $string, Excerpt string
 * @param [int] $desired_char_count, Length you want string to be
 * @return $new_string, New trimmed excerpt
 */
function trim_the_excerpt( $string, $desired_char_count ) {
	if ( strlen( $string ) > $desired_char_count ) {
			$new_string = wordwrap( $string, $desired_char_count );
			$new_string = substr( $new_string, 0, strpos($new_string, "\n") );
			return $new_string . '...';
	} else {
		return $string;
	}
}

/**
 * Outputs the "vanilla" search away from the filters for AJAX search
 *
 * @return [string] $search_form, to echo or store
 */
function vanilla_search() {
	$search_form = '<form role="search" class="search-form search-w has-w" method="get" action="' . esc_url( home_url( '/' ) ) . '" data-rlv="none">';
	$search_form .= '<label class="search-label">';
	if( is_search() ) {
		$search_form .= '<span class="screen-reader-text">Search again for</span>';
	} else {
		$search_form .= '<span class="screen-reader-text">Search for</span>';
	}
	$search_form .= '<input type="search" class="search-field" placeholder="What are you looking for?" value="';
	if( is_search() ) {
		$search_form .= get_search_query();
	}
	$search_form .= '" name="s"></label></form>';

	return $search_form;
}

/**
 * Outputs a ul menu for an array of links from ACF
 * @param [array] $links
 * @param [string] $location_prefix
 * @return void
 */
function acf_menuify($links, $location_prefix) {
	// Check if array empty, if so, return immediately
	if( empty($links) ) {
		return;
	}
	// Output menu
	echo '<ul class="'. esc_html( $location_prefix ) .'-menu acf-links">';
	// Run through array of links as link
	// Array should have at least 'external_link_url', 'link_text' per link
	foreach($links as $link) {

		// Check if external link is set, if so - make url
		if (array_key_exists( 'external_link_url', $link )) {
			if( $link['external_link_url'] != NULL && !empty( $link['external_link_url'] )) {
				$link['url'] = $link['external_link_url'];
			}
		}

		// Check if page link is set, if so - make url
		if(array_key_exists( 'page_link', $link )) {
			if( $link['page_link'] != NULL && !empty( $link['page_link'] )) {
				$link['url'] = $link['page_link'];
			}
		}

		// In the unlikely event url is empty, make it # for safety's sake
		if( empty($link['url']) ) {
			$link['url'] = '#';
		}

		// Echo li with link
		echo '<li class="'.esc_html( $location_prefix ).'-menu__item"><a href="'.esc_url( $link['url'] ).'" class="'.esc_html( $location_prefix ).'-menu__link">'.esc_html($link['link_text']).'</a></li>';
	}
	echo '</ul>';
}

function set_custom_block_advanced_settings($block_settings, $adv_settings) {
	if( empty( $block_settings ) || empty( $adv_settings ) ) {
		return; // Incorrect block data, no dice
	}

	/*var_dump($block_settings);
	echo '<br><br><br>';
	var_dump($adv_settings);*/

	// Check for custom ID
	if( $adv_settings['custom_id'] ) {
		$block_settings['block_id'] = esc_html( $adv_settings['custom_id'] );
	}

	// Check for custom classes
	if( $adv_settings['custom_classes'] && !empty( $adv_settings['custom_classes'] ) ) {
		$block_settings['classes'] .= ' ' . esc_html( $adv_settings['custom_classes'] );
	}

	if( array_key_exists('bottom_margin', $adv_settings ) && array_key_exists('bottom_padding', $adv_settings ) ) {
		// Set classes for custom margins / padding
		$spacing_map = array(
			'ignore' => '',
			'none' => '0',
			'sm' => 'sm',
			'md' => 'md',
			'lg' => 'lg',
			'xl' => 'xl',
			'xxl' => 'xxl',
			'huge' => 'huge',
		);

		// Margins
		if( $adv_settings['top_margin'] == 'ignore' && $adv_settings['bottom_margin'] == 'ignore' ) { // Both no class
			$spacing_map_key = $adv_settings['top_margin'];
			$block_settings['classes'] .= $spacing_map[$spacing_map_key];
		} else if( $adv_settings['top_margin'] == $adv_settings['bottom_margin'] ) { // Equal values, only need one class
			$spacing_map_key = $adv_settings['top_margin'];
			$block_settings['classes'] .= ' m-' . $spacing_map[$spacing_map_key];
		} else if( $adv_settings['top_margin'] != 'ignore' && $adv_settings['bottom_margin'] != 'ignore' ) { // Neither are no padding, need two classes
			$spacing_map_key_top = $adv_settings['top_margin'];
			$spacing_map_key_btm = $adv_settings['bottom_margin'];
			$block_settings['classes'] .= ' m-'.$spacing_map[$spacing_map_key_top].'-t m-'.$spacing_map[$spacing_map_key_btm].'-b';
		} else {
			if( $adv_settings['top_margin'] != 'ignore' ) {
				$spacing_map_key = $adv_settings['top_margin'];
				$block_settings['classes'] .= ' m-'.$spacing_map[$spacing_map_key].'-t';
			}
			if( $adv_settings['bottom_margin'] != 'ignore' ) {
				$spacing_map_key = $adv_settings['bottom_margin'];
				$block_settings['classes'] .= ' m-'.$spacing_map[$spacing_map_key].'-b';
			}
		}

		// Padding
		if( $adv_settings['top_padding'] == 'ignore' && $adv_settings['bottom_padding'] == 'ignore' ) { // Both no paddings
			$spacing_map_key = $adv_settings['top_padding'];
			$block_settings['classes'] .= $spacing_map[$spacing_map_key];
		} else if( $adv_settings['top_padding'] == $adv_settings['bottom_padding'] ) { // Equal values, only need one class
			$spacing_map_key = $adv_settings['top_padding'];
			$block_settings['classes'] .= ' p-' . $spacing_map[$spacing_map_key];
		} else if( $adv_settings['top_padding'] != 'ignore' && $adv_settings['bottom_padding'] != 'ignore' ) { // Neither are no padding, need two classes
			$spacing_map_key_top = $adv_settings['top_padding'];
			$spacing_map_key_btm = $adv_settings['bottom_padding'];
			$block_settings['classes'] .= ' p-'.$spacing_map[$spacing_map_key_top].'-t p-'.$spacing_map[$spacing_map_key_btm].'-b';
		} else {
			if( $adv_settings['top_padding'] != 'ignore' ) {
				$spacing_map_key = $adv_settings['top_padding'];
				$block_settings['classes'] .= ' p-'.$spacing_map[$spacing_map_key].'-t';
			}
			if( $adv_settings['bottom_padding'] != 'ignore' ) {
				$spacing_map_key = $adv_settings['bottom_padding'];
				$block_settings['classes'] .= ' p-'.$spacing_map[$spacing_map_key].'-b';
			}
		}
	}

	return $block_settings;
}


function output_jump_menu( $sections ) {
	$section_counter = 1;
	$output = '';

	if( !empty( $sections ) ) {
		$output .= '<span class="jump-title">Jump To</span>';
		$output .= '<ul class="jump-menu-items">';
		foreach( $sections as $section ) {
			if( $section->slug ) {
				$number_string = str_pad($section_counter, 2, '0', STR_PAD_LEFT);
				$output .= '<li data-target="'.esc_attr( $section->slug ).'" class="jump-menu-item"><a href="#'.esc_attr( $section->slug ).'" role="link" class="jump-menu-link"><span class="jump-num">'.$number_string.'. </span>'.esc_html( $section->name ).'</a></li>';
				$section_counter++;
			}
		}
		$output .= '</ul>';
	}

	return $output;
}

function get_main_category( $post_id, $post_type ) {
	$main_cat = array(); // init, gonna fill this up

	// Let's figure out the tax
	if ( 'post' == $post_type ) {
		$categories = get_the_category( $post_id );
		if ( ! empty( $categories ) ) {
			$main_cat['slug'] = $categories[0]->slug;
			$main_cat['name'] = $categories[0]->name;
			$main_cat['id']		= $categories[0]->term_id;
			$main_cat['url']  = get_category_link( $main_cat['id'] );
		}
	}

	return $main_cat;
}

// Make sure the ACF data is in the array and validish before using it
function is_data_okay( $key, $data ) {
	if ( ! isset( $data ) ) { // RUN THE GAUNTLET
		return false;
	}
	if ( ! is_array( $data ) ) {
		return false;
	}
	if ( ! array_key_exists( $key, $data ) ) {
		return false;
	}
	if ( ! $data[ $key ] ) {
		return false;
	}
	return true;
}

function debug_dump( $debug_var ) {
	echo '<pre class="debug-dump">';
	var_dump( $debug_var ); // I'm not above this ~jh
	echo '</pre>';
}

function pr($q) {
	echo '<pre>';
	print_r($q);
	echo '</pre>'; // I'm not either ~dc
}

function create_anchor( $title ) {
	$title = preg_replace( '/[^A-Za-z0-9 ]/', '', $title ); // remove non-alphanumeric
	$title = preg_replace( '!\s+!', ' ', $title );; // remove multiple spaces
	$anchor = strtolower( str_replace( ' ', '_', esc_html( $title ) ) ); // convert to anchor slug
	return $anchor;
}


// let's have that slug then Daniel
function cook_slug($str) {
  $str = strtolower(trim($str));
  $str = preg_replace('/[^a-z0-9-]/', '-', $str);
  $str = preg_replace('/-+/', "-", $str);
  rtrim($str, '-');
  return $str;
}

// strip everything out of number (for phone)
function nu($i) {
    return preg_replace("/[^0-9]/", "", $i);
}

// shorthand content filters
function cn($i) {
	return apply_filters('the_content', $i);
}
// shorthand again to include echo call
function ecn($i) { echo cn($i); }


function pid() {
	global $post;
	return $post->ID;
}

function wp_nav_menu_no_ul()
{
    $options = array(
        'echo' => false,
        'container' => false,
        'theme_location' => 'primary',
        'fallback_cb'=> 'default_page_menu'
    );

    $menu = wp_nav_menu($options);
    echo preg_replace(array(
        '#^<ul[^>]*>#',
        '#</ul>$#'
    ), '', $menu);

}

function default_page_menu() {
   wp_list_pages('title_li=');
}
