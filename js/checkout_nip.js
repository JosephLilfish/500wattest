(function ($) {

    $('.need_fv input').change(function () {
        if ($(this).is(":checked")) {

            $(' .billing_invoice_field').show();
            $('#billing_nip').attr('disabled', true);

            var wrapper = $('#billing_nip').closest('.form-row').removeClass('woocommerce-invalid');

        } else {

            $('#billing_nip').attr('disabled', false);

            var wrapper = $('#billing_nip').closest('.form-row');

            if (!checkNIP($('#billing_nip').val()) && $('#billing_nip').val() != '') {

                wrapper.addClass('woocommerce-invalid');

            }

        }
    });
    $(document).ready(function () {

        if ($('.need_fv').find('.input-checkbox').is(":checked")) {
            $('#billing_nip').attr('disabled', true);
            $('.billing_invoice_field').show();

        } else {

            $('.billing_invoice_field').hide();
            $('#billing_nip').attr('disabled', false);

        }
    });

    $('body').on('change', '#billing_nip, #billing_invoice_nip', function () {

        let val = $(this).val();
        val = val.replace(/[^0-9]+/, '');

        $(this).val(val);

        var wrapper = $(this).closest('.form-row');

        if (checkNIP($(this).val()) || $(this).val() == '' && $(this).attr('id') == 'billing_nip') {

            wrapper.addClass('woocommerce-validated'); // success

        } else {

            wrapper.addClass('woocommerce-invalid'); // error

        }

    });

    $('body').on('change', '#billing_invoice_name, #billing_invoice_address, #billing_invoice_city', function () {

        var wrapper = $(this).closest('.form-row');

        if ($(this).val().length < 3) {
            wrapper.addClass('woocommerce-invalid'); // error
            invalid = true;
        } else {
            wrapper.addClass('woocommerce-validated'); // success
        }

    });

    $('body').on('blur change', '#billing_invoice_postcode', function () {

        var wrapper = $(this).closest('.form-row');

        let code = $(this).val().replace(/[^0-9]+/, '');
        console.log(code);

        if (code.length != 5) {
            wrapper.addClass('woocommerce-invalid'); // error
        } else {
            wrapper.addClass('woocommerce-validated'); // success
        }

    });

    $(document.body).on('checkout_error', function () {

        $('.woocommerce-NoticeGroup-checkout strong').each(function () {

            let oi = $(this).text().replace('Billing', '');
            $(this).text(oi)

        });


        if ($('#billing_invoice').is(":checked")) {

            $('#billing_invoice_name, #billing_invoice_address, #billing_invoice_city, #billing_invoice_nip').trigger('change');

        } else {

            $('.billing_invoice_field ').removeClass('woocommerce-invalid');

        }

    });

    


})(jQuery);

function checkNIP(str) {
    str = str.replace(/[^0-9]+/, '');

    if (str.length !== 10) {
        return false;
    }

    arrSteps = [6, 5, 7, 2, 3, 4, 5, 6, 7];
    intSum = 0;

    for (let i = 0; i < 9; i++) {
        intSum += arrSteps[i] * str[i];
    }

    int = intSum % 11;
    intControlNr = int === 10 ? 0 : int;

    if (intControlNr == str[9]) {
        return true;
    }

    return false;
}