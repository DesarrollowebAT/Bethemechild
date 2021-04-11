<?php
/**
 * Thankyou page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/thankyou.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.2.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<div class="steps_container">
    <ul class="steps">
        <li class="step"><span class="number_container">1</span></li>
        <li class="step"><span class="number_container">2</span></li>
        <li class="step active"><span class="number_container">3</span></li>
    </ul>
    <ul class="steps_titles">
    	<li class="step_text" id="step_text_one"><?php _e('Carrito'); ?></li>
        <li class="step_text" id="step_text_two"><?php _e('Detalles de Facturación'); ?></li>
        <li class="step_text active" id="step_text_three"><?php _e('Finalización de compra'); ?></li>
    </ul>
</div>
<div class="clear"></div>
<div class="woocommerce-order">

	<?php if ( $order ) : ?>

		<?php if ( $order->has_status( 'failed' ) ) : ?>

			<p class="woocommerce-notice woocommerce-notice--error woocommerce-thankyou-order-failed"><?php _e( 'Unfortunately your order cannot be processed as the originating bank/merchant has declined your transaction. Please attempt your purchase again.', 'woocommerce' ); ?></p>

			<p class="woocommerce-notice woocommerce-notice--error woocommerce-thankyou-order-failed-actions">
				<a href="<?php echo esc_url( $order->get_checkout_payment_url() ); ?>" class="button pay"><?php _e( 'Pay', 'woocommerce' ) ?></a>
				<?php if ( is_user_logged_in() ) : ?>
					<a href="<?php echo esc_url( wc_get_page_permalink( 'myaccount' ) ); ?>" class="button pay"><?php _e( 'My account', 'woocommerce' ); ?></a>
				<?php endif; ?>
			</p>

		<?php else : 
			$bkat=true;
			/*if(current_user_can('administrator'))
			{*/ ?>
            	<div class="thankyou_page_title">
                	<div class="text">
	                    <div class="main_title">Muchas gracias por tu confianza</div>
    	                <div class="sub_title">¡Compra realizada con éxito!</div>
                    </div>
                </div><?php
				$items=$order->get_items();
				foreach($items as $item)
				{
					$categorias=wp_get_post_terms($item['product_id'],'product_cat');
					$categoria=$categorias[0];
					if($categoria->term_id == 27 || $categoria->term_id == 53 || $categoria->term_id == 54 || $categoria->term_id == 55)
					{ ?>
                    	<div class="bkat_success_container">
							<h2>Este es el resumen de tu curso:</h2><?php
							$autoescuela=get_field('autoescuela',$item['product_id']);
							$autoescuela=$autoescuela[0]; ?>
                            <div class="bloques_detalles">
                            	<div class="bloque logo"><img src="<?php echo get_the_post_thumbnail_url($autoescuela->ID); ?>" /></div>
                                <div class="bloque detalles_autoescuela">
                                	<span class="nombre_autoescuela"><?php echo $autoescuela->post_title; ?></span><br /><?php
                                    $direccion=get_field('mapa',$autoescuela->ID); ?>
                                    <span class="direccion_autoescuela"><?php echo $direccion['address']; ?></span>
                                </div>
                                <div class="bloque nombre_curso">
                                	<span class="title">Nombre del curso:</span><br /><?php
                                    echo $item['name']; ?>
                                </div>
                                <div class="bloque detalles_curso">
                                	<span class="title">Horario:</span><br /><?php
                                    echo get_field('horario_texto',$item['product_id']); ?><br />
                                    <span class="title">Fecha de inicio:</span><br /><?php
									$fecha=date_create(get_field('fecha_inicio',$item['product_id'])); $fecha=date_format($fecha,"j \d\e F"); echo traduccion_fecha($fecha); ?>
                                </div>
                                <div class="bloque precio">
									<span class="title">Precio:</span><br /><?php
									$_product = wc_get_product($item['product_id']);
									echo $_product->get_price().'€'; ?>
                                </div>
                            </div>
                            <p>Academia del Transportista procesará tu compra y nos pondremos en contacto contigo a la mayor brevedad posible para informarte de los siguientes pasos a seguir para iniciar tu curso.</p>
                        </div><?php
					}
					else
					{
						$bkat=false;
					}
				}
			/*}*/
			if(!$bkat)
			{ ?>

                <p class="woocommerce-notice woocommerce-notice--success woocommerce-thankyou-order-received"><?php echo apply_filters( 'woocommerce_thankyou_order_received_text', __( 'Thank you. Your order has been received.', 'woocommerce' ), $order ); ?></p>
    
                <ul class="woocommerce-order-overview woocommerce-thankyou-order-details order_details">
    
                    <li class="woocommerce-order-overview__order order">
                        <?php _e( 'Order number:', 'woocommerce' ); ?>
                        <strong><?php echo $order->get_order_number(); ?></strong>
                    </li>
    
                    <li class="woocommerce-order-overview__date date">
                        <?php _e( 'Date:', 'woocommerce' ); ?>
                        <strong><?php echo wc_format_datetime( $order->get_date_created() ); ?></strong>
                    </li>
    
                    <?php if ( is_user_logged_in() && $order->get_user_id() === get_current_user_id() && $order->get_billing_email() ) : ?>
                        <li class="woocommerce-order-overview__email email">
                            <?php _e( 'Email:', 'woocommerce' ); ?>
                            <strong><?php echo $order->get_billing_email(); ?></strong>
                        </li>
                    <?php endif; ?>
    
                    <li class="woocommerce-order-overview__total total">
                        <?php _e( 'Total:', 'woocommerce' ); ?>
                        <strong><?php echo $order->get_formatted_order_total(); ?></strong>
                    </li>
    
                    <?php if ( $order->get_payment_method_title() ) : ?>
                        <li class="woocommerce-order-overview__payment-method method">
                            <?php _e( 'Payment method:', 'woocommerce' ); ?>
                            <strong><?php echo wp_kses_post( $order->get_payment_method_title() ); ?></strong>
                        </li>
                    <?php endif; ?>
    
                </ul><?php
			} ?>

		<?php endif;
		
		if(!$bkat)
		{
			do_action( 'woocommerce_thankyou_' . $order->get_payment_method(), $order->get_id() );
			do_action( 'woocommerce_thankyou', $order->get_id() );
		} ?>

	<?php else : ?>

		<p class="woocommerce-notice woocommerce-notice--success woocommerce-thankyou-order-received"><?php echo apply_filters( 'woocommerce_thankyou_order_received_text', __( 'Thank you. Your order has been received.', 'woocommerce' ), null ); ?></p>

	<?php endif; ?>

</div>
