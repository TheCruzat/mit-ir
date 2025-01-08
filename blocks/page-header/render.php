<?php
/**
 * ACF Block Template: Page Header
 * Displays header with H1 for page header
 */

namespace MITIR;

global $post;

// INIT Grab fields
$custom_block_data = array(); // Store all values in an array for the block
$custom_block_data['classes'] = 'page-header'; // Declare first classes
$custom_block_data['hero'] = \get_field('page_hero');


// Generate unique block ID
if( empty( $custom_block_data['block_id'] ) ) {
	if( !empty( $block['metadata']['name'] ) ) {
 		$custom_block_data['block_id'] = $block['metadata']['name'];
 	} else {
 		$custom_block_data['block_id'] = 'pageheader_' . str_replace('block_', '', $block['id']);
 	}
}
?>
<header id="<?php echo esc_html( $custom_block_data['block_id'] ); ?>" class="<?php echo esc_html( $custom_block_data['classes'] ); ?>">

	<div class="header-content sideline magenta">
		<?php if($custom_block_data['hero']['eyebrow'] !== 'none' && $custom_block_data['hero']['eyebrow'] !== null && $custom_block_data['hero']['eyebrow'] !== '') {
			echo '<div class="eyebrow">';
			switch($custom_block_data['hero']['eyebrow']) {
				case 'custom':
					echo $custom_block_data['hero']['eyebrow_label'];
					break;
				case 'parent':
					echo '<a href="'.get_the_permalink($post->post_parent).'">'.get_the_title($post->post_parent).'</a>';
					break;
			}
			echo '</div>';
		}

		if($custom_block_data['hero']['title']) {
			$header_title = $custom_block_data['hero']['title'];
		} else {
			$header_title = $post->post_title;
		} echo '<h1 class="page-title">' . $header_title . '</h1>'; ?>
	</div>

	<?php if($custom_block_data['hero']['image']) : ?>
		<img class="bg-img" src="<?php echo $custom_block_data['hero']['image']['sizes']['block-bg'] ?>" alt="" />
	<?php endif; ?>

	<?php
	/* echo wp_get_attachment_image( $custom_block_data['thumbnail'], 'full', false, array( 'class' => 'header-bg', 'alt' => '' ) ); ?>
	<div class="page-header__text">
		<h1 class="page-header__title eyebrow eyebrow-title"><?php echo esc_html( $custom_block_data['eyebrow'] ); ?></h1>
		<span class="page-header__description txt-kplr-xl"><?php echo wp_kses_post( $custom_block_data['description'] ); ?></span>
	</div> */ ?>
</header>
