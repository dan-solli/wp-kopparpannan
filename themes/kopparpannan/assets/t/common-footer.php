    <footer class="extra">
    	<p>
        <?php if ( ! post_password_required() && ( comments_open() || '0' != get_comments_number() ) ) : ?>
        <span class="comments-link"><?php comments_popup_link( __( 'Leave a comment', 'kopparpannan' ), __( '1 Comment', 'kopparpannan' ), __( '% Comments', 'kopparpannan' ) ); ?></span>
        <?php endif; ?>
        <?php edit_post_link( __( 'Edit', 'kopparpannan' ), '<span class="sep"> |   </span><span class="edit-link">', '</span>' ); ?>
      </p>
    </footer>