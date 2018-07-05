   <div class="description">
      <?php the_content(); ?> 
    </div>
<?php if (has_summary()) { ?> 
    <div class="ui horizontal divider"> 
    	Summering 
    </div>
    <?php the_field('summering'); ?>
<?php } ?>

