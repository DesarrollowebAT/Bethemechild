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

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
/*if(current_user_can('administrator'))
{
	print_r(get_post_meta(get_the_id()));
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
<?php //print_r(get_post_meta(get_the_id())); ?>
<div <?php echo $product_schema; ?> id="product-<?php the_ID(); ?>" <?php post_class( $classes ); ?>>
	<div class="breadcrumbs">
    	<a href="<?php echo get_bloginfo('url'); ?>">Inicio</a> > <?php
		$autoescuela=get_field('autoescuela');
		$autoescuela=$autoescuela[0];
		$la_provincia=get_field('provincia',$autoescuela);
		$el_municipio=get_field('municipios_'.$la_provincia['value'],$autoescuela); /* ?>
        <a href="<?php echo get_permalink(woocommerce_get_page_id('shop')); ?>?s=&bkat=y&direccion_c=<?php echo $la_provincia['label']; ?>">Cursos en <?php echo $la_provincia['label']; ?></a> > <?php */
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
        	<a href="<?php echo get_permalink(woocommerce_get_page_id('shop')); ?>?s=&bkat=y&direccion_c=<?php echo $el_municipio['label'].', '.$la_provincia['label']; ?>">Cursos en <?php echo $el_municipio['label']; ?></a><?php
		} ?>
    </div>
	<div class="product_wrapper clearfix">
		<div class="column one-second autoescuela_info producto-mapa-pc">
			<div class="autoescuela_texto">
				<div class="imagen">
					<img src="<?php echo aq_resize(get_the_post_thumbnail_url($autoescuela->ID),130,0,true,true,true); ?>" />
				</div>
				<div class="titulos">
					<p class="pre_titulo">Autoescuela</p>
					<p class="titulo"><?php echo $autoescuela->post_title; ?></p>
				</div>
				<div class="descripcion"><?php
					echo $autoescuela->post_content; ?>
				</div>
				<ul class="detalles"><?php 
					 ?><?php
					if($la_provincia['label']!='' && $el_municipio['label'] !='')
					{ ?>                
						<li><span>Ubicación:</span> <?php echo $el_municipio['label'].', '.$la_provincia['label'] ?></li><?php
					}
					$la_direccion=get_field('mapa',$autoescuela); ?>
					<li><span>Dirección:</span> <?php echo $la_direccion['address']; ?></li><?php
					if(get_field('horario',$autoescuela))
					{ ?>
						<li><span>Horario:</span> <?php the_field('horario',$autoescuela); ?></li><?php
					} ?>
				</ul>
			</div>
            <div class="autoescuela_mapa"><?php 
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
        
        
        <div class="column one-second autoescuela_info producto-mapa-movil">
            <div class="autoescuela_mapa"><?php 
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
			<div class="autoescuela_texto"><?php
				$autoescuela=get_field('autoescuela');
				$autoescuela=$autoescuela[0]; ?>
				<div class="imagen">
					<img src="<?php echo aq_resize(get_the_post_thumbnail_url($autoescuela->ID),130,0,true,true,true); ?>" />
				</div>
				<div class="titulos">
					<p class="pre_titulo">Autoescuela</p>
					<p class="titulo"><?php echo $autoescuela->post_title; ?></p>
				</div>
				<div class="descripcion"><?php
					echo $autoescuela->post_content; ?>
				</div>
				<ul class="detalles"><?php 
					$la_provincia=get_field('provincia',$autoescuela);
					$el_municipio=get_field('municipios_'.$la_provincia['value'],$autoescuela); ?><?php
					if($la_provincia['label']!='' && $el_municipio['label'] !='')
					{ ?>                
						<li><span>Ubicación:</span> <?php echo $el_municipio['label'].', '.$la_provincia['label'] ?></li><?php
					}
					$la_direccion=get_field('mapa',$autoescuela); ?>
					<li><span>Dirección:</span> <?php echo $la_direccion['address']; ?></li><?php
					if(get_field('horario',$autoescuela))
					{ ?>
						<li><span>Horario:</span> <?php the_field('horario',$autoescuela); ?></li><?php
					} ?>
				</ul>
			</div>
		</div>
        
        
		<div class="summary entry-summary column one-second"><?php
			global $product;
			the_title( '<h1 class="product_title entry-title">', '</h1>' ); ?>
            <p class="price"><?php echo $product->get_price_html(); ?></p>
            <div class="descripcion"><?php the_content(); ?></div>
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
			<div class="formas_de_pago">
            	<h2 class="titulo">Elige cómo quieres matricularte</h2>
                <div class="elige-pago">
                    <div class="pago_completo">
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
                            <button type="submit" name="add-to-cart" value="<?php echo esc_attr( $product->get_id() ); ?>" class="el_boton payall">
                                <p class="descuento-diez">Paga todo el importe del curso ahora con un 10% de descuento</p>
                                
                                <p class="precio-diez">Precio final: <span><?php print_r(str_replace('.',',',(90*$product->get_price())/100)); ?>€</span></p>
                                <i class="fa fa-arrow-right" aria-hidden="true"></i>
                            </button><?php
                            do_action( 'woocommerce_after_add_to_cart_button' ); ?>
                        </form>
                    </div>
                    <div class="reserva">
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
                                <p class="matriculate">Paga solo la matricula y ahorra un 5%</p>
                                Matrícula: <span><?php print_r(str_replace('.',',', number_format((23.75*$product->get_price())/100,2))); ?>€</span>
                                <br /><br />
                                <p class="precio-final-producto">Precio final: <span><?php print_r(str_replace('.',',',number_format((95*$product->get_price())/100,2))); ?>€</span></p>
                                
                                <div class="recomendado">Recomendado</div>
                                <i class="fa fa-arrow-right" aria-hidden="true"></i>
                            </button><?php
                            do_action( 'woocommerce_after_add_to_cart_button' ); ?>
                        </form>
                    </div>
                	<div class="form_overlay" style="display:none;">
                		<div class="section_wrapper clearfix">
                			<a class="boton_cerrar" href="javascript:void(0);" onclick="hide_form_overlay();"><img src="<?php echo bloginfo('stylesheet_directory'); ?>/img/boton_cerrar.png" /></a>
                			<p>Por favor, rellena el siguiente formulario para poder reservar tu plaza sin descuento</p><?php
                            echo do_shortcode( '[contact-form-7 id="1085" title="Formulario Producto"]' ); ?>
                        </div>
                    </div>
                    <div class="solicita-informacion">
                        <button type="submit" href="javascript:void(0);" onclick="show_form_overlay();" value="" class="el_boton bookcourse">
                            Reserva tu plaza <span class="borrar-espacio"><br></span>
                            (sin descuento)
                            <br>
                            <p class="precio-sin-descuento">Precio final: <span><?php echo $product->get_price_html(); ?></span></p>
                            <i class="fa fa-arrow-right" aria-hidden="true"></i>
                        </button>
                    </div>
                </div>
                <span class="tasas">(los precios no incluyen las tasas, a pagar en el centro)</span>
                <div class="sequra">
                	<div class="titulo">Fináncialo con: <img src="<?php echo bloginfo('stylesheet_directory'); ?>/img/sequra.jpg" /></div>
                    <div class="detalles"></div>
                </div>
                <span>Este cálculo de cuotas es meramente informativo. Para financiar tu matrícula con Sequra, primero elige cómo matricularte y, durante el proceso de compra, elige Sequra como método de pago. En ese momento se formalizará el número de plazos y su coste.</span>
			</div><?php			
			/**
			 * woocommerce_single_product_summary hook.
			 *
			 * @hooked woocommerce_template_single_title - 5
			 * @hooked woocommerce_template_single_rating - 10
			 * @hooked woocommerce_template_single_price - 10
			 * @hooked woocommerce_template_single_excerpt - 20
			 * @hooked woocommerce_template_single_add_to_cart - 30
			 * @hooked woocommerce_template_single_meta - 40
			 * @hooked woocommerce_template_single_sharing - 50
			 * @hooked WC_Structured_Data::generate_product_data() - 60
			 */
			remove_action('woocommerce_single_product_summary','woocommerce_template_single_title',5);
			remove_action('woocommerce_single_product_summary','woocommerce_template_single_rating',10);
			remove_action('woocommerce_single_product_summary','woocommerce_template_single_price',10);
			remove_action('woocommerce_single_product_summary','woocommerce_template_single_excerpt',20);
			do_action( 'woocommerce_single_product_summary' ); ?>
            
            
			
			<?php 
				// Description | Default - right column
				if( in_array( $single_product_style, array( 'wide', 'wide tabs') ) ) {
					remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10);
				}
				
				remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15 );
				remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20);
			?>
			
			<?php
				/**
				 * woocommerce_after_single_product_summary hook.
				 *
				 * @hooked woocommerce_output_product_data_tabs - 10
				 * @hooked woocommerce_upsell_display - 15
				 * @hooked woocommerce_output_related_products - 20
				 */
				remove_action('woocommerce_after_single_product_summary','woocommerce_output_product_data_tabs',10);
				do_action( 'woocommerce_after_single_product_summary' );
			?>
	
		</div>
		
	</div>
	
	
	<?php 
		woocommerce_upsell_display();
		if( mfn_opts_get( 'shop-related' ) ) woocommerce_output_related_products(); 
	?>
	
	
	<?php if( version_compare( WC_VERSION, '2.7', '<' ) ): ?>
		<meta itemprop="url" content="<?php the_permalink(); ?>" />
	<?php endif; ?>


</div><!-- #product-<?php the_ID(); ?> -->

<?php do_action( 'woocommerce_after_single_product' ); ?>