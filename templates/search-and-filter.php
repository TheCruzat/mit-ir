	<form role="search" class="input-row" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
		<input class="input-field" placeholder="Search MIT Data" type="search" value="<?php if( is_search() ) { echo get_search_query(); } ?>" name="s" />
		<input type="hidden" value="1" name="sentence" />
		<input type="hidden" value="projects" name="post_type" />
		<input class="tax-switch" type="hidden" value="project-population" name="taxonomy" />
		<!-- <input class="tax-switch" type="hidden" name="tax_query[relation]" value="OR"> -->
		<!-- <input type="hidden" value="10" name="posts_per_page" /> -->
		<?php
			$search_url = $_SERVER['REQUEST_URI'];
			$pops = get_terms(['taxonomy' => 'project-population', 'hide_empty' => false]);
			?>

			<?php /*<select name="project-population" id="project-population" class="postform" aria-label="Select Population" multiple>
				<option disabled selected value>Population</option>
				<?php foreach($pops as $pop) :
					echo '<option value="'.$pop->slug.'">'.$pop->name.'</option>';
				endforeach; ?>
			</select> 	*/ ?>
		<div class="dropdown">

			<?php //project-population


			// pr($pops);

			 ?>
			<span class="dropdown--label">Population</span>

			<div class="dropdown-arrow chevron-to-close">

				<span class="chevron-icon">
					<span></span>
					<span></span>
				</span>
			</div>
			<div class="dropdown-panel">
				<div class="dropdown-panel--wrap">
					<span class="search-clear-all"><span><span></span><span></span></span>Deselect All</span>
				</div>
				<div class="dropdown-panel--wrap">
					<?php foreach($pops as $pop) :
						// echo '<option value="'.$pop->slug.'">'.$pop->name.'</option>';'.$pop->slug.'
						if(str_contains($search_url, '='.$pop->slug)) $sel = ' checked'; else $sel = '';
						echo '<div class="dropdown-panel--input">
							<span><input type="checkbox" id="'.$pop->slug.'" name="term" value="'.$pop->slug.'"'.$sel.'><span></span></span>
							<label for="'.$pop->slug.'">'.$pop->name.'</label>
						</div>';
					endforeach; ?>
					<div class="dropdown-close button">Apply</div>
				</div>
			</div>
		</div>
		<input type="submit" value="Search" />

	</form>
