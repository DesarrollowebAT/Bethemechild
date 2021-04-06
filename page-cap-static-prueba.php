<?php
/**
 * Template name: CAP Static Prueba ADR Pipe
 */

get_header();

/*$centro_mas_cercano=get_cursos_por_proximidad(1);
$centro_mas_cercano=$centro_mas_cercano[0];
$centro_mas_cercano=get_permalink($centro_mas_cercano->ID); ?>
<script>
	var link_centro_mas_cercano = <?php echo json_encode($centro_mas_cercano); ?>;
</script>*/ ?>
	<!-- #Content --><a name="formulario" id="formulario"></a>
	<div id="Content" class="landing_course_type">
		<div class="content_wrapper clearfix">
			<!-- .sections_group -->
			<div class="sections_group">
				<div class="entry-content" itemprop="mainContentOfPage">
                	<section class="section mcb-section first-section">
                    	<div class="section_wrapper mcb-section-inner">
                        	<div class="wrap mcb-wrap one slide-cap valign-top clearfix">
                            	<div class="mcb-wrap-inner">
                                	<div class="column mcb-column one column_column  column-margin-">
                                    	<div class="column_attr clearfix align_center"><?php
                                        	if(get_field('titulo_principal') != '')
											{ ?>
					                        	<h1 class="main_title"><?php the_field('titulo_principal'); ?></h1><?php
											}
											else
											{ ?>
					                        	<h2 class="main_title"><?php the_title(); ?></h2><?php
											} ?>
                                        </div>
                                    </div>
                                    <div class="column mcb-column three-fifth column_column  column-margin- hide-movil">
                                    </div>
                                    <div class="column mcb-column two-fifth column_column  column-margin- full-width-movil">
                                    	<div class="column_attr clearfix" style="">
											<div class="caja-form-ciudad"><?php
												if(is_page(74827))
												{ ?>
													<p class="titulo-form-ciudad">Ahora tú eliges el horario. Indícanos tus datos para informarte de todo:</p><?php													
												}
												elseif(is_page(8657))
												{ ?>
													<p class="titulo-form-ciudad">Solicita información sin compromiso:</p><?php													
												}
												else
												{ ?>
													<p class="titulo-form-ciudad">Tenemos cursos de mañana, tarde noche y fin de semana cerca de ti</p>
													<p class="titulo-form-ciudad-trans">¿Te interesa este curso? Facilítanos tus datos de contacto</p><?php
												}
												/*echo do_shortcode('[contact-form-7 id="7257" title="Formulario ciudad renovación CAP"]');*/
												echo do_shortcode('[contact-form-7 id="74843" title="Formulario ciudad renovación CAP GENÉRICO_ppipe"]'); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                    <section class="section mcb-section second-section"><?php
						if(have_rows('bloque_textos'))
						{
							while(have_rows('bloque_textos'))
							{
								the_row(); ?>
                                <div class="section_wrapper mcb-section-inner">
                                    <div class="wrap mcb-wrap one slide-cap valign-top clearfix">
                                        <div class="mcb-wrap-inner">
                                            <div class="column mcb-column one-third column_column  column-margin-">
                                                <div class="column_attr clearfix" style=""><h2 class="main_title"><?php the_sub_field('titulo'); ?></h2></div>
                                            </div>
                                            <div class="column mcb-column two-third column_column  column-margin-">
                                                <div class="column_attr clearfix" style="">
                                                    <p class="main_subtitle"><?php the_sub_field('texto'); ?></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="wrap mcb-wrap one slide-cap valign-top clearfix">
                                        <div class="mcb-wrap-inner">
                                            <div class="column mcb-column one-third column_column column-margin-">
                                                <div class="column_attr clearfix" style="">
                                                    <h2 class="title_landing_course_type"><?php the_sub_field('titulo_columna_1'); ?></h2>
                                                    <div class="text_landing_course_type"><?php the_sub_field('texto_columna_1'); ?></div>
                                                </div>
                                            </div>
                                            <div class="column mcb-column one-third column_column column-margin-">
                                                <div class="column_attr clearfix" style="">
                                                    <h2 class="title_landing_course_type <?php if(is_page(33609) || is_page(33619) || is_page(33583)){ ?>vacio<?php } ?>"><?php the_sub_field('titulo_columna_2'); ?></h2>
													<div class="text_landing_course_type grow-column altura-text"><?php the_sub_field('texto_columna_2'); ?></div><?php 
													if(!is_page(33609) && !is_page(33619) && !is_page(33583))
													{ ?>
	                                                    <a class="read_more" href="#"><?php _e('Leer más','academiadeltransportista'); ?></a><?php
													} ?>
                                                </div>
                                            </div>
                                            <div class="column mcb-column one-third column_column column-margin-">
                                                <div class="column_attr clearfix" style="">
                                                    <h2 class="title_landing_course_type"><?php the_sub_field('titulo_columna_3'); ?></h2>
                                                    <div class="text_landing_course_type grow-column"><?php the_sub_field('texto_columna_3'); ?></div>
                                                    <a class="read_more" href="#"><?php _e('Leer más','academiadeltransportista'); ?></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="wrap mcb-wrap one slide-cap valign-top clearfix otra-columna">
                                        <div class="mcb-wrap-inner">
                                            <div class="column mcb-column one-third column_column column-margin-">
                                                <div class="column_attr clearfix" style="">
                                                    <h2 class="title_landing_course_type"><?php the_sub_field('titulo_columna_4'); ?></h2>
                                                    <div class="text_landing_course_type"><?php the_sub_field('texto_columna_4'); ?></div>
                                                </div>
                                            </div>
                                            <div class="column mcb-column one-third column_column column-margin-">
                                                <div class="column_attr clearfix" style="">
                                                    <h2 class="title_landing_course_type"><?php the_sub_field('titulo_columna_5'); ?></h2>
                                                    <div class="text_landing_course_type grow-column"><?php the_sub_field('texto_columna_5'); ?></div>
                                                    <!--<a class="read_more" href="#"><?php _e('Leer más','academiadeltransportista'); ?></a>-->
                                                </div>
                                            </div>
                                            <div class="column mcb-column one-third column_column column-margin-">
                                                <div class="column_attr clearfix" style="">
                                                    <h2 class="title_landing_course_type"><?php the_sub_field('titulo_columna_6'); ?></h2><?php 
                                                    if(!is_page(71674))
													{ ?>
                                                    <div class="text_landing_course_type"><?php the_sub_field('texto_columna_6'); ?></div><?php 
													}
                                                    if(is_page(71674))
													{ ?>
                                                    <div class="text_landing_course_type grow-column"><?php the_sub_field('texto_columna_6'); ?></div>
	                                                    <a class="read_more" href="#"><?php _e('Leer más','academiadeltransportista'); ?></a><?php
													} ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <?php
                                    if(is_page(8666))
									{ ?>
                                    <div class="titulo-cursos-pedagogicas primer_bloque" style="clear:both;">
                                       <h2 class="main_title"><?php the_field('titulo_bloque_cursos'); ?></h2>
                                    </div>
                                    <div class="bloque-cursos-pedagogicas primer_bloque" style="clear:both;">
                                    	<?php echo do_shortcode( '[products ids="375, 113"] ' ); ?>
                                        <?php echo do_shortcode( '[products ids="366, 365, 370"] ' ); ?>
                                    </div>
                                    <div class="titulo-cursos-pedagogicas segundo_bloque" style="clear:both;">
                                       <h2 class="main_title"><?php the_field('titulo_bloque_cursos_dos'); ?></h2>
                                       <p class="main_title"><?php the_field('subtitulo_bloque_cursos_dos'); ?></p>
                                    </div>
                                    <div class="bloque-cursos-pedagogicas segundo_bloque fila" style="clear:both;">
                                        <?php echo do_shortcode( '[products ids="6450, 125"] ' ); ?>
                                    </div>
                                    <?php
									}?>
                                    
                                    <?php
                                    if(is_page(8663))
									{ ?>
                                    <div class="titulo-cursos-pedagogicas primer_bloque" style="clear:both;">
                                       <h2 class="main_title"><?php the_field('titulo_bloque_cursos'); ?></h2>
                                    </div>
                                    <div class="bloque-cursos-pedagogicas primer_bloque" style="clear:both;">
                                    	<?php echo do_shortcode( '[products ids="179, 377"] ' ); ?>
                                        <?php echo do_shortcode( '[products ids="373, 357, 362"] ' ); ?>
                                    </div>
                                    <div class="titulo-cursos-pedagogicas segundo_bloque" style="clear:both;">
                                       <h2 class="main_title"><?php the_field('titulo_bloque_cursos_dos'); ?></h2>
                                       <p class="main_title"><?php the_field('subtitulo_bloque_cursos_dos'); ?></p>
                                    </div>
                                    <div class="bloque-cursos-pedagogicas segundo_bloque fila" style="clear:both;">
                                        <?php echo do_shortcode( '[products ids="129, 133"] ' ); ?>
                                    </div>
                                    <?php
									}?>
                                    
                                    <?php
									if(!is_page(45023) && !is_page(74827) && !is_page(63527) && !is_page(63505) && !is_page(63531) && !is_page(63567) && !is_page(71674))
									{
										if(is_page(33609) || is_page(33583) || is_page(33619) || is_page(45045) || is_page(71674))
										{ ?>
											<div class="wrap mcb-wrap one slide-cap valign-top clearfix no-search"></div><?php 
										}
										else
										{ ?>
											<div class="wrap mcb-wrap one slide-cap valign-top clearfix">
												<div class="mcb-wrap-inner">
													<div class="column mcb-column one column_column  column-margin-">
														<div class="column_attr clearfix" style=""><?php
															if(!is_page(8657))
															{ ?>
                                                                <h3 class="main_title"><span>Encuentra</span> tu centro más cercano</h3><!-- <?php
                                                                if(is_page(33609) || is_page(33583) || is_page(33619))
                                                                {
                                                                    get_template_part('template-parts/form-buscar-centros');
                                                                }
                                                                else
                                                                { ?> -->
                                                                    <form class="course_search_form" method="get" action="<?php echo get_permalink(97); ?>">
                                                                        <input type="hidden" value="" id="s" name="s">
                                                                        <input type="hidden" value="y" id="bkat" name="bkat"><?php
                                                                        if(is_page(8666))
                                                                        { ?>
                                                                            <input type="hidden" id="tipo_curso" name="tipo_curso" value="30"><?php
                                                                        }
                                                                        elseif(is_page(8663))
                                                                        { ?>
                                                                            <input type="hidden" id="tipo_curso" name="tipo_curso" value="31"><?php 
                                                                        }
                                                                        elseif(is_page(8657))
                                                                        { 
                                                                            /* CAP inicial */ ?>
                                                                            <input type="hidden" id="tipo_curso" name="tipo_curso" value="28"><?php 
                                                                        }
                                                                        elseif(is_page(885))
                                                                        { 
                                                                            /* CAP continua */ ?>
                                                                            <input type="hidden" id="tipo_curso" name="tipo_curso" value="29"><?php 
                                                                        } ?>                                                            
                                                                        <input type="hidden" value="<?php echo $_GET['direccion_c']; ?>" id="direccion_c-landing-course-type" name="direccion_c"><?php
                                                                        if(false)/*is_page(8666) || is_page(8663) || is_page(8657) || is_page(885))*/
                                                                        { ?>
                                                                            <input type="hidden" value="<?php echo $_GET['provincia']; ?>" id="provincia-landing-course-type" name="provincia"><?php
                                                                        }
                                                                        else
                                                                        { ?>
                                                                            <input type="hidden" value="<?php echo $_GET['places_locality']; ?>" id="places_locality-landing-course-type" name="places_locality">
                                                                            <input type="hidden" value="<?php echo $_GET['provincia']; ?>" id="provincia-landing-course-type" name="provincia">
                                                                            <input type="hidden" value="<?php echo $_GET['places_locality_lat']; ?>" id="places_locality_lat-landing-course-type" name="places_locality_lat">
                                                                            <input type="hidden" value="<?php echo $_GET['places_locality_lng']; ?>" id="places_locality_lng-landing-course-type" name="places_locality_lng"><?php
                                                                        } ?>
                                                                        <input type="text" id="pac-input-landing-course-type" class="controls two-third column" <?php if($_GET['direccion_c'] == ''){ ?>placeholder="¿Dónde?"<?php }else{ ?>placeholder="<?php echo $_GET['direccion_c'] ?>" name="direccion_c"<?php } ?> />
                                                                        <button type="submit" class="button one-third column" id="boton_buscar"><?php _e( 'Encontrar centros', 'academiatransportista' ); ?> <img class="spinner" src="<?php echo get_bloginfo('stylesheet_directory'); ?>/img/spinner.gif" /></button>
                                                                    </form><?php
                                                                }
															} ?>
														</div>
													</div>
												</div>
											</div><?php 
										}
									} ?>
                                </div><?php
							}
						} ?>
                    </section>
                    
                    
                    <?php
                    if(is_page(45236))
					{ ?>
                    <section class="section mcb-section second-section bloque-textos-seo"><?php
						if(have_rows('bloque_textos_seo'))
						{
							while(have_rows('bloque_textos_seo'))
							{
								the_row(); ?>
                                <div class="section_wrapper mcb-section-inner">
                                    <div class="wrap mcb-wrap one slide-cap valign-top clearfix">
                                        <div class="mcb-wrap-inner">
                                            <div class="column mcb-column one-third column_column  column-margin-">
                                                <div class="column_attr clearfix" style=""><h2 class="main_title"><?php the_sub_field('titulo_uno'); ?></h2></div>
                                            </div>
                                            <div class="column mcb-column two-third column_column  column-margin-">
                                                <div class="column_attr clearfix" style="">
                                                    <p class="main_subtitle"><?php the_sub_field('texto_uno'); ?></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="wrap mcb-wrap one slide-cap valign-top clearfix">
                                        <div class="mcb-wrap-inner">
                                            <div class="column mcb-column one-third column_column  column-margin-">
                                                <div class="column_attr clearfix" style=""><h2 class="main_title"><?php the_sub_field('titulo_dos'); ?></h2></div>
                                            </div>
                                            <div class="column mcb-column two-third column_column  column-margin-">
                                                <div class="column_attr clearfix" style="">
                                                    <p class="main_subtitle"><?php the_sub_field('texto_dos'); ?></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="wrap mcb-wrap one slide-cap valign-top clearfix">
                                        <div class="mcb-wrap-inner">
                                            <div class="column mcb-column one-third column_column  column-margin-">
                                                <div class="column_attr clearfix" style=""><h2 class="main_title"><?php the_sub_field('titulo_tres'); ?></h2></div>
                                            </div>
                                            <div class="column mcb-column two-third column_column  column-margin-">
                                                <div class="column_attr clearfix" style="">
                                                    <p class="main_subtitle"><?php the_sub_field('texto_tres'); ?></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div><?php
							}
						} ?>
                    </section>
                    <?php } ?>
                    
                    
                    <?php
                    if(is_page(33619))
					{ ?>
                    <section class="section mcb-section examen-section">
                    
                          <div class="section_wrapper mcb-section-inner">
                              <h2 class="titulo-examen"><?php the_field('titulo_examenes'); ?></h2>
                          </div><?php
						if(have_rows('bloque_teorico_practico'))
						{
							while(have_rows('bloque_teorico_practico'))
							{
								the_row(); ?>
                                <div class="section_wrapper mcb-section-inner">
                                    <div class="wrap mcb-wrap one slide-cap valign-top clearfix">
                                        <div class="mcb-wrap-inner">
                                            <div class="column mcb-column one-two column_column column-margin- caja-examen margen-uno">
                                                <div class="column_attr clearfix" style="">
                                                    <img class="icon-examen" src="https://www.academiadeltransportista.com/wp-content/uploads/2020/05/ico-examen-teorico-def.png" /><h3 class="title-tipo-examen"><?php the_sub_field('titulo_columna_one'); ?></h3>
                                                    <div class="text_landing_course_type"><?php the_sub_field('texto_columna_one'); ?></div>
                                                </div>
                                            </div>
                                            <div class="column mcb-column one-two column_column column-margin- caja-examen margen-dos">
                                                <div class="column_attr clearfix" style="">
                                                    <img class="icon-examen" src="https://www.academiadeltransportista.com/wp-content/uploads/2020/05/ico-examen-practico.png" /><h3 class="title-tipo-examen"><?php the_sub_field('titulo_columna_two'); ?></h3>
                                                    <div class="text_landing_course_type grow-column"><?php the_sub_field('texto_columna_two'); ?></div>
                                                </div>
                                            </div><?php
							}
						} ?>
                        <?php
						if(have_rows('bloque_circuito_cerrado'))
						{
							while(have_rows('bloque_circuito_cerrado'))
							{
								the_row(); ?>
                                <div class="section_wrapper mcb-section-inner">
                                    <div class="wrap mcb-wrap one slide-cap valign-top clearfix">
                                        <div class="mcb-wrap-inner">
                                            <div class="column mcb-column column_column column-margin- caja-examen margen-cerrado">
                                                <div class="column_attr clearfix" style="">
                                                    <img class="icon-examen" src="https://www.academiadeltransportista.com/wp-content/uploads/2020/05/ico-circuito-cerrado.png" /><h3 class="title-tipo-examen"><?php the_sub_field('titulo_circuito'); ?></h3>
                                                    <div class="text_landing_course_type"><?php the_sub_field('texto_circuito'); ?></div>
                                                    <hr>
                                                    <p class="title-maniobra"><?php the_sub_field('titulo_maniobra-uno'); ?></p>
                                                    <div class="caja-maniobra">
                                                    	<?php 
														 $image = get_sub_field('imagen_maniobra_uno');
														 if( !empty( $image ) ): ?>
															<img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
														<?php endif; ?>
                                                        <div class="text-maniobra"><?php the_sub_field('texto_maniobra_uno'); ?></div>
                                                    </div>
                                                    <hr></span>
                                                    <p class="title-maniobra"><?php the_sub_field('titulo_maniobra-dos'); ?></p>
                                                    <div class="caja-maniobra">
                                                    	<?php 
														 $image = get_sub_field('imagen_maniobra_dos');
														 if( !empty( $image ) ): ?>
															<img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
														<?php endif; ?>
                                                        <div class="text-maniobra"><?php the_sub_field('texto_maniobra_dos'); ?></div>
                                                    </div>
                                                    <span class="bus-examen"><hr></span>
                                                    <p class="title-maniobra no-bus"><?php the_sub_field('titulo_maniobra-tres'); ?></p>
                                                    <div class="caja-maniobra">
                                                    	<?php 
														 $image = get_sub_field('imagen_maniobra_tres');
														 if( !empty( $image ) ): ?>
															<img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
														<?php endif; ?>
                                                        <div class="text-maniobra"><?php the_sub_field('texto_maniobra_tres'); ?></div>
                                                    </div>
                                                    <span class="trailer-examen"><hr></span>
                                                    <p class="title-maniobra no"><?php the_sub_field('titulo_maniobra-cuatro'); ?></p>
                                                    <div class="caja-maniobra">
                                                    	<?php 
														 $image = get_sub_field('imagen_maniobra_cuatro');
														 if( !empty( $image ) ): ?>
															<img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
														<?php endif; ?>
                                                        <div class="text-maniobra"><?php the_sub_field('texto_maniobra_cuatro'); ?></div>
                                                    </div>
                                                    <span class="trailer-examen"><hr></span>
                                                    <p class="title-maniobra no"><?php the_sub_field('titulo_maniobra-cinco'); ?></p>
                                                    <div class="caja-maniobra">
                                                    	<?php 
														 $image = get_sub_field('imagen_maniobra_cinco');
														 if( !empty( $image ) ): ?>
															<img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
														<?php endif; ?>
                                                        <div class="text-maniobra"><?php the_sub_field('texto_maniobra_cinco'); ?></div>
                                                    </div>
                                                    <span class="trailer-examen"><hr></span>
                                                    <p class="title-maniobra no"><?php the_sub_field('titulo_maniobra-seis'); ?></p>
                                                    <div class="caja-maniobra">
                                                    	<?php 
														 $image = get_sub_field('imagen_maniobra_seis');
														 if( !empty( $image ) ): ?>
															<img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
														<?php endif; ?>
                                                        <div class="text-maniobra"><?php the_sub_field('texto_maniobra_seis'); ?></div>
                                                    </div>
                                                </div>
                                            </div><?php
							}
						} ?>
                        <?php
						if(have_rows('bloque_circulacion'))
						{
							while(have_rows('bloque_circulacion'))
							{
								the_row(); ?>
                                <div class="section_wrapper mcb-section-inner">
                                    <div class="wrap mcb-wrap one slide-cap valign-top clearfix">
                                        <div class="mcb-wrap-inner">
                                            <div class="column mcb-column column_column column-margin- caja-examen circulacion">
                                                <div class="column_attr clearfix one-two column" style="">
                                                    <img class="icon-examen" src="https://www.academiadeltransportista.com/wp-content/uploads/2020/05/ico-examen-circulacion-def.png" /><h3 class="title-tipo-examen"><?php the_sub_field('titulo_circulacion'); ?></h3>
                                                    <div class="text_landing_course_type"><?php the_sub_field('texto_circulacion'); ?></div>
                                                </div>
                                                <div class="column_attr clearfix one-two column img" style="">
                                                <?php 
														 $image = get_sub_field('imagen_circulacion');
														 if( !empty( $image ) ): ?>
															<img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
														<?php endif; ?>
                                                </div>
                                            </div><?php
							}
						} ?>
                        <?php
						if(have_rows('bloque_examen_mercancias'))
						{
							while(have_rows('bloque_examen_mercancias'))
							{
								the_row(); ?>
                                <div class="section_wrapper mcb-section-inner section-mercan">
                                    <div class="wrap mcb-wrap one slide-cap valign-top clearfix">
                                        <div class="mcb-wrap-inner">
                                            <div class="column mcb-column column_column column-margin- mercancias">
                                                <div class="column_attr clearfix one-third column primero" style="">
                                                    <p class="title-examen-mercancias"><?php the_sub_field('titulo_mercancias'); ?></p>
                                                </div>
                                                <div class="column_attr clearfix one-third column segundo" style="">
                                                    <div class="text_landing_course_type"><?php the_sub_field('texto_mercancias'); ?></div>
                                                </div>
                                                <div class="column_attr clearfix one-third column tercero" style="">
                                                    <div class="text_landing_course_type"><?php the_sub_field('cta_mercancias'); ?></div>
                                                </div>
                                            </div><?php
							}
						} ?>
                          
                    </section><?php
                    }
					else { ?>
					<section class="section mcb-section examen-section"></section>
					<?php } ?>
                    
                    
                    <?php
                    if(is_page(33609) || is_page(33583))
					{ ?>
                    <section class="section mcb-section examen-section">
                    
                          <div class="section_wrapper mcb-section-inner">
                              <h2 class="titulo-examen"><?php the_field('titulo_examenes'); ?></h2>
                          </div><?php
						if(have_rows('bloque_teorico_practico'))
						{
							while(have_rows('bloque_teorico_practico'))
							{
								the_row(); ?>
                                <div class="section_wrapper mcb-section-inner">
                                    <div class="wrap mcb-wrap one slide-cap valign-top clearfix">
                                        <div class="mcb-wrap-inner">
                                            <div class="column mcb-column one-two column_column column-margin- caja-examen margen-uno">
                                                <div class="column_attr clearfix" style="">
                                                    <img class="icon-examen" src="https://www.academiadeltransportista.com/wp-content/uploads/2020/05/ico-examen-teorico-def.png" /><h3 class="title-tipo-examen"><?php the_sub_field('titulo_columna_one'); ?></h3>
                                                    <div class="text_landing_course_type"><?php the_sub_field('texto_columna_one'); ?></div>
                                                </div>
                                            </div>
                                            <div class="column mcb-column one-two column_column column-margin- caja-examen margen-dos">
                                                <div class="column_attr clearfix" style="">
                                                    <img class="icon-examen" src="https://www.academiadeltransportista.com/wp-content/uploads/2020/05/ico-examen-practico.png" /><h3 class="title-tipo-examen"><?php the_sub_field('titulo_columna_two'); ?></h3>
                                                    <div class="text_landing_course_type grow-column"><?php the_sub_field('texto_columna_two'); ?></div>
                                                </div>
                                            </div><?php
							}
						} ?>
                        <?php
						if(have_rows('bloque_circuito_cerrado'))
						{
							while(have_rows('bloque_circuito_cerrado'))
							{
								the_row(); ?>
                                <div class="section_wrapper mcb-section-inner">
                                    <div class="wrap mcb-wrap one slide-cap valign-top clearfix">
                                        <div class="mcb-wrap-inner">
                                            <div class="column mcb-column column_column column-margin- caja-examen margen-cerrado">
                                                <div class="column_attr clearfix" style="">
                                                    <img class="icon-examen" src="https://www.academiadeltransportista.com/wp-content/uploads/2020/05/ico-circuito-cerrado.png" /><h3 class="title-tipo-examen"><?php the_sub_field('titulo_circuito'); ?></h3>
                                                    <div class="text_landing_course_type"><?php the_sub_field('texto_circuito'); ?></div>
                                                    <hr>
                                                    <p class="title-maniobra"><?php the_sub_field('titulo_maniobra-uno'); ?></p>
                                                    <div class="caja-maniobra new">
                                                    	<div class="embed-container">
															<?php the_sub_field('video_maniobra_uno'); ?>
                                                        </div>
                                                        <div class="text-maniobra"><?php the_sub_field('texto_maniobra_uno'); ?></div>
                                                    </div>
                                                    <hr></span>
                                                    <p class="title-maniobra"><?php the_sub_field('titulo_maniobra-dos'); ?></p>
                                                    <div class="caja-maniobra new">
                                                    	<div class="embed-container">
															<?php the_sub_field('video_maniobra_dos'); ?>
                                                        </div>
                                                        <div class="text-maniobra"><?php the_sub_field('texto_maniobra_dos'); ?></div>
                                                    </div>
                                                    <span class="bus-examen"><hr></span>
                                                    <p class="title-maniobra no-bus"><?php the_sub_field('titulo_maniobra-tres'); ?></p>
                                                    <div class="caja-maniobra new">
                                                    	<div class="embed-container">
															<?php the_sub_field('video_maniobra_tres'); ?>
                                                        </div>
                                                        <div class="text-maniobra"><?php the_sub_field('texto_maniobra_tres'); ?></div>
                                                    </div>
                                                    <span class="trailer-examen"><hr></span>
                                                    <p class="title-maniobra no"><?php the_sub_field('titulo_maniobra-cuatro'); ?></p>
                                                    <div class="caja-maniobra new cuatro">
                                                    	<div class="embed-container">
															<?php the_sub_field('video_maniobra_cuatro'); ?>
                                                        </div>
                                                        <div class="text-maniobra"><?php the_sub_field('texto_maniobra_cuatro'); ?></div>
                                                    </div>
                                                    <span class="trailer-examen"><hr></span>
                                                    <p class="title-maniobra no"><?php the_sub_field('titulo_maniobra-cinco'); ?></p>
                                                    <div class="caja-maniobra new cinco">
                                                    	<div class="embed-container">
															<?php the_sub_field('video_maniobra_cinco'); ?>
                                                        </div>
                                                        <div class="text-maniobra"><?php the_sub_field('texto_maniobra_cinco'); ?></div>
                                                    </div>
                                                    <span class="trailer-examen"><hr></span>
                                                    <p class="title-maniobra no"><?php the_sub_field('titulo_maniobra-seis'); ?></p>
                                                    <div class="caja-maniobra new seis">
                                                    	<div class="embed-container">
															<?php the_sub_field('video_maniobra_seis'); ?>
                                                        </div>
                                                        <div class="text-maniobra"><?php the_sub_field('texto_maniobra_seis'); ?></div>
                                                    </div>
                                                </div>
                                            </div><?php
							}
						} ?>
                        <?php
						if(have_rows('bloque_circulacion'))
						{
							while(have_rows('bloque_circulacion'))
							{
								the_row(); ?>
                                <div class="section_wrapper mcb-section-inner">
                                    <div class="wrap mcb-wrap one slide-cap valign-top clearfix">
                                        <div class="mcb-wrap-inner">
                                            <div class="column mcb-column column_column column-margin- caja-examen circulacion">
                                                <div class="column_attr clearfix one-two column" style="">
                                                    <img class="icon-examen" src="https://www.academiadeltransportista.com/wp-content/uploads/2020/05/ico-examen-circulacion-def.png" /><h3 class="title-tipo-examen"><?php the_sub_field('titulo_circulacion'); ?></h3>
                                                    <div class="text_landing_course_type"><?php the_sub_field('texto_circulacion'); ?></div>
                                                </div>
                                                <div class="column_attr clearfix one-two column img" style="">
                                                <?php 
														 $image = get_sub_field('imagen_circulacion');
														 if( !empty( $image ) ): ?>
															<img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
														<?php endif; ?>
                                                </div>
                                            </div><?php
							}
						} ?>
                        <?php
						if(have_rows('bloque_examen_mercancias'))
						{
							while(have_rows('bloque_examen_mercancias'))
							{
								the_row(); ?>
                                <div class="section_wrapper mcb-section-inner section-mercan">
                                    <div class="wrap mcb-wrap one slide-cap valign-top clearfix">
                                        <div class="mcb-wrap-inner">
                                            <div class="column mcb-column column_column column-margin- mercancias">
                                                <div class="column_attr clearfix one-third column primero" style="">
                                                    <p class="title-examen-mercancias"><?php the_sub_field('titulo_mercancias'); ?></p>
                                                </div>
                                                <div class="column_attr clearfix one-third column segundo" style="">
                                                    <div class="text_landing_course_type"><?php the_sub_field('texto_mercancias'); ?></div>
                                                </div>
                                                <div class="column_attr clearfix one-third column tercero" style="">
                                                    <div class="text_landing_course_type"><?php the_sub_field('cta_mercancias'); ?></div>
                                                </div>
                                            </div><?php
							}
						} ?>
                          
                    </section><?php
                    }
					else { ?>
					<section class="section mcb-section examen-section"></section>
					<?php } ?>
                    
                   
                   <section class="section mcb-section third-section"><?php
						if(have_rows('bloque_preguntas'))
						{
							while(have_rows('bloque_preguntas'))
							{
								the_row(); ?>
                                <div class="section_wrapper mcb-section-inner">
                                    <h2 class="main_title"><?php the_sub_field('titulo'); ?></h2><?php
									if(have_rows('preguntas'))
									{ ?>
                                    	<div class="wrap mcb-wrap one slide-cap valign-top clearfix">
											<div class="mcb-wrap-inner"><?php
												$i=1;
												while(have_rows('preguntas'))
												{
													the_row(); ?>
                                                    <div class="column mcb-column one-third column_column  column-margin-">
                                                        <div class="column_attr clearfix" style="">
                                                            <h3 class="title_landing_course_type"><?php the_sub_field('pregunta'); ?></h3>
                                                            <p class="text_landing_course_type"><?php the_sub_field('respuesta'); ?></p>
                                                        </div>
                                                    </div><?php
													if($i%3 == 0)
													{ ?>
                                                    	</div>
														</div>
														<div class="wrap mcb-wrap one slide-cap valign-top clearfix">
														<div class="mcb-wrap-inner"><?php
													}
													$i++;
												} ?>
                                            </div>
                                        </div><?php
									} ?>
                                </div><?php
							}
						} ?>
                    </section>
                    <section class="section mcb-section fourth-section">
                    	<div class="main_title"><h3 class="title">Infórmate de nuestros cursos bonificados</h3></div>
                    	<div class="section_wrapper mcb-section-inner">
                            <p class="text_landing_course_type">Todos los cursos de Academia del Transportista pueden ser gratuitos o bonificables. A continuación te ofrecemos la información necesaria para optar a estas ventajas:</p>
                            <div class="wrap mcb-wrap one slide-cap valign-top clearfix">
                            	<div class="mcb-wrap-inner">
                                    <div class="column mcb-column one-second column_accordion">
                                    	<div class="accordion">
                                        	<div class="mfn-acc accordion_wrapper">
                                            	<div class="question cap-gratis">
	                                                <h2 class="title"><?php the_field('titulo_formulario_subvencion_gratis'); ?></h2>
    	                                            <div class="answer">
														<div class="caja-form-ciudad"><?php
															/*if(is_page(74827))
															{ ?>
																<p class="titulo-form-ciudad">Ahora tú eliges el horario. Indícanos tus datos para informarte de todo:</p><?php													
															}
															else
															{ ?>
																<p class="titulo-form-ciudad">Tenemos cursos de mañana, tarde noche y fin de semana cerca de ti</p>
																<p class="titulo-form-ciudad-trans">¿Te interesa este curso? Facilítanos tus datos de contacto</p><?php
															}*/
			                                        		/*echo do_shortcode('[contact-form-7 id="7257" title="Formulario ciudad renovación CAP"]');*/
															echo do_shortcode('[contact-form-7 id="74843" title="Formulario ciudad renovación CAP GENÉRICO_ppipe"]'); ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="column mcb-column one-second column_accordion">
                                    	<div class="accordion">
                                        	<div class="mfn-acc accordion_wrapper">
                                            	<div class="question cap-subvencionado">
	                                                <h2 class="title"><?php the_field('titulo_formulario_subvencionado'); ?></h2>
    	                                            <div class="answer">
														<div class="caja-form-ciudad"><?php
															/*if(is_page(74827))
															{ ?>
																<p class="titulo-form-ciudad">Ahora tú eliges el horario. Indícanos tus datos para informarte de todo:</p><?php													
															}
															else
															{ ?>
																<p class="titulo-form-ciudad">Tenemos cursos de mañana, tarde noche y fin de semana cerca de ti</p>
																<p class="titulo-form-ciudad-trans">¿Te interesa este curso? Facilítanos tus datos de contacto</p><?php
															}*/
			                                        		/*echo do_shortcode('[contact-form-7 id="7257" title="Formulario ciudad renovación CAP"]');*/
															echo do_shortcode('[contact-form-7 id="74843" title="Formulario ciudad renovación CAP GENÉRICO_ppipe"]'); ?>
                                                        </div>
													</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                    <section class="section mcb-section fifth-section">
                    	<div class="section_wrapper mcb-section-inner">
                        	<div class="wrap mcb-wrap one slide-cap valign-top clearfix">
                            	<div class="mcb-wrap-inner">
	                                <!--<div class="column mcb-column one-sixth column_column  column-margin- hide-movil"></div>-->
                                    <div class="column mcb-column two-fifth column_column  column-margin- form_title">
                                    	<div class="column_attr clearfix" style="">
	                                        <div class="intro-consejos-seguridad">
	                                            <?php /*<p class="titulo-consejos-seguridad">Hazte miembro del club AT y forma parte de los elegidos</p>
	                                            <p class="subtitulo-consejos-seguridad">Si no dispones del CAP puedes entrar en el club AT de forma gratuita como simpatizante</p>*/
												if(is_page(885))
												{ ?>
                                                	<p class="titulo-consejos-seguridad">Infórmate sobre los Cursos de renovación CAP</p><?php
												}
												elseif(is_page(8657))
												{ ?>
                                                	<p class="titulo-consejos-seguridad">Infórmate sobre el curso de CAP inicial</p><?php
												}
												elseif(is_page(33609))
												{ ?>
                                                	<p class="titulo-consejos-seguridad">Infórmate sobre la obtención del Permiso C1-C</p><?php
												}
												elseif(is_page(33583))
												{ ?>
                                                	<p class="titulo-consejos-seguridad">Infórmate sobre la obtención del Permiso C1+E - C+E</p><?php
												}
												elseif(is_page(33619))
												{ ?>
                                                	<p class="titulo-consejos-seguridad">Infórmate sobre la obtención del Permiso D1-D</p><?php
												}
												elseif(is_page(8666))
												{ ?>
                                                	<p class="titulo-consejos-seguridad">Infórmate sobre la obtención del carnet ADR</p><?php
												}
												elseif(is_page(8663))
												{ ?>
                                                	<p class="titulo-consejos-seguridad">Infórmate sobre la renovación del carnet ADR</p><?php
												}
												elseif(is_page(45236))
												{ ?>
                                                	<p class="titulo-consejos-seguridad">Infórmate sobre el Título de Competencia Profesional para el Transporte</p><?php
												}
												elseif(is_page(45023))
												{ ?>
                                                	<p class="titulo-consejos-seguridad">Infórmate sobre cómo ser conductor de ambulancia</p><?php
												}
                                                elseif(is_page(71674))
												{ ?>
                                                	<p class="titulo-consejos-seguridad">Infórmate sobre los Cursos de Jefe de Tráfico</p><?php
												} ?>
	                                            <p class="subtitulo-consejos-seguridad">Rellena el siguiente formulario y pronto nos pondremos en contacto contigo</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="column mcb-column two-fifth column_column column-margin- form_column segundo_formulario_pedaogicas">
                                    	<div class="column_attr clearfix" style="">
											<div class="caja-form-ciudad"><?php
												/*if(is_page(74827))
												{ ?>
													<p class="titulo-form-ciudad">Ahora tú eliges el horario. Indícanos tus datos para informarte de todo:</p><?php													
												}
												else
												{ ?>
													<p class="titulo-form-ciudad">Tenemos cursos de mañana, tarde noche y fin de semana cerca de ti</p>
													<p class="titulo-form-ciudad-trans">¿Te interesa este curso? Facilítanos tus datos de contacto</p><?php
												}*/
												/*echo do_shortcode('[contact-form-7 id="2331" title="Formulario de Club AT"]');*/
												echo do_shortcode('[contact-form-7 id="74843" title="Formulario ciudad renovación CAP GENÉRICO_ppipe"]'); ?>
                                            </div>
										</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
				</div>
			</div>
		</div>
	</div><?php 
get_footer();