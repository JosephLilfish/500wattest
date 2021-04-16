<?php
if ( ( is_page() || is_single() || is_product()) && in_array( get_post_meta( get_queried_object_id(), '_et_pb_page_layout', true ), array( 'et_full_width_page', 'et_no_sidebar' ) ) ) {
	return;
}
$classes = get_body_class();
if ( is_product_tag() ) {

    if ( is_active_sidebar( 'sidebar-1' ) && !is_product()) : ?>
        <div id="sidebar">
            <?php dynamic_sidebar( 'category-product' ); ?>
        </div> <!-- end #sidebar -->
    <?php
    endif;

}else if (in_array('woocommerce',$classes) && !is_product()) {

    if ( is_active_sidebar( 'sidebar-1' ) ) : ?>
        <div id="sidebar">
            <?php dynamic_sidebar( 'category-product' ); ?>
        </div> <!-- end #sidebar -->
    <?php
    endif;

} 
else {

    if ( is_active_sidebar( 'sidebar-1' ) && !is_product()) : ?>
        <div id="sidebar">
            <?php dynamic_sidebar( 'sidebar-1' ); ?>
        </div> <!-- end #sidebar -->
    <?php
    endif;

}
