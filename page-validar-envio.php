<?php get_header();

if($_POST)
{
	/* Estamos recibiendo callback de Twilio */
	if($_POST['EventType']=='UNDELIVERED')
	{
		/* Si el WhatsApp ha dado error, enviamos por email. */
		global $wpdb;
		$wpdb->update($wpdb->prefix.'envios_distribucion_leads',array('whatsapp-error' => 'si'),array('MessageSid' => $_POST['MessageSid']));
		$envio=$wpdb->get_results('SELECT * FROM '.$wpdb->prefix.'envios_distribucion_leads WHERE MessageSid = "'.$id_envio.'"',ARRAY_A);
		$datos=$envio[0];
		$email=wp_mail($datos['email_autoescuela'],'Hay una persona interesada en tu curso',"¡Enhorabuena!
		
		Tienes una persona interesada esperando a que le informes. Puedes descargar sus datos en tu espacio privado: ".add_query_arg(array('envio' => $datos['ID'].rand(10,99).'_'.$datos['id_autoescuela'].rand(10,99).'_'.$datos['id_producto'].rand(10,99)),get_permalink(72390)).". ¡Ponte en contacto cuanto antes!
		
		Un saludo");
		if($email)
		{
			global $wpdb;
			$wpdb->update($wpdb->prefix.'envios_distribucion_leads',array('enviado-por-email' => 'si'),array('ID' => $datos['ID']));
		}
	}
}
elseif($_GET['envio'] != '')
{
	$trozos_envio=explode('_',$_GET['envio']);
	$id_envio=substr($trozos_envio[0],0,-2);
	$id_centro=substr($trozos_envio[1],0,-2);
	$id_curso=substr($trozos_envio[2],0,-2);
	
	global $wpdb;
	$results = $wpdb->get_results('SELECT * FROM '.$wpdb->prefix.'envios_distribucion_leads WHERE ID = '.$id_envio.' AND id_autoescuela = '.$id_centro.' AND id_producto = '.$id_curso,ARRAY_A); ?>
	<div class="container ThanksMessage">
		<div class="column_attr">
			<p class="encabezado-business">Academia del transportista</p>
			<div class="BlockThanksP">
				<p>Gracias por contactar con<br /> Academia del Transportista</p><?php
				if($results)
				{
					$result=$results[0]; ?>
					<p><?php
						if($result['revisado']=='si')
						{ 
							echo 'Esta gestión ya fue confirmada por el centro.';
						}
						elseif($result['revisado']=='no')
						{
							/* MIRAMOS SI EL ENVÍO FUE POR MAIL O POR WHATSAPP Y LO ENVIAMOS POR EL MISMO CANAL */
							if($result['enviado-por-email'] == 'no')
							{
								if(function_exists('send_whatsapp'))
								{
									$message=send_whatsapp('segundo',$result['ID'],$result);
									global $wpdb;
									$wpdb->update($wpdb->prefix.'envios_distribucion_leads',array('MessageSid' => $message->sid),array('ID' => $envio_id));
								}
							}
							else
							{
								wp_mail($result['email_autoescuela'],'Datos de la persona interesada en tu curso',"Tu solicitud se ha gestionado correctamente. Incluimos en este mensaje los datos de la persona interesada.

Curso: ".$result['nombre_curso']." - Centro: ".$result['nombre_autoescuela']." - Fecha de inicio: ".$result['fecha_inicio']." - Fecha de fin: ".$result['fecha_fin']." - Horario: ".$result['horario']." - Nombre: ".$result['nombre_persona']." - Email: ".$result['email_persona']." - Teléfono: ".$result['telefono_persona']."

Seguiremos ayudándote a dar el impulso que quieres para tu autoescuela o centro de formación.

Un saludo");
							}
							/* ENVÍO A CONTABILIDAD DE AT */
							if(function_exists('pipedrive_person_exists'))
							{
								$check_person=pipedrive_person_exists($result['email_persona']);
							}
							if(is_numeric($check_person))
							{
								$pipedrive_person=$check_person;
							}
							else
							{
								$autoescuela=get_field('autoescuela',$id_curso);
								$autoescuela=$autoescuela[0];
								$provincia=get_field('provincia',$autoescuela);
								$ciudad=get_field('municipios_'.$provincia['value'],$autoescuela);
								$mapa=get_field('mapa',$autoescuela);
								if(function_exists('get_google_place'))
								{
									$sitio=get_google_place($mapa['address']);
									foreach($sitio->results[0]->address_components as $component)
									{
										if($component->types[0] == 'postal_code')
										{
											$codigo_postal=$component->long_name;
										}
									}
								}
								$person = array(
									'owner_id' => 11500110, /* Contabilidad */
									'email' => $result['email_persona'],
									'd7bfacec93ff6d77000751fc01145d1d0072a0c2' => 'El centro ha confirmado que se encarga del lead: '.$texto.$datos_cliente, /* Origen */
									'8dccd43ddda46b688abdbc792eba846f3b369394' => $provincia['value'], /* Provincia */
									'48c4819b116129dcf447617168266432f8d661d2' => $ciudad['label'], /* Localidad */
									'6983980680ede127d8bf6fe03418c33c1bfd8588' => $codigo_postal /* Código Postal */
								);
								if($result['nombre_persona'] != '')
								{
									$person['name']=$result['nombre_persona'];
								}
								else
								{
									$person['name']=$result['email_persona'];
								}
								if($result['telefono_persona'] != '')
								{
									$person['phone']=$result['telefono_persona'];
								}
								if(function_exists('add_pipedrive_element'))
								{
									$pipedrive_person=add_pipedrive_element($person);
								}
							}
							$activity = array(
								'subject' => 'PARA FACTURAR',
								'type' => 'Tarea',
								'note' => 'El centro ha confirmado que se encarga del lead: '.$texto.$datos_cliente,
								'user_id' => 11500110,
								'person_id' => $pipedrive_person
							);
							if(function_exists('add_pipedrive_element'))
							{
								$pipedrive_activity=add_pipedrive_element($activity);
							}
							
							$wpdb->update($wpdb->prefix.'envios_distribucion_leads',array('revisado'=>'si'),array('ID' => $result['ID']));
							if($result['enviado-por-email'] == 'no')
							{
								echo 'Gracias por confirmar la gestión del cliente. En breve el centro recibirá un mensaje de WhatsApp al número de teléfono registrado con los datos del cliente interesado.';
							}
							else
							{
								echo 'Gracias por confirmar la gestión del cliente. En breve el centro recibirá un mensaje a la dirección de email registrada con los datos del cliente interesado.';
							}
						} ?>
					</p><?php
				}
				else
				{
					echo '<p>Lo sentimos, no existe este envío.</p>';
				} ?>
				<a class="HomePageLink" href="/">Academia del Transportista</a>
			</div>
		</div>
	</div><?php
}
get_footer();