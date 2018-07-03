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

<article id="post-<?php the_ID(); ?>" class="raised item"> 
<?php get_template_part('assets/t/common', 'header');
			get_template_part('assets/t/common', 'meta');
      get_template_part('assets/t/meta', 'kopparpannan-event');
      get_template_part('assets/t/description', 'kopparpannan-event');
      get_template_part('assets/t/content-whisky', 'kopparpannan-event');
      get_template_part('assets/t/common', 'attachments');
			get_template_part('assets/t/common', 'footer');
?>
</article>
<?php endwhile; ?>

<?php get_footer(); ?>