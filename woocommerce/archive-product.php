<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
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

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

get_header( 'shop' ); ?>

<?php 
if($_GET['bkat']=='y')
{ ?>
	<?php /*<div class="inner_search_form">
		<div class="section_wrapper clearfix"><?php get_template_part('template-parts/search-form'); ?></div>
	</div>*/
	$user=wp_get_current_user();
	if(true)/*$user->data->ID==6)/*current_user_can('administrator'))*/
	{
		wc_get_template_part('bkat-search-results-2019');
	}
	else
	{ ?>
    	<div class="inner_sort_form">
            <div class="section_wrapper clearfix"><?php get_template_part('template-parts/sort-form'); ?></div>
        </div><?php
		wc_get_template_part('bkat-search-results');
	}
}
else
{ 
	/**
	 * woocommerce_before_main_content hook.
	 *
	 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
	 * @hooked woocommerce_breadcrumb - 20
	 * @hooked WC_Structured_Data::generate_website_data() - 30
	 */
	do_action( 'woocommerce_before_main_content' ); ?>
    <header class="woocommerce-products-header"><?php
    	if ( is_shop() || is_tax('product_cat',71) || is_tax('product_cat',72) || is_tax('product_cat',73) ) 
		{ ?>
			<h1 class="woocommerce-products-header__title page-title titulo-cursos-online">Cursos para Transportistas</h1>
			<div class="page-subtitle"><?php _e('Más de 100 cursos especializados para ti','academiadeltransportista'); ?></div><?php 
		}
		if(get_queried_object()->term_id == 17)
		{ ?>
        	<h1 class="titulo-cursos-online">Cursos Online para Transportistas y Conductores Profesionales</h1><?php
		}
		elseif(get_queried_object()->term_id == 18)
		{ ?>
        	<h1 class="titulo-cursos-online">Cursos Presenciales para Transportistas y Conductores Profesionales</h1><?php
		}
		/**
		 * woocommerce_archive_description hook.
		 *
		 * @hooked woocommerce_taxonomy_archive_description - 10
		 * @hooked woocommerce_product_archive_description - 10
		 */
		do_action( 'woocommerce_archive_description' ); ?>
    </header><?php
    if(have_posts())
	{ ?>
    	<div class="shop-filters"><?php
			/**
			 * woocommerce_before_shop_loop hook.
			 *
			 * @hooked woocommerce_result_count - 20
			 * @hooked woocommerce_catalog_ordering - 30
			 */
			remove_action('woocommerce_before_shop_loop','woocommerce_result_count',20);
			remove_action('woocommerce_before_shop_loop','woocommerce_catalog_ordering',30);
			do_action('woocommerce_before_shop_loop'); ?>
		</div><?php 
		woocommerce_product_loop_start();
		woocommerce_product_subcategories();
		while(have_posts())
		{
			the_post();
			/**
			 * woocommerce_shop_loop hook.
			 *
			 * @hooked WC_Structured_Data::generate_product_data() - 10
			 */
			do_action( 'woocommerce_shop_loop' );
			wc_get_template_part( 'content', 'product' );
		} // end of the loop.
		woocommerce_product_loop_end();
		/**
		 * woocommerce_after_shop_loop hook.
		 *
		 * @hooked woocommerce_pagination - 10
		 */
		do_action( 'woocommerce_after_shop_loop' );
        if(get_queried_object()->term_id == 17)
		{ ?>
        	<div style="text-align:center;margin-top: 50px;">
            	<p class="texto-web">La oferta de <b>cursos Online de Academia del Transportista</b> es muy variada, pudiendo encontrar cursos de diferentes especialidades dentro del sector del transporte. </p>
            
            	<p class="texto-web">Si quieres trabajar como <b>conductor</b>, o en cualquier otro trabajo relacionado con el sector del <b>transporte</b>, las posibilidades laborales que vas a tener van a aumentar considerablemente después de formarte en Academia del Transportista. Nuestros especialistas están a tu disposición para ayudarte a tomar la decisión adecuada.</p>
            
            	<p class="texto-web">Además, sabemos la dificultad de encontrar tiempo actualmente para estudiar, por eso, con nuestros <b>cursos online para transportistas</b>, tienes la posibilidad de organizarte como mejor te convenga para poder obtener el curso que desees. Tendrás a tu disposición una plataforma donde realizar <b>tests</b> y practicar cuanto necesites. Lo tenemos todo pensado para que nuestros alumnos puedan sacarse el curso que deseen con la mayor facilidad posible.</p>
            
            	<p class="texto-web" style="color:#e85e02;">Conoce la <b>oferta de cursos online para conductores y transportistas</b> de la plataforma online de Academia del transportista. En caso de que no encuentres lo que buscas, ponte en contacto con nosotros, seguro que tenemos la mejor opción para lo que necesitas.</p>
            </div><?php
		}
		elseif(get_queried_object()->term_id == 18)
		{ ?>
        	<div style="text-align:center;margin-top: 50px;">
            <p class="texto-web">En Academia del Transportista vas a poder encontrar los <b>cursos presenciales para transportistas</b> más importantes y necesarios del momento.</p>
            
            <p class="texto-web">Entre ellos encontrarás el <b>CAP</b>, en el que podrás realizar el curso para obtenerlo por primera vez (<b>CAP Inicial</b>), o bien el curso para renovarlo (<b>CAP Continua</b>). También ofrecemos los diferentes cursos de <b>ADR,</b> bien lo quieras renovar u obtener por primera vez, diferenciados por categorías (cisternas, explosivos, radiactivos), y muchos más.</p>
            
            <p class="texto-web">Una de las ventajas de Academia del Trasportista, es que existen más de 1000 centros repartidos por toda España, por eso es muy probable que puedas encontrar una de nuestras Academias cerca de tu casa. Madrid, Barcelona, Valencia, Sevilla, Bilbao, Alicante, Teruel, Valladolid o Zaragoza son solo algunas de las ciudades donde nos podrás encontrar.</p>
            
            <p class="texto-web">Además, en Academia del Transportista se apuesta por la última tecnología en el sector del transporte, por eso, podrás disfrutar de una educación presencial de una gran calidad.</p>
            
            <p class="texto-web" style="color:#e85e02;">Si tu deseo es dedicarte profesionalmente al sector del transporte, acudir a uno de los centros de Academia del Transportista para realizar uno de los <b>cursos presenciales para conductores y transportistas</b>, será una decisión que pueda marcar un antes y un después en tu vida laboral. Cada vez es más importante tener una buena formación, y el sector de la conducción y el transporte no es una excepción.</p>
            </div><?php			
		}
	}
	elseif(!woocommerce_product_subcategories(array('before' => woocommerce_product_loop_start(false), 'after' => woocommerce_product_loop_end(false))))
	{
		// WC < 2.7 backward compatibility
		if(version_compare(WC_VERSION, '2.7', '<'))
		{
			wc_get_template( 'loop/no-products-found.php' );
					
		}
		else
		{
			/**
			 * woocommerce_no_products_found hook.
			 *
			 * @hooked wc_no_products_found - 10
			 */
			do_action( 'woocommerce_no_products_found' );
		}
	}
	/**
	 * woocommerce_after_main_content hook.
	 *
	 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
	 */
	do_action( 'woocommerce_after_main_content' );
	/**
	 * woocommerce_sidebar hook.
	 *
	 * @hooked woocommerce_get_sidebar - 10
	 */
	do_action( 'woocommerce_sidebar' );
}
$categoria=get_queried_object();
if($_GET['bkat'] != 'y' && $categoria->term_id !=18 && $categoria->term_id !=17) 
{ ?>
	<div class="section_wrapper clearfix"><?php
		the_field('texto_tienda',97); ?>
    </div><?php
}

get_footer( 'shop' ); ?>