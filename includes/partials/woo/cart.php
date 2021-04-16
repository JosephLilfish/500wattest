<?php
add_action( 'woocommerce_before_cart', 'cart_icon', 10 );

function cart_icon(){

    ?>
    <div class="cart_top">
        <div class="cart_col">
            <div class="cart_icon">
                 <img src="<?php echo get_stylesheet_directory_uri();?>/gfx/gc.jpg" alt="cart"/>
            </div>
            <div class="text_side">
                <b>Koszyk</b>
                <div class="line"></div>
                <div class="cart_price cart_text">Wartość: <span>1200 zł</span></div>
            </div>
        </div>

        <div class="cart_col">
            <div class="cart_icon">
                 <img src="<?php echo get_stylesheet_directory_uri();?>/gfx/truck_cart.jpg" alt="truck"/>
            </div>
            <div class="text_side">
                <b>Dostawa i płatności</b>
                <div class="line"></div>
                <div class="cart_price cart_text">Wybierz sposób dostawy i płatności</div>
            </div>
        </div>
        
        <div class="cart_col">
            <div class="cart_icon">
                 <img src="<?php echo get_stylesheet_directory_uri();?>/gfx/pick.jpg" alt="pick"/>
            </div>
            <div class="text_side">
                <b>Złożenie zamówienia</b>
                <div class="line"></div>
                <div class="cart_price cart_text">Przyjecie do realizacji</div>
            </div>
        </div>
    </div>

<?php

}




add_action( 'woocommerce_before_checkout_form', 'cart_icon_checkout', 10 );

function cart_icon_checkout(){

    ?>
    <div class="cart_top">
        <div class="cart_col">
            <div class="cart_icon">
                 <img src="<?php echo get_stylesheet_directory_uri();?>/gfx/cgrey.jpg" alt="cart"/>
            </div>
            <div class="text_side">
                <b>Koszyk</b>
                <div class="line"></div>
                <div class="cart_price cart_text">Wartość: <span>1200 zł</span></div>
            </div>
        </div>

        <div class="cart_col">
            <div class="cart_icon">
                 <img src="<?php echo get_stylesheet_directory_uri();?>/gfx/truck_gold.jpg" alt="truck"/>
            </div>
            <div class="text_side">
                <b>Dostawa i płatności</b>
                <div class="line"></div>
                <div class="cart_price cart_text">Wybierz sposób dostawy i płatności</div>
            </div>
        </div>
        
        <div class="cart_col">
            <div class="cart_icon">
                 <img src="<?php echo get_stylesheet_directory_uri();?>/gfx/pick.jpg" alt="pick"/>
            </div>
            <div class="text_side">
                <b>Złożenie zamówienia</b>
                <div class="line"></div>
                <div class="cart_price cart_text">Przyjecie do realizacji</div>
            </div>
        </div>
    </div>

<?php

}
