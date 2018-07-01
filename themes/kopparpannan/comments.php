<?php
/**
* The template for displaying Comments.
*
* The area of the page that contains both current comments
* and the comment form. The actual display of comments is
* handled by a callback to expound_comment() which is
* located in the inc/template-tags.php file.
*
* @package Kopparpannan
*/

/*
* If the current post is protected by a password and
* the visitor has not yet entered the password we will
* return early without loading the comments.
*/
if ( post_password_required() )
return;
?>

<div id="comments" class="comments-area">

<?php // You can start editing here — including this comment! ?>

<?php if ( 1 or  have_comments() ) : ?>
<h2 class="comments-title">

<?php
printf( _nx( 'One thought on "%2$s"', '%1$s thoughts on "%2$s"', get_comments_number(), 'comments title', 'expound' ),
number_format_i18n( get_comments_number() ), '<span>' . get_the_title() . '</span>' );
?>
</h2>

<?php comment_form(); ?>

<?php if ( get_comment_pages_count() > 0 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
<nav id="comment-nav-above" class="navigation-comment" role="navigation">
<h1 class="screen-reader-text"><?php _e( 'Comment navigation', 'expound' ); ?></h1>
<div class="nav-previous"><?php previous_comments_link( __( '← Older Comments', 'expound' ) ); ?></div>
<div class="nav-next"><?php next_comments_link( __( 'Newer Comments →', 'expound' ) ); ?></div>
</nav>
<?php endif; // check for comment navigation ?>

    <?php
    /* Loop through and list the comments. Tell wp_list_comments()
    * to use expound_comment() to format the comments.
    * If you want to overload this in a child theme then you can
    * define expound_comment() and that will be used instead.
    * See expound_comment() in inc/template-tags.php for more.
    */
    wp_list_comments( /* array( 'callback' => 'expound_comment' ) */ );
    ?> 



<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
<nav id="comment-nav-below" class="navigation-comment" role="navigation">
<h1 class="screen-reader-text"><?php _e( 'Comment navigation', 'expound' ); ?></h1>
<div class="nav-previous"><?php previous_comments_link( __( '← Older Comments', 'expound' ) ); ?></div>
<div class="nav-next"><?php next_comments_link( __( 'Newer Comments →', 'expound' ) ); ?></div>
</nav>
<?php endif; // check for comment navigation ?>

<?php endif; // have_comments() ?>

<?php
// If comments are closed and there are comments, let's leave a little note, shall we?
if ( ! comments_open() && '0' != get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
?>
<p class="no-comments"><?php _e( 'Comments are closed.', 'expound' ); ?></p>
<?php endif; ?>

</div>

<!--
						<div class="ui segment">
							<div class="content">
								<div class="header"> <h2> <i class="comment outline icon"> </i> </h2> </div>
								<div class="description">
									<div class="ui comments">
										<div class="comment">
											<a class="avatar">
												<img src="noimage.png">
											</a>
											<div class="content">
												<a class="author">xMedlem_01</a>
												<div class="metadata">
													<span class="date"> x2016-01-01 </span>
												</div>
												<div class="text">
													xProin euismod viverra nisl, nec lobortis dui fermentum sed. Proin tempus sagittis lobortis. Proin diam libero, efficitur id nulla a, sodales congue nunc. 
												</div>
												<div class="actions">
													<a class="reply">Svara</a>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
-->