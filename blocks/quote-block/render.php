<?php
/**
 * ACF Block Template: Quote Block
 *
 */

namespace MITIR;

// INIT Grab fields
$custom_block_data = array(); // Store all values in an array for the block
$custom_block_data['classes'] = 'callout full-bg quote sideline sideline--rgba';
$custom_block_data['image'] = \get_field('quote_image');
$custom_block_data['quote'] = \get_field('quote');
$custom_block_data['name'] = \get_field('quote_name');
$custom_block_data['role'] = \get_field('quote_role');

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
	<img src="<?php echo $custom_block_data['image']['sizes']['block-bg'] ?>" alt="" />
	<div class="content-box sideline">
		<?php if($custom_block_data['quote']) : ?>
			<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/icons/icon-quote.svg" class="quote-icon" />
			<div class="header">&#8220;<?php echo $custom_block_data['quote'];?>&#8221;</div>
			<div class="attribution">
				<span><?php echo $custom_block_data['name'];?></span>
				<?php if($custom_block_data['role']) : ?>
					<span><?php echo $custom_block_data['role'];?></span>
				<?php endif; ?>
			</div>
		<?php endif; ?>
	</div>
</section>
