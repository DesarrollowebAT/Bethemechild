<?php
/**
 * Template name: Autoescuelas ciudades
 */

get_header();
$municipio_pagina=0; ?>
<div id="Content">
<?php /*if(current_user_can('administrator')){ print_r(get_post_meta(get_the_id())); }*/ ?>
    <div class="content_wrapper clearfix">
        <div class="sections_group">
        	<div class="section fondo-curso-ciudad autoescuelas-ciudad">
            	<div class="section_wrapper clearfix">
                	<div class="items_group clearfix">
                    	<div class="woocommerce woocommerce-page">
                            <div class="column one woocommerce-content">
                            
							    <div class="intro-curso-ciudad">
								<!--<span class="subtitle-ciudad">Renovación CAP</span>--><?php 
								/* Sacamos las autoescuelas del municipio seleccionado desde el admin para esta página */
								$provincia_elegida=get_field('provincia');
                                $municipio_elegido=get_field('municipios_'.$provincia_elegida['value']);
								$municipio_pagina=$municipio_elegido['value'];
								
								$autoescuelas_ids=get_listado_cacheado_autoescuelas_ciudad($provincia_elegida,$municipio_elegido);
								if($autoescuelas_ids)
								{
									$autoescuelas_query=new WP_Query(array(
										'post_type' => 'autoescuela',
										'posts_per_page' => -1,
										'post__in' => $autoescuelas_ids
									));
									/*print_r($autoescuelas_query->posts);die;*/
									$autoescuelas=$autoescuelas_query->posts;
								}
								else
								{
									$autoescuelas=cachear_listado_autoescuelas_ciudad($provincia_elegida,$municipio_elegido);
								} ?>
                                <div class="title">
                                	<h1>Autoescuelas <span class="title-ciudad">en <?php echo $municipio_elegido['label']; ?></span></h1>
									<p class="texto-ciudad">Conseguimos tu carnet de conducir al precio más económico. Contamos con las mejores autoescuelas de <?php echo $municipio_elegido['label']; ?>. Contacta con nosotros y buscaremos por ti la opción que mejor se adapte a tus necesidades.</p>
                                    <p class="texto-cta-ciudad">Contáctanos para recibir más información <img class="flecha-ciudad" src="<?php echo get_bloginfo('stylesheet_directory'); ?>/img/arrow-green.png" title=""></p>
                                    <img class="camion-ciudad" src="<?php echo get_bloginfo('stylesheet_directory'); ?>/img/Coche-moto-Autoescuelas-ciudad.png" title="">
									</div>
                                </div>
                                <div class="form-curso-ciudad"><?php 
									echo do_shortcode( '[contact-form-7 id="21487" title="Formulario páginas de autoescuelas por ciudad"]' ); ?>
                                </div><?php 
								if(count($autoescuelas) > 0)
								{ ?>
                                   	<p class="contador-ciudades"><?php if(count($autoescuelas) > 1){ ?>Estas son las <span><?php echo count($autoescuelas); ?></span><?php }else{ ?>Esta es la<?php } if(count($autoescuelas) > 1){ ?> autoescuelas<?php }else{ ?> autoescuela<?php } ?>  más <?php if(count($autoescuelas) > 1){ ?>cercanas<?php }else{ ?>cercana<?php } ?> a ti: consigue los datos de contacto de cada autoescuela pinchando en ellas</p><?php
                                }
								else
								{ ?>
                                	<p class="contador-ciudades"><?php _e('Actualmente nuestro directorio no cuenta con autoescuelas en esta ciudad. Recibe más información rellenando el formulario de arriba.'); ?></p><?php									
								} ?>
								<div class="clear"></div><?php
								if(count($autoescuelas) > 0)
								{ ?>
                                    <div class="zona_ubicacion">
                                        <button class="accordion" style="display:none;">Ver Mapa</button>
                                        <div class="mapa panel">
                                            <div class="acf-map listado"><?php
                                                foreach($autoescuelas as $autoescuela)
                                                {
                                                    $la_direccion = get_field('mapa',$autoescuela->ID);
                                                    if(!empty($la_direccion) /*&& !in_array($autoescuela->post_title,$autoescuelas_insertadas)*/)
													{ 
														$cursos=autoescuela_tiene_cursos($autoescuela);
														if($cursos=='si')
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
                                                } ?>
                                            </div>
                                        </div>
                                    </div>
									<img class="circulo" src="https://www.academiadeltransportista.com/wp-content/uploads/2019/05/Oval-1.png" />
                                    <div class="zona_cursos">
    	                                <div class="zona_cursos_exclusive_municipio"><ul class="products grid"></ul></div>
                                        <div class="zona_cursos_premium_municipio"><ul class="products grid"></ul></div>
                                        <div class="zona_cursos_pro_municipio"><ul class="products grid"></ul></div>
                                        <div class="zona_cursos_resto_municipio"><ul class="products grid"></ul></div>
                                        <div class="zona_cursos_exclusive"><ul class="products grid"></ul></div>
                                        <div class="zona_cursos_premium"><ul class="products grid"></ul></div>
                                        <div class="zona_cursos_pro"><ul class="products grid"></ul></div>
                                        <div class="zona_cursos_resto">
                                            <div class="products_wrapper isotope_wrapper"><?php
												if($autoescuelas)
												{ ?>
													<ul class="products grid"><?php
														global $post;
														foreach($autoescuelas as $post)
														{
															setup_postdata($post);
															$nivel_autoescuela=get_microsite_level($post);
															$clase_autoescuela='';
															switch($nivel_autoescuela)
															{
																case 'pro':
																	$clase_autoescuela = 'curso-pro';
																	break;
																case 'premium':
																	$clase_autoescuela = 'curso-premium';
																	break;
																case 'exclusive':
																	$clase_autoescuela = 'curso-exclusive';
																	break;
															}
															$provincia=get_field('provincia');
															$municipio=get_field('municipios_'.$provincia['value']);
															if($municipio_pagina != 0)
															{
																if($municipio_pagina == $municipio['value'])
																{
																	$municipio_actual=' municipio-actual ';
																}
																else
																{
																	$municipio_actual='';
																}
															} ?>
															<li class="isotope-item bkat-item post-<?php the_id(); echo ' '.$clase_autoescuela; echo $municipio_actual; ?> product type-product status-publish tipo-curso-cap-continua product_cat-cap-continua first instock shipping-taxable purchasable product-type-simple">
																<div class="desc"><?php
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
																	<div class="image_block">
																		<div class="img"><?php
																			if(get_the_post_thumbnail_url(get_the_id()) != '')
																			{ ?>
																				<img src="<?php echo aq_resize(get_the_post_thumbnail_url(get_the_id()),150,150,false,true,true); ?>" /><?php 
																			}
																			else
																			{
																				echo file_get_contents(get_stylesheet_directory().'/img/microsites/logo-autoescuela-gen.svg');
																			} ?>
                                                                        </div><?php
																		if(true)//get_current_user_id()==6)
																		{ ?>
																			<div class="nota_autoescuela"><?php
																				get_star_rating(get_the_id()); ?>
                                                                            </div><?php
																		}
																		else
																		{
																			build_nota_block(get_nota_post(get_the_id()));
																		} ?>
																		<a class="cta_button" href="<?php the_permalink(); ?>"><span><?php _e('Ver autoescuela','bkat'); ?></span></a>
																	</div>
																	<div class="texto">
																		<p class="titulo"><?php the_title(); ?></p><?php
																		if($provincia['label']!='' || $municipio['label']!='')
																		{ ?>
																			<p class="ubicacion"><?php
																				if($provincia['label']!='' && !is_numeric($municipio['label']))
																				{ ?>
																					<span><?php echo $provincia['label']; ?> |</span> <?php
																				}
																				else
																				{ ?>
																					<span><?php the_field('provincia_texto',$autoescuela->ID); ?> |</span> <?php
																				}
																				if($municipio['label']!='' && !is_numeric($municipio['label']))
																				{
																					echo $municipio['label'];
																				}
																				else
																				{
																					the_field('municipio_texto',$autoescuela->ID);
																				} ?>
																			</p><?php
																		}
																		if(get_field('horario',get_the_id())!='')
																		{ ?>
																			<p class="horario"><span>Horario:</span> <?php the_field('horario',get_the_id()); ?></p><?php
																		} ?>
																	</div>
																</div>
															</li><?php												
														} // end of the loop.
														wp_reset_postdata(); ?>
													</ul><?php
												} ?>
                                            </div>
                                        </div>
                                    </div><?php 
								}
								else
								{ ?>
                                	<div class="clear"></div><?php
									echo do_shortcode('[contact-form-7 id="1756" title="Formulario página sin resultados SEO"]');
								} ?>
                            </div>
                        </div>
                    </div>
                </div><?php
				if(get_the_content() != '')
				{ ?>
                    <div class="descripcion">
                        <div class="section_wrapper clearfix" >
                            <h2 class="title"><span>Autoescuela en </span> <?php echo $municipio_elegido['label']; ?></h2>
                            <p class="text" itemprop="description"><?php the_content(); ?></p>
                            <p class="cta-ciudad"><a target="_blank" class="boton-renovacion-cap" href="#Content">¿Quieres recibir más información?</a></p>
                        </div>
                    </div>
                    
                    <?php 
                    $content = apply_filters( 'the_content', get_the_content() );
                    $content = preg_replace("/<embed?[^>]+>/i", "(embed) ", $content);
                    $content = wp_strip_all_tags($content);
                    ?>
                       
                        <div itemscope itemtype="http://schema.org/Brand">
                            <meta itemprop="name" content="Autoescuelas en <?php echo $municipio_elegido['label']; ?>">
                            <meta itemprop="description" content="<?php echo $content; ?>">
                        </div>   
                    
                    <?php
				} ?>
            </div>
        </div>
    </div>
</div><?php
get_footer();