<?php
/**
 * ACF Block Template: Jump Links
 *
 */

namespace MITIR;

/*

// INIT Grab fields
$custom_block_data = array(); // Store all values in an array for the block
$custom_block_data['classes'] = 'page-header'; // Declare first classes
$custom_block_data['advanced'] = \get_field('advanced_settings');

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
}

// Generate unique block ID
if( empty( $custom_block_data['block_id'] ) ) {
	$custom_block_data['block_id'] = 'ph_' . str_replace('block_', '', $block['id']);
}
?>
<header id="<?php echo esc_html( $custom_block_data['block_id'] ); ?>" class="<?php echo esc_html( $custom_block_data['classes'] ); ?>">
	<?php echo wp_get_attachment_image( $custom_block_data['thumbnail'], 'full', false, array( 'class' => 'header-bg', 'alt' => '' ) ); ?>
	<div class="page-header__text">
		<h1 class="page-header__title eyebrow eyebrow-title"><?php echo esc_html( $custom_block_data['eyebrow'] ); ?></h1>
		<span class="page-header__description txt-kplr-xl"><?php echo wp_kses_post( $custom_block_data['description'] ); ?></span>
	</div>
</header>
*/ ?>
<div>Jump Links</div>
