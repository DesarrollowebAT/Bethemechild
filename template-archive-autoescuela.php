<?php
/**
 * Template name:Archive autoescuela
 */

get_header();

// Class
$blog_classes 	= array();
$section_class 	= array();

// Class | Layout
if( $_GET && key_exists( 'mfn-b', $_GET ) ){
	$blog_layout = esc_html( $_GET['mfn-b'] ); // demo
} else {
	$blog_layout = mfn_opts_get( 'blog-layout', 'classic' );
}
$blog_classes[] = $blog_layout;

// Layout | Masonry Tiles | Quick Fix
if( $blog_layout == 'masonry tiles' ){
	$blog_layout = 'masonry';
}

// Class | Columns
if( $_GET && key_exists( 'mfn-bc', $_GET ) ){
	$blog_classes[] = 'col-'. esc_html( $_GET['mfn-bc'] ); // demo
} else {
	$blog_classes[] = 'col-'. mfn_opts_get( 'blog-columns', 3 );
}

if( $_GET && key_exists( 'mfn-bfw', $_GET ) ){
	$section_class[] = 'full-width'; // demo
}
if( mfn_opts_get( 'blog-full-width' ) && ( $blog_layout == 'masonry' ) ){
	$section_class[] = 'full-width';
}
$section_class = implode( ' ', $section_class );


// Isotope
if( $blog_layout == 'masonry' ) $blog_classes[] = 'isotope';


// Ajax | load more
$load_more = mfn_opts_get( 'blog-load-more' );


// Translate
$translate['filter'] 		= mfn_opts_get('translate') ? mfn_opts_get('translate-filter','Filter by') : __('Filter by','betheme');
$translate['tags'] 			= mfn_opts_get('translate') ? mfn_opts_get('translate-tags','Tags') : __('Tags','betheme');
$translate['authors'] 		= mfn_opts_get('translate') ? mfn_opts_get('translate-authors','Authors') : __('Authors','betheme');
$translate['all'] 			= mfn_opts_get('translate') ? mfn_opts_get('translate-all','Show all') : __('Show all','betheme');
$translate['categories'] 	= mfn_opts_get('translate') ? mfn_opts_get('translate-categories','Categories') : __('Categories','betheme');
$translate['item-all'] 		= mfn_opts_get('translate') ? mfn_opts_get('translate-item-all','All') : __('All','betheme');

if($_GET['provincia'] != '' && $_GET['municipio'] != '')
{
	$provincia_buscada=array();
	$provincia_buscada['label']=$_GET['provincia'];
	$provincia_cod=get_provincia_cod($provincia_buscada['label']);
	$provincia_buscada['value']=$provincia_cod;
	
	$municipio_buscado=array();
	$municipio_buscado['label']=$_GET['municipio'];
	$municipio_cod=get_municipio_cod($municipio_buscado['label']);
	$municipio_buscado['value']=$municipio_cod;
	$municipio_pagina=$municipio_cod;
	
	if($_GET['municipio']=='Las Palmas' && $_GET['provincia']=='Castellón')
	{
		/* HARD CODED: Dirigimos el municipio de Las Palmas de Castellón a Las Palmas de Gran Canaria */
		$provincia_buscada=array('label' => 'Las Palmas', 'value' => 35);
		$municipio_buscado=array('label' => 'Las Palmas de Gran Canaria', 'value' => 350167);
	}
	
	$autoescuelas_ids=get_listado_cacheado_autoescuelas_ciudad($provincia_buscada,$municipio_buscado);
	
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
		$autoescuelas=cachear_listado_autoescuelas_ciudad($provincia_buscada,$municipio_buscado);
		$autoescuelas_ids=get_listado_cacheado_autoescuelas_ciudad($provincia_buscada,$municipio_buscado);
		$autoescuelas_query=new WP_Query(array(
			'post_type' => 'autoescuela',
			'posts_per_page' => -1,
			'post__in' => $autoescuelas_ids
		));
		/*print_r($autoescuelas_query->posts);die;*/
		$autoescuelas=$autoescuelas_query->posts;
	}
}
elseif($_GET['nombre'] != '')
{
	$autoescuelas=get_posts(array(
		'post_type' => 'autoescuela',
		'numberposts' => -1,
		'orderby' => 'title',
		'order' => 'asc',
		's' => $_GET['nombre']
	));
} ?>
<?php //print_r($autoescuelas);die; ?>
<?php /*<div class="inner_search_form">
	<div class="section_wrapper clearfix"><?php get_template_part('template-parts/search-form'); ?></div>
</div>*/ ?>
<?php /*print_r($_POST);*/ ?>
<!-- #Content -->
<div id="Content" class="woocommerce-content">
	<div class="content_wrapper clearfix">
    	<div class="sections_group">
        	<div class="section">
            	<div class="section_wrapper clearfix">
                	<div class="items_group clearfix">
                    	<div class="column one woocommerce-content"><?php
                        	if(count($autoescuelas) > 0)
							{ ?>
                                <div class="search_resuts_count"><?php 
                                    if($_GET['provincia'] != '')
                                    {
                                        echo 'Hemos encontrado '.count($autoescuelas).' Centros en '.$_GET['municipio'].' y alrededores';
                                    }
                                    elseif($_POST['provincia'] != '')
                                    {
                                        echo 'Hemos encontrado '.count($autoescuelas).' Centros en '.$_POST['municipio'].' y alrededores';
                                    }
                                    else
                                    {
                                        echo 'Hemos encontrado '.count($autoescuelas).' Centros';
                                    } ?></div>
                                <div class="zona_ubicacion">
                                    <button class="accordion" style="display:none;">Ver Mapa</button>
                                    <div class="mapa panel">
                                        <?php /*<iframe src="https://www.google.com/maps/d/embed?mid=1LJM27goWTrtXP1J0I9J_JcM6Dy0&ll=36.27163839144053%2C-5.292713881249938&z=5" width="100%" height="600"></iframe>*/ ?>
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
                                <div class="zona_cursos">
	                                <div class="zona_cursos_exclusive_municipio"><ul class="products grid"></ul></div>
                                    <div class="zona_cursos_premium_municipio"><ul class="products grid"></ul></div>
                                    <div class="zona_cursos_pro_municipio"><ul class="products grid"></ul></div>
                                    <div class="zona_cursos_resto_municipio"><ul class="products grid"></ul></div>
                                	<div class="zona_cursos_exclusive"><ul class="products grid"></ul></div>
                                    <div class="zona_cursos_premium"><ul class="products grid"></ul></div>
                                    <div class="zona_cursos_pro"><ul class="products grid"></ul></div>
                                    <div class="zona_cursos_resto">
                                        <div class="products_wrapper isotope_wrapper">
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
																if(true)/*get_current_user_id()==6)*/
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
                                                                if(array_key_exists('label',$provincia) || array_key_exists('label',$municipio))
                                                                { ?>
                                                                    <p class="ubicacion"><?php
                                                                        if(array_key_exists('label',$provincia) && $provincia['label']!='' && !is_numeric($municipio['label']))
                                                                        { ?>
                                                                            <span><?php echo $provincia['label']; ?> |</span> <?php
                                                                        }
                                                                        else
                                                                        { ?>
                                                                            <span><?php the_field('provincia_texto'); ?> |</span> <?php
                                                                        }
																		if(!is_null($municipio))
																		{
																			if(array_key_exists('label',$municipio) && $municipio['label']!='' && !is_numeric($municipio['label']))
																			{
																				echo $municipio['label'];
																			}
																			else
																			{
																				the_field('municipio_texto');
																			}
																		} ?>
                                                                    </p><?php
                                                                }
                                                                if(get_field('horario',get_the_id())!='')
                                                                { ?>
                                                                    <p class="horario"><span>Horario:</span> <?php the_field('horario',get_the_id()); ?></p><?php
                                                                }
																if(get_field('teorica_online',get_the_id()))
																{ ?>
																	<div class="teorica_online">
                                                                    	<img src="<?php echo get_bloginfo('stylesheet_directory') ?>/img/icon-computer-checked-at.png" />
                                                                    	Teórica online disponible
                                                                    </div><?php
																} ?>
                                                            </div>
                                                        </div>
                                                    </li><?php												
                                                } // end of the loop.
                                                wp_reset_postdata(); ?>
                                            </ul>
                                        </div>
                                    </div>
                                </div><?php	
							}
							else
							{ ?>
                            	<div class="search_resuts_count"><?php
									_e('No se han encontrado autoescuelas en el lugar elegido'); ?>
                                </div><?php
								echo do_shortcode('[contact-form-7 id="1392" title="Formulario página sin resultados"]');
							}
							// pagination
							/*if( function_exists( 'mfn_pagination' ) )
							{
								echo mfn_pagination( false, $load_more );
							}
							else
							{ ?>
                                <div class="nav-next"><?php next_posts_link(__('&larr; Older Entries', 'betheme')) ?></div>
								<div class="nav-previous"><?php previous_posts_link(__('Newer Entries &rarr;', 'betheme')) ?></div><?php
							}*/ ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div><?php
get_footer();
// Omit Closing PHP Tags