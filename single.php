<?php

/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package TwoByteCode
 */

get_header();
?>

<main id="primary" class="site-main">
	<div class="article-page bg-custom <?php if(is_user_logged_in()) echo "user-logged-in"; ?>">
		<div class="container-fluid m-0 d-flex p-0 flex-lg-row flex-column justify-content-center flex-wrap w-100">

			<div class="article-side-bar pt-4 pb-2 px-3 scrollarea d-none">

				<!-- most recent -->
				<div class="article-side-bar-part d-flex flex-column flex-lg-row flex-wrap justify-content-start align-items-start">
					<h2 class="mt-1 mb-3">Most Recent</h2>
					<?php

					$args = array(
						'posts_per_page' => '3',
						"orderby"        => "date",
						"order"          => "DESC"
					);
					$recent_posts = new WP_Query($args);
					if ($recent_posts->have_posts()) {
						while ($recent_posts->have_posts()) {

							$recent_posts->the_post();

							if (has_post_thumbnail()) : ?>


								<div class="card bg-transparent mb-4 shadow border-0 img-container">
									<a href="<?php echo get_permalink(); ?>"> <img class="card-img-top" alt="Thumbnail [100%x225]" src="<?php echo get_the_post_thumbnail_url(); ?>">
										<div class="overlay2"></div>
										<p class="carousel-caption"><?php echo wp_trim_words(get_the_title(), 12, "...") ?></p>

										<div class="overlay">
											<span>View Article <i class="bi bi-arrow-up-right-square"></i></span>
										</div>
									</a>
								</div>
						<?php endif;
						}
						wp_reset_postdata(); ?>
					<?php } else {
						echo "<p>No Post Found :(</p>";
					} ?>

				</div>


				<!-- most popular -->

				<div class="article-side-bar-part d-flex flex-column flex-lg-row flex-wrap justify-content-start align-items-start">
					<h2 class="mt-1 mb-3">Most Popular</h2>
					<?php

					$args = array(
						'posts_per_page' => '2',
						'orderby' => 'meta_value_num',
						'meta_key' => 'post_views_count'
					);
					$recent_posts = new WP_Query($args);
					if ($recent_posts->have_posts()) {
						while ($recent_posts->have_posts()) {

							$recent_posts->the_post();

							if (has_post_thumbnail()) : ?>


								<div class="card bg-transparent mb-4 shadow border-0 img-container">
									<a href="<?php echo get_permalink(); ?>"> <img class="card-img-top" alt="Thumbnail [100%x225]" src="<?php echo get_the_post_thumbnail_url(); ?>">
										<div class="overlay2"></div>
										<p class="carousel-caption"><?php echo wp_trim_words(get_the_title(), 12, "...") ?></p>

										<div class="overlay">
											<span>View Article <i class="bi bi-arrow-up-right-square"></i></span>
										</div>
									</a>
								</div>
						<?php endif;
						}
						wp_reset_postdata(); ?>
					<?php } else {
						echo "<p>No Post Found :(</p>";
					} ?>
				</div>
			</div>
			
			<div class="article-wrap">
				<?php
				while (have_posts()) :
					the_post();

					get_template_part('template-parts/content', get_post_type());

					the_post_navigation(
						array(
							'prev_text' => '<span class="nav-subtitle"><i class="bi bi-chevron-left align-middle"></i> ' . esc_html__('Previous', 'twobytecode') . '</span> <span class="nav-title">%title</span>',
							'next_text' => '<span class="nav-subtitle">' . esc_html__('Next', 'twobytecode') . ' <i class="bi bi-chevron-right align-middle"></i></span><span class="nav-title">%title</span>',
						)
					);

					// If comments are open or we have at least one comment, load up the comment template.
					if (comments_open() || get_comments_number()) :
						comments_template();
					endif;
				endwhile; // End of the loop.
				?>
			</div>

			<div class="rightbar scrollarea d-none">
				<?php get_sidebar(); ?>
			</div>
		</div>
	</div><!-- article page -->
</main><!-- #main -->
<?php get_footer(); ?>