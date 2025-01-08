<?php
/**
 * ACF Block Template: Hero Content
 *
 */

namespace MITIR;



// INIT Grab fields
$custom_block_data = array(); // Store all values in an array for the block
$custom_block_data['classes'] = 'ask-an-expert'; // Declare first classes
;
$custom_block_data['title'] = \get_field('aae_title');
$custom_block_data['content'] = \get_field('aae_content');
$custom_block_data['link'] = \get_field('aae_link');

// Generate unique block ID
if( empty( $custom_block_data['block_id'] ) ) {
	if( !empty( $block['metadata']['name'] ) ) {
 		$custom_block_data['block_id'] = $block['metadata']['name'];
 	} else {
 		$custom_block_data['block_id'] = 'askanexpert_' . str_replace('block_', '', $block['id']);
 	}
}
?>
<section id="<?php echo esc_html( $custom_block_data['block_id'] ); ?>" class="<?php echo esc_html( $custom_block_data['classes'] ); ?>">

	<?php if($custom_block_data['title']) : ?>
		<h2 class="header"><?php echo $custom_block_data['title']; ?></h2>
	<?php endif; ?>

	<div class="block-content">
		<?php ecn($custom_block_data['content']); ?>
	</div>

	<?php if($custom_block_data['link']) : ?>
		<!-- <div class="block-ctas"> -->
			<?php // foreach($custom_block_data['links'] as $link) : // pr($link);
				$cla = 'btn';

				$str = '<a';
				$str .= 	' class="'.$cla.'"';
				$str .= 	' href="'.$custom_block_data['link']['url'].'"';
				$str .= '>'.$custom_block_data['link']['title'].'</a>';
				echo $str;
			// endforeach; ?>
		<!-- </div> -->
	<?php endif; ?>

	<?php /* if($custom_block_data['links']) : ?>
		<a class="btn" href="<?php echo $custom_block_data['links']['url'] ?>"><?php echo $custom_block_data['links']['title'] ?></a>
	<?php endif; */ ?>

</section>
