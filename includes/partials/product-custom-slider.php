<?php
$slider_id = get_field("polecany_produkt");
if($slider_id){
?>

    <h2 class="prod_slick_title">Możesz polubić</h2>
    <ul class="shop_product in_prod slick_in_prod_custom">
<?php 

foreach($slider_id as $index => $slide){
    global $product;
    $product = wc_get_product( $slide );
    $title_product = get_the_title($slide);
    $image_product = $product->get_image();
    $url_product = get_the_permalink($slide);
    $price = $product->get_price();
    $checkout_url = WC()->cart->get_cart_url($slide);
?>
<li class="shop_item customSliderItem">
    <div class="photo_box">
    <a class="image_product" href="<?php echo $url_product?>"><?php echo $image_product ?></a>
</div>

<a href="<?php echo $url_product ?>" class="product_title"><?php echo $title_product ?></a>
<span class="price size-price bold"> <?php echo wc_price($price) ?></span>
<div class="product_icons_bot">
    <ul>
        <li><?php echo do_shortcode('[yith_wcwl_add_to_wishlist]') ?></li>
        <li class="normal">
            <a href="<?php  echo $checkout_url?>?add-to-cart=<?php echo $slide?>">
                <img class="before_hover" src="<?php echo get_stylesheet_directory_uri();?>/gfx/cart.png" alt="cart"/>
                <img class="on_hover" src="<?php echo get_stylesheet_directory_uri();?>/gfx/cart_gold.png" alt="cart"/>
            </a>
        </li>
    </ul>
    </div>
</li>
<?php
}

?>
</ul>
<div class="grey_divider"></div>
<?php }?>
