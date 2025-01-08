<?php
/**
 * ACF Block Template: Team Overview
 *
 */

namespace MITIR;



// INIT Grab fields
$custom_block_data = array(); // Store all values in an array for the block
$custom_block_data['classes'] = 'team-overview sideline'; // Declare first classes
;
$custom_block_data['content'] = \get_field('to_content');
$custom_block_data['selector'] = \get_posts([ 'numberposts' => -1, 'post_type' => 'team', 'order' => 'ASC' ]); // \get_field('to_selector');

// Generate unique block ID
if( empty( $custom_block_data['block_id'] ) ) {
	if( !empty( $block['metadata']['name'] ) ) {
 		$custom_block_data['block_id'] = $block['metadata']['name'];
 	} else {
 		$custom_block_data['block_id'] = 'teamoverview_' . str_replace('block_', '', $block['id']);
 	}
}
?>
<section id="<?php echo esc_html( $custom_block_data['block_id'] ); ?>" class="<?php echo esc_html( $custom_block_data['classes'] ); ?>">
	<!-- <img src="<?php echo $custom_block_data['callout']['image']['sizes']['block-bg'] ?>" alt="" /> -->

<?php if($custom_block_data['content']) : ?>
	<div class="team-overview-content">
		<h2 class="header sideline magenta">
			<?php echo $custom_block_data['content']['title']; ?>
		</h2>
	</div>
<?php endif; ?>



<?php if($custom_block_data['selector']) : ?>
	<div class="team-overview-headshots">
		<?php foreach($custom_block_data['selector'] as $team) : ?>
			<a href="/about/team#selector?name=<?php echo $team->post_name ?>">
				<?php
				echo '<img src="'.get_the_post_thumbnail_url($team->ID, 'query-square').'" alt="" />';
				echo '<span class="header">' . $team->post_title . '</span>'; ?>
			</a>
		<?php endforeach; ?>
	</div>
<?php endif; ?>
</section>
