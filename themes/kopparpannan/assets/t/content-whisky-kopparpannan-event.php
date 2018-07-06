<?php if (has_whisky()) { ?>   
  <div class="ui horizontal divider"> Provad dryck </div>
  <div class="ui horizontal raised segments">

<?php
	$args = array( 
		'post_type' => 'kp-whiskybetyg',
		'posts_per_page' => -1,
		'meta_key' => 'prov',
		'meta_value' => get_the_ID(),
	);
	$queue = new WP_Query($args);
	if ($queue->have_posts()) {
		while ($queue->have_posts()) {
			$queue->the_post();
			$whisky_ob = get_field('whisky');
?>
		<div class="ui segment">
			<div class="content">
				<div class="header"> 
					<a href="<?php echo get_the_permalink($whisky_ob); ?>">
						<?php echo get_the_title($whisky_ob); ?>
					</a>
				</div>
				<?php if (has_post_thumbnail($whisky_ob)) { ?>
				<div class="ui small image"> <?php echo get_the_post_thumbnail($whisky_ob); ?> </div>
				<?php } ?>
				<div class="meta">
					<div class="ui list">
						<div class="item">
							<i class="clock outline icon"></i>
							<div class="content">
								<?php
									$age = get_field('age', $whisky_ob->ID);
									echo $age;
									if ($age != 'NAS') {
										echo " yo";
									}
								?> </div>
						</div>
						<div class="item">
							<i class="glass martini icon"></i>
							<div class="content"> <?php echo get_field('alkoholhalt', $whisky_ob->ID); ?>% </div>
						</div>
						<div class="item">
							<i class="map marker alternate icon"></i>
							<div class="content">
								<?php the_flag($whisky_ob->ID);
											echo " ";
											$term = get_field('omrade', $whisky_ob->ID);
											echo $term->name;
								?> </div>
						</div>
						<div class="item">
							<i class="shopping cart icon"></i>
							<div class="content">
								<?php 
									echo get_field('pris', $whisky_ob->ID); 
									echo " / "; 
									echo get_field('volym', $whisky_ob->ID); ?>ml
							</div>
						</div>
						<div class="item">
							<i class="trophy icon"></i> 
							<div class="content">
								<strong><?php the_field('betyg'); ?></strong>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
<?php }
	} 
	wp_reset_postdata();
?>

	</div>
<?php } ?>
