    <div class="ui small divided horizontal list">
      <div title="Tidpunkt" class="item">
        <i title="Tidpunkt" class="calendar icon"></i> 
        <div class="content"> <?php the_field('tid'); ?> </div>
      </div>
      <div title="Provledare" class="item">
        <i class="user circle icon"></i> 
        <div class="content"> <?php the_field('provledare'); ?> </div>
      </div>
      <div title="Antal deltagare" class="item">
        <i class="users icon"></i> 
        <div class="content"> 
          <?php calculate_signups(get_the_ID()); ?> 
        </div>
      </div>
<?php 
    if (($num = images_in_gallery(get_the_ID())) > 0) { ?>
      <div title="Bildgalleri" class="item">
        <div class="ui green circular label">
          <i class="image icon"></i> <?php echo $num; ?> 
        </div>
      </div>
<?php } ?>
    </div>    
<?php
  if (is_single() and is_future_event() and get_current_user_id()) {
    $sup = is_user_signed_up(get_the_ID()); ?>
    <div title="Anmälningsknapp" class="right floated content">
      <form action="<?php echo get_site_url(); ?>/wp-admin/admin-post.php" method="post" class="ui form">
        <input type="hidden" name="action" 
               value="<?php echo ($sup ? "un" : ""); ?>signup_for_event">
        <input type="hidden" name="user_id" value="<?php echo get_current_user_id(); ?>">
        <input type="hidden" name="event_id" value="<?php echo get_the_ID(); ?>">
        <?php wp_nonce_field('signup-event-' . get_the_ID(), 'signup_nonce'); ?>
        <button class="<?php echo ($sup ? "red" : "green"); ?> ui button" type="submit">
          <?php echo ($sup ? "Ava" : "A"); ?>nmäl
        </button>
      </form>
    </div>
<?php } ?>