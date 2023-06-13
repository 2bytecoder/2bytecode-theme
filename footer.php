<?php

/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package TwoByteCode
 */

?>

<footer class="footer border-top border-dark border-3">
	<div class="container-fluid p-0 m-0 d-flex flex-column align-items-center justify-content-between">
		<?php
		if (!is_user_logged_in()) { ?>
			<div class="susbcribe py-1">
				<form action="<?php echo admin_url('admin-ajax.php'); ?>" id="newsletter-form">
					<div class="input-group">
						<input type="email" name="newsletter_email" class="form-control" placeholder="Your E-mail" required>
						<?php wp_nonce_field('add_newsletter8434_action'); ?>
						<span class="input-group-btn">
							<button class="btn btn-secondary px-4 py-3 newsletter-submit" type="submit">
								Susbcribe
							</button>
						</span>
					</div>
				</form>
			</div>

		<?php } ?>
		<div class="footer-top py-0 pb-lg-2">
			<div class="ft-part ft-part-1 order-4 order-lg-0">
				<h1>2<span class="color-2">B</span>C</h1>
				<p>&copy; Copyright 2022</p>
				<p>All rights reserved</p>
			</div>

			<div class="ft-part ft-part-2 order-0 order-lg-1">
				<p>Quick Links</p>
				<p><a href="<?php echo get_permalink(get_page_by_path('courses', '', 'page')->ID) ?>">Courses</a></p>
				<p><a href="<?php echo get_permalink(get_page_by_path('articles', '', 'page')->ID) ?>">Blog</a></p>
				<p><a href="<?php echo get_permalink(get_page_by_path('about-us', '', 'page')->ID) ?>">About Us</a></p>
			</div>

			<div class="ft-part ft-part-3 order-1 order-lg-2">
				<p>Services</p>
				<p><a href="<?php echo get_permalink(get_page_by_path('hire-us', '', 'page')->ID)."#ourApps" ?>">Our Apps</a></p>
				<p><a href="<?php echo get_permalink(get_page_by_path('hire-us', '', 'page')->ID) ?>">Hire Us</a></p>
			</div>

			<div class="ft-part ft-part-4 order-2 order-lg-3">
				<p>Legal</p>
				<p><a href="<?php echo get_permalink(get_page_by_path('privacy-and-policy', '', 'page')->ID) ?>">Privacy Policy</a></p>
				<p><a href="<?php echo get_permalink(get_page_by_path('terms-and-conditions', '', 'page')->ID) ?>">Terms and Conditions</a></p>
				<p><a href="<?php echo get_permalink(get_page_by_path('disclaimer', '', 'page')->ID) ?>">Disclaimer</a></p>
			</div>

			<div class="ft-part ft-part-5 order-3 order-lg-4">
				<p>Contact Us</p>
				<p><a href="mailto:support@2bytecode.com">support@2bytecode.com</a></p>
				<p>Find Us</p>
				<p>
					<span class="rounded-circle"><a href="https://www.facebook.com/2ByteCode-108581148373923"> <img src="<?php echo get_template_directory_uri() . '/images/facebook.svg'; ?>" alt="FACEBOOK LINK OF 2BYTECODE ACCOUNT"></a></span>
					<span class="rounded-circle"><a href="http://instagram.com/flutter2bc"> <img src="<?php echo get_template_directory_uri() . '/images/instagram.svg'; ?>" alt="INSTAGRAM LINK OF 2BYTECODE ACCOUNT"></a></span>
					<span class="rounded-circle"><a href="https://t.me/flutter_comm_2BC"><img src="<?php echo get_template_directory_uri() . '/images/telegram.svg'; ?>" alt="TELEGRAM LINK OF 2BYTECODE GROUP"></a></span>
					<span class="rounded-circle"><a href="https://www.youtube.com/channel/UCmgENiNqlTNoT1F1d07yqJQ"><img src="<?php echo get_template_directory_uri() . '/images/youtube.svg'; ?>" alt="YOUTUBE CHANNEL LINK OF 2BYTECODE GROUP"></a></span>
					<span class="rounded-circle"><a href="https://discord.gg/X4Cj8gpPRX"><img src="<?php echo get_template_directory_uri() . '/images/discord.svg'; ?>" alt="DISCORD LINK OF 2BYTECODE GROUP"></a></span>
				</p>
			</div>
		</div>

		<!-- <div class="footer-bottom">
		<p class="not-default">&copy; Copyright 2021<br /> All rights reserved</p>
	</div> -->

	</div>
</footer><!-- #footer -->
</div><!-- #page -->

<!-- Modal -->
<div class="modal fade" id="mainModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
		<div class="modal-content">
			<div class="modal-header border-0">
				<h5 class="modal-title" id="modalLabel"></h5>
				<!-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> -->
			</div>
			<div class="modal-body">

			</div>
			<div class="modal-footer border-0 d-flex align-items-center justify-content-center">
				<button type="button" class="btn btn-secondary px-5" data-bs-dismiss="modal">Close</button>
				<!-- <button type="button" class="btn btn-primary">Understood</button> -->
			</div>
		</div>
	</div>
</div>





<?php wp_footer(); ?>
</body>
</html>