<?php
/**
 * Medlemmar
 Template Name: Medlemskö
 *
 * @package Kopparpannan
 * @since Kopparpannan 0.1
 */
?>

<?php get_header(); ?>

	<table class="ui single line table">
	<thead>
		<tr>
			<th> Namn </th>
			<th> Telefon </th>
			<th> Epost </th>
			<th> Datum </th>
			<th> Nominator </th>
		</tr>
	</thead>
	<tbody>

<?php
	$args = array( 
		'post_type' => 'kp-medlemskandidat',
		'posts_per_page' => -1,
		'meta_key' => 'nomineringsdatum',
		'orderby' => 'meta_value',
		'order' => 'ASC'
	);
	$queue = new WP_Query($args);
	if ($queue->have_posts()) {
		while ($queue->have_posts()) {
			$queue->the_post();
			$nom_ob = get_field('nominator');
?>
		<tr>
			<td> <?php the_title(); ?> </td>
			<td> <?php the_field('telefonnummer'); ?> </td>
			<td> <?php the_field('epostadress'); ?> </td>
			<td> <?php 
							$datestr = get_field('nomineringsdatum');
							preg_match('/^(\d{4})(\d\d)(\d\d)$/', $datestr, $matches); 
							array_shift($matches);
							$datestr = implode('-', $matches);
							echo $datestr;
						?> 
			</td>
			<td> <?php echo $nom_ob['display_name']; ?> </td>
		</tr>

<?php }
	} 
	wp_reset_postdata()
?>
	</tbody>
</table>

<?php get_footer(); ?>