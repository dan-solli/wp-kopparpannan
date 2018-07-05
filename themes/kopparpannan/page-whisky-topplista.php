<?php
/**
 * Topplista
 *
 * @package Kopparpannan
 * @since Kopparpannan 0.1
 */
?>

<?php get_header(); ?>

<?php 
	$args = array( 
		'post_type' => 'kp-whiskybetyg',
		'post_status' => 'publish',
		'posts_per_page' => -1,
		'meta_key' => 'betyg',
		'orderby' => 'meta_value_num',
		'order' => 'DESC'
	);
	$queue = new WP_Query($args);
	if ($queue->have_posts()) { ?>
<table class="ui single line table">
	<thead>
		<tr>
			<th> Whisky </th>
			<th> Betyg </th>
			<th> Prov: Tema </th>
			<th> Datum </th>
		</tr>
	</thead>
	<tbody>
<?php 
		while ($queue->have_posts()) {
			$queue->the_post();
			$whisky_ob = get_field('whisky');
			$event_ob = get_field('prov');
?>

		<tr>
			<td> 
				<a href="<?php echo get_the_permalink($whisky_ob); ?>">
					<?php echo get_the_title($whisky_ob); ?>
			</td>
			<td> <?php echo get_field('betyg'); ?> </td>
			<td> <?php echo get_the_title($event_ob) . ": " . get_field('tema', $event_ob->ID); ?> </td>
			<td> <?php echo get_field('tid', $event_ob->ID); ?>  </td>
		</tr>
	<?php } ?>
	</tbody>
</table>
<?php } ?>
<?php get_footer(); ?>