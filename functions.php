<?php

// Exit if accessed directly

if ( !defined( 'ABSPATH' ) ) exit;



// BEGIN ENQUEUE PARENT ACTION

// AUTO GENERATED - Do not modify or remove comment markers above or below:



if ( !function_exists( 'chld_thm_cfg_locale_css' ) ):

    function chld_thm_cfg_locale_css( $uri ){

        if ( empty( $uri ) && is_rtl() && file_exists( get_template_directory() . '/rtl.css' ) )

            $uri = get_template_directory_uri() . '/rtl.css';

        return $uri;

    }

endif;

add_filter( 'locale_stylesheet_uri', 'chld_thm_cfg_locale_css' );



if ( !function_exists( 'chld_thm_cfg_parent_css' ) ):

    function chld_thm_cfg_parent_css() {

        wp_enqueue_style( 'chld_thm_cfg_parent', trailingslashit( get_template_directory_uri() ) . 'style.css', array(  ) );

    }

endif;

add_action( 'wp_enqueue_scripts', 'chld_thm_cfg_parent_css', 10 );



// END ENQUEUE PARENT ACTION





function eg_enqueue_scripts() {

     wp_enqueue_script( 'eg-scripts', get_stylesheet_directory_uri() . '/main.min.js', array( 'jquery' ), false, true );

     wp_enqueue_style( 'slick', "//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" );

     wp_enqueue_script( 'slick', "//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js" );

}

add_action( 'wp_enqueue_scripts', 'eg_enqueue_scripts' );




add_action( 'add_attachment', 'my_set_image_meta_upon_image_upload' );

function my_set_image_meta_upon_image_upload( $post_ID ) {

    if ( wp_attachment_is_image( $post_ID ) ) {

        $my_image_title = get_post( $post_ID )->post_title;

        $my_image_title = preg_replace( '%\s*[-_\s]+\s*%', ' ',

        $my_image_title );

        $my_image_title = ucwords( strtolower( $my_image_title ) );

        $my_image_meta = array(

            'ID' => $post_ID,

            'post_title' => $my_image_title,

            'post_excerpt' => $my_image_title,

            'post_content' => $my_image_title,

        );

        update_post_meta( $post_ID, '_wp_attachment_image_alt', $my_image_title );

        wp_update_post( $my_image_meta );

    }

}



function defer_parsing_of_js( $url ) {

    if ( is_user_logged_in() ) return $url; //don't break WP Admin

    if ( FALSE === strpos( $url, '.js' ) ) return $url;

    if ( strpos( $url, 'jquery.js' ) ) return $url;

    return str_replace( ' src', ' defer src', $url );

}

add_filter( 'script_loader_tag', 'defer_parsing_of_js', 10 );



function remove_wp_versions_strings($src){



global $wp_version;

parse_str(parse_url( $src, PHP_URL_QUERY ), $query);

if ( !empty( $query['ver']) && $query['ver'] === $wp_version){

$src = remove_query_arg('ver', $src);

}

return $src;

}



remove_action('wp_head', 'wp_generator');

add_filter('script_loader_src', 'remove_wp_versions_strings' );

add_filter('style_loader_src', 'remove_wp_versions_strings' );





include_once( 'includes/shortcodes.php' );








function diamond_include_font_awesome() {

    wp_enqueue_style('font-awesome', "https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css");

}



add_action('wp_enqueue_scripts', 'diamond_include_font_awesome');





include_once( 'includes/partials/woo/pay_gateway.php' );



add_filter( 'loop_shop_per_page', 'new_loop_shop_per_page', 20 );

function new_loop_shop_per_page( $cols ) {
  // $cols contains the current number of products per page based on the value stored on Options –> Reading
  // Return the number of products you wanna show per page.
  $cols = 40;
  return $cols;
}
