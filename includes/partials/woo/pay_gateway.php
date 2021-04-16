<?php

add_action( 'woocommerce_package_rates','show_hide_shipping_methods', 10, 2 );
function show_hide_shipping_methods( $rates, $package ) {
    // HERE Define your targeted shipping method ID
        $chosen_payment_method = WC()->session->get('chosen_payment_method');

    if( $chosen_payment_method =='cod' ){
        unset($rates['flexible_shipping_2_1']);
        unset($rates['flexible_shipping_2_8']);
    }elseif ( $chosen_payment_method =='bacs' ){

        unset($rates['flexible_shipping_5_6']);
        unset($rates['flexible_shipping_5_7']);
        
    }elseif ( $chosen_payment_method =='przelewy24' ){

        unset($rates['flexible_shipping_2_9']);
        unset($rates['flexible_shipping_2_2']);

    }
    return $rates;
}

add_action( 'woocommerce_review_order_before_payment', 'payment_methods_trigger_update_checkout' );
function payment_methods_trigger_update_checkout(){
    // jQuery code
    ?>
    <script type="text/javascript">
        (function($){
            $( 'form.checkout' ).on( 'change blur', 'input[name^="payment_method"]', function() {
                setTimeout(function(){
                    console.log('qqqqqqqqq00');
                    $(document.body).trigger('update_checkout');
                }, 250 );
            });
        })(jQuery);
    </script>
    <?php
}

add_action( 'woocommerce_checkout_update_order_review', 'refresh_shipping_methods' );
function refresh_shipping_methods( $post_data ){
    // HERE Define your targeted shipping method ID
    $cod = 'cod';
    $basc = 'bacs';
    $przelewy24 = 'przelewy24';

    $bool = true;

    if ( WC()->session->get('chosen_payment_method') === $cod ||  WC()->session->get('chosen_payment_method') === $basc ||  WC()->session->get('chosen_payment_method') === $przelewy24 )
        $bool = false;

    // Mandatory to make it work with shipping methods
    foreach ( WC()->cart->get_shipping_packages() as $package_key => $package ){
        WC()->session->set( 'shipping_for_package_' . $package_key, $bool );
    }
    WC()->cart->calculate_shipping();
}