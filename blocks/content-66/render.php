<?php
/**
 * ACF Block Template: Content 66
 *
 */

namespace MITIR;

global $post;

// INIT Grab fields
$custom_block_data = array(); // Store all values in an array for the block
$custom_block_data['classes'] = 'content-66'; // Declare first classes
;
$custom_block_data['content'] = \get_field('c6_content');
$custom_block_data['sideline'] = \get_field('c6_sideline');
$custom_block_data['font_size'] = \get_field('c6_font_size');
if($custom_block_data['font_size'] == 'large') {
	$custom_block_data['classes'] .= ' large-text';
}
$custom_block_data['breadcrumb'] = \get_field('pm_breadcrumb', $post->ID);
if($custom_block_data['breadcrumb'] == 'custom') {
	$custom_block_data['custom'] = \get_field('pm_bc_custom');
}

include(dirname(__FILE__) . '/../block-meta.php');

// Generate unique block ID
if( empty( $custom_block_data['block_id'] ) ) {
	if( !empty( $block['metadata']['name'] ) ) {
 		$custom_block_data['block_id'] = $block['metadata']['name'];
 	} else {
 		$custom_block_data['block_id'] = 'content66_' . str_replace('block_', '', $block['id']);
 	}
}
?>
<section id="<?php echo esc_html( $custom_block_data['block_id'] ); ?>" class="<?php echo esc_html( $custom_block_data['classes'] ); ?>">

	<?php
	// pr($custom_block_data['breadcrumb']);
	if(isset($custom_block_data['breadcrumb']) && $custom_block_data['breadcrumb'] == 'back') :
		echo '<div class="project-breadcrumb"><a href="javascript:history.go(-1)">Back</a></div>';
	endif;

	echo apply_filters('the_content', $custom_block_data['content']) ?>

</section>
