<?php

add_action( 'woocommerce_before_main_content', 'add_breadcrumbs', 10 );

function add_breadcrumbs(){
?>
<div class="full_width_row">
    <div class="et_pb_row bread_row">
        <?php
            if ( function_exists('yoast_breadcrumb') ) {
                yoast_breadcrumb( '<p id="breadcrumbs">','</p>' );
            }
        ?>
    </div>
</div>
<?php
}


/////MY ACCOUNT //////

add_action( 'woocommerce_register_form_start', 'add_register_text', 99 );

function add_register_text(){
    echo "<h3 class='my_account_title'>Jestem nowym klientem - rejestracja</h3>";
}

add_action( 'woocommerce_login_form_start', 'add_login_text', 10 );

function add_login_text(){

    echo "<h3 class='my_account_title'>Mam już konto - logowanie</h3>";

}

/////MY ACCOUNT //////


//////////CART/////////////

add_action( 'woocommerce_after_cart', 'go_to_shop',20);


function go_to_shop(){

    echo "<a class='border-button' href='/sklep/'>Kontynuuj zakupy</a>";

}

//////////CART/////////////
            
//////////////PRODUCT CATEGORY////////////////
/**
 * Display category image on category archive
 */
add_action( 'woocommerce_archive_description', 'woocommerce_category_image', 2 );
function woocommerce_category_image() {
    if ( is_product_category() ){
	    global $wp_query;
	    $cat = $wp_query->get_queried_object();
	    $thumbnail_id = get_term_meta( $cat->term_id, 'thumbnail_id', true );
	    $image = wp_get_attachment_url( $thumbnail_id );
	    if ( $image ) {
		    echo '<img class="category_main_img" src="' . $image . '" alt="' . $cat->name . '" />';
        }
        // echo do_shortcode('[products paginate=true]');
	}
}

remove_action('woocommerce_before_shop_loop','woocommerce_catalog_ordering',30);
    add_action( 'woocommerce_before_shop_loop', function(){
        echo "<div class='cat_sort cat_sort_top'>";
    }, 10 );

        add_action( 'woocommerce_before_shop_loop', function(){
            echo "<div class='order_cat'> <span>Sortowanie </span>";
        }, 19 );

        add_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 20 );

        add_action( 'woocommerce_before_shop_loop', function(){
            echo "</div>";
        }, 21 );

        add_action( 'woocommerce_before_shop_loop', 'woocommerce_pagination', 30 );
    
    add_action( 'woocommerce_before_shop_loop', function(){
        echo "</div>";
    }, 50 );

    
// -------

remove_action('woocommerce_after_shop_loop','woocommerce_pagination',10);
    
    add_action( 'woocommerce_after_shop_loop', function(){
        echo "<div class='cat_sort cat_sort_bottom'>";
    }, 10 );

        add_action( 'woocommerce_after_shop_loop', function(){
            echo "<div class='order_cat'> <span>Sortowanie </span>";
        }, 19 );

        add_action( 'woocommerce_after_shop_loop', 'woocommerce_catalog_ordering', 20 );

        add_action( 'woocommerce_after_shop_loop', function(){
            echo "</div>";
        }, 21 );

        add_action( 'woocommerce_after_shop_loop', 'woocommerce_pagination', 30 );
    
    add_action( 'woocommerce_after_shop_loop', function(){
        echo "</div>";
    }, 50 );



    
//////////////PRODUCT CATEGORY////////////////


// 1. Add custom field input @ Product Data > Variations > Single Variation

add_action( 'woocommerce_variation_options_pricing', 'cross_sell_prod', 100, 3 );


function cross_sell_prod( $loop, $variation_data, $variation ) {
woocommerce_wp_text_input( array(
    'id' => 'cross_sell_prod[' . $loop . ']',
    'class' => 'datepicker date-picker short form-row form-row-first',
    'label' => __( 'Kategoria powiązanych produktów', 'woocommerce' ),
    'value' => get_post_meta( $variation->ID, 'cross_sell_prod', true ),
    'wrapper_class' => 'form-row form-row-first'
)
);
}

// -----------------------------------------
// 2. Save custom field on product variation save

add_action( 'woocommerce_save_product_variation', 'count_m2_in_box_save_custom_field_variations', 10, 2 );

function count_m2_in_box_save_custom_field_variations( $variation_id, $i ) {
$custom_field = $_POST['cross_sell_prod'][$i];
if ( isset( $custom_field ) ) update_post_meta( $variation_id, 'cross_sell_prod', esc_attr( $custom_field ) );
}
// -----------------------------------------
// 3. Store custom field value into variation data

add_filter( 'woocommerce_available_variation', 'count_m2_in_box_add_custom_field_variation_data' );

function box_count_places_add_custom_field_variation_data( $variations ) {
$variations['cross_sell_prod'] = '<div class="woocommerce_custom_field">Powiązane produkty: <span>' . get_post_meta( $variations[ 'variation_id' ], 'cross_sell_prod', true ) . '</span></div>';
return $variations;
}

add_action('woocommerce_product_options_general_product_data', function() {
    woocommerce_wp_text_input([
        'id' => 'cross_sell_prod',
        'label' => __('Kategoria powiązanych produktów', 'txtdomain'),
        'wrapper_class' => 'show_if_simple',
        'class' => 'datepicker short'
    ]
);
});

add_action('woocommerce_process_product_meta', function($post_id) {
    $product = wc_get_product($post_id);
    $available_to = isset($_POST['cross_sell_prod']) ? $_POST['cross_sell_prod'] : '';
    $product->update_meta_data('cross_sell_prod', sanitize_text_field($available_to));
    $product->save();
});


/*
 * Dodanie CHECKBOX-ów na stronie zamówienie przed zakupem
 * 	privacy_policy - prawo do odstąpienia od umowy k-s
 *  privacy_policy2 - regulamin i polityka prywatności
 */

add_action( 'woocommerce_review_order_before_submit', 'bbloomer_add_checkout_privacy_policy', 9 );
function bbloomer_add_checkout_privacy_policy() {

woocommerce_form_field( 'privacy_policy', array(
   'type'          => 'checkbox',
   'class'         => array('form-row privacy'),
   'label_class'   => array('woocommerce-form__label woocommerce-form__label-for-checkbox checkbox'),
   'input_class'   => array('woocommerce-form__input woocommerce-form__input-checkbox input-checkbox'),
   'required'      => true,
   'label'         => 'Przeczytałem/am i akceptuję <a target="_blank" href="/polityka-prywatnosci/">Politykę prywatności</a>'
));

}

// wyświetl powiadomienie - akceptacja regulaminu
add_action( 'woocommerce_checkout_process', 'bbloomer_not_approved_privacy' );
function bbloomer_not_approved_privacy() {
    if ( ! (int) isset( $_POST['privacy_policy'] ) ) {
        wc_add_notice( __( 'Zaznacz wymagane zgody' ), 'error' );
    }
}


add_filter('wp_get_attachment_image_attributes', 'change_attachement_image_attributes', 20, 2);
function change_attachement_image_attributes( $attr, $attachment ) {
// Get post parent
$parent = get_post_field( 'post_parent', $attachment);

// Get post type to check if it's product
$type = get_post_field( 'post_type', $parent);
if( $type != 'product' ){
    return $attr;
}

/// Get title
$title = get_post_field( 'post_title', $parent);

if( $attr['alt'] == ''){
    $attr['alt'] = $title;
    $attr['title'] = $title;
}

return $attr;
}