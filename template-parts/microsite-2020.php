<?php
if($_GET['edit']!='true' && $_GET['v']!='y')
{
	$nivel_microsite=get_microsite_level();
	get_header('microsite');
	while(have_posts())
	{
		the_post(); ?>
		<!-- #Content -->
		<div class="post_id_custom" post_id="<?php echo get_the_id(); ?>"></div>
		<div id="Content" class="microsite-<?php echo $nivel_microsite; ?> default_template new_2020" microsite-color="<?php echo str_replace('#','',$color_microsite); ?>" color-texto="<?php echo str_replace('#','',$tcolor); ?>">
			<div class="content_wrapper clearfix"><?php
				$logo=get_the_post_thumbnail_url();
				$imagen_cabecera=get_field('imagen_cabecera'); ?>
				<div class="header_microsite">
                	<div class="overlay" style="background-color:<?php echo $color_microsite; ?>;"></div>
					<div class="cabecera_contenido">
						<div class="section_wrapper">
							<div class="column one-second informacion-centro-cabecera"><?php 
								if($nivel_microsite != '')
								{
									if($logo != '')
									{ ?>
										<div class="logo_principal"><img style="border-color:<?php echo $color_microsite; ?>;" alt="<?php echo get_the_title(); ?> - Autoescuela - <?php echo get_field('municipio_texto'); ?>" title="<?php echo get_the_title(); ?> - Autoescuela - <?php echo get_field('municipio_texto'); ?>" src="<?php echo $logo; ?>" /></div><?php 
									}
									else
									{ ?>
										<div class="logo_principal"><img style="border-color:<?php echo $color_microsite; ?>;" alt="<?php echo get_the_title(); ?> - Autoescuela - <?php echo get_field('municipio_texto'); ?>" title="<?php echo get_the_title(); ?> - Autoescuela - <?php echo get_field('municipio_texto'); ?>" src="<?php echo get_bloginfo('stylesheet_directory'); ?>/img/microsites/logo_generico.png" /></div><?php						
									}
								}
								if($nivel_microsite != '')
								{ 
									if($nivel_microsite == 'premium')
									{ ?>
										<div class="icono_pulgar autoescuela_plata">
											<img src="<?php echo get_bloginfo('stylesheet_directory'); ?>/img/icono-autoescuela-plata.svg" />
											<div class="description"><?php _e('Esta autoescuela est?? calificada como <span>Autoescuela PLATA</span>','bkat'); ?></div>
										</div><?php
									}
									elseif($nivel_microsite == 'exclusive')
									{ ?>
										<div class="icono_pulgar autoescuela_oro">
											<img src="<?php echo get_bloginfo('stylesheet_directory'); ?>/img/icono-autoescuela-oro.svg" />
											<div class="description"><?php _e('Esta autoescuela est?? calificada como <span>Autoescuela ORO</span>','bkat'); ?></div>
										</div><?php
									}
								} ?>
								<div class="texto_cabecera clear_both">
									<h1 class="titulo" style="color:<?php echo $tcolor; ?>;"><?php echo get_the_title(); ?></h1>
								</div>
                                <div class="valoraciones <?php if($is_red){ ?>shadowed<?php } ?>">
									<div class="val">
                                        <p class="titulo" style="color:<?php echo $tcolor; ?>;">Valoraci??n:</p><?php
                                        get_star_rating(get_the_id()); ?>
                                    </div>
                                    <p class="message_placeholder <?php if($tcolor_dark){ ?>dark<?php } ?>"></p>                                           
								</div>
                                <div class="contacto_cabecera">
                                	<p class="titulo" style="color:<?php echo $tcolor; ?>;">Ubicaci??n</p>
									<div class="elemento ubicacion">
                                    	<div class="icono"><?php echo file_get_contents(get_stylesheet_directory().'/img/microsites/ubicacion.svg'); ?></div>
										<div class="texto" style="color:<?php echo $tcolor; ?>;"><?php 
											$direccion=get_field('mapa'); echo $direccion['address']; ?><br /><?php
											echo get_field('municipio_texto').', '.get_field('provincia_texto'); ?>
                                        </div>
									</div>
                                </div>
							</div>
							<div class="column one-second formulario-contacto">
								<a id="form_level" name="form_level"></a><?php
								echo do_shortcode('[contact-form-7 id="9825" title="Formulario contacto microsite"]'); ?>
							</div>
						</div>
					</div>
				</div><?php
				if($_GET['val']=='y')
				{
					set_query_var( 'todas_las_valoraciones', 'si' );
					get_template_part('template-parts/valoraciones-block');
				}
				else
				{ ?>
					<!-- .sections_group -->
					<div class="microsite_sections">
                    	<section class="cursos_genericos section_wrapper mcb-section-inner">
                        	<div class="titulo_2" style="width:100%;">Carnets de conducir profesionales</div>
                            <div class="gutter"><?php
                                $carnets_de_conducir_profesionales=get_field('cursos_ofrecidos_tipo_autoescuela');
                                if($carnets_de_conducir_profesionales)
                                { ?>
                                    <ul class="cursos"><?php
                                        foreach($carnets_de_conducir_profesionales as $curso)
                                        { 
											if($curso['value'] == 'curso-obtencion-camion-c' || $curso['value'] == 'curso-obtencion-carnet-trailer-c-e' || $curso['value'] == 'curso-obtencion-carnet-autobus-d')
											{ ?>
                                                <li style="border-color:<?php echo $color_microsite; ?>;">
                                                    <div class="gutter">
                                                        <a href="#form_level"></a>
                                                        <div class="icon" style="border-color:<?php echo $color_microsite; ?>;"><?php
                                                        switch($curso['value'])
                                                        {
                                                            case 'curso-obtencion-camion-c': 
                                                                echo file_get_contents(get_stylesheet_directory().'/img/microsites/icono-camion.svg');
                                                                break;
                                                            case 'curso-obtencion-carnet-trailer-c-e': 
                                                                echo file_get_contents(get_stylesheet_directory().'/img/microsites/icono-trailer.svg');
                                                                break;
                                                            case 'curso-obtencion-carnet-autobus-d': 
                                                                echo file_get_contents(get_stylesheet_directory().'/img/microsites/icono-autobus.svg');
                                                                break;
                                                        } ?>
                                                        </div>
                                                        <div class="texto">
                                                            <h3 class="titulo"><?php echo $curso['label']; ?></h3>
                                                            <span href="#" class="microsite_form_trigger trigger_curso" style="color:<?php echo $color_microsite; ?>;"><?php _e('Pedir informaci??n','academiadeltransportista'); ?></span>
                                                        </div>
                                                    </div>
                                                </li><?php
											}
                                        } ?>
                                    </ul><?php
                                }
                                else
                                { ?>
                                    <div class="sin_cursos"><div class="icon" style="border-color:<?php echo $color_microsite; ?>;"><?php echo file_get_contents(get_stylesheet_directory().'/img/microsites/X.svg'); ?></div><div><?php _e('Actualmente no hay cursos','academiadeltransportista'); ?></div></div><?php
                                } ?>
                            </div>
                            <div class="gutter">
                            	<div class="titulo_2" style="width:100%;">Cursos CAP y ADR</div><?php
                                $cursos_cap_y_adr=get_field('cursos_ofrecidos_tipo_transporte');
                                if($cursos_cap_y_adr)
                                { ?>
                                    <ul class="cursos"><?php
                                        foreach($cursos_cap_y_adr as $curso)
                                        { 
											if($curso['value'] == 'curso-renovacion-del-cap' || $curso['value'] == 'curso-obtencion-cap-inicial' || $curso['value'] == 'curso-renovacion-adr' || $curso['value'] == 'curso-consejero-de-seguridad-adr')
											{ ?>
                                                <li style="border-color:<?php echo $color_microsite; ?>;">
                                                    <div class="gutter">
                                                        <a href="#form_level"></a>
                                                        <div class="icon" style="border-color:<?php echo $color_microsite; ?>;"><?php
                                                        switch($curso['value'])
                                                        {
                                                            case 'curso-renovacion-del-cap': 
                                                                echo file_get_contents(get_stylesheet_directory().'/img/microsites/icono-CAP.svg');
                                                                break;
                                                            case 'curso-obtencion-cap-inicial': 
                                                                echo file_get_contents(get_stylesheet_directory().'/img/microsites/icono-CAP.svg');
                                                                break;
                                                            case 'curso-renovacion-adr': 
                                                                echo file_get_contents(get_stylesheet_directory().'/img/microsites/icono-ADR.svg');
                                                                break;
                                                            case 'curso-consejero-de-seguridad-adr': 
                                                                echo file_get_contents(get_stylesheet_directory().'/img/microsites/icono-ADR.svg');
                                                                break;
                                                        } ?>
                                                        </div>
                                                        <div class="texto">
                                                            <h3 class="titulo"><?php echo $curso['label']; ?></h3>
                                                            <span class="microsite_form_trigger trigger_curso" style="color:<?php echo $color_microsite; ?>;"><?php _e('Pedir informaci??n','academiadeltransportista'); ?></span>
                                                        </div>
                                                    </div>
                                                </li><?php
											}
                                        } ?>
                                    </ul><?php
                                }
                                else
                                { ?>
                                    <div class="sin_cursos"><div class="icon" style="border-color:<?php echo $color_microsite; ?>;"><?php echo file_get_contents(get_stylesheet_directory().'/img/microsites/X.svg'); ?></div><div><?php _e('Actualmente no hay cursos','academiadeltransportista'); ?></div></div><?php
                                } ?>
                            </div>
                            <div class="gutter">
                                <div class="titulo_2" style="width:100%;">Otros cursos para transportistas</div><?php
								$cursos_3=get_field('cursos_ofrecidos_tipo_autoescuela');
								$cursos_1=get_field('cursos_ofrecidos_tipo_transporte');
                                $cursos_2=get_field('cursos_ofrecidos_tipo_mas_cursos');
								$otros_cursos_para_transportistas=array_merge($cursos_2,$cursos_1,$cursos_3);
                                if($otros_cursos_para_transportistas)
                                { ?>
                                    <ul class="cursos"><?php
                                        foreach($otros_cursos_para_transportistas as $curso)
                                        { 
											if($curso['value'] == 'curso-de-carretillas-elevadoras' || $curso['value'] == 'une-12195-sujecion-de-cargas-y-estiba' || $curso['value'] == 'curso-tacografo-digital' || $curso['value'] == 'cursos-de-logistica' || $curso['value'] == 'curso-de-seguridad-vial-laboral' || $curso['value'] == 'curso-obtencion-mercancias-peligrosas' || $curso['value'] == 'curso-obtencion-titulo-de-transportista' || $curso['value'] == 'curso-obtencion-carnet-remolque-b-e' || $curso['value'] == 'curso-conductor-ambulancia' || $curso['value'] == 'curso-grua-camion-pluma' || $curso['value'] == 'transporte-sanitario' || $curso['value'] == 'multiples-victimas' || $curso['value'] == 'docencia-fpe' || $curso['value'] == 'gestion-logistica' || $curso['value'] == 'flotas' || $curso['value'] == 'conduccion-eficiente')
											{ ?>
                                                <li style="border-color:<?php echo $color_microsite; ?>;" class="<?php echo $curso['value']; ?>">
                                                    <div class="gutter">
                                                        <a href="#form_level"></a>
                                                        <div class="icon" style="border-color:<?php if(get_field('color_microsite') != ''){ the_field('color_microsite'); }else{ ?>#FF6600<?php } ?>;"><?php
                                                        switch($curso['value'])
                                                        {
                                                            case 'curso-de-carretillas-elevadoras': 
                                                                echo file_get_contents(get_stylesheet_directory().'/img/microsites/icono-carretilla.svg');
                                                                break;
                                                            case 'une-12195-sujecion-de-cargas-y-estiba': 
                                                                echo file_get_contents(get_stylesheet_directory().'/img/microsites/icono-sujecion-cargas.svg');
                                                                break;
                                                            case 'curso-tacografo-digital': 
                                                                echo file_get_contents(get_stylesheet_directory().'/img/microsites/icono-tacografo.svg');
                                                                break;
                                                            case 'cursos-de-logistica': 
                                                                echo file_get_contents(get_stylesheet_directory().'/img/microsites/icono-logistica.svg');
                                                                break;
                                                            case 'curso-de-seguridad-vial-laboral': 
                                                                echo file_get_contents(get_stylesheet_directory().'/img/microsites/icono-seguridad-vial.svg');
                                                                break;
                                                            case 'curso-obtencion-mercancias-peligrosas': 
                                                                echo file_get_contents(get_stylesheet_directory().'/img/microsites/icono-seguridad.svg');
                                                                break;
                                                            case 'curso-obtencion-titulo-de-transportista': 
                                                                echo file_get_contents(get_stylesheet_directory().'/img/microsites/icono-camion.svg');
                                                                break;
															case 'curso-obtencion-carnet-remolque-b-e': 
																echo file_get_contents(get_stylesheet_directory().'/img/microsites/icono-remolque.svg');
																break;
															case 'curso-conductor-ambulancia': 
																echo file_get_contents(get_stylesheet_directory().'/img/microsites/icono-conductor-ambulancia.svg');
																break;
															case 'curso-grua-camion-pluma': 
																echo file_get_contents(get_stylesheet_directory().'/img/microsites/icono-camion-pluma.svg');
																break;
															case 'transporte-sanitario': 
																echo file_get_contents(get_stylesheet_directory().'/img/microsites/icono-transporte-sanitario.svg');
																break;
															case 'multiples-victimas': 
																echo file_get_contents(get_stylesheet_directory().'/img/microsites/icono-multiples-victimas.svg');
																break;
															case 'docencia-fpe': 
																echo file_get_contents(get_stylesheet_directory().'/img/microsites/icono-docencia-FPE.svg');
																break;
															case 'gestion-logistica': 
																echo file_get_contents(get_stylesheet_directory().'/img/microsites/icono-gestion-logistica.svg');
																break;
															case 'flotas': 
																echo file_get_contents(get_stylesheet_directory().'/img/microsites/icono-flotas.svg');
																break;
															case 'conduccion-eficiente': 
																echo file_get_contents(get_stylesheet_directory().'/img/microsites/icono-conduccion-eficiente.svg');
																break;
															
                                                        } ?>
                                                        </div>
                                                        <div class="texto">
                                                            <h3 class="titulo"><?php echo $curso['label']; ?></h3>
                                                            <span href="#" class="microsite_form_trigger trigger_curso" style="color:<?php echo $color_microsite; ?>;"><?php _e('Pedir informaci??n','academiadeltransportista'); ?></span>
                                                        </div>
                                                    </div>
                                                </li><?php
											}
                                        }
										
										$cursos_autoescuela_adicionales=get_field('cursos_ofrecidos_tipo_autoescuela_adicionales');
										$cursos_transporte_adicionales=get_field('cursos_ofrecidos_tipo_transporte_adicionales');
                                        $cursos_mas_adicionales=get_field('cursos_ofrecidos_tipo_mas_cursos_adicionales');
										if(!$cursos_autoescuela_adicionales)
										{
											$cursos_autoescuela_adicionales=array();
										}
										if(!$cursos_transporte_adicionales)
										{
											$cursos_transporte_adicionales=array();
										}
										if(!$cursos_mas_adicionales)
										{
											$cursos_mas_adicionales=array();
										}
										$cursos_adicionales=array_merge($cursos_autoescuela_adicionales,$cursos_transporte_adicionales,$cursos_mas_adicionales);
										
                                        if($cursos_adicionales)
                                        { 
                                            foreach($cursos_adicionales as $curso_mas_adicional)
                                            { ?>
                                                <li style="border-color:<?php echo $color_microsite; ?>;">
                                                	<div class="gutter">
	                                                    <a href="#form_level"></a>
    	                                                <div class="icon" style="border-color:<?php echo $color_microsite; ?>;"><?php echo file_get_contents(get_stylesheet_directory().'/img/microsites/icono-generico-carretera.svg'); ?></div>
        	                                            <div class="texto">
            	                                            <h3 class="titulo"><?php echo $curso_mas_adicional['nombre']; ?></h3>
                	                                        <span class="microsite_form_trigger trigger_curso" style="color:<?php echo $color_microsite; ?>;"><?php _e('Pedir informaci??n','academiadeltransportista'); ?></span>
                    	                                </div>
                                                    </div>
                                                </li><?php
                                            }
                                        } ?>
                                    </ul><?php
                                }
                                else
                                { ?>
                                    <div class="sin_cursos"><div class="icon" style="border-color:<?php echo $color_microsite; ?>;"><?php echo file_get_contents(get_stylesheet_directory().'/img/microsites/X.svg'); ?></div><div><?php _e('Actualmente no hay cursos','academiadeltransportista'); ?></div></div><?php
                                } ?>
                            </div>
                            <div class="gutter">
                                <div class="titulo_2" style="width:100%;">Permisos de conducir</div><?php
                                $permisos_de_conducir=get_field('cursos_ofrecidos_tipo_autoescuela');
                                if($permisos_de_conducir)
                                { ?>
                                    <ul class="cursos"><?php
                                        foreach($permisos_de_conducir as $curso)
                                        { 
											if($curso['value'] == 'curso-obtencion-carnet-coche-b' || $curso['value'] == 'curso-obtencion-carnet-moto-a')
											{ ?>
                                                <li style="border-color:<?php echo $color_microsite; ?>;">
                                                    <div class="gutter">
                                                        <a href="#form_level"></a>
                                                        <div class="icon" style="border-color:<?php if(get_field('color_microsite') != ''){ the_field('color_microsite'); }else{ ?>#FF6600<?php } ?>;"><?php
                                                        switch($curso['value'])
                                                        {
                                                            case 'curso-obtencion-carnet-coche-b': 
                                                                echo file_get_contents(get_stylesheet_directory().'/img/microsites/icono-coche.svg');
                                                                break;
                                                            case 'curso-obtencion-carnet-moto-a': 
                                                                echo file_get_contents(get_stylesheet_directory().'/img/microsites/icono-moto.svg');
                                                                break;
                                                        } ?>
                                                        </div>
                                                        <div class="texto">
                                                            <h3 class="titulo"><?php echo $curso['label']; ?></h3>
                                                            <span href="#" class="microsite_form_trigger trigger_curso" style="color:<?php echo $color_microsite; ?>;"><?php _e('Pedir informaci??n','academiadeltransportista'); ?></span>
                                                        </div>
                                                    </div>
                                                </li><?php
											}
                                        } ?>
                                    </ul><?php
                                }
                                else
                                { ?>
                                    <div class="sin_cursos"><div class="icon" style="border-color:<?php echo $color_microsite; ?>;"><?php echo file_get_contents(get_stylesheet_directory().'/img/microsites/X.svg'); ?></div><div><?php _e('Actualmente no hay cursos','academiadeltransportista'); ?></div></div><?php
                                } ?>
                            </div>
						</section>
						<section class="conoce_autoescuela section_wrapper mcb-section-inner">
							<div class="titulo_2"><?php _e('Conoce el centro CAP','academiadeltransportista'); ?></div>
							<div class="logo column mcb-column two-fifth column_column"><?php
								if($nivel_microsite != '')
								{
									if($logo != '')
									{ ?>
										<img style="border-color:<?php echo $color_microsite; ?>;" alt="<?php echo get_the_title(); ?> - Autoescuela - <?php echo get_field('municipio_texto'); ?>" title="<?php echo get_the_title(); ?> - Autoescuela - <?php echo get_field('municipio_texto'); ?>" src="<?php echo $logo; ?>" /><?php
									}
									else
									{ ?>
										<img style="border-color:<?php echo $color_microsite; ?>;" alt="<?php echo get_the_title(); ?> - Autoescuela - <?php echo get_field('municipio_texto'); ?>" title="<?php echo get_the_title(); ?> - Autoescuela - <?php echo get_field('municipio_texto'); ?>" src="<?php echo get_bloginfo('stylesheet_directory'); ?>/img/microsites/logo_generico.png" /><?php						
									}
								} ?>
							</div>
							<div class="textos column mcb-column three-fifth column_column">
                            	<div class="texto_cabecera clear_both"><?php
									if(get_field('texto_cabecera') != '')
									{ ?>
										<h2 class="descripcion"><?php the_field('texto_cabecera'); ?></h2><?php
									} ?>
								</div>
                                <div class="titulo_descripcion"><?php 
									if(get_field('titulo_texto_informacion') != '')
									{
										the_field('titulo_texto_informacion');
									} ?>
								</div>
								<div class="texto_descripcion"><?php 
									if(get_field('texto_informacion') != '')
									{
										the_field('texto_informacion');
									} ?>
								</div>
							</div>
						</section>
                        <section class="detalles_autoescuela section_wrapper mcb-section-inner">
							<div class="section_gutter"><?php
								if($nivel_microsite != '')
								{ ?>
									<div class="horarios_ubicacion column mcb-column one-second column_column">
                                    	<p class="titulo">Datos de contacto</p><?php
										if(get_field('telefono_fijo') != '')
										{ ?>
											<div class="elemento tlf_fijo"><div class="icono"><?php echo file_get_contents(get_stylesheet_directory().'/img/microsites/telefono-fijo.svg'); ?></div><p><?php the_field('telefono_fijo'); ?></p></div><?php
										}
										if(get_field('e-mail') != '')
										{ ?>
											<div class="elemento mail"><div class="icono"><?php echo file_get_contents(get_stylesheet_directory().'/img/microsites/email.svg'); ?></div><p><?php the_field('e-mail'); ?></p></div><?php
										} ?>
                                        <div class="separador" style="background-color:<?php echo $color_microsite; ?>;"></div>
									</div><?php
								}
								else
								{ ?>
                                	<div class="no_plan column mcb-column one column_column">
										<div class="titulo" style="text-align:center;">Solicita informaci??n de contacto</div>
										<a href="#" style="background-color:<?php echo $color_microsite; ?>; color:<?php echo $tcolor; ?>;" class="microsite_main_cta microsite_form_trigger transitions">Te llamamos gratis</a>
									</div><?php
								} ?>
									
								<?php
								if($nivel_microsite != '' && get_field('horario') != '')
								{ ?>
                                    <div class="horarios_ubicacion column mcb-column one-second column_column">
                                        <div class="titulo">Horario</div>
										<div class="elemento horario">
											<div class="icono"><?php echo file_get_contents(get_stylesheet_directory().'/img/microsites/horario.svg'); ?></div>
											<div class="texto"><?php the_field('horario'); ?></div>
                                        </div>
                                        <div class="separador" style="background-color:<?php echo $color_microsite; ?>;"></div>
                                    </div><?php
								}
								if(get_field('telefono_movil') != '')
								{ ?>
                                    <div class="telefonos column mcb-column one-second column_column">
                                        <div class="telefonos_container"><?php
                                            if($nivel_microsite != '')
                                            { ?>
                                                <div class="titulo">Contacto m??vil</div>
                                                <ul class="telefonos">
													<li class="elemento">
														<div class="icono"><?php echo file_get_contents(get_stylesheet_directory().'/img/microsites/whatsapp.svg'); ?></div>
														<div class="texto"><?php the_field('telefono_movil'); ?></div>
                                                    </li>
                                                </ul><?php
                                            }
                                            else
                                            { ?>
                                                <div class="titulo">Solicita informaci??n de contacto</div>
                                                <a href="#" class="microsite_main_cta microsite_form_trigger transitions" style="background-color:<?php echo $color_microsite; ?>;color:<?php echo $tcolor; ?>;">Te llamamos gratis</a><?php
                                            } ?>
                                        </div>
                                    </div><?php
								} ?>
							</div>
						</section>
						<section class="imagenes_autoescuela section_wrapper mcb-section-inner"><?php 
							if(have_rows('imagenes'))
							{ ?>
								<div class="owl-carousel"><?php
									while(have_rows('imagenes'))
									{
										the_row();
										$imagen=get_sub_field('imagen'); ?>
										<div><a href="<?php echo $imagen['url']; ?>"><img alt="<?php echo get_the_title(); ?> - Autoescuela - <?php echo get_field('municipio_texto'); ?>" title="<?php echo get_the_title(); ?> - Autoescuela - <?php echo get_field('municipio_texto'); ?>" src="<?php echo aq_resize($imagen['url'],580,390,true,true,true); ?>" /></a></div><?php
									} ?>
								</div><?php
							}
							else
							{ ?>
								<div class="owl-carousel default">
									<div>
										<a href="#" class="image_popup_trigger"><img alt="<?php echo get_the_title(); ?> - Autoescuela - <?php echo get_field('municipio_texto'); ?>" title="<?php echo get_the_title(); ?> - Autoescuela - <?php echo get_field('municipio_texto'); ?>" src="<?php echo get_bloginfo('stylesheet_directory'); ?>/img/microsites/default_image.png" /></a>
									</div>
									<div>
										<a href="#" class="image_popup_trigger"><img alt="<?php echo get_the_title(); ?> - Autoescuela - <?php echo get_field('municipio_texto'); ?>" title="<?php echo get_the_title(); ?> - Autoescuela - <?php echo get_field('municipio_texto'); ?>" src="<?php echo get_bloginfo('stylesheet_directory'); ?>/img/microsites/default_image.png" /></a>
									</div>
								</div><?php						 
							} ?>
						</section>
						<section class="cta_banner section_wrapper mcb-section-inner">
							<div class="the_cta" style="background-color:<?php echo $color_microsite; ?>;">
								<div class="textos column mcb-column three-fifth column_column">
									<div class="gutter">
										<div class="titulo_2" style="color:<?php echo $tcolor; ?>;">Conf??a en nuestros docentes y en nuestra experiencia</div>
										<a href="#" class="microsite_main_cta microsite_form_trigger" style="background:<?php echo $color_microsite; ?>;"><?php _e('Quiero matricularme','academiadeltransportista'); ?></a>
									</div>
								</div>
								<div class="imagen column mcb-column two-fifth column_column">
									<div class="gutter">
										<img alt="Contacta ahora con <?php the_title(); ?>" title="Contacta ahora con <?php the_title(); ?>" src="<?php echo get_bloginfo('stylesheet_directory'); ?>/img/microsites/icono-cta.png" />
									</div>
								</div>
							</div>
						</section><?php
						if(true)/*get_current_user_id() == 6)*/
						{
							set_query_var('color_microsite',$color_microsite);				
							get_template_part('template-parts/valoraciones-block');
						}
						
						$cursos=get_cursos_autoescuela();
						
						if($nivel_microsite != 'pro' && $nivel_microsite != 'premium' && $nivel_microsite != 'exclusive')
						{ ?>
							<section class="listado_cursos cursos_cercanos section_wrapper mcb-section-inner"><?php 
								/*$direccion=get_field('mapa'); echo $direccion['address']; ?><br /><?php
								echo get_field('municipio_texto').', '.get_field('provincia_texto');
								$address=str_replace(' ','+',$_GET['direccion_c']);
								$curl = curl_init();
									//curl_setopt($curl, CURLOPT_URL, 'https://maps.googleapis.com/maps/api/geocode/json?key=AIzaSyBboTKeNhIb48HqYWeDzpQKrirI1pI_vZM&address='.$address);
									curl_setopt($curl, CURLOPT_URL, 'https://maps.googleapis.com/maps/api/geocode/json?key=AIzaSyBP9OVPkIgTmQhuMr5kdT7JNHBEmv7cuLU&language=es-ES&address='.$address);
									curl_setopt ($curl, CURLOPT_RETURNTRANSFER, 1);
									$json = curl_exec($curl);
									if (curl_error($curl)) {
										$error_msg = curl_error($curl);
									}
								curl_close ($curl);
								
								restore_error_handler();
								$output= json_decode($json);
								$location['lat']=$output->results[0]->geometry->location->lat;
								$location['long']=$output->results[0]->geometry->location->lng;
								$address_components=$output->results[0]->address_components;*/
								$cursos_a_excluir=get_cursos_autoescuela();
								if($cursos_a_excluir)
								{
									$array_cursos_a_excluir=array();
									foreach($cursos_a_excluir as $curso_a_excluir)
									{
										$array_cursos_a_excluir[]=$curso_a_excluir->ID;
									}
								}
								$cursos_a_mostrar=get_cursos_en_radio(array('lat' => $direccion['lat'],'long' => $direccion['lng']),25,'posts','start_date','all',$array_cursos_a_excluir);
								if(!$cursos_a_mostrar)
								{
									$cursos_a_mostrar=get_cursos_en_radio(array('lat' => $direccion['lat'],'long' => $direccion['lng']),50,'posts','start_date','all',$array_cursos_a_excluir);
								}
								/*$autoescuelas=get_posts(
									array(
										'post_type' => 'autoescuela',
										'numberposts' => -1,
										'exclude' => array(get_the_id()),
										'meta_key'		=> 'provincia_texto',
										'meta_value'	=> get_field('provincia_texto',get_the_id()),
									)
								);
								
								$cursos=array();
								foreach($autoescuelas as $autoescuela)
								{
									$cursos_actuales=get_posts(array(
										'post_type' => 'product',
										'numberposts' => -1,
										'meta_query' => array(
											array(
												'key' => 'autoescuela', // name of custom field
												'value' => '"' . $autoescuela->ID . '"', // matches exactly "123", not just 123. This prevents a match for "1234"
												'compare' => 'LIKE'
											)
										)
									));
									if($cursos_actuales)
									{
										if(current_user_can('administrator')){ echo "-";print_r($cursos_actuales);echo "-"; }
										$cursos=array_merge($cursos,$cursos_actuales);
									}
								}
								if(count($cursos) > 8)
								{
									$cursos_a_mostrar=array_rand($cursos,8);
								}
								else
								{
									$cursos_a_mostrar=array_rand($cursos,count($cursos));
								}
								if($cursos_a_mostrar)
								{ ?>
									<div class="titulo_cursos"><?php _e('Cursos encontrados cerca de ti','academiadeltransportista'); ?></div>
									<div class="listado_cursos_inner"><?php
										foreach($cursos_a_mostrar as $num_curso)
										{
											build_related_product($cursos[$num_curso]);
										} ?>
									</div><?php
								}*/
								
								if($cursos_a_mostrar)
								{ ?>
									<div class="titulo_cursos"><?php _e('Cursos encontrados cerca de ti','academiadeltransportista'); ?></div>
									<div class="listado_cursos_inner"><?php
										if(count($cursos_a_mostrar) >= 8)
										{
											for($i=0;$i<=7;$i++)
											{
												build_related_product($cursos_a_mostrar[$i]);
											}
										}
										else
										{
											for($i=0;$i<count($cursos_a_mostrar);$i++)
											{
												build_related_product($cursos_a_mostrar[$i]);
											}
										} ?>
									</div><?php
								} ?>
							</section><?php
						}
						else
						{ 
							if($nivel_microsite == 'pro' && !$cursos)
							{ ?>
								<section class="listado_cursos cursos_cercanos section_wrapper mcb-section-inner"><?php
									/*$autoescuelas=get_posts(
										array(
											'post_type' => 'autoescuela',
											'numberposts' => -1,
											'exclude' => array(get_the_id()),
											'meta_key'		=> 'provincia',
											'meta_value'	=> get_field('provincia',get_the_id()),
										)
									);
									$cursos=array();
									foreach($autoescuelas as $autoescuela)
									{
										$cursos_actuales=get_posts(array(
											'post_type' => 'product',
											'numberposts' => -1,
											'meta_query' => array(
												array(
													'key' => 'autoescuela', // name of custom field
													'value' => '"' . $autoescuela->ID . '"', // matches exactly "123", not just 123. This prevents a match for "1234"
													'compare' => 'LIKE'
												)
											),
											'meta_key'			=> 'fecha_inicio',
											'orderby'			=> 'meta_value',
											'order'				=> 'ASC'
										));
										if($cursos_actuales)
										{
											$cursos=array_merge($cursos,$cursos_actuales);
										}
									}*/
									/*print_r($cursos);*/
									$cursos=get_cursos_en_radio(array('lat' => $direccion['lat'],'long' => $direccion['lng']),25,'posts','start_date','all',$array_cursos_a_excluir);
									if(!$cursos)
									{
										$cursos=get_cursos_en_radio(array('lat' => $direccion['lat'],'long' => $direccion['lng']),50,'posts','start_date','all',$array_cursos_a_excluir);
									}
									if(!empty($cursos))
									{
										$tope=count($cursos);
										if($tope > 8)
										{
											$cursos_a_mostrar=array_rand($cursos,8);
										}
										else
										{
											$cursos_a_mostrar=array_rand($cursos,$tope);
										}
									}
									
									if($cursos_a_mostrar)
									{ ?>
										<div class="titulo_cursos"><?php _e('Cursos encontrados cerca de ti','academiadeltransportista'); ?></div>
										<div class="listado_cursos_inner"><?php
											foreach($cursos_a_mostrar as $num_curso)
											{
												build_related_product($cursos[$num_curso]);
											} ?>
										</div><?php
									} ?>
								</section><?php
							}
							else
							{ ?>
								<section class="listado_cursos proximos_cursos section_wrapper mcb-section-inner">
									<div class="titulo_cursos"><?php _e('Cursos en este centro','academiadeltransportista'); ?></div>
									<div class="listado_cursos_inner"><?php 
										if($cursos)
										{
											foreach($cursos as $curso)
											{
												build_related_product($curso);
											}
										}
										else
										{ ?>
                                        	<div class="sin_cursos"><div class="icon" style="border-color:<?php echo $color_microsite; ?>;"><?php echo file_get_contents(get_stylesheet_directory().'/img/microsites/X.svg'); ?></div><div><?php _e('Actualmente no hay cursos','academiadeltransportista'); ?></div></div><?php											
										} ?>
									</div>
								</section><?php
							}
						} ?>
					</div><?php
				} ?>
			</div>
		</div><?php 
	} ?>
	<div itemscope itemtype="http://schema.org/LocalBusiness">
	  <meta itemprop="name" content="<?php echo get_the_title(); ?>">
	  <div itemprop="address" itemscope itemtype="http://schema.org/PostalAddress">
		<?php if($direccion['address'] != ''){ ?> <meta itemprop="streetAddress" content="<?php echo $direccion['address']; ?>"> <?php } ?>     
		<?php if(get_field('municipio_texto') != ''){ ?> <meta itemprop="addressLocality" content="<?php echo get_field('municipio_texto') ?>"> <?php } ?>    
		<?php if(get_field('provincia_texto') != ''){ ?> <meta itemprop="addressRegion" content="<?php echo get_field('provincia_texto') ?>"> <?php } ?>    
		<meta itemprop="addressCountry" content="ES">    
	  </div>
	<?php if(get_field('telefono_fijo') != ''){ ?> <meta itemprop="telephone" content="<?php echo get_field('telefono_fijo')?>"> <?php } ?>
	<?php if(get_field('e-mail') != ''){ ?> <meta itemprop="email" content="<?php echo get_field('e-mail')?>"> <?php } ?>
	
	  <div itemprop="image" itemscope itemtype="https://schema.org/ImageObject">
		<?php if($logo != ''){ ?> <meta itemprop="url" content="<?php echo $logo; ?>">
		<?php }	else { ?> <meta itemprop="url" content="<?php echo get_bloginfo('stylesheet_directory'); ?>/img/microsites/logo_generico.png"> <?php } ?>
		<meta itemprop="width" content="260">
		<meta itemprop="height" content="67">
	  </div>       
	
	</div><?php 
	get_footer('microsite');
}
elseif($_GET['v']=='y')
{
	get_template_part('template-parts/votar-autoescuela');
}
else
{
	get_template_part('template-parts/edit-microsite-2020-template');
}