<?php
/**
 * The main template file.
 *
 * Blah blah
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
?> 

<?php if ( get_post_type() == "kopparpannan-event") { 
        get_template_part('assets/t/meta', 'kopparpannan-event');
      }
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

<?php endwhile; ?>
<?php get_template_part('assets/t/common', 'pagination'); ?>
<?php get_footer(); ?>