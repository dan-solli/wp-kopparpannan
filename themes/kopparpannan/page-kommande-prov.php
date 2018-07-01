
<?php
/**
 * Medlemmar
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
?>

<table class="ui single line table">
	<thead>
		<tr>
			<th> Namn </th>
			<th> Epostadress </th>
			<th> Telefonnummer </th>
		</tr>
	</thead>
	<tbody>
<?php foreach ($users as $user) { ?>
		<tr>
			<td> <?php echo $user->display_name; ?> </td>
			<td> <?php echo $user->user_email; ?> </td>
			<td> Inte importerat </td>
		</tr>
<?php } ?>
	</tbody>
</table>

<?php get_footer(); ?>