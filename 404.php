<?php
/**
 * 404 page.
 *
 * @package Betheme
 * @author Muffin group
 * @link http://muffingroup.com
 */

/*$translate['404-title'] = mfn_opts_get('translate') ? mfn_opts_get('translate-404-title','Ooops... Error 404') : __('Ooops... Error 404','betheme');
$translate['404-subtitle'] = mfn_opts_get('translate') ? mfn_opts_get('translate-404-subtitle','We`re sorry, but the page you are looking for doesn`t exist.') : __('We are sorry, but the page you are looking for does not exist.','betheme');
$translate['404-text'] = mfn_opts_get('translate') ? mfn_opts_get('translate-404-text','Please check entered address and try again <em>or</em>') : __('Please check entered address and try again or ','betheme');
$translate['404-btn'] = mfn_opts_get('translate') ? mfn_opts_get('translate-404-btn','go to homepage') : __('go to homepage','betheme');
?><!DOCTYPE html>
<html class="no-js<?php echo mfn_user_os(); ?>" <?php language_attributes(); ?>>

<!-- head -->
<head>

<!-- meta -->
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<?php if( mfn_opts_get('responsive') ) echo '<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">'; ?>

<?php do_action('wp_seo'); ?>

<link rel="shortcut icon" href="<?php mfn_opts_show('favicon-img',THEME_URI .'/images/favicon.ico'); ?>" type="image/x-icon" />	

<!-- wp_head() -->
<?php wp_head();?>
</head>

<?php 
	$customID = mfn_opts_get( 'error404-page' );
	$body_class = '';
	if( $customID ) $body_class .= 'custom-404';


<!-- body -->
<body <?php body_class( $body_class ); ?>>*/?><?php 
get_header(); ?>
    <div id="Content">
		<div class="content_wrapper clearfix"><?php 
			if(false):// $customID ): ?>
                <!-- .sections_group -->
                <div class="sections_group"><?php 
                    mfn_builder_print( $customID, true );	// Content Builder & WordPress Editor Content ?>
                </div>
                <!-- .four-columns - sidebar --><?php 
                get_sidebar();
			else: ?>
            	<div id="Error_404">
					<div class="container">
						<div class="column one columna1_404">
							<div class="error_pic">
								<img class="gif" src="https://www.academiadeltransportista.com/wp-content/uploads/2020/01/Gif-anim-camion.gif" />
                            </div>
                            <div class="error_desk">
                            	<h2><?php echo $translate['404-title']; ?></h2>
                               	<h4>Lo sentimos, pero la página que estás buscando no existe.<?php //echo $translate['404-subtitle']; ?></h4>
                                <p><span class="check">Por favor, comprueba la dirección y prueba de nuevo o accede a la página de inicio. <?php //echo $translate['404-text']; ?></span> <a class="button button_filled 404" href="<?php echo site_url(); ?>">Volver a Inicio<?php //fecho $translate['404-btn']; ?></a></p>
                            </div>
                        </div>
                        <div class="page_404_form columna2_404">
						<h2 class="buscador-404">Escribe tu ciudad y<br> encuentra el mejor curso CAP</h2><?php 
							get_template_part('template-parts/search-form-front-page'); ?>
                        </div>
                    </div>
                </div><?php 
			endif; ?>
            <!-- wp_footer() -->
		</div>
	</div><?php 
/*wp_footer(); ?>
</body>
</html>*/
get_footer();