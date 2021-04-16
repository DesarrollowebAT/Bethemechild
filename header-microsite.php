<?php
/**
 * The Header for our theme.
 *
 * @package Betheme
 * @author Muffin group
 * @link http://muffingroup.com
 */
?><!DOCTYPE html>
<?php 
	if( $_GET && key_exists('mfn-rtl', $_GET) ):
		echo '<html class="no-js" lang="ar" dir="rtl">';
	else:
?>
<html class="no-js<?php echo mfn_user_os(); ?>" <?php language_attributes(); ?><?php mfn_tag_schema(); ?>>
<?php endif; ?>

<!-- head -->
<head>

<!-- meta -->
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="description" content="<?php the_field('texto_cabecera'); ?>">
<link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">

<?php 
	if( mfn_opts_get('responsive') ){
		if( mfn_opts_get('responsive-zoom') ){
			echo '<meta name="viewport" content="width=device-width, initial-scale=1" />';
		} else {
			echo '<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />';
		}
		 
	}
?>

<?php do_action('wp_seo'); ?>

<link rel="shortcut icon" href="<?php mfn_opts_show( 'favicon-img', THEME_URI .'/images/favicon.ico' ); ?>" />	
<link rel="dns-prefetch" href="//www.academiadeltransportista.com" />
<link rel="dns-prefetch" href="//maps.googleapis.com" />
<link rel="dns-prefetch" href="//www.gstatic.com" />
<link rel="dns-prefetch" href="//connect.facebook.net" />
<link rel="dns-prefetch" href="//v2.zopim.com" />
<link rel="dns-prefetch" href="//static.hotjar.com" />
<link rel="dns-prefetch" href="//www.google.com" />
<?php if( mfn_opts_get('apple-touch-icon') ): ?>
<link rel="apple-touch-icon" href="<?php mfn_opts_show( 'apple-touch-icon' ); ?>" />
<?php endif; ?>	

<!-- wp_head() -->
<?php wp_head(); ?>
Rich snippets -->
<!---
<script type='application/ld+json'>
{"@context":"http:\/\/schema.org","@type":"Organization","url":"https:\/\/academiadeltransportista.com\/",
"sameAs":["https:\/\/www.facebook.com\/autoescuelasAT\/","https:\/\/plus.google.com\/u\/0\/ 105531205707824507956\/post","https:\/\/twitter.com\/ATautoescuelas","https:\/\/www.youtube.com\/channel\/UCm3_3hZzE9msh6PUo6sB-Kw"],
"@id":"#organization",
"name":"Academia del transportista",
"logo":"https:\/\/localhost/AT\/wp-content\/uploads\/2017\/10\/logo_academia-.png",
"telephone":"+34 900 696 558",
"email":"info@academiadeltransportista.com"
}
</script> -->


<script src='https://www.google.com/recaptcha/api.js'></script>

<script type="text/javascript">

function myFunction() {
  document.getElementById("divcursos").style.display = "block"; document.getElementById("Content").style.display = "none";}

</script>

</head>
<?php $nivel_microsite=get_user_microsite_level(); ?>
<!-- body -->
<body <?php body_class(array('microsite','microsite-level-'.$nivel_microsite)); ?>><?php

if(false)/*get_current_user_id() != 6)*/
{
	if(is_singular('autoescuela'))
	{ 
		if($_GET['edit']!='true' && $_GET['v']!='y')
		{ ?>
			<div class="edit_microsite"><?php 
				if(!is_user_logged_in())
				{ ?>
					<a class="popup_trigger" href="#" style="background:url(/wp-content/themes/betheme-child/img/microsites/icono-editar.png) <?php if(get_field('color_microsite') != ''){ the_field('color_microsite'); }else{ ?>#FF6600<?php } ?> no-repeat 30px 50%;"><?php 
						_e('Editar página','academiadeltransportista'); ?>
					</a><?php
				}
				else
				{
					if($nivel_microsite == 'pro' || $nivel_microsite == 'premium' || $nivel_microsite == 'exclusive' || current_user_can('administrator'))
					{ ?>
						<a href="<?php echo get_the_permalink(get_the_id()); ?>?edit=true" style="background:url(/wp-content/themes/betheme-child/img/microsites/icono-editar.png) <?php if(get_field('color_microsite') != ''){ the_field('color_microsite'); }else{ ?>#FF6600<?php } ?> no-repeat 30px 50%;"><?php 
							_e('Editar página','academiadeltransportista'); ?>
						</a><?php
					}
					else
					{ ?>
						<a class="popup_trigger" href="#" style="background:url(/wp-content/themes/betheme-child/img/microsites/icono-editar.png) <?php if(get_field('color_microsite') != ''){ the_field('color_microsite'); }else{ ?>#FF6600<?php } ?> no-repeat 30px 50%;"><?php 
							_e('Editar página','academiadeltransportista'); ?>
						</a><?php
					}
				} ?>
			</div><?php
		}
		elseif($_GET['edit']=='true')
		{ ?>
			<div class="edit_microsite editing">
				<a href="<?php echo get_permalink(); ?>" style="background:url(/wp-content/themes/betheme-child/img/microsites/icono-editar.png) <?php if(get_field('color_microsite') != ''){ the_field('color_microsite'); }else{ ?>#FF6600<?php } ?> no-repeat 30px 50%;"><?php 
					_e('Salir del modo de edición','academiadeltransportista'); ?>
				</a>
			</div><div class="edit_microsite editing2">
				<a href="<?php echo get_permalink(); ?>" style="background:url(/wp-content/themes/betheme-child/img/microsites/icono-editar.png) <?php if(get_field('color_microsite') != ''){ the_field('color_microsite'); }else{ ?>#FF6600<?php } ?> no-repeat 30px 50%;"><?php 
					_e('Subir cursos','academiadeltransportista'); ?>
				</a>
			</div><?php		
		}
	}
}
else
{ ?>
	<div class="header_principal section_wrapper">
        <a href="<?php echo get_bloginfo('url'); ?>" target="_blank"><img class="logo vertical-align" alt="Ecodriver - El buscador de autoescuelas" src="<?php echo wp_get_attachment_url(893); ?>" /></a><?php
        if($_GET['edit']!='true' && $_GET['v']!='y')
        { ?>
            <div class="vertical-align edit_microsite"><?php 
                if(!is_user_logged_in())
                { ?>
                    <a class="popup_trigger transitions" href="#"><?php 
                        _e('Editar página','academiadeltransportista'); ?>
                    </a><?php
                }
                else
                {
                    if($nivel_microsite == 'pro' || $nivel_microsite == 'premium' || $nivel_microsite == 'exclusive' || get_current_user_id() == 1827 || current_user_can('administrator'))
                    { ?>
                        <a class="transitions" href="<?php echo get_the_permalink(get_the_id()); ?>?edit=true"><?php _e('Editar página','academiadeltransportista'); ?></a><?php
                    }
                    else
                    { ?>
                        <a class="popup_trigger transitions" href="#"><?php _e('Editar página','academiadeltransportista'); ?></a><?php
                    }
                } ?>
            </div><?php
        }
        elseif($_GET['edit']=='true')
        { ?>
            <div class="vertical-align edit_microsite">
                <a class="transitions" href="<?php echo get_permalink(); ?>"><?php 
                    _e('Salir del modo de edición','academiadeltransportista'); ?>
                </a>
				</div><br>
				<div class="vertical-align edit_microsite">
				<div class="btnsubcursos" style="margin-right:150px">
            		<button onclick="myFunction()">SUBIR CURSOS</button><?php 
            		 ?>
                </a>
            </div><?php
          	
        } ?>
    </div><?php
} ?>