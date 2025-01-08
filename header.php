<?php
/**
 * The header for our theme, covering everything from the doctype to the header
 * Keep all site content in individual pages - this is only for the header
 *
 * This is the template that displays all of the <head> section, along with the site logo and nav
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package mit-ir
 * @since 0.0.1
 */

namespace MITIR;

global $post;
?>
<!doctype html>
<html <?php language_attributes(); ?>>

<head>
  <meta charset="<?php bloginfo( 'charset' ); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="profile" href="http://gmpg.org/xfn/11">

<?php  // favicon goodies for later ?>

<?php $favi = get_field('favicon', 'option'); if($favi !== null) : ?>
<?php if($favi['favicon_apple']) : ?>
	<link rel="apple-touch-icon" sizes="180x180" href="<?php echo esc_url ( $favi['favicon_apple'] ); ?>">
<?php endif; ?>
<?php if($favi['favicon_512']) : ?>
	<link rel="icon" type="image/png" sizes="512x512" href="<?php echo esc_url ( $favi['favicon_512'] ); ?>">
<?php endif; ?>
<?php if($favi['favicon_192']) : ?>
	<link rel="icon" type="image/png" sizes="192x192" href="<?php echo esc_url ( $favi['favicon_192'] ); ?>">
<?php endif; ?>
<?php if($favi['favicon_32']) : ?>
	<link rel="icon" type="image/png" sizes="32x32" href="<?php echo esc_url ( $favi['favicon_32'] ); ?>">
<?php endif; ?>
<?php if($favi['favicon_16']) : ?>
	<link rel="icon" type="image/png" sizes="16x16" href="<?php echo esc_url ( $favi['favicon_16'] ); ?>">
<?php endif; ?>
	<link rel="manifest" href="<?php echo esc_url ( get_site_url() ); ?>/site.webmanifest">
	<link rel="mask-icon" href="<?php echo esc_url ( get_site_url() ); ?>/safari-pinned-tab.svg" color="#ed009b">
<?php if($favi['favicon_ico']) : ?>
	<link rel="shortcut icon" href="<?php echo esc_url ( $favi['favicon_ico'] ); ?>">
<?php endif; ?>
<?php if($favi['favicon_svg']) : ?>
	<link rel="shortcut icon" href="<?php echo esc_url ( $favi['favicon_svg'] ); ?>">
<?php endif; ?>
<?php endif; ?>



	<meta name="msapplication-TileColor" content="#ed009b">
	<meta name="msapplication-config" content="<?php echo esc_url ( get_site_url() ); ?>/browserconfig.xml">
	<meta name="theme-color" content="#dddddd">

  <?php wp_head();
				$search_name_check = get_queried_object_id(); ?>
</head>


<body <?php body_class( 'no-js' ); ?>>

<a class="skip-link screen-reader-text js-trigger" href="#content"><?php echo esc_html( 'Skip to Content &#9207;' ); ?></a>

<div id="page" class="site">
<header id="masthead" class="site-header">
	<div class="site-header__contain">
		<div class="site-branding">
			<a href="/" class="site-logo" title="MIT Office of the Provost: Institutional Research" rel="home">
				<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/logos/mit-ir-logo.svg" alt="MIT Office of the Provost: Institutional Research" width="178" height="26.75" />
			</a>
		</div>

		<div class="navigation-frame sideline">

			<div></div>

			<div class="secondary-navigation">
				<?php // if(!is_front_page()) : ?>
				<nav class="site-navigation" aria-label="<?php esc_attr_e('Site Navigation', 'mit-ir'); ?>">


					<ul id="menu-secondary-nav" class="footer-menu-items wp-menu">
					<?php

						$menu_name = 'secondary';
						$locations = get_nav_menu_locations();
						$menu = wp_get_nav_menu_object( $locations[ $menu_name ] );
						$menuitems = wp_get_nav_menu_items( $menu->term_id, array( 'order' => 'DESC' ) );

						if(get_post_type() == 'projects' && $post && !is_search() && !is_archive() && $parent = \get_field('parent_page', $post->ID)) {
							$parent_page = $parent[0];
						} else {
							$parent_page = null;
						}
						// pr($parent_page);
						foreach($menuitems as $item) {
							$icon = get_field('section_icon', $item);
							$title = $item->title;
							$url = $item->url;
							if($post && get_post_type() == 'projects' && $parent_page == $item->object_id) {
								$classy = ' class="project-parent"';
							} elseif($post && $post->ID == $item->object_id) {
								$classy = ' class="current_page_item"';
							} else {
								$classy = '';
							}
							echo '<li'.$classy.'><a href="'.$url.'">
								<img src="'.get_stylesheet_directory_uri().'/assets/icons/sections/'.$icon.'.svg" alt="" width="48" height="48" />
								<span>'.$title.'</span>
							</a></li>';
						}

						?>
					</ul>
				</nav>
				<?php // endif; ?>
			</div>

			<div class="main-navigation">
				<?php	if ( has_nav_menu( 'primary' ) ) : ?>
				<nav id="site-navigation" class="site-navigation main-navigation" aria-label="<?php esc_attr_e('Site Navigation', 'mit-ir'); ?>">

					<?php wp_nav_menu(
						array(
							'theme_location' => 'primary',
							// 'menu_id'        => 'primary-menu',
							// 'menu_class'     => 'primary-menu-items wp-menu',
							'container' 		 => false,
							'depth'					 => 2,
				      // 'fallback_cb'    => __NAMESPACE__ . '\Nav_Walker::fallback',
					    'link_before' => '<span>',
					    'link_after' => '</span>',
				      'has_dropdown'   => true,
				      // 'walker'         => new Nav_Walker(),
						)
					); ?>
				</nav><!-- #site-navigation -->
				<?php endif; ?>
			</div>

			<?php if(!is_front_page() && !is_search()) : ?>
			<div class="navigation-frame--search">
				<form role="search" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
					<input placeholder="Search MIT Data" type="search" value="<?php if( is_search() ) { echo get_search_query(); } ?>" name="s" />
					<input type="hidden" value="1" name="sentence" />
					<input type="hidden" value="projects" name="post_type" />
					<input type="submit" value="Search" />
				</form>
				<!-- <button id="main-navigation-toggle" class="menu-toggle mobile-toggle-button" aria-expanded="false" aria-haspopup="true" aria-controls="primary-menu" type="button" aria-label="<?php echo esc_html('Open Main Menu'); ?>">
					<span class="mobile-toggle-box">
						<span class="mobile-toggle-inner"></span>
					</span>
					<span id="nav-toggle-label" class="nav-toggle-label"><?php esc_html_e( 'Menu', 'mit-ir' ); ?></span>
				</button> -->
			</div>
			<?php endif; ?>
		</div>

		<div class="utility-frame">
			<button id="main-navigation-toggle" class="menu-toggle mobile-nav-toggle" aria-expanded="false" aria-haspopup="true" aria-controls="primary-menu" type="button" aria-label="<?php echo esc_html('Open Main Menu'); ?>">
				<span></span>
				<span></span>
				<span></span>
				<span></span>
				<span></span>
				<span id="nav-toggle-label" class="nav-toggle-label"><?php esc_html_e( 'Menu', 'mit-ir' ); ?></span>
			</button>

			<?php if(!is_front_page() && !is_search()) : ?>
			<button class="menu-search" aria-label="<?php echo esc_html('Search') ?>" aria-expanded="false">
				<svg width="41" height="40" viewBox="0 0 41 40" fill="none" xmlns="http://www.w3.org/2000/svg">
				<path fill-rule="evenodd" clip-rule="evenodd" d="M24.9655 12.5628C28.3826 15.9799 28.3826 21.5201 24.9655 24.9372C21.5484 28.3543 16.0082 28.3543 12.5911 24.9372C9.17404 21.5201 9.17404 15.9799 12.5911 12.5628C16.0082 9.14573 21.5484 9.14573 24.9655 12.5628ZM27.7933 25.4824C31.0925 21.0762 30.7391 14.8009 26.7333 10.795C22.3399 6.40165 15.2168 6.40165 10.8234 10.795C6.42996 15.1884 6.42996 22.3116 10.8234 26.705C15.0059 30.8875 21.6625 31.0882 26.0825 27.3071L30.9324 32.157L32.7002 30.3892L27.7933 25.4824Z" fill="#0D0009"/>
				</svg>
			</button>
			<?php endif; ?>

			<a href="https://mit.edu" class="mit-logo" title="MIT Office of the Provost: Institutional Research" rel="home" target="_blank">
				<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/logos/mit-logo.svg" alt="MIT Office of the Provost: Institutional Research" width="286" height="44" />
			</a>
		</div>
	</div>

	<?php if(!is_front_page() && !is_search()) : ?>
	<div class="site-header--search">
		<div class="search-and-filter">

			<?php include 'templates/search-and-filter.php'; ?>

		</div>
	</div>
	<?php endif; ?>
</header>


