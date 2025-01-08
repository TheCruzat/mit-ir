<?php
/**
 * The template for displaying the footer
 * Contains the closing of the #primary div and all content after.
 *
 * @package mit-ir
 * @since 0.0.1
 */

namespace MITIR;

$ftr = array(); // Store all values in an array for this file
$ftr['classes'] = 'site-footer dark sideline'; // Declare footer classes

/*

// Footer Data from ACF
$ftr['footer'] = \get_field('footer','option'); // Footer group field
$ftr['solum'] = \get_field('solum','option'); // Solum group field

// Break up Footer Group into variables
$ftr['logoId'] = $ftr['footer']['logo'];
$ftr['info'] = $ftr['footer']['Info'];

// Break up Solum Group into variables
$ftr['copyright'] = $ftr['solum']['copyright_text'];

// Footer Menu Slugs
$footer_menu_slug = ( $ftr['footer']['footer_main_menu_select'] == 'none') ? '' : $ftr['footer']['footer_main_menu_select'];
$support_menu_slug = ( $ftr['footer']['colophon_menu_select'] == 'none') ? '' : $ftr['footer']['colophon_menu_select'];
$solum_menu_slug = ( $ftr['solum']['solum_menu_select'] == 'none') ? '' : $ftr['solum']['solum_menu_select'];

*/ // for later
?>
	</div><!-- #primary -->
	<a id="back_to_top" href="#site_logo_link" class="back-to-top btn"><svg width="24" height="24" viewBox="0 0 24 24" aria-hidden="true" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M19 12L12 5L5 12" stroke="currentColor" stroke-width="2"/><path d="M12 19L12 5" stroke="currentColor" stroke-width="2"/></svg><span class="screen-reader-text btn__text">Back to Top</span></a>
	<footer id="colophon" class="<?php echo $ftr['classes']; ?>">
		<div class="site-footer__contain">
			<div class="ftr">
				<div class="ftr__col ftr__col--info">
					<div class="ftr-logo">
						<a href="<?php echo esc_url( home_url() ); ?>" class="ftr-logo__link"><span class="screen-reader-text">MIT Office of the Provost</span><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/logos/mit-ir-logo-reverse.svg" alt="" width="286" height="44" /></a>
					</div>
					<div class="ftr-info">
						<strong>Massachusetts Institute of Technology</strong><br>
						77 Massachusetts Avenue<br>
						Room 11-268<br>
						Cambridge, MA 02139 USA

						<?php /*echo wp_kses_post($ftr['info']); */?>
					</div>
				</div>
				<div class="ftr__col ftr__col--nav">
					<?php	if ( has_nav_menu( 'primary' ) ) : ?>
					<nav class="ftr-menu" aria-label="Site Navigation">
						<?php
						wp_nav_menu(
							array(
								'theme_location' => 'secondary',
								// 'menu_id'        => 'footer-menu',
								'menu_class'     => 'menu-secondary-nav footer-menu-items wp-menu',
								'container' 		 => false,
								'depth'					 => 1
							)
						);
						?>
					</nav>
					<?php endif;
					if ( has_nav_menu( 'secondary' ) ) : ?>
					<nav class="ftr-links"><?php
						wp_nav_menu(
							array(
								'theme_location' => 'primary',
								'menu_id'        => 'footer-links-menu',
								'menu_class'     => 'footer-secondary-menu footer-links-items wp-menu',
								'container' 		 => false,
								'depth'					 => 1
							)
						);
						?></nav>
					<?php endif; ?>
				</div>
			</div>
			<div class="ftr-solum">
				<?php /* if ( has_nav_menu( $solum_menu_slug ) ) : ?>
				<nav class="solum-menu">
					<?php
						wp_nav_menu(
							array(
								'theme_location' => $solum_menu_slug,
								'menu_id'        => 'solum-menu',
								'menu_class'     => 'solum-menu-items wp-menu',
								'container' 		 => false,
								'depth'					 => 1
							)
						);
					?>
				</nav>
				<?php endif; */ ?>
				<div class="solum-copy"><a href="https://www.mit.edu/accessibility" target="_blank">Accessibility</a></div>
				<div class="solum-copy"><span class="copyright">&copy; <?php echo date("Y"); ?> <?php echo 'MIT'; //esc_html( $ftr['copyright'] ); ?></span></div>
			</div>
		</div>
	</footer><!-- #colophon -->
</div><!-- #page -->
<?php wp_footer(); ?>
</body>
</html>
