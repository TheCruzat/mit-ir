<?php
/**
 * ACF Block Template: Cards 3up
 *
 */

namespace MITIR;

// INIT Grab fields
$custom_block_data = array(); // Store all values in an array for the block
$custom_block_data['classes'] = 'cards-3up'; // Declare first classes
$custom_block_data['header'] = \get_field('c3u_header');
$custom_block_data['cards'] = \get_field('c3u_cards');
$custom_block_data['featured'] = \get_field('c3u_featured');

//pr(get_field('featured_projects', 'options')['featured_projects']);

if($custom_block_data['featured']) {
	$core = \get_field('featured_projects', 'options')['featured_projects'];
} else {

	$core = \get_field('c3u_cards');
}

// pr($core);

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

?>
<section id="<?php echo esc_html( $custom_block_data['block_id'] ); ?>" class="<?php echo esc_html( $custom_block_data['classes'] ); ?>">
	<?php if($custom_block_data['header']) : ?>
		<h2 class="eyebrow"><?php echo $custom_block_data['header'] ?></h2>
	<?php endif; ?>
	<div class="cards">
		<?php foreach($core as $card) :

		if($custom_block_data['featured']) {
			$i = $card->ID;
		} else {
			$i = $card['project']->ID;
		}

		// pr($i);

			$title = \get_field('pm_display_title', $i);
			if(!$title) $title = get_the_title($i);

			$icon = \get_field('type_icon', $i);


		if($custom_block_data['featured']) {
			$cta_label = 'View ' . $title;
		} else {
				$cta_label = $card['cta_label'];
				if(!$cta_label) {
					$cta_label = 'View ' . $title;
				}
			}
			?>
		<a class="card backslide" href="<?= get_the_permalink($i); ?>">
			<div class="icon">
				<img src="<?= get_stylesheet_directory_uri() . '/assets/icons/types/' . $icon . '.svg' ?>" alt="" width="48" height="48" />
			</div>

			<h3 class="header">
				<?= $title; ?>
			</h3>

			<div class="content">
				<?= get_the_excerpt($i) ?>
			</div>

			<div class="cta">
				<span><?= $cta_label ?></span>
				<img src="<?= get_stylesheet_directory_uri(); ?>/assets/icons/icon-arrow-right.svg" alt="" width="24" height="24" />
			</div>

			<?php if($custom_block_data['featured']) {
					$card_flag = \get_field('flag', $i);
					$card_show_flag = \get_field('show_flag', $i);
					if($card_flag && $card_show_flag) {
						echo '<div class="flag">'.$card_flag.'</div>';
					}
				} else {
					if($card['show_flag'] && $card['flag']) : ?>
					<div class="flag">
						<?= $card['flag'] ?>
					</div>
					<?php endif;
				} ?>
		</a>
		<?php endforeach; ?>
	</div>
</section>
