    <div class="ui small divided horizontal list">
      <div title="Provledare" class="item">
        <i class="user circle icon"></i> 
        <div class="content"> <?php the_field('provledare'); ?> </div>
      </div>
      <div title="Antal deltagare" class="item">
        <i class="users icon"></i> 
        <div class="content"> <?php calculate_signups(get_the_ID()); ?> </div>
      </div>
<?php if (($num = images_in_gallery(get_the_ID())) > 0) { ?>
      <div title="Bildgalleri" class="item">
        <div class="ui green circular label">
          <i class="image icon"></i> <?php echo $num; ?> 
        </div>
      </div>
<?php } ?>
    </div>    