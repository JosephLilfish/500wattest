<?php
add_filter('woocommerce_billing_fields', 'custom_woocommerce_billing_fields');

function custom_woocommerce_billing_fields($fields){

    $fields['billing_invoice'] = array(
        'type'     => 'checkbox',
        'label'    => __( 'Chcę fakturę' ),
        'required' => false,
        'class'    => array( 'need_fv', 'form-row-wide', 'update_totals_on_change' ),
        'priority' => 120
    );

    $fields['billing_invoice_nip'] = array(
        'type'        => 'text',
        'label'       => __('NIP'),
        'placeholder' => __('NIP'),
        'required'    => true,
        'class'       => array( 'billing_invoice_field', 'form-row-wide' ),
        'priority' => 131
    );

    $fields['billing_invoice_name'] = array(
        'type'        => 'text',
        'label'       => __('Nazwa firmy'),
        'placeholder' => __('Wpisz nazwę firmy'),
        'required'    => true,
        'class'       => array( 'billing_invoice_field', 'form-row-wide' ),
        'priority' => 130
    );

    $fields['billing_invoice_address'] = array(
        'type'        => 'text',
        'label'       => __('Adres'),
        'placeholder' => __('Wpisz ulicę i numer budynku'),
        'required'    => true,
        'class'       => array( 'billing_invoice_field', 'form-row-wide' ),
        'priority' => 150
    );

    $fields['billing_invoice_postcode'] = array(
        'type'        => 'text',
        'label'       => __('Kod pocztowy'),
        'placeholder' => __('Wpisz kod pocztowy'),
        'required'    => true,
        'class'       => array( 'billing_invoice_field', 'form-row-first' ),
        'priority' => 160
    );

    $fields['billing_invoice_city'] = array(
        'type'        => 'text',
        'label'       => __('Miejscowość'),
        'placeholder' => __('Wpisz Miejscowość'),
        'required'    => true,
        'class'       => array( 'billing_invoice_field', 'form-row-last' ),
        'priority' => 170
    );

    return $fields;

}


add_action( 'woocommerce_admin_order_data_after_billing_address', 'vat_number_display_admin_order_meta', 10, 1 );

function vat_number_display_admin_order_meta( $order ) {

    if( !$order->get_meta( '_billing_invoice') ) return;

    echo '<h3>Dane do faktury:</h3>';

    if( !empty( $order->get_meta( '_billing_invoice_name') ) ){

        echo '<div><strong>' . __( 'Nazwa Firmy', 'woocommerce' ) . ':</strong> ' . $order->get_meta( '_billing_invoice_name') . '</div>';

    }

    if( !empty( $order->get_meta( '_billing_invoice_nip') ) ){

        echo '<div><strong>' . __( 'NIP', 'woocommerce' ) . ':</strong> ' . $order->get_meta( '_billing_invoice_nip') . '</div>';

    }

    if( !empty( $order->get_meta( '_billing_invoice_address') ) ){

        echo '<div><strong>' . __( 'Adres', 'woocommerce' ) . ':</strong> ' . $order->get_meta( '_billing_invoice_address') . '</div>';

    }

    if( !empty( $order->get_meta( '_billing_invoice_city') ) ){

        echo '<div><strong>' . __( 'Miejscowość', 'woocommerce' ) . ':</strong> ' . $order->get_meta( '_billing_invoice_city') . '</div>';

    }

    if( !empty( $order->get_meta( '_billing_invoice_postcode') ) ){

        echo '<div><strong>' . __( 'Kod pocztowy', 'woocommerce' ) . ':</strong> ' . $order->get_meta( '_billing_invoice_postcode') . '</div>';

    }

}

function CheckNIP($str) {
	$str = preg_replace('/[^0-9]+/', '', $str);

	if (strlen($str) !== 10) {
		return false;
	}

	$arrSteps = array(6, 5, 7, 2, 3, 4, 5, 6, 7);
	$intSum = 0;

	for ($i = 0; $i < 9; $i++) {
		$intSum += $arrSteps[$i] * $str[$i];
	}

	$int = $intSum % 11;
	$intControlNr = $int === 10 ? 0 : $int;

	if ($intControlNr == $str[9]) {
		return true;
	}

	return false;
}

add_action( 'woocommerce_after_checkout_validation', 'eg_validate_nip', 1000, 2);

function eg_validate_nip( $fields, $errors ){

	if( !empty( $_POST['billing_nip'] ) ){

		if ( !CheckNIP( $_POST['billing_nip'] ) ){
			$errors->add( 'validation', __( 'Podany NIP jest nieprawidłowy.', 'woocommerce' ) );

        }
	}

    if( !empty( $_POST['billing_invoice'] ) ){

        if( !empty( $_POST['billing_invoice_nip'] ) ){

            if ( !CheckNIP( $_POST['billing_invoice_nip'] ) ){

                $errors->add( 'validation', __( 'Podany NIP jest nieprawidłowy.', 'woocommerce' ) );

            }

        }

    }
}

/* Dodanie nipu do stringa z adresami */
add_filter( 'woocommerce_my_account_my_address_formatted_address', function( $args, $customer_id, $name ){
    // the phone is saved as billing_phone and shipping_phone
    $args['nip'] = get_user_meta( $customer_id, $name . '_nip', true );
    $args['invoice'] = get_user_meta( $customer_id, $name . '_invoice', true );
    $args['invoice_name'] = get_user_meta( $customer_id, $name . '_invoice_name', true );
    $args['invoice_nip'] = get_user_meta( $customer_id, $name . '_invoice_nip', true );
    $args['invoice_address'] = get_user_meta( $customer_id, $name . '_invoice_address', true );
    $args['invoice_city'] = get_user_meta( $customer_id, $name . '_invoice_city', true );
    $args['invoice_postcode'] = get_user_meta( $customer_id, $name . '_invoice_postcode', true );
    return $args;
}, 10, 3 );

// modify the address formats
add_filter( 'woocommerce_localisation_address_formats', function( $formats ){
    foreach ( $formats as $key => &$format ) {

        $format = str_replace( '{name}', "{name}\n{position}", $format);
        $format .= "\n{nip}";

    }
    return $formats;
} );


add_action( 'my-account-after-addresses', function(){

    $user_id = get_current_user_id();

    $billing_invoice = get_user_meta( $user_id, 'billing_invoice', true );

    if ( !$billing_invoice ) return;

    echo '<header class="woocommerce-Address-title title"><h3>DANE DO FAKTURY</h3>';
    echo '<a href="/moje-konto/edycja-adresow/rozliczeniowy/#billing_invoice_field" class="edit">Edytuj</a></header>';

    echo get_user_meta( $user_id, 'billing_invoice_name', true );
    echo "<br />NIP: " . get_user_meta( $user_id, 'billing_invoice_nip', true );
    echo "<br />" . get_user_meta( $user_id, 'billing_invoice_address', true );
    echo "<br />" . get_user_meta( $user_id, 'billing_invoice_postcode', true );
    echo ", " . get_user_meta( $user_id, 'billing_invoice_city', true );

});


// add the replacement value
add_filter( 'woocommerce_formatted_address_replacements', function( $replacements, $args ){

    if ( !empty( $args['nip'] ) ){
        $replacements['{nip}'] = 'NIP: ' . $args['nip'];
    } else {
        $replacements['{nip}'] = '';
    }
    if ( !empty( $args['position'] ) ){
        $replacements['{position}'] = 'Stanowisko: ' . $args['position'];
    } else {
        $replacements['{position}'] = '';
    }

    if( ( $args['invoice'] ) ){

        $invoice = $args['invoice_name'];
        $invoice .= "\n" . $args['invoice_nip'];
        $invoice .= "\n" . $args['invoice_address'];
        $invoice .= "\n" . $args['invoice_postcode'];
        $invoice .= " " . $args['invoice_city'];

        $replacements['{invoice}'] = $invoice;

    } else {
        $replacements['{invoice}'] = '';
    }

    return $replacements;
}, 10, 2 );


function eg_display_email_order_user_meta( $order, $sent_to_admin, $plain_text ) {

    // print_r( $order->get_meta_data() );

    if( !$order->get_meta( '_billing_invoice' ) ) return;

    ?>

    <table id="invoice" cellspacing="0" cellpadding="0" style="width: 100%; vertical-align: top; margin-bottom: 40px; padding:0;" border="0">
    	<tr>
    		<td style="text-align:<?php echo esc_attr( $text_align ); ?>; font-family: 'Helvetica Neue', Helvetica, Roboto, Arial, sans-serif; border:0; padding:0;" valign="top" width="50%">
    			<h2><?php esc_html_e( 'Dane do faktury', 'woocommerce' ); ?></h2>

    			<address class="address">
    	            <?php echo $order->get_meta( '_billing_invoice_name' ); ?><br />
                    NIP: <?php echo $order->get_meta( '_billing_invoice_nip' ); ?><br />
                    <?php echo $order->get_meta( '_billing_invoice_address' ); ?><br />
                    <?php echo $order->get_meta( '_billing_invoice_postcode' ) . ' ' . $order->get_meta( '_billing_invoice_city' ); ?>
    			</address>
    		</td>
    	</tr>
    </table>
    <?php
}
add_action('woocommerce_email_customer_details', 'eg_display_email_order_user_meta', 30, 3 );

add_filter('woocommerce_order_formatted_billing_address', 'woo_custom_order_formatted_billing_address', 10, 2);

function woo_custom_order_formatted_billing_address( $address , $WC_Order ){

    $address['nip'] = $WC_Order->billing_nip;
    $address['position'] = $WC_Order->billing_position;

    return $address;

}


// define the woocommerce_before_checkout_process callback
function action_woocommerce_before_checkout_process( $array ) {

    if( empty( $_POST['billing_invoice']) ){

        add_filter('woocommerce_billing_fields', function( $fields ){

            unset( $fields['billing_invoice_nip']['required'] );
            unset( $fields['billing_invoice_name']['required'] );
            unset( $fields['billing_invoice_address']['required'] );
            unset( $fields['billing_invoice_postcode']['required'] );
            unset( $fields['billing_invoice_city']['required'] );
            return $fields;

        });

    }

}; 

// add the action
add_action( 'woocommerce_before_checkout_process', 'action_woocommerce_before_checkout_process', 10, 1 );