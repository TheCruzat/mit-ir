<?php

/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package mit-ir
 */

namespace MITIR;

// we'll need this
use WP_Query;

// get the current full url
$search_url = $_SERVER['REQUEST_URI'];

// site top
get_header();
?>

	<?php

	// process search_url to get the goodies in a workable array
	$search_url = urldecode($search_url);
	$search_bits = array();
	foreach (explode('&', $search_url) as $part) {
	    list($key, $value) = explode('=', $part, 2);
	    if (array_key_exists($key, $search_bits)) {
	        $search_bits[$key] = $search_bits[$key].','.$value;
	    } else {
	        $search_bits[$key] = $value;
	    }
	}

	// if there are terms, put them in an array
	if(substr_count($search_url, 'term') > 0) {
		$terms = explode(',',$search_bits['term']);
	}

	// scrub orderby stuff from url -- hacky
	function cleanSearch($search_url) {
		return str_replace(['&orderby=post_date', '&orderby=title', '&order=asc', '&order=desc'], '', $search_url);
	}

	// generate the string for terms to use in results
	function cookTerms($terms) {
		$tstring = '';
		$tcount = count($terms);
		foreach($terms as $coun => $t) {
			if($coun == ($tcount - 1) && $coun != 0) {
				$tstring .= ' and ';
			}
			$tstring .= '<strong>'.get_term_by('slug', $t, 'project-population')->name.'</strong>';
			if($tcount > 2 && $coun < ($tcount - 2)) {
				$tstring .= ', ';
			}
		}
		return $tstring;
	}

	// dev clutter
	// $search_url = str_replace(['&orderby=post_date', '&order=asc', '&orderby=post_date', '&order=desc'], '', $search_url);
	// pr($search_bits);
	// pr($search_url);
	// pr(is_array($search_bits['taxonomy']));
  // echo is_array($search_bits['orderby']); ?>

	<main id="primary" class="site-main">

		<section class="search-and-filter sideline">
			<?php include 'templates/search-and-filter.php'; ?>
		</section>

		<div class="listing sideline">

			<?php // create the string to show in search results

			if(!have_posts() && $search_bits['/?s'] != null) {
				// if(!have_posts()) {
				// 	$term_string = '';
				if(!have_posts() && substr_count($search_url, 'term') > 0) {
					$term_string = ' tagged with '.cookTerms($terms);
				// } else {
				// 	$term_string = '';
				} else {
					$term_string = '';
				}
				$head_string = 'No results found for <strong class="keyword">'.get_search_query().'</strong>'.$term_string;
			} else if(substr_count($search_url, 'term') > 0 && $search_bits['/?s'] == null) {
				$tstring = cookTerms($terms);
				$head_string = 'All results tagged with '.$tstring;
			} else if($search_bits['/?s'] == null) {
				$head_string = 'All available projects';
			} else {
				if(substr_count($search_url, 'term') > 0) {
					$tstring = ' tagged with '.cookTerms($terms);
				} else {
					$tstring = '';
				}
				$head_string = 'Results for <strong class="keyword">'.get_search_query().'</strong>'.$tstring;
			} ?>

			<div class="listing-header">
				<div class="listing-header--message"><?= $head_string ?></div>
				<?php if(have_posts() || (substr_count($search_url, 'term') > 0 && $search_bits['/?s'] == null)) { // echo $search_url; ?>
				<div class="dropdown sorter">
					<span class="dropdown--label">Sort projects</span>
					<div class="dropdown-arrow">
						<svg width="14" height="8" viewBox="0 0 14 8" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path fill-rule="evenodd" clip-rule="evenodd" d="M13.4714 1.4714L7 7.94281L0.528595 1.4714L1.4714 0.528595L7 6.05719L12.5286 0.528596L13.4714 1.4714Z" fill="#0D0009"></path>
						</svg>
					</div>
					<div class="dropdown-panel">
						<div class="dropdown-panel--wrap">
							<?php
								$link_vars = [
									['Most Relevant', ''],
									['Title, A-Z', '&orderby=title&order=asc'],
									['Title, Z-A', '&orderby=title&order=desc'],
									['Newest to Oldest', '&orderby=post_date&order=asc'],
									['Oldest to Newest', '&orderby=post_date&order=desc']
								]; $linkstr = '';
								foreach($link_vars as $link) {
									$linkstr .= '<div class="dropdown-panel--input"><a href="'.get_site_url().cleanSearch($search_url).$link[1].'">'.$link[0].'</a></div>';
								}
								echo $linkstr;

							?>
						</div>
					</div>
				</div>
				<?php } ?>
			</div>

			<?php
			function drawItem($post) {

					$i = $post->ID;
					$data = get_fields($i);

					//pr($data);

					$pm_meta = \get_field('pm_name_in_group', $i);
					if(!$pm_meta) {
						$pm_meta = date('Y', strtotime($post->post_date));
					}

					echo '<div class="listing-item">';
					echo 	'<a href="'.get_permalink($i).'">';
					echo 		'<div class="listing-item--icon"><img src="'.get_stylesheet_directory_uri().'/assets/icons/types/'.$data['type_icon'].'.svg" alt="" /></div>';
					echo  	'<div class="listing-item--content">';
					echo 			'<h3 class="header">' . get_the_title() . '</h3>';
						the_excerpt();
					echo 		'</div>';
					echo 		'<div class="listing-item--meta">';
					echo 		$pm_meta;
					echo 		'</div>';
					echo 	'</a>';
					// pr();
					echo '</div>';
			}

			if(substr_count($search_url, 'term') > 0 && $search_bits['/?s'] == null) {

				$args = array(
					'post_type' => $search_bits['post_type'],
					'tax_query' => array(
						'relation' => 'OR'
					),
					'posts_per_page' => -1
				);


				if( array_key_exists( 'term', $search_bits ) ) {
					foreach(explode(',',$search_bits['term']) as $coun => $tag) {
						// pr($tag);
						$add = array(
							'taxonomy' => 'project-population',
							'field' => 'slug',
							'terms' => array($tag)
						);
						array_push($args['tax_query'], $add);
					}
				}

				// if( array_key_exists('orderby',$search_bits) && array_key_exists('order',$search_bits) ) {
				if( array_key_exists( 'orderby', $search_bits ) && array_key_exists( 'order', $search_bits ) ) {
					$args['order'] = $search_bits['order'];
					$args['orderby'] = $search_bits['orderby'];
				}

				// pr($args);

				$combo_query = new WP_Query($args);
				while ( $combo_query->have_posts() ) :
				    $combo_query->the_post();
				    drawItem($post);
				endwhile;

				wp_reset_postdata();

			} else {
				if(have_posts()) :
					while ( have_posts() ) : the_post();
						drawItem($post);
					endwhile; // End of the loop.
					// the_posts_pagination();
				endif;
			}
		//
		?>



		</div>

		<section class="featured-projects sideline">
			<div class="header">Featured Projects</div>
			<div class="cards">
			<?php
				// pr(get_field('featured_projects', 'Options')['featured_projects']);

				$feat_proj = get_field('featured_projects', 'Options');
				// pr($feat_proj['featured_projects']);

				foreach($feat_proj['featured_projects'] as $project) :

				// pr($project[0]);

				$icon = \get_field('type_icon', $project->ID);

				$str = '<a href="'.get_the_permalink($project->ID).'"><div class="backslide pink">';

				$str .= '<div class="topper">';

				if(isset($icon) && $icon !== 'null') :
				$str .= '<img src="'.get_stylesheet_directory_uri().'/assets/icons/types/'.$icon.'.svg" alt="" />';
				endif;

				$str .= '</div><div class="card-body">';

				// pr($icon);
				$str .= '<div class="header">'.$project->post_title.'</div>';
				$str .= '<img class="cta-arrow" src="'.get_stylesheet_directory_uri().'/assets/icons/icon-arrow-upper-right.svg" alt="" />';
				$str .= '</div></div></a>';

				echo $str;/**/

			endforeach; ?>
			</div>
		</section>

	</main>

<?php
get_footer();
