<?php

/*$prices=custom_get_filtered_price();
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
}*/

//Metemos el precio máximo en un json para luego usarlo en el js del slider  ?>
<?php /*<script>
	var price_range = <?php echo json_encode($price_range); ?>;
	var selected_date = <?php echo json_encode($selected_date); ?>;
	var selected_date_value = <?php echo json_encode($_GET['fecha']); ?>;
	var selected_end_date = <?php echo json_encode($selected_end_date); ?>;
	var selected_end_date_value = <?php echo json_encode($_GET['fecha_fin']); ?>;
</script>*/ ?>
<div class="buscador_principal"><h2><?php the_field('SearchMainTitle'); ?></h2><?php
	if(strpos(get_page_template_slug(),'cursos-ciudades'))
	{ ?>
		<span class="search_resuts_count">Busca tu próximo curso aquí</span><?php
	} ?>
    <form class="main_search_form" method="get" action="<?php echo get_permalink(97); ?>">
    	<div class="content-grid-form">
        	<div class="elemento">
            	<input type="hidden" value="" id="s" name="s">
				<input type="hidden" value="y" id="bkat" name="bkat">
                <input type="hidden" value="<?php echo $_GET['direccion_c']; ?>" id="direccion_c" name="direccion_c">
				<input type="hidden" value="<?php echo $_GET['places_locality']; ?>" id="places_locality" name="places_locality">
                <input type="hidden" value="<?php echo $_GET['provincia']; ?>" id="provincia" name="provincia">
                <input type="hidden" value="<?php echo $_GET['places_locality_lat']; ?>" id="places_locality_lat" name="places_locality_lat">
                <input type="hidden" value="<?php echo $_GET['places_locality_lng']; ?>" id="places_locality_lng" name="places_locality_lng">
				<input type="text" id="pac-input" class="controls animated fadeIn" <?php if($_GET['direccion_c'] == ''){ ?>placeholder="Escribe tu ciudad aquí"<?php }else{ ?>placeholder="<?php echo $_GET['direccion_c'] ?>"<?php } ?> />
			</div>
			<div class="elemento">
				<select id="tipo_curso" name="tipo_curso">
                	<option value="" disabled>Tipo de curso</option>
                    <option value="29" selected="selected">CAP continua</option>
                    <option value="28">CAP inicial</option>
                    <option value="30">ADR obtención</option>
                    <option value="31">ADR renovación</option>
                </select>
			</div>
            <button type="submit" class="button" id="boton_buscar"><?php _e( 'Encontrar cursos', 'academiatransportista' ); ?> <img class="spinner" src="<?php echo get_bloginfo('stylesheet_directory'); ?>/img/spinner.gif" /></button>
        </div>
    </form>
</div>