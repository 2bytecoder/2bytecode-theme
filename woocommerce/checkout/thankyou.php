<?php

/**
 * Thankyou page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/thankyou.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.7.0
 */

defined('ABSPATH') || exit;
?>

<section class="order">
    <div class="container d-flex align-items-center justify-content-center pt-2 pb-4 pt-md-4 pb-md-5">
        <div class="row">
            <div class="woocommerce-order col-12 col-xs-10 col-md-10 mx-auto">

                <?php
                if ($order) :

                    do_action('woocommerce_before_thankyou', $order->get_id());
                ?>

                    <?php if ($order->has_status('failed')) : ?>

                        <p class="woocommerce-notice woocommerce-notice--error woocommerce-thankyou-order-failed"><?php esc_html_e('Unfortunately your order cannot be processed as the originating bank/merchant has declined your transaction. Please attempt your purchase again.', 'woocommerce'); ?></p>

                        <p class="woocommerce-notice woocommerce-notice--error woocommerce-thankyou-order-failed-actions">
                            <a href="<?php echo esc_url($order->get_checkout_payment_url()); ?>" class="button pay"><?php esc_html_e('Pay', 'woocommerce'); ?></a>
                            <?php if (is_user_logged_in()) : ?>
                                <a href="<?php echo esc_url(wc_get_page_permalink('myaccount')); ?>" class="button pay"><?php esc_html_e('My account', 'woocommerce'); ?></a>
                            <?php endif; ?>
                        </p>

                    <?php else : ?>
                        <div class="order_success text-center">
                        <lottie-player src="https://assets7.lottiefiles.com/packages/lf20_s2lryxtd.json"  background="transparent"  speed="1" class="text-center d-flex justify-content-center mx-auto" style="width: 220px; height: 220px;"  autoplay></lottie-player>
                        <p class="woocommerce-notice woocommerce-notice--success woocommerce-thankyou-order-received"><?php echo apply_filters('woocommerce_thankyou_order_received_text', esc_html__('Thank you. Your order has been received.', 'woocommerce'), $order); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
                                                                                                                        ?></p>

                        <ul class="woocommerce-order-overview woocommerce-thankyou-order-details order_details d-flex align-items-center justify-content-center">

                            <li class="woocommerce-order-overview__order order">
                                <?php esc_html_e('Order number:', 'woocommerce'); ?>
                                <strong><?php echo $order->get_order_number(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
                                        ?></strong>
                            </li>

                            <li class="woocommerce-order-overview__total total">
                                <?php esc_html_e('Total:', 'woocommerce'); ?>
                                <strong><?php echo $order->get_formatted_order_total(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
                                        ?></strong>
                            </li>
                        </ul>
                        </div>

                    <?php endif; ?>

                    <?php do_action('woocommerce_thankyou_' . $order->get_payment_method(), $order->get_id()); ?>
                    <?php do_action('woocommerce_thankyou', $order->get_id()); ?>

                <?php else : ?>

                    <p class="woocommerce-notice woocommerce-notice--success woocommerce-thankyou-order-received"><?php echo apply_filters('woocommerce_thankyou_order_received_text', esc_html__('Thank you. Your order has been received.', 'woocommerce'), null); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
                                                                                                                    ?></p>

                <?php endif; ?>

            </div>
        </div>
    </div>
</section>
<script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>