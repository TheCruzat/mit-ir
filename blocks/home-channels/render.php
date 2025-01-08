<?php
/**
 * ACF Block Template: Homepage Channels
 *
 */

namespace MITIR;


// INIT Grab fields
$custom_block_data = array(); // Store all values in an array for the block
$custom_block_data['classes'] = 'home-channels'; // Declare first classes
// $custom_block_data[''] = \get_field('');
$custom_block_data['show_ht_row'] = \get_field('show_ht_row');
$custom_block_data['header'] = \get_field('channels_header');
$custom_block_data['channels'] = \get_field('channels');

$custom_block_data['links'] = \get_field('mega_menu', 'options');

// pr($custom_block_data['links']);

/*
if( $custom_block_data['advanced'] ) { // Advanced Settings Enabled
	// Get advanced settings, process them via function
	$custom_block_data['advanced_settings'] = \get_field('advanced');
	$adv_settings = set_custom_block_advanced_settings( $custom_block_data, $custom_block_data['advanced_settings']);

	if( !empty( $adv_settings ) ) {
		$custom_block_data = array_merge( $custom_block_data, $adv_settings );
	}
}

if( $custom_block_data['advanced'] && $custom_block_data['advanced_settings']['background_image'] ) {
	$custom_block_data['thumbnail'] = $custom_block_data['advanced_settings']['background_image'];
} else {
	$custom_block_data['thumbnail'] = get_post_thumbnail_id();
}

// Pull block data
$custom_block_data['title'] = \get_field('eyebrow_text');
$custom_block_data['description'] = \get_field('page_description');
$custom_block_data['excerpt'] = wp_strip_all_tags( get_the_excerpt(), false );

if( ! $custom_block_data['description'] ) {
	$custom_block_data['description'] = $custom_block_data['excerpt'];
}

// Check for eyebrow
if( $custom_block_data['title'] ) {
	$custom_block_data['eyebrow'] = $custom_block_data['title'];
} else {
	$custom_block_data['eyebrow'] = get_the_title();
} */

// Generate unique block ID
if( empty( $custom_block_data['block_id'] ) ) {
	if( !empty( $block['metadata']['name'] ) ) {
 		$custom_block_data['block_id'] = $block['metadata']['name'];
 	} else {
 		$custom_block_data['block_id'] = 'homechannels_' . str_replace('block_', '', $block['id']);
 	}
} /*
?>
<header id="<?php echo esc_html( $custom_block_data['block_id'] ); ?>" class="<?php echo esc_html( $custom_block_data['classes'] ); ?>">
	<?php echo wp_get_attachment_image( $custom_block_data['thumbnail'], 'full', false, array( 'class' => 'header-bg', 'alt' => '' ) ); ?>
	<div class="page-header__text">
		<h1 class="page-header__title eyebrow eyebrow-title"><?php echo esc_html( $custom_block_data['eyebrow'] ); ?></h1>
		<span class="page-header__description txt-kplr-xl"><?php echo wp_kses_post( $custom_block_data['description'] ); ?></span>
	</div>
</header>
*/ ?>
<section id="<?php echo esc_html( $custom_block_data['block_id'] ); ?>" class="<?php echo esc_html( $custom_block_data['classes'] ); ?>">

<?php // pr($block['metadata']['name']);
	if($custom_block_data['show_ht_row']) : ?>
		<div class="home-channels__header">
			<h2 class="eyebrow"><?php echo $custom_block_data['header']; ?></h2>
			<div class="view-more chevron-to-close">
				<span>View More</span>
				<span class="chevron-icon">
					<span></span>
					<span></span>
				</span>
			</div>
			<div class="home-channels__topics">
				<div class="home-channels__topics-menu">
					<ul><?php /* $topics = get_terms([ 'taxonomy' => 'project-topic', 'hide_empty' => false ]);
						// pr($topics[0]);
						foreach($topics as $term) : // pr($term);
							echo '<li><a href="'.get_term_link($term->term_id).'">'.$term->name.'</a></li>';
						endforeach; */

						foreach($custom_block_data['links'] as $link) : $l = $link['link'];
							// pr($link);
							if($l['target'] !== null) $targ = ' target="'.$l['target'].'"'; else $targ = '';
							echo '<li><a href="'.$l['url'].'"'.$targ.'>'.$l['title'].'</a></li>';
						endforeach; /* */

					?></ul>
				</div>
			</div>
		</div>
	<?php endif;
 ?>
 <div class="channels">
 	<?php foreach($custom_block_data['channels'] as $channel) :
 		if($channel['title']) {
 			$title = $channel['title'];
 		} else {
 			$title = $channel['page']->post_title;
 		}
 		?>
 		<a class="backslide" href="<?= get_the_permalink($channel['page']->ID); ?>">
 			<?php // pr($channel['icon']) ?>
 			<div class="icon">
 				<img src="<?php echo $channel['icon']['url'] ?>" alt="" width="<?php echo $channel['icon']['width'] ?>" height="<?php echo $channel['icon']['height'] ?>" />
 			</div>
 			<h3 class="header"><?php echo $title; // echo $channel['title'] ?></h3>
 			<div class="content">
 				<?php echo $channel['content']; ?>
 			</div>
 			<div class="arrow-icon"><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/icons/icon-arrow-upper-right.svg" alt="" width="21" height="20" /></div>
 		</a>
 	<?php endforeach; ?>
	</div>
	<script type="text/javascript">
		document.querySelector('.view-more').addEventListener('click', function() {
			const topics = document.querySelector('.home-channels__header');
			if(topics.classList.contains('open')) {
				topics.classList.remove('open')
			} else {
				topics.classList.add('open')
			}
		});
	</script>

</section>
