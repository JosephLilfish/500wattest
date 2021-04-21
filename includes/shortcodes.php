<?php

include_once( 'partials/woo/woo-hax.php' );
include_once( 'partials/woo/quantity.php' );
include_once( 'partials/woo/nip-checkout.php' );
include_once( 'partials/woo/product_page.php' );
include_once( 'partials/woo/cart.php' );

include_once( 'partials/register-sidebar.php' );


function header_hax( $atts ) {
    
    ob_start();
    include_once( 'partials/header/header_hax-' . $atts['head'] . '.php' );
    return ob_get_clean();
}
add_shortcode( 'header_hax', 'header_hax' );


function home_slider( ) {

    ob_start();
    get_template_part( 'includes/partials/home-slider' );
    return ob_get_clean();
}
add_shortcode( 'home_slider', 'home_slider' );

function home_banner( ) {

    ob_start();
    get_template_part( 'includes/partials/home-banner' );
    return ob_get_clean();
}
add_shortcode( 'home_banner', 'home_banner' );


function category_name( ) {

    ob_start();
    get_template_part( 'includes/partials/woo/category-name' );
    return ob_get_clean();
}
add_shortcode( 'category_name', 'category_name' );

function show_elements( $atts ) {
    
    ob_start();
    include_once( 'partials/woo/show_elements-' . $atts['woo'] . '.php' );
    return ob_get_clean();
}
add_shortcode( 'show_elements', 'show_elements' );


function footer_elements( $atts ) {
    
    ob_start();
    include_once( 'partials/footer/footer_elements-' . $atts['foot'] . '.php' );
    return ob_get_clean();
}
add_shortcode( 'footer_elements', 'footer_elements' );


function posts_elements( $atts ) {
    
    ob_start();
    include_once( 'partials/posts/post-' . $atts['post'] . '.php' );
    return ob_get_clean();
}
add_shortcode( 'posts_elements', 'posts_elements' );