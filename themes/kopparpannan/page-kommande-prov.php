
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
		'meta_query'			=> array( array(
			'key' 		=> 'tid',
			'value' 	=> $date_now,
			'type' 		=> 'NUM',
			'compare' => '>'))
	);


	$prov_query = new WP_Query( $args );
	if ($prov_query->have_posts()) {
		while ($prov_query->have_posts()) {
			$prov_query->the_post();
			get_template_part('content-medium', 'kopparpannan-event');
		}
	}
  get_footer();	
?>

