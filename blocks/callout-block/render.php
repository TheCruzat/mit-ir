<?php
/**
 * ACF Block Template: Callout Block
 *
 */

namespace MITIR;



// INIT Grab fields
$custom_block_data = array(); // Store all values in an array for the block
$custom_block_data['classes'] = 'callout sideline sideline--rgba'; // Declare first classes
;
$custom_block_data['callout'] = \get_field('callout_block');
$custom_block_data['link'] = \get_field('link');

if($custom_block_data['img_style'] = \get_field('image_style')) {
	$custom_block_data['classes'] .= ' full-bg';
}

// Generate unique block ID
if( empty( $custom_block_data['block_id'] ) ) {
	if( !empty( $block['metadata']['name'] ) ) {
 		$custom_block_data['block_id'] = $block['metadata']['name'];
 	} else {
 		$custom_block_data['block_id'] = 'callout_' . str_replace('block_', '', $block['id']);
 	}
}
?>
<section id="<?php echo esc_html( $custom_block_data['block_id'] ); ?>" class="<?php echo esc_html( $custom_block_data['classes'] ); ?>">
	<img src="<?php echo $custom_block_data['callout']['image']['sizes']['block-bg'] ?>" width="1600" height="900" alt="" />
	<div class="content-box sideline">
		<?php if($custom_block_data['callout']['title']) : ?>
			<h2 class="header"><?php echo $custom_block_data['callout']['title']; ?></h2>
		<?php endif; ?>

		<?php echo $custom_block_data['callout']['content']; ?>

		<?php if($custom_block_data['link']) : ?>
			<a class="btn" href="<?php echo $custom_block_data['link']['url'] ?>"><?php echo $custom_block_data['link']['title'] ?></a>
		<?php endif; ?>
	</div>
</section>
