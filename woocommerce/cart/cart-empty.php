<?php

/**
 * Empty cart page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/cart-empty.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.5.0
 */

defined('ABSPATH') || exit;

/*
 * @hooked wc_empty_cart_message - 10
 */
do_action( 'woocommerce_cart_is_empty' );

?>

<style>
	#cart_empty.open{
		width: 100%;
		height: 100%;
		max-width: 25rem; 
		max-height: 25rem; 
		top: -1.5rem;
	}
</style>

<section class="h-100 cart">
	<div class="container h-100">
		<div class="row d-flex justify-content-center align-items-center h-100">
			<div class="col-12 col-sm-8 col-md-6 px-0 px-md-auto mx-auto d-flex flex-column aligin-items-center justify-content-center">

				<div id="cart_empty" class="mx-auto position-relative" style="min-width:280px;min-height:280px;">
				</div>

				<h3 class="text-center font-monospace position-relative" style="top: -6.5rem">NULL in the cart</h3>
				<?php if (wc_get_page_id('shop') > 0) : ?>
					<p class="return-to-shop text-center font-monospace position-relative" style="top: -5.8rem">
						<a class="button wc-backward" href="<?php echo esc_url(apply_filters('woocommerce_return_to_shop_redirect', wc_get_page_permalink('shop'))); ?>">
							<?php
							/**
							 * Filter "Return To Shop" text.
							 *
							 * @since 4.6.0
							 * @param string $default_text Default text.
							 */
							echo esc_html(apply_filters('woocommerce_return_to_shop_text', __('Return to shop', 'woocommerce')));
							?>
						</a>
					</p>
				<?php endif; ?>

			</div>
		</div>
	</div>
</section>


<?php

