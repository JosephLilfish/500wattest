
<?php


add_shortcode ('woo_cart_but', 'woo_cart_but' );
/**
 * Create Shortcode for WooCommerce Cart Menu Item
 */
function woo_cart_but() {
	ob_start();
 
        $cart_count = WC()->cart->cart_contents_count; // Set variable for cart item count
        $cart_url = wc_get_cart_url();  // Set Cart URL
  
        ?>
        <a class="menu-item cart-contents" href="<?php echo $cart_url; ?>" title="Koszyk">
        <img class="on_hover" src="<?php echo get_stylesheet_directory_uri();?>/gfx/shopping-cart-solid.svg" alt="search"/>
            <?php
            if ( $cart_count > 0 ) {
            ?>
                <span class="cart-contents-count"><?php echo $cart_count; ?></span>
            <?php
            }
            ?>
        </a>
        <?php
	        
    return ob_get_clean();
 
}
add_filter( 'woocommerce_add_to_cart_fragments', 'woo_cart_but_count' );
/**
 * Add AJAX Shortcode when cart contents update
 */
function woo_cart_but_count( $fragments ) {
 
    ob_start();
    
    $cart_count = WC()->cart->cart_contents_count;
    $cart_url = wc_get_cart_url();
    
    ?>
    <a class="cart-contents menu-item" href="<?php echo $cart_url; ?>" title="<?php _e( 'Zobacz koszyk' ); ?>">
	<?php
    if ( $cart_count > 0 ) {
        ?>
        <span class="cart-contents-count"><?php echo $cart_count; ?></span>
        <?php            
    }
        ?></a>
    <?php
 
    $fragments['a.cart-contents'] = ob_get_clean();
     
    return $fragments;
}
?>
<ul class="header_icons">
<li><a href="/moje-konto/"><img class="on_hover" src="<?php echo get_stylesheet_directory_uri();?>/gfx/user-alt-solid.svg" alt="search"/></a></li>
<li><a href="/schowek/"><i class="yith-wcwl-icon fa fa-heart-o"></i></a></li>
<li><?php  echo do_shortcode ( "[woo_cart_but]" ) ; ?></li>
</ul>