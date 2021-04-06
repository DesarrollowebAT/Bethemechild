<?php
/**
 * Template name: Planes microsites
 */

get_header(); ?>
	<!-- #Content -->
	<div id="Content" class="planes_microsites">
		<div class="content_wrapper clearfix">
        	<!-- .sections_group -->
			<div class="sections_group">
            	<div class="entry-content" itemprop="mainContentOfPage">
                	<div class="header_planes">
                    	<div class="section_wrapper mcb-section-inner"><?php
							if(have_rows('cabecera'))
							{
								while(have_rows('cabecera'))
								{
									the_row(); ?>
									<div class="column mcb-column one-second column_column  column-margin- full-width-movil">
                                    	<div class="text_block">
	                                        <h1 class="title"><?php the_sub_field('titulo'); ?></h1>
    	                                    <div class="text"><?php the_sub_field('subtitulo'); ?></div>
                                            <div class="cta_button_container">
	        	                                <a href="<?php the_sub_field('enlace_boton'); ?>" class="cta_button cta_button_2"><?php the_sub_field('texto_boton'); ?></a>
                                            </div>
                                        </div>
									</div>
									<div class="column mcb-column one-second column_column  column-margin- full-width-movil"><?php
										if(get_sub_field('video') != '')
										{ ?>
											<div class="youtube-player" data-id="<?php echo get_youtube_video_id(get_sub_field('video')); ?>"></div><?php
										} ?>
                                    </div><?php
								}
							} ?>
                        </div>
                    </div>
                    <div class="first_block">
                    	<div class="section_wrapper mcb-section-inner"><?php
							if(get_field('primer_bloque') != '')
							{ ?>
                                <div class="column mcb-column one column_column  column-margin- full-width-movil">
                                    <div class="text_block">
                                        <h2 class="text"><?php the_field('primer_bloque'); ?></h2>
                                        <a href="#planes"><div class="icon"></div></a>
                                    </div>
                                </div><?php
							} ?>
                        </div>
                    </div>
                    <div class="second_block">
                    	<div class="section_wrapper mcb-section-inner"><?php
							if(have_rows('segundo_bloque'))
							{
								while(have_rows('segundo_bloque'))
								{
									the_row(); ?>
                                    <div class="column mcb-column one column_column  column-margin- full-width-movil">
                                        <div class="text_block">
                                        	<h3 class="pretitle"><?php the_sub_field('pretitulo'); ?></h3>
                                            <div class="title"><?php the_sub_field('titulo'); ?></div><?php
											if(have_rows('bloques_informacion'))
											{ ?>
                                            	<div class="info_blocks"><?php
													while(have_rows('bloques_informacion'))
													{
														the_row(); ?>
														<div class="info_block column mcb-column one-third column_column  column-margin-">
															<div class="gutter"><?php
																$imagen=get_sub_field('icono');
																if($imagen['url'] != '')
																{ ?>
	        	                                                	<img src="<?php echo $imagen['url']; ?>" alt="<?php the_sub_field('titulo'); ?>" /><?php
																}
																if(get_sub_field('titulo') != '')
																{ ?>
                            	                                	<h4 class="info_block_title"><?php the_sub_field('titulo'); ?></h4><?php
																}
																if(get_sub_field('texto') != '')
																{ ?>
                                            	                	<div class="info_block_text"><?php the_sub_field('texto'); ?></div><?php
																} ?>
                                                            </div>
                                                        </div><?php
													} ?>
                                                </div><?php
											} ?>
                                            <div class="cta_button_container">
	        	                                <a href="<?php the_sub_field('enlace_boton'); ?>" class="cta_button"><?php the_sub_field('titulo_boton'); ?></a>
                                            </div>
                                        </div>
                                    </div><?php
								}
							} ?>
                        </div>
                    </div>
                    <div class="third_block">
                    	<div class="section_wrapper mcb-section-inner"><?php
							if(have_rows('tercer_bloque'))
							{
								while(have_rows('tercer_bloque'))
								{
									the_row(); ?>
                                    <div class="column mcb-column one column_column  column-margin- full-width-movil">
                                        <div class="text_block">
                                        	<h3 class="pretitle"><?php the_sub_field('pretitulo'); ?></h3>
                                            <div class="title"><?php the_sub_field('titulo'); ?></div>
										</div><?php
										if(have_rows('bloques_informacion'))
										{ ?>
											<div class="info_blocks"><?php
												while(have_rows('bloques_informacion'))
												{
													the_row(); ?>
													<div class="info_block column mcb-column one-third column_column  column-margin-">
														<div class="gutter"><?php
															if(get_sub_field('texto') != '')
															{ ?>
																<div class="info_block_text"><?php the_sub_field('texto'); ?></div><?php
															} ?>
														</div>
													</div><?php
												} ?>
											</div><?php
										} ?>
										<div class="cta_button_container">
											<a href="<?php the_sub_field('enlace_boton'); ?>" class="cta_button"><?php the_sub_field('titulo_boton'); ?></a>
										</div>
                                    </div><?php
								}
							} ?>
                        </div>
                    </div>
                    <div class="fourth_block">
                    	<a name="planes" id="planes"></a>                    	
						<div class="section_wrapper mcb-section-inner"><?php
							if(have_rows('cuarto_bloque'))
							{
								while(have_rows('cuarto_bloque'))
								{
									the_row(); ?>
									<div class="text_block">
										<h2 class="title"><?php the_sub_field('titulo'); ?></h2>
									</div><?php
									$productos=get_sub_field('productos');
									if($productos)
									{ ?>
                                    	<div class="products_block"><?php
											foreach($productos as $producto)
											{ ?>
                                            	<div class="info_block column mcb-column one-third column_column product <?php if($producto->post_title == 'Plata' /*'Premium'*/){ ?>featured<?php } ?>">
                                                	<div class="product_title"><?php echo $producto->post_title; ?></div>
                                                    <div class="product_details_container"><?php 
														if($producto->post_title == 'Plata' /*'Premium'*/)
														{ ?>
                                                        	<div class="gutter_featured"></div><?php 
														} ?>
                                                        <div class="product_description"><?php echo $producto->post_content; ?></div><?php
                                                        $product = wc_get_product( $producto->ID ); ?>
                                                        <div class="product_price"><?php
                                                            if($product->price == 0)
                                                            { 
                                                                _e('¡Gratis!','academiadeltransportista');
                                                            }
                                                            else
                                                            { 
																$trozos_precio=explode('.',$product->price); ?>
																<div class="price_beginning"><?php echo $trozos_precio[0]; ?></div>
                                                                <div class="price_rest"><?php 
																	echo "'".$trozos_precio[1]; ?>
																	<p><?php _e('+ IVA','academiadeltransportista'); ?></p>
                                                                    <span>/ mes</span>
                                                                </div><?php
                                                            } ?>
                                                        </div>
                                                        <form class="cart" id="microsite_plan" name="microsite_plan" action="<?php echo esc_url(apply_filters('woocommerce_add_to_cart_form_action',$product->get_permalink())); ?>" method="post" enctype='multipart/form-data'><?php 
                                                            do_action( 'woocommerce_before_add_to_cart_button' );
                                                            do_action( 'woocommerce_before_add_to_cart_quantity' );
                                                            woocommerce_quantity_input(array(
                                                                'min_value'   => apply_filters('woocommerce_quantity_input_min',$product->get_min_purchase_quantity(),$product),
                                                                'max_value'   => apply_filters('woocommerce_quantity_input_max',$product->get_max_purchase_quantity(),$product),
                                                                'input_value' => isset($_POST['quantity']) ? wc_stock_amount(wp_unslash($_POST['quantity'])) : $product->get_min_purchase_quantity(),
																'label' => ''
                                                            ));
                                                            do_action( 'woocommerce_after_add_to_cart_quantity' ); ?>
                                                            <button type="submit" name="add-to-cart" value="<?php echo esc_attr( $product->get_id() ); ?>" class="el_boton"><?php 
                                                                _e('Empieza ya'); ?>
                                                            </button><?php
                                                            do_action( 'woocommerce_after_add_to_cart_button' );
                                                            
                                                            
                                                            if(have_rows('caracteristicas',$product->get_id()))
                                                            { ?>
                                                                <ul><?php
                                                                    while(have_rows('caracteristicas',$product->get_id()))
                                                                    {
                                                                        the_row(); ?>
                                                                        <li <?php if(get_sub_field('activo') == 'no'){ ?>class="inactive"<?php } ?>><?php the_sub_field('texto'); ?></li><?php
                                                                    } ?>
                                                                </ul><?php
                                                            } ?>
                                                            
                                                            <button type="submit" name="add-to-cart" value="<?php echo esc_attr( $product->get_id() ); ?>" class="el_boton el_boton_2"><?php 
                                                                _e('Suscríbete'); ?>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </div><?php
											} ?>
                                        </div><?php
									}
								}
							} ?>
                        </div>
                    </div>
                    <div class="section mcb-section fifth_block">
                   	  <div class="section_wrapper mcb-section-inner">
                        	<div class="wrap mcb-wrap one slide-cap valign-top clearfix">
                            	<div class="mcb-wrap-inner"><?php
									if(have_rows('quinto_bloque'))
									{
										while(have_rows('quinto_bloque'))
										{
											the_row(); ?>
                                            <div class="column mcb-column three-fifth column_column  column-margin-">
                                                <div class="form_title">
                                                    <p class="title"><?php the_sub_field('titulo'); ?></p>
                                                    <p class="text"><?php the_sub_field('texto'); ?></p>
                                                </div>
                                            </div>
                                  <div class="column mcb-column two-fifth column_column column-margin- form_column">
                                                <div class="column_attr clearfix" style=""><?php
                                                    echo do_shortcode(get_sub_field('formulario')); ?>
                                                </div>
                                            </div><?php
										}
									} ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
			</div>
			<!-- .four-columns - sidebar -->
			<?php get_sidebar(); ?>
		</div>
	</div><?php 
get_footer();
// Omit Closing PHP Tags