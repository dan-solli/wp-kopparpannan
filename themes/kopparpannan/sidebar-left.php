			<aside class="grid-sidebar-left"> 

				<div class="ui horizontal divider">
					Kommande prov 
				</div>

				<section class="ui segments" id="upcoming-events"> 
					
<?php
					$date_now = date("U");
					$args = array (
						'post_type' 			=> 'kopparpannan-event',
						'posts_per_page' 	=> -1,
						'meta_query'			=> array( array(
							'key' 		=> 'tid',
							'value' 	=> $date_now,
							'type' 		=> 'NUM',
							'compare' => '>'))
					);

					$prov_query = new WP_Query( $args );
					if ($prov_query->have_posts()) {
						while ($prov_query->have_posts()) {
							$prov_query->the_post();
?>
					<article class="ui raised segment" id="<?php the_ID(); ?>">
						<div class="content">
							<a href="<?php the_permalink(); ?>">
								<div class="ui header"> <?php the_title(); ?>
									<div title="Tema" class="sub header"><?php the_field('tema'); ?> </div>
								</div>
							</a>
							<div class="meta"> 
								<small>
									<i title="Tidpunkt" class="calendar icon"></i> 
									<?php the_field('tid'); ?> <br />
									<i title="Provledare" class="user circle icon"></i> 
									<?php the_field('provledare'); ?> <br />
									<i title="Anmälda" class="users icon"></i> 
									<?php calculate_signups(get_the_ID()); ?> <br />
								</small>
							</div>						
						</div>
					</article>

				<?php 
						}
					} 
					wp_reset_postdata();
				?>

				</section>

				<div class="ui horizontal divider">
					Citat 
				</div>

				<section class="ui raised card" id="memorable_quotes">
					<div class="content">
						<div class="header"> Laphroaig 10 yo</div>
						<div class="meta"> <i title="Tidpunkt" class="calendar icon"></i> 2014-01-01 </div>
						<div class="center aligned description">
							<i title="Startcitat" class="quote left icon"></i>
							God som fan
							<i title="Slutcitat" class="quote right icon"> </i>
						</div>
					</div>
				</section>

			</aside>
