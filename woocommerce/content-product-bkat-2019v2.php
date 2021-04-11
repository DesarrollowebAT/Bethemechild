<?php
/**
 * The template for displaying product content within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 3.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product;

// Ensure visibility
if ( empty( $product ) || ! $product->is_visible() ) {
	return;
}

// Extra post classes ----------
$classes = array();
$classes[] = 'isotope-item';
$classes[] = 'bkat-item';

$es_curso_destacado=get_field('curso_destacado');
$es_curso_destacado=$es_curso_destacado[0];

if($es_curso_destacado == 'si')
{
	$classes[] = 'curso-destacado';
}

// Product type - Buttons ----------
if( ! $product->is_in_stock() || mfn_opts_get( 'shop-catalogue' ) || in_array( $product->get_type(), array( 'external', 'grouped', 'variable' ) ) ){

	$add_to_cart = false;
	$image_frame = false;

} else {

	/* developers: $product->get_id() @since WC 2.5 */

	if( $product->supports( 'ajax_add_to_cart' ) ){
		$add_to_cart = '<a rel="nofollow" href="'. apply_filters( 'add_to_cart_url', esc_url( $product->add_to_cart_url() ) ) .'" data-quantity="1" data-product_id="'. esc_attr( $product->get_id() ) .'" class="add_to_cart_button ajax_add_to_cart product_type_simple"><i class="icon-basket"></i></a>';
	} else {
		$add_to_cart = '<a rel="nofollow" href="'. apply_filters( 'add_to_cart_url', esc_url( $product->add_to_cart_url() ) ) .'" data-quantity="1" data-product_id="'. esc_attr( $product->get_id() ) .'" class="add_to_cart_button product_type_simple"><i class="icon-basket"></i></a>';
	}

	$image_frame = 'double';
}

//Recogemos la autoescuela de este curso
$autoescuela=get_field('autoescuela');
$autoescuela=$autoescuela[0];

$nivel_autoescuela=get_microsite_level($autoescuela);
switch($nivel_autoescuela)
{
	case 'pro':
		$classes[] = 'curso-pro';
		break;
	case 'premium':
		$classes[] = 'curso-premium';
		break;
	case 'exclusive':
		$classes[] = 'curso-exclusive';
		break;
}

?>
<li <?php post_class( $classes ); ?> autoescuela="<?php echo $autoescuela->post_title; ?>"><?php //padmin(get_post_meta(get_the_id())); ?>
	<div class="desc <?php if( ($_GET['fecha_fin'] != '') && ($_GET['fecha_fin'] < get_field('fecha_de_finalizacion')) ){ ?>fuera_de_fecha<?php } ?>"><?php
    	if($nivel_autoescuela == 'premium')
		{ ?>
        	<div class="icono_pulgar autoescuela_plata">
				<img src="<?php echo get_bloginfo('stylesheet_directory'); ?>/img/icono-autoescuela-plata.svg" />
				<div class="description"><?php _e('Esta autoescuela está calificada como <span>Autoescuela PLATA</span>','bkat'); ?></div>
            </div><?php
		}
		elseif($nivel_autoescuela == 'exclusive')
		{ ?>
        	<div class="icono_pulgar autoescuela_oro">
				<img src="<?php echo get_bloginfo('stylesheet_directory'); ?>/img/icono-autoescuela-oro.svg" />
				<div class="description"><?php _e('Esta autoescuela está calificada como <span>Autoescuela ORO</span>','bkat'); ?></div>
            </div><?php
		} ?>
		<div class="titulo_curso"><?php the_title(); ?></div><?php
    	if($es_curso_destacado == 'si'){ ?><div class="destacado-label"><p>Recomendado</p></div><?php } ?>
        <div class="texto_izquierda"><?php
			if(get_the_post_thumbnail_url($autoescuela->ID) != '')
			{ ?>
		        <img src="<?php echo aq_resize(get_the_post_thumbnail_url($autoescuela->ID),150,150,false,true,true); ?>" /><?php
			}
			else
			{
				echo file_get_contents(get_stylesheet_directory().'/img/microsites/logo-autoescuela-gen.svg');
			}
			$autoescuela=get_field('autoescuela',get_the_id());
			$autoescuela=$autoescuela[0];
			if(true)/*get_current_user_id()==6)*/
			{ ?>
				<div class="nota_autoescuela"><?php
					get_star_rating($autoescuela->ID); ?>
				</div><?php
			}
			else
			{
				build_nota_block(get_nota_post($autoescuela->ID));
			}
			 ?>
            <a class="cta_button" rel="nofollow" href="<?php the_permalink(); ?>"><span><?php _e('Reservar plaza','bkat'); ?></span></a>
        </div>
        <div class="texto"><?php
            $provincia=get_field('provincia',$autoescuela->ID);
            $municipio=get_field('municipios_'.$provincia['value'],$autoescuela->ID);
            if($provincia['label']!='' || $municipio['label']!='')
            { ?>
                <p class="ubicacion"><?php
                    if($provincia['label']!='')
                    { ?>
                        <span><?php echo $provincia['label']; ?> |</span> <?php
                    }
                    if($municipio['label']!='')
                    {
                        echo $municipio['label'];
                    } ?>
                </p><?php
            }
            if(get_field('horario_texto')!='')
            { ?>
                <p class="horario"><span>Horario:</span> <?php the_field('horario_texto'); ?></p><?php
            }
            $fecha=date_create(get_field('fecha_inicio'));
            $fecha=date_format($fecha,"j \d\e F");
            if(get_field('fecha_inicio')!='')
            { ?>
                <p class="fecha_inicio"><span>Fecha de inicio:</span> <span class="dia"><?php echo traduccion_fecha($fecha); ?></span><?php if(get_field('hora_inicio')!=''){ echo ' '.get_field('hora_inicio').' hrs.'; }?></p><?php
            }
			if(get_field('fecha_de_finalizacion')!='')
            {
				$fecha_fin=date_create(get_field('fecha_de_finalizacion'));
	            $fecha_fin=date_format($fecha_fin,"j \d\e F"); ?>
                <p class="fecha_fin"><span>Fecha de fin:</span> <?php echo traduccion_fecha($fecha_fin); ?></p><?php
            }
			if(get_field('tipo_cap_inicial') != '')
			{ ?>
                <p class="tipo_curso"><span>Tipo de curso:</span> <?php the_field('tipo_cap_inicial'); ?></p><?php				
			}
			elseif(get_field('tipo_adr_texto') != '')
			{ ?>
                <p class="tipo_curso"><span>Tipo de curso:</span> <?php the_field('tipo_adr_texto'); ?></p><?php				
			}
			elseif(get_field('tipo_adr') != '')
			{ ?>
                <p class="tipo_curso"><span>Tipo de curso:</span> <?php the_field('tipo_adr'); ?></p><?php				
			}
			elseif(get_field('tipo_de_curso')!='')
            { ?>
                <p class="tipo_curso"><span>Tipo de curso:</span> <?php the_field('tipo_de_curso'); ?></p><?php
            } ?>
            <?php //echo do_shortcode('[gdrts_stars_rating_auto]');
            /**
             * woocommerce_after_shop_loop_item_title hook.
             *
             * @hooked woocommerce_template_loop_rating - 5
             * @hooked woocommerce_template_loop_price - 10
             */
            do_action( 'woocommerce_after_shop_loop_item_title' ); ?>
            <span class="tasas">(+ tasas a pagar en el centro)</span>
        </div><?php
		if( ($_GET['fecha_fin'] != '') && ($_GET['fecha_fin'] < get_field('fecha_de_finalizacion')) )
		{ ?>
			<span class="fuera_de_fecha_banner"><span>Atención:</span> Tu renovación está fuera de plazo</span><?php
		} ?>
	</div><?php
	/**
	 * woocommerce_after_shop_loop_item hook.
	 *
	 * @hooked woocommerce_template_loop_product_link_close - 5
	 * @hooked woocommerce_template_loop_add_to_cart - 10
	 */
	remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5);
	if( ! mfn_opts_get('shop-button') ){
		remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10);
	}
	do_action( 'woocommerce_after_shop_loop_item' ); ?>
</li>
