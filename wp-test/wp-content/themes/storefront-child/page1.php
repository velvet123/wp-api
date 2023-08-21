<?php /* Template Name: WocommerecFiled */ ?>
<?php get_header(); ?>
<div id="primary" class="content-area">
    <main id="main" class="site-main" role="main">
        <?php
        // Get all products
        $args = array(
            'post_type' => 'product',
            'posts_per_page' => -1,
        );
        $products = new WP_Query($args);
        // Start the loop.
        while ($products->have_posts()) : $products->the_post();
            // Include the page content template.
            get_template_part('template-parts/content', 'page');
            // If comments are open or we have at least one comment, load up the comment template.
            if (comments_open() || get_comments_number()) {
                comments_template();
            }
            // Retrieve meta values
            $product_id = get_the_ID();
            $meta_key1 = 'woocommerce_custom_field1'; // Replace 'your_meta_key1' with the first meta key
            $meta_value1 = get_post_meta($product_id, $meta_key1, true);
            $meta_key2 = 'woocommerce_custom_field2'; // Replace 'your_meta_key2' with the second meta key
            $meta_value2 = get_post_meta($product_id, $meta_key2, true);
            $meta_key3 = 'woocommerce_custom_field3'; // Replace 'your_meta_key3' with the third meta key
            $meta_value3 = get_post_meta($product_id, $meta_key3, true);
            if ($meta_value1) {
                // First meta value found
                echo 'Meta Value 1 for product ' . $product_id . ': ' . $meta_value1 . '<br>';
            } else {
                // First meta value not found
                echo 'No meta value 1 found for product ' . $product_id . '<br>';
            }
            if ($meta_value2) {
                // Second meta value found
                echo 'Meta Value 2 for product ' . $product_id . ': ' . $meta_value2 . '<br>';
            } else {
                // Second meta value not found
                echo 'No meta value 2 found for product ' . $product_id . '<br>';
            }
            if ($meta_value3) {
                // Third meta value found
                echo 'Meta Value 3 for product ' . $product_id . ': ' . $meta_value3 . '<br>';
            } else {
                // Third meta value not found
                echo 'No meta value 3 found for product ' . $product_id . '<br>';
            }
            // Display the product image and "Add to Cart" button
            $product = wc_get_product($product_id);
            if ($product) {
                echo $product->get_image('medium');
                echo '<a href="' . esc_url($product->add_to_cart_url()) . '" class="button add_to_cart_button">' . esc_html($product->add_to_cart_text()) . '</a>';
            }
        endwhile;
        wp_reset_postdata();
        ?>
    </main><!-- .site-main --



    <?php get_sidebar('content-bottom'); ?>
</div><!-- .content-area -->
<?php get_sidebar(); ?>
<?php get_footer(); ?>



 if ($product) {
    echo '<a href="' . esc_url($product->add_to_cart_url()) . '" class="button add_to_cart_button">' . esc_html($product->add_to_cart_text()) . '</a>';
 }














            if ($product) {

                echo $product->get_image('medium');
               <?php echo '<a href="' . esc_url($product->add_to_cart_url()) . '"?> class="button add_to_cart_button">' .<?php esc_html($product->add_to_cart_text()) . ?>'</a>';
            }



            <?php

            if ($product) {

                echo '<a href="' . esc_url($product->add_to_cart_url()) . '" class="button add_to_cart_button">' . esc_html($product->add_to_cart_text()) . '</a>';
            }

             ?>

            <?php
               
            endwhile;
         wp_reset_postdata();
        
            ?>





   <?php 
                $product = wc_get_product($product_id);
                if ($product) {

             ?>
                <img src="<?php echo $product->get_image('medium'); ?>" alt="">
                <?php
            }
            ?>

   











   Live API-key: live_aqDwEtSwDAEJbxVhT2Uyqq2U9qJyjW
Test API-key: test_usfyqwhAt58eu8CbvHBmVCQ84esF8w
Profile ID: pfl_z3P7xCTGvr













   let bodycls = document.body.classList.toString();
    let myImg = document.getElementsByClassName("site-logo-image")[0];
    if (bodycls.includes("home")) {
        myImg.src = "https://ecstaticdancehoorn.nl/wp-content/uploads/2020/06/logoedh-e1617192479876.jpg";
    }



 echo $product->get_image('medium');



 echo '<a href="' . get_permalink($product->get_id()) . '">' . $product->get_image('medium') . '</a>';



 let bodycls = document.body.classList.toString();
    let myImg = document.getElementsByClassName("site-logo-image")[0];
    if (bodycls.includes("home")) {
       /* myImg.src = ""; */
myImg.style.display = "none";
    }





















This is the idea I sent yesterday (and I did write something else in another phrase). I can imagine it comes across as confusing. Sorry about that.

I was thinking the following order on the homepage:

- Header image 

- Agenda: 2 dates with link to agenda-page/ticketshop. Info also shown on homepage: title, date, location, starting time, price.

- Section with info about the Ecstatic Dance in general (just like the former site) -> use On the world section?

- A section with the Ecstatic Dance rules (just like the former site) - use place//design Latest albums?

- About (Over) section with info about history, organisation, teammembers (teammembers will be shown with name, function and a black/white image (No separate Team-page for the new site) and text Volunteers wanted.
-> Can we use the design of The Artist for this with added text?

- FAQ: the same content as the former site

- Contact & adres: the same content as the former site








FTP host: 185.182.57.72
FTP user: meubepb325
FTP wachtwoord: a6z7aqjb
DirectAdmin gebruikersnaam: meubepb325
DirectAdmin wachtwoord: a6z7aqjb
DirectAdmin login link:
https://vserver325.axc.eu
Server: 325
username:
info@mooiegordijnenopmaat.nl
pass:-  Jucquw-9fokdy-nognyx





Skillions
Rupali Portfolio 
Judgement
ecstaticdancehoorn
mooiegordijnenopmaat
ClS
Parallels
bubble API
Irene
lupen


meubepb325_mooiegordijnenop