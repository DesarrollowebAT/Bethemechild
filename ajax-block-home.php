<?php
require('../../../wp-load.php');

/*if(get_current_user_id() == 6)
{
	$la_ip='90.174.2.4';
	$detection=geoip_detect2_get_info_from_ip($la_ip);
	print_r($detection);die;
}*/

$centros_en_radio=get_centros_en_radio();

if(count($centros_en_radio) < 3)
{
	$centros_en_radio=get_centros_en_radio(100);
}
	
if(count($centros_en_radio) >= 3)
{
	$centros_sin_plan=array();
	$centros_bronce=array();
	$centros_plata=array();
	$centros_oro=array();
	foreach($centros_en_radio as $centro_en_radio)
	{
    
        $level = get_microsite_level($centro_en_radio);
      
		if($level == 'pro')
		{
			array_push($centros_bronce,$centro_en_radio);
		}
		elseif($level == 'premium')
		{
			array_push($centros_plata,$centro_en_radio);
		}
		elseif($level == 'exclusive')
		{
			array_push($centros_oro,$centro_en_radio);
		}
		else
		{
			array_push($centros_sin_plan,$centro_en_radio);
		}
	}
	
	$centros_a_mostrar=array();
	
	if(count($centros_oro) > 1 && count($centros_plata) >= 1)
	{
		array_push($centros_a_mostrar,$centros_oro[0]);
		array_push($centros_a_mostrar,$centros_oro[1]);
		array_push($centros_a_mostrar,$centros_plata[0]);
	}
	elseif(count($centros_oro) == 1 && count($centros_plata) > 1)
	{
		array_push($centros_a_mostrar,$centros_oro[0]);
		array_push($centros_a_mostrar,$centros_plata[0]);
		array_push($centros_a_mostrar,$centros_plata[1]);
	}
	elseif(count($centros_oro) >= 3 && count($centros_plata) == 0)
	{
		array_push($centros_a_mostrar,$centros_oro[0]);
		array_push($centros_a_mostrar,$centros_oro[1]);
		array_push($centros_a_mostrar,$centros_oro[2]);
	}
	elseif(count($centros_oro) == 0 && count($centros_plata) >= 3)
	{
		array_push($centros_a_mostrar,$centros_plata[0]);
		array_push($centros_a_mostrar,$centros_plata[1]);
		array_push($centros_a_mostrar,$centros_plata[2]);
	}
	elseif( (count($centros_oro) + count($centros_plata)) < 3 )
	{
		$centros_a_mostrar=array_merge($centros_oro,$centros_plata,$centros_bronce,$centros_sin_plan);
		$centros_a_mostrar=array_slice($centros_a_mostrar,0,3);
	}
	$datos=array();
	
	$html_return='';
	/*$html_return.='<div class="MainTitlesCAPSearch">'.__('Estas son las autoescuelas que recomendamos para ti','bkat').'</div>';*/
	$html_return.='<div class="contentGridMainCourse MainCourseGrid">';
		foreach($centros_a_mostrar as $centro_a_mostrar)
		{ 
			$centro_nivel=get_microsite_level($centro_a_mostrar);
        	$html_return.='<div class="item ItemMainCourse centro-tipo-'.$centro_nivel.'"><div class="inner_container">';
				if($centro_nivel == 'exclusive')
				{
					$html_return.='<div class="icono_pulgar autoescuela_oro">
						<img src="'.get_bloginfo('stylesheet_directory').'/img/icono-autoescuela-oro.svg" title="">
                        <div class="description">Este centro está calificado como <span>Autoescuela ORO</span></div>
                    </div>';
				}
				elseif($centro_nivel == 'premium')
				{ 
            		$html_return.='<div class="icono_pulgar autoescuela_plata">
						<img src="'.get_bloginfo('stylesheet_directory').'/img/icono-autoescuela-plata.svg" title="">
                        <div class="description">Este centro está calificado como <span>Autoescuela PLATA</span></div>
                    </div>';
				}
                $html_return.='<div class="logo"><img src="'.get_the_post_thumbnail_url($centro_a_mostrar).'" /></div>';
				if(true)/*get_current_user_id() == 6)*/
				{
					$html_return.='<div class="nota"><div class="nota_autoescuela">'.get_star_rating_html($centro_a_mostrar->ID).'</div></div>';
				}
				else
				{
                	$html_return.='<div class="nota">'.build_nota_block_html(get_nota_post($centro_a_mostrar->ID)).'</div>';
				}
                $html_return.='<div class="post_title">'.$centro_a_mostrar->post_title.'</div>';
                $provincia=get_field('provincia',$centro_a_mostrar);
                $municipio=get_field('municipios_'.$provincia['value'],$centro_a_mostrar);
                if($provincia['label']!='' || $municipio['label']!='')
                { 
                    $html_return.='<p class="ubicacion">';
                        if($provincia['label']!='' && !is_numeric($municipio['label']))
                        { 
                            $html_return.='<span>'.$provincia['label'].' | </span> ';
                        }
                        else
                        { 
                            $html_return.='<span>'.get_field('provincia_texto',$centro_a_mostrar).' | </span> ';
                        }
                        if($municipio['label']!='' && !is_numeric($municipio['label']))
                        {
                            $html_return.=$municipio['label'];
                        }
                        else
                        {
                            $html_return.=get_field('municipio_texto',$centro_a_mostrar);
                        }
                    $html_return.='</p>';
                    if(get_field('horario',$centro_a_mostrar)!='')
                    { 
                        $html_return.='<p class="horario"><span>Horario:</span> '.get_field('horario',$centro_a_mostrar).'</p>';
                    }
                }
				$html_return.='<a class="ver_autoescuela" href="'.get_permalink($centro_a_mostrar).'">Ver centro</a>';
            $html_return.='</div></div>';
		}
	$html_return.='</div>';
}

$datos=array(
	'html_data' => $html_return
);

echo json_encode($datos);