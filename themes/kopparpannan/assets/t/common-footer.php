  <footer class="extra">
		<p>
	    <?php if ( ! post_password_required() && ( comments_open() || '0' != get_comments_number())
	  						&& is_single()) {
	    	comments_template();
	    } ?>
				    
	  </p>
  </footer>