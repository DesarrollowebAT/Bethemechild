<?php
/**
 * woocommerce_before_main_content hook.
 *
 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
 * @hooked woocommerce_breadcrumb - 20
 * @hooked WC_Structured_Data::generate_website_data() - 30
 */
do_action( 'woocommerce_before_main_content' );
if(have_posts())
{ 
	if($_GET['bkat']=='y')
	{
		$total=wc_get_loop_prop('total');
		if($total > 0)
		{ ?>
			<div class="search_resuts_count"><?php printf('Hemos encontrado %d cursos con esta búsqueda:', $total); ?></div><?php
		}
		else
		{ ?>
			<div class="search_resuts_count"><?php _e('Recibe más información','bkat'); ?></div><?php
		}
	} ?>
	<div class="zona_ubicacion">
    	<button class="accordion" style="display:none;">Ver Mapa</button>
    	<div class="mapa panel"><?php
			/* Comentamos el mapa REAL porque dicen que es "muy pobre" si solo muestra los resultados de la búsqueda (???)
        	<div class="acf-map listado">
				$autoescuelas_insertadas=array();
				while(have_posts())
				{
					the_post();
					$autoescuela = get_field('autoescuela',get_the_id());
					$autoescuela=$autoescuela[0];
					$la_direccion = get_field('mapa',$autoescuela->ID);
					if(!empty($la_direccion) && !in_array($autoescuela->post_title,$autoescuelas_insertadas))
					{ 
						$autoescuelas_insertadas[]=$autoescuela->post_title; ?>
                    	<div class="marker" data-lat="<?php echo $la_direccion['lat']; ?>" data-lng="<?php echo $la_direccion['lng']; ?>">
                        	<h4><?php echo $autoescuela->post_title; ?></h4>
                            <p class="address"><?php echo $la_direccion['address']; ?></p>
                        </div><?php	
					}
				} ?>
            </div> */ ?>
            <iframe src="https://www.google.com/maps/d/embed?mid=1LJM27goWTrtXP1J0I9J_JcM6Dy0&ll=36.27163839144053%2C-5.292713881249938&z=5" width="100%" height="600"></iframe>
        </div>
        <?php /*<div class="banner"><img src="<?php echo bloginfo('stylesheet_directory'); ?>/img/oferta-cap-inicial-y-renovacion-del-cap.jpg" /></div>*/ ?>
    </div>
	<div class="zona_cursos">
		<div class="zona_cursos_exclusive"><ul class="products grid"></ul></div>
        <div class="zona_cursos_premium"><ul class="products grid"></ul></div>
        <div class="zona_cursos_pro"><ul class="products grid"></ul></div>
        <div class="zona_cursos_destacados"><ul class="products grid"></ul></div>
		<div class="zona_cursos_resto"><?php
			woocommerce_product_loop_start();
			
			while(have_posts())
			{
				the_post();
				/**
				 * woocommerce_shop_loop hook.
				 *
				 * @hooked WC_Structured_Data::generate_product_data() - 10
				 */
				do_action( 'woocommerce_shop_loop' );
				wc_get_template_part( 'content', 'product-bkat' );
			} // end of the loop.
			woocommerce_product_loop_end(); ?>
        </div>
    </div><?php
	/**
	 * woocommerce_after_shop_loop hook.
	 *
	 * @hooked woocommerce_pagination - 10
	 */
	do_action( 'woocommerce_after_shop_loop' );
}
elseif(!woocommerce_product_subcategories(array('before' => woocommerce_product_loop_start(false), 'after' => woocommerce_product_loop_end(false))))
{
	/**
	 * woocommerce_no_products_found hook.
	 *
	 * @hooked wc_no_products_found - 10
	 */
	remove_action('woocommerce_no_products_found','wc_no_products_found',10); 
	do_action( 'woocommerce_no_products_found' );
	
	if($_GET['direccion_c'] != '')
	{ ?>
    	<script>
            var direccion = <?php echo json_encode($_GET['direccion_c']); ?>;
        </script><?php
	} ?>
    <div id="zero"><?php
		echo do_shortcode('[contact-form-7 id="1392" title="Formulario página sin resultados"]'); ?>
     </div><?php
}
/**
 * woocommerce_after_main_content hook.
 *
 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
 */
do_action( 'woocommerce_after_main_content' ); ?>