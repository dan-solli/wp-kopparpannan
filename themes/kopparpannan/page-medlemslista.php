<?php
/**
 * Medlemmar
 *
 * @package Kopparpannan
 * @since Kopparpannan 0.1
 */
?>

<?php get_header(); ?>

<?php
$users = get_users('orderby=nicename&role=editor');
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