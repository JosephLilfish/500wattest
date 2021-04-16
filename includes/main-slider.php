<?php
function iguana_main_slider( ) {

    ob_start();
    include_once( 'partials/main-slider.php' );
    return ob_get_clean();
}
add_shortcode( 'iguana_main_slider', 'iguana_main_slider' );
