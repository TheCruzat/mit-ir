<?php
/**
 * ACF Block Template: Cards Stack Vertical
 *
 */

namespace MITIR;



// INIT Grab fields
$custom_block_data = array(); // Store all values in an array for the block
$custom_block_data['classes'] = 'cards-stack-vertical'; // Declare first classes
;
$custom_block_data['cards'] = \get_field('cv_cards');

include(dirname(__FILE__) . '/../block-meta.php');

// Generate unique block ID
if( empty( $custom_block_data['block_id'] ) ) {
	if( !empty( $block['metadata']['name'] ) ) {
 		$custom_block_data['block_id'] = $block['metadata']['name'];
 	} else {
 		$custom_block_data['block_id'] = 'cardstackvert_' . str_replace('block_', '', $block['id']);
 	}
}
?>
<section id="<?php echo esc_html( $custom_block_data['block_id'] ); ?>" class="<?php echo esc_html( $custom_block_data['classes'] ); ?>">
	<?php // pr($custom_block_data) ?>

	<div class="cards">
		<?php foreach($custom_block_data['cards'] as $card) :
			$cta_label = $card['cta_label'];
			if(!$cta_label) {
				$cta_label = $card['link']['title'];
			}
			echo '<div>';
			echo '<div class="icon"><img src="' . get_stylesheet_directory_uri() . '/assets/icons/types/' . $card['icon'] . '.svg" alt="" /></div>';
			echo '<div>';
			echo 	'<h2 class="header">'.$card['title'].'</h2>';
			echo 	'<div class="content">'.cn($card['excerpt']).'</div>';
			if($card['link']) {
				if($card['link']['target']) {
					$targ = ' target="_blank"';
				} else { $targ = ''; }
			echo 	'<div class="cta"><a href="'.$card['link']['url'].'"'.$targ.'><span>'.$cta_label.'</span><img src="'.get_stylesheet_directory_uri() . '/assets/icons/icon-arrow-upper-right.svg" alt="" /></a></div>';
			}
			echo '</div>';
			echo '</div>';
		endforeach; ?>
	</div>
</section>
