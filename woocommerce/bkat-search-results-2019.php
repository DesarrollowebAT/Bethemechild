<?php
/**
 * woocommerce_before_main_content hook.
 *
 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
 * @hooked woocommerce_breadcrumb - 20
 * @hooked WC_Structured_Data::generate_website_data() - 30
 */
do_action( 'woocommerce_before_main_content' ); ?>
<div class="bkat_search_results_2019">
	<div class="mobile_bkat_menu_container" style="display:none;">
    	<a href="#" class="menu_element" id="filtrar"><span><?php _e('Filtrar','bkat'); ?></span></a>
        <a href="#" class="menu_element" id="ordenar"><span><?php _e('Ordenar','bkat'); ?></span></a>
        <a href="#" class="menu_element" id="mapa"><span><?php _e('Mapa','bkat'); ?></span></a>
        <div class="clear"></div>
        <div class="content_element" id="content_element_filtrar"></div>
        <div class="content_element" id="content_element_ordenar"></div>
        <div class="content_element" id="content_element_mapa"></div>
        <div class="clear"></div>
    </div><?php
	if(have_posts())
	{ 
		if($_GET['bkat']=='y')
		{
			$total=wc_get_loop_prop('total');
			if($total > 0)
			{ ?>
				<div class="search_resuts_count"><?php printf('Hemos encontrado <span>%d</span> cursos para ti.', $total); ?></div>
				<div class="post_search_resuts_count"><?php _e('Reserva tu plaza pinchando en el curso que más se ajuste a tus necesidades.','bkat'); ?></div><?php
			}
			else
			{ ?>
				<div class="search_resuts_count"><?php _e('Recibe más información','bkat'); ?></div><?php
			}
		} ?>
		<div class="bkat_container">
			<div class="zona_filtro">
				<div class="title"><?php _e('Utiliza los siguientes filtros para encontrar el curso que más se adapte a tus intereses','bkat'); ?></div>
				<form method="get" action="<?php echo get_permalink(97); ?>">
					<input type="hidden" value="" id="s" name="s">
		            <input type="hidden" value="y" id="bkat" name="bkat">
					<input type="hidden" value="<?php echo $_GET['direccion_c']; ?>" id="direccion_c" name="direccion_c">
					<input type="hidden" value="<?php echo $_GET['provincia']; ?>" id="provincia" name="provincia"><?php
					if($_GET['orderby'] != '')
					{ ?>
						<input type="hidden" value="<?php echo $_GET['orderby']; ?>" id="orderby" name="orderby"><?php
					}
					$prices=custom_get_filtered_price();
					$min = floor( $prices->min_price );
					$max = ceil( $prices->max_price );
					$current_min = isset( $_GET['min_price'] ) ? wc_clean( wp_unslash( $_GET['min_price'] ) ) : apply_filters( 'woocommerce_price_filter_widget_min_amount', $min );
					$current_max = isset( $_GET['max_price'] ) ? wc_clean( wp_unslash( $_GET['max_price'] ) ) : apply_filters( 'woocommerce_price_filter_widget_max_amount', $max );
					$min_price=apply_filters( 'woocommerce_price_filter_widget_min_amount', $min );
					$max_price=apply_filters( 'woocommerce_price_filter_widget_max_amount', $max );
					
					$price_range=array('min_price' => $min_price,'max_price' => $max_price,'current_min' => $current_min,'current_max' => $current_max); ?>
					<script>
						var price_range = <?php echo json_encode($price_range); ?>;
					</script>
                    <input type="hidden" value="" id="min_price" name="min_price">
                    <input type="hidden" value="" id="max_price" name="max_price">
                    <div class="elemento">
                    	<div class="elemento_title"><?php _e('Precio','bkat'); ?></div>
	                    <div class="slider_container">
    	                    <div id="slider-range"></div>
        	            </div>
                        <input type="text" id="amount" readonly>
                    </div>
                    <div class="elemento radio">
                    	<div class="elemento_title"><?php _e('Tipo de curso','bkat'); ?></div>
                    	<input type="radio" name="tipo_curso" value="28" <?php if($_GET['tipo_curso'] == 28){ ?>checked="checked"<?php } ?>> <span>CAP Inicial</span><br />
						<input type="radio" name="tipo_curso" value="29" <?php if($_GET['tipo_curso'] == 29){ ?>checked="checked"<?php } ?>> <span>CAP Continua</span><br />
						<input type="radio" name="tipo_curso" value="30" <?php if($_GET['tipo_curso'] == 30){ ?>checked="checked"<?php } ?>> <span>ADR Obtención</span><br />
                        <input type="radio" name="tipo_curso" value="31" <?php if($_GET['tipo_curso'] == 31){ ?>checked="checked"<?php } ?>> <span>ADR Renovación</span><br />
                    </div>
                    <div class="elemento radio">
	                    <div class="elemento_title"><?php _e('Turno','bkat'); ?></div>
                        <input type="radio" name="turno" value="" <?php if($_GET['turno'] == ''){ ?>checked="checked"<?php } ?>>Todos<br />
                        <input type="radio" name="turno" value="mananas" <?php if($_GET['turno'] == 'mananas'){ ?>checked="checked"<?php } ?>><span>Mañanas</span><br />
                        <input type="radio" name="turno" value="tardes" <?php if($_GET['turno'] == 'tardes'){ ?>checked="checked"<?php } ?>><span>Tardes</span><br />
                        <input type="radio" name="turno" value="findesemana" <?php if($_GET['turno'] == 'findesemana'){ ?>checked="checked"<?php } ?>><span>Fin de semana</span><br />
                    </div>
                    <div class="send_button_container">
	                    <input type="submit" value="Filtrar" />
                    </div>
                </form>
			</div>
			<div class="zona_resultados">
				<div class="sort_form"><?php get_template_part('template-parts/sort-form'); ?></div>
				<div class="zona_cursos">
					<div class="cursos_container zona_cursos_exclusive" style="display:none;"><ul class="products grid"></ul></div>
					<div class="cursos_container zona_cursos_premium" style="display:none;"><ul class="products grid"></ul></div>
					<div class="cursos_container zona_cursos_pro" style="display:none;"><ul class="products grid"></ul></div>
					<div class="cursos_container zona_cursos_destacados" style="display:none;"><ul class="products grid"></ul></div>
					<div class="cursos_container zona_cursos_resto"><?php
						woocommerce_product_loop_start();
						
						$autoescuelas_encontradas_otras_provincias=array();
						
						while(have_posts())
						{
							the_post();
							
							if($wp_query->query_vars['primer_curso_radio'] == get_the_id())
							{ 
								woocommerce_product_loop_end(); ?>
                            	</div>
                                <div class="cursos_container zona_cursos_radio_exclusive" style="display:none;"><ul class="products grid"></ul></div>
								<div class="cursos_container zona_cursos_radio_premium" style="display:none;"><ul class="products grid"></ul></div>
								<div class="cursos_container zona_cursos_radio_pro" style="display:none;"><ul class="products grid"></ul></div>
								<div class="cursos_container zona_cursos_radio_destacados" style="display:none;"><ul class="products grid"></ul></div>
                                <div class="cursos_container zona_cursos_radio_resto"><?php
								woocommerce_product_loop_start();
							}
							
							$autoescuela=get_field('autoescuela',get_the_id());
							
							$provincia_actual=get_field('provincia_texto',$autoescuela[0]->ID);
							
							if($_GET['places_locality'] != 'Las Palmas' && $_GET['provincia'] != 'Castellón')
							{
								/* HARD CODED: Evitamos esto si estamos en Las Palmas, Castellón */
								if($provincia_actual != $_GET['provincia'] && !in_array($autoescuela[0]->ID,$autoescuelas_encontradas_otras_provincias))
								{
									$autoescuelas_encontradas_otras_provincias[]=$autoescuela[0]->ID;
								}
							}
							
							/**
							 * woocommerce_shop_loop hook.
							 *
							 * @hooked WC_Structured_Data::generate_product_data() - 10
							 */
							do_action( 'woocommerce_shop_loop' );
							
							wc_get_template_part( 'content', 'product-bkat-2019v2' );
						} // end of the loop.
						woocommerce_product_loop_end(); ?>
					</div>
				</div>
				<div class="zona_ubicacion"><?php
					$provincia_cod=get_provincia_cod($_GET['provincia']);
					if($_GET['places_locality']=='Las Palmas' && $_GET['provincia'] == 'Castellón')
					{
						/* HARD CODED: Si estamos en Las Palmas, Castellón, redirigimos a la provincia de Las Palmas */
						$provincia_cod=35;
					}
                	$autoescuelas=get_posts(array(
						'post_type' => 'autoescuela',
						'numberposts' => -1,
						'meta_key' => 'provincia',
						'meta_value' => $provincia_cod,
						'compare' => 'NUMERIC'
					)); ?>
					<div class="acf-map listado"><?php
						$autoescuelas_insertadas=array();
						foreach($autoescuelas as $autoescuela)
						{
							$la_direccion = get_field('mapa',$autoescuela->ID);
							if(!empty($la_direccion) && !in_array($autoescuela->post_title,$autoescuelas_insertadas))
							{ 
								if(autoescuela_tiene_cursos($autoescuela)=='si')
								{ ?>
                                    <div class="marker" data-lat="<?php echo $la_direccion['lat']; ?>" data-lng="<?php echo $la_direccion['lng']; ?>">
                                        <h4><?php echo $autoescuela->post_title; ?></h4>
                                        <p class="address"><?php echo $la_direccion['address']; ?></p>
                                    </div><?php	
								}
								else
								{ ?>
                                    <div class="marker_empty" data-lat="<?php echo $la_direccion['lat']; ?>" data-lng="<?php echo $la_direccion['lng']; ?>">
                                        <h4><?php echo $autoescuela->post_title; ?></h4>
                                        <p class="address"><?php echo $la_direccion['address']; ?></p>
                                    </div><?php	
								}
							}
						}
						if($autoescuelas_encontradas_otras_provincias)
						{
							$autoescuelas_otras_provincias=get_posts(array(
								'post_type' => 'autoescuela',
								'numberposts' => -1,
								'include' => $autoescuelas_encontradas_otras_provincias
							));
							foreach($autoescuelas_otras_provincias as $autoescuela)
							{
								$la_direccion = get_field('mapa',$autoescuela->ID);
								if(!empty($la_direccion) && !in_array($autoescuela->post_title,$autoescuelas_insertadas))
								{ ?>
									<div class="marker" data-lat="<?php echo $la_direccion['lat']; ?>" data-lng="<?php echo $la_direccion['lng']; ?>">
										<h4><?php echo $autoescuela->post_title; ?></h4>
										<p class="address"><?php echo $la_direccion['address']; ?></p>
									</div><?php	
								}
							}
						} ?>
					</div>
				</div>
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
		<div class="section_wrapper mcb-section-inner">
			<div class="wrap two-third box-no-results valign-top" style="">
        		<div class="box-no-results-inner background"></div>
            	<div class="box-no-results-inner"><?php
					echo do_shortcode('[contact-form-7 id="1392" title="Formulario página sin resultados"]'); ?>
		 		</div>
        	</div>
		</div><?php
	}
	/**
	 * woocommerce_after_main_content hook.
	 *
	 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
	 */
	do_action( 'woocommerce_after_main_content' ); ?>
</div>