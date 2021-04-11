<?php 
	$params=explode('?',$_SERVER['REQUEST_URI']);
	$params=$params[1];
	$url_actual_sin_paged=get_permalink( woocommerce_get_page_id( 'shop' ) ).'?'.$params;
	$user=wp_get_current_user();
?>
<div class="sorter map-pc<?php /*-bkat_2019*/ ?>">
	<span class="title">Ordena los resultados:</span>
    <a class="cercania <?php if($_GET['orderby'] == 'cercania'){ ?>active<?php } ?>" href="<?php echo add_query_arg('orderby','cercania',$url_actual_sin_paged); ?>">Cercanía</a>
    <a class="economicos <?php if($_GET['orderby'] == 'price_'){ ?>active<?php } ?>" href="<?php echo add_query_arg('orderby','price_',$url_actual_sin_paged); ?>">Los más económicos</a>
    <div class="enlace_con_desplegable">
        <a href="#" class="horario <?php if($_GET['orderby'] == 'horario-m' || $_GET['orderby'] == 'horario-t' || $_GET['orderby'] == 'horario-f'){ ?>active<?php } ?>">Turno</a>
        <div class="desp">
            <a <?php if($_GET['orderby'] == 'horario-m'){ ?>class="active"<?php } ?> href="<?php echo add_query_arg('orderby','horario-m',$url_actual_sin_paged); ?>">Turno mañanas</a>
            
            <a <?php if($_GET['orderby'] == 'horario-t'){ ?>class="active"<?php } ?> href="<?php echo add_query_arg('orderby','horario-t',$url_actual_sin_paged); ?>">Turno tardes</a>
            <a <?php if($_GET['orderby'] == 'horario-f'){ ?>class="active"<?php } ?> href="<?php echo add_query_arg('orderby','horario-f',$url_actual_sin_paged); ?>">Turno fines de semana</a>
        </div>
    </div>
    <a class="fecha-inicio <?php if($_GET['orderby'] == 'fecha-inicio'){ ?>active<?php } ?>" href="<?php echo add_query_arg('orderby','fecha-inicio',$url_actual_sin_paged); ?>">Fecha de inicio</a>
</div>

<?php 

if($user->data->ID!=6)
{ ?>
    <div class="map-movil">
        <button class="accordion2">Ordena los resultados</button>
        <div class="sorter panel2">
            <a class="cercania <?php if($_GET['orderby'] == 'cercania'){ ?>active<?php } ?>" href="<?php echo add_query_arg('orderby','cercania',$url_actual_sin_paged); ?>">Cercanía</a>
            <a class="economicos <?php if($_GET['orderby'] == 'price_'){ ?>active<?php } ?>" href="<?php echo add_query_arg('orderby','price_',$url_actual_sin_paged); ?>">Los más económicos</a>
            <a class="horario" <?php if($_GET['orderby'] == 'horario-m'){ ?>class="active"<?php } ?> href="<?php echo add_query_arg('orderby','horario-m',$url_actual_sin_paged); ?>">Turno mañanas</a>
            <a class="horario" <?php if($_GET['orderby'] == 'horario-t'){ ?>class="active"<?php } ?> href="<?php echo add_query_arg('orderby','horario-t',$url_actual_sin_paged); ?>">Turno tardes</a>
            <a class="horario" <?php if($_GET['orderby'] == 'horario-f'){ ?>class="active"<?php } ?> href="<?php echo add_query_arg('orderby','horario-f',$url_actual_sin_paged); ?>">Turno fines de semana</a>
            <a class="fecha-inicio <?php if($_GET['orderby'] == 'fecha-inicio'){ ?>active<?php } ?>" href="<?php echo add_query_arg('orderby','fecha-inicio',$url_actual_sin_paged); ?>">Fecha de inicio</a>
        </div>
    </div><?php
} ?>