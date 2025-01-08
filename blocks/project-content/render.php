<?php
/**
 * ACF Block Template: Content 66
 *
 */

namespace MITIR;

global $drop_down_viz; // prevent multiple dropdowns

// INIT Grab fields
$custom_block_data = array(); // Store all values in an array for the block
$custom_block_data['classes'] = 'project-content'; // Declare first classes
;

$i = pid();
$custom_block_data['group'] = \get_field('pm_projects_in_group', $i);
if ($custom_block_data['group']) {
	$custom_block_data['groupname'] = \get_field('pm_name_in_group', $i);
}

$custom_block_data['set'] = \get_field('project_single'); // pr($custom_block_data['set']);
switch($custom_block_data['set']['project_content'][0]['acf_fc_layout']) {
	case 'content_66':
		$custom_block_data['classes'] .= ' content-66';
		break;
	case 'iframe_embed':
		$custom_block_data['classes'] .= ' iframe-embed';
		break;
	case 'table':
		$custom_block_data['classes'] .= ' table';
		break;
	case 'columns':
		$custom_block_data['classes'] .= ' columns';
		break;
}

include(dirname(__FILE__) . '/../block-meta.php');

$sel_class = '';
if($custom_block_data['sideline'] == 'gray') : $sel_class = ' sideline'; endif;
if($custom_block_data['sideline'] == 'magenta') : $sel_class = ' sideline magenta'; endif;

// Generate unique block ID
if( empty( $custom_block_data['block_id'] ) ) {
	if( !empty( $block['metadata']['name'] ) ) {
 		$custom_block_data['block_id'] = $block['metadata']['name'];
 	} else {
 		$custom_block_data['block_id'] = 'projectcontent_' . str_replace('block_', '', $block['id']);
 	}
}
?><?php

		if($custom_block_data['group'] && $custom_block_data['groupname'] && $drop_down_viz == null) :
			echo '<div class="project-group-selector--frame'.$sel_class.'"><div class="project-group-selector">';
			echo '<div class="current">'.$custom_block_data['groupname'].'</div>';
			echo 	'<div class="options">';
			foreach($custom_block_data['group'] as $groupie) :
				$gi = $groupie->ID;
				$gtitle = \get_field('pm_display_title', $gi);
				$gname = \get_field('pm_name_in_group', $gi);
				// if(!$gname) {
				// 	$gname = $groupie->post_title;
				// }
				echo '<div><a class="back-slide" href="'.get_permalink($gi).'">'.$gtitle.' ('.$gname.')</a></div>';
			endforeach;
			echo '</div>';
			echo '<div class="project-group-selector--icon">';
			echo 	'<svg width="14" height="8" viewBox="0 0 14 8" fill="none" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M13.4714 1.4714L7 7.94281L0.528595 1.4714L1.4714 0.528595L7 6.05719L12.5286 0.528596L13.4714 1.4714Z" fill="#0D0009"/></svg>';
			echo '</div>';
			echo '</div></div>';

			$drop_down_viz = true;
		endif;
3
?>
<section id="<?php echo esc_html( $custom_block_data['block_id'] ); ?>" class="<?php echo esc_html( $custom_block_data['classes'] ); ?>">
	<div class="content-box">
	<?php

		switch($custom_block_data['set']['project_content'][0]['acf_fc_layout']) :

			case 'content_66':
				ecn($custom_block_data['set']['project_content'][0]['content']);
				break;
			case 'iframe_embed':
				ecn($custom_block_data['set']['project_content'][0]['embed']);
				break;
			case 'table':
				ecn($custom_block_data['set']['project_content'][0]['shortcode']);
				break;
			case 'columns':
				if($custom_block_data['set']['project_content'][0]['header']) {
					echo '<div class="eyebrow">' . $custom_block_data['set']['project_content'][0]['header'] . '</div>';
				}
				echo '<div class="project-content-columns">';
				foreach($custom_block_data['set']['project_content'][0]['columns'] as $col) :
					echo '<div class="project-content-column">';
						ecn($col['column_content']);
					echo '</div>';
				endforeach;
				echo '</div>';
				break;

		endswitch;

		// ?>
	</div>
</section>
