<?php
/**
 * ACF Block Template: Cards 3up
 *
 */

namespace MITIR;

// INIT Grab fields
$custom_block_data = array(); // Store all values in an array for the block
$custom_block_data['classes'] = 'logos-block'; // Declare first classes
;
$custom_block_data['header'] = \get_field('lb_header');
$custom_block_data['logos'] = \get_field('lb_logos');

include(dirname(__FILE__) . '/../block-meta.php');

// Generate unique block ID
if( empty( $custom_block_data['block_id'] ) ) {
	if( !empty( $block['metadata']['name'] ) ) {
 		$custom_block_data['block_id'] = $block['metadata']['name'];
 	} else {
 		$custom_block_data['block_id'] = 'logoblock_' . str_replace('block_', '', $block['id']);
 	}
}
?>
<section id="<?php echo esc_html( $custom_block_data['block_id'] ); ?>" class="<?php echo esc_html( $custom_block_data['classes'] ); ?>">
	<?php if($custom_block_data['header']) : ?>
		<div class="header"><?php ecn($custom_block_data['header']); ?></div>
	<?php endif; ?>
	<div class="cards">
		<?php if($custom_block_data['logos']) : foreach($custom_block_data['logos'] as $logo) :

			echo '<div class="logo-card">';
			echo 	'<img src="'.$logo['logo']['url'].'" alt="" />';
			echo 	'<div class="header">'.$logo['title'].'</div>';
			echo 	'<div>'.$logo['content'].'</div>';
			echo '</div>';
			?>


		<?php endforeach; endif; ?>
	</div>
	<?php // pr($custom_block_data) ?>
</section>
