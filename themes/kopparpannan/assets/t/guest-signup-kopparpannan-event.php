<?php 
	if (is_single() and is_future_event() and 
		  is_user_logged_in() and current_user_can('publish_posts')) {
?>
	<div class="ui horizontal divider">
		Anmäl gäst
	</div>		
	<form action="<?php echo get_site_url(); ?>/wp-admin/admin-post.php"
				method="post" class="ui form">
		<div class="field required">
			<label>Namn</label>
			<input name="namn" placeholder="Namn" type="text">
		</div>
		<div class="field">
			<label>Telefonnummer</label>
			<input name="telefon" placeholder="Telefonnummer" type="text">
		</div>
		<div class="field">
			<label>Epostadress</label>
			<input name="epost" placeholder="Epostadress" type="text">
		</div>
		<div class="field">
			<button class="ui blue button" type="submit">Spara</button>
		</div>
    <input type="hidden" name="action" 
           value="signup_guest_for_event">
    <input type="hidden" name="user_id" value="<?php echo get_current_user_id(); ?>">
    <input type="hidden" name="event_id" value="<?php echo get_the_ID(); ?>">
    <?php wp_nonce_field('signup-guest-' . get_the_ID(), 'signup_nonce'); ?>

	</form>
<?php
	}
?>