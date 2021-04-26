(function (root, $, undefined) {
    if($("div").hasClass("product")){
    $(document).ready(function () {

        $('[name="variation_id"]').on("change",()=>{
           $("[data-id]").hide();
            $('[data-id="'+$('[name="variation_id"]').val()+'"]').addClass("prizeContainerShow").show();
        })

        $("[name='quantity_new']").on("change",()=>{
            $("[name='quantity']").val($("[name='quantity_new']").val()).trigger("input").trigger("change");
        })
        $("[for='pa_kolor-wiodacy']").clone().appendTo(".selectAttr");
        $("#pa_kolor-wiodacy").clone().appendTo(".selectAttr").attr("id", "pa_kolor-wiodacy_new").on('input',
        () => { $("#pa_kolor-wiodacy").val($("#pa_kolor-wiodacy_new").val()).trigger('input').trigger('change'); 
       
        });
       
        $("[for='pa_szerokosc']").clone().appendTo(".selectAttr");
        $("#pa_szerokosc").clone().appendTo(".selectAttr").attr("id", "pa_szerokosc_new").on('input',
        () => { $("#pa_szerokosc").val($("#pa_szerokosc_new").val()).trigger('input').trigger('change'); });


        $("[for='pa_wysokosc']").clone().appendTo(".selectAttr");
        $("#pa_wysokosc").clone().appendTo(".selectAttr").attr("id", "pa_wysokosc_new").on('input',
        () => { $("#pa_wysokosc").val($("#pa_wysokosc_new").val()).trigger('input').trigger('change'); });


        $("[for='pa_material-wiodacy']").clone().appendTo(".selectAttr");
        $("#pa_material-wiodacy").clone().appendTo(".selectAttr").attr("id", "pa_material-wiodacy_new").on('input',
        () => { $("#pa_material-wiodacy").val($("#pa_material-wiodacy_new").val()).trigger('input').trigger('change'); });


        if($("form").hasClass("variations_form")){

            $(".single_add_to_cart_button").clone().appendTo(".buttonContainer").attr("id", "new_cart").on('click',
            () => { $(".variations_form").submit(); });

            
            $("#variable_wish").on('click',()=>{
                $(".add_to_wishlist")[0].click();

            });
           
        }
       
 

    });
}
}(this, jQuery));