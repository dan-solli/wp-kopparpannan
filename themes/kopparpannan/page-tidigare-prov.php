
<?php
/**
 * Kommande prov
 *
 * @package Kopparpannan
 * @since Kopparpannan 0.1
 */
?>

<?php 
	get_header();

	$date_now = date("U");
	$args = array (
		'post_type' 			=> 'kopparpannan-event',
		'posts_per_page' 	=> -1,
		'order' => 'DESC',
		'meta_key' => 'tid',
		'meta_type' => 'DATETIME',
		'orderby' => 'meta_value_datetime',
		'meta_query'			=> array( array(
			'key' 		=> 'tid',
			'value' 	=> $date_now,
			'type' 		=> 'NUM',
			'compare' => '<'))
	);


	$prov_query = new WP_Query( $args );
	if ($prov_query->have_posts()) {
		while ($prov_query->have_posts()) {
			$prov_query->the_post();
?>			
			<article id="post-<?php the_ID(); ?>" class="raised item">  
			<?php get_template_part('assets/t/common', 'header');
			      get_template_part('assets/t/common', 'meta'); 
						get_template_part('assets/t/meta', 'kopparpannan-event');

			?> 
			    <div class="description">
			      <?php the_content(); ?> 
			    </div>
			    <div class="extra">
			      <?php get_template_part('assets/t/common', 'attachments'); ?>
			    </div>

			    <?php get_template_part('assets/t/common', 'footer'); ?>
			  </div>
			</article>

<?php } 
		} ?>

<?php get_footer(); ?>
