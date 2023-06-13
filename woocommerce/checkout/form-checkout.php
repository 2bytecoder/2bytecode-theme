<?php

/**
 * Checkout Form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-checkout.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.5.0
 */

if (!defined('ABSPATH')) {
	exit;
}

// do_action( 'woocommerce_before_checkout_form', $checkout );

// If checkout registration is disabled and not logged in, the user cannot checkout.
// if ( ! $checkout->is_registration_enabled() && $checkout->is_registration_required() && ! is_user_logged_in() ) {
// 	echo esc_html( apply_filters( 'woocommerce_checkout_must_be_logged_in_message', __( 'You must be logged in to checkout.', 'woocommerce' ) ) );
// 	return;
// }

?>

<section class="checkout d-flex align-items-center justify-content-center">
	<div class="container py-5 mb-3">
		<div class="d-flex flex-column align-items-center justify-content-center">

			<?php 
			if(!is_user_logged_in()){
			?>
			<div class="auth_required my-3 border border-warning border-2 rounded-2 p-4 px-3 px-sm-5 mb-5">
				<p class="lh-lg font-monospace">Already Have a account <a href="/dashboard/?redirect_to=<?php echo wc_get_checkout_url(); ?>">Login</a> <br/> Or, <a href="/signup/?redirect_to=<?php echo wc_get_checkout_url(); ?>">Sign up</a> to continue ...</p>
			</div>
			<?php } ?>


			<form name="checkout" method="post" class="checkout woocommerce-checkout" action="<?php echo esc_url(wc_get_checkout_url()); ?>" enctype="multipart/form-data">
				<div class="row gx-md-3 gx-lg-5">
					<div class="col-12 col-md-7">

						<?php if ($checkout->get_checkout_fields()) : ?>

							<?php do_action('woocommerce_checkout_before_customer_details'); ?>

							<div id="customer_details">
								<div class="w-100">
									<?php do_action('woocommerce_checkout_billing'); ?>
								</div>

								<!-- <div class="col-2">
									<?php // do_action('woocommerce_checkout_shipping'); ?>
								</div> -->
							</div>

							<?php do_action('woocommerce_checkout_after_customer_details'); ?>

						<?php endif; ?>

						<div class="payment-method mt-4">
							<?php do_action('woocommerce_checkout_payment_hook'); ?>
						</div>
					</div>



					<div class="col-12 col-md-5">

						<?php do_action('woocommerce_checkout_before_order_review_heading'); ?>

						<h3 id="order_review_heading" class="mt-5 mt-md-0 mb-3"><?php esc_html_e('Your order', 'woocommerce'); ?></h3>

						<?php do_action('woocommerce_checkout_before_order_review'); ?>

						<div id="order_review" class="woocommerce-checkout-review-order">
							<?php do_action('woocommerce_checkout_order_review'); ?>
						</div>

						<?php do_action('woocommerce_checkout_after_order_review'); ?>


						<div class="form-row place-order">
							<noscript>
								<?php
								/* translators: $1 and $2 opening and closing emphasis tags respectively */
								printf(esc_html__('Since your browser does not support JavaScript, or it is disabled, please ensure you click the %1$sUpdate Totals%2$s button before placing your order. You may be charged more than the amount stated above if you fail to do so.', 'woocommerce'), '<em>', '</em>');
								?>
								<br /><button type="submit" class="button alt" name="woocommerce_checkout_update_totals" value="<?php esc_attr_e('Update totals', 'woocommerce'); ?>"><?php esc_html_e('Update totals', 'woocommerce'); ?></button>
							</noscript>

							<?php wc_get_template('checkout/terms.php'); ?>

							<?php do_action('woocommerce_review_order_before_submit'); ?>

							<?php 
							if(is_user_logged_in()){
							echo '<button type="submit" class="btn btn-primary px-5 py-3 checkout" name="woocommerce_checkout_place_order" id="place_order" value="Place order" data-value="Place order">Place order</button>';
							}else{
								echo '<button type="submit" class="btn btn-primary px-5 py-3 checkout disabled" name="woocommerce_checkout_place_order" value="Login/Sign up required">Login/Sign up required</button>';
							}
							?>

							<?php do_action('woocommerce_review_order_after_submit'); ?>

							<?php wp_nonce_field('woocommerce-process_checkout', 'woocommerce-process-checkout-nonce'); ?>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
</section>

<?php do_action('woocommerce_after_checkout_form', $checkout); ?>