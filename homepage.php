<?php 
/* 
Template Name: Homepage
*/ 
?>

<?php get_header(); ?>
			
			<div id="sections" class="clearfix">
				
				<div class="page-title page-title-portfolio">
					<?php if ( get_option( 'okay_theme_customizer_main_title' ) ) { ?>
						<h2><?php echo get_option( 'okay_theme_customizer_main_title', '' ) ;?></h2>
					<?php } ?>
					
					<?php if ( get_option( 'okay_theme_customizer_sub_title' ) ) { ?>
						<h3><?php echo get_option( 'okay_theme_customizer_sub_title', '' ) ;?></h3>
					<?php } ?>
				</div>
				
				<?php if ( get_option( 'okay_theme_customizer_enable_slider' ) == 'enabled' ) { ?>
					<?php 
						$hasposts = get_posts( 'post_type=okay-slider' );
					    if( $hasposts ) { 
					?>
						<!-- Intro Message -->
						<div class="section section-slider">
							<!-- Slides -->
							<div class="flexslider">
								<ul class="slides">
									<?php
										$slider_list_args = array(
				                			'posts_per_page' => 9,
				                			'post_type' => 'okay-slider'
										);
										$slider_list_posts = new WP_Query($slider_list_args);
									?>
									<?php while( $slider_list_posts->have_posts() ) : $slider_list_posts->the_post() ?>
										<li>
											<?php if ( get_post_meta( $post->ID, '_cmb_slide_link', true ) ) { ?>
												<?php
													global $post;
													$slidelink = get_post_meta( $post->ID, '_cmb_slide_link', true );
												?>
												<a href="<?php echo $slidelink; ?>"><?php the_post_thumbnail( 'large-image' ); ?></a>
												<?php } else { ?>									
												<?php the_post_thumbnail( 'large-image' ); ?>
											<?php } ?>
										</li>
									<?php endwhile; ?>
									<?php wp_reset_postdata(); ?>
								</ul>
							</div>			
						</div><!-- slider section -->
					<?php } ?>
				<?php } ?>
				
				<?php if ( get_option( 'okay_theme_customizer_enable_services' ) == 'enabled' ) { ?>
					<!-- Services -->
					<div class="section section-services">
						<div class="section-title">
							<span>
								<?php if ( get_option( 'okay_theme_customizer_services_title' ) ) { ?>
									<?php echo get_option( 'okay_theme_customizer_services_title' ); ?>
								<?php } ?>
							</span>
						</div>
	
						<div class="services-wrap" id="equalize">
							<?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('Services Text Columns') ) : else : ?>		
							<?php endif; ?>
						</div>
					</div><!-- services section -->
				<?php } ?>
				
				
				<?php if ( get_option( 'okay_theme_customizer_enable_portfolio' ) == 'enabled' ) { ?>
					<!-- Portfolio -->
					<div class="section section-portfolio">					
						<div class="section-title">
							<span>
								<?php if ( get_option( 'okay_theme_customizer_portfolio_title_home' ) ) { ?>
									<?php echo get_option( 'okay_theme_customizer_portfolio_title_home' ); ?>
								<?php } ?>
							</span>
						</div>
						
						<div class="portfolio-blocks-wrap">
							<ul class="portfolio-blocks">
		                    	<?php
									$home_portfolio_list_args = array(
			                			'posts_per_page' => 12,
			                			'post_type' => 'okay-portfolio'
									);
									$home_portfolio_list_args = new WP_Query($home_portfolio_list_args);
								?>
								<?php while( $home_portfolio_list_args->have_posts() ) : $home_portfolio_list_args->the_post() ?>
				                    <li class="portfolio-block">					                    	
			                    		<div class="portfolio-block-inside">
			                    			<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" class="portfolio-small-image"><?php the_post_thumbnail( 'portfolio-image' ); ?></a>
			                    		</div>
									</li>
								<?php endwhile; ?>
								<?php wp_reset_postdata(); ?>
		                    </ul>
						</div><!-- portfolio blocks wrap -->
					</div><!-- section -->
				<?php } ?>
				
				
				<?php if ( get_option( 'okay_theme_customizer_enable_blog' ) == 'enabled' ) { ?>
					<!-- Blog -->
					<div class="section section-blog">
						<div class="section-title">
							<span>
								<?php if ( get_option( 'okay_theme_customizer_blog_title' ) ) { ?>
									<?php echo get_option( 'okay_theme_customizer_blog_title' ); ?>
								<?php } ?>
							</span>
						</div>
	
						<div class="home-blog clearfix">
							  <ul>
							  	<?php
									$home_blog_list_args = array(
			                			'posts_per_page' => 3
									);
									$home_blog_list_args = new WP_Query($home_blog_list_args);
								?>
								<?php while( $home_blog_list_args->have_posts() ) : $home_blog_list_args->the_post() ?>	
							  		<li class="home-blog-post">
							  			<div class="blog-thumb">
							  				<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
							  					<?php the_post_thumbnail( 'blog-thumb' ); ?>
							  				</a>
							  			</div>
							  			
							  			<div class="blog-title">
							  				<div class="big-comment">
							  					<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
							  				</div>
							  				
							  				<p class="home-blog-post-meta"><?php echo get_the_date(); ?></p>
							  			</div>
							  			
							  			<div class="excerpt">
							  				<?php the_excerpt(); ?>
							  			</div>
							  			
							  			<div class="blog-read-more">
							  				<a href="<?php the_permalink(); ?>"><?php _e('Read More','okay'); ?></a>
							  			</div>
							  		</li>
							  	<?php endwhile; ?>
								<?php wp_reset_postdata(); ?>
							  </ul>
						</div><!-- home blog -->
					</div><!-- blog section -->
				<?php } ?>
				
				
				<?php if ( get_option( 'okay_theme_customizer_enable_testimonials' ) == 'enabled' ) { ?>
					<!-- Testimonials -->
					<div class="section section-testimonials">
						<div class="section-title">
							<span>
								<?php if ( get_option( 'okay_theme_customizer_testimonial_title' ) ) { ?>
									<?php echo get_option( 'okay_theme_customizer_testimonial_title' ); ?>
								<?php } ?>
							</span>
						</div>
							
						<div id="testimonial-slider" class="flexslider">
							<ul class="testimonials slides">
								<?php if ( function_exists('dynamic_sidebar') && dynamic_sidebar('Testimonials') ) : else : ?>		
								<?php endif; ?>
							</ul>
						</div>
					</div><!-- testimonial section -->
				<?php } ?>
			</div><!-- sections -->	
			
<?php get_footer(); ?>