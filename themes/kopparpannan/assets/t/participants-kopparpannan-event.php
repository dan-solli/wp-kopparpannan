<?php  
	$arr = calculate_signup_count(get_the_ID());

	if ($arr['members'] > 0) { 
    $args = array(
      'post_type' => 'medlemsanmalning',
      'post_status' => 'publish', 
      'meta_query' => array(
        array(
            'key' => 'event',
            'value' => get_the_ID()
        ),
      ),
    );
    $anm_query = new WP_Query($args);
    if ($anm_query->have_posts()) {
?>    	
		<div class="ui horizontal divider"> 
	  	Anmälda medlemmar 
	  </div>
		<table class="ui single line compact table">
			<thead>
				<tr>
					<th> Namn </th>
					<th> Anmälningstidpunkt </th>
				</tr>
			</thead>
			<tbody>
<?php 
    	while ($anm_query->have_posts()) {
    		$anm_query->the_post(); 
    		$user = get_field('user');

?>
				<tr>
					<td> <?php echo $user['display_name']; ?> </td>
					<td> <?php echo get_the_date('Y-m-d H:i'); ?> </td>
				</tr>
<?php     		
    	}
    }
    wp_reset_postdata(); 
?>
			</tbody>
		</table>
<?php } 
	if ($arr['guests'] > 0) { 
    $args = array(
      'post_type' => 'gastanmalning',
      'post_status' => 'publish', 
      'meta_query' => array(
        array(
            'key' => 'event',
            'value' => get_the_ID()
        ),
      ),
    );
    $gue_query = new WP_Query($args);
    if ($gue_query->have_posts()) {
?>    	
		<div class="ui horizontal divider"> 
	  	Anmälda gäster 
	  </div>
		<table class="ui single line compact table">
			<thead>
				<tr>
					<th> Namn </th>
					<th> Anmäld av </th>
					<th> Telefon </th>
					<th> Epost </th>
					<th> Anmälningstidpunkt </th>
					<th> </th>
				</tr>
			</thead>
			<tbody>
<?php 
    	while ($gue_query->have_posts()) {
    		$gue_query->the_post(); 
?>
				<tr>
					<td> 
						<?php the_field('inbjuden') ?> </td>
					<td> <?php 
									$user = get_field('inbjuden_av'); 
									echo $user['display_name'];
								?> </td>
					<td> <?php the_field('telefon') ?> </td>
					<td> <?php the_field('epost') ?> </td>
					<td> <?php echo get_the_date('Y-m-d H:i'); ?> </td>
					<td>
<?php if (get_field('inbjuden_av')['ID'] == get_current_user_id()) { ?>
						<form action="<?php echo get_site_url(); ?>/wp-admin/admin-post.php"
									method="post" class="ui form">
							<input type="hidden" name="id" value="<?php echo get_the_ID(); ?>">
							<input type="hidden" name="action" value="remove_guest_for_event">
    					<?php wp_nonce_field('remove-guest-' . get_the_ID(), 'remove_signup_nonce'); ?>

							<button title="Ta bort inbjuden gäst"
											class="red circular ui compact icon button" type="submit">
								<i class="times circle outline icon"></i>
							</button>
						</form>
<?php } ?>
					</td>						
				</tr>
<?php     		
    	}
    }
    wp_reset_postdata(); 
?>
			</tbody>
		</table>
<?php } ?>