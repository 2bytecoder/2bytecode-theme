<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package TwoByteCode
 */

get_header();
?>


	<main id="primary" class="site-main">
	<div class="archive-page bg-custom pb-5">
		
			

		<?php if ( have_posts() ) : ?>


			<div class="container-fluid m-0 d-flex flex-lg-row flex-column p-0 flex-wrap w-100">
			<div class="archive-content-wrap">
			<header class="page-header text-start mt-2 mt-lg-3">
				<?php
				the_archive_title( '<h1 class="page-title px-3">', '</h1>' );
				the_archive_description( '<div class="archive-description">', '</div>' );
				?>
			</header><!-- .page-header -->
			<div class="archive-content-wrap-inner">
			<?php
			/* Start the Loop */
			while ( have_posts() ) :
				the_post();

				/*
				 * Include the Post-Type-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Type name) and that will be used instead.
				 */
				get_template_part( 'template-parts/content-excerpt', get_post_type() );

			endwhile;

			the_posts_navigation();

		else : ?>
			<div class="container-fluid m-0 d-flex flex-lg-row p-0 flex-column flex-wrap w-100">
			<div class="archive-content-wrap">
			<header class="page-header mt-2 mt-lg-3">
				<h1 class="page-title"><?php esc_html_e( 'Nothing Found', 'twobytecode' ); ?></h1>
			</header><!-- .page-header -->
			<div class="archive-content-wrap-inner">

		<?php 

			get_template_part( 'template-parts/content', 'none' );

		endif;
		?>

		</div>
		</div>
		
		<div class="rightbar scrollarea mt-4">
				<?php
				get_sidebar();
				?>
		</div>

		</div>
		</div>
	</main><!-- #main -->


<?php
get_sidebar();
get_footer();
