<?php

$prices=custom_get_filtered_price();
$min = floor( $prices->min_price );
$max = ceil( $prices->max_price );
$current_min = isset( $_GET['min_price'] ) ? wc_clean( wp_unslash( $_GET['min_price'] ) ) : apply_filters( 'woocommerce_price_filter_widget_min_amount', $min );
$current_max = isset( $_GET['max_price'] ) ? wc_clean( wp_unslash( $_GET['max_price'] ) ) : apply_filters( 'woocommerce_price_filter_widget_max_amount', $max );
$min_price=apply_filters( 'woocommerce_price_filter_widget_min_amount', $min );
$max_price=apply_filters( 'woocommerce_price_filter_widget_max_amount', $max );

$price_range=array('min_price' => $min_price,'max_price' => $max_price,'current_min' => $current_min,'current_max' => $current_max);

if($_GET['fecha'])
{
	$selected_date=date('j F, Y',strtotime($_GET['fecha']));
	$selected_date=traduccion_fecha($selected_date);
}
else
{
	$selected_date='';
}
if($_GET['fecha_fin'])
{
	$selected_end_date=date('j F, Y',strtotime($_GET['fecha_fin']));
	$selected_end_date=traduccion_fecha($selected_end_date);
}
else
{
	$selected_end_date='';
}

//Metemos el precio máximo en un json para luego usarlo en el js del slider ?>
<script>
	var price_range = <?php echo json_encode($price_range); ?>;
	var selected_date = <?php echo json_encode($selected_date); ?>;
	var selected_date_value = <?php echo json_encode($_GET['fecha']); ?>;
	var selected_end_date = <?php echo json_encode($selected_end_date); ?>;
	var selected_end_date_value = <?php echo json_encode($_GET['fecha_fin']); ?>;
</script>
<div class="buscador_principal"><?php
	/*if($_GET['bkat']=='y')
	{
		$total=wc_get_loop_prop('total');
		if($total > 0)
		{ ?>
			<span class="search_resuts_count"><?php printf('Hemos encontrado %d cursos con esta búsqueda', $total); ?></span><?php
		}
		else
		{ ?>
			<span class="search_resuts_count"><?php printf('Has buscado:', $total); ?></span><?php
		}
	}
	else*/if(strpos(get_page_template_slug(),'cursos-ciudades'))
	{ ?>
		<span class="search_resuts_count">Busca tu próximo curso aquí</span><?php
	} ?>
    <form method="get" action="<?php echo get_permalink(97); ?>"><?php
		if(false)/*current_user_can('administrator'))*/
		{ ?>
        	<select id="tipo_curso" name="tipo_curso">
	            <option value="29" selected="selected">CAP continua</option>
    	        <option value="28">CAP inicial</option>
            	<option value="30">ADR obtención</option>
                <option value="31">ADR renovación</option>
            </select><?php
		} ?>
        <div class="elemento">
            <input type="hidden" value="" id="s" name="s">
            <input type="hidden" value="y" id="bkat" name="bkat">
            <input type="hidden" value="<?php echo $_GET['direccion_c']; ?>" id="direccion_c" name="direccion_c">
            <input type="hidden" value="<?php echo $_GET['provincia']; ?>" id="provincia" name="provincia">
			<input type="text" id="pac-input" class="controls" <?php if($_GET['direccion_c'] == ''){ ?>placeholder="¿Dónde?"<?php }else{ ?>placeholder="<?php echo $_GET['direccion_c'] ?>"<?php } ?> />
            <?php /*$provincias=get_provincias_activas(); ?>
            <select name="cercania">
                <option value="" disabled selected>Provincia</option><?php
                foreach($provincias as $provincia)
                {
                    foreach($provincia as $codigo => $nombre)
                    { ?>
                        <option value="<?php echo $codigo; ?>" <?php if($_GET['cercania'] == $codigo){ ?>selected="selected"<?php } ?>><?php echo $nombre; ?></option><?php
                    }
                } ?>
            </select>*/ ?>
        </div>
        <?php /*<div class="elemento precio ui-state-default">
            <span class="ui-icon ui-icon-plus"></span>
            <input type="text" id="amount" readonly>
            <input type="hidden" value="" id="min_price" name="min_price">
            <input type="hidden" value="" id="max_price" name="max_price">
            <div class="slider_container" style="display:none;">
                <div id="slider-range"></div>
            </div>
        </div>*/
		if(!is_front_page())
		{ ?>
            <div class="elemento">
                <select id="tipo_curso" name="tipo_curso">
                	<option value="" disabled>Tipo de curso</option>
                    <option value="29" <?php if($_GET['tipo_curso'] == '29'){ ?>selected="selected"<?php } ?>>CAP continua</option>
                    <option value="28" <?php if($_GET['tipo_curso'] == '28'){ ?>selected="selected"<?php } ?>>CAP inicial</option>
                    <option value="30" <?php if($_GET['tipo_curso'] == '30'){ ?>selected="selected"<?php } ?>>ADR obtención</option>
                    <option value="31" <?php if($_GET['tipo_curso'] == '31'){ ?>selected="selected"<?php } ?>>ADR renovación</option>
                </select>
            </div><?php
		} ?>
        <div class="elemento">
            <select name="horario">
                <option value="" disabled selected>Turno</option>
                <option value="findesemana" <?php if($_GET['horario'] == 'findesemana'){ ?>selected="selected"<?php } ?>>Fin de semana</option>
                <option value="mananas" <?php if($_GET['horario'] == 'mananas'){ ?>selected="selected"<?php } ?>>Mañanas</option>
                <option value="tardes" <?php if($_GET['horario'] == 'tardes'){ ?>selected="selected"<?php } ?>>Tardes</option>
            </select>
        </div>
        <div class="elemento fecha ui-state-default">
            <!-- <span class="ui-icon ui-icon-plus"></span> -->
            <input type="text" id="datepicker">
            <input type="hidden" id="fechaalt" name="fecha">
        </div>
        <div class="elemento fecha ui-state-default">
        	<!-- <span class="ui-icon ui-icon-plus plus_end"></span> -->
            <input type="text" id="datepicker_end">
            <input type="hidden" id="fechafinalt" name="fecha_fin">
        </div>
        <div class="elemento">
	        <button type="submit" class="button" id="boton_buscar"><?php _e( 'Encontrar cursos', 'academiatransportista' ); ?> <img class="spinner" src="<?php echo get_bloginfo('stylesheet_directory'); ?>/img/spinner.gif" /></button>
        </div>
    </form>
</div>
