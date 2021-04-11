<?php
/**
 * Template name: Cursos ciudades
 */

get_header(); ?>
<div id="Content">
<?php /*if(current_user_can('administrator')){ print_r(get_post_meta(get_the_id())); }*/ ?>
    <div class="content_wrapper clearfix">
        <div class="sections_group">
        	<div class="section fondo-curso-ciudad">
            	<div class="section_wrapper clearfix">
                	<div class="items_group clearfix">
                    	<div class="woocommerce woocommerce-page">
                            <div class="column one woocommerce-content">
							    <div class="intro-curso-ciudad">
								<span class="subtitle-ciudad">Renovación CAP</span><?php 
								/* Sacamos el tipo de curso a buscar seleccionado desde el admin para esta página */
								$tipo_curso=get_field('tipo_de_curso');
								switch($tipo_curso)
								{
									case 'cap_cont':
										$tipo_curso=array(29);
										break;
									case 'cap_inicial':
										$tipo_curso=array(28);
										break;
									case 'adr_cont':
										$tipo_curso=array(31);
										break;
									case 'adr_inicial':
										$tipo_curso=array(30);
										break;
									default:
										$tipo_curso=array(29,28,31,30);
								}
                                /* Sacamos las autoescuelas del municipio seleccionado desde el admin para esta página */
								$provincia_elegida=get_field('provincia');
								$municipio_elegido=get_field('municipios_'.$provincia_elegida['value']);
								
								$address=str_replace(' ','+',$municipio_elegido['label'].'+'.$provincia_elegida['label'].'+España');
								
								$curl = curl_init();
									/*curl_setopt($curl, CURLOPT_URL, 'https://maps.googleapis.com/maps/api/geocode/json?key=AIzaSyBboTKeNhIb48HqYWeDzpQKrirI1pI_vZM&address='.$address);*/
									curl_setopt($curl, CURLOPT_URL, 'https://maps.googleapis.com/maps/api/geocode/json?key=AIzaSyBP9OVPkIgTmQhuMr5kdT7JNHBEmv7cuLU&language=es-ES&address='.$address);
									curl_setopt ($curl, CURLOPT_RETURNTRANSFER, 1);
									$json = curl_exec($curl);
									if (curl_error($curl)) {
										$error_msg = curl_error($curl);
										/*if(current_user_can('administrator')){ print_r($error_msg); die; }*/
									}
								curl_close ($curl);
								
								restore_error_handler();
								$output= json_decode($json);
								
								$location['lat']=$output->results[0]->geometry->location->lat;
								$location['long']=$output->results[0]->geometry->location->lng;
								$address_components=$output->results[0]->address_components;
								
								/*foreach($address_components as $address_component)
								{	
									if($address_component->types[0] == 'locality')
									{
										if(strpos($address_component->long_name,"L'") === 0)
										{
											$trozos=explode("'",$address_component->long_name);
											$municipio=get_municipio_cod($trozos[1].' ('.$trozos[0]."')");
										}
										elseif(strpos($address_component->long_name,' '))
										{
											$trozos=explode(' ',$address_component->long_name);
											if($trozos[0] == 'El' || $trozos[0] == 'La' || $trozos[0] == 'el' || $trozos[0] == 'la' || $trozos[0] == 'Los' || $trozos[0] == 'Las' || $trozos[0] == 'los' || $trozos[0] == 'Es' || $trozos[0] == 'es' || $trozos[0] == 'Sa' || $trozos[0] == 'sa' || $trozos[0] == 'Sas' || $trozos[0] == 'sas' || $trozos[0] == 'Els' || $trozos[0] == 'els' || $trozos[0] == 'Les' || $trozos[0] == 'les' || $trozos[0] == 'A' || $trozos[0] == 'a' || $trozos[0] == 'O' || $trozos[0] == 'o' || $trozos[0] == 'As' || $trozos[0] == 'as')
											{
												$prefijo=$trozos[0];
												unset($trozos[0]);
												$municipio=get_municipio_cod(implode(' ',$trozos).' ('.$prefijo.')');
											}
											else
											{
												$municipio=get_municipio_cod($address_component->long_name);
											}
										}
										else
										{
											$municipio=get_municipio_cod($address_component->long_name);
										}
									}
									if($address_component->types[0] == 'administrative_area_level_2' || $address_component->types[0] == 'archipelago')
									{
										if(strpos($address_component->long_name,' '))
										{
											if($address_component->long_name == 'Balearic Islands')
											{
												$provincia=get_provincia_cod('Balears (Illes)');
											}
											else
											{
												$trozos=explode(' ',$address_component->long_name);
												if($trozos[0] == 'El' || $trozos[0] == 'La' || $trozos[0] == 'el' || $trozos[0] == 'la' || $trozos[0] == 'Los' || $trozos[0] == 'Las' || $trozos[0] == 'los' || $trozos[0] == 'Es' || $trozos[0] == 'es' || $trozos[0] == 'Sa' || $trozos[0] == 'sa' || $trozos[0] == 'Sas' || $trozos[0] == 'sas' || $trozos[0] == 'Els' || $trozos[0] == 'els' || $trozos[0] == 'Les' || $trozos[0] == 'les' || $trozos[0] == 'A' || $trozos[0] == 'a' || $trozos[0] == 'O' || $trozos[0] == 'o' || $trozos[0] == 'As' || $trozos[0] == 'as')
												{
													$prefijo=$trozos[0];
													unset($trozos[0]);
													$provincia=get_provincia_cod(implode(' ',$trozos).' ('.$prefijo.')');
												}
												else
												{
													$provincia=get_provincia_cod($address_component->long_name);
												}
											}
										}
										else
										{
											$provincia=get_provincia_cod($address_component->long_name);
										}
										$provincia_nombre=$address_component->long_name;
									}
									$ids_cursos_en_lugar=array();
				
									if(is_numeric($municipio))
									{
										$cursos_en_municipio=get_posts(array(
											'post_type' => 'product',
											'posts_per_page' => -1,
											'meta_query' => array(
												array(
													'key' => 'municipio_curso',
													'value' => $municipio,
													'compare' => 'NUMERIC'
												)
											),
											'orderby' => 'meta_value_num',
											'meta_key' => 'fecha_inicio',
											'order' => 'ASC',
											'tax_query' => array(
												array(
													'taxonomy' => 'tipo-curso',
													'field' => 'term_taxonomy_id',
													'terms' => $tipo_curso
												)
											)
										));
										if($cursos_en_municipio)
										{
											foreach($cursos_en_municipio as $curso)
											{
												$ids_cursos_en_lugar[]=$curso->ID;
											}
										}
									}
									
									if(!is_numeric($municipio) || !$cursos_en_municipio)
									{
										if(is_numeric($provincia))
										{
											$cursos_en_provincia=get_posts(array(
												'post_type' => 'product',
												'posts_per_page' => -1,
												'meta_query' => array(
													array(
														'key' => 'provincia_curso',
														'value' => $provincia,
														'compare' => 'NUMERIC'
													)
												),
												'orderby' => 'meta_value_num',
												'meta_key' => 'fecha_inicio',
												'order' => 'ASC',
												'tax_query' => array(
													array(
														'taxonomy' => 'tipo-curso',
														'field' => 'term_taxonomy_id',
														'terms' => $tipo_curso
													)
												)
											));
											if($cursos_en_provincia)
											{
												foreach($cursos_en_provincia as $curso)
												{
													$ids_cursos_en_lugar[]=$curso->ID;
												}
											}
										}
									}
								}*/
								
								if(is_numeric($municipio_elegido['value']))
								{
									$cursos_en_municipio=get_posts(array(
										'post_type' => 'product',
										'posts_per_page' => -1,
										'meta_query' => array(
											array(
												'key' => 'municipio_curso',
												'value' => $municipio_elegido['value'],
												'compare' => 'NUMERIC'
											)
										),
										'orderby' => 'meta_value_num',
										'meta_key' => 'fecha_inicio',
										'order' => 'ASC',
										'tax_query' => array(
											array(
												'taxonomy' => 'tipo-curso',
												'field' => 'term_taxonomy_id',
												'terms' => $tipo_curso
											)
										)
									));
									if($cursos_en_municipio)
									{
										foreach($cursos_en_municipio as $curso)
										{
											$ids_cursos_en_lugar[]=$curso->ID;
										}
									}
								}
								
								if(!is_numeric($municipio_elegido['value']) || !$cursos_en_municipio)
								{
									if(is_numeric($provincia_elegida['value']))
									{
										$cursos_en_provincia=get_posts(array(
											'post_type' => 'product',
											'posts_per_page' => -1,
											'meta_query' => array(
												array(
													'key' => 'provincia_curso',
													'value' => $provincia_elegida['value'],
													'compare' => 'NUMERIC'
												)
											),
											'orderby' => 'meta_value_num',
											'meta_key' => 'fecha_inicio',
											'order' => 'ASC',
											'tax_query' => array(
												array(
													'taxonomy' => 'tipo-curso',
													'field' => 'term_taxonomy_id',
													'terms' => $tipo_curso
												)
											)
										));
										if($cursos_en_provincia)
										{
											foreach($cursos_en_provincia as $curso)
											{
												$ids_cursos_en_lugar[]=$curso->ID;
											}
										}
									}
								}
								
								if($ids_cursos_en_lugar)
								{
									$ids_cursos_en_radio=get_cursos_en_radio($location,15,'ids','start_date',get_field('tipo_de_curso'),$ids_cursos_en_lugar);
									$ids_cursos=array_merge($ids_cursos_en_lugar,$ids_cursos_en_radio);
									$cursos=get_posts(array(
										'post_type' => 'product',
										'posts_per_page' => -1,
										'post__in' => $ids_cursos,
										'orderby' => 'post__in',
										'order' => 'ASC'
									));
								}
								else
								{
									$ids_cursos_en_radio=get_cursos_en_radio($location,15,'ids','start_date',get_field('tipo_de_curso'),array());
									if($ids_cursos_en_radio)
									{
										$cursos=get_posts(array(
											'post_type' => 'product',
											'posts_per_page' => -1,
											'post__in' => $ids_cursos_en_radio,
											'orderby' => 'post__in',
											'order' => 'ASC'
										));
									}
								}
								
								
                                /*$provincia_elegida=get_field('provincia');
                                $municipio_elegido=get_field('municipios_'.$provincia_elegida['value']);
                                $autoescuelas=get_posts(
									array(
										'numberposts' => -1,
										'post_type' => 'autoescuela',
										'post_status' => 'publish',
										'meta_key' => 'municipios_'.$provincia_elegida['value'],
										'meta_value' => $municipio_elegido['value']
									)
								);
								$cuenta_cursos=get_posts(
									array(
										'post_type' => 'product',
										'post_status' => 'publish',
										'meta_key' => 'municipio_curso',
										'meta_value' => $municipio_elegido['value']
									)
								);*/ ?>
                                <div class="title">
                                	<h1>Renovación <span class="title-ciudad">CAP <?php echo $municipio_elegido['label']; ?></span></h1>
									<p class="texto-ciudad">Indícanos tus datos de contacto para facilitarte más información sobre cursos CAP cercanos a ti. Tenemos cursos CAP inicial y CAP continua con diferentes horarios. Elige el que más se adapta a tus necesidades.</p>
                                    <p class="texto-cta-ciudad">Contáctanos para recibir más información <img class="flecha-ciudad" src="https://www.academiadeltransportista.com/wp-content/uploads/2019/05/arrow.png" title=""></p>
                                    <img class="camion-ciudad" src="https://www.academiadeltransportista.com/wp-content/uploads/2019/05/camion-cursos-ciudad.png" title="">
									</div>
                                </div>
                                <div class="form-curso-ciudad">
                                <?php echo do_shortcode( '[contact-form-7 id="7257" title="Formulario ciudad renovación CAP"]' ); ?>
                                </div>
                                <?php if(count($cursos) > 0)
									{ ?>
                                    	<p class="contador-ciudades"><?php if(count($cursos) > 1){ ?>Estos son los<?php }else{ ?>Este es<?php } ?> <span><?php echo count($cursos); ?></span> <?php if(count($cursos) > 1){ ?>cursos<?php }else{ ?>curso<?php } ?>  más <?php if(count($cursos) > 1){ ?>cercanos<?php }else{ ?>cercano<?php } ?> a ti: reserva ya tu plaza pinchando en cada curso</p><?php
                                    }
									/*else
									{ ?>
                                    	<p class="contador-ciudades">La mayor oferta de cursos CAP continua, inicial y ADR</p><?php
									}*/ ?>
                                <?php
								if(count($cursos) > 0)
								{ ?>
                                    <div class="zona_ubicacion">
                                        <button class="accordion" style="display:none;">Ver Mapa</button>
                                        <div class="mapa panel">
                                            <div class="acf-map listado"><?php
												$autoescuelass=get_posts(array(
													'post_type' => 'autoescuela',
													'numberposts' => -1,
													'meta_key' => 'provincia_texto',
													'meta_value' => $provincia_elegida['label']
												));
                                                foreach($autoescuelass as $autoescuela)
                                                {
                                                    $la_direccion = get_field('mapa',$autoescuela->ID);
                                                    if(!empty($la_direccion))
													{ 
														$cursoss=autoescuela_tiene_cursos($autoescuela);
														if($cursoss=='si')
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
                                            <?php /*<iframe src="https://www.google.com/maps/d/embed?mid=1LJM27goWTrtXP1J0I9J_JcM6Dy0&ll=36.27163839144053%2C-5.292713881249938&z=5" width="100%" height="600"></iframe>*/ ?>
                                        </div>
                                    </div>
                                    <div class="zona_cursos">
                                    	<div class="zona_cursos_exclusive_municipio"><ul class="products grid"></ul></div>
                                        <div class="zona_cursos_premium_municipio"><ul class="products grid"></ul></div>
                                        <div class="zona_cursos_pro_municipio"><ul class="products grid"></ul></div>
                                        <div class="zona_cursos_resto_municipio"><ul class="products grid"></ul></div>
                                    	<div class="zona_cursos_exclusive" style="display:none;"><ul class="products grid"></ul></div>
	                                    <div class="zona_cursos_premium" style="display:none;"><ul class="products grid"></ul></div>
                                        <div class="zona_cursos_pro" style="display:none;"><ul class="products grid"></ul></div>
                                        <div class="zona_cursos_destacados"><ul class="products grid"></ul></div>
                                        <div class="zona_cursos_resto">
                                            <div class="products_wrapper isotope_wrapper"><?php
                                                /*foreach($autoescuelas as $autoescuela)
                                                {
                                                    $cursos = get_posts(array(
                                                        'post_type' => 'product',
                                                        'post_status' => 'publish',
                                                        'meta_query' => array(
                                                            array(
                                                                'key' => 'autoescuela',
                                                                'value' => '"' . $autoescuela->ID . '"',
                                                                'compare' => 'LIKE'
                                                            )
                                                        ),
                                                        'orderby' => 'meta_value_num',
                                                        'meta_key' => 'fecha_inicio',
                                                        'order' => 'ASC'
                                                    ));*/
                                                    if($cursos)
                                                    { ?>
                                                        <ul class="products grid"><?php
                                                            foreach($cursos as $curso)
                                                            { 
																$autoescuela=get_field('autoescuela',$curso->ID);
																$autoescuela=$autoescuela[0];
																$nivel_autoescuela=get_microsite_level($autoescuela);
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
																$provincia=get_field('provincia',$autoescuela->ID);
                                                                $municipio=get_field('municipios_'.$provincia['value'],$autoescuela->ID);
																if($municipio['value'] == $municipio_elegido['value'])
																{
																	$municipio_actual=' municipio-actual ';
																}
																else
																{
																	$municipio_actual='';
																} ?>
                                                                <li class="product bkat-item isotope-item <?php echo ' '.$clase_autoescuela.' '; if(get_field('curso_destacado',$curso->ID)[0] == 'si'){ ?>curso-destacado<?php } echo $municipio_actual; ?>" autoescuela="<?php echo $autoescuela->post_title; ?>"><?php /*if(current_user_can('administrator')){ print_r(get_post_meta($curso->ID));die; }*/ ?>
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
																		}
                                                                        if(get_field('curso_destacado',$curso->ID)[0] == 'si'){ ?><div class="destacado-label"><p>Destacado</p></div><?php } ?>
                                                                        <div class="image_block">
																			<div class="img"><?php
																				if(get_the_post_thumbnail_url($autoescuela->ID) != '')
																				{ ?>
																					<img src="<?php echo aq_resize(get_the_post_thumbnail_url($autoescuela->ID),150,150,false,true,true); ?>" /><?php 
																				}
																				else
																				{
																					echo file_get_contents(get_stylesheet_directory().'/img/microsites/logo-autoescuela-gen.svg');
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
	                                                                        <a class="cta_button" rel="nofollow" href="<?php echo get_permalink($curso->ID); ?>"><span><?php _e('Ver curso','bkat'); ?></span></a>
                                                                        </div>
                                                                        <div class="texto">
                                                                            <p class="titulo"><?php echo $autoescuela->post_title; ?></p><?php
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
                                                                            if(get_field('horario',$autoescuela->ID)!='')
                                                                            { ?>
                                                                                <p class="horario"><span>Horario:</span> <?php the_field('horario_texto',$curso->ID); ?></p><?php
                                                                            }
                                                                            $fecha=date_create(get_field('fecha_inicio',$curso->ID));
                                                                            $fecha=date_format($fecha,"j \d\e F");
                                                                            if(get_field('fecha_inicio',$curso->ID)!='')
                                                                            { ?>
                                                                                <p class="fecha_inicio"><span>Fecha de inicio:</span> <?php echo traduccion_fecha($fecha); if(get_field('hora_inicio',$curso->ID)!=''){ echo ' '.get_field('hora_inicio',$curso->ID).' hrs.'; }?></p><?php
                                                                            }
                                                                            if(get_field('fecha_de_finalizacion',$curso->ID)!='')
                                                                            { 
                                                                                $fecha_fin=date_create(get_field('fecha_de_finalizacion',$curso->ID));
                                                                                $fecha_fin=date_format($fecha_fin,"j \d\e F"); ?>
                                                                                <p class="fecha_fin"><span>Fecha de fin:</span> <?php echo traduccion_fecha($fecha_fin); ?></p><?php
                                                                            }
                                                                            $_pf = new WC_Product_Factory();
                                                                            $el_producto = $_pf->get_product($curso->ID); ?>
                                                                            <span class="price"><?php
                                                                                echo $el_producto->get_price_html(); ?>
                                                                            </span>
                                                                            <span class="tasas">(+ tasas a pagar en el centro)</span>
                                                                        </div>
                                                                        <?php /*<p class="matriculate">¡Matricúlate!</p>*/ ?>
                                                                    </div>
                                                                </li><?php
                                                            } ?>
                                                        </ul><?php
                                                    }
                                                /*}*/ ?>
                                            </div>
                                        </div>
                                    </div><?php
								}
								/*else
								{ ?>
                                	<div class="clear"></div><?php
									echo do_shortcode('[contact-form-7 id="1756" title="Formulario página sin resultados SEO"]');
								}*/ ?>
                            </div>
                        </div>
                    </div>
                </div><?php
				if(get_the_content() != '')
				{ ?>
                    <div class="descripcion">
                        <div class="section_wrapper clearfix" >
                            <h2 class="title">Curso <span>renovación CAP</span> <?php echo $municipio_elegido['label']; ?></h2>
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
                            <meta itemprop="name" content="Curso renovación CAP <?php echo $municipio_elegido['label']; ?>">
                            <meta itemprop="description" content="<?php echo $content; ?>">
                        </div><?php
				}
				if($tipo_curso[0]==29)
				{ ?>
                	<div class="descripcion">
						<div class="section_wrapper clearfix" ><?php
							$ciudades_cercanas=get_ciudades_cercanas_autoescuelas_ciudad($provincia_elegida,$municipio_elegido);
							if(!$ciudades_cercanas)
							{
								$ciudades_cercanas=cachear_ciudades_cercanas_autoescuelas_ciudad($provincia_elegida,$municipio_elegido,$tipo_curso[0]);
							}
							else
							{
								$ciudades_cercanas=json_decode($ciudades_cercanas[0]->ciudades_renovacion_cap_cercanas,true);
							}
							if($ciudades_cercanas)
							{ ?>
								<div class="ciudades_cercanas">
									<p class="title">Ciudades cerca de <span><?php echo $municipio_elegido['label']; ?></span></p>
									<ul><?php
										foreach($ciudades_cercanas as $id_post => $distancia)
										{ 
											$ciudad_actual=get_posts(array(
												'post_type' => 'page',
												'include' => array($id_post)
											));
											if($ciudad_actual)
											{
												$ciudad_actual=$ciudad_actual[0]; ?>
												<li class="ciudad"><a href="<?php echo get_permalink($ciudad_actual->ID); ?>"><span class="nombre"><?php echo $ciudad_actual->post_title; ?></span> <span class="distancia"><?php echo $distancia.' km' ?></span></a></li><?php
											}
										} ?>
									</ul>
								</div><?php
							} ?>
                        </div>
                    </div><?php
				} ?>
            </div>
        </div>
    </div>
</div><?php
get_footer();