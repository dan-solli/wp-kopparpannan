<?php
/**
 * The main whisky showing page
 *
 * This one should move into index.php - maybe!?
 *
 * @package Kopparpannan
 * @since Kopparpannan 0.1
 */
?>

<?php get_header(); ?>


<?php while ( have_posts() ) : the_post() ?>
					<article id="post-<?php the_ID(); ?>" class="ui raised segments">
						<div class="ui segment">
							<div class="content">
								<div class="header">
									<h2> 
										<?php the_title(); ?>
										<i class="scotland flag"> </i> 
									</h2>
								</div>
							</div>
						</div>							
						<div class="ui horizontal raised segments">

<?php if ( has_post_thumbnail() ) { ?>
							<div class="ui segment">
<?php 	the_post_thumbnail( 'full', array( 'class'  => 'ui centered small image' ) ); ?>
							</div>
<?php } ?>

							<div class="ui segment">
								<div class="content">
									<div class="description">
										<div class="ui list">
											<div class="item">
												<i class="clock outline icon"></i>
												<div class="content"> 
													<?php 
														$age = get_field('age'); 
														echo $age;
														if ($age != 'NAS') {
															echo " yo";
														}
													?> </div>
											</div>
											<div class="item">
												<i class="glass martini icon"></i>
												<div class="content"> <?php the_field('alkoholhalt'); ?>% </div>
											</div>
											<div class="item">
												<i class="map marker alternate icon"></i>
												<div class="content"> <?php 
													$term = get_field('omrade'); 
													echo $term->name;
												?> </div>
											</div>
											<div class="item">
												<i class="shopping cart icon"></i>
												<div class="content"> 
													<?php the_field('pris'); echo " / "; the_field('volym'); ?>ml 
												</div>
											</div>
										</div>
										<div class="ui list">
<?php 
	$args = array (
		'post_type' 			=> 'kp-whiskybetyg',
		'posts_per_page' 	=> -1,
		'meta_query'			=> array( array(
			'key' 		=> 'whisky',
			'value' 	=> get_the_ID(),
			'type' 		=> 'NUM',
			'compare' => '='))
	);

	$betyg_query = new WP_Query( $args );
	if ($betyg_query->have_posts()) {
		while ($betyg_query->have_posts()) {
			$betyg_query->the_post();
			$prov_ob = get_field('prov');
?>
											<div class="item">
												<i class="trophy icon"></i>
												<div class="content"> 
													<?php the_field('betyg'); ?>
													<small> 
														( <a href="<?php echo get_permalink($prov_ob); ?>">
															<?php echo date('Y-m-d', $prov_ob->tid); ?>
														</a> )
													</small> 
												</div>
											</div>
<?php 
    }
  } 
  wp_reset_postdata();
?>											
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="ui segment">
							<div class="content">
								<div class="header"> <h2> <i class="quote left icon"> </i> </h2> </div>
								<div class="description">
<?php 
	$args = array (
		'post_type' 			=> 'citat',
		'posts_per_page' 	=> -1,
		'meta_query'			=> array( array(
			'key' 		=> 'whisky',
			'value' 	=> get_the_ID(),
			'type' 		=> 'NUM',
			'compare' => '='))
	);

	$citat_query = new WP_Query( $args );
	if ($citat_query->have_posts()) {
		while ($citat_query->have_posts()) {
			$citat_query->the_post();

			$prov_ob = get_field('event');
			$user_ob = get_field('user');
?>									
									<blockquote>
											<cite>
										<?php the_title() ?>
											</cite><br />
										<?php echo $user_ob['display_name'] . ", " . 
										      explode(" ", get_field('tid', $prov_ob))[0]; ?>
									</blockquote>
<?php } } ?>									
								</div>
							</div>
						</div>
						<div class="ui segment">
							<div class="content">
								<div class="header"> <h2> <i class="quote info icon"> </i> </h2> </div>
								<div class="description">
									<?php the_content(); ?>
								</div>
							</div>
						</div>
					</article>

<?php comments_template(); ?>
<?php endwhile; ?>

<?php get_footer(); ?>