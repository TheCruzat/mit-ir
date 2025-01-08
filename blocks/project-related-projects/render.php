<?php
/**
 * ACF Block Template: Hero Content
 *
 */

namespace MITIR;



// INIT Grab fields
$custom_block_data = array(); // Store all values in an array for the block
$custom_block_data['classes'] = 'project-related-projects sideline'; // Declare first classes
;
$custom_block_data['header'] = \get_field('rp_header');
$custom_block_data['projects'] = \get_field('rp_projects');

// Generate unique block ID
if( empty( $custom_block_data['block_id'] ) ) {
	if( !empty( $block['metadata']['name'] ) ) {
 		$custom_block_data['block_id'] = $block['metadata']['name'];
 	} else {
 		$custom_block_data['block_id'] = 'relatedprojects_' . str_replace('block_', '', $block['id']);
 	}
}
?>
<section id="<?php echo esc_html( $custom_block_data['block_id'] ); ?>" class="<?php echo esc_html( $custom_block_data['classes'] ); ?>">

	<div class="header"><?php echo $custom_block_data['header'] ?></div>
	<div class="cards">
		<?php foreach($custom_block_data['projects'] as $project) : // pr($project->ID);

			$icon = \get_field('type_icon', $project->ID);

			$str = '<a class="header" href="'.get_the_permalink($project->ID).'"><div class="backslide pink">';

			$str .= '<div class="topper">';

			if(isset($icon) && $icon !== 'null') :
			$str .= '<img src="'.get_stylesheet_directory_uri().'/assets/icons/types/'.$icon.'.svg" alt="" width="48" height="48" />';
			endif;

			$str .= '</div><div class="card-body">';

			// pr($icon);
			$str .= $project->post_title;
			$str .= '<img class="cta-arrow" src="'.get_stylesheet_directory_uri().'/assets/icons/icon-arrow-upper-right.svg" alt="" width="24" height="24" />';
			$str .= '</div></div></a>';

			echo $str;
		endforeach; ?>
		</div>

</section>
