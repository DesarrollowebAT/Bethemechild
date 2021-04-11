<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-single-product.php.
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
 * @version     3.0.0
 */
/*print_r(get_post_meta(get_the_id(),'fecha_inicio',true));*/
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
/*if(current_user_can('administrator'))
{
	$la_meta=get_post_meta(get_the_id());
	print_r($la_meta);
}*/
	/**
	 * woocommerce_before_single_product hook.
	 *
	 * @hooked wc_print_notices - 10
	 */
	do_action( 'woocommerce_before_single_product' );

	if ( post_password_required() ) {
		echo get_the_password_form();
		return;
	}


	// prev & next post -------------------
	$single_post_nav = array(
		'hide-header'	=> false,
		'hide-sticky'	=> false,
	);

	$opts_single_post_nav = mfn_opts_get( 'prev-next-nav' );
	if( is_array( $opts_single_post_nav ) ){

		if( isset( $opts_single_post_nav['hide-header'] ) ){
			$single_post_nav['hide-header'] = true;
		}
		if( isset( $opts_single_post_nav['hide-sticky'] ) ){
			$single_post_nav['hide-sticky'] = true;
		}

	}

	$post_prev = get_adjacent_post( false, '', true );
	$post_next = get_adjacent_post( false, '', false );

	// WC < 2.7 backward compatibility
	if( version_compare( WC_VERSION, '2.7', '<' ) ){
		$shop_page_id = woocommerce_get_page_id( 'shop' );
	} else {
		$shop_page_id = wc_get_page_id( 'shop' );
	}


	// post classes -----------------------
	$classes = array();

	if( mfn_opts_get( 'share' ) == 'hide-mobile' ){
		$classes[] = 'no-share-mobile';
	} elseif( ! mfn_opts_get( 'share' ) ) {
		$classes[] = 'no-share';
	}
	$classes[]='bkat-product';
	$classes[]='bkat2019v';

	$single_product_style = mfn_opts_get( 'shop-product-style' );
	$classes[] = $single_product_style;


	// translate
	$translate['all'] = mfn_opts_get('translate') ? mfn_opts_get('translate-all','Show all') : __('Show all','betheme');


	// WC < 2.7 backward compatibility
	if( version_compare( WC_VERSION, '2.7', '<' ) ){
		$product_schema = 'itemscope itemtype="'. woocommerce_get_product_schema() .'"';
	} else {
		$product_schema = '';
	}
?>
<?php /*if(current_user_can('administrator')){ print_r(get_post_meta(get_the_id())); }*/ ?>
<div <?php echo $product_schema; ?> id="product-<?php the_ID(); ?>" <?php post_class( $classes ); ?>>
	<div class="breadcrumbs">
    	<a href="<?php echo get_bloginfo('url'); ?>">Inicio</a> > <?php
		$autoescuela=get_field('autoescuela');
		$autoescuela=$autoescuela[0];
		$la_provincia=get_field('provincia',$autoescuela);
		$el_municipio=get_field('municipios_'.$la_provincia['value'],$autoescuela);
		$paginas = get_posts(array(
			'numberposts'	=> -1,
			'post_type'		=> 'page',
			'meta_query'	=> array(
				'relation' => 'AND',
				array(
					'key' => 'provincia',
					'value'	=> $la_provincia['value']
				),
				array(
					'key' => 'municipios_'.$la_provincia['value'],
					'value'	=> $el_municipio['value']
				)
			)
		));
		if($paginas)
		{ ?>
        	<a href="<?php echo get_permalink($paginas[0]->ID); ?>">Cursos en <?php echo $el_municipio['label']; ?></a><?php
		}
		else
		{ ?>
        	<a href="<?php echo get_permalink(woocommerce_get_page_id('shop')); ?>?s=&bkat=y&direccion_c=<?php echo $el_municipio['label'].', '.$la_provincia['label']; ?>" rel="nofollow">Cursos en <?php echo $el_municipio['label']; ?></a><?php
		} ?>
         > <?php the_title(); ?>
    </div><?php
	global $product; ?>
	<div class="product_wrapper">
    	<div class="info_block">
        	<div class="info_text">
				<div class="inner"><?php
					if(true)/*$_SERVER['REMOTE_ADDR']=='88.17.235.0')/*current_user_can('administrator'))*/
					{ ?>
                    	<div class="columna1"><?php
							the_title( '<h1 class="product_title entry-title">', '</h1>' );
							if(get_field('tipo_cap_inicial') != '')
							{ ?>
								<p style="margin-bottom:0;" class="tipo_curso"><?php the_field('tipo_cap_inicial'); ?></p><?php				
							}
							elseif(get_field('tipo_adr_texto') != '')
							{ ?>
								<p style="margin-bottom:0;" class="tipo_curso"><?php the_field('tipo_adr_texto'); ?></p><?php				
							}
							elseif(get_field('tipo_adr') != '')
							{ ?>
								<p style="margin-bottom:0;" class="tipo_curso"><?php the_field('tipo_adr'); ?></p><?php				
							}
							elseif(get_field('tipo_de_curso')!='')
							{ ?>
								<p style="margin-bottom:0;" class="tipo_curso"><?php the_field('tipo_de_curso'); ?></p><?php
							} ?>
                            <p class="price"><?php echo $product->get_price_html(); ?></p>
                            <div class="info_curso">
                                <ul class="detalles">
                                    <li><span class="title">Horario: </span><span class="horario"><?php the_field('horario_texto'); ?></span></li><?php
                                    $fecha=date_create(get_field('fecha_inicio'));
                                    $fecha=date_format($fecha,"j \d\e F"); ?>
                                    <li>
                                        <span class="title">Fecha de inicio del curso: </span><span class="fecha_inicio"><?php echo traduccion_fecha($fecha);
                                        if(get_field('hora_inicio') != '')
                                        { ?>
                                             a las <?php the_field('hora_inicio');
                                        } ?></span>
                                    </li><?php
                                    $fecha_fin=date_create(get_field('fecha_de_finalizacion'));
                                    $fecha_fin=date_format($fecha_fin,"j \d\e F"); ?>
                                    <li>
                                        <span class="title">Fecha de finalización del curso: </span><span class="fecha_fin"><?php echo traduccion_fecha($fecha_fin); ?></span>
                                    </li>
                                </ul>
                            </div>
                            <ul class="ventajas">
                            	<li><?php _e('Te garantizamos el <strong>mejor precio del mercado</strong>','academiadeltransportista'); ?></li>
                                <li><?php 
									_e('Por la compra de un curso, entrarás a formar parte del <strong>Club AT GRATIS</strong> y podrás:','academiadeltransportista'); ?>
                                    <ul>
                                    	<li><?php _e('Acceder a <strong>bolsa de empleo</strong> para conductores y transportistas','academiadeltransportista'); ?></li>
                                        <li><?php _e('<strong>Descuento</strong> en <strong>carburantes</strong>, contratación de <strong>seguros, cines y espectáculos</strong>','academiadeltransportista'); ?></li>
                                        <li><?php _e('Mantenerte informado de las <strong>novedades del sector</strong>.','academiadeltransportista'); ?></li>
                                    </ul>
                                </li>
                                
                            </ul>
                        </div>
                        <div class="columna2">
                            <div class="info_autoescuela">
                                <div class="logo_autoescuela"><?php
									if(get_current_user_id()==6)
									{ ?>
                                    	<a href="<?php echo get_permalink($autoescuela->ID); ?>">
                                        	<img src="<?php echo aq_resize(get_the_post_thumbnail_url($autoescuela->ID),130,0,true,true,true); ?>" />
                                        </a><?php
									}
									else
									{ ?>
	                                    <img src="<?php echo aq_resize(get_the_post_thumbnail_url($autoescuela->ID),130,0,true,true,true); ?>" /><?php
									} ?>
                                </div><?php
								if(true)/*get_current_user_id()==6)*/
								{ ?>
									<div class="nota_autoescuela"><?php
										get_star_rating($autoescuela->ID); ?>
									</div><?php
								}
								else
								{
                                	build_nota_block(get_nota_post($autoescuela->ID));
								} ?>
                                <div class="texto_autoescuela">
                                    <ul>
                                        <li class="title"><?php echo $autoescuela->post_title; ?></li><?php
                                        if($la_provincia['label']!='' && $el_municipio['label'] !='')
                                        { ?>
                                            <li class="ubicacion"><?php echo $el_municipio['label'].', <span class="provincia">'.$la_provincia['label'].'</span>'; ?></li><?php
                                        }
                                        $la_direccion=get_field('mapa',$autoescuela);
                                        if($la_direccion['address'] != '')
                                        { ?>
                                            <li><?php echo $la_direccion['address']; ?></li><?php
                                        }
                                        if(get_field('horario',$autoescuela))
                                        { ?>
                                            <li><span>Horario:</span> <?php the_field('horario',$autoescuela); ?></li><?php
                                        } ?>
                                    </ul>
                                </div>
                            </div>
                            <div class="buttons_container">
                                <a class="button_matricularme" href="#tipos_matricula">Quiero matricularme</a>
                                <a class="button_faq" href="#">Preguntas frecuentes</a>
                            </div>
						</div><?php
					}
					else
					{
						the_title( '<h1 class="product_title entry-title">', '</h1>' ); ?>
                        <p class="price"><?php echo $product->get_price_html(); ?></p>
                        <div class="info_autoescuela">
                            <div class="logo_autoescuela">
                                <img src="<?php echo aq_resize(get_the_post_thumbnail_url($autoescuela->ID),130,0,true,true,true); ?>" />
                            </div>
                            <div class="texto_autoescuela">
                                <ul>
                                    <li>Autoescuela: <?php echo $autoescuela->post_title; ?></li><?php
                                    if($la_provincia['label']!='' && $el_municipio['label'] !='')
                                    { ?>
                                        <li><span>Ubicación:</span> <?php echo $el_municipio['label'].', '.$la_provincia['label'] ?></li><?php
                                    }
                                    $la_direccion=get_field('mapa',$autoescuela);
                                    if($la_direccion['address'] != '')
                                    { ?>
                                        <li><span>Dirección:</span> <?php echo $la_direccion['address']; ?></li><?php
                                    }
                                    if(get_field('horario',$autoescuela))
                                    { ?>
                                        <li><span>Horario:</span> <?php the_field('horario',$autoescuela); ?></li><?php
                                    } ?>
                                </ul>
                            </div>
                        </div>
                        <div class="info_curso">
                            <ul class="detalles">
                                <li><span>Horario: </span><?php the_field('horario_texto'); ?></li><?php
                                $fecha=date_create(get_field('fecha_inicio'));
                                $fecha=date_format($fecha,"j \d\e F"); ?>
                                <li>
                                    <span>Fecha de inicio del curso: </span><?php echo traduccion_fecha($fecha);
                                    if(get_field('hora_inicio') != '')
                                    { ?>
                                         a las <?php the_field('hora_inicio');
                                    } ?>
                                </li><?php
                                $fecha_fin=date_create(get_field('fecha_de_finalizacion'));
                                $fecha_fin=date_format($fecha_fin,"j \d\e F"); ?>
                                <li>
                                    <span>Fecha de finalización del curso: </span><?php echo traduccion_fecha($fecha_fin); ?>
                                </li>
                            </ul>
                        </div>
                        <div class="buttons_container">
                            <a class="button_matricularme" href="#tipos_matricula">Quiero matricularme</a>
                            <a class="button_faq" href="#">Preguntas frecuentes</a>
                        </div><?php
					} ?>
                </div>
            </div>
            <div class="map"><?php
				if(!empty($la_direccion))
				{ ?>
                	<div class="acf-map">
                        <div class="marker" data-lat="<?php echo $la_direccion['lat']; ?>" data-lng="<?php echo $la_direccion['lng']; ?>">
                        	<h4><?php echo $autoescuela->post_title; ?></h4>
                            <p class="address"><?php echo $la_direccion['address']; ?></p>
                        </div>
                    </div><?php
				} ?>
            </div>
        </div>
        <div class="anchor_offset" id="tipos_matricula" name="tipos_matricula"></div><?php
		if(true)/*get_current_user_id() != 6)*/
		{ ?>
            <div class="book_block">
                <div class="single_block" id="reserva_plaza">
                    <div class="container">
                        <div class="pre-price">Reserva aquí tu plaza</div>
                        <div class="mini_reservation_form_container"><?php
                            echo do_shortcode('[contact-form-7 id="1085" title="Formulario Producto"]');
							if(get_current_user_id() == 6)
							{
								echo do_shortcode('[contact-form-7 id="72346" title="Formulario Producto_copy"]');
							} ?>
                        </div>
                    </div>
                </div>
                <div class="single_block" id="comprar_curso">
                    <div class="container">
                        <div class="pre-price">Precio pagando curso completo</div>
                        <div class="price"><?php print_r(str_replace(array('.00','.'),array('',','),number_format((90*$product->get_price())/100,2))); ?><sup>€</sup><span class="tasas">+tasas</span></div>
                        <div class="description">Paga todo el importe del curso ahora con un 10% de descuento</div>
                        <form class="cart" id="form_10" name="form_10" action="<?php echo esc_url(apply_filters('woocommerce_add_to_cart_form_action',$product->get_permalink())); ?>" method="post" enctype='multipart/form-data'><?php
                            do_action( 'woocommerce_before_add_to_cart_button' );
                            do_action( 'woocommerce_before_add_to_cart_quantity' );
                            woocommerce_quantity_input(array(
                                'min_value'   => apply_filters('woocommerce_quantity_input_min',$product->get_min_purchase_quantity(),$product),
                                'max_value'   => apply_filters('woocommerce_quantity_input_max',$product->get_max_purchase_quantity(),$product),
                                'input_value' => isset($_POST['quantity']) ? wc_stock_amount(wp_unslash($_POST['quantity'])) : $product->get_min_purchase_quantity(),
                            ));
                            do_action( 'woocommerce_after_add_to_cart_quantity' ); ?>
                            <input type="hidden" name="descuento_10" value="s" />
                            <button type="submit" name="add-to-cart" value="<?php echo esc_attr( $product->get_id() ); ?>" class="el_boton payall">Comprar curso</button><?php
                            do_action( 'woocommerce_after_add_to_cart_button' ); ?>
                        </form>
                    </div>
                </div>
                <?php /*<div class="single_block pago_recomendado" id="pagar_matricula">
                    <div class="container">
                        <div class="pre-price">Precio pagando <br />matrícula</div>
                        <div class="price"><?php print_r(str_replace(array('.00','.'),array('',','),number_format((95*$product->get_price())/100,2))); ?><sup>€</sup><span class="tasas">+tasas</span></div>
                        <div class="description">Ahorra un 5% sobre el precio total del curso y paga AHORA solo la matrícula.</div>
                        <form class="cart" id="form_25" name="form_25" action="<?php echo esc_url(apply_filters('woocommerce_add_to_cart_form_action',$product->get_permalink())); ?>" method="post" enctype='multipart/form-data'><?php
                            do_action( 'woocommerce_before_add_to_cart_button' );
                            do_action( 'woocommerce_before_add_to_cart_quantity' );
                            woocommerce_quantity_input(array(
                                'min_value'   => apply_filters('woocommerce_quantity_input_min',$product->get_min_purchase_quantity(),$product),
                                'max_value'   => apply_filters('woocommerce_quantity_input_max',$product->get_max_purchase_quantity(),$product),
                                'input_value' => isset($_POST['quantity']) ? wc_stock_amount(wp_unslash($_POST['quantity'])) : $product->get_min_purchase_quantity(),
                            ));
                            do_action( 'woocommerce_after_add_to_cart_quantity' ); ?>
                            <input type="hidden" name="pagar_25" value="s" />
                            <button type="submit" name="add-to-cart" value="<?php echo esc_attr( $product->get_id() ); ?>" class="el_boton" id="payregistration">
                                Matricular por <?php print_r(str_replace(array('.00','.'),array('',','), number_format((20*$product->get_price())/100,2))); ?>€
                            </button><?php
                            do_action( 'woocommerce_after_add_to_cart_button' ); ?>
                        </form>
                    </div>
                </div>*/ ?>
                <div class="single_block" id="financiar" price_value="<?php echo wc_format_decimal($product->get_price(),2); ?>">
                    <div class="container">
                        <div class="pre-price">Financia tu curso hasta en 12 meses</div>
                        <div class="price"><?php echo $product->get_price(); ?><sup>€</sup><span class="tasas">+tasas</span></div>
                        <div class="description">
                            <?php /*<div class="sequra">
                                <div class="titulo"><img src="<?php echo bloginfo('stylesheet_directory'); ?>/img/sequra.jpg" /></div>
                                <div class="detalles"></div>
                            </div>*/
							if(true)/*get_current_user_id() == 6)*/
							{ ?>
                            	Introduce tu correo electrónico y pulsa "Continuar". A continuación aparecerá el botón para financiar con WANNME<?php
							} ?>
                        </div>
                        <form class="cart" id="form_financia" name="form_financia" action="<?php echo esc_url(apply_filters('woocommerce_add_to_cart_form_action',$product->get_permalink())); ?>" method="post" enctype='multipart/form-data'><?php
                            do_action( 'woocommerce_before_add_to_cart_button' );
                            do_action( 'woocommerce_before_add_to_cart_quantity' );
                            woocommerce_quantity_input(array(
                                'min_value'   => apply_filters('woocommerce_quantity_input_min',$product->get_min_purchase_quantity(),$product),
                                'max_value'   => apply_filters('woocommerce_quantity_input_max',$product->get_max_purchase_quantity(),$product),
                                'input_value' => isset($_POST['quantity']) ? wc_stock_amount(wp_unslash($_POST['quantity'])) : $product->get_min_purchase_quantity(),
                            ));
							if(true)/*get_current_user_id() == 6)*/
							{ ?>
                            	<div class="wannme_container">
                                	<div class="wannme_mail_layer">
                                    	<div class="wannme_error" style="display:none;color:red;">Por favor, introduce tu email para continuar.</div>
                                    	<input name="email" placeholder="E-mail" /> <div class="continuar">Continuar</div>
                                    </div>
									<div id="wannme-create-payment" class="wannme-create-payment"></div>
								</div><?php
							}
							else
							{ ?>
                            	<div style="font-weight:bold;text-align:center;">En construcción</div><?php
							}
                            do_action( 'woocommerce_after_add_to_cart_quantity' ); ?>
                            <?php /*<input type="hidden" name="sequra_disponible" value="s" />
                            <button type="submit" name="add-to-cart" value="<?php echo esc_attr( $product->get_id() ); ?>" class="el_boton payall">Financiar curso</button><?php */
                            do_action( 'woocommerce_after_add_to_cart_button' ); ?>
                        </form>
                    </div>
                </div>
            </div><?php
		}
		else
		{ ?>
        	<div class="book_block version_2019">
                <div class="single_block" id="reserva_plaza">
                    <div class="container">
                        <div class="pre-price">Reserva tu plaza sin descuento</div>
                        <div class="mini_reservation_form_container"><?php
                            echo do_shortcode('[contact-form-7 id="1085" title="Formulario Producto"]'); ?>
                        </div>
                    </div>
                </div>
                <div class="single_block pago_recomendado" id="comprar_curso">
                    <div class="container">
                        <div class="pre-price">Precio pagando curso</div>
                        <div class="price"><?php print_r(str_replace(array('.00','.'),array('',','),number_format((90*$product->get_price())/100,2))); ?><sup>€</sup><span class="tasas">+tasas</span></div>
                        <div class="description">Paga todo el importe del curso ahora con un 10% de descuento</div>
                        <form class="cart" id="form_10" name="form_10" action="<?php echo esc_url(apply_filters('woocommerce_add_to_cart_form_action',$product->get_permalink())); ?>" method="post" enctype='multipart/form-data'><?php
                            do_action( 'woocommerce_before_add_to_cart_button' );
                            do_action( 'woocommerce_before_add_to_cart_quantity' );
                            woocommerce_quantity_input(array(
                                'min_value'   => apply_filters('woocommerce_quantity_input_min',$product->get_min_purchase_quantity(),$product),
                                'max_value'   => apply_filters('woocommerce_quantity_input_max',$product->get_max_purchase_quantity(),$product),
                                'input_value' => isset($_POST['quantity']) ? wc_stock_amount(wp_unslash($_POST['quantity'])) : $product->get_min_purchase_quantity(),
                            ));
                            do_action( 'woocommerce_after_add_to_cart_quantity' ); ?>
                            <input type="hidden" name="descuento_10" value="s" />
                            <button type="submit" name="add-to-cart" value="<?php echo esc_attr( $product->get_id() ); ?>" class="el_boton payall">Comprar curso</button><?php
                            do_action( 'woocommerce_after_add_to_cart_button' ); ?>
                        </form>
                    </div>
                </div>
                <div class="single_block" id="financiar">
                    <div class="container">
                        <div class="pre-price">Financiar</div>
                        <div class="price"><?php echo $product->get_price(); ?><sup>€</sup><span class="tasas">+tasas</span></div>
                        <div class="description">
                            <?php $WcPagantis = new WcPagantis(); $WcPagantis->pagantisAddProductSimulator(); ?>
                        </div>
                        <form class="cart" id="form_financia" name="form_financia" action="<?php echo esc_url(apply_filters('woocommerce_add_to_cart_form_action',$product->get_permalink())); ?>" method="post" enctype='multipart/form-data'><?php
                            do_action( 'woocommerce_before_add_to_cart_button' );
                            do_action( 'woocommerce_before_add_to_cart_quantity' );
                            woocommerce_quantity_input(array(
                                'min_value'   => apply_filters('woocommerce_quantity_input_min',$product->get_min_purchase_quantity(),$product),
                                'max_value'   => apply_filters('woocommerce_quantity_input_max',$product->get_max_purchase_quantity(),$product),
                                'input_value' => isset($_POST['quantity']) ? wc_stock_amount(wp_unslash($_POST['quantity'])) : $product->get_min_purchase_quantity(),
                            ));
                            do_action( 'woocommerce_after_add_to_cart_quantity' ); ?>
                            <input type="hidden" name="pagantis_disponible" value="s" />
                            <button type="submit" name="add-to-cart" value="<?php echo esc_attr( $product->get_id() ); ?>" class="el_boton payall">Financiar curso</button><?php
                            do_action( 'woocommerce_after_add_to_cart_button' ); ?>
                        </form>
                    </div>
                </div>
            </div><?php
		} ?>
</div><!-- #product-<?php the_ID(); ?> --><?php
do_action( 'woocommerce_after_single_product' ); ?>
