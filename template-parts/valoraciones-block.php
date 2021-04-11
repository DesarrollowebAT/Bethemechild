<?php

if(is_singular('autoescuela'))
{
	/*$votos=get_field('votos',get_the_id());*/
	if($todas_las_valoraciones=='si')
	{
		$votos_totales=get_field('votos');
		$votos=array();
		foreach($votos_totales as $voto)
		{
			if($voto['comentario'] != '')
			$votos[]=$voto;
		}
	}
	else
	{
		$votos=get_opiniones_destacadas();
	}
	
	if($votos)
	{ ?>
		<section class="valoraciones section_wrapper mcb-section-inner">
			<div class="titulo_2" <?php if($todas_las_valoraciones=='si'){ ?> style="margin-top:4rem;" <?php } ?>><?php _e('Opiniones de usuarios'); ?></div><?php
			if($todas_las_valoraciones=='si')
			{
				if(puede_opinar(get_current_user_id(),get_the_id()) || get_current_user_id() == 6 || get_current_user_id() == 4)
				{ ?>
					<a href="#" class="boton_escribir_valoracion">Escribir valoración</a><?php
				}
			}
			$i=1;
			foreach($votos as $voto)
			{
				set_query_var( 'voto', $voto );
                get_template_part('template-parts/valoracion');
			}
			/*if($todas_las_valoraciones!='si')
			{
				if(puede_opinar(get_current_user_id(),get_the_id()) || get_current_user_id() == 6)
				{ ?>
					<a href="#" class="enlace_escribir_opinion">Escribir valoración</a><?php
				}
			}*/
			if(/*(count(get_field('votos',get_the_id())) > 3) && */($todas_las_valoraciones!='si'))
			{ ?>
            	<a href="<?php echo add_query_arg('val','y',get_permalink()); ?>" style="color:<?php echo $color_microsite; ?>" class="mas_valoraciones"><?php 
					_e('Ver todas las valoraciones','academiadeltransportista'); ?> <span class="flip_horizontal"><?php echo file_get_contents(get_stylesheet_directory().'/img/flecha_izq.svg'); ?></span>
                </a><?php
			} ?>
		</section><?php
	}
	else
	{
		if(puede_opinar(get_current_user_id(),get_the_id()) || get_current_user_id() == 6 || get_current_user_id() == 4)
		{ ?>
        	<div class="titulo_2"><?php _e('Opiniones de usuarios','academiadeltransportista'); ?></div>
			<a href="#" class="boton_escribir_valoracion primera"><?php _e('Sé el primero en opinar.','academiadeltransportista'); ?></a><?php
		}
	}
} ?>