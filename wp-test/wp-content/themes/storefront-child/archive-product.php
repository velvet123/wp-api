<?php
defined('ABSPATH') || exit;
get_header('shop');
do_action('woocommerce_before_main_content');


do_action( 'woocommerce_before_shop_loop' );
if (woocommerce_product_loop()) {

    while ( have_posts() ) {
        the_post();

        /**
         * Hook: woocommerce_shop_loop.
         */
        do_action( 'woocommerce_shop_loop' );

        wc_get_template_part( 'content', 'product' );
    }
    do_action('woocommerce_before_shop_loop');
    // here we’ve deleted the loop

    echo '<h1>MOST POPULAR !!</h1>';
do_shortcode('[products orderby="popularity" class="m-popular" columns="2" limit="2"]');    
    do_action('woocommerce_after_shop_loop');
} else {
    do_action('woocommerce_no_products_found');
}


do_action('woocommerce_after_main_content');
do_action('woocommerce_sidebar');
get_footer('shop');
?>