<article id="post-<?php the_ID(); ?>" class="raised item">  
<?php //post_class('raised item'); ?>
<?php if ( has_post_thumbnail() ) { ?>
  <div class="ui tiny image"> <?php the_post_thumbnail(); ?></div>
<?php } ?>
  <div class="content">
    <header class="block header"> 
      <a href="<?php the_permalink(); ?>" 
         title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', '_s' ), the_title_attribute( 'echo=0' ) ) ); ?>" 
         rel="bookmark">
         <?php 
              $title = get_the_title(); 
              if (get_post_type() == "kopparpannan-event") {
                $title .= ": " . get_field('tema');
              }
              echo $title; 
          ?>
      </a> 
    </header>
    <div class="meta">
      <small>
        <span class="post-date">
          <i title="Postad den" class="clock outline icon"></i>
          <?php echo get_the_date('Y-m-d H:i'); ?>
        </span>
        <span title="Författare" class="author">
          <i class="user outline icon"></i>
          <?php the_author(); ?>
        </span>
        <span title="Kommentarer" class="comments">
          <i class="comment outline icon"></i>
          <?php echo "0"; //the_comments_number(); ?>
        </span>
      </small>
    </div>
    <div class="ui small divided horizontal list">
      <div title="Provledare" class="item">
        <i class="user circle icon"></i> 
        <div class="content"> <?php the_field('provledare'); ?> </div>
      </div>
      <div title="Antal deltagare" class="item">
        <i class="users icon"></i> 
        <div class="content"> <?php calculate_signups(get_the_ID()); ?> </div>
      </div>
    </div>
    <div class="description">
      <?php the_content(); ?> 
    </div>
    <div class="ui horizontal divider"> Summering </div>
      <?php the_field('summering'); ?>
    <div class="ui horizontal divider"> Provad dryck </div>
      <?php get_template_part('content-whisky', 'kopparpannan-event'); ?>


    <footer class="extra">
        <?php if ( ! post_password_required() && ( comments_open() || '0' != get_comments_number() ) ) : ?>
        <span class="comments-link"><?php comments_popup_link( __( 'Leave a comment', 'kopparpannan' ), __( '1 Comment', 'kopparpannan' ), __( '% Comments', 'kopparpannan' ) ); ?></span>
        <?php endif; ?>
        <?php edit_post_link( __( 'Edit', 'kopparpannan' ), '<span class="sep"> |   </span><span class="edit-link">', '</span>' ); ?>
    </footer>
  </div>
</article>

