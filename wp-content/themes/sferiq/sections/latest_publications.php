<?php 

	global $wp_customize;

	$zerif_total_posts = get_option('posts_per_page'); /* number of latest posts to show */
	
	if( !empty($zerif_total_posts) && ($zerif_total_posts > 0) ):
	
		echo '<section class="latest-publications" id="latestpublications">';
		
			echo '<div class="container">';

				/* SECTION HEADER */
				
				echo '<div class="section-header">';

					$zerif_latestpublications_title = get_theme_mod('zerif_latestpublications_title');

					/* title */
					if( !empty($zerif_latestpublications_title) ):
					
						echo '<h2 class="dark-text">' . wp_kses_post( $zerif_latestpublications_title ) . '</h2>';
						
					else:
					
						echo '<h2 class="dark-text">' . __('Latest publications','sferiq') . '</h2>';
						
					endif;

					/* subtitle */
					$zerif_latestpublications_subtitle = get_theme_mod('zerif_latestpublications_subtitle');

					if( !empty($zerif_latestpublications_subtitle) ):

						echo '<div class="dark-text section-legend">'.wp_kses_post( $zerif_latestpublications_subtitle ).'</div>';

					elseif ( isset( $wp_customize ) ):
					
						echo '<div class="dark-text section-legend zerif_hidden_if_not_customizer"></div>';
						
					endif;
				
				echo '</div><!-- END .section-header -->';

				echo '<div class="clear"></div>';
				
				echo '<div id="carousel-homepage-latestpublications" class="carousel slide" data-ride="carousel">';
					
					/* Wrapper for slides */
					
					echo '<div class="carousel-inner" role="listbox">';
						
						
						$zerif_latest_loop = new WP_Query( array( 'post_type' => 'post','category_name' => 'publications', 'posts_per_page' => $zerif_total_posts, 'order' => 'DESC','ignore_sticky_posts' => true ) );
						
						$publicationslideActive = '<div class="item active">';
						$publicationslide 		= '<div class="item">';
						$publicationslideClose 	= '<div class="clear"></div></div>';
						$i_latest_posts= 0;
						
						if ( $zerif_latest_loop->have_posts() ) :
						
							while ( $zerif_latest_loop->have_posts() ) : $zerif_latest_loop->the_post();
								
								$i_latest_posts++;

								if ( !wp_is_mobile() ){

										if($i_latest_posts == 1){
											echo $publicationslideActive;
										}
										else if($i_latest_posts % 4 == 1){
											echo $publicationslide;
										}
									
										echo '<div class="col-sm-3 latestpublications-box">';

											echo '<div class="latestpublications-img">';
											
												echo '<a class="latestpublications-img-a" href="'.esc_url( get_permalink() ).'" title="'.esc_attr( get_the_title() ).'">';

													if ( has_post_thumbnail() ) :
														the_post_thumbnail();
													else:
														echo '<img src="'.esc_url( get_template_directory_uri() ).'/images/blank-latestposts.png" alt="'.esc_attr( get_the_title() ).'" />';
													endif; 

												echo '</a>';
												
											echo '</div>';

											echo '<div class="latespublications-content">';

												echo '<h3 class="latestpublications-title"><a href="'.esc_url( get_permalink() ).'" title="'.esc_attr( get_the_title() ).'">'.wp_kses_post( get_the_title() ).'</a></h3>';

												$ismore = @strpos( $post->post_content, '<!--more-->');
												
												if($ismore) {
													the_content( sprintf( esc_html__('[...]','sferiq'), '<span class="screen-reader-text">'.esc_html__('about ', 'sferiq').get_the_title().'</span>' ) );
												} else {
													the_excerpt();
												}

											echo '</div>';

										echo '</div><!-- .latestpublications-box"> -->';

										/* after every four posts it must closing the '.item' */
										if($i_latest_posts % 4 == 0){
											echo $publicationslideClose;
										}

								} else {

									if( $i_latest_posts == 1 ) $active = 'active'; else $active = ''; 
			
									echo '<div class="item '.$active.'">';
										echo '<div class="col-md-3 latestpublications-box">';
											echo '<div class="latestpublications-img">';
												echo '<a class="latestpublications-img-a" href="'.get_permalink().'" title="'.get_the_title().'">';
													if ( has_post_thumbnail() ) :
														the_post_thumbnail();
													else:
														echo '<img src="'.esc_url( get_template_directory_uri() ).'/images/blank-latestposts.png" alt="'.esc_attr( get_the_title() ).'" />';
													endif; 
												echo '</a>';
											echo '</div>';
											echo '<div class="latespublications-content">';
												echo '<h3 class="latestpublications-title"><a href="'.esc_url( get_permalink() ).'" title="'.esc_attr( get_the_title() ).'">'.wp_kses_post( get_the_title() ).'</a></h3>';
												
												$ismore = @strpos( $post->post_content, '<!--more-->');
												
												if($ismore) {
													the_content( sprintf( esc_html__('[...]','sferiq'), '<span class="screen-reader-text">'.esc_html__('about ', 'sferiq').get_the_title().'</span>' ) );
												} else {
													the_excerpt();
												}
											echo '</div>';
										echo '</div>';
									echo '</div>';
								}
							
							endwhile;
						
						endif;	

						if ( !wp_is_mobile() ) {

							// if there are less than 10 posts
							if($i_latest_posts % 4!=0){
								echo $publicationslideClose;
							}

						}

						wp_reset_postdata(); 
						
					echo '</div><!-- .carousel-inner -->';

					/* Controls */
					echo '<a class="left carousel-control" href="#carousel-homepage-latestpublications" role="button" data-slide="prev">';
						echo '<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>';
						echo '<span class="sr-only">'.__('Previous','sferiq').'</span>';
					echo '</a>';
					echo '<a class="right carousel-control" href="#carousel-homepage-latestpublications" role="button" data-slide="next">';
						echo '<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>';
						echo '<span class="sr-only">'.__('Next','sferiq').'</span>';
					echo '</a>';
				echo '</div><!-- #carousel-homepage-latestpublications -->';

			echo '</div><!-- .container -->';
		echo '</section>';

endif; ?>
