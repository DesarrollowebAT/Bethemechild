<?php
/**
 * Single Product tabs
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/tabs/tabs.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.4.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Filter tabs and allow third parties to add their own.
 *
 * Each tab is an array containing title, callback and priority.
 * @see woocommerce_default_product_tabs()
 */
$tabs = apply_filters( 'woocommerce_product_tabs', array() );

if ( ! empty( $tabs ) ) : ?>

	<?php if( in_array( mfn_opts_get( 'shop-product-style' ), array( 'tabs', 'wide tabs', 'modern' ) ) ): ?>
    
    <div class="informacion-producto">
    <div class="enlaces-tab">
    <a class="curso" href="#descripcion-curso">DESCRIPCIÓN DEL CURSO</a>
    <a class="gratis" href="#curso-gratis">¿CÓMO ME PUEDE SALIR GRATIS?</a>
    <a class="testimonios margen-testimonios" href="#testimonios-alumnos">TESTIMONIOS DE ALUMNOS</a>
    </div>
    <span id="descripcion-curso"></span>
    <?php
	echo get_post_meta(get_the_id(),'descripcion_del_curso', true);
	?>
    <hr / id="curso-gratis" class="separador-tabs-gratis">
    <?php
	echo get_post_meta(get_the_id(),'curso_gratis', true);
	?>
    <hr / id="testimonios-alumnos" class="separador-tabs">
    <?php
	echo get_post_meta(get_the_id(),'testimonios', true);
	?>
    </div>
    

		<div class="jq-tabs tabs_wrapper">
			
			<ul>
				<?php 
					$output_tabs = '';
					
					foreach ( $tabs as $key => $tab ){
						
						echo '<li><a href="#tab-'. $key .'">'. apply_filters( 'woocommerce_product_' . $key . '_tab_title', esc_html( $tab['title'] ), $key ) .'</a></li>';
	
					}
	
				?>
			</ul>
			
			<?php 
				$output_tabs = '';
				
				foreach ( $tabs as $key => $tab ){
					
					echo '<div id="tab-'. $key .'">';
					
						call_user_func( $tab['callback'], $key, $tab );
						 
					echo '</div>';
				}
			?>
			
		</div>
		
	<?php else: ?>

		<div class="accordion">
			<div class="mfn-acc accordion_wrapper open1st">
				<?php foreach ( $tabs as $key => $tab ) : ?>
					
					<div class="question">
					
						<div class="title">
							<i class="icon-plus acc-icon-plus"></i><i class="icon-minus acc-icon-minus"></i>
							<?php echo apply_filters( 'woocommerce_product_' . $key . '_tab_title', esc_html( $tab['title'] ), $key ); ?>
						</div>
						
						<div class="answer">
							<?php call_user_func( $tab['callback'], $key, $tab ) ?>	
						</div>
	
					</div>
	
				<?php endforeach; ?>
			</div>
		</div>
	
	<?php endif; ?>
	
<?php endif; ?>