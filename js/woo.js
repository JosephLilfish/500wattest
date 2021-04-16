(function($){



    $('.woocommerce-form #username').attr('placeholder','Login / E-mail');

    $('.woocommerce-form #password').attr('placeholder','Hasło');

    $('.woocommerce-form #reg_email').attr('placeholder','E-mail');



    $('#yith-wcwl-form .product-add-to-cart .nobr').text('Dodaj do koszyka / Usuń');







    if ($("body").hasClass("archive")) {



        $('.cat-parent').prepend("<span class='plus_cat-parent'></span>");

        $('.plus_cat-parent').on('click tap',function(){

            $(this).parent().toggleClass('active_cat');

        });



        $('.current-cat').parents('.current-cat-parent').addClass('active_cat');



    }



    $('.woocommerce-pagination li .next').text('>');

    $('.woocommerce-pagination li .prev').text('<');







    $(document.body).on('updated_cart_totals', cart_total);



    function cart_total(){



        if ($("body").hasClass("woocommerce-cart") || $("body").hasClass("woocommerce-checkout")) {

    

            var price_amount = $('.order-total .woocommerce-Price-amount bdi').text();

            $('.cart_top .text_side .cart_price span').text(price_amount);

    

        }

    }

    cart_total();

    

    var zero_dlugosc = $( '.woocommerce-product-attributes-item--attribute_pa_dlugosc .woocommerce-product-attributes-item__value p' ).text();
    var zero_szerokosc = $( '.woocommerce-product-attributes-item--attribute_pa_szerokosc .woocommerce-product-attributes-item__value p' ).text();
    var zero_wysokosc = $( '.woocommerce-product-attributes-item--attribute_pa_wysokosc .woocommerce-product-attributes-item__value p' ).text();
    
    if (zero_dlugosc == "0"){
        $('.woocommerce-product-attributes-item--attribute_pa_dlugosc').hide();
    }
    if (zero_szerokosc == "0"){
        $('.woocommerce-product-attributes-item--attribute_pa_szerokosc').hide();
    }
    if (zero_wysokosc == "0"){
        $('.woocommerce-product-attributes-item--attribute_pa_wysokosc').hide();
    }
})( jQuery );

