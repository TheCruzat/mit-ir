<?php
/**
 * ACF Block Template: Hero Content
 *
 */

namespace MITIR;



// INIT Grab fields
$custom_block_data = array(); // Store all values in an array for the block
$custom_block_data['classes'] = 'project-related-materials sideline'; // Declare first classes
;
$custom_block_data['header'] = \get_field('rm_header');
$custom_block_data['materials'] = \get_field('rm_materials');

// Generate unique block ID
if( empty( $custom_block_data['block_id'] ) ) {
	if( !empty( $block['metadata']['name'] ) ) {
 		$custom_block_data['block_id'] = $block['metadata']['name'];
 	} else {
 		$custom_block_data['block_id'] = 'relatedmaterials_' . str_replace('block_', '', $block['id']);
 	}
}
?>
<section id="<?php echo esc_html( $custom_block_data['block_id'] ); ?>" class="<?php echo esc_html( $custom_block_data['classes'] ); ?>">

	<div class="header"><?php echo $custom_block_data['header'] ?></div>
	<div class="cards"><?php foreach($custom_block_data['materials'] as $item) :
		// pr($item);
		$str = '<a href="'.$item['link']['url'].'" target="_blank"><div class="backslide">';
		$str .= '<div class="topper"><img src="'.get_stylesheet_directory_uri().'/assets/icons/types/'.$item['icon'].'.svg" alt="" /></div>';
		$str .= '<div class="card-body">';
		$str .= '<div class="header">'.$item['title'].'</div>';
		$str .= $item['excerpt'];
		$str .= '<img class="cta-arrow" src="'.get_stylesheet_directory_uri().'/assets/icons/icon-arrow-upper-right.svg" alt="" />';
		$str .= '</div>';
		$str .= '</div></a>';

		echo $str;
	endforeach; ?></div>

</section>
