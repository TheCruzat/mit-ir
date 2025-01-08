<?php
/**
 * ACF Block Template: Search and Filter
 *
 */

namespace MITIR;


// INIT Grab fields
$custom_block_data = array(); // Store all values in an array for the block
$custom_block_data['classes'] = 'search-and-filter sideline magenta'; // Declare first classes
$custom_block_data['header'] = \get_field('sf_header');
$custom_block_data['tagline'] = \get_field('sf_tagline');

// Generate unique block ID
if( empty( $custom_block_data['block_id'] ) ) {
	if( !empty( $block['metadata']['name'] ) ) {
 		$custom_block_data['block_id'] = $block['metadata']['name'];
 	} else {
 		$custom_block_data['block_id'] = 'searchandfilter_' . str_replace('block_', '', $block['id']);
 	}
} ?>
<section id="<?php echo esc_html( $custom_block_data['block_id'] ); ?>" class="<?php echo esc_html( $custom_block_data['classes'] ); ?>">

	<div class="top-row">
		<?php if($custom_block_data['header']) : ?>
			<h1 class="header"><?php echo $custom_block_data['header']; ?></h1>
		<?php endif; ?>
		<?php if($custom_block_data['tagline']) : ?>
			<div class="tagline"><?php echo $custom_block_data['tagline']; ?></div>
		<?php endif; ?>
	</div>

	<?php include(dirname(__FILE__) . '/../../templates/search-and-filter.php'); ?>

</section>
