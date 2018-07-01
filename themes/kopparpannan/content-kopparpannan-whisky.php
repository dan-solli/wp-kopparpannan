					<div class="ui horizontal raised segments">
<?php if ( has_post_thumbnail() ) { ?>
						<div class="ui segment">
<?php 	the_post_thumbnail( 'full', array( 'class'  => 'ui centered tiny image' ) ); ?>
						</div>
<?php } ?>
						<div class="ui segment">
							<div class="content">
								<div class="header">
									<h2> <?php the_title(); ?> <i class="scotland flag"> </i> </h2>
								</div>

								<div class="description">
									<div class="ui list">
										<div class="item">
											<i class="clock outline icon"></i>
											<div class="content"> 
												<?php 
													$age = get_field('age'); 
													echo $age;
													if ($age != 'NAS') {
														echo " yo";
													}
												?> </div>
										</div>
										<div class="item">
											<i class="glass martini icon"></i>
											<div class="content"> <?php the_field('alkoholhalt'); ?>% </div>
										</div>
										<div class="item">
											<i class="map marker alternate icon"></i>
											<div class="content"> 
												<?php 
													$term = get_field('omrade'); 
													echo $term->name;
												?> </div>
										</div>
										<div class="item">
											<i class="shopping cart icon"></i>
											<div class="content"> <?php the_field('pris'); echo " / "; the_field('volym'); ?>ml 
											</div>
										</div>

										<div class="ui  horizonal divider"></div>

										<div class="item">
											<i class="trophy icon"></i>
											<div class="content"> X5,22 <small>(X2015-03-18)</small> </div>
										</div>

										<div class="ui  horizonal divider"></div>

										<div class="item">
											<i class="comment outline icon"></i>
											<div class="content"> X4 kommentarer </div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>