<?php
/**
 * ACF Block Template: Cards 3up Alt
 *
 */

namespace MITIR;

// INIT Grab fields
$custom_block_data = array(); // Store all values in an array for the block
$custom_block_data['classes'] = 'cards-3up alt-3up'; // Declare first classes
$custom_block_data['header'] = \get_field('c3u_header');
$custom_block_data['cards'] = \get_field('c3u_cards');

$custom_block_data['sideline'] = \get_field('block_sideline');
if($custom_block_data['sideline'] == 'gray') {
	$custom_block_data['classes'] .= ' sideline';
} else if($custom_block_data['sideline'] == 'magenta') {
	$custom_block_data['classes'] .= ' sideline magenta';
}

$custom_block_data['bottomline'] = \get_field('block_bottomline');
if($custom_block_data['bottomline'] == 'gray') {
	$custom_block_data['classes'] .= ' bottomline';
}

// Generate unique block ID
if( empty( $custom_block_data['block_id'] ) ) {
	if( !empty( $block['metadata']['name'] ) ) {
 		$custom_block_data['block_id'] = $block['metadata']['name'];
 	} else {
 		$custom_block_data['block_id'] = 'cards3up_' . str_replace('block_', '', $block['id']);
 	}
}

	// temporary
	$fpo_content = [
		["Quality of Life Survey", "An institute-wide survey to better understand the lives of faculty, staff, postdoctoral scholars, and students.", "View Quality of Life survey"],
		["Diversity Dashboard", "An in-depth look at the demographic trends of the entire MIT community.", "View Diversity Dashboard"],
		["Common Data Set", "Standardied data points that allow for comparison between MIT and other institutions.", "View Common Data Set"]
	]
?>
<section id="<?php echo esc_html( $custom_block_data['block_id'] ); ?>" class="<?php echo esc_html( $custom_block_data['classes'] ); ?>">
	<?php if($custom_block_data['header']) : ?>
		<div class="eyebrow"><?php echo $custom_block_data['header'] ?></div>
	<?php endif; ?>
	<div class="cards">
<?php foreach($custom_block_data['cards'] as $coun => $card) :
			$i = $card['project'];
			$title = \get_field('pm_display_title', $i);
			if(!$title) $title = get_the_title($i);
			$icon = get_field('type_icon', $i);

			?>
		<a class="card backslide" href="<?= get_the_permalink($i); ?>">
			<div class="icon">
				<img src="<?= get_stylesheet_directory_uri() . '/assets/icons/types/' . $icon . '.svg' ?>" alt="" />
			</div>

			<h3 class="header">
				<?= $title ?>
				<img src="<?= get_stylesheet_directory_uri(); ?>/assets/icons/icon-arrow-upper-right.svg" alt="" />
			</h3>


		</a>
		<?php

			if(($coun+1) % 3 == 0) {
				echo '<div></div>';
			}
		?>
		<?php endforeach; ?>
	</div>
</section>
