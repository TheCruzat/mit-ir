<?php
/**
 * ACF Block Template: Link List
 *
 */

namespace MITIR;


// INIT Grab fields
$custom_block_data = array(); // Store all values in an array for the block
$custom_block_data['classes'] = 'link-list sideline'; // Declare first classes
$custom_block_data['links'] = \get_field('ll_links');

// Generate unique block ID
if( empty( $custom_block_data['block_id'] ) ) {
	if( !empty( $block['metadata']['name'] ) ) {
 		$custom_block_data['block_id'] = $block['metadata']['name'];
 	} else {
 		$custom_block_data['block_id'] = 'linklist_' . str_replace('block_', '', $block['id']);
 	}
} ?>
<section id="<?php echo esc_html( $custom_block_data['block_id'] ); ?>" class="<?php echo esc_html( $custom_block_data['classes'] ); ?>">
	<?php foreach($custom_block_data['links'] as $link) :
		if($link['title']) {
			$title = $link['title'];
		} else {
			$title = $link['link']['title'];
		}

		if($link['icon']) {
			$icon = $link['icon'];
		}

		if($title && $icon) {
			$str = '<a href="'.$link['link']['url'].'" class="header"';
			if($link['link']['target'] == '_blank') {
				$str .= ' target="_blank"';
			}
			$str .= '>
				<img src="'.get_stylesheet_directory_uri().'/assets/icons/types/'.$icon.'.svg" alt="" />
				<span>'.$title.'</span></a>';
			echo $str;
		}

	endforeach; ?>
</section>

