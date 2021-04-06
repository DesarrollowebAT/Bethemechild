<?php
require('../../../wp-load.php');

if($_GET['id_valoracion'] || $_POST['id_valoracion'])
{
	/* Es un "me gusta" */
	if($_GET['id_valoracion'])
	{
		$usuario=$_GET['usuario'];
		$id_valoracion=$_GET['id_valoracion'];
	}
	elseif($_POST['id_valoracion'])
	{
		$usuario=$_POST['usuario'];
		$id_valoracion=$_POST['id_valoracion'];
	}
	$id_valoracion=explode('_',$id_valoracion);
	$centro=$id_valoracion[0];
	$valoracion=$id_valoracion[1];
	
	$fila=array(
		'usuario' => $usuario
	);
	
	if(add_sub_row(array('votos',$valoracion,'likes'),$fila,$centro))
	{
		$datos['success'] = true;
		$datos['message'] = 'El voto se ha registrado correctamente.';
		$votos=get_field('votos',$centro);
		$datos['num_likes'] = count(array_filter($votos[$valoracion-1]['likes']));
	}
	
	echo json_encode($datos);
}
else
{
	/* Es una valoración */
	if($_GET['centro'])
	{
		$centro=$_GET['centro'];
		$usuario=$_GET['usuario'];
		$puntuacion=$_GET['puntuacion'];
		$comentario=$_GET['comentario'];
		$fecha=$_GET['fecha'];
	}
	elseif($_POST['centro'])
	{
		$centro=$_POST['centro'];
		$usuario=$_POST['usuario'];
		$puntuacion=$_POST['puntuacion'];
		$comentario=$_POST['comentario'];
		$fecha=$_POST['fecha'];
	}
	
	$datos=array();
	
	if(is_numeric($centro))
	{
		if(is_numeric($usuario))
		{
			if(is_numeric($puntuacion))
			{
				$votos_actuales=get_field('votos',$centro);
				$duplicado=false;
				
				foreach($votos_actuales as $voto)
				{
					if($voto['usuario']['ID'] == $usuario)
					{
						$duplicado=true;
					}
				}
				
				if(true)/*!$duplicado)*/
				{	
					$nuevo_voto=count($votos_actuales)+1;
					$fila=array(
						'id_voto' => $centro.'_'.$nuevo_voto,
						'usuario' => $usuario,
						'puntuacion' => $puntuacion,
						'comentario' => $comentario,
						'fecha' => $fecha
					);
					if(add_row('votos',$fila,$centro))
					{
						$datos['success'] = true;
						$datos['message'] = 'El voto se ha registrado correctamente.';
						
						$el_usuario=get_user_by('ID',$usuario);
						$fila['usuario']=$el_usuario->data->user_email;
						
						$response = wp_remote_post(	'https://ecodriver.at/wp-json/eco_rest_api/sincronizar_valoraciones/', array(
							'method' => 'POST',
							'headers' => array('Content-type:application/x-www-form-urlencoded'),
							'body' => $fila
						));
					}
					else
					{
						$datos['success'] = false;
						$datos['message'] = 'El voto no ha sido registrado. Inténtelo de nuevo más tarde.';
					}
				}
				else
				{
					$datos['success'] = false;
					$datos['message'] = 'Ya has votado a este centro.';
				}
			}
			else
			{
				$datos['success'] = false;
				$datos['message'] = 'La puntuación no es válida.';
			}
		}
		else
		{
			$datos['success'] = false;
			$datos['message'] = 'El usuario no es válido.';
		}
	}
	else
	{
		$datos['success'] = false;
		$datos['message'] = 'El centro no es válido.';
	}
	
	echo json_encode($datos);
} ?>