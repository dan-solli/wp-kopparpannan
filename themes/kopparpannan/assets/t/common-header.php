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