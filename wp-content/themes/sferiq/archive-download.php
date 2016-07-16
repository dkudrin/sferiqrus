<?php
/**
 * The template for displaying Archive pages.
 */
get_header(); ?>

<div class="clear"></div>

</header> <!-- / END HOME SECTION  -->

<div id="content" class="site-content">

<div class="container">

<div class="content-left-wrap col-md-12">

	<div id="primary" class="content-area">

		<main id="main" class="site-main" role="main">

		<?php if ( have_posts() ) : ?>

			<header class="page-header">

				<h1 class="page-title">

					<?php

						if ( is_category() ) :

							single_cat_title();

						elseif ( is_tag() ) :

							single_tag_title();

						elseif ( is_author() ) :

							printf( __( 'Author: %s', 'sferiq' ), '<span class="vcard">' . get_the_author() . '</span>' );

						elseif ( is_day() ) :

							printf( __( 'Day: %s', 'sferiq' ), '<span>' . get_the_date() . '</span>' );

						elseif ( is_month() ) :

							printf( __( 'Month: %s', 'sferiq' ), '<span>' . get_the_date( _x( 'F Y', 'monthly archives date format', 'sferiq' ) ) . '</span>' );

						elseif ( is_year() ) :

							printf( __( 'Year: %s', 'sferiq' ), '<span>' . get_the_date( _x( 'Y', 'yearly archives date format', 'sferiq' ) ) . '</span>' );

						elseif ( is_tax( 'post_format', 'post-format-aside' ) ) :

							_e( 'Asides', 'sferiq' );

						elseif ( is_tax( 'post_format', 'post-format-gallery' ) ) :

							_e( 'Galleries', 'sferiq');

						elseif ( is_tax( 'post_format', 'post-format-image' ) ) :

							_e( 'Images', 'sferiq');

						elseif ( is_tax( 'post_format', 'post-format-video' ) ) :

							_e( 'Videos', 'sferiq' );

						elseif ( is_tax( 'post_format', 'post-format-quote' ) ) :

							_e( 'Quotes', 'sferiq' );

						elseif ( is_tax( 'post_format', 'post-format-link' ) ) :

							_e( 'Links', 'sferiq' );

						elseif ( is_tax( 'post_format', 'post-format-status' ) ) :

							_e( 'Statuses', 'sferiq' );

						elseif ( is_tax( 'post_format', 'post-format-audio' ) ) :

							_e( 'Audios', 'sferiq' );

						elseif ( is_tax( 'post_format', 'post-format-chat' ) ) :

							_e( 'Chats', 'sferiq' );

						else :

							_e( 'Archives', 'sferiq' );

						endif;

					?>

				</h1>

				<?php

					// Show an optional term description.

					$term_description = term_description();

					if ( ! empty( $term_description ) ) :

						printf( '<div class="taxonomy-description">%s</div>', $term_description );

					endif;

				?>

			</header><!-- .page-header -->

			<?php while ( have_posts() ) : the_post();

					/* Include the Post-Format-specific template for the content.

					 * If you want to override this in a child theme, then include a file

					 * called content-___.php (where ___ is the Post Format name) and that will be used instead.

					 */

					get_template_part( 'content', 'archive-download' );

				endwhile;  
				
				zerif_paging_nav(); 
				
			else:
			
				get_template_part( 'content', 'none' );
				
			endif; ?>

		</main><!-- #main -->

	</div><!-- #primary -->

</div><!-- .content-left-wrap -->

</div><!-- .container -->

<?php get_footer(); ?>