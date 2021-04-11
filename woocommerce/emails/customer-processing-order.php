<?php
/**
 * Customer processing order email
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/emails/customer-processing-order.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates/Emails
 * @version     2.5.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$id_pedido=$email->object->data['id'];
$order = wc_get_order( $id_pedido );
$items = $order->get_items();
$bkat=false;
foreach($items as $item)
{
	$categorias=wp_get_post_terms($item['product_id'],'product_cat');
	$categoria=$categorias[0];
	if($categoria->term_id == 27 || $categoria->term_id == 53 || $categoria->term_id == 54 || $categoria->term_id == 55)
	{
		$bkat=true;
	}
}

if($bkat)/*$email->recipient == 'rhurtado@roiting.com' || $email->recipient == 'rohurmar@gmail.com')*/
{ ?>
	<div class="woocommerce-order-received">
    	<div id="Content" style="width:100%; background:#f4f4f4; overflow:auto;">
            <div class="thankyou_page_title" style="padding:2.5rem 0 0 0;">
                <div class="text" style="width:100%;text-align:center;">
                    <div class="main_title" style="color:#e85e02;font-size:2rem;line-height:2.5rem;">Muchas gracias por tu confianza</div>
                    <div class="sub_title" style="font-size:1rem;">¡Compra realizada con éxito!</div>
                </div>
            </div><?php
            foreach($items as $item)
            { ?>
                <div class="bkat_success_container" style="width:90%;background:#fff;border-radius:5px 5px 5px 5px;-moz-border-radius:5px 5px 5px 5px;-webkit-border-radius:5px 5px 5px 5px;padding:2.5rem;margin:2.5rem auto;">
                    <h2 style="color:#3C4150;font-weight:normal;font-size:25px;">Este es el resumen de tu curso:</h2><?php
                    $autoescuela=get_field('autoescuela',$item['product_id']);
                    $autoescuela=$autoescuela[0]; ?>
                    <div class="bloques_detalles" style="background:#EFF0F2;border-radius: 5px 5px 5px 5px;-moz-border-radius: 5px 5px 5px 5px;-webkit-border-radius: 5px 5px 5px 5px;display: flex;">
                        <div class="bloque detalles_autoescuela" style="width:28%;float:left;border-right:1px solid #fff;padding:1rem;">
                            <span class="nombre_autoescuela" style="font-weight:bold;color:#e85e02;"><?php echo $autoescuela->post_title; ?></span><br /><?php
                            $direccion=get_field('mapa',$autoescuela->ID); ?>
                            <span class="direccion_autoescuela"><?php echo $direccion['address']; ?></span>
                        </div>
                        <div class="bloque nombre_curso" style="width:20%;float:left;border-right:1px solid #fff;padding:1rem;">
                            <span class="title" style="font-weight:bold;color:#e85e02;">Nombre del curso:</span><br /><?php
                            echo $item['name']; ?>
                        </div>
                        <div class="bloque detalles_curso" style="width:36%;float:left;border-right:1px solid #fff;padding:1rem;">
                            <span class="title" style="font-weight:bold;">Horario:</span><br /><?php
                            echo get_field('horario_texto',$item['product_id']); ?><br />
                            <span class="title">Fecha de inicio:</span><br /><?php
                            $fecha=date_create(get_field('fecha_inicio',$item['product_id'])); $fecha=date_format($fecha,"j \d\e F"); echo traduccion_fecha($fecha); ?>
                        </div>
                        <div class="bloque precio" style="width:16%;float:left;border-right:1px solid #fff;padding:1rem;border-right:none;">
                            <span class="title" style="font-weight:bold;">Precio:</span><br /><?php
                            $_product = wc_get_product($item['product_id']);
                            echo $_product->get_price().'€'; ?>
                        </div>
                    </div>
                    <p style="clear:both;margin-top:2.5rem;font-size:1.2rem;">Academia del Transportista procesará tu compra y nos pondremos en contacto contigo a la mayor brevedad posible para informarte de los siguientes pasos a seguir para iniciar tu curso.</p>
                </div><?php
            } ?>
        </div>
    </div><?php
}
else
{
	/**
	 * @hooked WC_Emails::email_header() Output the email header
	 */
	do_action( 'woocommerce_email_header', $email_heading, $email ); ?>
	
	<p><?php _e( "Hemos recibido tu pedido y está siendo procesado. Aquí tienes los detalles de tu pedido:", 'woocommerce' ); ?></p><?php	
	/**
	 * @hooked WC_Emails::order_details() Shows the order details table.
	 * @hooked WC_Structured_Data::generate_order_data() Generates structured data.
	 * @hooked WC_Structured_Data::output_structured_data() Outputs structured data.
	 * @since 2.5.0
	 */	 
	do_action( 'woocommerce_email_order_details', $order, $sent_to_admin, $plain_text, $email );
	/**
	 * @hooked WC_Emails::order_meta() Shows order meta data.
	 */
	do_action( 'woocommerce_email_order_meta', $order, $sent_to_admin, $plain_text, $email );
	/**
	 * @hooked WC_Emails::customer_details() Shows customer details
	 * @hooked WC_Emails::email_address() Shows email address
	 */
	do_action( 'woocommerce_email_customer_details', $order, $sent_to_admin, $plain_text, $email );
	/**
	 * @hooked WC_Emails::email_footer() Output the email footer
	 */
	do_action( 'woocommerce_email_footer', $email );
}