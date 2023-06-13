<?php

/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package TwoByteCode
 */

get_header();
?>




<!-- main -->
<div class="half-circle"></div>
<main id="primary" class="site-main home-page-hero">
	<div class="container pt-3 pt-md-5">
		<div class="row p-3 pb-0 pe-lg-0 pt-lg-5 align-items-center">
			<div class="col-lg-5 p-3 pt-2 p-lg-5 pt-lg-3">
				<div class="d-inline-flex">
				<h1 class="d-inline fw-bolder lh-1 text-dark">App</h1>
				<img src="<?php echo get_template_directory_uri() . '/images/flutter-bw.svg'?>"  class="d-inline ms-3 mini-img" alt="">
				</div>
				
				<h1 class="fw-bolder lh-2 text-dark"><span class="color-1">Development</span><br>Made Super<span class="color-2">
						Easy.</span></h1>
				
					<p>Flutter is the fastest growing cross-platform app development framework by Google. Hit Get Started and start your journey of becoming a Flutter developer...</p>
				<div class="d-grid gap-3 d-md-flex justify-content-md-start mb-4 mb-lg-3">
					<a role="button" href="<?php echo get_permalink(get_page_by_path('courses', '', 'page')->ID) ?>" class="btn btn-primary fw-bold px-5">Get
						Started &lt;/&gt;</a>
					<!-- <a role="button" href="<?php echo get_permalink(get_page_by_path('articles', '', 'page')->ID) ?>" class="btn btn-outline-secondary btn-lg px-4 py-3">Blog</a> -->
				</div>
			</div>
			<div class="col-lg-6 mt-4 mt-lg-0 offset-lg-1 p-0 overflow-hidden text-center">
				<img class="rounded-lg-3 m-auto hero-img" src="<?php echo get_template_directory_uri() . '/images/undraw_programming_re_kg9v.svg'; ?>" alt="">
			</div>
		</div>
	</div>
</main>
<!-- #main -->


<!-- features -->
<section class="features pt-md-5">
	<div class="container">
		<div class="d-flex flex-row mx-auto flex-wrap justify-content-center align-items-center text-center">
			<div class="card bg-transparent border-0 flex-fill">
				<img class="mx-auto my-2" src="<?php echo get_template_directory_uri() . '/images/medal.png'; ?>" data-light-src="<?php echo get_template_directory_uri() . '/images/medal.png'; ?>" data-dark-src="<?php echo get_template_directory_uri() . '/images/medal-dark.svg'; ?>" alt="Generic placeholder image" width="80" height="80">
				<h4 class="h4">First and Best</h4>
				<p class="text-dark">The only website that is completely dedicated to flutter app <br/> Development. </p>
			</div>

			<div class="card bg-transparent border-0 flex-fill">
				<img class="mx-auto my-2" src="<?php echo get_template_directory_uri() . '/images/sitemap.png'; ?>" data-light-src="<?php echo get_template_directory_uri() . '/images/sitemap.png'; ?>" data-dark-src="<?php echo get_template_directory_uri() . '/images/structure-dark.svg'; ?>" alt="Generic placeholder image" width="80" height="80">
				<h4 class="h4">Structured Courses</h4>
				<p class="text-dark">All the courses from dart to flutter, are well structured and designed specially for everyone.</p>
			</div>

			<div class="card bg-transparent border-0 flex-fill">
				<img class="mx-auto my-2" src="<?php echo get_template_directory_uri() . '/images/night-mode.png'; ?>" data-light-src="<?php echo get_template_directory_uri() . '/images/night-mode.png'; ?>" data-dark-src="<?php echo get_template_directory_uri() . '/images/moon-dark.svg'; ?>" alt="Generic placeholder image" width="80" height="80">
				<h4 class="h4">Night Mode</h4>
				<p class="text-dark">Night Mode is available to help you read better and increase your <br/> productivity.</p>
			</div>

			<div class="card bg-transparent border-0 flex-fill">
				<img class="mx-auto my-2" src="<?php echo get_template_directory_uri() . '/images/easy.png'; ?>" data-light-src="<?php echo get_template_directory_uri() . '/images/easy.png'; ?>" data-dark-src="<?php echo get_template_directory_uri() . '/images/easy-dark.svg'; ?>" alt="Generic placeholder image" width="80" height="80">
				<h4 class="h4">Simple And Easy</h4>
				<p class="text-dark">Very simple and easy language to understand. Better than official documentation.</p>
			</div>
		</div>
	</div>
</section>
<!--#features -->


<!-- service -->
<section class="service">

	<div class="service-item">
		<div class="container">
			<div class="row m-auto">
				<div class="col-md-6 order-1 order-md-2 text-center">
					<img class="featurette-image m-auto" src="<?php echo get_template_directory_uri() . '/images/Frame-1.svg'; ?>" data-light-src="<?php echo get_template_directory_uri() . '/images/Frame-1.svg'; ?>" data-dark-src="<?php echo get_template_directory_uri() . '/images/youdark-dark.svg'; ?>" alt="">
				</div>
				<div class="col-md-6 order-2 order-md-1 mt-5 mt-md-0">
					<h2 class="fw-bolder color-2 fs-1">Know Your<br>
						<!-- font-size: 40px !important; -->
						<span class="text-dark">Flutter</span> <span class="color-1">Level</span>
					</h2>
					<p class="lead">Do you want to know your flutter knowledge level?
Go to our specially designed system and label yourself as a Beginner, intermidiate or expert flutter app developer.</p>
					<p><a class="btn btn-primary fw-bold px-5" href="/quiz/" role="button">Take Quiz</a></p>
				</div>
			</div>
		</div>
	</div>

	<div class="service-item">
		<div class="container">
			<div class="row m-auto">
				<div class="col-md-6 order-1 order-md-1 text-center">
					<img class="featurette-image m-auto" src="<?php echo get_template_directory_uri() . '/images/undraw_flutter_dev_wvqj-1.png'; ?>" data-light-src="<?php echo get_template_directory_uri() . '/images/undraw_flutter_dev_wvqj-1.png'; ?>" data-dark-src="<?php echo get_template_directory_uri() . '/images/undraw_flutter_dev_wvqj-1-dark.svg'; ?>" alt="">
				</div>
				<div class="col-md-6 mx-auto order-2 order-md-2 mt-5 mt-md-0">
					<h2 class="featurette-heading fw-bolder fs-1 text-dark">Learn to <span class="color-1">Flutter</span></h2>
					<p class="lead">Learn flutter app development with a defined roadmap.This will guide you through your flutter app journey and help you become an expert. Begin your app development journey with flutter <a href="#" class="text-decoration-none">Read More...</a> </p>
					<p><a class="btn btn-primary disabled fw-bold px-5" href="#" role="button">Coming Soon</a></p>
				</div>
			</div>
		</div>
	</div>

	<div class="service-item">
		<div class="container">
			<div class="row m-auto">
				<div class="col-md-6 mx-auto order-2 order-md-1 mt-5 mt-md-0">
					<h2 class="featurette-heading fw-bolder fs-1 text-dark"><span class="color-1">Learn</span><br /> Dart Language</h2>
					<p class="lead">When it comes to app development, hands down, dart is one of the most powerful language. It is very essential to master this language and its concept. We have a well-desgined dart courses for everyone. Check it <a href="#" class="text-decoration-none">out ...</a> </p>
					<p><a class="btn btn-primary fw-bold px-5" href="/dart/" role="button">Start Now</a></p>
				</div>
				<div class="col-md-6 order-md-2 order-1 text-center">
					<img class="featurette-image m-auto" src="<?php echo get_template_directory_uri() . '/images/undraw_researching_-22-gp.svg'; ?>" alt="">
				</div>
			</div>
		</div>
	</div>

	<div class="service-item">
		<div class="container">
			<div class="row m-auto">
				<div class="col-md-6 order-md-1 order-1 text-center">
					<img class="featurette-image m-auto" src="<?php echo get_template_directory_uri() . '/images/undraw_online_reading_np7n.svg'; ?>" alt="">
				</div>
				<div class="col-md-6 order-md-2 order-2 mt-5 mt-md-0">
					<h2 class="featurette-heading fw-bolder fs-1 text-dark"><span class="color-1">Our</span> Blogs</h2>
					<p class="lead">We often face error and sometimes we do not know that how to implement this particular feature in our app. So, for this problem we have articles for the people who want to master a particular concept about flutter app development and dart langauge... </p>
					<p><a class="btn btn-primary fw-bold px-5" href="<?php echo get_permalink(get_page_by_path('articles', '', 'page')->ID) ?>" role="button">Read Blogs</a></p>
				</div>
			</div>
		</div>
	</div>


</section>
<!-- #service -->



<!-- recent articles -->
<?php
$args = array(
				'posts_per_page' => '3',
				"orderby"        => "date",
				"order"          => "DESC"
			);
	$recent_posts = new WP_Query($args);
	if($recent_posts->have_posts()):

?>

<section class="articles py-4">
	<div class="container-fluid">

		<div class="container">
			<h2 class="p-md-5 m-md-4 py-md-3 h2 color-1">People are <span class="text-light">Reading --</span></h2>
		</div>

		<div class="d-flex flex-row mx-auto flex-wrap justify-content-center align-items-center">
			<?php

			// $args = array(
			// 	'posts_per_page' => '3',
			// 	"orderby"        => "date",
			// 	"order"          => "DESC"
			// );
			while ($recent_posts->have_posts()) {

				$recent_posts->the_post();

				if (has_post_thumbnail()) : ?>


					<div class="card bg-transparent mb-4 shadow border-0 img-container">
						<a href="<?php echo get_permalink(); ?>"> <img class="card-img-top" alt="Thumbnail [100%x225]" src="<?php echo get_the_post_thumbnail_url(); ?>">
							<div class="overlay2"></div>
							<p class="carousel-caption"><?php echo wp_trim_words(get_the_title(), 15, "..."); ?></p>

							<div class="overlay">
								<span>View Article <i class="bi bi-arrow-up-right-square"></i></span>
							</div>
						</a>
					</div>
			<?php endif;
			}
			wp_reset_postdata(); ?>

		</div>
	</div>
</section>
<?php endif; ?>


<?php

get_footer();
