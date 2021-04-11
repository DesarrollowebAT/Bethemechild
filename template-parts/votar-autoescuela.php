<?php
/**
 * The Template for displaying all single posts.
 *
 * @package Betheme
 * @author Muffin group
 * @link https://muffingroup.com
 */

/*if(current_user_can('administrator'))*/

$nivel_microsite=get_microsite_level();
get_header('microsite');
while(have_posts())
{
	the_post(); ?>
	<!-- #Content -->
	<div id="Content" class="microsite-<?php echo $nivel_microsite; ?>" microsite-color="<?php if(get_field('color_microsite') != ''){ echo str_replace('#','',get_field('color_microsite')); }else{ ?>FF6600<?php } ?>">
		<div class="content_wrapper clearfix"><?php
			$logo=get_the_post_thumbnail_url();
			$imagen_cabecera=get_field('imagen_cabecera'); ?>
			<div class="header_microsite" style="background:url(<?php if($imagen_cabecera){ echo $imagen_cabecera['url']; }else{ ?><?php echo get_bloginfo('stylesheet_directory'); ?>/img/microsites/cabecera_generica.png<?php } ?>);">
				<div class="cabecera_contenido">
					<div class="logo_principal"><?php 
						if($nivel_microsite != '')
						{
							if($logo != '')
							{ ?>
								<img style="border-color:<?php if(get_field('color_microsite') != ''){ the_field('color_microsite'); }else{ ?>#FF6600<?php } ?>;" alt="<?php echo get_the_title(); ?>" src="<?php echo $logo; ?>" /><?php
							}
							else
							{ ?>
								<img style="border-color:<?php if(get_field('color_microsite') != ''){ the_field('color_microsite'); }else{ ?>#FF6600<?php } ?>;" alt="<?php echo get_the_title(); ?>" src="<?php echo get_bloginfo('stylesheet_directory'); ?>/img/microsites/logo_generico.png" /><?php						
							}
						} ?>
					</div>
					<div class="texto_cabecera">
						<h1 class="titulo"><?php echo get_the_title(); ?></h1>
						<div class="descripcion"><?php _e('Haz clic sobre el número de volantes que quieres otorgar a este centro','academiadeltransportista'); ?></div>
					</div>
					<div class="valoraciones pagina_valorar"><?php //print_r(get_post_meta(get_the_id())); ?>
						<div class="las_estrellas"><?php
							echo file_get_contents(get_stylesheet_directory().'/img/microsites/stars.svg'); ?>
						</div>
						<?php echo do_shortcode('[gdrts_stars_rating_auto]'); //echo Custom_Ratings_Public::vote(); ?>
					</div>
				</div>
			</div>
		</div>
	</div><?php 
}
get_footer('microsite');