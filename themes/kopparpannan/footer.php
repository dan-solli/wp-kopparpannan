		  </main>
	 
		  <?php get_sidebar('right'); ?>

			<footer class="grid-footer" role="contentinfo">
				<section class="site-info">
				  <?php /** * Fires before the Twenty Fifteen footer text for footer customization. * * @since Twenty Fifteen 1.0 */ do_action( 'kopparpannan_credits' ); ?>
				            <a href="<?php echo esc_url( __( 'https://wordpress.org/', 'kopparpannan' ) ); ?>"><?php printf( __( 'Proudly powered by %s', 'twentyfifteen' ), 'WordPress' ); ?></a>
				</section>
			<!-- .site-info -->

			</footer>
			<!-- .site-footer -->

		</div>
		<!-- .grid-container -->
		 
		<?php wp_footer(); ?>
		 
	</body>
</html>