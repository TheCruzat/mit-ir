<?php

/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package mit-ir
 */

namespace MITIR;

get_header();

	$tax = get_queried_object();
	// pr($tax);
	// echo  $taxonomy->name;
?>

	<main id="primary" class="site-main">

<section class="home-channels">

		<div class="home-channels__header">
			<div class="eyebrow">Research Topics</div>
			<div class="view-more">
				<span>View More</span>
				<span class="chevron-icon">
					<span></span>
					<span></span>
				</span>
			</div>
			<div class="home-channels__topics">
				<div class="home-channels__topics-menu">
					<ul><li><a href="https://accreditation.mit.edu" target="_blank">Accreditation</a></li><li><a href="/project-topic/admissions" target="">Admissions</a></li><li><a href="/project-topic/advising" target="">Advising</a></li><li><a href="/project-topic/alumni" target="">Alumni</a></li><li><a href="/project-topic/awards" target="">Awards</a></li><li><a href="/project-topic/campus-climate" target="">Campus Climate</a></li><li><a href="/project-topic/career" target="">Career</a></li><li><a href="/project-topic/class-size" target="">Class Size</a></li><li><a href="/project-topic/collaborations" target="">Collaborations</a></li><li><a href="/project-topic/common-data-set" target="">Common Data Set</a></li><li><a href="/project-topic/commuting" target="">Commuting</a></li><li><a href="/project-topic/degrees" target="">Degrees</a></li><li><a href="/project-topic/diversity" target="">Diversity</a></li><li><a href="/project-topic/enrollment" target="">Enrollment</a></li><li><a href="/project-topic/epr" target="">ePR</a></li><li><a href="/project-topic/faculty" target="">Faculty</a></li><li><a href="/project-topic/financial-aid" target="">Financial Aid</a></li><li><a href="/project-topic/focus-groups" target="">Focus Groups</a></li><li><a href="/project-topic/graduate-students" target="">Graduate Students</a></li><li><a href="/project-topic/graduation-rate" target="">Graduation Rate</a></li><li><a href="/project-topic/health-wellness" target="">Health &amp; Wellness</a></li><li><a href="/project-topic/mentoring" target="">Mentoring</a></li><li><a href="https://facts.mit.edu" target="_blank">MIT Facts</a></li><li><a href="/project-topic/mitx" target="">MITx</a></li><li><a href="/project-topic/national-academies" target="">National Academies</a></li><li><a href="/project-topic/nobel-prize" target="">Nobel Prize</a></li><li><a href="/project-topic/postdoctoral-scholars" target="">Postdoctoral Scholars</a></li><li><a href="/project-topic/quality-of-life" target="">Quality of Life</a></li><li><a href="/project-topic/rankings" target="">Rankings</a></li><li><a href="/project-topic/research-expenditures" target="">Research Expenditures</a></li><li><a href="/project-topic/retention" target="">Retention</a></li><li><a href="/project-topic/sat-act-scores" target="">SAT/ACT Scores</a></li><li><a href="/project-topic/satisfaction" target="">Satisfaction</a></li><li><a href="/project-topic/staff" target="">Staff</a></li><li><a href="/project-topic/surveys" target="">Surveys</a></li><li><a href="/project-topic/time-to-degree" target="">Time to Degree</a></li><li><a href="/project-topic/tuition" target="">Tuition</a></li><li><a href="/project-topic/undergraduate-students" target="">Undergraduate Students</a></li><li><a href="/project-topic/workload" target="">Workload</a></li></ul>
				</div>
			</div>
		</div>
	<script type="text/javascript">
		document.querySelector('.view-more').addEventListener('click', function() {
			const topics = document.querySelector('.home-channels__header');
			if(topics.classList.contains('open')) {
				topics.classList.remove('open')
			} else {
				topics.classList.add('open')
			}
		});
	</script>

</section>


		<div class="listing sideline">

			<div class="listing-header">Projects listed under "<?= $tax->name; ?>"</div>

			<?php
		while ( have_posts() ) : the_post();

			$i = $post->ID;
			$data = get_fields($i);


					$pm_meta = $data['pm_name_in_group'];
					if(!$pm_meta) {
						$pm_meta = date('Y', strtotime($post->post_date));
					}

			echo '<div class="listing-item">';
			echo 	'<a href="'.get_permalink($i).'">';
			echo 		'<div class="listing-item--icon"><img src="'.get_stylesheet_directory_uri().'/assets/icons/types/'.$data['type_icon'].'.svg" alt="" /></div>';
			echo  	'<div class="listing-item--content">';
			echo 			'<h3 class="header">' . get_the_title() . '</h3>';
				the_excerpt();
			echo 		'</div>';
			echo 		'<div class="listing-item--meta">';
			echo 			$pm_meta;
			echo 		'</div>';
			echo 	'</a>';
			// pr();
			echo '</div>';

		endwhile; // End of the loop.
		?>
		</div>

		<section class="featured-projects sideline">
			<div class="header">Featured Projects</div>
			<div class="cards">
			<?php foreach(get_field('featured_projects', 'Options') as $project) :

				// pr($project);

				$icon = \get_field('type_icon', $project[0]->ID);

				$str = '<a href="'.get_the_permalink($project[0]->ID).'"><div class="backslide pink">';

				$str .= '<div class="topper">';

				if(isset($icon) && $icon !== 'null') :
				$str .= '<img src="'.get_stylesheet_directory_uri().'/assets/icons/types/'.$icon.'.svg" alt="" />';
				endif;

				$str .= '</div><div class="card-body">';

				// pr($icon);
				$str .= '<div class="header">'.$project[0]->post_title.'</div>';
				$str .= '<img class="cta-arrow" src="'.get_stylesheet_directory_uri().'/assets/icons/icon-arrow-upper-right.svg" alt="" />';
				$str .= '</div></div></a>';

				echo $str;/**/

			endforeach; ?>
			</div>
		</section>

	</main>

<?php
get_footer();
