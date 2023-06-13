<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package TwoByteCode
 */

get_header();
?>


	<main id="primary" class="site-main">
	<div class="search-page bg-custom pb-5">

		<?php if ( have_posts() ) : ?>


			<div class="container-fluid m-0 d-flex flex-lg-row p-0 flex-column flex-wrap w-100">
			<div class="search-content-wrap">
			<header class="page-header text-start mt-2 mt-lg-3">
				<h1 class="page-title">
					<?php
					/* translators: %s: search query. */
					printf( esc_html__( 'Search Results for: %s', 'twobytecode' ), '<span>' . get_search_query() . '</span>' );
					?>
				</h1>
			</header><!-- .page-header -->
			<div class="search-content-wrap-inner">

			<?php
			/* Start the Loop */
			while ( have_posts() ) :
				the_post();

				/**
				 * Run the loop for the search to output the results.
				 * If you want to overload this in a child theme then include a file
				 * called content-search.php and that will be used instead.
				 */
				get_template_part( 'template-parts/content', 'search' );

			endwhile;

			the_posts_navigation();

		else : ?> 
			<div class="container-fluid m-0 d-flex flex-lg-row p-0 flex-column flex-wrap w-100">
			<div class="search-content-wrap">
			<header class="page-header mt-2 mt-lg-3">
				<h1 class="page-title"><?php esc_html_e( 'Nothing Found', 'twobytecode' ); ?></h1>
			</header><!-- .page-header -->
			<div class="search-content-wrap-inner">
			
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
get_footer();
