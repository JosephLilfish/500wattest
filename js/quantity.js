(function ($) {

  
   


            $(document).ready(function () {
            
                setTimeout(function () {
                    bindEvents();
                }, 200)
            
            });
    



            $(document.body).on('updated_cart_totals', bindEvents);

            function bindEvents() {


                var qty = $('.quantity input');

                $('.button_q').on('click', function () {

                    let $fq = $(this).parent().find($('.quantity input'));
                    var $button = $(this);
                    var oldValue = $fq.val();
                    
                        if ($button.text() == "+") {

                             var newVal = parseFloat(oldValue) + 1;

                        } else {
                    // Don't allow decrementing below zero
                            if (oldValue > 1) {

                                var newVal = parseFloat(oldValue) - 1;

                            } else {

                                newVal = 1;

                            }
                    }
                    $fq.attr('value',newVal);
                    qty.trigger('change');
                });
            }

    


    // $(document.body).on('updated_cart_totals', bindEvents);

   




})(jQuery);
