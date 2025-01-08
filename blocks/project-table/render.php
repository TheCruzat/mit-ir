<?php
/**
 * ACF Block Template: Hero Content
 *
 */

namespace MITIR;



// INIT Grab fields
$custom_block_data = array(); // Store all values in an array for the block
$custom_block_data['classes'] = 'hero-content sideline'; // Declare first classes
;
$custom_block_data['content'] = \get_field('hero_content');
$custom_block_data['links'] = \get_field('hero_links');

// Generate unique block ID
if( empty( $custom_block_data['block_id'] ) ) {
	if( !empty( $block['metadata']['name'] ) ) {
 		$custom_block_data['block_id'] = $block['metadata']['name'];
 	} else {
 		$custom_block_data['block_id'] = 'herocontent_' . str_replace('block_', '', $block['id']);
 	}
}
?>
<section id="<?php echo esc_html( $custom_block_data['block_id'] ); ?>" class="<?php echo esc_html( $custom_block_data['classes'] ); ?>">
	<div class="content-frame">
		<img src="<?php echo $custom_block_data['content']['image']['sizes']['block-bg'] ?>" alt="" />
		<div class="content-box">
			<?php if($custom_block_data['content']['title']) : ?>
				<div class="header"><?php echo $custom_block_data['content']['title']; ?></div>
			<?php endif; ?>

			<div class="block-content">
				<?php echo $custom_block_data['content']['content']; ?>
			</div>

			<?php if($custom_block_data['links']) : ?>
				<div class="block-ctas">
					<?php foreach($custom_block_data['links'] as $link) : // pr($link);
						$cla = 'btn';

						$str = '<a';
						$str .= 	' class="'.$cla.'"';
						$str .= 	' href="'.$link['link']['url'].'"';
						$str .= '>'.$link['link']['title'].'</a>';
						echo $str;
					endforeach; ?>
				</div>
			<?php endif; ?>

			<?php /* if($custom_block_data['links']) : ?>
				<a class="btn" href="<?php echo $custom_block_data['links']['url'] ?>"><?php echo $custom_block_data['links']['title'] ?></a>
			<?php endif; */ ?>
		</div>
	</div>
</section>
