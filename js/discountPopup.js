(function (root, $, undefined) {
    if($("div").hasClass("product")){
        $(".discountPopup").hide();
$(".discountButton").click(function(){

    $('.discountPopup').show();
  });

  $(".popupClose").click(function(){
    $(".discountPopup").hide();
  })
}
  

}(this,jQuery));