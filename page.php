<?php
/**
 * Page Template
 *
 * @package mit-ir
 * @since 0.0.1
 */

namespace MITIR;

get_header();
?>
<main id="main" class="site-main">
	<div id="content" <?php post_class('page-content page-content--full-width'); ?>>
		<?php
		while ( have_posts() ) : the_post();

			the_content();

		endwhile; // End of the loop.
		?>
		<?php // testing membership plugin
			//if ( current_user_can( 'Gated Read' ) ) { echo 'This user can do something'; } else { echo 'cannot do the thing'; }
		?>
	</div>
</main><!-- #main -->
<?php
get_footer();

