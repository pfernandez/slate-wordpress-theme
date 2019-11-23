<?php get_header();?>

				<div class="container">
						<div class="portfolio-full archive-full">
							<div class="portfolio-blocks-wrap">
								<ul class="portfolio-blocks">
			                    	<?php
										$global_posts_query = new WP_Query(
											array(
												'posts_per_page' => 12,
												'paged' => get_query_var('paged'),
												'post_type' => 'okay-portfolio'
											)
										);
									 
										if( $global_posts_query->have_posts() ) : while( $global_posts_query->have_posts() ) : $global_posts_query->the_post();
									?>
									
					                    <li class="portfolio-block">					                    	
				                    		<div class="portfolio-block-inside">
				                    			<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" class="portfolio-small-image"><?php the_post_thumbnail( 'portfolio-image' ); ?></a>
				                    		</div>
										</li>
			
									<?php endwhile; endif; ?>
									<?php wp_reset_postdata(); ?>

									<!-- post navigation -->
									<?php if ( $global_posts_query->max_num_pages > 1 ) { ?>
										<div class="portfolio-navigation">
											<div class="alignleft">
												<?php next_posts_link( __( 'Older Entries', 'okay' ) , $global_posts_query->max_num_pages) ?>
											</div>
											<div class="alignright">
												<?php previous_posts_link(__( 'Newer Entries', 'okay' ), $global_posts_query->max_num_pages) ?>
											</div>
										</div>
									<?php } ?>
			                    </ul>
							</div><!-- portfolio blocks wrap -->
						</div><!-- content -->
				</div><!-- container -->

<?php get_footer(); ?>