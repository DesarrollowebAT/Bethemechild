<?php
/**
 * 
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
										if(current_user_can('administrator')){ print_r($error_msg); die; }
									}
								curl_close ($curl);
								
								restore_error_handler();
								$output= json_decode($json);
								
								$location['lat']=$output->results[0]->geometry->location->lat;
								$location['long']=$output->results[0]->geometry->location->lng;
								$address_components=$output->results[0]->address_components;
								
								foreach($address_components as $address_component)
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
								}
								if($ids_cursos_en_lugar)
								{
									$ids_cursos_en_radio=get_cursos_en_radio($location,25,'ids','start_date',get_field('tipo_de_curso'),$ids_cursos_en_lugar);
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
									$ids_cursos_en_radio=get_cursos_en_radio($location,25,'ids','start_date',get_field('tipo_de_curso'));
									$ids_cursos=array_merge($ids_cursos_en_lugar,$ids_cursos_en_radio);
									$cursos=get_posts(array(
										'post_type' => 'product',
										'posts_per_page' => -1,
										'post__in' => $ids_cursos,
										'orderby' => 'post__in',
										'order' => 'ASC'
									));
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
									<p class="texto-ciudad">Gracias por tu interés en nuestros cursos. Rellena el siguiente formulario para recibir más información sobre cursos cercanos a ti. Tenemos varios cursos CAP de mañana, tarde-noche y fines de semana.</p>
                                    <p class="texto-cta-ciudad">Contáctanos para recibir más información <img class="flecha-ciudad" src="https://www.academiadeltransportista.com/fase2/wp-content/uploads/2019/05/arrow.png" title=""></p>
                                    <img class="camion-ciudad" src="https://www.academiadeltransportista.com/fase2/wp-content/uploads/2019/05/camion-cursos-ciudad.png" title="">
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
                                            <?php /*<div class="acf-map listado"><?php
                                                foreach($autoescuelas as $autoescuela)
                                                {
                                                    $la_direccion = get_field('mapa',$autoescuela->ID);
                                                    if(!empty($la_direccion))
                                                    { ?>
                                                        <div class="marker" data-lat="<?php echo $la_direccion['lat']; ?>" data-lng="<?php echo $la_direccion['lng']; ?>">
                                                            <h4><?php echo $autoescuela->post_title; ?></h4>
                                                            <p class="address"><?php echo $la_direccion['address']; ?></p>
                                                        </div><?php	
                                                    }
                                                } ?>
                                            </div>*/ ?>
                                            <iframe src="https://www.google.com/maps/d/embed?mid=1LJM27goWTrtXP1J0I9J_JcM6Dy0&ll=36.27163839144053%2C-5.292713881249938&z=5" width="100%" height="600"></iframe>
                                        </div>
                                    </div>
									<img class="circulo" src="https://www.academiadeltransportista.com/fase2/wp-content/uploads/2019/05/Oval-1.png" />
                                    <div class="zona_cursos">
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
																$autoescuela=$autoescuela[0]; ?>
                                                                <li class="product bkat-item isotope-item <?php if(get_field('curso_destacado',$curso->ID)[0] == 'si'){ ?>curso-destacado<?php } ?>">
                                                                    <a rel="nofollow" href="<?php echo get_permalink($curso); ?>" class="desc"><?php
                                                                        if(get_field('curso_destacado',$curso->ID)[0] == 'si'){ ?><div class="destacado-label"><p>Destacado</p></div><?php } ?>
                                                                        <img src="<?php echo aq_resize(get_the_post_thumbnail_url($autoescuela->ID),150,0,true,true,true); ?>" />
                                                                        <div class="texto">
                                                                            <p class="titulo"><?php echo $autoescuela->post_title; ?></p><?php
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
                                                                        <p class="matriculate">¡Matricúlate!</p>
                                                                    </a>
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
                        </div>   
                    
                    <?php
				} ?>
            </div>
        </div>
    </div>
</div><?php
get_footer();