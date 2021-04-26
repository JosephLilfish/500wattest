<?php
///////////////PRODUCT////////////////////////
remove_action("woocommerce_single_product_summary","woocommerce_template_single_price",10);
remove_action("woocommerce_single_product_summary","woocommerce_template_single_excerpt",20);
remove_action("woocommerce_single_product_summary","woocommerce_template_single_add_to_cart",30);

add_action("woocommerce_single_product_summary","woocommerce_template_single_price",8);
add_action("woocommerce_single_product_summary","woocommerce_template_single_add_to_cart",10);
add_action("woocommerce_single_product_summary","woocommerce_template_single_excerpt",55);


add_filter( 'woocommerce_product_tabs', 'bbloomer_remove_product_tabs', 9999 );
  

add_action( 'woocommerce_product_meta_end', 'wc_show_attribute_links' );
// if you'd like to show it on archive page, replace "woocommerce_product_meta_end" with "woocommerce_shop_loop_item_title"

function wc_show_attribute_links() {
	global $post;
	$attribute_names = array( 'pa_serie');
		
	foreach ( $attribute_names as $attribute_name ) {
		$taxonomy = get_taxonomy( $attribute_name );
		
		if ( $taxonomy && ! is_wp_error( $taxonomy ) ) {
			$terms = wp_get_post_terms( $post->ID, $attribute_name );
			$terms_array = array();
		
	        if ( ! empty( $terms ) ) {
		        foreach ( $terms as $term ) {
			       $archive_link = get_term_link( $term->slug, $attribute_name );
			       $full_line = '<a href="' . $archive_link . '">'. $term->name . '</a>';
			       array_push( $terms_array, $full_line );
		        }
		        echo $taxonomy->labels->name . ' ' . implode( $terms_array, ', ' );
	        }
    	}
    }
}



function bbloomer_remove_product_tabs( $tabs ) {
    unset( $tabs['additional_information'] ); 
    return $tabs;
}


add_action( 'woocommerce_single_product_summary', 'woocommerce_additional_info', 30 );

function woocommerce_additional_info(){
    global $product;
    echo "<p class='ai_title'>Dane techniczne:</p>";
    do_action( 'woocommerce_product_additional_information', $product );
}



add_action( 'woocommerce_single_product_summary', 'woocommerce_katalog_nr', 7 );

function woocommerce_katalog_nr(){
    
    global $product;
    $nr_catalog = $product->get_attribute( 'pa_numer-katalogowy' );
    $nr_serii = $product->get_attribute( 'pa_seria' );
global $post;
    $term = wp_get_post_terms( $post->ID, "pa_seria" );
    $archive_link = get_term_link( $term[0], "pa_seria" );
 
 
    echo ("<div class='selectAttr'><p class='nr_catalog'>Numer katalogowy: <b>" . $nr_catalog . "</b></p>");
    if($nr_serii){

     echo("<p class='serie'>SERIA:<a href='".$archive_link."'><span>".$nr_serii."</span></p></a>");
    }
    echo("</div>");
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


add_action( 'woocommerce_single_product_summary', 'woocommerce_discount', 14 );

function woocommerce_discount(){
    global $product;
    $stock = $product -> stock;
    ?>
   
        <div class="discountBox">
       <div class="discountDesc"> <p>Kup<span> więcej </span> by wydać <span> mniej, </span>rabaty nawet do <span> 10% </span>!</p></div>
       <button class="discountButton">Sprawdź szczegóły</button>


       <div class="discountPopup">
           <div class="popupClose"><i class="far fa-times-circle"></i></div>
           <div class="popupImage"></div>
           <hr>
           <div class="popupTextBox">
           <h2>Kup  więcej by wydać mniej!</h2>
           <div class="popupList">
               <div class="singleDisc"><p>od 500zł</p><div class="goldDisc">RABAT 5%</div></div>
               <div class="singleDisc"><p>od 700zł</p><div class="goldDisc">RABAT 7%</div></div>
               <div class="singleDisc"><p>od 1000zł</p><div class="goldDisc">RABAT 10%</div></div>
           </div>
           <p class="popupAddInfo">*rabat nie nalicza się na produkty przecenione<br>
                **W przypadku zwrotu przez klienta części towaru, na który został naliczony rabat ilościowy, zwrot należności zostanie pomniejszony proporcjonalnie o różnicę udzielonego rabatu w zamówieniu pierwotnym
            </p>
           </div>
       </div>
        </div>

    <?php

}





add_action( 'woocommerce_single_product_summary', 'woocommerce_variable_price', 9 );

function woocommerce_variable_price(){
    global $product;
    if($product->is_type('variable')){
$variations = $product->get_available_variations();
//var_dump($variations);
foreach($variations as $index => $variation){?>
    <div class="priceContainer" data-id="<?php echo $variation["variation_id"] ?>"><?php echo $variation["price_html"] ?>
    <?php $stock = $product -> stock;
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

   
</div>
    <?php
}

?>



<?php
}
}
add_action( 'woocommerce_single_product_summary', 'woocommerce_variable_buttons', 11 );

function woocommerce_variable_buttons(){
    global $product;
    if($product->is_type('variable')){
    ?>
<div class="buttonContainer cart">

<div class="quantity quantityVariable">
	<div class="d-f fxd-c">
        <div class="d-f qty-btns">  
            <div class="dec button_q">-</div>
    	   
		    <input type="number"  name="quantity_new"id="quantity_60814c4df35c3" class="input-text qty text" step="1" min="1" max="66" name="quantity" value="1" title="Szt." size="4" placeholder="" inputmode="">
            <div class="inc button_q">+</div>
    </div>
    </div>
    </div>
    <button class="wishButton" id="variable_wish">Dodaj do ulubionych</button>
    </div>
    <?php
}}
add_action( 'woocommerce_single_product_summary', 'check_type', 1);

function check_type(){
    global $product;
if($product->is_type('variable')){
  

    remove_action("woocommerce_single_product_summary","woocommerce_template_single_price",8);
    remove_action( 'woocommerce_single_product_summary', 'woocommerce_shipp_icon', 9 );
    //add_action( 'woocommerce_single_product_summary', 'woocommerce_shipp_icon',9 );

}
    
}