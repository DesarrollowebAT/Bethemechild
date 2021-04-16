<<<<<<< HEAD
<<<<<<< HEAD
<?php
if(is_user_logged_in())
{
	$microsite_level=get_user_microsite_level();
	if($microsite_level == 'pro' || $microsite_level == 'premium' || $microsite_level == 'exclusive' || get_current_user_id() == 1827 || current_user_can('administrator'))
	{
		$cursos_actuales = get_posts(array(
			'post_type' => 'product',
			'numberposts' => -1,
			'meta_query' => array(
				array(
					'key' => 'autoescuela', // name of custom field
					'value' => '"' . get_the_ID() . '"', // matches exactly "123", not just 123. This prevents a match for "1234"
					'compare' => 'LIKE'
				)
			)
		));
		if($_POST)
		{ ?>
        	<div class="registros_subida"><?php
			
				$la_meta=get_post_meta(get_the_id());
				$imagen_actual=$la_meta['imagen_cabecera'][0];
				
				/* Estamos recibiendo datos. Los guardamos */
				if($_FILES['background_image']['name'] != '')
				{
					$image_id=upload_image_from_form_to_wp_media($_FILES['background_image']);
					if($image_id > 0)
					{
						update_field('imagen_cabecera',$image_id,get_the_id());
						wp_delete_attachment($imagen_actual,true);
					}
				}
				if($_POST['delete_current_bg_image'] == 'yes')
				{
					wp_delete_attachment($imagen_actual,true);
				}
				if($_FILES['logo_image']['name'] != '')
				{
					$image_id=upload_image_from_form_to_wp_media($_FILES['logo_image']);
					if($image_id > 0)
					{
						set_post_thumbnail(get_the_id(),$image_id);
					}
				}
				if($_POST['delete_current_logo'] == 'yes')
				{
					delete_post_thumbnail(get_the_id());
				}
				if($_POST['new_title'] != '')
				{
					wp_update_post(array(
						'ID' => get_the_id(),
						'post_title' => $_POST['new_title']
					));
				}
				if($_POST['new_description'] != '')
				{
					update_field('texto_cabecera',$_POST['new_description'],get_the_id());
				}
				if($_POST['color_microsite'] != '')
				{
					update_field('color_microsite','#'.$_POST['color_microsite'],get_the_id());
				}
				if($_POST['new_horario'] != '')
				{
					update_field('horario',$_POST['new_horario'],get_the_id());
				}
				if($_POST['new_direccion'] != '')
				{
					$address=slugify($_POST['new_direccion']);
					$address=str_replace('-','+',$address);
					$curl = curl_init();
						curl_setopt($curl, CURLOPT_URL, 'https://maps.googleapis.com/maps/api/geocode/json?key=AIzaSyBP9OVPkIgTmQhuMr5kdT7JNHBEmv7cuLU&address='.$address);
						curl_setopt ($curl, CURLOPT_RETURNTRANSFER, 1);
						$json = curl_exec($curl);
					curl_close ($curl);
					$output= json_decode($json);
					
					$lat=$output->results[0]->geometry->location->lat;
					$long=$output->results[0]->geometry->location->lng;
					
					$address_components=$output->results[0]->address_components;
					foreach($address_components as $address_component)
					{
						if($address_component->types[0] == 'locality')
						{
							$municipio_texto=$address_component->long_name;
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
							$provincia_texto=$address_component->long_name;
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
					}
					/*if(get_current_user_id()==6){ print_r($municipio);die; }*/
					update_field('provincia',$provincia,get_the_id());
					update_field('provincia_texto',$provincia_texto,get_the_id());
					update_field('municipios_'.$provincia,$municipio,get_the_id());
					update_field('municipio_texto',$municipio_texto,get_the_id());
					update_field('mapa',array('address' => $_POST['new_direccion'],'lat' => $lat,'lng' => $long),get_the_id());
					wp_update_post(array('ID' => get_the_id()));
				}
				if($_POST['new_tlf_fijo'] != '')
				{
					update_field('telefono_fijo',$_POST['new_tlf_fijo'],get_the_id());
				}
				if($_POST['new_tlf_movil'] != '')
				{
					update_field('telefono_movil',$_POST['new_tlf_movil'],get_the_id());
				}
				if($_POST['new_e-mail'] != '')
				{
					update_field('e-mail',$_POST['new_e-mail'],get_the_id());
				}
                  if($_POST['new_Whatsapptelf'] != '')
                 {
                 update_field('Whatsapptelf',$_POST['new_Whatsapptelf'],get_the_id());
                }
				if($_POST['new_texto_descriptivo'] != '')
				{
					update_field('titulo_texto_informacion',$_POST['new_texto_descriptivo'],get_the_id());
				}
				if($_POST['new_texto_informacion'] != '')
				{
					update_field('texto_informacion',$_POST['new_texto_informacion'],get_the_id());
				}
				if($_POST['borrar_imagen_6'] != '')
				{
					delete_sub_field(array('imagenes', 6, 'imagen'));
					delete_row('imagenes',6,get_the_id());
					wp_delete_attachment($_POST['borrar_imagen_6'],true);
				}
				if($_POST['borrar_imagen_5'] != '')
				{
					delete_sub_field(array('imagenes', 5, 'imagen'));
					delete_row('imagenes',5,get_the_id());
					wp_delete_attachment($_POST['borrar_imagen_5'],true);
				}
				if($_POST['borrar_imagen_4'] != '')
				{
					delete_sub_field(array('imagenes', 4, 'imagen'));
					delete_row('imagenes',4,get_the_id());
					wp_delete_attachment($_POST['borrar_imagen_4'],true);
				}
				if($_POST['borrar_imagen_3'] != '')
				{
					delete_sub_field(array('imagenes', 3, 'imagen'));
					delete_row('imagenes',3,get_the_id());
					wp_delete_attachment($_POST['borrar_imagen_3'],true);
				}
				if($_POST['borrar_imagen_2'] != '')
				{
					delete_sub_field(array('imagenes', 2, 'imagen'));
					delete_row('imagenes',2,get_the_id());
					wp_delete_attachment($_POST['borrar_imagen_2'],true);
				}
				if($_POST['borrar_imagen_1'] != '')
				{
					delete_sub_field(array('imagenes', 1, 'imagen'));
					delete_row('imagenes',1,get_the_id());
					wp_delete_attachment($_POST['borrar_imagen_1'],true);
				}
				if($_FILES['anadir_imagen_1']['name'] != '')
				{
					$image_id=upload_image_from_form_to_wp_media($_FILES['anadir_imagen_1']);
					if($image_id > 0)
					{
						add_row('imagenes',array('imagen' => $image_id),get_the_id());
					}
				}
				if($_FILES['anadir_imagen_2']['name'] != '')
				{
					$image_id=upload_image_from_form_to_wp_media($_FILES['anadir_imagen_2']);
					if($image_id > 0)
					{
						add_row('imagenes',array('imagen' => $image_id),get_the_id());
					}
				}
				if($_FILES['anadir_imagen_3']['name'] != '')
				{
					$image_id=upload_image_from_form_to_wp_media($_FILES['anadir_imagen_3']);
					if($image_id > 0)
					{
						add_row('imagenes',array('imagen' => $image_id),get_the_id());
					}
				}
				if($_FILES['anadir_imagen_4']['name'] != '')
				{
					$image_id=upload_image_from_form_to_wp_media($_FILES['anadir_imagen_4']);
					if($image_id > 0)
					{
						add_row('imagenes',array('imagen' => $image_id),get_the_id());
					}
				}
				if($_FILES['anadir_imagen_5']['name'] != '')
				{
					$image_id=upload_image_from_form_to_wp_media($_FILES['anadir_imagen_5']);
					if($image_id > 0)
					{
						add_row('imagenes',array('imagen' => $image_id),get_the_id());
					}
				}
				if($_FILES['anadir_imagen_6']['name'] != '')
				{
					$image_id=upload_image_from_form_to_wp_media($_FILES['anadir_imagen_6']);
					if($image_id > 0)
					{
						add_row('imagenes',array('imagen' => $image_id),get_the_id());
					}
				}
				$cursos_seleccionados_autoescuela=array();
				if($_POST['curso-obtencion-camion-c'] == 'yes')
				{
					$cursos_seleccionados_autoescuela[]='curso-obtencion-camion-c';
				}
				if($_POST['curso-obtencion-carnet-trailer-c-e'] == 'yes')
				{
					$cursos_seleccionados_autoescuela[]='curso-obtencion-carnet-trailer-c-e';
				}
				if($_POST['curso-obtencion-carnet-autobus-d'] == 'yes')
				{
					$cursos_seleccionados_autoescuela[]='curso-obtencion-carnet-autobus-d';
				}
				if($_POST['curso-obtencion-carnet-remolque-b-e'] == 'yes')
				{
					$cursos_seleccionados_autoescuela[]='curso-obtencion-carnet-remolque-b-e';
				}
				if($_POST['curso-obtencion-carnet-coche-b'] == 'yes')
				{
					$cursos_seleccionados_autoescuela[]='curso-obtencion-carnet-coche-b';
				}
				if($_POST['curso-obtencion-carnet-moto-a'] == 'yes')
				{
					$cursos_seleccionados_autoescuela[]='curso-obtencion-carnet-moto-a';
				}
				update_field('cursos_ofrecidos_tipo_autoescuela',$cursos_seleccionados_autoescuela,get_the_id());
				
				$cursos_seleccionados_transporte=array();
				if($_POST['curso-renovacion-del-cap'] == 'yes')
				{
					$cursos_seleccionados_transporte[]='curso-renovacion-del-cap';
				}
				if($_POST['curso-obtencion-cap-inicial'] == 'yes')
				{
					$cursos_seleccionados_transporte[]='curso-obtencion-cap-inicial';
				}
				if($_POST['curso-obtencion-mercancias-peligrosas'] == 'yes')
				{
					$cursos_seleccionados_transporte[]='curso-obtencion-mercancias-peligrosas';
				}
				if($_POST['curso-renovacion-adr'] == 'yes')
				{
					$cursos_seleccionados_transporte[]='curso-renovacion-adr';
				}
				if($_POST['curso-obtencion-titulo-de-transportista'] == 'yes')
				{
					$cursos_seleccionados_transporte[]='curso-obtencion-titulo-de-transportista';
				}
				if($_POST['curso-consejero-de-seguridad-adr'] == 'yes')
				{
					$cursos_seleccionados_transporte[]='curso-consejero-de-seguridad-adr';
				}
				update_field('cursos_ofrecidos_tipo_transporte',$cursos_seleccionados_transporte,get_the_id());
				
				$cursos_seleccionados_mas=array();
				if($_POST['curso-de-carretillas-elevadoras'] == 'yes')
				{
					$cursos_seleccionados_mas[]='curso-de-carretillas-elevadoras';
				}
				if($_POST['curso-grua-camion-pluma'] == 'yes')
				{
					$cursos_seleccionados_mas[]='curso-grua-camion-pluma';
				}
				if($_POST['une-12195-sujecion-de-cargas-y-estiba'] == 'yes')
				{
					$cursos_seleccionados_mas[]='une-12195-sujecion-de-cargas-y-estiba';
				}
				if($_POST['curso-tacografo-digital'] == 'yes')
				{
					$cursos_seleccionados_mas[]='curso-tacografo-digital';
				}
				if($_POST['cursos-de-logistica'] == 'yes')
				{
					$cursos_seleccionados_mas[]='cursos-de-logistica';
				}
				if($_POST['curso-de-seguridad-vial-laboral'] == 'yes')
				{
					$cursos_seleccionados_mas[]='curso-de-seguridad-vial-laboral';
				}
				update_field('cursos_ofrecidos_tipo_mas_cursos',$cursos_seleccionados_mas,get_the_id()); 
				
				$value_cursos_autoescuela=array();
				for($cont_cursos_autoescuela=0;$cont_cursos_autoescuela<1000;$cont_cursos_autoescuela++)
				{
					if(isset($_POST['add_curso_autoescuela_'.$cont_cursos_autoescuela]))
					{
						if($_POST['add_curso_autoescuela_'.$cont_cursos_autoescuela] != '')
						{
							$value_cursos_autoescuela[]=array(
								'nombre' => $_POST['add_curso_autoescuela_'.$cont_cursos_autoescuela]
							);
						}
					}
					else
					{
						break;
					}
				}
				if($_POST['add_curso_autoescuela'] != '')
				{
					$value_cursos_autoescuela[]=array(
						'nombre' => $_POST['add_curso_autoescuela']
					);
				}
				update_field('cursos_ofrecidos_tipo_autoescuela_adicionales',$value_cursos_autoescuela,get_the_id());
				
				$value_cursos_transporte=array();
				for($cont_cursos_transporte=0;$cont_cursos_transporte<1000;$cont_cursos_transporte++)
				{
					if(isset($_POST['add_curso_transporte_'.$cont_cursos_transporte]))
					{
						if($_POST['add_curso_transporte_'.$cont_cursos_transporte] != '')
						{
							$value_cursos_transporte[]=array(
								'nombre' => $_POST['add_curso_transporte_'.$cont_cursos_transporte]
							);
						}
					}
					else
					{
						break;
					}
				}
				if($_POST['add_curso_transporte'] != '')
				{
					$value_cursos_transporte[]=array(
						'nombre' => $_POST['add_curso_transporte']
					);
				}
				update_field('cursos_ofrecidos_tipo_transporte_adicionales',$value_cursos_transporte,get_the_id());
				
				$value_cursos_mas=array();
				for($cont_cursos_mas=0;$cont_cursos_mas<1000;$cont_cursos_mas++)
				{
					if(isset($_POST['add_curso_mas_'.$cont_cursos_mas]))
					{
						if($_POST['add_curso_mas_'.$cont_cursos_mas] != '')
						{
							$value_cursos_mas[]=array(
								'nombre' => $_POST['add_curso_mas_'.$cont_cursos_mas]
							);
						}
					}
					else
					{
						break;
					}
				}
				if($_POST['add_curso_mas'] != '')
				{
					$value_cursos_mas[]=array(
						'nombre' => $_POST['add_curso_mas']
					);
				}
				update_field('cursos_ofrecidos_tipo_mas_cursos_adicionales',$value_cursos_mas,get_the_id());
                
                /* cursos booking */
				foreach($cursos_actuales as $curso)
				{
					if($_POST['eliminar_curso_'.$curso->ID] == 'si')
					{
						wp_trash_post($curso->ID);
					}
					else
					{
						if($_POST['tipo_curso_'.$curso->ID] != '')
						{
							if($_POST['tipo_curso_'.$curso->ID] == 'cap-inicial')
							{
								$cat=53;
								$cat_tc=28;
							}
							elseif($_POST['tipo_curso_'.$curso->ID] == 'cap-continua')
							{
								$cat=27;
								$cat_tc=29;
							}
							elseif($_POST['tipo_curso_'.$curso->ID] == 'adr-obtencion')
							{
								$cat=55;
								$cat_tc=30;
							}
							elseif($_POST['tipo_curso_'.$curso->ID] == 'adr-renovacion')
							{
								$cat=54;
								$cat_tc=31;
							}
							wp_set_post_terms($curso->ID,array($cat),'product_cat');
							wp_set_post_terms($curso->ID,array($cat_tc),'tipo-curso');
						}
						
						if($_POST['tipo_cap_inicial_curso_'.$curso->ID] != '')
						{
							update_field('tipo_cap_inicial',$_POST['tipo_cap_inicial_curso_'.$curso->ID],$curso->ID);
						}
						if($_POST['tipo_cap_ampliacion_curso_'.$curso->ID] != '')
						{
							update_field('tipo_cap_ampliacion',$_POST['tipo_cap_ampliacion_curso_'.$curso->ID],$curso->ID);
						}
						if($_POST['tipo_adr_curso_'.$curso->ID] != '')
						{
							update_field('tipo_adr',$_POST['tipo_adr_curso_'.$curso->ID],$curso->ID);
						}
						if($_POST['tipo_adr_texto_curso_'.$curso->ID] != '')
						{
							update_field('tipo_adr_texto',$_POST['tipo_adr_texto_curso_'.$curso->ID],$curso->ID);
						}
						/**/
						/*if($_POST['tipo_adr_curso_'.$curso->ID] != '')
						{
							if($_POST['tipo_adr_curso_'.$curso->ID] != get_field('tipo_de_curso',$curso->ID))
							{
								update_field('tipo_de_curso',$_POST['tipo_adr_curso_'.$curso->ID],$curso->ID);
							}
						}*/
						if($_POST['horario_curso_'.$curso->ID] != '')
						{
							if($_POST['horario_curso_'.$curso->ID] != get_field('horario_texto',$curso->ID))
							{
								update_field('horario_texto',$_POST['horario_curso_'.$curso->ID],$curso->ID);
							}
						}
						if($_POST['fecha_inicio_curso_'.$curso->ID] != '')
						{
							$anyo=substr($_POST['fecha_inicio_curso_'.$curso->ID],6,4);
							$mes=substr($_POST['fecha_inicio_curso_'.$curso->ID],3,2);
							$dia=substr($_POST['fecha_inicio_curso_'.$curso->ID],0,2);
							$fecha_formateada=$anyo.$mes.$dia;
							if($fecha_formateada != get_field('fecha_inicio',$curso->ID))
							{
								update_field('fecha_inicio',$fecha_formateada,$curso->ID);
							}
						}
						if($_POST['fecha_fin_curso_'.$curso->ID] != '')
						{
							$anyo=substr($_POST['fecha_fin_curso_'.$curso->ID],6,4);
							$mes=substr($_POST['fecha_fin_curso_'.$curso->ID],3,2);
							$dia=substr($_POST['fecha_fin_curso_'.$curso->ID],0,2);
							$fecha_formateada=$anyo.$mes.$dia;
							if($fecha_formateada != get_field('fecha_de_finalizacion',$curso->ID))
							{
								update_field('fecha_de_finalizacion',$fecha_formateada,$curso->ID);
							}
						}
						if($_POST['hora_inicio_curso_'.$curso->ID] != get_field('hora_inicio',$curso->ID))
						{
							update_field('hora_inicio',$_POST['hora_inicio_curso_'.$curso->ID],$curso->ID);
						}
						if($_POST['turno_curso_'.$curso->ID] != get_field('horario',$curso->ID))
						{
							update_field('horario',$_POST['turno_curso_'.$curso->ID],$curso->ID);
						}
						if($_POST['precio_curso_'.$curso->ID] != '')
						{
							$nuevo_precio=str_replace(',','.',$_POST['precio_curso_'.$curso->ID]);
							if($nuevo_precio != get_post_meta($curso->ID,'_regular_price',true))
							{
								update_post_meta( $curso->ID, '_regular_price', $nuevo_precio );
								update_post_meta( $curso->ID, '_price', $nuevo_precio );
							}
						}
					}
				}
				if($_POST['insertar_nuevo_curso'] == 'Sí')
				{
					$cuerpo_mail='Se ha añadido el siguiente nuevo curso desde un microsite: <br /><ul>';
					if($_POST['tipo_curso_nuevo'] == 'cap-inicial')
					{
						$titulo='CAP INICIAL';
						$cat=53;
						$cat_tc=28;
					}
					elseif($_POST['tipo_curso_nuevo'] == 'cap-continua')
					{
						$titulo='CAP CONTINUA';
						$cat=27;
						$cat_tc=29;
					}
					elseif($_POST['tipo_curso_nuevo'] == 'adr-obtencion')
					{
						$titulo='ADR OBTENCIÓN';
						$cat=55;
						$cat_tc=30;
					}
					elseif($_POST['tipo_curso_nuevo'] == 'adr-renovacion')
					{
						$titulo='ADR RENOVACIÓN';
						$cat=54;
						$cat_tc=31;
					}
					
					$cuerpo_mail.='<li>Tipo de curso: '.$titulo.'</li>';
					
					$postarr=array(
						'post_title' => $titulo,
						'post_type' => 'product',
						'post_status' => 'publish'
					);
					$post_id=wp_insert_post($postarr);
					
					wp_set_post_terms($post_id,array($cat),'product_cat');
					wp_set_post_terms($post_id,array($cat_tc),'tipo-curso');
					
					$precio=$_POST['precio_curso_nuevo'];
					$cuerpo_mail.='<li>Precio del curso: '.$precio.'</li>';
					$precio=str_replace(array(' ','€'),'',$precio);
					update_post_meta( $post_id, '_regular_price', $precio );
					update_post_meta( $post_id, '_price', $precio );
										
					update_field('autoescuela',array(get_the_id()),$post_id);
					$cuerpo_mail.='<li>ID autoescuela: '.get_the_id().'</li>';
					$cuerpo_mail.='<li><a href="'.get_bloginfo('url').'/wp-admin/post.php?post='.get_the_id().'&action=edit">Enlace edición autoescuela</a>.</li>';
					
					$anyo=substr($_POST['fecha_inicio_curso_nuevo'],6,4);
					$mes=substr($_POST['fecha_inicio_curso_nuevo'],3,2);
					$dia=substr($_POST['fecha_inicio_curso_nuevo'],0,2);
					$fecha_formateada=$anyo.$mes.$dia;
					$fecha_inicio_formateada=$fecha_formateada;
					update_field('fecha_inicio',$fecha_formateada,$post_id);
					$cuerpo_mail.='<li>Fecha de inicio: '.$_POST['fecha_inicio_curso_nuevo'].'</li>';
					
					$anyo=substr($_POST['fecha_fin_curso_nuevo'],6,4);
					$mes=substr($_POST['fecha_fin_curso_nuevo'],3,2);
					$dia=substr($_POST['fecha_fin_curso_nuevo'],0,2);
					$fecha_formateada=$anyo.$mes.$dia;
					$fecha_fin_formateada=$fecha_formateada;
					update_field('fecha_de_finalizacion',$fecha_formateada,$post_id);
					$cuerpo_mail.='<li>Fecha de fin: '.$_POST['fecha_fin_curso_nuevo'].'</li>';
					
					update_field('horario',$_POST['turno_curso_nuevo'],$post_id);
					$cuerpo_mail.='<li>Turno: '.$_POST['turno_curso_nuevo'].'</li>';
					
					update_field('hora_inicio',$_POST['hora_inicio_curso_nuevo'],$post_id);
					$cuerpo_mail.='<li>Hora de inicio: '.$_POST['hora_inicio_curso_nuevo'].'</li>';
					
					update_field('horario_texto',$_POST['horario_curso_nuevo'],$post_id);
					$cuerpo_mail.='<li>Horario: '.$_POST['horario_curso_nuevo'].'</li>';
					
					if($_POST['tipo_cap_inicial_curso_nuevo'] != '')
					{
						update_field('tipo_cap_inicial',$_POST['tipo_cap_inicial_curso_nuevo'],$post_id);
						$cuerpo_mail.='<li>Tipo curso CAP inicial: '.$_POST['tipo_cap_inicial_curso_nuevo'].'</li>';
					}
					if($_POST['tipo_cap_ampliacion_curso_nuevo'] != '')
					{
						update_field('tipo_cap_ampliacion',$_POST['tipo_cap_ampliacion_curso_nuevo'],$post_id);
						$cuerpo_mail.='<li>Tipo curso CAP ampliación: '.$_POST['tipo_cap_ampliacion_curso_nuevo'].'</li>';
					}
					if($_POST['tipo_adr_curso_nuevo'] != '')
					{
						update_field('tipo_adr',$_POST['tipo_adr_curso_nuevo'],$post_id);
						$cuerpo_mail.='<li>Tipo curso ADR: '.$_POST['tipo_adr_curso_nuevo'].'</li>';
					}
					if($_POST['tipo_adr_texto_curso_nuevo'] != '')
					{
						update_field('tipo_adr_texto',$_POST['tipo_adr_texto_curso_nuevo'],$post_id);
						$cuerpo_mail.='<li>Indica tipo curso ADR: '.$_POST['tipo_adr_texto_curso_nuevo'].'</li>';
					}
					
					if(function_exists('cambio_slug'))
					{
						cambio_slug($post_id);
					}
					
					$cuerpo_mail.='<li><a href="'.get_bloginfo('url').'/wp-admin/post.php?post='.$post_id.'&action=edit">Enlace edición curso</a></li>';
					$cabeceras=array('Content-Type: text/html; charset=UTF-8');
					$asunto='Nuevo curso insertado desde microsite';
					
					/*chequeamos si el curso es sospechoso de duplicado*/
					$curso=get_posts(array(
						'post_type' => 'product',
						'tax_query' => array(
							array(
								'taxonomy' => 'product_cat',
								'field' => 'term_id',
								'terms' => $cat,
								'include_children' => false
							)
						),
						'meta_query' => array(
							'relation' => 'AND',
							array(
								'key' => 'autoescuela',
								'value' => '"' . get_the_id() . '"',
								'compare'	=> 'LIKE'
							),
							array(
								'key' => 'fecha_inicio',
								'value' => $fecha_inicio_formateada,
								'type'		=> 'NUMERIC',
								'compare'	=> '='
							),
							array(
								'key' => 'fecha_de_finalizacion',
								'value' => $fecha_fin_formateada,
								'type'		=> 'NUMERIC',
								'compare'	=> '='
							),
							array(
								'key' => 'horario',
								'value' => $_POST['turno_curso_nuevo'],
								'type'		=> 'TEXT',
								'compare'	=> '='
							)
						),
						'exclude' => array($post_id)
					));
					if($curso)
					{
						$asunto='POSIBLE DUPLICADO: Nuevo curso insertado desde microsite';
					}
					/*fin chequeamos si el curso es sospechoso de duplicado*/
					if(!current_user_can('administrator'))
					{
						if($post_id != 0)
						{
							wp_mail('clientes@academiadeltransportista.com',$asunto,$cuerpo_mail,$cabeceras);
						}
					}
					else
					{
						if($post_id != 0)
						{
							wp_mail('rhurtado@roiting.com',$asunto,$cuerpo_mail,$cabeceras);
						}
					}
					
					if(function_exists('rocket_clean_domain'))
					{
						rocket_clean_domain();
					}
				} ?>
            </div><?php
			wp_redirect(get_permalink(get_the_id()).'?edit=true');
		}
		get_header('microsite');
		$color_microsite=get_field('color_microsite');
		if($color_microsite == '')
		{
			$color_microsite='#3DD05D';
		}
		
		$rgb = HTMLToRGB($color_microsite);
		$hsl = RGBToHSL($rgb);
		if($hsl->lightness > 200)
		{
			$tcolor='#333';
		}
		else
		{
			$tcolor='#fff';
		}
		while(have_posts())
		{
			the_post(); ?>
            <div class="edit_form_container">
                <form method="post" action="<?php echo get_permalink(get_the_id()).'?edit=true'; ?>" id="form_update_autoescuela_<?php echo get_the_id(); ?>" enctype="multipart/form-data">
                	<input type="hidden" name="edit_form" value="true" />
                    <!-- CONTENIDO DIV CURSOS -->
					<div id="divcursos" style="display:none;">
					<section class="cursos section_wrapper mcb-section-inner">
                                	<div class="titulo_edicion numbered">Añade las próximas convocatorias de tus cursos CAP Inicial, CAP Continua, ADR Obtención y ADR Renovación:</div>
                                    <div class="edit_block cursos nuevo_curso">
	                                    <div class="titulo_edicion nuevo">Insertar nuevo curso:</div>
                                    	<div class="curso" style="border-color:<?php if(get_field('color_microsite') != ''){ the_field('color_microsite'); }else{ ?>#FF6600<?php } ?>;">
                                        	<div class="gutter">
                                                <div class="the_input not_full_width">
                                                    <input type="checkbox" name="insertar_nuevo_curso" value="Sí"> Insertar este nuevo curso
                                                </div>
                                                <div class="the_input tipo not_full_width radios">
                                                    <p>Tipo de curso:</p>
                                                    <div class="the_subinput">
	                                                    <input type="radio" name="tipo_curso_nuevo" value="cap-inicial"> CAP Inicial
                                                    </div>
                                                    <div class="the_subinput">
	                                                    <input type="radio" name="tipo_curso_nuevo" value="cap-continua"> CAP Continua
                                                    </div><?php
													if(false)/*current_user_can('administrator'))*/
													{ ?>
														<div class="the_subinput">
                                                            <input type="radio" name="tipo_curso_nuevo" value="cap-ampliacion"> CAP Ampliación
                                                        </div><?php
													} ?>
                                                    <div class="the_subinput">
	                                                    <input type="radio" name="tipo_curso_nuevo" value="adr-obtencion"> ADR Obtención
                                                    </div>
                                                    <div class="the_subinput">
	                                                    <input type="radio" name="tipo_curso_nuevo" value="adr-renovacion"> ADR Renovación
                                                    </div>
                                                </div>
                                                <div class="clear"></div><?php
												if(true)/*current_user_can('administrator'))*/
												{ ?>
													<div class="selector_tipo_curso the_input tipo_cap_inicial" style="display:none;">
                                                        <span>Tipo de curso CAP Inicial:</span>
                                                        <select name="tipo_cap_inicial_curso_nuevo" form="form_update_autoescuela_<?php echo get_the_id(); ?>">
                                                            <option value="" selected="selected">Elige</option>
                                                            <option value="mercancias">Mercancías</option>
                                                            <option value="viajeros">Viajeros</option>
                                                            <option value="mercancias-viajeros">Mercancías / Viajeros</option>
                                                        </select>
                                                    </div>
													<?php /*<div class="selector_tipo_curso the_input tipo_cap_ampliacion" style="display:none;">
                                                        <span>Tipo de curso CAP Ampliación:</span>
                                                        <select name="tipo_cap_ampliacion_curso_nuevo" form="form_update_autoescuela_<?php echo get_the_id(); ?>">
                                                        	<option value="" selected="selected">Elige</option>
                                                            <option value="mercancias">Mercancías</option>
                                                            <option value="viajeros">Viajeros</option>
                                                        </select>
                                                    </div>*/ ?>
													<div class="selector_tipo_curso the_input tipo_adr" style="display:none;">
                                                        <span>Tipo de curso ADR:</span>
                                                        <select name="tipo_adr_curso_nuevo" form="form_update_autoescuela_<?php echo get_the_id(); ?>">
                                                        	<option value="" selected="selected">Elige</option>
                                                            <option value="basico">Básico</option>
                                                            <option value="cisternas">Cisternas</option>
                                                            <option value="basico-cisternas">Básico + Cisternas</option>
                                                            <option value="explosivos">Explosivos</option>
                                                            <option value="radiactivos">Radiactivos</option>
                                                            <option value="otros">Otros (Indicad cuál)</option>
                                                        </select>
                                                        <div class="the_input tipo_adr_texto" style="display:none;">
                                                            <span>Indica tipo de curso ADR:</span> <input type="text" name="tipo_adr_texto_curso_nuevo" />
                                                        </div>
                                                    </div><?php
												} ?>
                                                <?php /*<div class="the_input tipo_adr" style="display:none;">
                                                    <span>Tipo de curso ADR:</span> <input type="text" name="tipo_adr_curso_nuevo" />
                                                </div>*/ ?>
                                                <div class="the_input">
                                                    <span>Horario del curso:</span> <input type="text" name="horario_curso_nuevo" />
                                                </div>
                                                <div class="the_input half_size_left">
                                                    <span>Fecha de inicio:</span> <input type="text" class="elDatePicker" name="fecha_inicio_curso_nuevo" />
                                                </div>
                                                <div class="the_input half_size_right">
                                                    <span>Hora de inicio:</span> <input type="text" name="hora_inicio_curso_nuevo" />
                                                </div>
                                                <div class="the_input half_size_left">
                                                    <span>Fecha de fin:</span> <input type="text" class="elDatePicker" name="fecha_fin_curso_nuevo" />
                                                </div>
                                                <div class="the_input half_size_right">
                                                    <span>Turno:</span>
                                                    <select name="turno_curso_nuevo" form="form_update_autoescuela_<?php echo get_the_id(); ?>">
                                                        <option value="mananas" selected="selected">Mañanas</option>
                                                        <option value="tardes">Tardes</option>
                                                        <option value="findesemana">Fin de semana</option>
                                                    </select>
                                                </div>
                                                <div class="the_input half_size_left">
                                                    <span>Precio:</span> <input type="text" name="precio_curso_nuevo" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="edit_block cursos cursos_actuales">
										<div class="titulo_edicion anadidos">Cursos añadidos:</div><?php
                                        foreach($cursos_actuales as $curso)
                                        { 	
											$categoria=wp_get_post_terms($curso->ID,'tipo-curso'); ?>
                                        	<div class="curso" curso_id="<?php echo $curso->ID; ?>" style="border-color:<?php if(get_field('color_microsite') != ''){ the_field('color_microsite'); }else{ ?>#FF6600<?php } ?>;">
                                            	<div class="gutter">
                                                    <div class="the_input not_full_width radios">
                                                        <p>Tipo de curso:</p>
                                                        <div class="the_subinput">
                                                        	<input type="radio" name="tipo_curso_<?php echo $curso->ID; ?>" value="cap-inicial" <?php if($categoria[0]->slug == 'cap-inicial'){ ?>checked="checked"<?php } ?>> CAP Inicial
                                                        </div>
                                                        <div class="the_subinput">
	                                                        <input type="radio" name="tipo_curso_<?php echo $curso->ID; ?>" value="cap-continua" <?php if($categoria[0]->slug == 'cap-continua'){ ?>checked="checked"<?php } ?>> CAP Continua
                                                        </div>
                                                        <div class="the_subinput">
	                                                        <input type="radio" name="tipo_curso_<?php echo $curso->ID; ?>" value="adr-obtencion" <?php if($categoria[0]->slug == 'adr-obtencion'){ ?>checked="checked"<?php } ?>> ADR Obtención
                                                        </div>
                                                        <div class="the_subinput">
	                                                        <input type="radio" name="tipo_curso_<?php echo $curso->ID; ?>" value="adr-renovacion" <?php if($categoria[0]->slug == 'adr-renovacion'){ ?>checked="checked"<?php } ?>> ADR Renovación
                                                        </div>
                                                    </div>
                                                    <div class="clear"></div>
                                                    <div class="selector_tipo_curso the_input tipo_cap_inicial" <?php if($categoria[0]->slug != 'cap-inicial'){ ?> style="display:none;" <?php } ?>>
                                                        <span>Tipo de curso CAP Inicial:</span>
                                                        <select name="tipo_cap_inicial_curso_<?php echo $curso->ID; ?>" form="form_update_autoescuela_<?php echo get_the_id(); ?>">
                                                            <option value="" <?php if(get_field('tipo_cap_inicial',$curso->ID) == ''){ ?>selected="selected"<?php } ?>>Elige</option>
                                                            <option value="mercancias" <?php if(get_field('tipo_cap_inicial',$curso->ID) == 'mercancias'){ ?>selected="selected"<?php } ?>>Mercancías</option>
                                                            <option value="viajeros" <?php if(get_field('tipo_cap_inicial',$curso->ID) == 'viajeros'){ ?>selected="selected"<?php } ?>>Viajeros</option>
                                                            <option value="mercancias-viajeros" <?php if(get_field('tipo_cap_inicial',$curso->ID) == 'mercancias-viajeros'){ ?>selected="selected"<?php } ?>>Mercancías / Viajeros</option>
                                                        </select>
                                                    </div>
													<?php /*<div class="selector_tipo_curso the_input tipo_cap_ampliacion" style="display:none;">
                                                        <span>Tipo de curso CAP Ampliación:</span>
                                                        <select name="tipo_cap_ampliacion_curso_nuevo" form="form_update_autoescuela_<?php echo get_the_id(); ?>">
                                                        	<option value="" selected="selected">Elige</option>
                                                            <option value="mercancias">Mercancías</option>
                                                            <option value="viajeros">Viajeros</option>
                                                        </select>
                                                    </div>*/ ?>
                                                    <div class="selector_tipo_curso the_input tipo_adr" <?php if($categoria[0]->slug != 'adr-obtencion' && $categoria[0]->slug != 'adr-renovacion'){ ?> style="display:none;" <?php } ?>>
                                                        <span>Tipo de curso ADR:</span>
                                                        <select name="tipo_adr_curso_<?php echo $curso->ID; ?>" form="form_update_autoescuela_<?php echo get_the_id(); ?>">
                                                            <option value="" <?php if(get_field('tipo_adr',$curso->ID) == ''){ ?>selected="selected"<?php } ?>>Elige</option>
                                                            <option value="basico" <?php if(get_field('tipo_adr',$curso->ID) == 'basico'){ ?>selected="selected"<?php } ?>>Básico</option>
                                                            <option value="cisternas" <?php if(get_field('tipo_adr',$curso->ID) == 'cisternas'){ ?>selected="selected"<?php } ?>>Cisternas</option>
                                                            <option value="basico-cisternas" <?php if(get_field('tipo_adr',$curso->ID) == 'basico-cisternas'){ ?>selected="selected"<?php } ?>>Básico + Cisternas</option>
                                                            <option value="explosivos" <?php if(get_field('tipo_adr',$curso->ID) == 'explosivos'){ ?>selected="selected"<?php } ?>>Explosivos</option>
                                                            <option value="radiactivos" <?php if(get_field('tipo_adr',$curso->ID) == 'radiactivos'){ ?>selected="selected"<?php } ?>>Radiactivos</option>
                                                            <option value="otros" <?php if(get_field('tipo_adr',$curso->ID) == 'otros'){ ?>selected="selected"<?php } ?>>Otros (Indicad cuál)</option>
                                                        </select>
														<div class="the_input tipo_adr_texto" <?php if(get_field('tipo_adr_texto',$curso->ID) == ''){ ?> style="display:none;" <?php } ?>>
                                                            <span>Indica tipo de curso ADR:</span> <input type="text" name="tipo_adr_texto_curso_<?php echo $curso->ID; ?>" value="<?php the_field('tipo_adr_texto',$curso->ID); ?>" />
                                                        </div>
                                                    </div>
                                                    <div class="clear"></div>
                                                    <?php /*<div class="the_input tipo_adr">
                                                        <span>Tipo de curso CAP/ADR:</span> <input type="text" name="tipo_adr_curso_<?php echo $curso->ID; ?>" value="<?php the_field('tipo_de_curso',$curso->ID); ?>" />
                                                    </div>*/ ?>
                                                    <div class="the_input">
                                                        <span>Horario del curso:</span> <input type="text" name="horario_curso_<?php echo $curso->ID; ?>" value="<?php the_field('horario_texto',$curso->ID); ?>" />
                                                    </div>
                                                    <div class="the_input half_size_left">
                                                        <span>Fecha de inicio:</span> <input type="text" class="elDatePicker" name="fecha_inicio_curso_<?php echo $curso->ID; ?>" value="<?php echo get_field('fecha_inicio',$curso->ID); ?>" />
                                                    </div>
                                                    <div class="the_input half_size_right">
                                                        <span>Hora de inicio:</span> <input type="text" name="hora_inicio_curso_<?php echo $curso->ID; ?>" value="<?php the_field('hora_inicio',$curso->ID); ?>" />
                                                    </div>
                                                    <div class="the_input half_size_left">
                                                        <span>Fecha de fin:</span> <input type="text" class="elDatePicker" name="fecha_fin_curso_<?php echo $curso->ID; ?>" value="<?php echo get_field('fecha_de_finalizacion',$curso->ID); ?>" />
                                                    </div>
                                                    <div class="the_input half_size_right">
                                                        <span>Turno:</span>
                                                        <select name="turno_curso_<?php echo $curso->ID; ?>" form="form_update_autoescuela_<?php echo get_the_id(); ?>">
                                                            <option value="" <?php if(get_field('horario',$curso->ID)==''){ ?>selected="selected"<?php } ?>>- Elige -</option>
                                                            <option value="mananas" <?php if(get_field('horario',$curso->ID)=='mananas'){ ?>selected="selected"<?php } ?>>Mañanas</option>
                                                            <option value="tardes" <?php if(get_field('horario',$curso->ID)=='tardes'){ ?>selected="selected"<?php } ?>>Tardes</option>
                                                            <option value="findesemana" <?php if(get_field('horario',$curso->ID)=='findesemana'){ ?>selected="selected"<?php } ?>>Fin de semana</option>
                                                        </select>
                                                    </div>
                                                    <div class="the_input half_size_left">
                                                        <span>Precio:</span> <input type="text" name="precio_curso_<?php echo $curso->ID; ?>" value="<?php echo get_post_meta($curso->ID,'_regular_price',true); ?>" />
                                                    </div>
                                                    <div class="the_input clear_only">
														<input type="checkbox" name="eliminar_curso_<?php echo $curso->ID; ?>" value="si"> Eliminar este curso (marcar casilla y pulsar botón "Guardar cambios")
													</div>
                                                </div>
											</div><?php                                            
                                        } ?>
                                    </div>
                                </section>
									</div>
					
					
					<!-- #Content -->
										
                    <div id="Content" class="new_2020" microsite-color="<?php echo str_replace('#','',$color_microsite); ?>" color-texto="<?php echo str_replace('#','',$tcolor); ?>">
                        <div class="content_wrapper clearfix"><?php
                            $logo=get_the_post_thumbnail_url();
                            $imagen_cabecera=get_field('imagen_cabecera'); ?>
                            <div class="header_microsite new" style="background-color:<?php echo $color_microsite; ?>;">
                            	<div class="overlay" style="background-color:<?php echo $color_microsite; ?>;"></div>
                                <div class="cabecera_contenido">
                                    <div class="logo_principal" style="color:<?php echo $tcolor; ?>;"><?php 
                                        if($logo != '')
                                        { ?>
                                            <img alt="<?php echo get_the_title(); ?>" src="<?php echo $logo; ?>" /><?php
                                        }
                                        else
                                        { ?>
                                            <img alt="<?php echo get_the_title(); ?>" src="<?php echo get_bloginfo('stylesheet_directory'); ?>/img/microsites/logo_generico.png" /><?php						
                                        } ?>
                                        <div class="clear"></div>
                                        <div class="edit_block logo numbered">
                                            <div class="titulo">Cambiar logo</div>
                                            <input type="file" name="logo_image" id="logo_image"><br /><?php
                                            if(has_post_thumbnail())
                                            { ?>
                                                <div class="remove_current">
                                                    <input type="checkbox" name="delete_current_logo" value="yes"> <label for="delete_current_logo">Eliminar logo actual (se colocará en su lugar un logo genérico)</label>
                                                </div><?php
                                            } ?>
                                        </div>
                                    </div>
                                    <div class="texto_cabecera">
                                        <h1 class="titulo" style="color:<?php echo $tcolor; ?>;"><?php echo get_the_title(); ?></h1>
										<div class="edit_block titulo numbered">
                                            <div class="titulo" style="color:<?php echo $tcolor; ?>;">Cambiar título</div>
                                            <input type="text" name="new_title" id="new_title" value="<?php echo get_the_title(); ?>">
                                        </div>
                                    </div>
                                    <div class="color_microsite">
	                                    <div class="edit_block color numbered">
    	                                    <div class="titulo" style="color:<?php echo $tcolor; ?>;">Elige color principal para tu sitio</div>
        	                                <input class="jscolor" name="color_microsite" value="<?php if(get_field('color_microsite') != ''){ echo str_replace('#','',get_field('color_microsite')); }else{ ?>FF6600<?php } ?>">
            	                        </div>
                                    </div>
                                    <div class="edit_block contacto_cabecera numbered">
                                        <p class="titulo" style="color:<?php echo $tcolor; ?>;">Datos de contacto</p>
										<div class="elemento tlf_fijo"><p class="titulo" style="color:<?php echo $tcolor; ?>;">Teléfono fijo:</p> <input type="text" name="new_tlf_fijo" id="new_tlf_fijo" value="<?php the_field('telefono_fijo'); ?>" placeholder="Teléfono fijo del centro"></div>
										<div class="elemento mail"><p class="titulo" style="color:<?php echo $tcolor; ?>;">Email:</p> <input type="text" name="new_e-mail" id="new_e-mail" value="<?php the_field('e-mail'); ?>" placeholder="e-mail del centro"></div>
                                        <div class="elemento new_Whatsapptelf">
                                            <p class="titulo" style="color:<?php echo $tcolor; ?>;">Teléfono para notificaciones de Whatsapp</p>
                                            <?php
                                                if ( get_field('Whatsapptelf') ) {
                                                    $inputValue = get_field('Whatsapptelf');
                                                } else {
                                                    $inputValue = get_field('telefono_movil');
                                                }
                                            ?>
                                            <input type="text" name="new_Whatsapptelf" id="new_Whatsapptelf" value="<?php echo $inputValue ?>" placeholder=""  maxlength="9">
                                            <p style="font-size:10px;">Por favor, escriba un único número de teléfono"</p>


                                            <div class="elemento tlf_movil"><p class="titulo" style="color:<?php echo $tcolor; ?>;">Teléfono movil:</p> 	<input type="text" name="new_tlf_movil" id="new_tlf_movil" value="<?php the_field('telefono_movil'); ?>" placeholder="Teléfono móvil del centro" maxlength="9"></div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- .sections_group -->
                            <div class="microsite_sections">
                            	<div class="section_wrapper"><p class="titulo_edicion numbered">Selecciona qué tipos de cursos ofrece la autoescuela:</p></div>
                                <section class="cursos_genericos section_wrapper mcb-section-inner">
                                	<div class="cabecera_mobile" style="display:none;">Cursos que ofrecemos</div>
                                    <div class="cursos_genericos_1 column mcb-column one-third column_column">
                                        <div class="gutter"><?php
											$values_autoescuela=array();
											if(get_field('cursos_ofrecidos_tipo_autoescuela'))
											{
												$values_autoescuela = get_field('cursos_ofrecidos_tipo_autoescuela');
											}
											$values_transporte=array();
											if(get_field('cursos_ofrecidos_tipo_transporte'))
											{
												$values_transporte = get_field('cursos_ofrecidos_tipo_transporte');
											}
											$values_mas=array();
											if(get_field('cursos_ofrecidos_tipo_mas_cursos'))
											{
												$values_mas = get_field('cursos_ofrecidos_tipo_mas_cursos');
											}
											$values=array_merge($values_autoescuela,$values_transporte,$values_mas);
											$field_autoescuela = get_field_object('cursos_ofrecidos_tipo_autoescuela');
											$choices_autoescuela = $field_autoescuela['choices'];
											$field_transporte = get_field_object('cursos_ofrecidos_tipo_transporte');
											$choices_transporte = $field_transporte['choices'];
											$field_mas = get_field_object('cursos_ofrecidos_tipo_mas_cursos');
											$choices_mas = $field_mas['choices'];
											$field=array_merge($field_autoescuela,$field_transporte,$field_mas);
											$choices=array_merge($choices_autoescuela,$choices_transporte,$choices_mas); ?>
                                            <ul class="cursos">
												<li style="border-color:<?php if(get_field('color_microsite') != ''){ the_field('color_microsite'); }else{ ?>#FF6600<?php } ?>;width:100%;"><?php 
													_e('Cursos predefinidos (marca la casilla de los que quieras que aparezcan en la versión pública de la página):','academiadeltransportista'); ?>
												</li><?php
												foreach($choices as $choice_value => $choice_label)
												{ ?>
                                                	<li style="border-color:<?php if(get_field('color_microsite') != ''){ the_field('color_microsite'); }else{ ?>#FF6600<?php } ?>;"><?php
														$found=false;
														foreach ($values as $value)
														{
															if ($value['value'] == $choice_value)
															{ ?>
																<input type="checkbox" checked="checked" name="<?php echo $choice_value; ?>" value="yes" <?php if($microsite_level=='pro'){ ?> style="display:none;" <?php } ?>><?php
																$found=true;
															}
														} // end foreach $values
														if(!$found)
														{ ?>
															<input type="checkbox" name="<?php echo $choice_value; ?>" value="yes"><?php
														} ?>
                                                        <label for="<?php echo $choice_value; ?>"><?php echo $choice_label; ?></label>
                                                    </li><?php
												} // end foreach $choices 
												$cursos_anadidos_autoescuela=get_field('cursos_ofrecidos_tipo_autoescuela_adicionales');
												$cursos_anadidos_transporte=get_field('cursos_ofrecidos_tipo_transporte_adicionales');
                                                $cursos_anadidos_mas=get_field('cursos_ofrecidos_tipo_mas_cursos_adicionales');
												if(!empty($cursos_anadidos_autoescuela) || !empty($cursos_anadidos_transporte) || !empty($cursos_anadidos_mas))
												{ ?>
                                                	<li style="border-color:<?php if(get_field('color_microsite') != ''){ the_field('color_microsite'); }else{ ?>#FF6600<?php } ?>;width:100%;"><?php 
														_e('Cursos adicionales añadidos (para eliminar uno, bórralo y guarda la página):','academiadeltransportista'); ?>
													</li><?php
													if(!empty($cursos_anadidos_autoescuela))
													{
														$i=0;
														foreach($cursos_anadidos_autoescuela as $curso_anadido)
														{ ?>
															<li style="border-color:<?php if(get_field('color_microsite') != ''){ the_field('color_microsite'); }else{ ?>#FF6600<?php } ?>;">
																<input type="text" class="add_curso_autoescuela" name="add_curso_autoescuela_<?php echo $i; ?>" value="<?php echo $curso_anadido['nombre'] ?>" />
															</li><?php
															$i++;
														}
													}
													if(!empty($cursos_anadidos_transporte))
													{
														$i=0;
														foreach($cursos_anadidos_transporte as $curso_anadido)
														{ ?>
															<li style="border-color:<?php if(get_field('color_microsite') != ''){ the_field('color_microsite'); }else{ ?>#FF6600<?php } ?>;">
																<input type="text" class="add_curso_transporte" name="add_curso_transporte_<?php echo $i; ?>" value="<?php echo $curso_anadido['nombre'] ?>" />
															</li><?php
															$i++;
														}
													}
													if(!empty($cursos_anadidos_mas))
													{
														$i=0;
														foreach($cursos_anadidos_mas as $curso_anadido)
														{ ?>
															<li style="border-color:<?php if(get_field('color_microsite') != ''){ the_field('color_microsite'); }else{ ?>#FF6600<?php } ?>;">
																<input type="text" class="add_curso_mas" name="add_curso_mas_<?php echo $i; ?>" value="<?php echo $curso_anadido['nombre'] ?>" />
															</li><?php
															$i++;
														}
													}
												} ?>
                                                <li style="border-color:<?php if(get_field('color_microsite') != ''){ the_field('color_microsite'); }else{ ?>#FF6600<?php } ?>;width:100%;"><?php 
													_e('Añade un nuevo curso escribiendo su nombre aquí y guardando la página:','academiadeltransportista'); ?>
                                                </li>
                                                <li style="border-color:<?php if(get_field('color_microsite') != ''){ the_field('color_microsite'); }else{ ?>#FF6600<?php } ?>;width:100%;">
                                                	<input type="text" class="add_curso_mas" name="add_curso_mas" placeholder="Añadir otro curso" />
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </section>
                                <section class="conoce_autoescuela section_wrapper mcb-section-inner">
                                    <div class="titulo_2"><?php _e('Conoce la autoescuela','academiadeltransportista'); ?></div>
                                    <div class="logo column mcb-column two-fifth column_column"><?php
                                        if($logo != '')
                                        { ?>
                                            <img alt="<?php echo get_the_title(); ?>" src="<?php echo $logo; ?>" /><?php
                                        }
                                        else
                                        { ?>
                                            <img alt="<?php echo get_the_title(); ?>" src="<?php echo get_bloginfo('stylesheet_directory'); ?>/img/microsites/logo_generico.png" /><?php						
                                        } ?>
                                    </div>
                                    <div class="textos column mcb-column three-fifth column_column">
                                    	<?php
                                        if(get_field('texto_cabecera') != '')
                                        { ?>
                                            <div class="descripcion"><?php the_field('texto_cabecera'); ?></div><?php
                                        } ?>
                                        <div class="edit_block descripcion numbered">
                                            <div class="titulo">Cambiar introducción</div>
                                            <textarea type="text" name="new_description" id="new_description"><?php the_field('texto_cabecera'); ?></textarea>
                                        </div>
                                        <div class="titulo_descripcion"><?php 
                                            if(get_field('titulo_texto_informacion') != '')
                                            {
                                                the_field('titulo_texto_informacion');
                                            }
                                            else
                                            {
                                                _e('No hay texto descriptivo actualmente','academiadeltransportista');
                                            } ?>
                                            <div class="edit_block texto_descriptivo numbered">
	                                            <div class="titulo">Cambiar texto</div>
	                                            <textarea name="new_texto_descriptivo" id="new_texto_descriptivo"><?php the_field('titulo_texto_informacion'); ?></textarea>
                                            </div>
                                        </div>
                                        <div class="texto_descripcion"><?php 
                                            if(get_field('texto_informacion') != '')
                                            {
                                                the_field('texto_informacion');
                                            }
                                            else
                                            {
                                                _e('No hay texto explicativo','academiadeltransportista');
                                            } ?>
                                            <div class="edit_block texto_informacion numbered">
                                            	<div class="titulo">Cambiar texto</div>
	                                            <textarea name="new_texto_informacion" id="new_texto_informacion"><?php the_field('texto_informacion'); ?></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </section>
                                <section class="detalles_autoescuela section_wrapper mcb-section-inner numbered">
                                    <div class="section_gutter">
                                        <div class="horarios_ubicacion column mcb-column one-second column_column">
                                            <div class="titulo">Ubicación</div>
                                            <div class="elemento ubicacion">
                                                <div class="icono"><img src="<?php echo get_bloginfo('stylesheet_directory'); ?>/img/microsites/ubicacion.png" /></div><?php 
                                                $direccion=get_field('mapa'); echo $direccion['address']; ?><br /><?php
                                                echo get_field('municipio_texto').', '.get_field('provincia_texto'); ?>
                                            </div>
                                            <div class="separador" style="background-color:<?php echo $color_microsite; ?>;"></div>
                                        </div>
										<div class="horarios_ubicacion column mcb-column one-second column_column">
                                            <div class="titulo">Horario</div>
                                            <div class="elemento horario">
                                                <div class="icono"><img src="<?php echo get_bloginfo('stylesheet_directory'); ?>/img/microsites/horario.png" /></div>
												<input type="text" name="new_horario" id="new_horario" value="<?php the_field('horario'); ?>" placeholder="Horario del centro">
                                            </div>
                                            <div class="separador" style="background-color:<?php echo $color_microsite; ?>;"></div>
                                        </div>

                                    </div>
                                </section>
                                <section class="imagenes_autoescuela section_wrapper mcb-section-inner">
									<div class="titulo_edicion numbered">Inserta imágenes de tu autoescuela</div><?php 
                                    if(have_rows('imagenes'))
                                    { ?>
                                        <div class="owl-carousel"><?php
                                            while(have_rows('imagenes'))
                                            {
                                                the_row();
                                                $imagen=get_sub_field('imagen'); ?>
                                                <div><?php /*<a href="<?php echo $imagen['url']; ?>">*/ ?><img src="<?php echo aq_resize($imagen['url'],580,390,true,true,true); ?>" /><?php /*</a>*/ ?></div><?php
                                            } ?>
                                        </div><?php
                                    }
                                    else
                                    { ?>
                                        <div class="owl-carousel default">
                                            <div><a href="#"><img src="<?php echo get_bloginfo('stylesheet_directory'); ?>/img/microsites/default_image.png" /></a></div>
                                            <div><a href="#"><img src="<?php echo get_bloginfo('stylesheet_directory'); ?>/img/microsites/default_image.png" /></a></div>
                                        </div><?php
                                    } ?>
                                    <div class="edit_block imagenes_carrusel"><?php
										$imagenes=get_field('imagenes');
										if($imagenes)
										{
											$num_imagenes=count($imagenes);
										}
										else
										{
											$num_imagenes=0;
										}
										/*print_r($imagenes);*/ ?>
                                        <div class="titulo">Añadir imágenes</div><?php
										if($num_imagenes < 6)
										{ ?>
	                                        <div class="instrucciones">El máximo de imágenes permitido es de 6<?php if($num_imagenes !=6){ ?>, por lo que solo puedes añadir <?php echo (6-$num_imagenes); ?> imágenes más. Para añadir más, tendrás que eliminar antes otras imágenes<?php } ?>.</div>
											<ol><?php
	    	                                    for($i=1;$i<=(6-$num_imagenes);$i++)
												{ ?>
        	    	                            	<li><input type="file" name="anadir_imagen_<?php echo $i; ?>" id="anadir_imagen_<?php echo $i; ?>"></li><?php											
												} ?>
                        	                </ol><?php
										}
										else
										{ ?>
                                        	<div class="instrucciones">El máximo de imágenes permitido es de 6, por lo que no puedes añadir más. Para añadir más, tendrás que eliminar antes otras imágenes.</div><?php
										} ?>
                                        <div class="titulo">Eliminar imágenes</div>
										<div class="instrucciones">Selecciona las imágenes a eliminar y guarda la página</div><?php
										if($num_imagenes > 0)
										{ ?>
                                        	<ul><?php
												$j=1;
												foreach($imagenes as $imagen)
    	                                        {
        	                                        $la_imagen=$imagen['imagen']; ?>
													<input type="checkbox" name="borrar_imagen_<?php echo $j; ?>" value="<?php echo $la_imagen['ID']; ?>"> <img src="<?php echo $la_imagen['sizes']['thumbnail']; ?>" /><?php
													$j++;
												} ?>
                                            </ul><?php
										} ?>
                                    </div>
                                </section>
                                <section class="cta_banner section_wrapper mcb-section-inner">
                                    <div class="the_cta" style="background-color:<?php if(get_field('color_microsite') != ''){ the_field('color_microsite'); }else{ ?>#FF6600<?php } ?>;">
                                        <div class="textos column mcb-column three-fifth column_column">
                                            <div class="gutter">
                                                <div class="titulo_2" style="color:<?php echo $tcolor; ?>;">Confía en nuestros docentes y en nuestra experiencia</div>
                                                <a href="#" class="microsite_main_cta" style="background:<?php if(get_field('color_microsite') != ''){ the_field('color_microsite'); }else{ ?>#FF6600<?php } ?>;"><?php _e('Quiero matricularme','academiadeltransportista'); ?></a>
                                            </div>
                                        </div>
                                        <div class="imagen column mcb-column two-fifth column_column">
                                            <div class="gutter">
                                                <img src="<?php echo get_bloginfo('stylesheet_directory'); ?>/img/microsites/icono-cta.png" />
                                            </div>
                                        </div>
                                    </div>
                                </section>
                                <section class="cursos section_wrapper mcb-section-inner">
                                	<div class="titulo_edicion numbered">Añade las próximas convocatorias de tus cursos CAP Inicial, CAP Continua, ADR Obtención y ADR Renovación:</div>
                                    <div class="edit_block cursos nuevo_curso">
	                                    <div class="titulo_edicion nuevo">Insertar nuevo curso:</div>
                                    	<div class="curso" style="border-color:<?php if(get_field('color_microsite') != ''){ the_field('color_microsite'); }else{ ?>#FF6600<?php } ?>;">
                                        	<div class="gutter">
                                                <div class="the_input not_full_width">
                                                    <input type="checkbox" name="insertar_nuevo_curso" value="Sí"> Insertar este nuevo curso
                                                </div>
                                                <div class="the_input tipo not_full_width radios">
                                                    <p>Tipo de curso:</p>
                                                    <div class="the_subinput">
	                                                    <input type="radio" name="tipo_curso_nuevo" value="cap-inicial"> CAP Inicial
                                                    </div>
                                                    <div class="the_subinput">
	                                                    <input type="radio" name="tipo_curso_nuevo" value="cap-continua"> CAP Continua
                                                    </div><?php
													if(false)/*current_user_can('administrator'))*/
													{ ?>
														<div class="the_subinput">
                                                            <input type="radio" name="tipo_curso_nuevo" value="cap-ampliacion"> CAP Ampliación
                                                        </div><?php
													} ?>
                                                    <div class="the_subinput">
	                                                    <input type="radio" name="tipo_curso_nuevo" value="adr-obtencion"> ADR Obtención
                                                    </div>
                                                    <div class="the_subinput">
	                                                    <input type="radio" name="tipo_curso_nuevo" value="adr-renovacion"> ADR Renovación
                                                    </div>
                                                </div>
                                                <div class="clear"></div><?php
												if(true)/*current_user_can('administrator'))*/
												{ ?>
													<div class="selector_tipo_curso the_input tipo_cap_inicial" style="display:none;">
                                                        <span>Tipo de curso CAP Inicial:</span>
                                                        <select name="tipo_cap_inicial_curso_nuevo" form="form_update_autoescuela_<?php echo get_the_id(); ?>">
                                                            <option value="" selected="selected">Elige</option>
                                                            <option value="mercancias">Mercancías</option>
                                                            <option value="viajeros">Viajeros</option>
                                                            <option value="mercancias-viajeros">Mercancías / Viajeros</option>
                                                        </select>
                                                    </div>
													<?php /*<div class="selector_tipo_curso the_input tipo_cap_ampliacion" style="display:none;">
                                                        <span>Tipo de curso CAP Ampliación:</span>
                                                        <select name="tipo_cap_ampliacion_curso_nuevo" form="form_update_autoescuela_<?php echo get_the_id(); ?>">
                                                        	<option value="" selected="selected">Elige</option>
                                                            <option value="mercancias">Mercancías</option>
                                                            <option value="viajeros">Viajeros</option>
                                                        </select>
                                                    </div>*/ ?>
													<div class="selector_tipo_curso the_input tipo_adr" style="display:none;">
                                                        <span>Tipo de curso ADR:</span>
                                                        <select name="tipo_adr_curso_nuevo" form="form_update_autoescuela_<?php echo get_the_id(); ?>">
                                                        	<option value="" selected="selected">Elige</option>
                                                            <option value="basico">Básico</option>
                                                            <option value="cisternas">Cisternas</option>
                                                            <option value="basico-cisternas">Básico + Cisternas</option>
                                                            <option value="explosivos">Explosivos</option>
                                                            <option value="radiactivos">Radiactivos</option>
                                                            <option value="otros">Otros (Indicad cuál)</option>
                                                        </select>
                                                        <div class="the_input tipo_adr_texto" style="display:none;">
                                                            <span>Indica tipo de curso ADR:</span> <input type="text" name="tipo_adr_texto_curso_nuevo" />
                                                        </div>
                                                    </div><?php
												} ?>
                                                <?php /*<div class="the_input tipo_adr" style="display:none;">
                                                    <span>Tipo de curso ADR:</span> <input type="text" name="tipo_adr_curso_nuevo" />
                                                </div>*/ ?>
                                                <div class="the_input">
                                                    <span>Horario del curso:</span> <input type="text" name="horario_curso_nuevo" />
                                                </div>
                                                <div class="the_input half_size_left">
                                                    <span>Fecha de inicio:</span> <input type="text" class="elDatePicker" name="fecha_inicio_curso_nuevo" />
                                                </div>
                                                <div class="the_input half_size_right">
                                                    <span>Hora de inicio:</span> <input type="text" name="hora_inicio_curso_nuevo" />
                                                </div>
                                                <div class="the_input half_size_left">
                                                    <span>Fecha de fin:</span> <input type="text" class="elDatePicker" name="fecha_fin_curso_nuevo" />
                                                </div>
                                                <div class="the_input half_size_right">
                                                    <span>Turno:</span>
                                                    <select name="turno_curso_nuevo" form="form_update_autoescuela_<?php echo get_the_id(); ?>">
                                                        <option value="mananas" selected="selected">Mañanas</option>
                                                        <option value="tardes">Tardes</option>
                                                        <option value="findesemana">Fin de semana</option>
                                                    </select>
                                                </div>
                                                <div class="the_input half_size_left">
                                                    <span>Precio:</span> <input type="text" name="precio_curso_nuevo" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="edit_block cursos cursos_actuales">
										<div class="titulo_edicion anadidos">Cursos añadidos:</div><?php
                                        foreach($cursos_actuales as $curso)
                                        { 	
											$categoria=wp_get_post_terms($curso->ID,'tipo-curso'); ?>
                                        	<div class="curso" curso_id="<?php echo $curso->ID; ?>" style="border-color:<?php if(get_field('color_microsite') != ''){ the_field('color_microsite'); }else{ ?>#FF6600<?php } ?>;">
                                            	<div class="gutter">
                                                    <div class="the_input not_full_width radios">
                                                        <p>Tipo de curso:</p>
                                                        <div class="the_subinput">
                                                        	<input type="radio" name="tipo_curso_<?php echo $curso->ID; ?>" value="cap-inicial" <?php if($categoria[0]->slug == 'cap-inicial'){ ?>checked="checked"<?php } ?>> CAP Inicial
                                                        </div>
                                                        <div class="the_subinput">
	                                                        <input type="radio" name="tipo_curso_<?php echo $curso->ID; ?>" value="cap-continua" <?php if($categoria[0]->slug == 'cap-continua'){ ?>checked="checked"<?php } ?>> CAP Continua
                                                        </div>
                                                        <div class="the_subinput">
	                                                        <input type="radio" name="tipo_curso_<?php echo $curso->ID; ?>" value="adr-obtencion" <?php if($categoria[0]->slug == 'adr-obtencion'){ ?>checked="checked"<?php } ?>> ADR Obtención
                                                        </div>
                                                        <div class="the_subinput">
	                                                        <input type="radio" name="tipo_curso_<?php echo $curso->ID; ?>" value="adr-renovacion" <?php if($categoria[0]->slug == 'adr-renovacion'){ ?>checked="checked"<?php } ?>> ADR Renovación
                                                        </div>
                                                    </div>
                                                    <div class="clear"></div>
                                                    <div class="selector_tipo_curso the_input tipo_cap_inicial" <?php if($categoria[0]->slug != 'cap-inicial'){ ?> style="display:none;" <?php } ?>>
                                                        <span>Tipo de curso CAP Inicial:</span>
                                                        <select name="tipo_cap_inicial_curso_<?php echo $curso->ID; ?>" form="form_update_autoescuela_<?php echo get_the_id(); ?>">
                                                            <option value="" <?php if(get_field('tipo_cap_inicial',$curso->ID) == ''){ ?>selected="selected"<?php } ?>>Elige</option>
                                                            <option value="mercancias" <?php if(get_field('tipo_cap_inicial',$curso->ID) == 'mercancias'){ ?>selected="selected"<?php } ?>>Mercancías</option>
                                                            <option value="viajeros" <?php if(get_field('tipo_cap_inicial',$curso->ID) == 'viajeros'){ ?>selected="selected"<?php } ?>>Viajeros</option>
                                                            <option value="mercancias-viajeros" <?php if(get_field('tipo_cap_inicial',$curso->ID) == 'mercancias-viajeros'){ ?>selected="selected"<?php } ?>>Mercancías / Viajeros</option>
                                                        </select>
                                                    </div>
													<?php /*<div class="selector_tipo_curso the_input tipo_cap_ampliacion" style="display:none;">
                                                        <span>Tipo de curso CAP Ampliación:</span>
                                                        <select name="tipo_cap_ampliacion_curso_nuevo" form="form_update_autoescuela_<?php echo get_the_id(); ?>">
                                                        	<option value="" selected="selected">Elige</option>
                                                            <option value="mercancias">Mercancías</option>
                                                            <option value="viajeros">Viajeros</option>
                                                        </select>
                                                    </div>*/ ?>
                                                    <div class="selector_tipo_curso the_input tipo_adr" <?php if($categoria[0]->slug != 'adr-obtencion' && $categoria[0]->slug != 'adr-renovacion'){ ?> style="display:none;" <?php } ?>>
                                                        <span>Tipo de curso ADR:</span>
                                                        <select name="tipo_adr_curso_<?php echo $curso->ID; ?>" form="form_update_autoescuela_<?php echo get_the_id(); ?>">
                                                            <option value="" <?php if(get_field('tipo_adr',$curso->ID) == ''){ ?>selected="selected"<?php } ?>>Elige</option>
                                                            <option value="basico" <?php if(get_field('tipo_adr',$curso->ID) == 'basico'){ ?>selected="selected"<?php } ?>>Básico</option>
                                                            <option value="cisternas" <?php if(get_field('tipo_adr',$curso->ID) == 'cisternas'){ ?>selected="selected"<?php } ?>>Cisternas</option>
                                                            <option value="basico-cisternas" <?php if(get_field('tipo_adr',$curso->ID) == 'basico-cisternas'){ ?>selected="selected"<?php } ?>>Básico + Cisternas</option>
                                                            <option value="explosivos" <?php if(get_field('tipo_adr',$curso->ID) == 'explosivos'){ ?>selected="selected"<?php } ?>>Explosivos</option>
                                                            <option value="radiactivos" <?php if(get_field('tipo_adr',$curso->ID) == 'radiactivos'){ ?>selected="selected"<?php } ?>>Radiactivos</option>
                                                            <option value="otros" <?php if(get_field('tipo_adr',$curso->ID) == 'otros'){ ?>selected="selected"<?php } ?>>Otros (Indicad cuál)</option>
                                                        </select>
														<div class="the_input tipo_adr_texto" <?php if(get_field('tipo_adr_texto',$curso->ID) == ''){ ?> style="display:none;" <?php } ?>>
                                                            <span>Indica tipo de curso ADR:</span> <input type="text" name="tipo_adr_texto_curso_<?php echo $curso->ID; ?>" value="<?php the_field('tipo_adr_texto',$curso->ID); ?>" />
                                                        </div>
                                                    </div>
                                                    <div class="clear"></div>
                                                    <?php /*<div class="the_input tipo_adr">
                                                        <span>Tipo de curso CAP/ADR:</span> <input type="text" name="tipo_adr_curso_<?php echo $curso->ID; ?>" value="<?php the_field('tipo_de_curso',$curso->ID); ?>" />
                                                    </div>*/ ?>
                                                    <div class="the_input">
                                                        <span>Horario del curso:</span> <input type="text" name="horario_curso_<?php echo $curso->ID; ?>" value="<?php the_field('horario_texto',$curso->ID); ?>" />
                                                    </div>
                                                    <div class="the_input half_size_left">
                                                        <span>Fecha de inicio:</span> <input type="text" class="elDatePicker" name="fecha_inicio_curso_<?php echo $curso->ID; ?>" value="<?php echo get_field('fecha_inicio',$curso->ID); ?>" />
                                                    </div>
                                                    <div class="the_input half_size_right">
                                                        <span>Hora de inicio:</span> <input type="text" name="hora_inicio_curso_<?php echo $curso->ID; ?>" value="<?php the_field('hora_inicio',$curso->ID); ?>" />
                                                    </div>
                                                    <div class="the_input half_size_left">
                                                        <span>Fecha de fin:</span> <input type="text" class="elDatePicker" name="fecha_fin_curso_<?php echo $curso->ID; ?>" value="<?php echo get_field('fecha_de_finalizacion',$curso->ID); ?>" />
                                                    </div>
                                                    <div class="the_input half_size_right">
                                                        <span>Turno:</span>
                                                        <select name="turno_curso_<?php echo $curso->ID; ?>" form="form_update_autoescuela_<?php echo get_the_id(); ?>">
                                                            <option value="" <?php if(get_field('horario',$curso->ID)==''){ ?>selected="selected"<?php } ?>>- Elige -</option>
                                                            <option value="mananas" <?php if(get_field('horario',$curso->ID)=='mananas'){ ?>selected="selected"<?php } ?>>Mañanas</option>
                                                            <option value="tardes" <?php if(get_field('horario',$curso->ID)=='tardes'){ ?>selected="selected"<?php } ?>>Tardes</option>
                                                            <option value="findesemana" <?php if(get_field('horario',$curso->ID)=='findesemana'){ ?>selected="selected"<?php } ?>>Fin de semana</option>
                                                        </select>
                                                    </div>
                                                    <div class="the_input half_size_left">
                                                        <span>Precio:</span> <input type="text" name="precio_curso_<?php echo $curso->ID; ?>" value="<?php echo get_post_meta($curso->ID,'_regular_price',true); ?>" />
                                                    </div>
                                                    <div class="the_input clear_only">
														<input type="checkbox" name="eliminar_curso_<?php echo $curso->ID; ?>" value="si"> Eliminar este curso (marcar casilla y pulsar botón "Guardar cambios")
													</div>
                                                </div>
											</div><?php                                            
                                        } ?>
                                    </div>
                                </section>
                            </div>
                        </div>
                    </div>
                    <button class="guardar_cambios" type="submit" style="background-color:<?php if(get_field('color_microsite') != ''){ the_field('color_microsite'); }else{ ?>#FF6600<?php } ?>;"><div>Guardar cambios</div></button>
                </form>
			</div><?php 
		}
		get_footer('microsite');
	}
	else
	{
		wp_redirect(get_permalink(get_the_id()));
	}
}
else
{
	wp_redirect(get_permalink(get_the_id()));
=======
<?php
if(is_user_logged_in())
{
	$microsite_level=get_user_microsite_level();
	if($microsite_level == 'pro' || $microsite_level == 'premium' || $microsite_level == 'exclusive' || get_current_user_id() == 1827 || current_user_can('administrator'))
	{
		$cursos_actuales = get_posts(array(
			'post_type' => 'product',
			'numberposts' => -1,
			'meta_query' => array(
				array(
					'key' => 'autoescuela', // name of custom field
					'value' => '"' . get_the_ID() . '"', // matches exactly "123", not just 123. This prevents a match for "1234"
					'compare' => 'LIKE'
				)
			)
		));
		if($_POST)
		{ ?>
        	<div class="registros_subida"><?php
			
				$la_meta=get_post_meta(get_the_id());
				$imagen_actual=$la_meta['imagen_cabecera'][0];
				
				/* Estamos recibiendo datos. Los guardamos */
				if($_FILES['background_image']['name'] != '')
				{
					$image_id=upload_image_from_form_to_wp_media($_FILES['background_image']);
					if($image_id > 0)
					{
						update_field('imagen_cabecera',$image_id,get_the_id());
						wp_delete_attachment($imagen_actual,true);
					}
				}
				if($_POST['delete_current_bg_image'] == 'yes')
				{
					wp_delete_attachment($imagen_actual,true);
				}
				if($_FILES['logo_image']['name'] != '')
				{
					$image_id=upload_image_from_form_to_wp_media($_FILES['logo_image']);
					if($image_id > 0)
					{
						set_post_thumbnail(get_the_id(),$image_id);
					}
				}
				if($_POST['delete_current_logo'] == 'yes')
				{
					delete_post_thumbnail(get_the_id());
				}
				if($_POST['new_title'] != '')
				{
					wp_update_post(array(
						'ID' => get_the_id(),
						'post_title' => $_POST['new_title']
					));
				}
				if($_POST['new_description'] != '')
				{
					update_field('texto_cabecera',$_POST['new_description'],get_the_id());
				}
				if($_POST['color_microsite'] != '')
				{
					update_field('color_microsite','#'.$_POST['color_microsite'],get_the_id());
				}
				if($_POST['new_horario'] != '')
				{
					update_field('horario',$_POST['new_horario'],get_the_id());
				}
				if($_POST['new_direccion'] != '')
				{
					$address=slugify($_POST['new_direccion']);
					$address=str_replace('-','+',$address);
					$curl = curl_init();
						curl_setopt($curl, CURLOPT_URL, 'https://maps.googleapis.com/maps/api/geocode/json?key=AIzaSyBP9OVPkIgTmQhuMr5kdT7JNHBEmv7cuLU&address='.$address);
						curl_setopt ($curl, CURLOPT_RETURNTRANSFER, 1);
						$json = curl_exec($curl);
					curl_close ($curl);
					$output= json_decode($json);
					
					$lat=$output->results[0]->geometry->location->lat;
					$long=$output->results[0]->geometry->location->lng;
					
					$address_components=$output->results[0]->address_components;
					foreach($address_components as $address_component)
					{
						if($address_component->types[0] == 'locality')
						{
							$municipio_texto=$address_component->long_name;
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
							$provincia_texto=$address_component->long_name;
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
					}
					/*if(get_current_user_id()==6){ print_r($municipio);die; }*/
					update_field('provincia',$provincia,get_the_id());
					update_field('provincia_texto',$provincia_texto,get_the_id());
					update_field('municipios_'.$provincia,$municipio,get_the_id());
					update_field('municipio_texto',$municipio_texto,get_the_id());
					update_field('mapa',array('address' => $_POST['new_direccion'],'lat' => $lat,'lng' => $long),get_the_id());
					wp_update_post(array('ID' => get_the_id()));
				}
				if($_POST['new_tlf_fijo'] != '')
				{
					update_field('telefono_fijo',$_POST['new_tlf_fijo'],get_the_id());
				}
				if($_POST['new_tlf_movil'] != '')
				{
					update_field('telefono_movil',$_POST['new_tlf_movil'],get_the_id());
				}
				if($_POST['new_e-mail'] != '')
				{
					update_field('e-mail',$_POST['new_e-mail'],get_the_id());
				}
                  if($_POST['new_Whatsapptelf'] != '')
                 {
                 update_field('Whatsapptelf',$_POST['new_Whatsapptelf'],get_the_id());
                }
				if($_POST['new_texto_descriptivo'] != '')
				{
					update_field('titulo_texto_informacion',$_POST['new_texto_descriptivo'],get_the_id());
				}
				if($_POST['new_texto_informacion'] != '')
				{
					update_field('texto_informacion',$_POST['new_texto_informacion'],get_the_id());
				}
				if($_POST['borrar_imagen_6'] != '')
				{
					delete_sub_field(array('imagenes', 6, 'imagen'));
					delete_row('imagenes',6,get_the_id());
					wp_delete_attachment($_POST['borrar_imagen_6'],true);
				}
				if($_POST['borrar_imagen_5'] != '')
				{
					delete_sub_field(array('imagenes', 5, 'imagen'));
					delete_row('imagenes',5,get_the_id());
					wp_delete_attachment($_POST['borrar_imagen_5'],true);
				}
				if($_POST['borrar_imagen_4'] != '')
				{
					delete_sub_field(array('imagenes', 4, 'imagen'));
					delete_row('imagenes',4,get_the_id());
					wp_delete_attachment($_POST['borrar_imagen_4'],true);
				}
				if($_POST['borrar_imagen_3'] != '')
				{
					delete_sub_field(array('imagenes', 3, 'imagen'));
					delete_row('imagenes',3,get_the_id());
					wp_delete_attachment($_POST['borrar_imagen_3'],true);
				}
				if($_POST['borrar_imagen_2'] != '')
				{
					delete_sub_field(array('imagenes', 2, 'imagen'));
					delete_row('imagenes',2,get_the_id());
					wp_delete_attachment($_POST['borrar_imagen_2'],true);
				}
				if($_POST['borrar_imagen_1'] != '')
				{
					delete_sub_field(array('imagenes', 1, 'imagen'));
					delete_row('imagenes',1,get_the_id());
					wp_delete_attachment($_POST['borrar_imagen_1'],true);
				}
				if($_FILES['anadir_imagen_1']['name'] != '')
				{
					$image_id=upload_image_from_form_to_wp_media($_FILES['anadir_imagen_1']);
					if($image_id > 0)
					{
						add_row('imagenes',array('imagen' => $image_id),get_the_id());
					}
				}
				if($_FILES['anadir_imagen_2']['name'] != '')
				{
					$image_id=upload_image_from_form_to_wp_media($_FILES['anadir_imagen_2']);
					if($image_id > 0)
					{
						add_row('imagenes',array('imagen' => $image_id),get_the_id());
					}
				}
				if($_FILES['anadir_imagen_3']['name'] != '')
				{
					$image_id=upload_image_from_form_to_wp_media($_FILES['anadir_imagen_3']);
					if($image_id > 0)
					{
						add_row('imagenes',array('imagen' => $image_id),get_the_id());
					}
				}
				if($_FILES['anadir_imagen_4']['name'] != '')
				{
					$image_id=upload_image_from_form_to_wp_media($_FILES['anadir_imagen_4']);
					if($image_id > 0)
					{
						add_row('imagenes',array('imagen' => $image_id),get_the_id());
					}
				}
				if($_FILES['anadir_imagen_5']['name'] != '')
				{
					$image_id=upload_image_from_form_to_wp_media($_FILES['anadir_imagen_5']);
					if($image_id > 0)
					{
						add_row('imagenes',array('imagen' => $image_id),get_the_id());
					}
				}
				if($_FILES['anadir_imagen_6']['name'] != '')
				{
					$image_id=upload_image_from_form_to_wp_media($_FILES['anadir_imagen_6']);
					if($image_id > 0)
					{
						add_row('imagenes',array('imagen' => $image_id),get_the_id());
					}
				}
				$cursos_seleccionados_autoescuela=array();
				if($_POST['curso-obtencion-camion-c'] == 'yes')
				{
					$cursos_seleccionados_autoescuela[]='curso-obtencion-camion-c';
				}
				if($_POST['curso-obtencion-carnet-trailer-c-e'] == 'yes')
				{
					$cursos_seleccionados_autoescuela[]='curso-obtencion-carnet-trailer-c-e';
				}
				if($_POST['curso-obtencion-carnet-autobus-d'] == 'yes')
				{
					$cursos_seleccionados_autoescuela[]='curso-obtencion-carnet-autobus-d';
				}
				if($_POST['curso-obtencion-carnet-remolque-b-e'] == 'yes')
				{
					$cursos_seleccionados_autoescuela[]='curso-obtencion-carnet-remolque-b-e';
				}
				if($_POST['curso-obtencion-carnet-coche-b'] == 'yes')
				{
					$cursos_seleccionados_autoescuela[]='curso-obtencion-carnet-coche-b';
				}
				if($_POST['curso-obtencion-carnet-moto-a'] == 'yes')
				{
					$cursos_seleccionados_autoescuela[]='curso-obtencion-carnet-moto-a';
				}
				update_field('cursos_ofrecidos_tipo_autoescuela',$cursos_seleccionados_autoescuela,get_the_id());
				
				$cursos_seleccionados_transporte=array();
				if($_POST['curso-renovacion-del-cap'] == 'yes')
				{
					$cursos_seleccionados_transporte[]='curso-renovacion-del-cap';
				}
				if($_POST['curso-obtencion-cap-inicial'] == 'yes')
				{
					$cursos_seleccionados_transporte[]='curso-obtencion-cap-inicial';
				}
				if($_POST['curso-obtencion-mercancias-peligrosas'] == 'yes')
				{
					$cursos_seleccionados_transporte[]='curso-obtencion-mercancias-peligrosas';
				}
				if($_POST['curso-renovacion-adr'] == 'yes')
				{
					$cursos_seleccionados_transporte[]='curso-renovacion-adr';
				}
				if($_POST['curso-obtencion-titulo-de-transportista'] == 'yes')
				{
					$cursos_seleccionados_transporte[]='curso-obtencion-titulo-de-transportista';
				}
				if($_POST['curso-consejero-de-seguridad-adr'] == 'yes')
				{
					$cursos_seleccionados_transporte[]='curso-consejero-de-seguridad-adr';
				}
				update_field('cursos_ofrecidos_tipo_transporte',$cursos_seleccionados_transporte,get_the_id());
				
				$cursos_seleccionados_mas=array();
				if($_POST['curso-de-carretillas-elevadoras'] == 'yes')
				{
					$cursos_seleccionados_mas[]='curso-de-carretillas-elevadoras';
				}
				if($_POST['curso-grua-camion-pluma'] == 'yes')
				{
					$cursos_seleccionados_mas[]='curso-grua-camion-pluma';
				}
				if($_POST['une-12195-sujecion-de-cargas-y-estiba'] == 'yes')
				{
					$cursos_seleccionados_mas[]='une-12195-sujecion-de-cargas-y-estiba';
				}
				if($_POST['curso-tacografo-digital'] == 'yes')
				{
					$cursos_seleccionados_mas[]='curso-tacografo-digital';
				}
				if($_POST['cursos-de-logistica'] == 'yes')
				{
					$cursos_seleccionados_mas[]='cursos-de-logistica';
				}
				if($_POST['curso-de-seguridad-vial-laboral'] == 'yes')
				{
					$cursos_seleccionados_mas[]='curso-de-seguridad-vial-laboral';
				}
				update_field('cursos_ofrecidos_tipo_mas_cursos',$cursos_seleccionados_mas,get_the_id()); 
				
				$value_cursos_autoescuela=array();
				for($cont_cursos_autoescuela=0;$cont_cursos_autoescuela<1000;$cont_cursos_autoescuela++)
				{
					if(isset($_POST['add_curso_autoescuela_'.$cont_cursos_autoescuela]))
					{
						if($_POST['add_curso_autoescuela_'.$cont_cursos_autoescuela] != '')
						{
							$value_cursos_autoescuela[]=array(
								'nombre' => $_POST['add_curso_autoescuela_'.$cont_cursos_autoescuela]
							);
						}
					}
					else
					{
						break;
					}
				}
				if($_POST['add_curso_autoescuela'] != '')
				{
					$value_cursos_autoescuela[]=array(
						'nombre' => $_POST['add_curso_autoescuela']
					);
				}
				update_field('cursos_ofrecidos_tipo_autoescuela_adicionales',$value_cursos_autoescuela,get_the_id());
				
				$value_cursos_transporte=array();
				for($cont_cursos_transporte=0;$cont_cursos_transporte<1000;$cont_cursos_transporte++)
				{
					if(isset($_POST['add_curso_transporte_'.$cont_cursos_transporte]))
					{
						if($_POST['add_curso_transporte_'.$cont_cursos_transporte] != '')
						{
							$value_cursos_transporte[]=array(
								'nombre' => $_POST['add_curso_transporte_'.$cont_cursos_transporte]
							);
						}
					}
					else
					{
						break;
					}
				}
				if($_POST['add_curso_transporte'] != '')
				{
					$value_cursos_transporte[]=array(
						'nombre' => $_POST['add_curso_transporte']
					);
				}
				update_field('cursos_ofrecidos_tipo_transporte_adicionales',$value_cursos_transporte,get_the_id());
				
				$value_cursos_mas=array();
				for($cont_cursos_mas=0;$cont_cursos_mas<1000;$cont_cursos_mas++)
				{
					if(isset($_POST['add_curso_mas_'.$cont_cursos_mas]))
					{
						if($_POST['add_curso_mas_'.$cont_cursos_mas] != '')
						{
							$value_cursos_mas[]=array(
								'nombre' => $_POST['add_curso_mas_'.$cont_cursos_mas]
							);
						}
					}
					else
					{
						break;
					}
				}
				if($_POST['add_curso_mas'] != '')
				{
					$value_cursos_mas[]=array(
						'nombre' => $_POST['add_curso_mas']
					);
				}
				update_field('cursos_ofrecidos_tipo_mas_cursos_adicionales',$value_cursos_mas,get_the_id());
                
                /* cursos booking */
				foreach($cursos_actuales as $curso)
				{
					if($_POST['eliminar_curso_'.$curso->ID] == 'si')
					{
						wp_trash_post($curso->ID);
					}
					else
					{
						if($_POST['tipo_curso_'.$curso->ID] != '')
						{
							if($_POST['tipo_curso_'.$curso->ID] == 'cap-inicial')
							{
								$cat=53;
								$cat_tc=28;
							}
							elseif($_POST['tipo_curso_'.$curso->ID] == 'cap-continua')
							{
								$cat=27;
								$cat_tc=29;
							}
							elseif($_POST['tipo_curso_'.$curso->ID] == 'adr-obtencion')
							{
								$cat=55;
								$cat_tc=30;
							}
							elseif($_POST['tipo_curso_'.$curso->ID] == 'adr-renovacion')
							{
								$cat=54;
								$cat_tc=31;
							}
							wp_set_post_terms($curso->ID,array($cat),'product_cat');
							wp_set_post_terms($curso->ID,array($cat_tc),'tipo-curso');
						}
						
						if($_POST['tipo_cap_inicial_curso_'.$curso->ID] != '')
						{
							update_field('tipo_cap_inicial',$_POST['tipo_cap_inicial_curso_'.$curso->ID],$curso->ID);
						}
						if($_POST['tipo_cap_ampliacion_curso_'.$curso->ID] != '')
						{
							update_field('tipo_cap_ampliacion',$_POST['tipo_cap_ampliacion_curso_'.$curso->ID],$curso->ID);
						}
						if($_POST['tipo_adr_curso_'.$curso->ID] != '')
						{
							update_field('tipo_adr',$_POST['tipo_adr_curso_'.$curso->ID],$curso->ID);
						}
						if($_POST['tipo_adr_texto_curso_'.$curso->ID] != '')
						{
							update_field('tipo_adr_texto',$_POST['tipo_adr_texto_curso_'.$curso->ID],$curso->ID);
						}
						/**/
						/*if($_POST['tipo_adr_curso_'.$curso->ID] != '')
						{
							if($_POST['tipo_adr_curso_'.$curso->ID] != get_field('tipo_de_curso',$curso->ID))
							{
								update_field('tipo_de_curso',$_POST['tipo_adr_curso_'.$curso->ID],$curso->ID);
							}
						}*/
						if($_POST['horario_curso_'.$curso->ID] != '')
						{
							if($_POST['horario_curso_'.$curso->ID] != get_field('horario_texto',$curso->ID))
							{
								update_field('horario_texto',$_POST['horario_curso_'.$curso->ID],$curso->ID);
							}
						}
						if($_POST['fecha_inicio_curso_'.$curso->ID] != '')
						{
							$anyo=substr($_POST['fecha_inicio_curso_'.$curso->ID],6,4);
							$mes=substr($_POST['fecha_inicio_curso_'.$curso->ID],3,2);
							$dia=substr($_POST['fecha_inicio_curso_'.$curso->ID],0,2);
							$fecha_formateada=$anyo.$mes.$dia;
							if($fecha_formateada != get_field('fecha_inicio',$curso->ID))
							{
								update_field('fecha_inicio',$fecha_formateada,$curso->ID);
							}
						}
						if($_POST['fecha_fin_curso_'.$curso->ID] != '')
						{
							$anyo=substr($_POST['fecha_fin_curso_'.$curso->ID],6,4);
							$mes=substr($_POST['fecha_fin_curso_'.$curso->ID],3,2);
							$dia=substr($_POST['fecha_fin_curso_'.$curso->ID],0,2);
							$fecha_formateada=$anyo.$mes.$dia;
							if($fecha_formateada != get_field('fecha_de_finalizacion',$curso->ID))
							{
								update_field('fecha_de_finalizacion',$fecha_formateada,$curso->ID);
							}
						}
						if($_POST['hora_inicio_curso_'.$curso->ID] != get_field('hora_inicio',$curso->ID))
						{
							update_field('hora_inicio',$_POST['hora_inicio_curso_'.$curso->ID],$curso->ID);
						}
						if($_POST['turno_curso_'.$curso->ID] != get_field('horario',$curso->ID))
						{
							update_field('horario',$_POST['turno_curso_'.$curso->ID],$curso->ID);
						}
						if($_POST['precio_curso_'.$curso->ID] != '')
						{
							$nuevo_precio=str_replace(',','.',$_POST['precio_curso_'.$curso->ID]);
							if($nuevo_precio != get_post_meta($curso->ID,'_regular_price',true))
							{
								update_post_meta( $curso->ID, '_regular_price', $nuevo_precio );
								update_post_meta( $curso->ID, '_price', $nuevo_precio );
							}
						}
					}
				}
				if($_POST['insertar_nuevo_curso'] == 'Sí')
				{
					$cuerpo_mail='Se ha añadido el siguiente nuevo curso desde un microsite: <br /><ul>';
					if($_POST['tipo_curso_nuevo'] == 'cap-inicial')
					{
						$titulo='CAP INICIAL';
						$cat=53;
						$cat_tc=28;
					}
					elseif($_POST['tipo_curso_nuevo'] == 'cap-continua')
					{
						$titulo='CAP CONTINUA';
						$cat=27;
						$cat_tc=29;
					}
					elseif($_POST['tipo_curso_nuevo'] == 'adr-obtencion')
					{
						$titulo='ADR OBTENCIÓN';
						$cat=55;
						$cat_tc=30;
					}
					elseif($_POST['tipo_curso_nuevo'] == 'adr-renovacion')
					{
						$titulo='ADR RENOVACIÓN';
						$cat=54;
						$cat_tc=31;
					}
					
					$cuerpo_mail.='<li>Tipo de curso: '.$titulo.'</li>';
					
					$postarr=array(
						'post_title' => $titulo,
						'post_type' => 'product',
						'post_status' => 'publish'
					);
					$post_id=wp_insert_post($postarr);
					
					wp_set_post_terms($post_id,array($cat),'product_cat');
					wp_set_post_terms($post_id,array($cat_tc),'tipo-curso');
					
					$precio=$_POST['precio_curso_nuevo'];
					$cuerpo_mail.='<li>Precio del curso: '.$precio.'</li>';
					$precio=str_replace(array(' ','€'),'',$precio);
					update_post_meta( $post_id, '_regular_price', $precio );
					update_post_meta( $post_id, '_price', $precio );
										
					update_field('autoescuela',array(get_the_id()),$post_id);
					$cuerpo_mail.='<li>ID autoescuela: '.get_the_id().'</li>';
					$cuerpo_mail.='<li><a href="'.get_bloginfo('url').'/wp-admin/post.php?post='.get_the_id().'&action=edit">Enlace edición autoescuela</a>.</li>';
					
					$anyo=substr($_POST['fecha_inicio_curso_nuevo'],6,4);
					$mes=substr($_POST['fecha_inicio_curso_nuevo'],3,2);
					$dia=substr($_POST['fecha_inicio_curso_nuevo'],0,2);
					$fecha_formateada=$anyo.$mes.$dia;
					$fecha_inicio_formateada=$fecha_formateada;
					update_field('fecha_inicio',$fecha_formateada,$post_id);
					$cuerpo_mail.='<li>Fecha de inicio: '.$_POST['fecha_inicio_curso_nuevo'].'</li>';
					
					$anyo=substr($_POST['fecha_fin_curso_nuevo'],6,4);
					$mes=substr($_POST['fecha_fin_curso_nuevo'],3,2);
					$dia=substr($_POST['fecha_fin_curso_nuevo'],0,2);
					$fecha_formateada=$anyo.$mes.$dia;
					$fecha_fin_formateada=$fecha_formateada;
					update_field('fecha_de_finalizacion',$fecha_formateada,$post_id);
					$cuerpo_mail.='<li>Fecha de fin: '.$_POST['fecha_fin_curso_nuevo'].'</li>';
					
					update_field('horario',$_POST['turno_curso_nuevo'],$post_id);
					$cuerpo_mail.='<li>Turno: '.$_POST['turno_curso_nuevo'].'</li>';
					
					update_field('hora_inicio',$_POST['hora_inicio_curso_nuevo'],$post_id);
					$cuerpo_mail.='<li>Hora de inicio: '.$_POST['hora_inicio_curso_nuevo'].'</li>';
					
					update_field('horario_texto',$_POST['horario_curso_nuevo'],$post_id);
					$cuerpo_mail.='<li>Horario: '.$_POST['horario_curso_nuevo'].'</li>';
					
					if($_POST['tipo_cap_inicial_curso_nuevo'] != '')
					{
						update_field('tipo_cap_inicial',$_POST['tipo_cap_inicial_curso_nuevo'],$post_id);
						$cuerpo_mail.='<li>Tipo curso CAP inicial: '.$_POST['tipo_cap_inicial_curso_nuevo'].'</li>';
					}
					if($_POST['tipo_cap_ampliacion_curso_nuevo'] != '')
					{
						update_field('tipo_cap_ampliacion',$_POST['tipo_cap_ampliacion_curso_nuevo'],$post_id);
						$cuerpo_mail.='<li>Tipo curso CAP ampliación: '.$_POST['tipo_cap_ampliacion_curso_nuevo'].'</li>';
					}
					if($_POST['tipo_adr_curso_nuevo'] != '')
					{
						update_field('tipo_adr',$_POST['tipo_adr_curso_nuevo'],$post_id);
						$cuerpo_mail.='<li>Tipo curso ADR: '.$_POST['tipo_adr_curso_nuevo'].'</li>';
					}
					if($_POST['tipo_adr_texto_curso_nuevo'] != '')
					{
						update_field('tipo_adr_texto',$_POST['tipo_adr_texto_curso_nuevo'],$post_id);
						$cuerpo_mail.='<li>Indica tipo curso ADR: '.$_POST['tipo_adr_texto_curso_nuevo'].'</li>';
					}
					
					if(function_exists('cambio_slug'))
					{
						cambio_slug($post_id);
					}
					
					$cuerpo_mail.='<li><a href="'.get_bloginfo('url').'/wp-admin/post.php?post='.$post_id.'&action=edit">Enlace edición curso</a></li>';
					$cabeceras=array('Content-Type: text/html; charset=UTF-8');
					$asunto='Nuevo curso insertado desde microsite';
					
					/*chequeamos si el curso es sospechoso de duplicado*/
					$curso=get_posts(array(
						'post_type' => 'product',
						'tax_query' => array(
							array(
								'taxonomy' => 'product_cat',
								'field' => 'term_id',
								'terms' => $cat,
								'include_children' => false
							)
						),
						'meta_query' => array(
							'relation' => 'AND',
							array(
								'key' => 'autoescuela',
								'value' => '"' . get_the_id() . '"',
								'compare'	=> 'LIKE'
							),
							array(
								'key' => 'fecha_inicio',
								'value' => $fecha_inicio_formateada,
								'type'		=> 'NUMERIC',
								'compare'	=> '='
							),
							array(
								'key' => 'fecha_de_finalizacion',
								'value' => $fecha_fin_formateada,
								'type'		=> 'NUMERIC',
								'compare'	=> '='
							),
							array(
								'key' => 'horario',
								'value' => $_POST['turno_curso_nuevo'],
								'type'		=> 'TEXT',
								'compare'	=> '='
							)
						),
						'exclude' => array($post_id)
					));
					if($curso)
					{
						$asunto='POSIBLE DUPLICADO: Nuevo curso insertado desde microsite';
					}
					/*fin chequeamos si el curso es sospechoso de duplicado*/
					if(!current_user_can('administrator'))
					{
						if($post_id != 0)
						{
							wp_mail('clientes@academiadeltransportista.com',$asunto,$cuerpo_mail,$cabeceras);
						}
					}
					else
					{
						if($post_id != 0)
						{
							wp_mail('rhurtado@roiting.com',$asunto,$cuerpo_mail,$cabeceras);
						}
					}
					
					if(function_exists('rocket_clean_domain'))
					{
						rocket_clean_domain();
					}
				} ?>
            </div><?php
			wp_redirect(get_permalink(get_the_id()).'?edit=true');
		}
		get_header('microsite');
		$color_microsite=get_field('color_microsite');
		if($color_microsite == '')
		{
			$color_microsite='#3DD05D';
		}
		
		$rgb = HTMLToRGB($color_microsite);
		$hsl = RGBToHSL($rgb);
		if($hsl->lightness > 200)
		{
			$tcolor='#333';
		}
		else
		{
			$tcolor='#fff';
		}
		while(have_posts())
		{
			the_post(); ?>
            <div class="edit_form_container">
                <form method="post" action="<?php echo get_permalink(get_the_id()).'?edit=true'; ?>" id="form_update_autoescuela_<?php echo get_the_id(); ?>" enctype="multipart/form-data">
                	<input type="hidden" name="edit_form" value="true" />
                    <!-- CONTENIDO DIV CURSOS -->
					<div id="divcursos" style="display:none;">
					<section class="cursos section_wrapper mcb-section-inner">
                                	<div class="titulo_edicion numbered">Añade las próximas convocatorias de tus cursos CAP Inicial, CAP Continua, ADR Obtención y ADR Renovación:</div>
                                    <div class="edit_block cursos nuevo_curso">
	                                    <div class="titulo_edicion nuevo">Insertar nuevo curso:</div>
                                    	<div class="curso" style="border-color:<?php if(get_field('color_microsite') != ''){ the_field('color_microsite'); }else{ ?>#FF6600<?php } ?>;">
                                        	<div class="gutter">
                                                <div class="the_input not_full_width">
                                                    <input type="checkbox" name="insertar_nuevo_curso" value="Sí"> Insertar este nuevo curso
                                                </div>
                                                <div class="the_input tipo not_full_width radios">
                                                    <p>Tipo de curso:</p>
                                                    <div class="the_subinput">
	                                                    <input type="radio" name="tipo_curso_nuevo" value="cap-inicial"> CAP Inicial
                                                    </div>
                                                    <div class="the_subinput">
	                                                    <input type="radio" name="tipo_curso_nuevo" value="cap-continua"> CAP Continua
                                                    </div><?php
													if(false)/*current_user_can('administrator'))*/
													{ ?>
														<div class="the_subinput">
                                                            <input type="radio" name="tipo_curso_nuevo" value="cap-ampliacion"> CAP Ampliación
                                                        </div><?php
													} ?>
                                                    <div class="the_subinput">
	                                                    <input type="radio" name="tipo_curso_nuevo" value="adr-obtencion"> ADR Obtención
                                                    </div>
                                                    <div class="the_subinput">
	                                                    <input type="radio" name="tipo_curso_nuevo" value="adr-renovacion"> ADR Renovación
                                                    </div>
                                                </div>
                                                <div class="clear"></div><?php
												if(true)/*current_user_can('administrator'))*/
												{ ?>
													<div class="selector_tipo_curso the_input tipo_cap_inicial" style="display:none;">
                                                        <span>Tipo de curso CAP Inicial:</span>
                                                        <select name="tipo_cap_inicial_curso_nuevo" form="form_update_autoescuela_<?php echo get_the_id(); ?>">
                                                            <option value="" selected="selected">Elige</option>
                                                            <option value="mercancias">Mercancías</option>
                                                            <option value="viajeros">Viajeros</option>
                                                            <option value="mercancias-viajeros">Mercancías / Viajeros</option>
                                                        </select>
                                                    </div>
													<?php /*<div class="selector_tipo_curso the_input tipo_cap_ampliacion" style="display:none;">
                                                        <span>Tipo de curso CAP Ampliación:</span>
                                                        <select name="tipo_cap_ampliacion_curso_nuevo" form="form_update_autoescuela_<?php echo get_the_id(); ?>">
                                                        	<option value="" selected="selected">Elige</option>
                                                            <option value="mercancias">Mercancías</option>
                                                            <option value="viajeros">Viajeros</option>
                                                        </select>
                                                    </div>*/ ?>
													<div class="selector_tipo_curso the_input tipo_adr" style="display:none;">
                                                        <span>Tipo de curso ADR:</span>
                                                        <select name="tipo_adr_curso_nuevo" form="form_update_autoescuela_<?php echo get_the_id(); ?>">
                                                        	<option value="" selected="selected">Elige</option>
                                                            <option value="basico">Básico</option>
                                                            <option value="cisternas">Cisternas</option>
                                                            <option value="basico-cisternas">Básico + Cisternas</option>
                                                            <option value="explosivos">Explosivos</option>
                                                            <option value="radiactivos">Radiactivos</option>
                                                            <option value="otros">Otros (Indicad cuál)</option>
                                                        </select>
                                                        <div class="the_input tipo_adr_texto" style="display:none;">
                                                            <span>Indica tipo de curso ADR:</span> <input type="text" name="tipo_adr_texto_curso_nuevo" />
                                                        </div>
                                                    </div><?php
												} ?>
                                                <?php /*<div class="the_input tipo_adr" style="display:none;">
                                                    <span>Tipo de curso ADR:</span> <input type="text" name="tipo_adr_curso_nuevo" />
                                                </div>*/ ?>
                                                <div class="the_input">
                                                    <span>Horario del curso:</span> <input type="text" name="horario_curso_nuevo" />
                                                </div>
                                                <div class="the_input half_size_left">
                                                    <span>Fecha de inicio:</span> <input type="text" class="elDatePicker" name="fecha_inicio_curso_nuevo" />
                                                </div>
                                                <div class="the_input half_size_right">
                                                    <span>Hora de inicio:</span> <input type="text" name="hora_inicio_curso_nuevo" />
                                                </div>
                                                <div class="the_input half_size_left">
                                                    <span>Fecha de fin:</span> <input type="text" class="elDatePicker" name="fecha_fin_curso_nuevo" />
                                                </div>
                                                <div class="the_input half_size_right">
                                                    <span>Turno:</span>
                                                    <select name="turno_curso_nuevo" form="form_update_autoescuela_<?php echo get_the_id(); ?>">
                                                        <option value="mananas" selected="selected">Mañanas</option>
                                                        <option value="tardes">Tardes</option>
                                                        <option value="findesemana">Fin de semana</option>
                                                    </select>
                                                </div>
                                                <div class="the_input half_size_left">
                                                    <span>Precio:</span> <input type="text" name="precio_curso_nuevo" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="edit_block cursos cursos_actuales">
										<div class="titulo_edicion anadidos">Cursos añadidos:</div><?php
                                        foreach($cursos_actuales as $curso)
                                        { 	
											$categoria=wp_get_post_terms($curso->ID,'tipo-curso'); ?>
                                        	<div class="curso" curso_id="<?php echo $curso->ID; ?>" style="border-color:<?php if(get_field('color_microsite') != ''){ the_field('color_microsite'); }else{ ?>#FF6600<?php } ?>;">
                                            	<div class="gutter">
                                                    <div class="the_input not_full_width radios">
                                                        <p>Tipo de curso:</p>
                                                        <div class="the_subinput">
                                                        	<input type="radio" name="tipo_curso_<?php echo $curso->ID; ?>" value="cap-inicial" <?php if($categoria[0]->slug == 'cap-inicial'){ ?>checked="checked"<?php } ?>> CAP Inicial
                                                        </div>
                                                        <div class="the_subinput">
	                                                        <input type="radio" name="tipo_curso_<?php echo $curso->ID; ?>" value="cap-continua" <?php if($categoria[0]->slug == 'cap-continua'){ ?>checked="checked"<?php } ?>> CAP Continua
                                                        </div>
                                                        <div class="the_subinput">
	                                                        <input type="radio" name="tipo_curso_<?php echo $curso->ID; ?>" value="adr-obtencion" <?php if($categoria[0]->slug == 'adr-obtencion'){ ?>checked="checked"<?php } ?>> ADR Obtención
                                                        </div>
                                                        <div class="the_subinput">
	                                                        <input type="radio" name="tipo_curso_<?php echo $curso->ID; ?>" value="adr-renovacion" <?php if($categoria[0]->slug == 'adr-renovacion'){ ?>checked="checked"<?php } ?>> ADR Renovación
                                                        </div>
                                                    </div>
                                                    <div class="clear"></div>
                                                    <div class="selector_tipo_curso the_input tipo_cap_inicial" <?php if($categoria[0]->slug != 'cap-inicial'){ ?> style="display:none;" <?php } ?>>
                                                        <span>Tipo de curso CAP Inicial:</span>
                                                        <select name="tipo_cap_inicial_curso_<?php echo $curso->ID; ?>" form="form_update_autoescuela_<?php echo get_the_id(); ?>">
                                                            <option value="" <?php if(get_field('tipo_cap_inicial',$curso->ID) == ''){ ?>selected="selected"<?php } ?>>Elige</option>
                                                            <option value="mercancias" <?php if(get_field('tipo_cap_inicial',$curso->ID) == 'mercancias'){ ?>selected="selected"<?php } ?>>Mercancías</option>
                                                            <option value="viajeros" <?php if(get_field('tipo_cap_inicial',$curso->ID) == 'viajeros'){ ?>selected="selected"<?php } ?>>Viajeros</option>
                                                            <option value="mercancias-viajeros" <?php if(get_field('tipo_cap_inicial',$curso->ID) == 'mercancias-viajeros'){ ?>selected="selected"<?php } ?>>Mercancías / Viajeros</option>
                                                        </select>
                                                    </div>
													<?php /*<div class="selector_tipo_curso the_input tipo_cap_ampliacion" style="display:none;">
                                                        <span>Tipo de curso CAP Ampliación:</span>
                                                        <select name="tipo_cap_ampliacion_curso_nuevo" form="form_update_autoescuela_<?php echo get_the_id(); ?>">
                                                        	<option value="" selected="selected">Elige</option>
                                                            <option value="mercancias">Mercancías</option>
                                                            <option value="viajeros">Viajeros</option>
                                                        </select>
                                                    </div>*/ ?>
                                                    <div class="selector_tipo_curso the_input tipo_adr" <?php if($categoria[0]->slug != 'adr-obtencion' && $categoria[0]->slug != 'adr-renovacion'){ ?> style="display:none;" <?php } ?>>
                                                        <span>Tipo de curso ADR:</span>
                                                        <select name="tipo_adr_curso_<?php echo $curso->ID; ?>" form="form_update_autoescuela_<?php echo get_the_id(); ?>">
                                                            <option value="" <?php if(get_field('tipo_adr',$curso->ID) == ''){ ?>selected="selected"<?php } ?>>Elige</option>
                                                            <option value="basico" <?php if(get_field('tipo_adr',$curso->ID) == 'basico'){ ?>selected="selected"<?php } ?>>Básico</option>
                                                            <option value="cisternas" <?php if(get_field('tipo_adr',$curso->ID) == 'cisternas'){ ?>selected="selected"<?php } ?>>Cisternas</option>
                                                            <option value="basico-cisternas" <?php if(get_field('tipo_adr',$curso->ID) == 'basico-cisternas'){ ?>selected="selected"<?php } ?>>Básico + Cisternas</option>
                                                            <option value="explosivos" <?php if(get_field('tipo_adr',$curso->ID) == 'explosivos'){ ?>selected="selected"<?php } ?>>Explosivos</option>
                                                            <option value="radiactivos" <?php if(get_field('tipo_adr',$curso->ID) == 'radiactivos'){ ?>selected="selected"<?php } ?>>Radiactivos</option>
                                                            <option value="otros" <?php if(get_field('tipo_adr',$curso->ID) == 'otros'){ ?>selected="selected"<?php } ?>>Otros (Indicad cuál)</option>
                                                        </select>
														<div class="the_input tipo_adr_texto" <?php if(get_field('tipo_adr_texto',$curso->ID) == ''){ ?> style="display:none;" <?php } ?>>
                                                            <span>Indica tipo de curso ADR:</span> <input type="text" name="tipo_adr_texto_curso_<?php echo $curso->ID; ?>" value="<?php the_field('tipo_adr_texto',$curso->ID); ?>" />
                                                        </div>
                                                    </div>
                                                    <div class="clear"></div>
                                                    <?php /*<div class="the_input tipo_adr">
                                                        <span>Tipo de curso CAP/ADR:</span> <input type="text" name="tipo_adr_curso_<?php echo $curso->ID; ?>" value="<?php the_field('tipo_de_curso',$curso->ID); ?>" />
                                                    </div>*/ ?>
                                                    <div class="the_input">
                                                        <span>Horario del curso:</span> <input type="text" name="horario_curso_<?php echo $curso->ID; ?>" value="<?php the_field('horario_texto',$curso->ID); ?>" />
                                                    </div>
                                                    <div class="the_input half_size_left">
                                                        <span>Fecha de inicio:</span> <input type="text" class="elDatePicker" name="fecha_inicio_curso_<?php echo $curso->ID; ?>" value="<?php echo get_field('fecha_inicio',$curso->ID); ?>" />
                                                    </div>
                                                    <div class="the_input half_size_right">
                                                        <span>Hora de inicio:</span> <input type="text" name="hora_inicio_curso_<?php echo $curso->ID; ?>" value="<?php the_field('hora_inicio',$curso->ID); ?>" />
                                                    </div>
                                                    <div class="the_input half_size_left">
                                                        <span>Fecha de fin:</span> <input type="text" class="elDatePicker" name="fecha_fin_curso_<?php echo $curso->ID; ?>" value="<?php echo get_field('fecha_de_finalizacion',$curso->ID); ?>" />
                                                    </div>
                                                    <div class="the_input half_size_right">
                                                        <span>Turno:</span>
                                                        <select name="turno_curso_<?php echo $curso->ID; ?>" form="form_update_autoescuela_<?php echo get_the_id(); ?>">
                                                            <option value="" <?php if(get_field('horario',$curso->ID)==''){ ?>selected="selected"<?php } ?>>- Elige -</option>
                                                            <option value="mananas" <?php if(get_field('horario',$curso->ID)=='mananas'){ ?>selected="selected"<?php } ?>>Mañanas</option>
                                                            <option value="tardes" <?php if(get_field('horario',$curso->ID)=='tardes'){ ?>selected="selected"<?php } ?>>Tardes</option>
                                                            <option value="findesemana" <?php if(get_field('horario',$curso->ID)=='findesemana'){ ?>selected="selected"<?php } ?>>Fin de semana</option>
                                                        </select>
                                                    </div>
                                                    <div class="the_input half_size_left">
                                                        <span>Precio:</span> <input type="text" name="precio_curso_<?php echo $curso->ID; ?>" value="<?php echo get_post_meta($curso->ID,'_regular_price',true); ?>" />
                                                    </div>
                                                    <div class="the_input clear_only">
														<input type="checkbox" name="eliminar_curso_<?php echo $curso->ID; ?>" value="si"> Eliminar este curso (marcar casilla y pulsar botón "Guardar cambios")
													</div>
                                                </div>
											</div><?php                                            
                                        } ?>
                                    </div>
                                </section>
									</div>
					
					
					<!-- #Content -->
										
                    <div id="Content" class="new_2020" microsite-color="<?php echo str_replace('#','',$color_microsite); ?>" color-texto="<?php echo str_replace('#','',$tcolor); ?>">
                        <div class="content_wrapper clearfix"><?php
                            $logo=get_the_post_thumbnail_url();
                            $imagen_cabecera=get_field('imagen_cabecera'); ?>
                            <div class="header_microsite new" style="background-color:<?php echo $color_microsite; ?>;">
                            	<div class="overlay" style="background-color:<?php echo $color_microsite; ?>;"></div>
                                <div class="cabecera_contenido">
                                    <div class="logo_principal" style="color:<?php echo $tcolor; ?>;"><?php 
                                        if($logo != '')
                                        { ?>
                                            <img alt="<?php echo get_the_title(); ?>" src="<?php echo $logo; ?>" /><?php
                                        }
                                        else
                                        { ?>
                                            <img alt="<?php echo get_the_title(); ?>" src="<?php echo get_bloginfo('stylesheet_directory'); ?>/img/microsites/logo_generico.png" /><?php						
                                        } ?>
                                        <div class="clear"></div>
                                        <div class="edit_block logo numbered">
                                            <div class="titulo">Cambiar logo</div>
                                            <input type="file" name="logo_image" id="logo_image"><br /><?php
                                            if(has_post_thumbnail())
                                            { ?>
                                                <div class="remove_current">
                                                    <input type="checkbox" name="delete_current_logo" value="yes"> <label for="delete_current_logo">Eliminar logo actual (se colocará en su lugar un logo genérico)</label>
                                                </div><?php
                                            } ?>
                                        </div>
                                    </div>
                                    <div class="texto_cabecera">
                                        <h1 class="titulo" style="color:<?php echo $tcolor; ?>;"><?php echo get_the_title(); ?></h1>
										<div class="edit_block titulo numbered">
                                            <div class="titulo" style="color:<?php echo $tcolor; ?>;">Cambiar título</div>
                                            <input type="text" name="new_title" id="new_title" value="<?php echo get_the_title(); ?>">
                                        </div>
                                    </div>
                                    <div class="color_microsite">
	                                    <div class="edit_block color numbered">
    	                                    <div class="titulo" style="color:<?php echo $tcolor; ?>;">Elige color principal para tu sitio</div>
        	                                <input class="jscolor" name="color_microsite" value="<?php if(get_field('color_microsite') != ''){ echo str_replace('#','',get_field('color_microsite')); }else{ ?>FF6600<?php } ?>">
            	                        </div>
                                    </div>
                                    <div class="edit_block contacto_cabecera numbered">
                                        <p class="titulo" style="color:<?php echo $tcolor; ?>;">Datos de contacto</p>
										<div class="elemento tlf_fijo"><p class="titulo" style="color:<?php echo $tcolor; ?>;">Teléfono fijo:</p> <input type="text" name="new_tlf_fijo" id="new_tlf_fijo" value="<?php the_field('telefono_fijo'); ?>" placeholder="Teléfono fijo del centro"></div>
										<div class="elemento mail"><p class="titulo" style="color:<?php echo $tcolor; ?>;">Email:</p> <input type="text" name="new_e-mail" id="new_e-mail" value="<?php the_field('e-mail'); ?>" placeholder="e-mail del centro"></div>
                                        <div class="elemento new_Whatsapptelf">
                                            <p class="titulo" style="color:<?php echo $tcolor; ?>;">Teléfono para notificaciones de Whatsapp</p>
                                            <?php
                                                if ( get_field('Whatsapptelf') ) {
                                                    $inputValue = get_field('Whatsapptelf');
                                                } else {
                                                    $inputValue = get_field('telefono_movil');
                                                }
                                            ?>
                                            <input type="text" name="new_Whatsapptelf" id="new_Whatsapptelf" value="<?php echo $inputValue ?>" placeholder=""  maxlength="9">
                                            <p style="font-size:10px;">Por favor, escriba un único número de teléfono"</p>


                                            <div class="elemento tlf_movil"><p class="titulo" style="color:<?php echo $tcolor; ?>;">Teléfono movil:</p> 	<input type="text" name="new_tlf_movil" id="new_tlf_movil" value="<?php the_field('telefono_movil'); ?>" placeholder="Teléfono móvil del centro" maxlength="9"></div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- .sections_group -->
                            <div class="microsite_sections">
                            	<div class="section_wrapper"><p class="titulo_edicion numbered">Selecciona qué tipos de cursos ofrece la autoescuela:</p></div>
                                <section class="cursos_genericos section_wrapper mcb-section-inner">
                                	<div class="cabecera_mobile" style="display:none;">Cursos que ofrecemos</div>
                                    <div class="cursos_genericos_1 column mcb-column one-third column_column">
                                        <div class="gutter"><?php
											$values_autoescuela=array();
											if(get_field('cursos_ofrecidos_tipo_autoescuela'))
											{
												$values_autoescuela = get_field('cursos_ofrecidos_tipo_autoescuela');
											}
											$values_transporte=array();
											if(get_field('cursos_ofrecidos_tipo_transporte'))
											{
												$values_transporte = get_field('cursos_ofrecidos_tipo_transporte');
											}
											$values_mas=array();
											if(get_field('cursos_ofrecidos_tipo_mas_cursos'))
											{
												$values_mas = get_field('cursos_ofrecidos_tipo_mas_cursos');
											}
											$values=array_merge($values_autoescuela,$values_transporte,$values_mas);
											$field_autoescuela = get_field_object('cursos_ofrecidos_tipo_autoescuela');
											$choices_autoescuela = $field_autoescuela['choices'];
											$field_transporte = get_field_object('cursos_ofrecidos_tipo_transporte');
											$choices_transporte = $field_transporte['choices'];
											$field_mas = get_field_object('cursos_ofrecidos_tipo_mas_cursos');
											$choices_mas = $field_mas['choices'];
											$field=array_merge($field_autoescuela,$field_transporte,$field_mas);
											$choices=array_merge($choices_autoescuela,$choices_transporte,$choices_mas); ?>
                                            <ul class="cursos">
												<li style="border-color:<?php if(get_field('color_microsite') != ''){ the_field('color_microsite'); }else{ ?>#FF6600<?php } ?>;width:100%;"><?php 
													_e('Cursos predefinidos (marca la casilla de los que quieras que aparezcan en la versión pública de la página):','academiadeltransportista'); ?>
												</li><?php
												foreach($choices as $choice_value => $choice_label)
												{ ?>
                                                	<li style="border-color:<?php if(get_field('color_microsite') != ''){ the_field('color_microsite'); }else{ ?>#FF6600<?php } ?>;"><?php
														$found=false;
														foreach ($values as $value)
														{
															if ($value['value'] == $choice_value)
															{ ?>
																<input type="checkbox" checked="checked" name="<?php echo $choice_value; ?>" value="yes" <?php if($microsite_level=='pro'){ ?> style="display:none;" <?php } ?>><?php
																$found=true;
															}
														} // end foreach $values
														if(!$found)
														{ ?>
															<input type="checkbox" name="<?php echo $choice_value; ?>" value="yes"><?php
														} ?>
                                                        <label for="<?php echo $choice_value; ?>"><?php echo $choice_label; ?></label>
                                                    </li><?php
												} // end foreach $choices 
												$cursos_anadidos_autoescuela=get_field('cursos_ofrecidos_tipo_autoescuela_adicionales');
												$cursos_anadidos_transporte=get_field('cursos_ofrecidos_tipo_transporte_adicionales');
                                                $cursos_anadidos_mas=get_field('cursos_ofrecidos_tipo_mas_cursos_adicionales');
												if(!empty($cursos_anadidos_autoescuela) || !empty($cursos_anadidos_transporte) || !empty($cursos_anadidos_mas))
												{ ?>
                                                	<li style="border-color:<?php if(get_field('color_microsite') != ''){ the_field('color_microsite'); }else{ ?>#FF6600<?php } ?>;width:100%;"><?php 
														_e('Cursos adicionales añadidos (para eliminar uno, bórralo y guarda la página):','academiadeltransportista'); ?>
													</li><?php
													if(!empty($cursos_anadidos_autoescuela))
													{
														$i=0;
														foreach($cursos_anadidos_autoescuela as $curso_anadido)
														{ ?>
															<li style="border-color:<?php if(get_field('color_microsite') != ''){ the_field('color_microsite'); }else{ ?>#FF6600<?php } ?>;">
																<input type="text" class="add_curso_autoescuela" name="add_curso_autoescuela_<?php echo $i; ?>" value="<?php echo $curso_anadido['nombre'] ?>" />
															</li><?php
															$i++;
														}
													}
													if(!empty($cursos_anadidos_transporte))
													{
														$i=0;
														foreach($cursos_anadidos_transporte as $curso_anadido)
														{ ?>
															<li style="border-color:<?php if(get_field('color_microsite') != ''){ the_field('color_microsite'); }else{ ?>#FF6600<?php } ?>;">
																<input type="text" class="add_curso_transporte" name="add_curso_transporte_<?php echo $i; ?>" value="<?php echo $curso_anadido['nombre'] ?>" />
															</li><?php
															$i++;
														}
													}
													if(!empty($cursos_anadidos_mas))
													{
														$i=0;
														foreach($cursos_anadidos_mas as $curso_anadido)
														{ ?>
															<li style="border-color:<?php if(get_field('color_microsite') != ''){ the_field('color_microsite'); }else{ ?>#FF6600<?php } ?>;">
																<input type="text" class="add_curso_mas" name="add_curso_mas_<?php echo $i; ?>" value="<?php echo $curso_anadido['nombre'] ?>" />
															</li><?php
															$i++;
														}
													}
												} ?>
                                                <li style="border-color:<?php if(get_field('color_microsite') != ''){ the_field('color_microsite'); }else{ ?>#FF6600<?php } ?>;width:100%;"><?php 
													_e('Añade un nuevo curso escribiendo su nombre aquí y guardando la página:','academiadeltransportista'); ?>
                                                </li>
                                                <li style="border-color:<?php if(get_field('color_microsite') != ''){ the_field('color_microsite'); }else{ ?>#FF6600<?php } ?>;width:100%;">
                                                	<input type="text" class="add_curso_mas" name="add_curso_mas" placeholder="Añadir otro curso" />
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </section>
                                <section class="conoce_autoescuela section_wrapper mcb-section-inner">
                                    <div class="titulo_2"><?php _e('Conoce la autoescuela','academiadeltransportista'); ?></div>
                                    <div class="logo column mcb-column two-fifth column_column"><?php
                                        if($logo != '')
                                        { ?>
                                            <img alt="<?php echo get_the_title(); ?>" src="<?php echo $logo; ?>" /><?php
                                        }
                                        else
                                        { ?>
                                            <img alt="<?php echo get_the_title(); ?>" src="<?php echo get_bloginfo('stylesheet_directory'); ?>/img/microsites/logo_generico.png" /><?php						
                                        } ?>
                                    </div>
                                    <div class="textos column mcb-column three-fifth column_column">
                                    	<?php
                                        if(get_field('texto_cabecera') != '')
                                        { ?>
                                            <div class="descripcion"><?php the_field('texto_cabecera'); ?></div><?php
                                        } ?>
                                        <div class="edit_block descripcion numbered">
                                            <div class="titulo">Cambiar introducción</div>
                                            <textarea type="text" name="new_description" id="new_description"><?php the_field('texto_cabecera'); ?></textarea>
                                        </div>
                                        <div class="titulo_descripcion"><?php 
                                            if(get_field('titulo_texto_informacion') != '')
                                            {
                                                the_field('titulo_texto_informacion');
                                            }
                                            else
                                            {
                                                _e('No hay texto descriptivo actualmente','academiadeltransportista');
                                            } ?>
                                            <div class="edit_block texto_descriptivo numbered">
	                                            <div class="titulo">Cambiar texto</div>
	                                            <textarea name="new_texto_descriptivo" id="new_texto_descriptivo"><?php the_field('titulo_texto_informacion'); ?></textarea>
                                            </div>
                                        </div>
                                        <div class="texto_descripcion"><?php 
                                            if(get_field('texto_informacion') != '')
                                            {
                                                the_field('texto_informacion');
                                            }
                                            else
                                            {
                                                _e('No hay texto explicativo','academiadeltransportista');
                                            } ?>
                                            <div class="edit_block texto_informacion numbered">
                                            	<div class="titulo">Cambiar texto</div>
	                                            <textarea name="new_texto_informacion" id="new_texto_informacion"><?php the_field('texto_informacion'); ?></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </section>
                                <section class="detalles_autoescuela section_wrapper mcb-section-inner numbered">
                                    <div class="section_gutter">
                                        <div class="horarios_ubicacion column mcb-column one-second column_column">
                                            <div class="titulo">Ubicación</div>
                                            <div class="elemento ubicacion">
                                                <div class="icono"><img src="<?php echo get_bloginfo('stylesheet_directory'); ?>/img/microsites/ubicacion.png" /></div><?php 
                                                $direccion=get_field('mapa'); echo $direccion['address']; ?><br /><?php
                                                echo get_field('municipio_texto').', '.get_field('provincia_texto'); ?>
                                            </div>
                                            <div class="separador" style="background-color:<?php echo $color_microsite; ?>;"></div>
                                        </div>
										<div class="horarios_ubicacion column mcb-column one-second column_column">
                                            <div class="titulo">Horario</div>
                                            <div class="elemento horario">
                                                <div class="icono"><img src="<?php echo get_bloginfo('stylesheet_directory'); ?>/img/microsites/horario.png" /></div>
												<input type="text" name="new_horario" id="new_horario" value="<?php the_field('horario'); ?>" placeholder="Horario del centro">
                                            </div>
                                            <div class="separador" style="background-color:<?php echo $color_microsite; ?>;"></div>
                                        </div>

                                    </div>
                                </section>
                                <section class="imagenes_autoescuela section_wrapper mcb-section-inner">
									<div class="titulo_edicion numbered">Inserta imágenes de tu autoescuela</div><?php 
                                    if(have_rows('imagenes'))
                                    { ?>
                                        <div class="owl-carousel"><?php
                                            while(have_rows('imagenes'))
                                            {
                                                the_row();
                                                $imagen=get_sub_field('imagen'); ?>
                                                <div><?php /*<a href="<?php echo $imagen['url']; ?>">*/ ?><img src="<?php echo aq_resize($imagen['url'],580,390,true,true,true); ?>" /><?php /*</a>*/ ?></div><?php
                                            } ?>
                                        </div><?php
                                    }
                                    else
                                    { ?>
                                        <div class="owl-carousel default">
                                            <div><a href="#"><img src="<?php echo get_bloginfo('stylesheet_directory'); ?>/img/microsites/default_image.png" /></a></div>
                                            <div><a href="#"><img src="<?php echo get_bloginfo('stylesheet_directory'); ?>/img/microsites/default_image.png" /></a></div>
                                        </div><?php
                                    } ?>
                                    <div class="edit_block imagenes_carrusel"><?php
										$imagenes=get_field('imagenes');
										if($imagenes)
										{
											$num_imagenes=count($imagenes);
										}
										else
										{
											$num_imagenes=0;
										}
										/*print_r($imagenes);*/ ?>
                                        <div class="titulo">Añadir imágenes</div><?php
										if($num_imagenes < 6)
										{ ?>
	                                        <div class="instrucciones">El máximo de imágenes permitido es de 6<?php if($num_imagenes !=6){ ?>, por lo que solo puedes añadir <?php echo (6-$num_imagenes); ?> imágenes más. Para añadir más, tendrás que eliminar antes otras imágenes<?php } ?>.</div>
											<ol><?php
	    	                                    for($i=1;$i<=(6-$num_imagenes);$i++)
												{ ?>
        	    	                            	<li><input type="file" name="anadir_imagen_<?php echo $i; ?>" id="anadir_imagen_<?php echo $i; ?>"></li><?php											
												} ?>
                        	                </ol><?php
										}
										else
										{ ?>
                                        	<div class="instrucciones">El máximo de imágenes permitido es de 6, por lo que no puedes añadir más. Para añadir más, tendrás que eliminar antes otras imágenes.</div><?php
										} ?>
                                        <div class="titulo">Eliminar imágenes</div>
										<div class="instrucciones">Selecciona las imágenes a eliminar y guarda la página</div><?php
										if($num_imagenes > 0)
										{ ?>
                                        	<ul><?php
												$j=1;
												foreach($imagenes as $imagen)
    	                                        {
        	                                        $la_imagen=$imagen['imagen']; ?>
													<input type="checkbox" name="borrar_imagen_<?php echo $j; ?>" value="<?php echo $la_imagen['ID']; ?>"> <img src="<?php echo $la_imagen['sizes']['thumbnail']; ?>" /><?php
													$j++;
												} ?>
                                            </ul><?php
										} ?>
                                    </div>
                                </section>
                                <section class="cta_banner section_wrapper mcb-section-inner">
                                    <div class="the_cta" style="background-color:<?php if(get_field('color_microsite') != ''){ the_field('color_microsite'); }else{ ?>#FF6600<?php } ?>;">
                                        <div class="textos column mcb-column three-fifth column_column">
                                            <div class="gutter">
                                                <div class="titulo_2" style="color:<?php echo $tcolor; ?>;">Confía en nuestros docentes y en nuestra experiencia</div>
                                                <a href="#" class="microsite_main_cta" style="background:<?php if(get_field('color_microsite') != ''){ the_field('color_microsite'); }else{ ?>#FF6600<?php } ?>;"><?php _e('Quiero matricularme','academiadeltransportista'); ?></a>
                                            </div>
                                        </div>
                                        <div class="imagen column mcb-column two-fifth column_column">
                                            <div class="gutter">
                                                <img src="<?php echo get_bloginfo('stylesheet_directory'); ?>/img/microsites/icono-cta.png" />
                                            </div>
                                        </div>
                                    </div>
                                </section>
                                <section class="cursos section_wrapper mcb-section-inner">
                                	<div class="titulo_edicion numbered">Añade las próximas convocatorias de tus cursos CAP Inicial, CAP Continua, ADR Obtención y ADR Renovación:</div>
                                    <div class="edit_block cursos nuevo_curso">
	                                    <div class="titulo_edicion nuevo">Insertar nuevo curso:</div>
                                    	<div class="curso" style="border-color:<?php if(get_field('color_microsite') != ''){ the_field('color_microsite'); }else{ ?>#FF6600<?php } ?>;">
                                        	<div class="gutter">
                                                <div class="the_input not_full_width">
                                                    <input type="checkbox" name="insertar_nuevo_curso" value="Sí"> Insertar este nuevo curso
                                                </div>
                                                <div class="the_input tipo not_full_width radios">
                                                    <p>Tipo de curso:</p>
                                                    <div class="the_subinput">
	                                                    <input type="radio" name="tipo_curso_nuevo" value="cap-inicial"> CAP Inicial
                                                    </div>
                                                    <div class="the_subinput">
	                                                    <input type="radio" name="tipo_curso_nuevo" value="cap-continua"> CAP Continua
                                                    </div><?php
													if(false)/*current_user_can('administrator'))*/
													{ ?>
														<div class="the_subinput">
                                                            <input type="radio" name="tipo_curso_nuevo" value="cap-ampliacion"> CAP Ampliación
                                                        </div><?php
													} ?>
                                                    <div class="the_subinput">
	                                                    <input type="radio" name="tipo_curso_nuevo" value="adr-obtencion"> ADR Obtención
                                                    </div>
                                                    <div class="the_subinput">
	                                                    <input type="radio" name="tipo_curso_nuevo" value="adr-renovacion"> ADR Renovación
                                                    </div>
                                                </div>
                                                <div class="clear"></div><?php
												if(true)/*current_user_can('administrator'))*/
												{ ?>
													<div class="selector_tipo_curso the_input tipo_cap_inicial" style="display:none;">
                                                        <span>Tipo de curso CAP Inicial:</span>
                                                        <select name="tipo_cap_inicial_curso_nuevo" form="form_update_autoescuela_<?php echo get_the_id(); ?>">
                                                            <option value="" selected="selected">Elige</option>
                                                            <option value="mercancias">Mercancías</option>
                                                            <option value="viajeros">Viajeros</option>
                                                            <option value="mercancias-viajeros">Mercancías / Viajeros</option>
                                                        </select>
                                                    </div>
													<?php /*<div class="selector_tipo_curso the_input tipo_cap_ampliacion" style="display:none;">
                                                        <span>Tipo de curso CAP Ampliación:</span>
                                                        <select name="tipo_cap_ampliacion_curso_nuevo" form="form_update_autoescuela_<?php echo get_the_id(); ?>">
                                                        	<option value="" selected="selected">Elige</option>
                                                            <option value="mercancias">Mercancías</option>
                                                            <option value="viajeros">Viajeros</option>
                                                        </select>
                                                    </div>*/ ?>
													<div class="selector_tipo_curso the_input tipo_adr" style="display:none;">
                                                        <span>Tipo de curso ADR:</span>
                                                        <select name="tipo_adr_curso_nuevo" form="form_update_autoescuela_<?php echo get_the_id(); ?>">
                                                        	<option value="" selected="selected">Elige</option>
                                                            <option value="basico">Básico</option>
                                                            <option value="cisternas">Cisternas</option>
                                                            <option value="basico-cisternas">Básico + Cisternas</option>
                                                            <option value="explosivos">Explosivos</option>
                                                            <option value="radiactivos">Radiactivos</option>
                                                            <option value="otros">Otros (Indicad cuál)</option>
                                                        </select>
                                                        <div class="the_input tipo_adr_texto" style="display:none;">
                                                            <span>Indica tipo de curso ADR:</span> <input type="text" name="tipo_adr_texto_curso_nuevo" />
                                                        </div>
                                                    </div><?php
												} ?>
                                                <?php /*<div class="the_input tipo_adr" style="display:none;">
                                                    <span>Tipo de curso ADR:</span> <input type="text" name="tipo_adr_curso_nuevo" />
                                                </div>*/ ?>
                                                <div class="the_input">
                                                    <span>Horario del curso:</span> <input type="text" name="horario_curso_nuevo" />
                                                </div>
                                                <div class="the_input half_size_left">
                                                    <span>Fecha de inicio:</span> <input type="text" class="elDatePicker" name="fecha_inicio_curso_nuevo" />
                                                </div>
                                                <div class="the_input half_size_right">
                                                    <span>Hora de inicio:</span> <input type="text" name="hora_inicio_curso_nuevo" />
                                                </div>
                                                <div class="the_input half_size_left">
                                                    <span>Fecha de fin:</span> <input type="text" class="elDatePicker" name="fecha_fin_curso_nuevo" />
                                                </div>
                                                <div class="the_input half_size_right">
                                                    <span>Turno:</span>
                                                    <select name="turno_curso_nuevo" form="form_update_autoescuela_<?php echo get_the_id(); ?>">
                                                        <option value="mananas" selected="selected">Mañanas</option>
                                                        <option value="tardes">Tardes</option>
                                                        <option value="findesemana">Fin de semana</option>
                                                    </select>
                                                </div>
                                                <div class="the_input half_size_left">
                                                    <span>Precio:</span> <input type="text" name="precio_curso_nuevo" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="edit_block cursos cursos_actuales">
										<div class="titulo_edicion anadidos">Cursos añadidos:</div><?php
                                        foreach($cursos_actuales as $curso)
                                        { 	
											$categoria=wp_get_post_terms($curso->ID,'tipo-curso'); ?>
                                        	<div class="curso" curso_id="<?php echo $curso->ID; ?>" style="border-color:<?php if(get_field('color_microsite') != ''){ the_field('color_microsite'); }else{ ?>#FF6600<?php } ?>;">
                                            	<div class="gutter">
                                                    <div class="the_input not_full_width radios">
                                                        <p>Tipo de curso:</p>
                                                        <div class="the_subinput">
                                                        	<input type="radio" name="tipo_curso_<?php echo $curso->ID; ?>" value="cap-inicial" <?php if($categoria[0]->slug == 'cap-inicial'){ ?>checked="checked"<?php } ?>> CAP Inicial
                                                        </div>
                                                        <div class="the_subinput">
	                                                        <input type="radio" name="tipo_curso_<?php echo $curso->ID; ?>" value="cap-continua" <?php if($categoria[0]->slug == 'cap-continua'){ ?>checked="checked"<?php } ?>> CAP Continua
                                                        </div>
                                                        <div class="the_subinput">
	                                                        <input type="radio" name="tipo_curso_<?php echo $curso->ID; ?>" value="adr-obtencion" <?php if($categoria[0]->slug == 'adr-obtencion'){ ?>checked="checked"<?php } ?>> ADR Obtención
                                                        </div>
                                                        <div class="the_subinput">
	                                                        <input type="radio" name="tipo_curso_<?php echo $curso->ID; ?>" value="adr-renovacion" <?php if($categoria[0]->slug == 'adr-renovacion'){ ?>checked="checked"<?php } ?>> ADR Renovación
                                                        </div>
                                                    </div>
                                                    <div class="clear"></div>
                                                    <div class="selector_tipo_curso the_input tipo_cap_inicial" <?php if($categoria[0]->slug != 'cap-inicial'){ ?> style="display:none;" <?php } ?>>
                                                        <span>Tipo de curso CAP Inicial:</span>
                                                        <select name="tipo_cap_inicial_curso_<?php echo $curso->ID; ?>" form="form_update_autoescuela_<?php echo get_the_id(); ?>">
                                                            <option value="" <?php if(get_field('tipo_cap_inicial',$curso->ID) == ''){ ?>selected="selected"<?php } ?>>Elige</option>
                                                            <option value="mercancias" <?php if(get_field('tipo_cap_inicial',$curso->ID) == 'mercancias'){ ?>selected="selected"<?php } ?>>Mercancías</option>
                                                            <option value="viajeros" <?php if(get_field('tipo_cap_inicial',$curso->ID) == 'viajeros'){ ?>selected="selected"<?php } ?>>Viajeros</option>
                                                            <option value="mercancias-viajeros" <?php if(get_field('tipo_cap_inicial',$curso->ID) == 'mercancias-viajeros'){ ?>selected="selected"<?php } ?>>Mercancías / Viajeros</option>
                                                        </select>
                                                    </div>
													<?php /*<div class="selector_tipo_curso the_input tipo_cap_ampliacion" style="display:none;">
                                                        <span>Tipo de curso CAP Ampliación:</span>
                                                        <select name="tipo_cap_ampliacion_curso_nuevo" form="form_update_autoescuela_<?php echo get_the_id(); ?>">
                                                        	<option value="" selected="selected">Elige</option>
                                                            <option value="mercancias">Mercancías</option>
                                                            <option value="viajeros">Viajeros</option>
                                                        </select>
                                                    </div>*/ ?>
                                                    <div class="selector_tipo_curso the_input tipo_adr" <?php if($categoria[0]->slug != 'adr-obtencion' && $categoria[0]->slug != 'adr-renovacion'){ ?> style="display:none;" <?php } ?>>
                                                        <span>Tipo de curso ADR:</span>
                                                        <select name="tipo_adr_curso_<?php echo $curso->ID; ?>" form="form_update_autoescuela_<?php echo get_the_id(); ?>">
                                                            <option value="" <?php if(get_field('tipo_adr',$curso->ID) == ''){ ?>selected="selected"<?php } ?>>Elige</option>
                                                            <option value="basico" <?php if(get_field('tipo_adr',$curso->ID) == 'basico'){ ?>selected="selected"<?php } ?>>Básico</option>
                                                            <option value="cisternas" <?php if(get_field('tipo_adr',$curso->ID) == 'cisternas'){ ?>selected="selected"<?php } ?>>Cisternas</option>
                                                            <option value="basico-cisternas" <?php if(get_field('tipo_adr',$curso->ID) == 'basico-cisternas'){ ?>selected="selected"<?php } ?>>Básico + Cisternas</option>
                                                            <option value="explosivos" <?php if(get_field('tipo_adr',$curso->ID) == 'explosivos'){ ?>selected="selected"<?php } ?>>Explosivos</option>
                                                            <option value="radiactivos" <?php if(get_field('tipo_adr',$curso->ID) == 'radiactivos'){ ?>selected="selected"<?php } ?>>Radiactivos</option>
                                                            <option value="otros" <?php if(get_field('tipo_adr',$curso->ID) == 'otros'){ ?>selected="selected"<?php } ?>>Otros (Indicad cuál)</option>
                                                        </select>
														<div class="the_input tipo_adr_texto" <?php if(get_field('tipo_adr_texto',$curso->ID) == ''){ ?> style="display:none;" <?php } ?>>
                                                            <span>Indica tipo de curso ADR:</span> <input type="text" name="tipo_adr_texto_curso_<?php echo $curso->ID; ?>" value="<?php the_field('tipo_adr_texto',$curso->ID); ?>" />
                                                        </div>
                                                    </div>
                                                    <div class="clear"></div>
                                                    <?php /*<div class="the_input tipo_adr">
                                                        <span>Tipo de curso CAP/ADR:</span> <input type="text" name="tipo_adr_curso_<?php echo $curso->ID; ?>" value="<?php the_field('tipo_de_curso',$curso->ID); ?>" />
                                                    </div>*/ ?>
                                                    <div class="the_input">
                                                        <span>Horario del curso:</span> <input type="text" name="horario_curso_<?php echo $curso->ID; ?>" value="<?php the_field('horario_texto',$curso->ID); ?>" />
                                                    </div>
                                                    <div class="the_input half_size_left">
                                                        <span>Fecha de inicio:</span> <input type="text" class="elDatePicker" name="fecha_inicio_curso_<?php echo $curso->ID; ?>" value="<?php echo get_field('fecha_inicio',$curso->ID); ?>" />
                                                    </div>
                                                    <div class="the_input half_size_right">
                                                        <span>Hora de inicio:</span> <input type="text" name="hora_inicio_curso_<?php echo $curso->ID; ?>" value="<?php the_field('hora_inicio',$curso->ID); ?>" />
                                                    </div>
                                                    <div class="the_input half_size_left">
                                                        <span>Fecha de fin:</span> <input type="text" class="elDatePicker" name="fecha_fin_curso_<?php echo $curso->ID; ?>" value="<?php echo get_field('fecha_de_finalizacion',$curso->ID); ?>" />
                                                    </div>
                                                    <div class="the_input half_size_right">
                                                        <span>Turno:</span>
                                                        <select name="turno_curso_<?php echo $curso->ID; ?>" form="form_update_autoescuela_<?php echo get_the_id(); ?>">
                                                            <option value="" <?php if(get_field('horario',$curso->ID)==''){ ?>selected="selected"<?php } ?>>- Elige -</option>
                                                            <option value="mananas" <?php if(get_field('horario',$curso->ID)=='mananas'){ ?>selected="selected"<?php } ?>>Mañanas</option>
                                                            <option value="tardes" <?php if(get_field('horario',$curso->ID)=='tardes'){ ?>selected="selected"<?php } ?>>Tardes</option>
                                                            <option value="findesemana" <?php if(get_field('horario',$curso->ID)=='findesemana'){ ?>selected="selected"<?php } ?>>Fin de semana</option>
                                                        </select>
                                                    </div>
                                                    <div class="the_input half_size_left">
                                                        <span>Precio:</span> <input type="text" name="precio_curso_<?php echo $curso->ID; ?>" value="<?php echo get_post_meta($curso->ID,'_regular_price',true); ?>" />
                                                    </div>
                                                    <div class="the_input clear_only">
														<input type="checkbox" name="eliminar_curso_<?php echo $curso->ID; ?>" value="si"> Eliminar este curso (marcar casilla y pulsar botón "Guardar cambios")
													</div>
                                                </div>
											</div><?php                                            
                                        } ?>
                                    </div>
                                </section>
                            </div>
                        </div>
                    </div>
                    <button class="guardar_cambios" type="submit" style="background-color:<?php if(get_field('color_microsite') != ''){ the_field('color_microsite'); }else{ ?>#FF6600<?php } ?>;"><div>Guardar cambios</div></button>
                </form>
			</div><?php 
		}
		get_footer('microsite');
	}
	else
	{
		wp_redirect(get_permalink(get_the_id()));
	}
}
else
{
	wp_redirect(get_permalink(get_the_id()));
>>>>>>> 778c166765337ab116d0bec5c5809e5ece91be4d
=======
<?php
if(is_user_logged_in())
{
	$microsite_level=get_user_microsite_level();
	if($microsite_level == 'pro' || $microsite_level == 'premium' || $microsite_level == 'exclusive' || get_current_user_id() == 1827 || current_user_can('administrator'))
	{
		$cursos_actuales = get_posts(array(
			'post_type' => 'product',
			'numberposts' => -1,
			'meta_query' => array(
				array(
					'key' => 'autoescuela', // name of custom field
					'value' => '"' . get_the_ID() . '"', // matches exactly "123", not just 123. This prevents a match for "1234"
					'compare' => 'LIKE'
				)
			)
		));
		if($_POST)
		{ ?>
        	<div class="registros_subida"><?php
			
				$la_meta=get_post_meta(get_the_id());
				$imagen_actual=$la_meta['imagen_cabecera'][0];
				
				/* Estamos recibiendo datos. Los guardamos */
				if($_FILES['background_image']['name'] != '')
				{
					$image_id=upload_image_from_form_to_wp_media($_FILES['background_image']);
					if($image_id > 0)
					{
						update_field('imagen_cabecera',$image_id,get_the_id());
						wp_delete_attachment($imagen_actual,true);
					}
				}
				if($_POST['delete_current_bg_image'] == 'yes')
				{
					wp_delete_attachment($imagen_actual,true);
				}
				if($_FILES['logo_image']['name'] != '')
				{
					$image_id=upload_image_from_form_to_wp_media($_FILES['logo_image']);
					if($image_id > 0)
					{
						set_post_thumbnail(get_the_id(),$image_id);
					}
				}
				if($_POST['delete_current_logo'] == 'yes')
				{
					delete_post_thumbnail(get_the_id());
				}
				if($_POST['new_title'] != '')
				{
					wp_update_post(array(
						'ID' => get_the_id(),
						'post_title' => $_POST['new_title']
					));
				}
				if($_POST['new_description'] != '')
				{
					update_field('texto_cabecera',$_POST['new_description'],get_the_id());
				}
				if($_POST['color_microsite'] != '')
				{
					update_field('color_microsite','#'.$_POST['color_microsite'],get_the_id());
				}
				if($_POST['new_horario'] != '')
				{
					update_field('horario',$_POST['new_horario'],get_the_id());
				}
				if($_POST['new_direccion'] != '')
				{
					$address=slugify($_POST['new_direccion']);
					$address=str_replace('-','+',$address);
					$curl = curl_init();
						curl_setopt($curl, CURLOPT_URL, 'https://maps.googleapis.com/maps/api/geocode/json?key=AIzaSyBP9OVPkIgTmQhuMr5kdT7JNHBEmv7cuLU&address='.$address);
						curl_setopt ($curl, CURLOPT_RETURNTRANSFER, 1);
						$json = curl_exec($curl);
					curl_close ($curl);
					$output= json_decode($json);
					
					$lat=$output->results[0]->geometry->location->lat;
					$long=$output->results[0]->geometry->location->lng;
					
					$address_components=$output->results[0]->address_components;
					foreach($address_components as $address_component)
					{
						if($address_component->types[0] == 'locality')
						{
							$municipio_texto=$address_component->long_name;
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
							$provincia_texto=$address_component->long_name;
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
					}
					/*if(get_current_user_id()==6){ print_r($municipio);die; }*/
					update_field('provincia',$provincia,get_the_id());
					update_field('provincia_texto',$provincia_texto,get_the_id());
					update_field('municipios_'.$provincia,$municipio,get_the_id());
					update_field('municipio_texto',$municipio_texto,get_the_id());
					update_field('mapa',array('address' => $_POST['new_direccion'],'lat' => $lat,'lng' => $long),get_the_id());
					wp_update_post(array('ID' => get_the_id()));
				}
				if($_POST['new_tlf_fijo'] != '')
				{
					update_field('telefono_fijo',$_POST['new_tlf_fijo'],get_the_id());
				}
				if($_POST['new_tlf_movil'] != '')
				{
					update_field('telefono_movil',$_POST['new_tlf_movil'],get_the_id());
				}
				if($_POST['new_e-mail'] != '')
				{
					update_field('e-mail',$_POST['new_e-mail'],get_the_id());
				}
                  if($_POST['new_Whatsapptelf'] != '')
                 {
                 update_field('Whatsapptelf',$_POST['new_Whatsapptelf'],get_the_id());
                }
				if($_POST['new_texto_descriptivo'] != '')
				{
					update_field('titulo_texto_informacion',$_POST['new_texto_descriptivo'],get_the_id());
				}
				if($_POST['new_texto_informacion'] != '')
				{
					update_field('texto_informacion',$_POST['new_texto_informacion'],get_the_id());
				}
				if($_POST['borrar_imagen_6'] != '')
				{
					delete_sub_field(array('imagenes', 6, 'imagen'));
					delete_row('imagenes',6,get_the_id());
					wp_delete_attachment($_POST['borrar_imagen_6'],true);
				}
				if($_POST['borrar_imagen_5'] != '')
				{
					delete_sub_field(array('imagenes', 5, 'imagen'));
					delete_row('imagenes',5,get_the_id());
					wp_delete_attachment($_POST['borrar_imagen_5'],true);
				}
				if($_POST['borrar_imagen_4'] != '')
				{
					delete_sub_field(array('imagenes', 4, 'imagen'));
					delete_row('imagenes',4,get_the_id());
					wp_delete_attachment($_POST['borrar_imagen_4'],true);
				}
				if($_POST['borrar_imagen_3'] != '')
				{
					delete_sub_field(array('imagenes', 3, 'imagen'));
					delete_row('imagenes',3,get_the_id());
					wp_delete_attachment($_POST['borrar_imagen_3'],true);
				}
				if($_POST['borrar_imagen_2'] != '')
				{
					delete_sub_field(array('imagenes', 2, 'imagen'));
					delete_row('imagenes',2,get_the_id());
					wp_delete_attachment($_POST['borrar_imagen_2'],true);
				}
				if($_POST['borrar_imagen_1'] != '')
				{
					delete_sub_field(array('imagenes', 1, 'imagen'));
					delete_row('imagenes',1,get_the_id());
					wp_delete_attachment($_POST['borrar_imagen_1'],true);
				}
				if($_FILES['anadir_imagen_1']['name'] != '')
				{
					$image_id=upload_image_from_form_to_wp_media($_FILES['anadir_imagen_1']);
					if($image_id > 0)
					{
						add_row('imagenes',array('imagen' => $image_id),get_the_id());
					}
				}
				if($_FILES['anadir_imagen_2']['name'] != '')
				{
					$image_id=upload_image_from_form_to_wp_media($_FILES['anadir_imagen_2']);
					if($image_id > 0)
					{
						add_row('imagenes',array('imagen' => $image_id),get_the_id());
					}
				}
				if($_FILES['anadir_imagen_3']['name'] != '')
				{
					$image_id=upload_image_from_form_to_wp_media($_FILES['anadir_imagen_3']);
					if($image_id > 0)
					{
						add_row('imagenes',array('imagen' => $image_id),get_the_id());
					}
				}
				if($_FILES['anadir_imagen_4']['name'] != '')
				{
					$image_id=upload_image_from_form_to_wp_media($_FILES['anadir_imagen_4']);
					if($image_id > 0)
					{
						add_row('imagenes',array('imagen' => $image_id),get_the_id());
					}
				}
				if($_FILES['anadir_imagen_5']['name'] != '')
				{
					$image_id=upload_image_from_form_to_wp_media($_FILES['anadir_imagen_5']);
					if($image_id > 0)
					{
						add_row('imagenes',array('imagen' => $image_id),get_the_id());
					}
				}
				if($_FILES['anadir_imagen_6']['name'] != '')
				{
					$image_id=upload_image_from_form_to_wp_media($_FILES['anadir_imagen_6']);
					if($image_id > 0)
					{
						add_row('imagenes',array('imagen' => $image_id),get_the_id());
					}
				}
				$cursos_seleccionados_autoescuela=array();
				if($_POST['curso-obtencion-camion-c'] == 'yes')
				{
					$cursos_seleccionados_autoescuela[]='curso-obtencion-camion-c';
				}
				if($_POST['curso-obtencion-carnet-trailer-c-e'] == 'yes')
				{
					$cursos_seleccionados_autoescuela[]='curso-obtencion-carnet-trailer-c-e';
				}
				if($_POST['curso-obtencion-carnet-autobus-d'] == 'yes')
				{
					$cursos_seleccionados_autoescuela[]='curso-obtencion-carnet-autobus-d';
				}
				if($_POST['curso-obtencion-carnet-remolque-b-e'] == 'yes')
				{
					$cursos_seleccionados_autoescuela[]='curso-obtencion-carnet-remolque-b-e';
				}
				if($_POST['curso-obtencion-carnet-coche-b'] == 'yes')
				{
					$cursos_seleccionados_autoescuela[]='curso-obtencion-carnet-coche-b';
				}
				if($_POST['curso-obtencion-carnet-moto-a'] == 'yes')
				{
					$cursos_seleccionados_autoescuela[]='curso-obtencion-carnet-moto-a';
				}
				update_field('cursos_ofrecidos_tipo_autoescuela',$cursos_seleccionados_autoescuela,get_the_id());
				
				$cursos_seleccionados_transporte=array();
				if($_POST['curso-renovacion-del-cap'] == 'yes')
				{
					$cursos_seleccionados_transporte[]='curso-renovacion-del-cap';
				}
				if($_POST['curso-obtencion-cap-inicial'] == 'yes')
				{
					$cursos_seleccionados_transporte[]='curso-obtencion-cap-inicial';
				}
				if($_POST['curso-obtencion-mercancias-peligrosas'] == 'yes')
				{
					$cursos_seleccionados_transporte[]='curso-obtencion-mercancias-peligrosas';
				}
				if($_POST['curso-renovacion-adr'] == 'yes')
				{
					$cursos_seleccionados_transporte[]='curso-renovacion-adr';
				}
				if($_POST['curso-obtencion-titulo-de-transportista'] == 'yes')
				{
					$cursos_seleccionados_transporte[]='curso-obtencion-titulo-de-transportista';
				}
				if($_POST['curso-consejero-de-seguridad-adr'] == 'yes')
				{
					$cursos_seleccionados_transporte[]='curso-consejero-de-seguridad-adr';
				}
				update_field('cursos_ofrecidos_tipo_transporte',$cursos_seleccionados_transporte,get_the_id());
				
				$cursos_seleccionados_mas=array();
				if($_POST['curso-de-carretillas-elevadoras'] == 'yes')
				{
					$cursos_seleccionados_mas[]='curso-de-carretillas-elevadoras';
				}
				if($_POST['curso-grua-camion-pluma'] == 'yes')
				{
					$cursos_seleccionados_mas[]='curso-grua-camion-pluma';
				}
				if($_POST['une-12195-sujecion-de-cargas-y-estiba'] == 'yes')
				{
					$cursos_seleccionados_mas[]='une-12195-sujecion-de-cargas-y-estiba';
				}
				if($_POST['curso-tacografo-digital'] == 'yes')
				{
					$cursos_seleccionados_mas[]='curso-tacografo-digital';
				}
				if($_POST['cursos-de-logistica'] == 'yes')
				{
					$cursos_seleccionados_mas[]='cursos-de-logistica';
				}
				if($_POST['curso-de-seguridad-vial-laboral'] == 'yes')
				{
					$cursos_seleccionados_mas[]='curso-de-seguridad-vial-laboral';
				}
				update_field('cursos_ofrecidos_tipo_mas_cursos',$cursos_seleccionados_mas,get_the_id()); 
				
				$value_cursos_autoescuela=array();
				for($cont_cursos_autoescuela=0;$cont_cursos_autoescuela<1000;$cont_cursos_autoescuela++)
				{
					if(isset($_POST['add_curso_autoescuela_'.$cont_cursos_autoescuela]))
					{
						if($_POST['add_curso_autoescuela_'.$cont_cursos_autoescuela] != '')
						{
							$value_cursos_autoescuela[]=array(
								'nombre' => $_POST['add_curso_autoescuela_'.$cont_cursos_autoescuela]
							);
						}
					}
					else
					{
						break;
					}
				}
				if($_POST['add_curso_autoescuela'] != '')
				{
					$value_cursos_autoescuela[]=array(
						'nombre' => $_POST['add_curso_autoescuela']
					);
				}
				update_field('cursos_ofrecidos_tipo_autoescuela_adicionales',$value_cursos_autoescuela,get_the_id());
				
				$value_cursos_transporte=array();
				for($cont_cursos_transporte=0;$cont_cursos_transporte<1000;$cont_cursos_transporte++)
				{
					if(isset($_POST['add_curso_transporte_'.$cont_cursos_transporte]))
					{
						if($_POST['add_curso_transporte_'.$cont_cursos_transporte] != '')
						{
							$value_cursos_transporte[]=array(
								'nombre' => $_POST['add_curso_transporte_'.$cont_cursos_transporte]
							);
						}
					}
					else
					{
						break;
					}
				}
				if($_POST['add_curso_transporte'] != '')
				{
					$value_cursos_transporte[]=array(
						'nombre' => $_POST['add_curso_transporte']
					);
				}
				update_field('cursos_ofrecidos_tipo_transporte_adicionales',$value_cursos_transporte,get_the_id());
				
				$value_cursos_mas=array();
				for($cont_cursos_mas=0;$cont_cursos_mas<1000;$cont_cursos_mas++)
				{
					if(isset($_POST['add_curso_mas_'.$cont_cursos_mas]))
					{
						if($_POST['add_curso_mas_'.$cont_cursos_mas] != '')
						{
							$value_cursos_mas[]=array(
								'nombre' => $_POST['add_curso_mas_'.$cont_cursos_mas]
							);
						}
					}
					else
					{
						break;
					}
				}
				if($_POST['add_curso_mas'] != '')
				{
					$value_cursos_mas[]=array(
						'nombre' => $_POST['add_curso_mas']
					);
				}
				update_field('cursos_ofrecidos_tipo_mas_cursos_adicionales',$value_cursos_mas,get_the_id());
                
                /* cursos booking */
				foreach($cursos_actuales as $curso)
				{
					if($_POST['eliminar_curso_'.$curso->ID] == 'si')
					{
						wp_trash_post($curso->ID);
					}
					else
					{
						if($_POST['tipo_curso_'.$curso->ID] != '')
						{
							if($_POST['tipo_curso_'.$curso->ID] == 'cap-inicial')
							{
								$cat=53;
								$cat_tc=28;
							}
							elseif($_POST['tipo_curso_'.$curso->ID] == 'cap-continua')
							{
								$cat=27;
								$cat_tc=29;
							}
							elseif($_POST['tipo_curso_'.$curso->ID] == 'adr-obtencion')
							{
								$cat=55;
								$cat_tc=30;
							}
							elseif($_POST['tipo_curso_'.$curso->ID] == 'adr-renovacion')
							{
								$cat=54;
								$cat_tc=31;
							}
							wp_set_post_terms($curso->ID,array($cat),'product_cat');
							wp_set_post_terms($curso->ID,array($cat_tc),'tipo-curso');
						}
						
						if($_POST['tipo_cap_inicial_curso_'.$curso->ID] != '')
						{
							update_field('tipo_cap_inicial',$_POST['tipo_cap_inicial_curso_'.$curso->ID],$curso->ID);
						}
						if($_POST['tipo_cap_ampliacion_curso_'.$curso->ID] != '')
						{
							update_field('tipo_cap_ampliacion',$_POST['tipo_cap_ampliacion_curso_'.$curso->ID],$curso->ID);
						}
						if($_POST['tipo_adr_curso_'.$curso->ID] != '')
						{
							update_field('tipo_adr',$_POST['tipo_adr_curso_'.$curso->ID],$curso->ID);
						}
						if($_POST['tipo_adr_texto_curso_'.$curso->ID] != '')
						{
							update_field('tipo_adr_texto',$_POST['tipo_adr_texto_curso_'.$curso->ID],$curso->ID);
						}
						/**/
						/*if($_POST['tipo_adr_curso_'.$curso->ID] != '')
						{
							if($_POST['tipo_adr_curso_'.$curso->ID] != get_field('tipo_de_curso',$curso->ID))
							{
								update_field('tipo_de_curso',$_POST['tipo_adr_curso_'.$curso->ID],$curso->ID);
							}
						}*/
						if($_POST['horario_curso_'.$curso->ID] != '')
						{
							if($_POST['horario_curso_'.$curso->ID] != get_field('horario_texto',$curso->ID))
							{
								update_field('horario_texto',$_POST['horario_curso_'.$curso->ID],$curso->ID);
							}
						}
						if($_POST['fecha_inicio_curso_'.$curso->ID] != '')
						{
							$anyo=substr($_POST['fecha_inicio_curso_'.$curso->ID],6,4);
							$mes=substr($_POST['fecha_inicio_curso_'.$curso->ID],3,2);
							$dia=substr($_POST['fecha_inicio_curso_'.$curso->ID],0,2);
							$fecha_formateada=$anyo.$mes.$dia;
							if($fecha_formateada != get_field('fecha_inicio',$curso->ID))
							{
								update_field('fecha_inicio',$fecha_formateada,$curso->ID);
							}
						}
						if($_POST['fecha_fin_curso_'.$curso->ID] != '')
						{
							$anyo=substr($_POST['fecha_fin_curso_'.$curso->ID],6,4);
							$mes=substr($_POST['fecha_fin_curso_'.$curso->ID],3,2);
							$dia=substr($_POST['fecha_fin_curso_'.$curso->ID],0,2);
							$fecha_formateada=$anyo.$mes.$dia;
							if($fecha_formateada != get_field('fecha_de_finalizacion',$curso->ID))
							{
								update_field('fecha_de_finalizacion',$fecha_formateada,$curso->ID);
							}
						}
						if($_POST['hora_inicio_curso_'.$curso->ID] != get_field('hora_inicio',$curso->ID))
						{
							update_field('hora_inicio',$_POST['hora_inicio_curso_'.$curso->ID],$curso->ID);
						}
						if($_POST['turno_curso_'.$curso->ID] != get_field('horario',$curso->ID))
						{
							update_field('horario',$_POST['turno_curso_'.$curso->ID],$curso->ID);
						}
						if($_POST['precio_curso_'.$curso->ID] != '')
						{
							$nuevo_precio=str_replace(',','.',$_POST['precio_curso_'.$curso->ID]);
							if($nuevo_precio != get_post_meta($curso->ID,'_regular_price',true))
							{
								update_post_meta( $curso->ID, '_regular_price', $nuevo_precio );
								update_post_meta( $curso->ID, '_price', $nuevo_precio );
							}
						}
					}
				}
				if($_POST['insertar_nuevo_curso'] == 'Sí')
				{
					$cuerpo_mail='Se ha añadido el siguiente nuevo curso desde un microsite: <br /><ul>';
					if($_POST['tipo_curso_nuevo'] == 'cap-inicial')
					{
						$titulo='CAP INICIAL';
						$cat=53;
						$cat_tc=28;
					}
					elseif($_POST['tipo_curso_nuevo'] == 'cap-continua')
					{
						$titulo='CAP CONTINUA';
						$cat=27;
						$cat_tc=29;
					}
					elseif($_POST['tipo_curso_nuevo'] == 'adr-obtencion')
					{
						$titulo='ADR OBTENCIÓN';
						$cat=55;
						$cat_tc=30;
					}
					elseif($_POST['tipo_curso_nuevo'] == 'adr-renovacion')
					{
						$titulo='ADR RENOVACIÓN';
						$cat=54;
						$cat_tc=31;
					}
					
					$cuerpo_mail.='<li>Tipo de curso: '.$titulo.'</li>';
					
					$postarr=array(
						'post_title' => $titulo,
						'post_type' => 'product',
						'post_status' => 'publish'
					);
					$post_id=wp_insert_post($postarr);
					
					wp_set_post_terms($post_id,array($cat),'product_cat');
					wp_set_post_terms($post_id,array($cat_tc),'tipo-curso');
					
					$precio=$_POST['precio_curso_nuevo'];
					$cuerpo_mail.='<li>Precio del curso: '.$precio.'</li>';
					$precio=str_replace(array(' ','€'),'',$precio);
					update_post_meta( $post_id, '_regular_price', $precio );
					update_post_meta( $post_id, '_price', $precio );
										
					update_field('autoescuela',array(get_the_id()),$post_id);
					$cuerpo_mail.='<li>ID autoescuela: '.get_the_id().'</li>';
					$cuerpo_mail.='<li><a href="'.get_bloginfo('url').'/wp-admin/post.php?post='.get_the_id().'&action=edit">Enlace edición autoescuela</a>.</li>';
					
					$anyo=substr($_POST['fecha_inicio_curso_nuevo'],6,4);
					$mes=substr($_POST['fecha_inicio_curso_nuevo'],3,2);
					$dia=substr($_POST['fecha_inicio_curso_nuevo'],0,2);
					$fecha_formateada=$anyo.$mes.$dia;
					$fecha_inicio_formateada=$fecha_formateada;
					update_field('fecha_inicio',$fecha_formateada,$post_id);
					$cuerpo_mail.='<li>Fecha de inicio: '.$_POST['fecha_inicio_curso_nuevo'].'</li>';
					
					$anyo=substr($_POST['fecha_fin_curso_nuevo'],6,4);
					$mes=substr($_POST['fecha_fin_curso_nuevo'],3,2);
					$dia=substr($_POST['fecha_fin_curso_nuevo'],0,2);
					$fecha_formateada=$anyo.$mes.$dia;
					$fecha_fin_formateada=$fecha_formateada;
					update_field('fecha_de_finalizacion',$fecha_formateada,$post_id);
					$cuerpo_mail.='<li>Fecha de fin: '.$_POST['fecha_fin_curso_nuevo'].'</li>';
					
					update_field('horario',$_POST['turno_curso_nuevo'],$post_id);
					$cuerpo_mail.='<li>Turno: '.$_POST['turno_curso_nuevo'].'</li>';
					
					update_field('hora_inicio',$_POST['hora_inicio_curso_nuevo'],$post_id);
					$cuerpo_mail.='<li>Hora de inicio: '.$_POST['hora_inicio_curso_nuevo'].'</li>';
					
					update_field('horario_texto',$_POST['horario_curso_nuevo'],$post_id);
					$cuerpo_mail.='<li>Horario: '.$_POST['horario_curso_nuevo'].'</li>';
					
					if($_POST['tipo_cap_inicial_curso_nuevo'] != '')
					{
						update_field('tipo_cap_inicial',$_POST['tipo_cap_inicial_curso_nuevo'],$post_id);
						$cuerpo_mail.='<li>Tipo curso CAP inicial: '.$_POST['tipo_cap_inicial_curso_nuevo'].'</li>';
					}
					if($_POST['tipo_cap_ampliacion_curso_nuevo'] != '')
					{
						update_field('tipo_cap_ampliacion',$_POST['tipo_cap_ampliacion_curso_nuevo'],$post_id);
						$cuerpo_mail.='<li>Tipo curso CAP ampliación: '.$_POST['tipo_cap_ampliacion_curso_nuevo'].'</li>';
					}
					if($_POST['tipo_adr_curso_nuevo'] != '')
					{
						update_field('tipo_adr',$_POST['tipo_adr_curso_nuevo'],$post_id);
						$cuerpo_mail.='<li>Tipo curso ADR: '.$_POST['tipo_adr_curso_nuevo'].'</li>';
					}
					if($_POST['tipo_adr_texto_curso_nuevo'] != '')
					{
						update_field('tipo_adr_texto',$_POST['tipo_adr_texto_curso_nuevo'],$post_id);
						$cuerpo_mail.='<li>Indica tipo curso ADR: '.$_POST['tipo_adr_texto_curso_nuevo'].'</li>';
					}
					
					if(function_exists('cambio_slug'))
					{
						cambio_slug($post_id);
					}
					
					$cuerpo_mail.='<li><a href="'.get_bloginfo('url').'/wp-admin/post.php?post='.$post_id.'&action=edit">Enlace edición curso</a></li>';
					$cabeceras=array('Content-Type: text/html; charset=UTF-8');
					$asunto='Nuevo curso insertado desde microsite';
					
					/*chequeamos si el curso es sospechoso de duplicado*/
					$curso=get_posts(array(
						'post_type' => 'product',
						'tax_query' => array(
							array(
								'taxonomy' => 'product_cat',
								'field' => 'term_id',
								'terms' => $cat,
								'include_children' => false
							)
						),
						'meta_query' => array(
							'relation' => 'AND',
							array(
								'key' => 'autoescuela',
								'value' => '"' . get_the_id() . '"',
								'compare'	=> 'LIKE'
							),
							array(
								'key' => 'fecha_inicio',
								'value' => $fecha_inicio_formateada,
								'type'		=> 'NUMERIC',
								'compare'	=> '='
							),
							array(
								'key' => 'fecha_de_finalizacion',
								'value' => $fecha_fin_formateada,
								'type'		=> 'NUMERIC',
								'compare'	=> '='
							),
							array(
								'key' => 'horario',
								'value' => $_POST['turno_curso_nuevo'],
								'type'		=> 'TEXT',
								'compare'	=> '='
							)
						),
						'exclude' => array($post_id)
					));
					if($curso)
					{
						$asunto='POSIBLE DUPLICADO: Nuevo curso insertado desde microsite';
					}
					/*fin chequeamos si el curso es sospechoso de duplicado*/
					if(!current_user_can('administrator'))
					{
						if($post_id != 0)
						{
							wp_mail('clientes@academiadeltransportista.com',$asunto,$cuerpo_mail,$cabeceras);
						}
					}
					else
					{
						if($post_id != 0)
						{
							wp_mail('rhurtado@roiting.com',$asunto,$cuerpo_mail,$cabeceras);
						}
					}
					
					if(function_exists('rocket_clean_domain'))
					{
						rocket_clean_domain();
					}
				} ?>
            </div><?php
			wp_redirect(get_permalink(get_the_id()).'?edit=true');
		}
		get_header('microsite');
		$color_microsite=get_field('color_microsite');
		if($color_microsite == '')
		{
			$color_microsite='#3DD05D';
		}
		
		$rgb = HTMLToRGB($color_microsite);
		$hsl = RGBToHSL($rgb);
		if($hsl->lightness > 200)
		{
			$tcolor='#333';
		}
		else
		{
			$tcolor='#fff';
		}
		while(have_posts())
		{
			the_post(); ?>
            <div class="edit_form_container">
                <form method="post" action="<?php echo get_permalink(get_the_id()).'?edit=true'; ?>" id="form_update_autoescuela_<?php echo get_the_id(); ?>" enctype="multipart/form-data">
                	<input type="hidden" name="edit_form" value="true" />
                    <!-- CONTENIDO DIV CURSOS -->
					<div id="divcursos" style="display:none;">
					<section class="cursos section_wrapper mcb-section-inner">
                                	<div class="titulo_edicion numbered">Añade las próximas convocatorias de tus cursos CAP Inicial, CAP Continua, ADR Obtención y ADR Renovación:</div>
                                    <div class="edit_block cursos nuevo_curso">
	                                    <div class="titulo_edicion nuevo">Insertar nuevo curso:</div>
                                    	<div class="curso" style="border-color:<?php if(get_field('color_microsite') != ''){ the_field('color_microsite'); }else{ ?>#FF6600<?php } ?>;">
                                        	<div class="gutter">
                                                <div class="the_input not_full_width">
                                                    <input type="checkbox" name="insertar_nuevo_curso" value="Sí"> Insertar este nuevo curso
                                                </div>
                                                <div class="the_input tipo not_full_width radios">
                                                    <p>Tipo de curso:</p>
                                                    <div class="the_subinput">
	                                                    <input type="radio" name="tipo_curso_nuevo" value="cap-inicial"> CAP Inicial
                                                    </div>
                                                    <div class="the_subinput">
	                                                    <input type="radio" name="tipo_curso_nuevo" value="cap-continua"> CAP Continua
                                                    </div><?php
													if(false)/*current_user_can('administrator'))*/
													{ ?>
														<div class="the_subinput">
                                                            <input type="radio" name="tipo_curso_nuevo" value="cap-ampliacion"> CAP Ampliación
                                                        </div><?php
													} ?>
                                                    <div class="the_subinput">
	                                                    <input type="radio" name="tipo_curso_nuevo" value="adr-obtencion"> ADR Obtención
                                                    </div>
                                                    <div class="the_subinput">
	                                                    <input type="radio" name="tipo_curso_nuevo" value="adr-renovacion"> ADR Renovación
                                                    </div>
                                                </div>
                                                <div class="clear"></div><?php
												if(true)/*current_user_can('administrator'))*/
												{ ?>
													<div class="selector_tipo_curso the_input tipo_cap_inicial" style="display:none;">
                                                        <span>Tipo de curso CAP Inicial:</span>
                                                        <select name="tipo_cap_inicial_curso_nuevo" form="form_update_autoescuela_<?php echo get_the_id(); ?>">
                                                            <option value="" selected="selected">Elige</option>
                                                            <option value="mercancias">Mercancías</option>
                                                            <option value="viajeros">Viajeros</option>
                                                            <option value="mercancias-viajeros">Mercancías / Viajeros</option>
                                                        </select>
                                                    </div>
													<?php /*<div class="selector_tipo_curso the_input tipo_cap_ampliacion" style="display:none;">
                                                        <span>Tipo de curso CAP Ampliación:</span>
                                                        <select name="tipo_cap_ampliacion_curso_nuevo" form="form_update_autoescuela_<?php echo get_the_id(); ?>">
                                                        	<option value="" selected="selected">Elige</option>
                                                            <option value="mercancias">Mercancías</option>
                                                            <option value="viajeros">Viajeros</option>
                                                        </select>
                                                    </div>*/ ?>
													<div class="selector_tipo_curso the_input tipo_adr" style="display:none;">
                                                        <span>Tipo de curso ADR:</span>
                                                        <select name="tipo_adr_curso_nuevo" form="form_update_autoescuela_<?php echo get_the_id(); ?>">
                                                        	<option value="" selected="selected">Elige</option>
                                                            <option value="basico">Básico</option>
                                                            <option value="cisternas">Cisternas</option>
                                                            <option value="basico-cisternas">Básico + Cisternas</option>
                                                            <option value="explosivos">Explosivos</option>
                                                            <option value="radiactivos">Radiactivos</option>
                                                            <option value="otros">Otros (Indicad cuál)</option>
                                                        </select>
                                                        <div class="the_input tipo_adr_texto" style="display:none;">
                                                            <span>Indica tipo de curso ADR:</span> <input type="text" name="tipo_adr_texto_curso_nuevo" />
                                                        </div>
                                                    </div><?php
												} ?>
                                                <?php /*<div class="the_input tipo_adr" style="display:none;">
                                                    <span>Tipo de curso ADR:</span> <input type="text" name="tipo_adr_curso_nuevo" />
                                                </div>*/ ?>
                                                <div class="the_input">
                                                    <span>Horario del curso:</span> <input type="text" name="horario_curso_nuevo" />
                                                </div>
                                                <div class="the_input half_size_left">
                                                    <span>Fecha de inicio:</span> <input type="text" class="elDatePicker" name="fecha_inicio_curso_nuevo" />
                                                </div>
                                                <div class="the_input half_size_right">
                                                    <span>Hora de inicio:</span> <input type="text" name="hora_inicio_curso_nuevo" />
                                                </div>
                                                <div class="the_input half_size_left">
                                                    <span>Fecha de fin:</span> <input type="text" class="elDatePicker" name="fecha_fin_curso_nuevo" />
                                                </div>
                                                <div class="the_input half_size_right">
                                                    <span>Turno:</span>
                                                    <select name="turno_curso_nuevo" form="form_update_autoescuela_<?php echo get_the_id(); ?>">
                                                        <option value="mananas" selected="selected">Mañanas</option>
                                                        <option value="tardes">Tardes</option>
                                                        <option value="findesemana">Fin de semana</option>
                                                    </select>
                                                </div>
                                                <div class="the_input half_size_left">
                                                    <span>Precio:</span> <input type="text" name="precio_curso_nuevo" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="edit_block cursos cursos_actuales">
										<div class="titulo_edicion anadidos">Cursos añadidos:</div><?php
                                        foreach($cursos_actuales as $curso)
                                        { 	
											$categoria=wp_get_post_terms($curso->ID,'tipo-curso'); ?>
                                        	<div class="curso" curso_id="<?php echo $curso->ID; ?>" style="border-color:<?php if(get_field('color_microsite') != ''){ the_field('color_microsite'); }else{ ?>#FF6600<?php } ?>;">
                                            	<div class="gutter">
                                                    <div class="the_input not_full_width radios">
                                                        <p>Tipo de curso:</p>
                                                        <div class="the_subinput">
                                                        	<input type="radio" name="tipo_curso_<?php echo $curso->ID; ?>" value="cap-inicial" <?php if($categoria[0]->slug == 'cap-inicial'){ ?>checked="checked"<?php } ?>> CAP Inicial
                                                        </div>
                                                        <div class="the_subinput">
	                                                        <input type="radio" name="tipo_curso_<?php echo $curso->ID; ?>" value="cap-continua" <?php if($categoria[0]->slug == 'cap-continua'){ ?>checked="checked"<?php } ?>> CAP Continua
                                                        </div>
                                                        <div class="the_subinput">
	                                                        <input type="radio" name="tipo_curso_<?php echo $curso->ID; ?>" value="adr-obtencion" <?php if($categoria[0]->slug == 'adr-obtencion'){ ?>checked="checked"<?php } ?>> ADR Obtención
                                                        </div>
                                                        <div class="the_subinput">
	                                                        <input type="radio" name="tipo_curso_<?php echo $curso->ID; ?>" value="adr-renovacion" <?php if($categoria[0]->slug == 'adr-renovacion'){ ?>checked="checked"<?php } ?>> ADR Renovación
                                                        </div>
                                                    </div>
                                                    <div class="clear"></div>
                                                    <div class="selector_tipo_curso the_input tipo_cap_inicial" <?php if($categoria[0]->slug != 'cap-inicial'){ ?> style="display:none;" <?php } ?>>
                                                        <span>Tipo de curso CAP Inicial:</span>
                                                        <select name="tipo_cap_inicial_curso_<?php echo $curso->ID; ?>" form="form_update_autoescuela_<?php echo get_the_id(); ?>">
                                                            <option value="" <?php if(get_field('tipo_cap_inicial',$curso->ID) == ''){ ?>selected="selected"<?php } ?>>Elige</option>
                                                            <option value="mercancias" <?php if(get_field('tipo_cap_inicial',$curso->ID) == 'mercancias'){ ?>selected="selected"<?php } ?>>Mercancías</option>
                                                            <option value="viajeros" <?php if(get_field('tipo_cap_inicial',$curso->ID) == 'viajeros'){ ?>selected="selected"<?php } ?>>Viajeros</option>
                                                            <option value="mercancias-viajeros" <?php if(get_field('tipo_cap_inicial',$curso->ID) == 'mercancias-viajeros'){ ?>selected="selected"<?php } ?>>Mercancías / Viajeros</option>
                                                        </select>
                                                    </div>
													<?php /*<div class="selector_tipo_curso the_input tipo_cap_ampliacion" style="display:none;">
                                                        <span>Tipo de curso CAP Ampliación:</span>
                                                        <select name="tipo_cap_ampliacion_curso_nuevo" form="form_update_autoescuela_<?php echo get_the_id(); ?>">
                                                        	<option value="" selected="selected">Elige</option>
                                                            <option value="mercancias">Mercancías</option>
                                                            <option value="viajeros">Viajeros</option>
                                                        </select>
                                                    </div>*/ ?>
                                                    <div class="selector_tipo_curso the_input tipo_adr" <?php if($categoria[0]->slug != 'adr-obtencion' && $categoria[0]->slug != 'adr-renovacion'){ ?> style="display:none;" <?php } ?>>
                                                        <span>Tipo de curso ADR:</span>
                                                        <select name="tipo_adr_curso_<?php echo $curso->ID; ?>" form="form_update_autoescuela_<?php echo get_the_id(); ?>">
                                                            <option value="" <?php if(get_field('tipo_adr',$curso->ID) == ''){ ?>selected="selected"<?php } ?>>Elige</option>
                                                            <option value="basico" <?php if(get_field('tipo_adr',$curso->ID) == 'basico'){ ?>selected="selected"<?php } ?>>Básico</option>
                                                            <option value="cisternas" <?php if(get_field('tipo_adr',$curso->ID) == 'cisternas'){ ?>selected="selected"<?php } ?>>Cisternas</option>
                                                            <option value="basico-cisternas" <?php if(get_field('tipo_adr',$curso->ID) == 'basico-cisternas'){ ?>selected="selected"<?php } ?>>Básico + Cisternas</option>
                                                            <option value="explosivos" <?php if(get_field('tipo_adr',$curso->ID) == 'explosivos'){ ?>selected="selected"<?php } ?>>Explosivos</option>
                                                            <option value="radiactivos" <?php if(get_field('tipo_adr',$curso->ID) == 'radiactivos'){ ?>selected="selected"<?php } ?>>Radiactivos</option>
                                                            <option value="otros" <?php if(get_field('tipo_adr',$curso->ID) == 'otros'){ ?>selected="selected"<?php } ?>>Otros (Indicad cuál)</option>
                                                        </select>
														<div class="the_input tipo_adr_texto" <?php if(get_field('tipo_adr_texto',$curso->ID) == ''){ ?> style="display:none;" <?php } ?>>
                                                            <span>Indica tipo de curso ADR:</span> <input type="text" name="tipo_adr_texto_curso_<?php echo $curso->ID; ?>" value="<?php the_field('tipo_adr_texto',$curso->ID); ?>" />
                                                        </div>
                                                    </div>
                                                    <div class="clear"></div>
                                                    <?php /*<div class="the_input tipo_adr">
                                                        <span>Tipo de curso CAP/ADR:</span> <input type="text" name="tipo_adr_curso_<?php echo $curso->ID; ?>" value="<?php the_field('tipo_de_curso',$curso->ID); ?>" />
                                                    </div>*/ ?>
                                                    <div class="the_input">
                                                        <span>Horario del curso:</span> <input type="text" name="horario_curso_<?php echo $curso->ID; ?>" value="<?php the_field('horario_texto',$curso->ID); ?>" />
                                                    </div>
                                                    <div class="the_input half_size_left">
                                                        <span>Fecha de inicio:</span> <input type="text" class="elDatePicker" name="fecha_inicio_curso_<?php echo $curso->ID; ?>" value="<?php echo get_field('fecha_inicio',$curso->ID); ?>" />
                                                    </div>
                                                    <div class="the_input half_size_right">
                                                        <span>Hora de inicio:</span> <input type="text" name="hora_inicio_curso_<?php echo $curso->ID; ?>" value="<?php the_field('hora_inicio',$curso->ID); ?>" />
                                                    </div>
                                                    <div class="the_input half_size_left">
                                                        <span>Fecha de fin:</span> <input type="text" class="elDatePicker" name="fecha_fin_curso_<?php echo $curso->ID; ?>" value="<?php echo get_field('fecha_de_finalizacion',$curso->ID); ?>" />
                                                    </div>
                                                    <div class="the_input half_size_right">
                                                        <span>Turno:</span>
                                                        <select name="turno_curso_<?php echo $curso->ID; ?>" form="form_update_autoescuela_<?php echo get_the_id(); ?>">
                                                            <option value="" <?php if(get_field('horario',$curso->ID)==''){ ?>selected="selected"<?php } ?>>- Elige -</option>
                                                            <option value="mananas" <?php if(get_field('horario',$curso->ID)=='mananas'){ ?>selected="selected"<?php } ?>>Mañanas</option>
                                                            <option value="tardes" <?php if(get_field('horario',$curso->ID)=='tardes'){ ?>selected="selected"<?php } ?>>Tardes</option>
                                                            <option value="findesemana" <?php if(get_field('horario',$curso->ID)=='findesemana'){ ?>selected="selected"<?php } ?>>Fin de semana</option>
                                                        </select>
                                                    </div>
                                                    <div class="the_input half_size_left">
                                                        <span>Precio:</span> <input type="text" name="precio_curso_<?php echo $curso->ID; ?>" value="<?php echo get_post_meta($curso->ID,'_regular_price',true); ?>" />
                                                    </div>
                                                    <div class="the_input clear_only">
														<input type="checkbox" name="eliminar_curso_<?php echo $curso->ID; ?>" value="si"> Eliminar este curso (marcar casilla y pulsar botón "Guardar cambios")
													</div>
                                                </div>
											</div><?php                                            
                                        } ?>
                                    </div>
                                </section>
									</div>
					
					
					<!-- #Content -->
										
                    <div id="Content" class="new_2020" microsite-color="<?php echo str_replace('#','',$color_microsite); ?>" color-texto="<?php echo str_replace('#','',$tcolor); ?>">
                        <div class="content_wrapper clearfix"><?php
                            $logo=get_the_post_thumbnail_url();
                            $imagen_cabecera=get_field('imagen_cabecera'); ?>
                            <div class="header_microsite new" style="background-color:<?php echo $color_microsite; ?>;">
                            	<div class="overlay" style="background-color:<?php echo $color_microsite; ?>;"></div>
                                <div class="cabecera_contenido">
                                    <div class="logo_principal" style="color:<?php echo $tcolor; ?>;"><?php 
                                        if($logo != '')
                                        { ?>
                                            <img alt="<?php echo get_the_title(); ?>" src="<?php echo $logo; ?>" /><?php
                                        }
                                        else
                                        { ?>
                                            <img alt="<?php echo get_the_title(); ?>" src="<?php echo get_bloginfo('stylesheet_directory'); ?>/img/microsites/logo_generico.png" /><?php						
                                        } ?>
                                        <div class="clear"></div>
                                        <div class="edit_block logo numbered">
                                            <div class="titulo">Cambiar logo</div>
                                            <input type="file" name="logo_image" id="logo_image"><br /><?php
                                            if(has_post_thumbnail())
                                            { ?>
                                                <div class="remove_current">
                                                    <input type="checkbox" name="delete_current_logo" value="yes"> <label for="delete_current_logo">Eliminar logo actual (se colocará en su lugar un logo genérico)</label>
                                                </div><?php
                                            } ?>
                                        </div>
                                    </div>
                                    <div class="texto_cabecera">
                                        <h1 class="titulo" style="color:<?php echo $tcolor; ?>;"><?php echo get_the_title(); ?></h1>
										<div class="edit_block titulo numbered">
                                            <div class="titulo" style="color:<?php echo $tcolor; ?>;">Cambiar título</div>
                                            <input type="text" name="new_title" id="new_title" value="<?php echo get_the_title(); ?>">
                                        </div>
                                    </div>
                                    <div class="color_microsite">
	                                    <div class="edit_block color numbered">
    	                                    <div class="titulo" style="color:<?php echo $tcolor; ?>;">Elige color principal para tu sitio</div>
        	                                <input class="jscolor" name="color_microsite" value="<?php if(get_field('color_microsite') != ''){ echo str_replace('#','',get_field('color_microsite')); }else{ ?>FF6600<?php } ?>">
            	                        </div>
                                    </div>
                                    <div class="edit_block contacto_cabecera numbered">
                                        <p class="titulo" style="color:<?php echo $tcolor; ?>;">Datos de contacto</p>
										<div class="elemento tlf_fijo"><p class="titulo" style="color:<?php echo $tcolor; ?>;">Teléfono fijo:</p> <input type="text" name="new_tlf_fijo" id="new_tlf_fijo" value="<?php the_field('telefono_fijo'); ?>" placeholder="Teléfono fijo del centro"></div>
										<div class="elemento mail"><p class="titulo" style="color:<?php echo $tcolor; ?>;">Email:</p> <input type="text" name="new_e-mail" id="new_e-mail" value="<?php the_field('e-mail'); ?>" placeholder="e-mail del centro"></div>
                                        <div class="elemento new_Whatsapptelf">
                                            <p class="titulo" style="color:<?php echo $tcolor; ?>;">Teléfono para notificaciones de Whatsapp</p>
                                            <?php
                                                if ( get_field('Whatsapptelf') ) {
                                                    $inputValue = get_field('Whatsapptelf');
                                                } else {
                                                    $inputValue = get_field('telefono_movil');
                                                }
                                            ?>
                                            <input type="text" name="new_Whatsapptelf" id="new_Whatsapptelf" value="<?php echo $inputValue ?>" placeholder=""  maxlength="9">
                                            <p style="font-size:10px;">Por favor, escriba un único número de teléfono"</p>


                                            <div class="elemento tlf_movil"><p class="titulo" style="color:<?php echo $tcolor; ?>;">Teléfono movil:</p> 	<input type="text" name="new_tlf_movil" id="new_tlf_movil" value="<?php the_field('telefono_movil'); ?>" placeholder="Teléfono móvil del centro" maxlength="9"></div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- .sections_group -->
                            <div class="microsite_sections">
                            	<div class="section_wrapper"><p class="titulo_edicion numbered">Selecciona qué tipos de cursos ofrece la autoescuela:</p></div>
                                <section class="cursos_genericos section_wrapper mcb-section-inner">
                                	<div class="cabecera_mobile" style="display:none;">Cursos que ofrecemos</div>
                                    <div class="cursos_genericos_1 column mcb-column one-third column_column">
                                        <div class="gutter"><?php
											$values_autoescuela=array();
											if(get_field('cursos_ofrecidos_tipo_autoescuela'))
											{
												$values_autoescuela = get_field('cursos_ofrecidos_tipo_autoescuela');
											}
											$values_transporte=array();
											if(get_field('cursos_ofrecidos_tipo_transporte'))
											{
												$values_transporte = get_field('cursos_ofrecidos_tipo_transporte');
											}
											$values_mas=array();
											if(get_field('cursos_ofrecidos_tipo_mas_cursos'))
											{
												$values_mas = get_field('cursos_ofrecidos_tipo_mas_cursos');
											}
											$values=array_merge($values_autoescuela,$values_transporte,$values_mas);
											$field_autoescuela = get_field_object('cursos_ofrecidos_tipo_autoescuela');
											$choices_autoescuela = $field_autoescuela['choices'];
											$field_transporte = get_field_object('cursos_ofrecidos_tipo_transporte');
											$choices_transporte = $field_transporte['choices'];
											$field_mas = get_field_object('cursos_ofrecidos_tipo_mas_cursos');
											$choices_mas = $field_mas['choices'];
											$field=array_merge($field_autoescuela,$field_transporte,$field_mas);
											$choices=array_merge($choices_autoescuela,$choices_transporte,$choices_mas); ?>
                                            <ul class="cursos">
												<li style="border-color:<?php if(get_field('color_microsite') != ''){ the_field('color_microsite'); }else{ ?>#FF6600<?php } ?>;width:100%;"><?php 
													_e('Cursos predefinidos (marca la casilla de los que quieras que aparezcan en la versión pública de la página):','academiadeltransportista'); ?>
												</li><?php
												foreach($choices as $choice_value => $choice_label)
												{ ?>
                                                	<li style="border-color:<?php if(get_field('color_microsite') != ''){ the_field('color_microsite'); }else{ ?>#FF6600<?php } ?>;"><?php
														$found=false;
														foreach ($values as $value)
														{
															if ($value['value'] == $choice_value)
															{ ?>
																<input type="checkbox" checked="checked" name="<?php echo $choice_value; ?>" value="yes" <?php if($microsite_level=='pro'){ ?> style="display:none;" <?php } ?>><?php
																$found=true;
															}
														} // end foreach $values
														if(!$found)
														{ ?>
															<input type="checkbox" name="<?php echo $choice_value; ?>" value="yes"><?php
														} ?>
                                                        <label for="<?php echo $choice_value; ?>"><?php echo $choice_label; ?></label>
                                                    </li><?php
												} // end foreach $choices 
												$cursos_anadidos_autoescuela=get_field('cursos_ofrecidos_tipo_autoescuela_adicionales');
												$cursos_anadidos_transporte=get_field('cursos_ofrecidos_tipo_transporte_adicionales');
                                                $cursos_anadidos_mas=get_field('cursos_ofrecidos_tipo_mas_cursos_adicionales');
												if(!empty($cursos_anadidos_autoescuela) || !empty($cursos_anadidos_transporte) || !empty($cursos_anadidos_mas))
												{ ?>
                                                	<li style="border-color:<?php if(get_field('color_microsite') != ''){ the_field('color_microsite'); }else{ ?>#FF6600<?php } ?>;width:100%;"><?php 
														_e('Cursos adicionales añadidos (para eliminar uno, bórralo y guarda la página):','academiadeltransportista'); ?>
													</li><?php
													if(!empty($cursos_anadidos_autoescuela))
													{
														$i=0;
														foreach($cursos_anadidos_autoescuela as $curso_anadido)
														{ ?>
															<li style="border-color:<?php if(get_field('color_microsite') != ''){ the_field('color_microsite'); }else{ ?>#FF6600<?php } ?>;">
																<input type="text" class="add_curso_autoescuela" name="add_curso_autoescuela_<?php echo $i; ?>" value="<?php echo $curso_anadido['nombre'] ?>" />
															</li><?php
															$i++;
														}
													}
													if(!empty($cursos_anadidos_transporte))
													{
														$i=0;
														foreach($cursos_anadidos_transporte as $curso_anadido)
														{ ?>
															<li style="border-color:<?php if(get_field('color_microsite') != ''){ the_field('color_microsite'); }else{ ?>#FF6600<?php } ?>;">
																<input type="text" class="add_curso_transporte" name="add_curso_transporte_<?php echo $i; ?>" value="<?php echo $curso_anadido['nombre'] ?>" />
															</li><?php
															$i++;
														}
													}
													if(!empty($cursos_anadidos_mas))
													{
														$i=0;
														foreach($cursos_anadidos_mas as $curso_anadido)
														{ ?>
															<li style="border-color:<?php if(get_field('color_microsite') != ''){ the_field('color_microsite'); }else{ ?>#FF6600<?php } ?>;">
																<input type="text" class="add_curso_mas" name="add_curso_mas_<?php echo $i; ?>" value="<?php echo $curso_anadido['nombre'] ?>" />
															</li><?php
															$i++;
														}
													}
												} ?>
                                                <li style="border-color:<?php if(get_field('color_microsite') != ''){ the_field('color_microsite'); }else{ ?>#FF6600<?php } ?>;width:100%;"><?php 
													_e('Añade un nuevo curso escribiendo su nombre aquí y guardando la página:','academiadeltransportista'); ?>
                                                </li>
                                                <li style="border-color:<?php if(get_field('color_microsite') != ''){ the_field('color_microsite'); }else{ ?>#FF6600<?php } ?>;width:100%;">
                                                	<input type="text" class="add_curso_mas" name="add_curso_mas" placeholder="Añadir otro curso" />
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </section>
                                <section class="conoce_autoescuela section_wrapper mcb-section-inner">
                                    <div class="titulo_2"><?php _e('Conoce la autoescuela','academiadeltransportista'); ?></div>
                                    <div class="logo column mcb-column two-fifth column_column"><?php
                                        if($logo != '')
                                        { ?>
                                            <img alt="<?php echo get_the_title(); ?>" src="<?php echo $logo; ?>" /><?php
                                        }
                                        else
                                        { ?>
                                            <img alt="<?php echo get_the_title(); ?>" src="<?php echo get_bloginfo('stylesheet_directory'); ?>/img/microsites/logo_generico.png" /><?php						
                                        } ?>
                                    </div>
                                    <div class="textos column mcb-column three-fifth column_column">
                                    	<?php
                                        if(get_field('texto_cabecera') != '')
                                        { ?>
                                            <div class="descripcion"><?php the_field('texto_cabecera'); ?></div><?php
                                        } ?>
                                        <div class="edit_block descripcion numbered">
                                            <div class="titulo">Cambiar introducción</div>
                                            <textarea type="text" name="new_description" id="new_description"><?php the_field('texto_cabecera'); ?></textarea>
                                        </div>
                                        <div class="titulo_descripcion"><?php 
                                            if(get_field('titulo_texto_informacion') != '')
                                            {
                                                the_field('titulo_texto_informacion');
                                            }
                                            else
                                            {
                                                _e('No hay texto descriptivo actualmente','academiadeltransportista');
                                            } ?>
                                            <div class="edit_block texto_descriptivo numbered">
	                                            <div class="titulo">Cambiar texto</div>
	                                            <textarea name="new_texto_descriptivo" id="new_texto_descriptivo"><?php the_field('titulo_texto_informacion'); ?></textarea>
                                            </div>
                                        </div>
                                        <div class="texto_descripcion"><?php 
                                            if(get_field('texto_informacion') != '')
                                            {
                                                the_field('texto_informacion');
                                            }
                                            else
                                            {
                                                _e('No hay texto explicativo','academiadeltransportista');
                                            } ?>
                                            <div class="edit_block texto_informacion numbered">
                                            	<div class="titulo">Cambiar texto</div>
	                                            <textarea name="new_texto_informacion" id="new_texto_informacion"><?php the_field('texto_informacion'); ?></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </section>
                                <section class="detalles_autoescuela section_wrapper mcb-section-inner numbered">
                                    <div class="section_gutter">
                                        <div class="horarios_ubicacion column mcb-column one-second column_column">
                                            <div class="titulo">Ubicación</div>
                                            <div class="elemento ubicacion">
                                                <div class="icono"><img src="<?php echo get_bloginfo('stylesheet_directory'); ?>/img/microsites/ubicacion.png" /></div><?php 
                                                $direccion=get_field('mapa'); echo $direccion['address']; ?><br /><?php
                                                echo get_field('municipio_texto').', '.get_field('provincia_texto'); ?>
                                            </div>
                                            <div class="separador" style="background-color:<?php echo $color_microsite; ?>;"></div>
                                        </div>
										<div class="horarios_ubicacion column mcb-column one-second column_column">
                                            <div class="titulo">Horario</div>
                                            <div class="elemento horario">
                                                <div class="icono"><img src="<?php echo get_bloginfo('stylesheet_directory'); ?>/img/microsites/horario.png" /></div>
												<input type="text" name="new_horario" id="new_horario" value="<?php the_field('horario'); ?>" placeholder="Horario del centro">
                                            </div>
                                            <div class="separador" style="background-color:<?php echo $color_microsite; ?>;"></div>
                                        </div>

                                    </div>
                                </section>
                                <section class="imagenes_autoescuela section_wrapper mcb-section-inner">
									<div class="titulo_edicion numbered">Inserta imágenes de tu autoescuela</div><?php 
                                    if(have_rows('imagenes'))
                                    { ?>
                                        <div class="owl-carousel"><?php
                                            while(have_rows('imagenes'))
                                            {
                                                the_row();
                                                $imagen=get_sub_field('imagen'); ?>
                                                <div><?php /*<a href="<?php echo $imagen['url']; ?>">*/ ?><img src="<?php echo aq_resize($imagen['url'],580,390,true,true,true); ?>" /><?php /*</a>*/ ?></div><?php
                                            } ?>
                                        </div><?php
                                    }
                                    else
                                    { ?>
                                        <div class="owl-carousel default">
                                            <div><a href="#"><img src="<?php echo get_bloginfo('stylesheet_directory'); ?>/img/microsites/default_image.png" /></a></div>
                                            <div><a href="#"><img src="<?php echo get_bloginfo('stylesheet_directory'); ?>/img/microsites/default_image.png" /></a></div>
                                        </div><?php
                                    } ?>
                                    <div class="edit_block imagenes_carrusel"><?php
										$imagenes=get_field('imagenes');
										if($imagenes)
										{
											$num_imagenes=count($imagenes);
										}
										else
										{
											$num_imagenes=0;
										}
										/*print_r($imagenes);*/ ?>
                                        <div class="titulo">Añadir imágenes</div><?php
										if($num_imagenes < 6)
										{ ?>
	                                        <div class="instrucciones">El máximo de imágenes permitido es de 6<?php if($num_imagenes !=6){ ?>, por lo que solo puedes añadir <?php echo (6-$num_imagenes); ?> imágenes más. Para añadir más, tendrás que eliminar antes otras imágenes<?php } ?>.</div>
											<ol><?php
	    	                                    for($i=1;$i<=(6-$num_imagenes);$i++)
												{ ?>
        	    	                            	<li><input type="file" name="anadir_imagen_<?php echo $i; ?>" id="anadir_imagen_<?php echo $i; ?>"></li><?php											
												} ?>
                        	                </ol><?php
										}
										else
										{ ?>
                                        	<div class="instrucciones">El máximo de imágenes permitido es de 6, por lo que no puedes añadir más. Para añadir más, tendrás que eliminar antes otras imágenes.</div><?php
										} ?>
                                        <div class="titulo">Eliminar imágenes</div>
										<div class="instrucciones">Selecciona las imágenes a eliminar y guarda la página</div><?php
										if($num_imagenes > 0)
										{ ?>
                                        	<ul><?php
												$j=1;
												foreach($imagenes as $imagen)
    	                                        {
        	                                        $la_imagen=$imagen['imagen']; ?>
													<input type="checkbox" name="borrar_imagen_<?php echo $j; ?>" value="<?php echo $la_imagen['ID']; ?>"> <img src="<?php echo $la_imagen['sizes']['thumbnail']; ?>" /><?php
													$j++;
												} ?>
                                            </ul><?php
										} ?>
                                    </div>
                                </section>
                                <section class="cta_banner section_wrapper mcb-section-inner">
                                    <div class="the_cta" style="background-color:<?php if(get_field('color_microsite') != ''){ the_field('color_microsite'); }else{ ?>#FF6600<?php } ?>;">
                                        <div class="textos column mcb-column three-fifth column_column">
                                            <div class="gutter">
                                                <div class="titulo_2" style="color:<?php echo $tcolor; ?>;">Confía en nuestros docentes y en nuestra experiencia</div>
                                                <a href="#" class="microsite_main_cta" style="background:<?php if(get_field('color_microsite') != ''){ the_field('color_microsite'); }else{ ?>#FF6600<?php } ?>;"><?php _e('Quiero matricularme','academiadeltransportista'); ?></a>
                                            </div>
                                        </div>
                                        <div class="imagen column mcb-column two-fifth column_column">
                                            <div class="gutter">
                                                <img src="<?php echo get_bloginfo('stylesheet_directory'); ?>/img/microsites/icono-cta.png" />
                                            </div>
                                        </div>
                                    </div>
                                </section>
                                <section class="cursos section_wrapper mcb-section-inner">
                                	<div class="titulo_edicion numbered">Añade las próximas convocatorias de tus cursos CAP Inicial, CAP Continua, ADR Obtención y ADR Renovación:</div>
                                    <div class="edit_block cursos nuevo_curso">
	                                    <div class="titulo_edicion nuevo">Insertar nuevo curso:</div>
                                    	<div class="curso" style="border-color:<?php if(get_field('color_microsite') != ''){ the_field('color_microsite'); }else{ ?>#FF6600<?php } ?>;">
                                        	<div class="gutter">
                                                <div class="the_input not_full_width">
                                                    <input type="checkbox" name="insertar_nuevo_curso" value="Sí"> Insertar este nuevo curso
                                                </div>
                                                <div class="the_input tipo not_full_width radios">
                                                    <p>Tipo de curso:</p>
                                                    <div class="the_subinput">
	                                                    <input type="radio" name="tipo_curso_nuevo" value="cap-inicial"> CAP Inicial
                                                    </div>
                                                    <div class="the_subinput">
	                                                    <input type="radio" name="tipo_curso_nuevo" value="cap-continua"> CAP Continua
                                                    </div><?php
													if(false)/*current_user_can('administrator'))*/
													{ ?>
														<div class="the_subinput">
                                                            <input type="radio" name="tipo_curso_nuevo" value="cap-ampliacion"> CAP Ampliación
                                                        </div><?php
													} ?>
                                                    <div class="the_subinput">
	                                                    <input type="radio" name="tipo_curso_nuevo" value="adr-obtencion"> ADR Obtención
                                                    </div>
                                                    <div class="the_subinput">
	                                                    <input type="radio" name="tipo_curso_nuevo" value="adr-renovacion"> ADR Renovación
                                                    </div>
                                                </div>
                                                <div class="clear"></div><?php
												if(true)/*current_user_can('administrator'))*/
												{ ?>
													<div class="selector_tipo_curso the_input tipo_cap_inicial" style="display:none;">
                                                        <span>Tipo de curso CAP Inicial:</span>
                                                        <select name="tipo_cap_inicial_curso_nuevo" form="form_update_autoescuela_<?php echo get_the_id(); ?>">
                                                            <option value="" selected="selected">Elige</option>
                                                            <option value="mercancias">Mercancías</option>
                                                            <option value="viajeros">Viajeros</option>
                                                            <option value="mercancias-viajeros">Mercancías / Viajeros</option>
                                                        </select>
                                                    </div>
													<?php /*<div class="selector_tipo_curso the_input tipo_cap_ampliacion" style="display:none;">
                                                        <span>Tipo de curso CAP Ampliación:</span>
                                                        <select name="tipo_cap_ampliacion_curso_nuevo" form="form_update_autoescuela_<?php echo get_the_id(); ?>">
                                                        	<option value="" selected="selected">Elige</option>
                                                            <option value="mercancias">Mercancías</option>
                                                            <option value="viajeros">Viajeros</option>
                                                        </select>
                                                    </div>*/ ?>
													<div class="selector_tipo_curso the_input tipo_adr" style="display:none;">
                                                        <span>Tipo de curso ADR:</span>
                                                        <select name="tipo_adr_curso_nuevo" form="form_update_autoescuela_<?php echo get_the_id(); ?>">
                                                        	<option value="" selected="selected">Elige</option>
                                                            <option value="basico">Básico</option>
                                                            <option value="cisternas">Cisternas</option>
                                                            <option value="basico-cisternas">Básico + Cisternas</option>
                                                            <option value="explosivos">Explosivos</option>
                                                            <option value="radiactivos">Radiactivos</option>
                                                            <option value="otros">Otros (Indicad cuál)</option>
                                                        </select>
                                                        <div class="the_input tipo_adr_texto" style="display:none;">
                                                            <span>Indica tipo de curso ADR:</span> <input type="text" name="tipo_adr_texto_curso_nuevo" />
                                                        </div>
                                                    </div><?php
												} ?>
                                                <?php /*<div class="the_input tipo_adr" style="display:none;">
                                                    <span>Tipo de curso ADR:</span> <input type="text" name="tipo_adr_curso_nuevo" />
                                                </div>*/ ?>
                                                <div class="the_input">
                                                    <span>Horario del curso:</span> <input type="text" name="horario_curso_nuevo" />
                                                </div>
                                                <div class="the_input half_size_left">
                                                    <span>Fecha de inicio:</span> <input type="text" class="elDatePicker" name="fecha_inicio_curso_nuevo" />
                                                </div>
                                                <div class="the_input half_size_right">
                                                    <span>Hora de inicio:</span> <input type="text" name="hora_inicio_curso_nuevo" />
                                                </div>
                                                <div class="the_input half_size_left">
                                                    <span>Fecha de fin:</span> <input type="text" class="elDatePicker" name="fecha_fin_curso_nuevo" />
                                                </div>
                                                <div class="the_input half_size_right">
                                                    <span>Turno:</span>
                                                    <select name="turno_curso_nuevo" form="form_update_autoescuela_<?php echo get_the_id(); ?>">
                                                        <option value="mananas" selected="selected">Mañanas</option>
                                                        <option value="tardes">Tardes</option>
                                                        <option value="findesemana">Fin de semana</option>
                                                    </select>
                                                </div>
                                                <div class="the_input half_size_left">
                                                    <span>Precio:</span> <input type="text" name="precio_curso_nuevo" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="edit_block cursos cursos_actuales">
										<div class="titulo_edicion anadidos">Cursos añadidos:</div><?php
                                        foreach($cursos_actuales as $curso)
                                        { 	
											$categoria=wp_get_post_terms($curso->ID,'tipo-curso'); ?>
                                        	<div class="curso" curso_id="<?php echo $curso->ID; ?>" style="border-color:<?php if(get_field('color_microsite') != ''){ the_field('color_microsite'); }else{ ?>#FF6600<?php } ?>;">
                                            	<div class="gutter">
                                                    <div class="the_input not_full_width radios">
                                                        <p>Tipo de curso:</p>
                                                        <div class="the_subinput">
                                                        	<input type="radio" name="tipo_curso_<?php echo $curso->ID; ?>" value="cap-inicial" <?php if($categoria[0]->slug == 'cap-inicial'){ ?>checked="checked"<?php } ?>> CAP Inicial
                                                        </div>
                                                        <div class="the_subinput">
	                                                        <input type="radio" name="tipo_curso_<?php echo $curso->ID; ?>" value="cap-continua" <?php if($categoria[0]->slug == 'cap-continua'){ ?>checked="checked"<?php } ?>> CAP Continua
                                                        </div>
                                                        <div class="the_subinput">
	                                                        <input type="radio" name="tipo_curso_<?php echo $curso->ID; ?>" value="adr-obtencion" <?php if($categoria[0]->slug == 'adr-obtencion'){ ?>checked="checked"<?php } ?>> ADR Obtención
                                                        </div>
                                                        <div class="the_subinput">
	                                                        <input type="radio" name="tipo_curso_<?php echo $curso->ID; ?>" value="adr-renovacion" <?php if($categoria[0]->slug == 'adr-renovacion'){ ?>checked="checked"<?php } ?>> ADR Renovación
                                                        </div>
                                                    </div>
                                                    <div class="clear"></div>
                                                    <div class="selector_tipo_curso the_input tipo_cap_inicial" <?php if($categoria[0]->slug != 'cap-inicial'){ ?> style="display:none;" <?php } ?>>
                                                        <span>Tipo de curso CAP Inicial:</span>
                                                        <select name="tipo_cap_inicial_curso_<?php echo $curso->ID; ?>" form="form_update_autoescuela_<?php echo get_the_id(); ?>">
                                                            <option value="" <?php if(get_field('tipo_cap_inicial',$curso->ID) == ''){ ?>selected="selected"<?php } ?>>Elige</option>
                                                            <option value="mercancias" <?php if(get_field('tipo_cap_inicial',$curso->ID) == 'mercancias'){ ?>selected="selected"<?php } ?>>Mercancías</option>
                                                            <option value="viajeros" <?php if(get_field('tipo_cap_inicial',$curso->ID) == 'viajeros'){ ?>selected="selected"<?php } ?>>Viajeros</option>
                                                            <option value="mercancias-viajeros" <?php if(get_field('tipo_cap_inicial',$curso->ID) == 'mercancias-viajeros'){ ?>selected="selected"<?php } ?>>Mercancías / Viajeros</option>
                                                        </select>
                                                    </div>
													<?php /*<div class="selector_tipo_curso the_input tipo_cap_ampliacion" style="display:none;">
                                                        <span>Tipo de curso CAP Ampliación:</span>
                                                        <select name="tipo_cap_ampliacion_curso_nuevo" form="form_update_autoescuela_<?php echo get_the_id(); ?>">
                                                        	<option value="" selected="selected">Elige</option>
                                                            <option value="mercancias">Mercancías</option>
                                                            <option value="viajeros">Viajeros</option>
                                                        </select>
                                                    </div>*/ ?>
                                                    <div class="selector_tipo_curso the_input tipo_adr" <?php if($categoria[0]->slug != 'adr-obtencion' && $categoria[0]->slug != 'adr-renovacion'){ ?> style="display:none;" <?php } ?>>
                                                        <span>Tipo de curso ADR:</span>
                                                        <select name="tipo_adr_curso_<?php echo $curso->ID; ?>" form="form_update_autoescuela_<?php echo get_the_id(); ?>">
                                                            <option value="" <?php if(get_field('tipo_adr',$curso->ID) == ''){ ?>selected="selected"<?php } ?>>Elige</option>
                                                            <option value="basico" <?php if(get_field('tipo_adr',$curso->ID) == 'basico'){ ?>selected="selected"<?php } ?>>Básico</option>
                                                            <option value="cisternas" <?php if(get_field('tipo_adr',$curso->ID) == 'cisternas'){ ?>selected="selected"<?php } ?>>Cisternas</option>
                                                            <option value="basico-cisternas" <?php if(get_field('tipo_adr',$curso->ID) == 'basico-cisternas'){ ?>selected="selected"<?php } ?>>Básico + Cisternas</option>
                                                            <option value="explosivos" <?php if(get_field('tipo_adr',$curso->ID) == 'explosivos'){ ?>selected="selected"<?php } ?>>Explosivos</option>
                                                            <option value="radiactivos" <?php if(get_field('tipo_adr',$curso->ID) == 'radiactivos'){ ?>selected="selected"<?php } ?>>Radiactivos</option>
                                                            <option value="otros" <?php if(get_field('tipo_adr',$curso->ID) == 'otros'){ ?>selected="selected"<?php } ?>>Otros (Indicad cuál)</option>
                                                        </select>
														<div class="the_input tipo_adr_texto" <?php if(get_field('tipo_adr_texto',$curso->ID) == ''){ ?> style="display:none;" <?php } ?>>
                                                            <span>Indica tipo de curso ADR:</span> <input type="text" name="tipo_adr_texto_curso_<?php echo $curso->ID; ?>" value="<?php the_field('tipo_adr_texto',$curso->ID); ?>" />
                                                        </div>
                                                    </div>
                                                    <div class="clear"></div>
                                                    <?php /*<div class="the_input tipo_adr">
                                                        <span>Tipo de curso CAP/ADR:</span> <input type="text" name="tipo_adr_curso_<?php echo $curso->ID; ?>" value="<?php the_field('tipo_de_curso',$curso->ID); ?>" />
                                                    </div>*/ ?>
                                                    <div class="the_input">
                                                        <span>Horario del curso:</span> <input type="text" name="horario_curso_<?php echo $curso->ID; ?>" value="<?php the_field('horario_texto',$curso->ID); ?>" />
                                                    </div>
                                                    <div class="the_input half_size_left">
                                                        <span>Fecha de inicio:</span> <input type="text" class="elDatePicker" name="fecha_inicio_curso_<?php echo $curso->ID; ?>" value="<?php echo get_field('fecha_inicio',$curso->ID); ?>" />
                                                    </div>
                                                    <div class="the_input half_size_right">
                                                        <span>Hora de inicio:</span> <input type="text" name="hora_inicio_curso_<?php echo $curso->ID; ?>" value="<?php the_field('hora_inicio',$curso->ID); ?>" />
                                                    </div>
                                                    <div class="the_input half_size_left">
                                                        <span>Fecha de fin:</span> <input type="text" class="elDatePicker" name="fecha_fin_curso_<?php echo $curso->ID; ?>" value="<?php echo get_field('fecha_de_finalizacion',$curso->ID); ?>" />
                                                    </div>
                                                    <div class="the_input half_size_right">
                                                        <span>Turno:</span>
                                                        <select name="turno_curso_<?php echo $curso->ID; ?>" form="form_update_autoescuela_<?php echo get_the_id(); ?>">
                                                            <option value="" <?php if(get_field('horario',$curso->ID)==''){ ?>selected="selected"<?php } ?>>- Elige -</option>
                                                            <option value="mananas" <?php if(get_field('horario',$curso->ID)=='mananas'){ ?>selected="selected"<?php } ?>>Mañanas</option>
                                                            <option value="tardes" <?php if(get_field('horario',$curso->ID)=='tardes'){ ?>selected="selected"<?php } ?>>Tardes</option>
                                                            <option value="findesemana" <?php if(get_field('horario',$curso->ID)=='findesemana'){ ?>selected="selected"<?php } ?>>Fin de semana</option>
                                                        </select>
                                                    </div>
                                                    <div class="the_input half_size_left">
                                                        <span>Precio:</span> <input type="text" name="precio_curso_<?php echo $curso->ID; ?>" value="<?php echo get_post_meta($curso->ID,'_regular_price',true); ?>" />
                                                    </div>
                                                    <div class="the_input clear_only">
														<input type="checkbox" name="eliminar_curso_<?php echo $curso->ID; ?>" value="si"> Eliminar este curso (marcar casilla y pulsar botón "Guardar cambios")
													</div>
                                                </div>
											</div><?php                                            
                                        } ?>
                                    </div>
                                </section>
                            </div>
                        </div>
                    </div>
                    <button class="guardar_cambios" type="submit" style="background-color:<?php if(get_field('color_microsite') != ''){ the_field('color_microsite'); }else{ ?>#FF6600<?php } ?>;"><div>Guardar cambios</div></button>
                </form>
			</div><?php 
		}
		get_footer('microsite');
	}
	else
	{
		wp_redirect(get_permalink(get_the_id()));
	}
}
else
{
	wp_redirect(get_permalink(get_the_id()));
>>>>>>> 778c166765337ab116d0bec5c5809e5ece91be4d
}