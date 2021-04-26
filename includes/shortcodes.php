<?php

include_once( 'partials/woo/woo-hax.php' );
include_once( 'partials/woo/quantity.php' );
include_once( 'partials/woo/nip-checkout.php' );
include_once( 'partials/woo/product_page.php' );
include_once( 'partials/woo/cart.php' );

include_once( 'partials/register-sidebar.php' );


function createSearchBar(){
    ?>
    <div class="search_in_header">
    <?php if ( function_exists( 'aws_get_search_form' ) ) { aws_get_search_form(); } ?>
                            <!-- <form role="search" method="get" class="et-search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
    
                                <?php
    
                                // printf( '<input type="search" class="et-search-field" placeholder="" value="%2$s" name="s" title="%3$s" />',
    
                                // esc_attr__( 'Search &hellip;', 'Divi' ),
    
                                // get_search_query(),
    
                                // esc_attr__( 'Search for:', 'Divi' )
    
                                // );
    
    
    
                                /**
    
                                * Fires inside the search form element, just before its closing tag.
    
                                *
    
                                // * @since ??
    
                                // */
    
                                // do_action( 'et_search_form_fields' );
    
                                ?>
    
                                <button type="submit" id="searchsubmit_header"><img class="on_hover" src="<?php echo get_stylesheet_directory_uri();?>/gfx/ionic-ios-search.png" alt="search"/> Szukaj</button>
    
                            </form> -->
    
                        </div><?php
}
add_shortcode('createSearchBar','createSearchBar');


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