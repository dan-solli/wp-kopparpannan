<?php
/**
 * The main event showing page
 *
 * @package Kopparpannan
 * @since Kopparpannan 0.1
 */
?>

<?php get_header(); ?>


<?php while ( have_posts() ) : the_post() ?>

<?php 
	if (is_future_event() and is_user_signed_up(get_the_ID())) { ?>
	<div class="ui success message">
		<div class="header">
			Du är anmäld till evenemanget!
		</div>
		<p> Välkommen! </p>
	</div>
<?php } ?>
<article id="post-<?php the_ID(); ?>" class="raised item"> 
<?php get_template_part('assets/t/common', 'header');
			get_template_part('assets/t/common', 'meta');
      get_template_part('assets/t/meta', 'kopparpannan-event');
      get_template_part('assets/t/description', 'kopparpannan-event');
      get_template_part('assets/t/content-whisky', 'kopparpannan-event');
      get_template_part('assets/t/common', 'attachments');
      if (get_current_user_id()) {
        get_template_part('assets/t/participants', 'kopparpannan-event');
        get_template_part('assets/t/guest-signup', 'kopparpannan-event');
      }
?> 
	<div class="ui horizontal divider"></div> 
<?php
			get_template_part('assets/t/common', 'footer');
?>
</article>
<?php endwhile; ?>

<?php get_footer(); ?>
