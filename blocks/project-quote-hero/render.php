<?php
/**
 * ACF Block Template: Project Quote Hero
 *
 */

namespace MITIR;



// INIT Grab fields
$custom_block_data = array(); // Store all values in an array for the block
$custom_block_data['classes'] = 'project-quote-hero'; // Declare first classes
;
$custom_block_data['content'] = \get_field('qh_content');
$custom_block_data['link'] = \get_field('qh_link');
$custom_block_data['quote'] = \get_field('qh_quote');

include(dirname(__FILE__) . '/../block-meta.php');

// Generate unique block ID
if( empty( $custom_block_data['block_id'] ) ) {
	if( !empty( $block['metadata']['name'] ) ) {
 		$custom_block_data['block_id'] = $block['metadata']['name'];
 	} else {
 		$custom_block_data['block_id'] = 'quotehero_' . str_replace('block_', '', $block['id']);
 	}
}
?>
<section id="<?php echo esc_html( $custom_block_data['block_id'] ); ?>" class="<?php echo esc_html( $custom_block_data['classes'] ); ?>">
	<?php // pr($custom_block_data) ?>

	<div class="content-left sideline magenta">
		<div class="header"><?= $custom_block_data['content']['title'] ?></div>
		<div class="content"><?php ecn($custom_block_data['content']['content']); ?></div>
		<div class="cta">
			<?php
				$targ = '';
				echo '<a href="'.$custom_block_data['link']['url'].'" class="btn"'.$targ.'>'.$custom_block_data['link']['title'].'</a>';
			?>
		</div>
	</div>

	<div class="quote-right">
		<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/icons/icon-quote.svg" class="quote-icon" />
		<div class="header"><?= $custom_block_data['quote']['quote'];?>&#8221;</div>
		<div class="attribution">
				<span><?php echo $custom_block_data['quote']['quote_name'];?></span>
				<?php if($custom_block_data['quote']['quote_role']) : ?>
					<span><?php echo $custom_block_data['quote']['quote_role'];?></span>
				<?php endif; ?>
		</div>
	</div>
</section>
