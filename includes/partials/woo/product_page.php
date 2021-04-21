<?php
///////////////PRODUCT////////////////////////
remove_action("woocommerce_single_product_summary","woocommerce_template_single_price",10);
remove_action("woocommerce_single_product_summary","woocommerce_template_single_excerpt",20);
remove_action("woocommerce_single_product_summary","woocommerce_template_single_add_to_cart",30);

add_action("woocommerce_single_product_summary","woocommerce_template_single_price",8);
add_action("woocommerce_single_product_summary","woocommerce_template_single_add_to_cart",10);
add_action("woocommerce_single_product_summary","woocommerce_template_single_excerpt",55);

add_filter( 'woocommerce_product_tabs', 'bbloomer_remove_product_tabs', 9999 );
  
function bbloomer_remove_product_tabs( $tabs ) {
    unset( $tabs['additional_information'] ); 
    return $tabs;
}


add_action( 'woocommerce_single_product_summary', 'woocommerce_additional_info', 25 );

function woocommerce_additional_info(){
    global $product;
    echo "<p class='ai_title'>Dane techniczne:</p>";
    do_action( 'woocommerce_product_additional_information', $product );
}



add_action( 'woocommerce_single_product_summary', 'woocommerce_katalog_nr', 7 );

function woocommerce_katalog_nr(){
    
    global $product;
    $nr_catalog = $product->get_attribute( 'pa_numer-katalogowy' );
    echo "<p class='nr_catalog'>Numer katalogowy: <b>" . $nr_catalog . "</b></p>";
    
}


// add_filter('gettext', 'bbloomer_translate_tag_taxonomy');
// add_filter( 'ngettext', 'bbloomer_translate_tag_taxonomy' );
 
function bbloomer_translate_tag_taxonomy($translated) {
 
if ( is_product() ) {
// This will only trigger on the single product page
$translated = str_ireplace('tagi', 'Skonfiguruj swój produkt, kliknij i wybierz', $translated);
$translated = str_ireplace('tag', 'Skonfiguruj swój produkt, kliknij i wybierz', $translated);
}
 
return $translated;

}


remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );



// add_action( 'woocommerce_share', 'cross_category', 10 );

function cross_category(){
    
    global $product;
    $prod_id = $product ->get_id();
    $cross_sell = get_post_meta( $prod_id , 'cross_sell_prod');
    print_r($cross_sell);


}

add_action( 'woocommerce_single_product_summary', 'woocommerce_shipp_icon', 9 );

function woocommerce_shipp_icon(){
    global $product;
    $stock = $product -> stock;
    ?>
   
        <div class="truck_box">
            <?php if ( $stock == 0 ){ ?>
                <p class="red">Produkt niedostępny<br /></p>
            <?php } else { ?>
            <img class="on_hover" src="<?php echo get_stylesheet_directory_uri();?>/gfx/truck.png" alt="truck"/>
                <p>Produkt dostępny (<?php echo $stock ;?> szt.)<br />
            Wysyłka w ciągu 48h od zamówienia</p>
            <?php } ?>
        </div>

    <?php

}

add_action( 'woocommerce_after_add_to_cart_button', 'wish_button', 7 );

function wish_button(){
    
   echo do_shortcode('[yith_wcwl_add_to_wishlist]') ;
    
}



remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );

///////////////PRODUCT////////////////////////

add_action( 'woocommerce_after_single_product', 'recent_prod', 10 );

function recent_prod(){

    echo do_shortcode('[show_elements woo="product_crosssell"]');
    echo do_shortcode('[show_elements woo="products_in_product"]');

}
 


add_action( 'woocommerce_after_shop_loop_item', 'add_icon', 10 );

function add_icon(){
    global $product;
          $id_product = $product->get_id();
?>
    <div class="product_icons_bot">
        <ul>
            <li><?php echo do_shortcode('[yith_wcwl_add_to_wishlist]') ?></li>
            <li class="normal">
                <a href="<?php  echo $checkout_url?>?add-to-cart=<?php echo $id_product ?>">
                    <img class="before_hover" src="<?php echo get_stylesheet_directory_uri();?>/gfx/cart.png" alt="cart"/>
                    <img class="on_hover" src="<?php echo get_stylesheet_directory_uri();?>/gfx/cart_gold.png" alt="cart"/>
                </a>
            </li>
        </ul>
    </div>
<?php
} 