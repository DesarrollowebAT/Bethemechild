<div class="valoracion" id_valoracion="<?php echo $voto['id_voto']; ?>">
    <div class="header_valoraciones">
        <p class="nombre_fecha_valoracion">
            <span class="nombre"><?php
                $nombre=$voto['usuario']['user_firstname'].' '.$voto['usuario']['user_lastname'];
                /*if($voto['usuario'] == )*/
                if(trim($nombre) != '')
                {
                    echo $nombre.' | ';
                }
                else
                {
                    if($voto['usuario']['display_name'] != 'acadamin')
                    {
                        echo $voto['usuario']['display_name'].' | ';
                    }
                } ?>
            </span>
            <span class="fecha"><?php echo $voto['fecha']; ?></span>
        </p>
        <div class="valoracion_valoracion">
            <?php get_star_rating(0,$voto['id_voto']); ?> <span class="numero_valoracion"><?php echo $voto['puntuacion']; ?></span> | <span class="texto_valoracion"><?php switch($voto['puntuacion']){ case 1: echo 'No recomendado'; break; case 2: echo 'Regular'; break; case 3: echo 'Bien'; break; case 4: echo 'Sobresaliente'; break; case 5: echo 'Excelente'; break; } ?></span>
        </div>
    </div>
    <div class="body_valoraciones"><?php 
        echo $voto['comentario']; ?>
    </div>
    <div class="valoracion_me_gusta"><?php 
		$puede_likear=true;
		$ya_likeado=false;
		if(is_user_logged_in())
		{
			foreach($voto['likes'] as $like)
			{
				if(get_current_user_id() == $like['usuario']['ID'])
				{
					/* No se puede likear dos veces */
					$ya_likeado=true;
					$puede_likear=false;
				}
			}
		}
		else
		{
			/* No puede likear sin estar logueado */
			$puede_likear=false;
		}
		if(get_current_user_id()==6 || get_current_user_id()==4){ $puede_likear=true; }
		if($puede_likear)
		{
			$numero_likes=count(array_filter($voto['likes']));
			if($numero_likes == 0)
			{ ?>
				<a href="#" class="me_gusta" id_usuario="<?php echo get_current_user_id(); ?>"><?php echo file_get_contents(get_stylesheet_directory().'/img/thumb_up.svg'); _e('Me gusta','academiadeltransportista'); ?></a><?php
			}
			else
			{ ?>
				<a href="#" class="me_gusta" id_usuario="<?php echo get_current_user_id(); ?>"><?php echo file_get_contents(get_stylesheet_directory().'/img/thumb_up.svg'); echo $numero_likes; ?></a><?php			
			}
		}
		else
		{
			$numero_likes=count(array_filter($voto['likes']));
			if($numero_likes == 0)
			{
			}
			else
			{ ?>
				<span href="#" class="me_gusta_disabled <?php if($ya_likeado){ ?>voted<?php } ?>"><?php echo file_get_contents(get_stylesheet_directory().'/img/thumb_up.svg'); echo $numero_likes; ?></span><?php
			}
		} ?>
    </div>
</div>