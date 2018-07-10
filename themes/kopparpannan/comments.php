<?php if ( have_comments() ) : ?>
			<div class="ui segment">
	    	<h3 class="ui dividing header"> 
	    		<i class="comment outline icon"> </i> 
	    		<?php comments_number('Ingen Kommentar', 'En Kommentar', '% Kommentarer' );?>
	    	</h3>
							<div class="content">
								<div class="description">
									<div class="ui comments">
<?php wp_list_comments("type=comment&callback=format_comment&end-callback=format_comment_end");?>
									</div>
								</div>
							</div>
<?php endif; ?>

							<div class="ui horizontal divider"> Kommentera mera </div>
<?php

if (get_current_user_id() )
$fields =  array(
    'author' =>
        '<input name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) .'" size="30" placeholder="Ditt namn"/>',
    'email' =>
        '<input name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) .'" size="30" placeholder="Din epost"/>',
);
$args = array(
    'id_form'           => 'commentform',
    'class_form'        => 'comment-form',
    'id_submit'         => 'submit',
    'class_submit'      => 'submit',
    'name_submit'       => 'submit',
    'title_reply'       => '',
    'title_reply_to'    => 'Svara',
    'cancel_reply_link' => '[Avbryt]',
    'label_submit'      => 'Kommentera',
    'format'            => 'xhtml',
    'comment_field'     =>  '<textarea id="comment" name="comment" placeholder="Kommentar" cols="70" rows="4" aria-required="true">' .'</textarea>',
    'logged_in_as'      => '',
    'fields'            => apply_filters( 'comment_form_default_fields', $fields ),
    'submit_button'     => '<input name="%1$s" id="%2$s" value="%4$s" type="submit" class="ui blue form button">'
);

	comment_form( $args );
?>
	</div>
