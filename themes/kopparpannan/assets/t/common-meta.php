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
          <?php echo get_comments_number(); ?>
        </span>
      </small>
    </div>