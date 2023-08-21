<div class="card-main">
        <div class="card-inner">
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
            ?>
            <?php
             $product = wc_get_product($product_id);
            if ($product) {
                ?>

                 <img src="<?php echo $product->get_image('medium');?>" alt="">
                 <?php
             }
            ?>

   
               <h5 class="product-title"><?php
               if ($meta_value1) {
                // First meta value found
                echo  $meta_value1 ;
            } else {
                // First meta value not found
                echo "No meta value 1 found for product";
            }?></h5>
              
              <h5 class="product-pricing"><?php if ($meta_value2) {
                // Second meta value found
                echo  $meta_value2 ;
            } else {
                // Second meta value not found
                echo "No meta value 2 found for product";
            }
        ?></h5>

         <h5 class="product-pricing"><?php if ($meta_value3) {
                // Third meta value found
                echo $meta_value3 ;
            } else {
                // Third meta value not found
                echo "No meta value 3 found for product";
            }?></h5>

            <?php
               
            endwhile;
         wp_reset_postdata();
        
            ?>

            

           
        </div>


</div>













