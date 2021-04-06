<?php
require('../../../wp-load.php');
header('Content-type: application/vnd.ms-excel;charset=utf-16');
header('Content-Disposition: attachment; filename=webcentrosNEW3.xls');
global $wpdb;
$centros = $wpdb->get_results ( "
	SELECT * 
	FROM CENTROS_CORE
	WHERE added = '02-12-2019'
" );
/*print_r($centros);die;*/
if($centros)
{ ?>
    <table border="1" cellpadding="2" cellspacing="0" width="100%">
		<tr>
            <td>Nombre:</td>
            <td>Domicilio:</td>
            <td>Poblaci&oacute;n:</td>
            <td>Cg Postal:</td>
            <td>Tel&eacute;fono:</td>
        </tr><?php
		foreach($centros as $centro)
		{
			if($centro)
			{ ?>
            	<tr>
                    <td><?php echo htmlentities($centro->nombre); ?></td>
                    <td><?php echo htmlentities($centro->direccion); ?></td>
                    <td><?php echo htmlentities($centro->poblacion); ?></td>
                    <td><?php echo $centro->codigo_postal; ?></td>
                    <td><?php echo $centro->telefono; ?></td>
                </tr><?php
			}
		} ?>
    </table><?php
} ?>