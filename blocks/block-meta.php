<?php

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

?>
