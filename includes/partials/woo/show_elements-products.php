<?php
    $args = array(
	
		'posts_per_page' => 9,
		'post_type' => 'product',
        'meta_key'  	=> 'total_sales',
        'orderby'   	=> 'meta_value_num',
        'meta_query' => array(
            array(
                'key' => '_stock_status',
                'value' => 'instock'
            )
    )
	
    );
    $the_query = new WP_Query( $args );
    
	// The Loop
    ?>
    <ul class="shop_product in_prod">
        <?php
        while ( $the_query->have_posts() ) {
          $the_query->the_post(); 
          global $product;
          $id_product = $product->get_id();
          $title_product = get_the_title();
          $image_product = $product->get_image();
          $url_product = get_the_permalink();
          $price = $product->get_price();
        //   $checkout_url = WC()->cart->get_cart_url();

        ?>
            <li class="shop_item">
                <div class="photo_box">

                    <a class="image_product" href="<?php echo $url_product ?>"><?php echo $image_product ?></a>

                </div>

                <a href="<?php echo $url_product ?>" class="product_title"><?php echo $title_product ?></a>
                <span class="price size-price bold"> <?php echo wc_price($price) ?></span>
                <div class="product_icons_bot www">
                    <ul>
                        <li><a href="#"><?php echo do_shortcode('[yith_wcwl_add_to_wishlist]') ?></a></li>
                        <li class="normal">
                            <a href="<?php  echo $checkout_url?>?add-to-cart=<?php echo $id_product ?>">
                                <img class="before_hover" src="<?php echo get_stylesheet_directory_uri();?>/gfx/cart.png" alt="cart"/>
                                <img class="on_hover" src="<?php echo get_stylesheet_directory_uri();?>/gfx/cart_gold.png" alt="cart"/>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>

        <?php }	?>
    </ul>
    <div class="grey_divider"></div>