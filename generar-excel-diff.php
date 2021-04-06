<?php

require('../../../wp-load.php');

header('Content-type: application/vnd.ms-excel;charset=iso-8859-15');
header('Content-Disposition: attachment; filename=webcentrosDIFF.xls');

if(file_exists('/var/www/vhosts/academiadeltransportista.com/httpdocs/wp-content/plugins/at-importer/webcentros_021219_7.txt'))
{
	$texto=file_get_contents('/var/www/vhosts/academiadeltransportista.com/httpdocs/wp-content/plugins/at-importer/webcentros_021219_7.txt');
	/* Dividimos por páginas */
	$paginas=explode('CENTROS AUTORIZADOS PARA IMPARTICION DE CURSOS DEL CAP',$texto);
	$salida=''; ?>
    <table border="1" cellpadding="2" cellspacing="0" width="100%">
		<tr>
            <td>Nombre:</td>
            <td>Domicilio:</td>
            <td>Poblaci&oacute;n:</td>
            <td>Cg Postal:</td>
            <td>Tel&eacute;fono:</td>
        </tr><?php
		foreach($paginas as $pagina)
		{
			if($pagina != '')
			{
				/*print_r($pagina);*/
				$textos_sobrantes=array('Distribución por Comunidad Autónoma y Provincia','Ministerio de Fomento','Fecha: 02-12-2019');
				$pagina=str_replace($textos_sobrantes,'',$pagina);
				
				/* Sacamos los teléfonos porque salen todos al final */
				$telefonos=array();
				preg_match_all('!\d+!', $pagina, $numeros);
				foreach($numeros[0] as $numero)
				{
					if(strlen(trim($numero)) == 9)
					{
						$telefonos[]=trim($numero);
					}
				}
				/* Todos los cursos a checkear */
				/*$cursos_seleccionados_autoescuela=array('curso-obtencion-camion-c','curso-obtencion-carnet-trailer-c-e','curso-obtencion-carnet-autobus-d','curso-obtencion-carnet-remolque-b-e','curso-obtencion-carnet-coche-b','curso-obtencion-carnet-moto-a');
				$cursos_seleccionados_transporte=array('curso-renovacion-del-cap','curso-obtencion-cap-inicial','curso-obtencion-mercancias-peligrosas','curso-renovacion-adr','curso-obtencion-titulo-de-transportista','curso-consejero-de-seguridad-adr');
				$cursos_seleccionados_mas=array('curso-de-carretillas-elevadoras','curso-grua-camion-pluma','une-12195-sujecion-de-cargas-y-estiba','curso-tacografo-digital','cursos-de-logistica','curso-de-seguridad-vial-laboral');*/
				/* Dividimos los centros */
				$centros=explode('Nombre',$pagina);
				unset($centros[0]);
				$contador_telefonos=0;
				foreach($centros as $centro)
				{ 
					$explode_centro_1=explode('Domicilio',$centro);
					$nombre=trim($explode_centro_1[0]);
					$explode_centro_2=explode('Población',$explode_centro_1[1]);
					$direccion=trim($explode_centro_2[0]);
					$explode_centro_3=explode('Cg Postal',$explode_centro_2[1]);
					$poblacion=trim($explode_centro_3[0]);
					$codigo_postal=substr(trim($explode_centro_3[1]),0,5);
					$codigo_postal=trim($codigo_postal);
					if(count($telefonos)==7)
					{
						$telefono=$telefonos[$contador_telefonos];
					}
					else
					{
						$telefono='';
					}
					
					/* Introducimos centro */
					/*$address=$direccion.', '.$poblacion;
					$address=str_replace(' ','+',$address);
					$curl = curl_init();
						curl_setopt($curl, CURLOPT_URL, 'https://maps.googleapis.com/maps/api/geocode/json?key=AIzaSyBP9OVPkIgTmQhuMr5kdT7JNHBEmv7cuLU&address='.$address);
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
					$address_components=$output->results[0]->address_components;
					
					foreach($address_components as $address_component)
					{
						if($address_component->types[0] == 'locality')
						{
							$municipio_texto=$address_component->long_name;
						}
						elseif($address_component->types[0] == 'administrative_area_level_2' || $address_component->types[0] == 'archipelago')
						{
							$provincia_texto=$address_component->long_name;
						}
					}*/
					
					$centro_existe=get_posts(array(
						'post_type' => 'autoescuela',
						's' => $nombre
					));
					if(!$centro_existe)
					{ ?>
                        <tr>
                            <td><?php echo htmlentities($nombre); ?></td>
                            <td><?php echo htmlentities($direccion); ?></td>
                            <td><?php echo htmlentities($poblacion); ?></td>
                            <td><?php echo $codigo_postal; ?></td>
                            <td><?php echo $telefono; ?></td>
                        </tr><?php 
					}
					
					$contador_telefonos++;
				}
			}
		} ?>
    </table><?php
} ?>