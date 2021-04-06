<?php
/**
 * The Template for displaying all single posts.
 *
 * @package Betheme
 * @author Muffin group
 * @link https://muffingroup.com
 */

/*if(current_user_can('administrator')){ //print_r(get_post_meta(get_the_id()));
	$usuarios=get_users(); ?>
    <ul><?php
	foreach($usuarios as $usuario)
	{ ?>
    	<li><?php echo $usuario->ID; print_r(get_field('autoescuelas','user_'.$usuario->ID)); ?></li><?php    
	} ?>
	</ul><?php 
}*/
/*if(current_user_can('administrator'))
{
	print_r(get_microsite_level());
}*/
if(true)/*$_SERVER['REMOTE_ADDR'] == '79.151.197.3' || $_SERVER['REMOTE_ADDR'] == '79.157.32.81')*/
{/*print_r(get_post_meta(get_the_id()));*/
	if($_GET['edit']!='true' && $_GET['v']!='y')
	{
		$nivel_microsite=get_microsite_level();
		get_header('microsite');
		while(have_posts())
		{
			the_post(); ?>
			<!-- #Content -->
            <div class="post_id_custom" post_id="<?php echo get_the_id(); ?>"></div>
			<div id="Content" class="microsite-<?php echo $nivel_microsite; ?> default_template" microsite-color="<?php if(get_field('color_microsite') != ''){ echo str_replace('#','',get_field('color_microsite')); }else{ ?>FF6600<?php } ?>">
	            <a class="back_button" href="<?php echo get_bloginfo('url'); ?>" target="_blank">Ir a Academia del Transportista</a>
				<div class="content_wrapper clearfix"><?php
					$logo=get_the_post_thumbnail_url();
					$imagen_cabecera=get_field('imagen_cabecera'); ?>
					<div class="header_microsite" style="background:url(<?php if($imagen_cabecera){ echo $imagen_cabecera['url']; }else{ ?><?php echo get_bloginfo('stylesheet_directory'); ?>/img/microsites/cabecera_generica.png<?php } ?>);">
						<div class="cabecera_contenido">
							<div class="logo_principal"><?php 
								if($nivel_microsite != '')
								{
									if($logo != '')
									{ ?>
										<img style="border-color:<?php if(get_field('color_microsite') != ''){ the_field('color_microsite'); }else{ ?>#FF6600<?php } ?>;" alt="<?php echo get_the_title(); ?> - Autoescuela - <?php echo get_field('municipio_texto'); ?>" title="<?php echo get_the_title(); ?> - Autoescuela - <?php echo get_field('municipio_texto'); ?>" src="<?php echo $logo; ?>" /><?php
									}
									else
									{ ?>
										<img style="border-color:<?php if(get_field('color_microsite') != ''){ the_field('color_microsite'); }else{ ?>#FF6600<?php } ?>;" alt="<?php echo get_the_title(); ?> - Autoescuela - <?php echo get_field('municipio_texto'); ?>" title="<?php echo get_the_title(); ?> - Autoescuela - <?php echo get_field('municipio_texto'); ?>" src="<?php echo get_bloginfo('stylesheet_directory'); ?>/img/microsites/logo_generico.png" /><?php						
									}
								} ?>
							</div>
							<div class="texto_cabecera">
								<h1 class="titulo"><?php echo get_the_title(); ?></h1><?php
								if(get_field('texto_cabecera') != '')
								{ ?>
									<h2 class="descripcion"><?php the_field('texto_cabecera'); ?></h2><?php
								} ?>
							</div>
							<div class="valoraciones"><?php //print_r(get_post_meta(get_the_id()));
								if(true)/*get_current_user_id() == 6)*/
								{ ?>
                                	<div class="val">
										<p class="titulo">Valoración:</p><?php
	                                	get_star_rating(get_the_id()); ?>
									</div>
                                    <p class="message_placeholder"></p><?php
								}
								else
								{ ?>
                                    <div class="las_estrellas"><?php
                                        echo file_get_contents(get_stylesheet_directory().'/img/microsites/stars.svg'); ?>
                                    </div>
                                    <?php echo do_shortcode('[gdrts_stars_rating_auto]'); //echo Custom_Ratings_Public::vote(); ?><?php
								} ?>
							</div>
							<a href="#" class="microsite_main_cta microsite_form_trigger" style="background:<?php if(get_field('color_microsite') != ''){ the_field('color_microsite'); }else{ ?>#FF6600<?php } ?>;">Solicita información</a>
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
                            <section class="detalles_autoescuela section_wrapper mcb-section-inner">
                                <div class="section_gutter">
                                    <div class="horarios_ubicacion column mcb-column one-second column_column">
                                        <div class="titulo">Horarios y ubicación</div><?php
                                        if($nivel_microsite != '')
                                        { ?>
                                            <div class="elemento horario"><div class="icono" style="background-color:<?php if(get_field('color_microsite') != ''){ the_field('color_microsite'); }else{ ?>#FF6600<?php } ?>;"></div><?php the_field('horario'); ?></div><?php
                                        } ?>
                                        <div class="elemento ubicacion">
                                            <div class="icono" style="background-color:<?php if(get_field('color_microsite') != ''){ the_field('color_microsite'); }else{ ?>#FF6600<?php } ?>;"></div><?php 
                                                $direccion=get_field('mapa'); echo $direccion['address']; ?><br /><?php
                                                echo get_field('municipio_texto').', '.get_field('provincia_texto'); ?>
                                            </div>
                                        <div class="separador" style="background-color:<?php if(get_field('color_microsite') != ''){ the_field('color_microsite'); }else{ ?>#FF6600<?php } ?>;"></div>
                                    </div>
                                    <div class="telefonos column mcb-column one-second column_column">
                                        <div class="telefonos_container"><?php
                                            if($nivel_microsite != '')
                                            { ?>
                                                <div class="titulo">Datos de contacto</div><?php
                                                if(get_field('telefono_fijo') != '' || get_field('telefono_movil') != '')
                                                { ?>
                                                    <ul class="telefonos"><?php
                                                        if(get_field('telefono_fijo') != '')
                                                        { ?>
                                                            <li class="elemento"><div class="icono" style="background-color:<?php if(get_field('color_microsite') != ''){ the_field('color_microsite'); }else{ ?>#FF6600<?php } ?>;"></div><?php the_field('telefono_fijo'); ?><?php /*<div class="mascara tlf" style="background-color:<?php if(get_field('color_microsite') != ''){ the_field('color_microsite'); }else{ ?>#FF6600<?php } ?>;"><span><?php _e('Mostrar teléfono'); ?></span></div>*/ ?></li><?php
                                                        }
                                                        if(get_field('telefono_movil') != '')
                                                        { ?>
                                                            <li class="elemento"><div class="icono" style="background-color:<?php if(get_field('color_microsite') != ''){ the_field('color_microsite'); }else{ ?>#FF6600<?php } ?>;"></div><?php the_field('telefono_movil'); ?><?php /*<div class="mascara mov" style="background-color:<?php if(get_field('color_microsite') != ''){ the_field('color_microsite'); }else{ ?>#FF6600<?php } ?>;"><span><?php _e('Mostrar móvil'); ?></div>*/ ?></li><?php
                                                        } ?>
                                                    </ul><?php
                                                }
                                                if(get_field('e-mail') != '')
                                                { ?>
                                                    <ul class="email">
                                                        <li class="elemento"><div class="icono" style="background-color:<?php if(get_field('color_microsite') != ''){ the_field('color_microsite'); }else{ ?>#FF6600<?php } ?>;"></div><?php the_field('e-mail'); ?><?php /*<div class="mascara mail" style="background-color:<?php if(get_field('color_microsite') != ''){ the_field('color_microsite'); }else{ ?>#FF6600<?php } ?>;"><span><?php _e('Mostrar mail'); ?></span></div>*/ ?></li>
                                                    </ul><?php
                                                }
                                            }
                                            else
                                            { ?>
                                                <div class="titulo">Solicita información de contacto</div>
                                                <a href="#" class="microsite_main_cta microsite_form_trigger" style="background-color:<?php if(get_field('color_microsite') != ''){ the_field('color_microsite'); }else{ ?>#FF6600<?php } ?>;">Te llamamos gratis</a><?php
                                            } ?>
                                        </div>
                                    </div>
                                </div>
                            </section>
                            <section class="conoce_autoescuela section_wrapper mcb-section-inner">
                                <div class="titulo_2"><?php _e('Conoce la autoescuela','academiadeltransportista'); ?></div>
                                <div class="logo column mcb-column two-fifth column_column"><?php
                                    if($nivel_microsite != '')
                                    {
                                        if($logo != '')
                                        { ?>
                                            <img style="border-color:<?php if(get_field('color_microsite') != ''){ the_field('color_microsite'); }else{ ?>#FF6600<?php } ?>;" alt="<?php echo get_the_title(); ?> - Autoescuela - <?php echo get_field('municipio_texto'); ?>" title="<?php echo get_the_title(); ?> - Autoescuela - <?php echo get_field('municipio_texto'); ?>" src="<?php echo $logo; ?>" /><?php
                                        }
                                        else
                                        { ?>
                                            <img style="border-color:<?php if(get_field('color_microsite') != ''){ the_field('color_microsite'); }else{ ?>#FF6600<?php } ?>;" alt="<?php echo get_the_title(); ?> - Autoescuela - <?php echo get_field('municipio_texto'); ?>" title="<?php echo get_the_title(); ?> - Autoescuela - <?php echo get_field('municipio_texto'); ?>" src="<?php echo get_bloginfo('stylesheet_directory'); ?>/img/microsites/logo_generico.png" /><?php						
                                        }
                                    } ?>
                                </div>
                                <div class="textos column mcb-column three-fifth column_column">
                                    <div class="titulo_descripcion"><?php 
                                        if(get_field('titulo_texto_informacion') != '')
                                        {
                                            the_field('titulo_texto_informacion');
                                        }
                                        /*else
                                        {
                                            _e('No hay texto descriptivo actualmente','academiadeltransportista');
                                        }*/ ?>
                                    </div>
                                    <div class="texto_descripcion"><?php 
                                        if(get_field('texto_informacion') != '')
                                        {
                                            the_field('texto_informacion');
                                        }
                                        /*else
                                        {
                                            _e('No hay texto explicativo','academiadeltransportista');
                                        }*/ ?>
                                    </div>
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
                                <div class="the_cta" style="background-color:<?php if(get_field('color_microsite') != ''){ the_field('color_microsite'); }else{ ?>#FF6600<?php } ?>;">
                                    <div class="textos column mcb-column three-fifth column_column">
                                        <div class="gutter">
                                            <div class="titulo_2">Confía en nuestros docentes y en nuestra experiencia</div>
                                            <a href="#" class="microsite_main_cta microsite_form_trigger" style="background:<?php if(get_field('color_microsite') != ''){ the_field('color_microsite'); }else{ ?>#FF6600<?php } ?>;"><?php _e('Quiero matricularme','academiadeltransportista'); ?></a>
                                        </div>
                                    </div>
                                    <div class="imagen column mcb-column two-fifth column_column">
                                        <div class="gutter">
                                            <img alt="Contacta ahora con <?php the_title(); ?>" title="Contacta ahora con <?php the_title(); ?>" src="<?php echo get_bloginfo('stylesheet_directory'); ?>/img/microsites/icono-cta.png" />
                                        </div>
                                    </div>
                                </div>
                            </section>
                            <section class="cursos_genericos section_wrapper mcb-section-inner">
                                <div class="cabecera_mobile" style="display:none;">Cursos que ofrecemos</div>
                                <div class="cursos_genericos_1 column mcb-column one-third column_column">
                                    <div class="gutter">
                                        <div class="cabecera"></div>
                                        <div class="titulo_3" style="background-color:<?php if(get_field('color_microsite') != ''){ the_field('color_microsite'); }else{ ?>#FF6600<?php } ?>;"><?php _e('Autoescuela','academiadeltransportista'); ?></div><?php
                                        $cursos_autoescuela=get_field('cursos_ofrecidos_tipo_autoescuela');
                                        if($cursos_autoescuela)
                                        { ?>
                                            <ul class="cursos"><?php
                                                foreach($cursos_autoescuela as $curso)
                                                { ?>
                                                    <li style="border-color:<?php if(get_field('color_microsite') != ''){ the_field('color_microsite'); }else{ ?>#FF6600<?php } ?>;">
                                                        <div class="icon" style="border-color:<?php if(get_field('color_microsite') != ''){ the_field('color_microsite'); }else{ ?>#FF6600<?php } ?>;"><?php
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
                                                            case 'curso-obtencion-carnet-remolque-b-e': 
                                                                echo file_get_contents(get_stylesheet_directory().'/img/microsites/icono-remolque.svg');
                                                                break;
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
                                                            <a href="#" class="microsite_form_trigger trigger_curso" style="color:<?php if(get_field('color_microsite') != ''){ the_field('color_microsite'); }else{ ?>#FF6600<?php } ?>;"><?php _e('Pedir información','academiadeltransportista'); ?></a>
                                                        </div>
                                                    </li><?php
                                                }
                                                $cursos_autoescuela_adicionales=get_field('cursos_ofrecidos_tipo_autoescuela_adicionales');
                                                if($cursos_autoescuela_adicionales)
                                                { 
                                                    foreach($cursos_autoescuela_adicionales as $curso_autoescuela_adicional)
                                                    { ?>
                                                        <li style="border-color:<?php if(get_field('color_microsite') != ''){ the_field('color_microsite'); }else{ ?>#FF6600<?php } ?>;">
                                                            <div class="icon" style="border-color:<?php if(get_field('color_microsite') != ''){ the_field('color_microsite'); }else{ ?>#FF6600<?php } ?>;"></div>
                                                            <div class="texto">
                                                                <h3 class="titulo"><?php echo $curso_autoescuela_adicional['nombre']; ?></h3>
                                                                <a href="#" class="microsite_form_trigger trigger_curso" style="color:<?php if(get_field('color_microsite') != ''){ the_field('color_microsite'); }else{ ?>#FF6600<?php } ?>;"><?php _e('Pedir información','academiadeltransportista'); ?></a>
                                                            </div>
                                                        </li><?php
                                                    }
                                                } ?>
                                            </ul><?php
                                        }
                                        else
                                        { ?>
                                            <div class="sin_cursos"><?php _e('Actualmente no hay cursos','academiadeltransportista'); ?></div><?php
                                        } ?>
                                    </div>
                                </div>
                                <div class="cursos_genericos_2 textos column mcb-column one-third column_column">
                                    <div class="gutter">
                                        <div class="cabecera"><div class="titulo_2">Cursos que ofrecemos</div></div>
                                        <div class="titulo_3" style="background-color:<?php if(get_field('color_microsite') != ''){ the_field('color_microsite'); }else{ ?>#FF6600<?php } ?>;"><?php _e('Transporte','academiadeltransportista'); ?></div><?php
                                        $cursos_transporte=get_field('cursos_ofrecidos_tipo_transporte');
                                        if($cursos_transporte)
                                        { ?>
                                            <ul class="cursos"><?php
                                                foreach($cursos_transporte as $curso)
                                                { ?>
                                                    <li style="border-color:<?php if(get_field('color_microsite') != ''){ the_field('color_microsite'); }else{ ?>#FF6600<?php } ?>;">
                                                        <div class="icon" style="border-color:<?php if(get_field('color_microsite') != ''){ the_field('color_microsite'); }else{ ?>#FF6600<?php } ?>;"><?php
                                                        switch($curso['value'])
                                                        {
                                                            case 'curso-renovacion-del-cap': 
                                                                echo file_get_contents(get_stylesheet_directory().'/img/microsites/icono-CAP.svg');
                                                                break;
                                                            case 'curso-obtencion-cap-inicial': 
                                                                echo file_get_contents(get_stylesheet_directory().'/img/microsites/icono-CAP.svg');
                                                                break;
                                                            case 'curso-obtencion-mercancias-peligrosas': 
                                                                echo file_get_contents(get_stylesheet_directory().'/img/microsites/icono-seguridad.svg');
                                                                break;
                                                            case 'curso-renovacion-adr': 
                                                                echo file_get_contents(get_stylesheet_directory().'/img/microsites/icono-ADR.svg');
                                                                break;
                                                            case 'curso-obtencion-titulo-de-transportista': 
                                                                echo file_get_contents(get_stylesheet_directory().'/img/microsites/icono-camion.svg');
                                                                break;
                                                            case 'curso-consejero-de-seguridad-adr': 
                                                                echo file_get_contents(get_stylesheet_directory().'/img/microsites/icono-ADR.svg');
                                                                break;
                                                            case 'curso-conductor-ambulancia': 
                                                                echo file_get_contents(get_stylesheet_directory().'/img/microsites/icono-conductor-ambulancia.svg');
                                                                break;
                                                        } ?>
                                                        </div>
                                                        <div class="texto">
                                                            <h3 class="titulo"><?php echo $curso['label']; ?></h3>
                                                            <a href="#" class="microsite_form_trigger trigger_curso" style="color:<?php if(get_field('color_microsite') != ''){ the_field('color_microsite'); }else{ ?>#FF6600<?php } ?>;"><?php _e('Pedir información','academiadeltransportista'); ?></a>
                                                        </div>
                                                    </li><?php
                                                }
                                                $cursos_transporte_adicionales=get_field('cursos_ofrecidos_tipo_transporte_adicionales');
                                                if($cursos_transporte_adicionales)
                                                { 
                                                    foreach($cursos_transporte_adicionales as $curso_transporte_adicional)
                                                    { ?>
                                                        <li style="border-color:<?php if(get_field('color_microsite') != ''){ the_field('color_microsite'); }else{ ?>#FF6600<?php } ?>;">
                                                            <div class="icon" style="border-color:<?php if(get_field('color_microsite') != ''){ the_field('color_microsite'); }else{ ?>#FF6600<?php } ?>;"></div>
                                                            <div class="texto">
                                                                <h3 class="titulo"><?php echo $curso_transporte_adicional['nombre']; ?></h3>
                                                                <a href="#" class="microsite_form_trigger trigger_curso" style="color:<?php if(get_field('color_microsite') != ''){ the_field('color_microsite'); }else{ ?>#FF6600<?php } ?>;"><?php _e('Pedir información','academiadeltransportista'); ?></a>
                                                            </div>
                                                        </li><?php
                                                    }
                                                } ?>
                                            </ul><?php
                                        }
                                        else
                                        { ?>
                                            <div class="sin_cursos"><?php _e('Actualmente no hay cursos','academiadeltransportista'); ?></div><?php
                                        } ?>
                                    </div>
                                </div>
                                <div class="cursos_genericos_3 textos column mcb-column one-third column_column">
                                    <div class="gutter">
                                        <div class="cabecera"></div>
                                        <div class="titulo_3" style="background-color:<?php if(get_field('color_microsite') != ''){ the_field('color_microsite'); }else{ ?>#FF6600<?php } ?>;"><?php _e('Más cursos','academiadeltransportista'); ?></div><?php
                                        $cursos_otros=get_field('cursos_ofrecidos_tipo_mas_cursos');
                                        if($cursos_otros)
                                        { ?>
                                            <ul class="cursos"><?php
                                                foreach($cursos_otros as $curso)
                                                { ?>
                                                    <li style="border-color:<?php if(get_field('color_microsite') != ''){ the_field('color_microsite'); }else{ ?>#FF6600<?php } ?>;">
                                                        <div class="icon" style="border-color:<?php if(get_field('color_microsite') != ''){ the_field('color_microsite'); }else{ ?>#FF6600<?php } ?>;"><?php
                                                        switch($curso['value'])
                                                        {
                                                            case 'curso-de-carretillas-elevadoras': 
                                                                echo file_get_contents(get_stylesheet_directory().'/img/microsites/icono-carretilla.svg');
                                                                break;
                                                            case 'curso-grua-camion-pluma': 
                                                                echo file_get_contents(get_stylesheet_directory().'/img/microsites/icono-camion-pluma.svg');
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
                                                        } ?>
                                                        </div>
                                                        <div class="texto">
                                                            <h3 class="titulo"><?php echo $curso['label']; ?></h3>
                                                            <a href="#" class="microsite_form_trigger trigger_curso" style="color:<?php if(get_field('color_microsite') != ''){ the_field('color_microsite'); }else{ ?>#FF6600<?php } ?>;"><?php _e('Pedir información','academiadeltransportista'); ?></a>
                                                        </div>
                                                    </li><?php
                                                }
                                                $cursos_mas_adicionales=get_field('cursos_ofrecidos_tipo_mas_cursos_adicionales');
                                                if($cursos_mas_adicionales)
                                                { 
                                                    foreach($cursos_mas_adicionales as $curso_mas_adicional)
                                                    { ?>
                                                        <li style="border-color:<?php if(get_field('color_microsite') != ''){ the_field('color_microsite'); }else{ ?>#FF6600<?php } ?>;">
                                                            <div class="icon" style="border-color:<?php if(get_field('color_microsite') != ''){ the_field('color_microsite'); }else{ ?>#FF6600<?php } ?>;"></div>
                                                            <div class="texto">
                                                                <h3 class="titulo"><?php echo $curso_mas_adicional['nombre']; ?></h3>
                                                                <a href="#" class="microsite_form_trigger trigger_curso" style="color:<?php if(get_field('color_microsite') != ''){ the_field('color_microsite'); }else{ ?>#FF6600<?php } ?>;"><?php _e('Pedir información','academiadeltransportista'); ?></a>
                                                            </div>
                                                        </li><?php
                                                    }
                                                } ?>
                                            </ul><?php
                                        }
                                        else
                                        { ?>
                                            <div class="sin_cursos"><?php _e('Actualmente no hay cursos','academiadeltransportista'); ?></div><?php
                                        } ?>
                                    </div>
                                </div>
                            </section><?php
                            if(true)/*get_current_user_id() == 6)*/
                            {
								if(get_field('color_microsite') != '')
								{
									set_query_var('color_microsite',get_field('color_microsite'));
								}
								else
								{
									set_query_var('color_microsite','#FF6600');
                                }						
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
                                        $autoescuelas=get_posts(
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
                                                ),
                                                'meta_key'			=> 'fecha_inicio',
                                                'orderby'			=> 'meta_value',
                                                'order'				=> 'ASC'
                                            ));
                                            if($cursos_actuales)
                                            {
                                                $cursos=array_merge($cursos,$cursos_actuales);
                                            }
                                        }
                                        /*print_r($cursos);*/
                                        $cursos_a_mostrar=array_rand($cursos,8);
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
                                            foreach($cursos as $curso)
                                            {
                                                build_related_product($curso);
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
		get_template_part('template-parts/edit-microsite-template');
	}
}
else
{
	get_header(); ?>
	
	<!-- #Content -->
	<div id="Content"><?php //print_r(get_post_meta(get_the_id())); ?>
		<div class="content_wrapper clearfix">
			<!-- .sections_group -->
			<div class="sections_group microsite">
				<?php /*<section class="header_microsite">
					<section class="section_wrapper">
					</section>
				</section>
				<section class="body_microsite section_wrapper">
					<div class="datos">
						<div class="bloque">Horario</div>
						<div class="bloque">Contacto</div>
						<div class="bloque">Ubicación</div>
					</div>
					<div class="description">
						<div class="logo"></div>
						<div class="text"></div>
					</div>
					<div class="imagenes">
						<div class="imagen"></div>
						<div class="imagen"></div>
					</div>
					<div class="cta">
						<div class="texto">
							Conoce nuestros centros de formación y nuestra metodología de aprendizaje
						</div>
						<a href="#">Contáctanos</a>
					</div>
					<div class="cursos_genericos">
						<h2>Cursos genéricos</h2>
						Aquí van los cursos
					</div>
					<div class="otros_cursos">
						<h2>Otros cursos</h2>
						Aquí van los cursos
					</div>
				</section><?php */
				if( get_post_meta( get_the_ID(), 'mfn-post-template', true ) == 'builder' )
				{
					// Template | Builder -----------------------------------------------	
					$single_post_nav = array(
						'hide-sticky'	=> false,
						'in-same-term'	=> false,
					);
					$opts_single_post_nav = mfn_opts_get( 'prev-next-nav' );
					if(isset($opts_single_post_nav['hide-sticky']))
					{
						$single_post_nav['hide-sticky'] = true;
					}
					// single post navigation | sticky
					if(!$single_post_nav['hide-sticky'])
					{
						if(isset($opts_single_post_nav['in-same-term']))
						{
							$single_post_nav['in-same-term'] = true;
						}
							
						$post_prev = get_adjacent_post( $single_post_nav['in-same-term'], '', true );
						$post_next = get_adjacent_post( $single_post_nav['in-same-term'], '', false );
							
						echo mfn_post_navigation_sticky( $post_prev, 'prev', 'icon-left-open-big' );
						echo mfn_post_navigation_sticky( $post_next, 'next', 'icon-right-open-big' );
					}
					while(have_posts())
					{
						the_post();							// Post Loop
						mfn_builder_print( get_the_ID() );	// Content Builder & WordPress Editor Content
					}
				}
				else
				{					
					// Template | Default -----------------------------------------------					
					while(have_posts())
					{
						the_post();
						get_template_part( 'includes/content', 'single' );
					}	
				} ?>
			</div>
			<!-- .four-columns - sidebar --><?php 
			get_sidebar(); ?>			
		</div>
	</div>
	<?php 
	get_footer();
	// Omit Closing PHP Tags
}