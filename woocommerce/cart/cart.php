<?php

/**
 * Cart Page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/cart.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.8.0
 */

defined('ABSPATH') || exit;

do_action('woocommerce_before_cart'); ?>

<section class="h-100 h-custom cart">
  <div class="container py-md-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-12 px-0 px-md-auto">

        <?php do_action('woocommerce_before_cart_table'); ?>
        <form class="woocommerce-cart-form" action="<?php echo esc_url(wc_get_cart_url()); ?>" method="post">


          <div class="card card-registration card-registration-2 shop_table shop_table_responsive cart woocommerce-cart-form__contents">
            <div class="card-body p-0">


              <div class="row g-0">
                <div class="col-lg-8">
                  <div class="p-3 pt-4 p-md-5 mb-5 mb-md-auto">
                    <div class="d-flex justify-content-between align-items-center mb-5">
                      <h1 class="fw-bold mb-0 text-dark">Shopping Cart</h1>
                      <p class="mb-0 text-muted"><?php print_r(WC()->cart->get_cart_contents_count()); ?> item(s)</p>
                    </div>
                    <!-- <hr class="my-3"> -->




                    <?php do_action('woocommerce_before_cart_contents'); ?>



                    <?php foreach (WC()->cart->get_cart() as $cart_item_key => $cart_item) {
                      $_product   = apply_filters('woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key);
                      $product_id = apply_filters('woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key);

                      if ($_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters('woocommerce_cart_item_visible', true, $cart_item, $cart_item_key)) {
                        $product_permalink = apply_filters('woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink($cart_item) : '', $cart_item, $cart_item_key);
                    ?>



                        <div class="row mb-3 d-flex justify-content-between align-items-center product woocommerce-cart-form__cart-item <?php echo esc_attr(apply_filters('woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key)); ?>">
                          <div class="col-4 col-md-2 col-lg-2 col-xl-2 product-thumbnail ps-0 ps-md-auto">
                            <?php
                            $thumbnail = apply_filters('woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key);

                            if (!$product_permalink) {
                              echo $thumbnail; // PHPCS: XSS ok.
                            } else {
                              printf('<a href="%s">%s</a>', esc_url($product_permalink), $thumbnail); // PHPCS: XSS ok.
                            }
                            ?>

                          </div>
                          <div class="col-8 col-md-5 col-lg-6 col-xl-6 pe-0 pe-md-auto">
                            <p class="text-muted small mb-1"><?php echo get_post_meta($product_id, '_course_type', true); ?></p>
                            <h6 class="text-black product-name">
                              <?php
                              if (!$product_permalink) {
                                echo wp_kses_post(apply_filters('woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key) . '&nbsp;');
                              } else {
                                echo wp_kses_post(apply_filters('woocommerce_cart_item_name', sprintf('<a href="%s">%s</a>', esc_url($product_permalink), $_product->get_name()), $cart_item, $cart_item_key));
                              }

                              do_action('woocommerce_after_cart_item_name', $cart_item, $cart_item_key);

                              // Meta data.
                              echo wc_get_formatted_cart_item_data($cart_item); // PHPCS: XSS ok.

                              // Backorder notification.
                              if ($_product->backorders_require_notification() && $_product->is_on_backorder($cart_item['quantity'])) {
                                echo wp_kses_post(apply_filters('woocommerce_cart_item_backorder_notification', '<p class="backorder_notification">' . esc_html__('Available on backorder', 'woocommerce') . '</p>', $product_id));
                              }
                              ?>
                            </h6>
                            <p class="small mb-0"><?php echo get_post_meta($product_id, '_total_lessons', true); ?> Lessons | <?php echo get_post_meta($product_id, '_total_duration', true); ?> Hours</p>
                          </div>

                          <div class="col-6 col-md-3 col-lg-2 col-xl-2 offset-lg-1">
                            <h6 class="mb-0 product-price pt-3 pt-md-0" data-title="<?php esc_attr_e('Price', 'woocommerce'); ?>">
                              <?php
                              echo apply_filters('woocommerce_cart_item_price', WC()->cart->get_product_price($_product), $cart_item, $cart_item_key); // PHPCS: XSS ok.
                              ?>
                              <br>
                              <del><?php echo get_woocommerce_currency_symbol() . $_product->get_regular_price().".00"; ?></del>
                            </h6>

                            <!-- qty -->
                            <span class="product-quantity" data-title="<?php esc_attr_e('Quantity', 'woocommerce'); ?>">
                              <?php if ($_product->is_sold_individually()) {
                                $product_quantity = sprintf('1 <input type="hidden" name="cart[%s][qty]" value="1" />', $cart_item_key);
                              }
                              // echo apply_filters('woocommerce_cart_item_quantity', $product_quantity, $cart_item_key, $cart_item);
                              ?>
                            </span>
                          </div>

                          <div class="col-6 col-md-1 col-lg-1 col-xl-1 text-end product-remove pt-3 pt-md-0">
                            <?php
                            echo apply_filters( // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
                              'woocommerce_cart_item_remove_link',
                              sprintf(
                                '<a href="%s" class="remove" aria-label="%s" data-product_id="%s" data-product_sku="%s">&times;</a>',
                                esc_url(wc_get_cart_remove_url($cart_item_key)),
                                esc_html__('Remove this item', 'woocommerce'),
                                esc_attr($product_id),
                                esc_attr($_product->get_sku())
                              ),
                              $cart_item_key
                            );
                            ?>
                          </div>
                        </div>
                        <!-- <hr class="my-3"> -->

                    <?php }
                    } ?>

                    <!-- <button type="submit" class="button" name="update_cart" value="<?php esc_attr_e('Update cart', 'woocommerce'); ?>"><?php esc_html_e('Update cart', 'woocommerce'); ?></button> -->
                    <?php do_action( 'woocommerce_cart_contents' ); ?>
                    <?php do_action('woocommerce_cart_actions'); ?>

                    <?php wp_nonce_field('woocommerce-cart', 'woocommerce-cart-nonce'); ?>



                    <?php do_action('woocommerce_after_cart_contents'); ?>
                    <?php do_action('woocommerce_after_cart_table'); ?>


        </form>
      </div>
    </div>








    <?php do_action( 'woocommerce_before_cart_collaterals' ); ?>
    
    <div class="col-lg-4 bg-grey">
      <div class="p-4 p-md-5 mb-5 mb-md-auto">
        <h3 class="fw-bold mb-5 mt-2 pt-1">Summary</h3>
        <hr class="my-4">

        <div class="d-flex flex-column justify-content-between mb-4">

          <div class="d-flex justify-content-between mb-2">
            <h5 class="text-uppercase">Sub total</h5>
            <h5><?php echo wc_price(WC()->cart->subtotal_ex_tax); ?></h5>
          </div>

          <?php if(WC()->cart->get_total_tax()): ?>
          <div class="d-flex justify-content-between mb-2">
            <h5 class="text-uppercase">GST 18%</h5>
            <h5><?php echo wc_price(WC()->cart->get_total_tax()); ?></h5>
          </div>
          <?php endif; ?>

          <?php if (WC()->cart->discount_cart) { ?>
            <div class="d-flex justify-content-between mb-4">
              <h5 class="text-uppercase">Coupon discount</h5>
              <h5>- <?php echo wc_price(WC()->cart->discount_cart); ?></h5>
            </div>
          <?php } ?>

        </div>



        <h6 class="text-uppercase mb-2">Promo code</h6>

        <?php if (wc_coupons_enabled()) { ?>
          <div class="coupon">
            <div class="mb-5">
              <?php
              
              if (count(WC()->cart->get_applied_coupons()) == 0) { ?>
                <div class="form-outline">
                  <input type="text" id="coupon_code" name="coupon_code" class="form-control" value="" placeholder="Enter Promo code" />
                  <button type="submit" class="button apply_coupon" name="apply_coupon" value="<?php esc_attr_e('Apply coupon', 'woocommerce'); ?>"><?php esc_attr_e('Apply coupon', 'woocommerce'); ?></button>
                  <?php do_action('woocommerce_cart_coupon'); ?>
                </div>
              <?php } else { ?>
                <span class="cat-links">
                <a href="/cart/?remove_coupon=<?php echo WC()->cart->get_applied_coupons()[0]; ?>" title="Remove Coupon" class="woocommerce-remove-coupon" data-coupon="<?php echo WC()->cart->get_applied_coupons()[0]; ?>">
                    <?php echo strtoupper(WC()->cart->get_applied_coupons()[0]); ?>
                    &nbsp; <i class="bi bi-x-lg"></i>
                  </a>
                </span>
              <?php
              } ?>
            </div>
          </div>
        <?php } ?>


        <hr class="my-3">

        <div class="d-flex justify-content-between mb-3">
          <h5 class="text-uppercase">Total price</h5>
          <h5><?php echo wc_price(WC()->cart->total); ?></h5>
        </div>

        <a type="button" href="/checkout/" class="btn btn-primary btn-block btn-lg px-5 mb-2 checkout">Checkout &nbsp; <i class="bi bi-arrow-right"></i></a>

      </div>
    </div>
  </div>
  </div>
  </div>

  <!-- <div class="py-3">
    <h6 class="mb-0"><a href="/courses/" class="text-body small text-decoration-none"><i class="bi bi-arrow-left me-2"></i>Back to shop</a></h6>
  </div> -->

  </div>
  </div>
  </div>
</section>




<?php do_action('woocommerce_after_cart'); ?>