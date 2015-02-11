<?php
/**
 * The template for displaying pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages and that
 * other "pages" on your WordPress site will use a different template.
 *
 * @package WordPress
 * @subpackage Swiss_Design_Group
 * @since Swiss Design Group 1.0
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
		
			<div class="page-title-section">
				<div class="container">
					<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
				</div>
			</div>

			<div class="container">
				
				<?php
				// Start the loop.
				while ( have_posts() ) : the_post();

					// Include the page content template.
					get_template_part( 'content', 'page' );

				// End the loop.
				endwhile;
				?>
			</div><!-- .container -->

		</main><!-- .site-main -->
	</div><!-- .content-area -->

<?php get_footer(); ?>