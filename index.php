<?php

// error_reporting(E_ALL);

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

get_header();
?>

	<main id="primary" class="site-main">
		<div id="content" <?php post_class('page-content page-content--full-width'); ?>>

				<?php
		while ( have_posts() ) : the_post();

			the_content();

		endwhile; // End of the loop.
		?>

	</div>
	</main>

<?php
get_footer();
