<?php
// Removes the WooCommerce filter, that is validating the quantity to be an int
remove_filter('woocommerce_stock_amount', 'intval');
 
// Add a filter, that validates the quantity to be a float
add_filter('woocommerce_stock_amount', 'floatval');

add_filter( 'woocommerce_cart_item_quantity', 'qty_input_field_in_cart', 10, 3 );

function qty_input_field_in_cart( $product_quantity, $cart_item_key, $cart_item ) {

    // return json_encode( $cart_item );

    if( $cart_item['variation_id'] == 0 ){
        
        $product = wc_get_product( $cart_item['product_id'] );
 
    } else {

        $product = wc_get_product( $cart_item['variation_id'] );

    }

    // return $fake_quantity_value;

    if ( $product->is_sold_individually() ) {
        $product_quantity = sprintf( '1 <input type="hidden" name="cart[%s][qty]" value="1" />', $cart_item_key );
    } else {
        $product_quantity = woocommerce_quantity_input(
            array(
                'input_name'   => "cart[{$cart_item_key}][qty]",
                'input_value'  => $cart_item['quantity'],
                'max_value'    => $product->get_max_purchase_quantity(),
                'min_value'    => '0',
                'product_name' => $product->get_name()
            ),
            $product,
            false
        );
    }

   
    $out .= '<div class="d-f jc-sb"><div><div class="dec button_q">-</div>' . $product_quantity . '<div class="inc button_q">+</div></div></div>';


    // <input name="fake-quantity" autocomplete="off" value="1" />

    return $out;
}

add_action( 'woocommerce_before_quantity_input_field', function( ){

    if( is_cart() ) return;

    ?>
    <div class="d-f fxd-c">
        
    <div class="d-f qty-btns">
    <div class="dec button_q">-</div>
    <?php
}, 10 );

add_action( 'woocommerce_after_quantity_input_field', function(){

    if( is_cart() ) return;
?>  
    
    <div class="inc button_q">+</div>
    </div>
    </div>
<?php
});

