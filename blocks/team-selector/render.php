<?php
/**
 * ACF Block Template: Team Selector
 *
 */

namespace MITIR;



// INIT Grab fields
$custom_block_data = array(); // Store all values in an array for the block
$custom_block_data['classes'] = 'team-selector sideline'; // Declare first classes
;
$custom_block_data['content'] = \get_field('ts_content');
//$custom_block_data['selector'] = \get_field('ts_selector');
$custom_block_data['selector'] = \get_posts([ 'numberposts' => -1, 'post_type' => 'team', 'order' => 'ASC' ]);

// Generate unique block ID
if( empty( $custom_block_data['block_id'] ) ) {
	if( !empty( $block['metadata']['name'] ) ) {
 		$custom_block_data['block_id'] = $block['metadata']['name'];
 	} else {
 		$custom_block_data['block_id'] = 'teamselector_' . str_replace('block_', '', $block['id']);
 	}
}
// global $_wp_additional_image_sizes;
// pr($_wp_additional_image_sizes);
?>
<section id="<?php echo esc_html( $custom_block_data['block_id'] ); ?>" class="<?php echo esc_html( $custom_block_data['classes'] ); ?>">
	<div class="team-selector-rail">
		<div class="eyebrow">Select Team Members</div>
		<ul class="team-selector-nav">
		<?php $team1 = [];

		foreach($custom_block_data['selector'] as $coun => $team) :

			if($coun == 0) {
				$team1['id'] = $team->ID;
				$team1['name'] = $team->post_title;
				$team1['title'] = \get_field('title', $team->ID);
				$team1['content'] = addslashes(apply_filters('the_content', $team->post_content));
				if($temail = \get_field('email', $team->ID)) {
					$team1['email'] = $temail;
				}
				if($tphone = \get_field('phone', $team->ID)) {
					$team1['phone'] = $tphone;
				}
			}

			$str = '<li ';
			if($coun == 0) $str .= 'class="sel" ';
			$str .= 'data-id="'.$team->ID.'" ';
			$str .= 'data-slug="'.$team->post_name.'"';
			$str .= '><span>'.$team->post_title.'</span></li>';

			echo $str;

			endforeach; ?>
		</ul>
	</div>

	<div id="selector-frame" class="team-selector-frame">
		<?php foreach($custom_block_data['selector'] as $coun => $team) : ?>
		<div data-team-name="<?php echo $team->post_name; ?>">
	 		<div class="selector-meta">
				<img id="headshot" alt="picture of <?php echo $team->post_title ?>" src="<?php echo get_the_post_thumbnail_url($team->ID, 'query-square'); ?>" />
				<div>
					<div class="team-sel-identity">
						<div class="header team-sel-name"><?php echo $team->post_title; ?></div>
						<?php if($ttitle = \get_field('title', $team->ID)) { ?>
							<div class="team-sel-title"><?php echo $ttitle; ?></div>
						<?php } ?>
					</div>
					<?php if($temail = \get_field('email', $team->ID)) { ?>
						<div class="team-sel-email"><a href="mailto:<?php echo $temail ?>"><?php echo $temail; ?></a></div>
					<?php } ?>
					<?php if($tphone = \get_field('phone', $team->ID)) { ?>
						<div class="team-sel-phone"><a href="tel:<?php echo $tphone ?>"><?php echo $tphone; ?></a></div>
					<?php } ?>
				</div><?php /**/ ?>
			</div>
			<div class="selector-content">
				<?php echo ecn($team->post_content); ?>
			</div>
		</div>
		<?php endforeach; ?>
	</div>
	<script type="text/javascript">
		// const team = https://mit-ir.test/wp-json/wp/v2/team;
		// console.log();
		/*const
			screen = document.querySelector('#selector-frame'),
			thead = screen.querySelector('#headshot'),
			tname = screen.querySelector('.team-sel-name'),
			ttitle = screen.querySelector('.team-sel-title'),
			temail = screen.querySelector('.team-sel-email'),
			tphone = screen.querySelector('.team-sel-phone'),

			req = new XMLHttpRequest(),
			core = [];
			; // '/wp-json/wp/v2/team');

		function pingSite(id) {
			const url = window.location.protocol+'//'+window.location.host+'/wp-json/wp/v2/team/'+id;
			console.log(url);
			req.open('GET', url);
			// req.open('GET', 'https://mit-ir.test/wp-json/wp/v2/team/'+id);
			req.onload = function() {
				if(req.status >= 200 && req.status < 400) {
					const data = JSON.parse(req.responseText);
					console.log(data);


					/ *screen.querySelector('#headshot').setAttribute('src', nav.getAttribute('data-avatar'));
					screen.querySelector('#headshot').setAttribute('alt', nav.getAttribute('data-name'));
					screen.querySelector('.team-sel-name').innerHTML = nav.getAttribute('data-name');
					screen.querySelector('.team-sel-title').innerHTML = nav.getAttribute('data-title');
					screen.querySelector('.team-sel-email a').innerHTML = nav.getAttribute('data-email');
					screen.querySelector('.team-sel-email a').setAttribute('href', 'mailto:'.nav.getAttribute('data-email'));
					screen.querySelector('.team-sel-phone a').innerHTML = nav.getAttribute('data-phone');
					screen.querySelector('.team-sel-phone a').setAttribute('href', 'tel:'.nav.getAttribute('data-phone'));
					screen.querySelector('.selector-content').innerHTML = esc(nav.getAttribute('data-content'));* /


				} else {
					console.log('connected to server, returned error');
				}
			};
			req.onerror = function() {
				console.log('connection error');
			};
			req.send();
		}

		function rePopulateTeam(core) {
			console.log(core);
		}

		/ *fetch(req)
			.then((response) => {
		    if (!response.ok) {
		      throw new Error(`HTTP error! Status: ${response.status}`);
		    }

		    return response.blob();
		  })
		  .then((response) => {
		    console.log(response);
		  });

		  console.log()*/

		function flipNav(nav) {
			const slug = nav.getAttribute('data-slug');
			document.querySelector('.team-selector-nav li.sel').classList.remove('sel');
			nav.classList.add('sel');

			document.querySelectorAll('[data-team-name]').forEach((block, ndx) => {
				block.style.display = 'none';
			});
			document.querySelector('[data-team-name="'+slug+'"]').style.display = 'block';

			if(history.pushState) {
				history.pushState(null, null, '#selector?name='+slug);
			} else {
				location.hash = '#selector?name='+slug;
			}
		}

		document.querySelectorAll('.team-selector-nav li').forEach((nav, ndx) => {
			nav.addEventListener('click', function() {
				flipNav(nav);
			});
		});

		if(window.location.hash) {
			const teamVal = window.location.hash.split("=");

			if(teamVal[0].includes('#selector?name')) {
				flipNav(document.querySelector('.team-selector-nav li[data-slug="'+teamVal[1]+'"]'));
			}
		}
	</script>
</section>
