<<<<<<< HEAD
<?php
function iguana_main_slider( ) {

    ob_start();
    include_once( 'partials/main-slider.php' );
    return ob_get_clean();
}
add_shortcode( 'iguana_main_slider', 'iguana_main_slider' );
=======
<?php
function iguana_main_slider( ) {

    ob_start();
    include_once( 'partials/main-slider.php' );
    return ob_get_clean();
}
add_shortcode( 'iguana_main_slider', 'iguana_main_slider' );
>>>>>>> d7a2223e709ae53b4626bf2012b4732d46b28b6e
