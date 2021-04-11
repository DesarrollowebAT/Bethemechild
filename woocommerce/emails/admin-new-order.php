<?php
/**
 * Admin new order email
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/emails/admin-new-order.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates/Emails/HTML
 * @version 3.5.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/*
 * @hooked WC_Emails::email_header() Output the email header
 */
do_action( 'woocommerce_email_header', $email_heading, $email ); ?>

<?php /* translators: %s: Customer billing full name */
if($order->get_formatted_billing_full_name() != '')
{ ?>
	<p><?php printf( __( 'You’ve received the following order from %s:', 'woocommerce' ), $order->get_formatted_billing_full_name() ); ?></p><?php // phpcs:ignore WordPress.XSS.EscapeOutput.OutputNotEscaped
}
else
{ ?>
	<p><?php printf( __( 'You’ve received the following order from %s:', 'woocommerce' ), $order->billing_email ); ?></p><?php	
} ?>
<?php

$items = $order->get_items();
$bkat=false;
foreach($items as $item)
{/*print_r($item['product_id']);*/
	$categorias=wp_get_post_terms($item['product_id'],'product_cat');
	$categoria=$categorias[0];
	if($categoria->term_id == 27 || $categoria->term_id == 53 || $categoria->term_id == 54 || $categoria->term_id == 55)
	{
		$bkat=true;
	}
}
if($bkat)
{ 
	$autoescuela=get_field('autoescuela',$item['product_id']);
	$autoescuela=$autoescuela[0];
	$fecha_inicio=date_create(get_field('fecha_inicio',$item['product_id']));
    $fecha_inicio=date_format($fecha_inicio,"j \d\e F");
	$fecha_fin=date_create(get_field('fecha_de_finalizacion',$item['product_id']));
    $fecha_fin=date_format($fecha_fin,"j \d\e F");
	$cupones=$order->get_used_coupons();
	$cupon=$cupones[0]; ?>
	Detalles del curso adquirido:<br />
    <ul>
    	<li><strong>Nombre del curso:</strong> <?php echo $item['name']; ?></li>
        <li><strong>Nombre autoescuela:</strong> <?php echo $autoescuela->post_title; ?></li>
        <li><strong>Fecha de inicio:</strong> <?php echo traduccion_fecha($fecha_inicio); ?></li>
        <li><strong>Fecha de fin:</strong> <?php echo traduccion_fecha($fecha_fin); ?></li>
        <li><strong>Horario:</strong> <?php the_field('horario_texto',$item['product_id']); ?></li>
    </ul>
	Tipo de pago:
	<ul><?php
		$order_notes=get_private_order_notes($order->ID);
		$es_payin7=false;
		foreach($order_notes as $note)
		{
			if(strpos($note['note_content'],'Payin7'))
			{
				$es_payin7=true;
			}
		}
		if($cupon == 'descuento-10-por-cien')
		{ ?>
        	<li><strong>PAGO CURSO COMPLETO</strong></li><?php
		}
		elseif($cupon == 'pagar-solo-matricula')
		{ ?>
        	<li><strong>PAGO MATRICULA DE CURSO</strong></li><?php
		}
		elseif($es_payin7)
		{ ?>
        	<li><strong>FINANCIACIÓN WANNME/PAYIN7</strong></li><?php
		} ?>
    </ul><?php
}

/*
 * @hooked WC_Emails::order_details() Shows the order details table.
 * @hooked WC_Structured_Data::generate_order_data() Generates structured data.
 * @hooked WC_Structured_Data::output_structured_data() Outputs structured data.
 * @since 2.5.0
 */
do_action( 'woocommerce_email_order_details', $order, $sent_to_admin, $plain_text, $email );

/*
 * @hooked WC_Emails::order_meta() Shows order meta data.
 */
do_action( 'woocommerce_email_order_meta', $order, $sent_to_admin, $plain_text, $email );

/*
 * @hooked WC_Emails::customer_details() Shows customer details
 * @hooked WC_Emails::email_address() Shows email address
 */
do_action( 'woocommerce_email_customer_details', $order, $sent_to_admin, $plain_text, $email );

/*
 * @hooked WC_Emails::email_footer() Output the email footer
 */
do_action( 'woocommerce_email_footer', $email );