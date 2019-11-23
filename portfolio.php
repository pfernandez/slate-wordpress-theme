<?php 
/* 
Template Name: Portfolio
*/ 
?>

<?php get_header();?>

				<div class="container">
						<div class="portfolio-full">
							<div class="portfolio-big-slide">
								<?php
									$global_posts_query = new WP_Query(
										array(
											'posts_per_page' => 1,
											'post_type' => 'okay-portfolio'
										)
									);
								 
									if ( $global_posts_query->have_posts() ) : while( $global_posts_query->have_posts() ) : $global_posts_query->the_post();
								?>
									<!--Large Portfolio Item-->
									<div class="portfolio-block-large clearfix">
										<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" class="portfolio-large-image"><?php the_post_thumbnail( 'large-image' ); ?></a>
									</div>
								<?php endwhile; endif; ?>
								<?php wp_reset_postdata(); ?>
							</div>
							
							<div class="portfolio-big-title">
								<?php if ( get_option( 'okay_theme_customizer_portfolio_page_title' ) ) { ?>
									<h2><?php echo get_option( 'okay_theme_customizer_portfolio_page_title' ); ?></h2>
								<?php } ?>
								
								<?php if ( get_option( 'okay_theme_customizer_portfolio_page_sub_title' ) ) { ?>
									<h3><?php echo get_option( 'okay_theme_customizer_portfolio_page_sub_title' ); ?></h3>
								<?php } ?>
							</div>
							
							<div class="portfolio-blocks-wrap">
								<ul class="portfolio-blocks">
			                    	<?php
										$global_posts_query = new WP_Query(
											array(
												'posts_per_page' => 13,
												'paged' => get_query_var('paged'),
												'post_type' => 'okay-portfolio'
											)
										);
									 
										if ( $global_posts_query->have_posts() ) : while( $global_posts_query->have_posts() ) : $global_posts_query->the_post();
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