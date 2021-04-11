<?php
/**
 * Product Loop Start
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/loop/loop-start.php.
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
 * @version     2.0.0
 */

$shop_classes = array();

if( is_woocommerce() ){
	// Shop Layout aplies ONLY for archives page (Shop)
	
	if( ! is_product() ){
		
		// layout
		if( $_GET && key_exists( 'mfn-shop', $_GET ) ){
			$shop_layout = esc_html( $_GET[ 'mfn-shop' ] ); // demo
		} else {
			$shop_layout = mfn_opts_get( 'shop-layout', 'grid' );
		}
		$shop_classes[] = $shop_layout;
		
		// isotope
		if( $shop_layout == 'masonry' ) $shop_classes[] = 'isotope';
		
	}
	
}

$shop_classes = implode( ' ', $shop_classes );

$user=wp_get_current_user();
if((is_post_type_archive('product') || is_tax('product_cat',71) || is_tax('product_cat',72) || is_tax('product_cat',73)) && $_GET['bkat'] != 'y')/*current_user_can('administrator'))*/
{
	$subcategorias=get_terms(array(
		'taxonomy' => 'product_cat',
		'include' => array(71,72,73),
		'hide_empty' => false,
		'orderby' => 'term_id'
	));
	if($subcategorias)
	{ 
		if(is_post_type_archive('product'))
		{ ?>
            <ul class="otros_cursos_subcategorias dynamic_change">
                <li class="titulo"><?php _e('Filtrar por tipo de curso:','academiadeltransportista'); ?></li>
                <li class="first"><a class="active" href="#" datacategory="all" datalink="<?php echo get_permalink(woocommerce_get_page_id('shop')); ?>"><?php _e('Todos','academiadeltransportista'); ?></a></li><?php
                foreach($subcategorias as $subcategoria)
                { ?>
                    <li><a href="#" datacategory="<?php echo $subcategoria->term_id; ?>" datalink="<?php echo get_term_link($subcategoria); ?>"><?php echo $subcategoria->name; ?></a></li><?php
                } ?>
            </ul><?php
		}
		else
		{ ?>
            <ul class="otros_cursos_subcategorias">
                <li class="titulo"><?php _e('Filtrar por tipo de curso:','academiadeltransportista'); ?></li>
                <li class="first"><a <?php if(is_post_type_archive('product')){ ?>class="active"<?php } ?> href="<?php echo get_permalink(woocommerce_get_page_id('shop')); ?>"><?php _e('Todos','academiadeltransportista'); ?></a></li><?php
                foreach($subcategorias as $subcategoria)
                { ?>
                    <li><a <?php if(get_queried_object()->term_id == $subcategoria->term_id){ ?>class="active"<?php } ?> href="<?php echo get_term_link($subcategoria); ?>"><?php echo $subcategoria->name; ?></a></li><?php
                } ?>
            </ul><?php			
		}
	}
} ?>

<div class="products_wrapper isotope_wrapper <?php if(is_post_type_archive('product')){ echo 'archive-'.get_queried_object()->name; } ?> other-new"><?php
	if((is_post_type_archive('product') || is_tax('product_cat',71) || is_tax('product_cat',72) || is_tax('product_cat',73)) && $_GET['bkat'] != 'y')/*current_user_can('administrator'))*/
	{ ?>
    	<div class="product_archive_form">
        	<div class="white_box">
				<div class="title"><?php _e('¿Quieres más información sobre nuestros cursos?','academiadeltransportista'); ?></div><?php
				echo do_shortcode('[contact-form-7 id="21949" title="Formulario contacto otros cursos"]'); ?>
            </div>
		</div><?php		
	} ?>
	<ul class="products <?php echo $shop_classes; ?>">