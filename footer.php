<?php
/**
 * The template for displaying the footer.
 *
 * @package Betheme
 * @author Muffin group
 * @link https://muffingroup.com
 */


$back_to_top_class = mfn_opts_get('back-top-top');

if( $back_to_top_class == 'hide' ){
	$back_to_top_position = false;
} elseif( strpos( $back_to_top_class, 'sticky' ) !== false ){
	$back_to_top_position = 'body';
} elseif( mfn_opts_get('footer-hide') == 1 ){
	$back_to_top_position = 'footer';
} else {
	$back_to_top_position = 'copyright';
}

?>

<?php do_action( 'mfn_hook_content_after' ); ?>

<!-- #Footer -->
<footer id="Footer" class="clearfix">
	<div class="footer">
		<div class="container">
			<div class="column one column_column">
				<div class="footer1">
                <p class="titulo-footer">ACADEMIA DEL TRANSPORTISTA</p>
                <p class="menu-footer"><a class="enlace-footer" href="https://www.academiadeltransportista.com/curso-renovacion-cap/">Renovación Cap</a> /  <!-- <a class="enlace-footer" href="https://www.academiadeltransportista.com/carnet-c/">Carnet C</a> / --> <a class="enlace-footer" href="https://www.academiadeltransportista.com/transporte-sanitario/">Transporte Sanitario</a> / <a class="enlace-footer" href="<?php echo get_permalink(88131); ?>">Profesor CAP</a> / <?php /* <a class="enlace-footer" href="https://www.academiadeltransportista.com/sala-de-prensa/">Sala de Prensa</a>*/ ?> <a class="enlace-footer" href="https://www.academiadeltransportista.com/informacion-legal/">Información Legal</a>  <ul class="social"><li class="facebook"><a target="_blank" href="https://www.facebook.com/atacademiadeltransportista" title="Facebook"><i class="icon-facebook"></i></a></li><li class="twitter"><a target="_blank" href="https://twitter.com/ATransportista" title="Twitter"><i class="icon-twitter"></i></a></li><li class="youtube"><a target="_blank" href="https://www.youtube.com/channel/UCm3_3hZzE9msh6PUo6sB-Kw" title="YouTube"><i class="icon-youtube"></i></a></li><li class="linkedin"><a target="_blank" href="https://www.linkedin.com/company/11158404/?lipi=urn%3Ali%3Apage%3Ad_flagship3_profile_view_base%3BfIWl%2BuDpScOA%2FHIjtxxjmA%3D%3D&amp;licu=urn%3Ali%3Acontrol%3Ad_flagship3_profile_view_base-background_details_company" title="LinkedIn"><i class="icon-linkedin"></i></a></li><li><form action="https://mipermiso.solajero.com" method="post" name="test" target="_blank"> <input name="hash" value="a628ea28-e27f-4435-ab5b-70b0a5475a02" type="hidden"><input class="button boton_test" style="vertical-align:middle" name="enviar" value="HACER TEST ONLINE" type="submit"></form></li></ul></p>
                </div>
                <div class="footer2">
                <img alt="camion frontal bus footer - academia del transportista" class="transporte-footer" src="https://www.academiadeltransportista.com/wp-content/uploads/2019/08/camion-frontal-bus-footer-academiadeltransportista.png" />
                <img alt="logo footer - academia del transportista" class="logo-footer" src="https://www.academiadeltransportista.com/wp-content/uploads/2018/07/logo-footer-at-nueva.png" />
                <p class="texto-footer">Con más de 20 años de experiencia, AT Academia del Transportista es la mayor red de centros de Formación Profesional para el Empleo especializada en Transporte, Logística y Seguridad Vial Laboral, con más de 1000 centros de formación a nivel nacional.</p>
                </div>
                <div class="footer3">
                <p class="texto2-footer">Estamos acreditados por:</p>
                <img alt="logo dgt - academia del transportista" class="logo-dgt" src="https://www.academiadeltransportista.com/wp-content/uploads/2018/06/logo-dgt.jpg" />
                <img alt="logo ministerio transportes, movilidad y agenda urbana - academia del transportista" class="logo-ministerio-fomento" src="https://www.academiadeltransportista.com/wp-content/uploads/2020/07/logo-ministerio-transportes-movilidad-y-agenda-urbana-AT.png" />
               <img alt="logo ministerio educación, fp - academia del transportista" class="logo-ministerio-fomento" src="https://www.academiadeltransportista.com/wp-content/uploads/2020/11/logo-ministerio-educacion-f.png" />
                <img alt="logo ministerio empleo - academia del transportista" class="logo-ministerio-empleo" src="https://www.academiadeltransportista.com/wp-content/uploads/2018/06/logo-ministerio-empleo.jpg" />
                <img alt="logo apel - academia del transportista" class="logo-apel" src="https://www.academiadeltransportista.com/wp-content/uploads/2018/06/logo-apel.png" /><br />

                <img alt="logo eeej garantia juvenil - academia del transportista" class="logo-eeej" src="https://www.academiadeltransportista.com/wp-content/uploads/2020/04/logoeeejgarantiajuvenil.png" />
                <img alt="logo anced - academia del transportista" class="logo-anced" src="https://www.academiadeltransportista.com/wp-content/uploads/2020/04/ANCED-Logo_trazado_COLOR.png" />

                </div>
			</div>
		</div>
	</div>


    <div class="footer-movil">
		<div class="container">
			<div class="column one column_column">
                <div class="footer2">
                <img alt="camion frontal bus footer - academia del transportista" class="transporte-footer" src="https://www.academiadeltransportista.com/wp-content/uploads/2019/08/camion-frontal-bus-footer-academiadeltransportista.png" />
                <img alt="logo footer - academia del transportista" class="logo-footer" src="https://www.academiadeltransportista.com/wp-content/uploads/2018/07/logo-footer-at-nueva.png" />
                <p class="texto-footer">Con más de 20 años de experiencia, AT Academia del Transportista es la mayor red de centros de Formación Profesional para el Empleo especializada en Transporte, Logística y Seguridad Vial Laboral, con más de 1000 centros de formación a nivel nacional.</p>
                </div>
                <div class="footer3">
                <p class="texto2-footer">Estamos acreditados por:</p>
                <img alt="logo dgt - academia del transportista" class="logo-dgt" src="https://www.academiadeltransportista.com/wp-content/uploads/2018/06/logo-dgt.jpg" />
                <img alt="logo ministerio fomento - academia del transportista" class="logo-ministerio-fomento" src="https://www.academiadeltransportista.com/wp-content/uploads/2020/07/logo-ministerio-transportes-movilidad-y-agenda-urbana-AT.png" />
                <img alt="logo ministerio educación, fp - academia del transportista" class="logo-ministerio-fomento" src="https://www.academiadeltransportista.com/wp-content/uploads/2020/11/logo-ministerio-educacion-f.png" />
                <img alt="logo ministerio empleo - academia del transportista" class="logo-ministerio-empleo" src="https://www.academiadeltransportista.com/wp-content/uploads/2018/06/logo-ministerio-empleo.jpg" />
                <img alt="logo apel - academia del transportista" class="logo-apel" src="https://www.academiadeltransportista.com/wp-content/uploads/2018/06/logo-apel.png" /><br />

                <img alt="logo eeej garantia juvenil - academia del transportista" class="logo-eeej" src="https://www.academiadeltransportista.com/wp-content/uploads/2020/04/logoeeejgarantiajuvenil.png" />
                <img alt="logo anced - academia del transportista" class="logo-anced" src="https://www.academiadeltransportista.com/wp-content/uploads/2020/04/ANCED-Logo_trazado_COLOR.png" />

                </div>
                <div class="footer1">
                <p class="titulo-footer">ACADEMIA DEL TRANSPORTISTA<p class="menu-footer"><a class="enlace-footer" href="https://www.academiadeltransportista.com/curso-renovacion-cap/">Renovación Cap</a> / <!-- <a class="enlace-footer" href="https://www.academiadeltransportista.com/carnet-c/">Carnet C</a> --> <a class="enlace-footer" href="https://www.academiadeltransportista.com/transporte-sanitario/">Transporte Sanitario</a> / <a class="enlace-footer" href="<?php echo get_permalink(88131); ?>">Profesor CAP</a> / <a class="enlace-footer" href="https://www.academiadeltransportista.com/informacion-legal/">Información Legal</a> <span class="barra-movil">/</span> <ul class="social"><li class="facebook"><a target="_blank" href="https://www.facebook.com/atacademiadeltransportista" title="Facebook"><i class="icon-facebook"></i></a></li><li class="twitter"><a target="_blank" href="https://twitter.com/ATransportista" title="Twitter"><i class="icon-twitter"></i></a></li><li class="youtube"><a target="_blank" href="https://www.youtube.com/channel/UCm3_3hZzE9msh6PUo6sB-Kw" title="YouTube"><i class="icon-youtube"></i></a></li><li class="linkedin"><a target="_blank" href="https://www.linkedin.com/company/11158404/?lipi=urn%3Ali%3Apage%3Ad_flagship3_profile_view_base%3BfIWl%2BuDpScOA%2FHIjtxxjmA%3D%3D&amp;licu=urn%3Ali%3Acontrol%3Ad_flagship3_profile_view_base-background_details_company" title="LinkedIn"><i class="icon-linkedin"></i></a></li><li><form action="https://mipermiso.solajero.com" method="post" name="test" target="_blank"> <input name="hash" value="a628ea28-e27f-4435-ab5b-70b0a5475a02" type="hidden"> <input class="button boton_test" style="vertical-align:middle" name="enviar" value="HACER TEST ONLINE" type="submit"></form></li></ul></p>
                </div>
			</div>
		</div>
	</div>


	<?php
		$sidebars_count = 0;
		for( $i = 1; $i <= 5; $i++ ){
			if ( is_active_sidebar( 'footer-area-'. $i ) ) $sidebars_count++;
		}

		if( $sidebars_count > 0 ){

			$footer_style = '';

			if( mfn_opts_get( 'footer-padding' ) ){
				$footer_style .= 'padding:'. mfn_opts_get( 'footer-padding' ) .';';
			}

			echo '<div class="widgets_wrapper" style="'. $footer_style .'">';
				echo '<div class="container">';

					if( $footer_layout = mfn_opts_get( 'footer-layout' ) ){
						// Theme Options

						$footer_layout 	= explode( ';', $footer_layout );
						$footer_cols 	= $footer_layout[0];

						for( $i = 1; $i <= $footer_cols; $i++ ){
							if ( is_active_sidebar( 'footer-area-'. $i ) ){
								echo '<div class="column '. $footer_layout[$i] .'">';
									dynamic_sidebar( 'footer-area-'. $i );
								echo '</div>';
							}
						}

					} else {
						// Default - Equal Width

						$sidebar_class = '';
						switch( $sidebars_count ){
							case 2: $sidebar_class = 'one-second'; break;
							case 3: $sidebar_class = 'one-third'; break;
							case 4: $sidebar_class = 'one-fourth'; break;
							case 5: $sidebar_class = 'one-fifth'; break;
							default: $sidebar_class = 'one';
						}

						for( $i = 1; $i <= 5; $i++ ){
							if ( is_active_sidebar( 'footer-area-'. $i ) ){
								echo '<div class="column '. $sidebar_class .'">';
									dynamic_sidebar( 'footer-area-'. $i );
								echo '</div>';
							}
						}

					}

				echo '</div>';
			echo '</div>';
		}
	?>


	<?php if( mfn_opts_get('footer-hide') != 1 ): ?>

		<div class="footer_copy">
			<div class="container">
				<div class="column one">

					<?php
						if( $back_to_top_position == 'copyright' ){
							echo '<a id="back_to_top" class="button button_js" href=""><i class="icon-up-open-big"></i></a>';
						}
					?>

					<!-- Copyrights -->
					<div class="copyright">
						<?php
							if( mfn_opts_get('footer-copy') ){
								echo do_shortcode( mfn_opts_get('footer-copy') );
							} else {
								echo '&copy; '. date( 'Y' ) .' '. get_bloginfo( 'name' ) .'. All Rights Reserved. <a target="_blank" rel="nofollow" href="https://muffingroup.com">Muffin group</a>';
							}
						?>
					</div>

					<?php
						if( has_nav_menu( 'social-menu-bottom' ) ){
							mfn_wp_social_menu_bottom();
						} else {
							get_template_part( 'includes/include', 'social' );
						}
					?>

				</div>
			</div>
		</div>

	<?php endif; ?>


	<?php
		if( $back_to_top_position == 'footer' ){
			echo '<a id="back_to_top" class="button button_js in_footer" href=""><i class="icon-up-open-big"></i></a>';
		}
	?>


<?php /*<script type="text/javascript" src="js/smooth-scroll.js"></script>
<script>
	var scroll = new SmoothScroll('a[href*="#"]');
</script>*/ ?>

</footer>

</div><!-- #Wrapper -->
<?php
if(false)/*!is_page(8657))*/
{ ?>
	<!--Start of Zopim Live Chat Script-->
        <!--Start of Zendesk Chat Script-->
<!--<div class="the_live_chat">
<script type="text/javascript">
window.$zopim||(function(d,s){var z=$zopim=function(c){z._.push(c)},$=z.s=
d.createElement(s),e=d.getElementsByTagName(s)[0];z.set=function(o){z.set.
_.push(o)};z._=[];z.set._=[];$.async=!0;$.setAttribute("charset","utf-8");
$.src="https://v2.zopim.com/?57z0ZKc4O8MbRUSkCKlBOxdmdwbx9aoM";z.t=+new Date;$.
type="text/javascript";e.parentNode.insertBefore($,e)})(document,"script");
</script></div>-->
<!--End of Zendesk Chat Script-->
<?php
} ?>
<?php
	// Responsive | Side Slide
	if( mfn_opts_get( 'responsive-mobile-menu' ) ){
		get_template_part( 'includes/header', 'side-slide' );
	}
?>

<?php
	if( $back_to_top_position == 'body' ){
		echo '<a id="back_to_top" class="button button_js '. $back_to_top_class .'" href=""><i class="icon-up-open-big"></i></a>';
	}
?>

<?php if( mfn_opts_get('popup-contact-form') ): ?>
	<div id="popup_contact">
		<a class="button button_js" href="#"><i class="<?php mfn_opts_show( 'popup-contact-form-icon', 'icon-mail-line' ); ?>"></i></a>
		<div class="popup_contact_wrapper">
			<?php echo do_shortcode( mfn_opts_get('popup-contact-form') ); ?>
			<span class="arrow"></span>
		</div>
	</div>
<?php endif; ?>

<?php do_action( 'mfn_hook_bottom' ); ?>

<!-- wp_footer() -->
<?php wp_footer(); ?>


<?php /*<div id="aviso" class="telefono">
	<img src="<?php echo bloginfo('stylesheet_directory'); ?>/img/icono-telefono.svg" />
    <div class="texto">
	    <p class="llama-ahora">¡Llama ahora!</p>
		<p class="el_telefono"><a class="tel" href="tel:672035652">672 035 652</a></p>
	    <p class="escribenos"><a href="#">O escríbenos</a></p>
    </div>
</div>*/ ?>

<div class="aviso-otra-ciudad">
    <div id="aviso" class="telefono mobile" style="display:none;">
        <div class="tlf">
            <p class="text-contact-footer escribenos"><a href="#">CONTACTAR</a></p>
        </div>
        <div class="texto">
            <p class="text-contact-footer"><a href="javascript:void(0);" onclick="mostrar_form_overlay();">SOY DE OTRA CIUDAD</a></p>
        </div>
    </div>
</div>
<?php
global $post;
/*if($post->ID != 7808)*/
/*if(is_post_type_archive('product') && $_GET['bkat']!='y')
{*/
if(is_product())
{
	if(!has_term(array(27,55,54,53),'product_cat',get_the_id())) /* No mostramos el CTA en los cursos del booking */
	{ ?>
        <div class="aviso-otras-ciudades">
            <div id="aviso" class="telefono mobile" style="display:none;">
                <div class="tlf">
                    <p class="text-contact-footer2 escribenos">
                        <a href="#"><?php
                            if(is_product())
                            {
                                if(get_the_id() == 325 || get_the_id() == 120)
								{ ?>
									ME INTERESA ESTE CURSO<?php
								}
								else
								{ ?>
									QUIERO MÁS INFORMACIÓN<?php
								}
                            }
                            else
                            { ?>
                                CONTACTAR<?php
                            } ?>
                        </a>
                    </p>
                </div>
            </div>
        </div><?php
	}
} ?>

<div id="formulario_flotante">
	<div class="content">
        <div class="CtcItemGrid alinear"><div><a class="cerrar" href="#">X</a></div></div>
        <p class="subtitulo-contacto-ciudad alinear2"><?php
			if(is_product())
			{ ?>
            	Quiero recibir información sobre este curso<?php
			}
			else
			{ ?>
				¿Dudas? Contacta con Academia del Transportista o llámanos al <a class="tel" href="tel:672035652">672 035 652</a><?php
			} ?>
        </p><?php
		if(is_product())
		{
			echo do_shortcode('[contact-form-7 id="4982" title="Contact-form-test"]');
		}
		else
		{
			echo do_shortcode('[contact-form-7 id="191" title="Formulario de contacto-at"]');
		} ?>
    </div>
</div>

<?php /*<aside id="quick-call-buttons" class="mostrar-botontlf">
    <div id="call-you" class="caja_llamar">
        <div class="ornament">
            <div class="square square-top"></div>
            <div class="square square-bottom"></div>
        </div>
        <div class="content-box">
            <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3 text-right icon_box">
            	<img class="icon-movil-resp" src="http://www.academiadeltransportista.com/wp-content/uploads/2018/07/icono-telefono.png" />
            </div>
            <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9 text-left text_box vertical-centering">
            	<div class="center_box">
		            <p class="llama-movil"><span class="llama-ahora">¡Llama ahora!</span></p>
    		        <a class="tel" href="tel:672035652">672 035 652</a>
        	    </div>
            </div>
        </div>
    </div>
</aside>*/ ?>


<?php /*<script src="//maps.googleapis.com/maps/api/js?sensor=true&libraries=places"></script>
<script src="<?php echo bloginfo('stylesheet_directory'); ?>/assets/jquery.placepicker.min.js"></script>
<script>
jQuery("#placepicker").placepicker();
</script>*/ ?>

<script src='https://www.google.com/recaptcha/api.js'></script>

<script>  
  wpcf7.cached = 0; 
</script>

<script>
	jQuery('img').on('hover', function (event) {
    jQuery('img').attr('title','');
	});
</script>

<script>
/*document.addEventListener( 'wpcf7mailsent', function( event ) {
    location = 'https://www.academiadeltransportista.com/gracias/';
}, false );*/
</script>

<script>
/*if(jQuery('.landing_course_type').length == 0)
{
	var acc = document.getElementsByClassName("accordion");
	var i;
	
	for (i = 0; i < acc.length; i++) {
	  acc[i].addEventListener("click", function() {
		  console.log(11111);
		this.classList.toggle("activa");
		var panel = this.nextElementSibling;
		if (panel.style.maxHeight){
		  panel.style.maxHeight = null;
		} else {
		  panel.style.maxHeight = panel.scrollHeight + "px";
		}
	  });
	}
}
else
{*/
	jQuery(".mfn-acc .question .title").click(function(){		
		jQuery(this).closest('.question').toggleClass('active');
		jQuery(this).closest('.accordion').toggleClass('activa');
		jQuery(this).next('.answer').slideToggle(100);
	});
	jQuery(jQuery('.question.cap-gratis input[name=tipo-subvencion]').val('Renovar CAP gratis'));
	jQuery(jQuery('.question.cap-gratis input[name=tipo-subvencion]').attr('value','Renovar CAP gratis'));
	jQuery(jQuery('.question.cap-subvencionado input[name=tipo-subvencion]').val('Renovar CAP subvencionado'));
	jQuery(jQuery('.question.cap-subvencionado input[name=tipo-subvencion]').attr('value','Renovar CAP subvencionado'));
/*}*/
</script>

<script>
var acc = document.getElementsByClassName("accordion2");
var i;

for (i = 0; i < acc.length; i++) {
  acc[i].addEventListener("click", function() {
    this.classList.toggle("activa2");
    var panel2 = this.nextElementSibling;
    if (panel2.style.maxHeight){
      panel2.style.maxHeight = null;
    } else {
      panel2.style.maxHeight = panel2.scrollHeight + "px";
    }
  });
}
</script>
<script>
jQuery(document).ready(function(){
	jQuery('#aviso.telefono').animate({
	right: "-5rem"
	},1000);
	});
</script>

<script>
function show_form_overlay(){
	jQuery('.form_overlay').slideDown();
}
function hide_form_overlay(){
	jQuery('.form_overlay').slideUp();
}
</script>

<script>
function mostrar_form_overlay(){
	jQuery('.form_ciudad').slideDown();
}
function ocultar_form_overlay(){
	jQuery('.form_ciudad').slideUp();
}
</script>

<?php /*<script type="text/javascript" src="/wp-content/themes/betheme-child/js/wow.min.js"></script>
<script type="text/javascript">
new WOW().init();
</script>*/ ?>

<script>
jQuery('.modal-club-trigger').on('click',function(e){
	jQuery('#modalclub').css('display','block');
});
jQuery('#modalclub .close').on('click',function(e){
	jQuery('#modalclub').css('display','none');
});
// Get the modal
var modal = document.getElementById('modalclub');

// Get the button that opens the modal
/*var btn = document.getElementById("modal-club");*/

// Get the <span> element that closes the modal
/*var span = document.getElementsByClassName("close")[0];*/

// When the user clicks on the button, open the modal
/*btn.onclick = function() {
    modal.style.display = "block";
}*/

// When the user clicks on <span> (x), close the modal
/*span.onclick = function() {
    modal.style.display = "none";
}*/

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}


</script>

<?php /*<script>
	//CÓDIGO PARA RELLENAR LA ID DEL USUARIO EN EL FORMULARIO DE PUBLICAR OFERTA
	jQuery('input[name=current_user_id]').val(<?php echo get_current_user_id(); ?>);
</script>*/ ?>

<script>
	/* Rellenamos campo URL formularios */
	if(jQuery('input[name="current-url"]').length > 0)
	{
		jQuery('input[name="current-url"]').each(function(index, element) {
			jQuery(element).val(window.location.href);
			jQuery(element).attr('value',window.location.href); 
		});
	}
</script>

<script>
document.addEventListener( 'wpcf7mailsent', function( event ) {
    if ( '1242' == event.detail.contactFormId ) {
        location = 'https://www.academiadeltransportista.com/gracias-ciudad/';
	} else if ( '8758' == event.detail.contactFormId ) {
		location = 'https://www.academiadeltransportista.com/';
    } else if ( '1106' == event.detail.contactFormId ) {
        location = 'https://www.academiadeltransportista.com/gracias-ciudad/';
	} else if ( '191' == event.detail.contactFormId ) {
        location = 'https://www.academiadeltransportista.com/gracias/';
	} else if ( '6' == event.detail.contactFormId ) {
        location = 'https://www.academiadeltransportista.com/gracias/';
	} else if ( '254' == event.detail.contactFormId ) {
        location = 'https://www.academiadeltransportista.com/gracias-centros/';
	} else if ( '292' == event.detail.contactFormId ) {
        location = 'https://www.academiadeltransportista.com/gracias/';
	} else if ( '1085' == event.detail.contactFormId ) {
        location = 'https://www.academiadeltransportista.com/gracias-reserva-plaza/';
	} else if ( '1392' == event.detail.contactFormId ) {
		location = 'https://www.academiadeltransportista.com/gracias-no-resultados/';
	} else if ( '1756' == event.detail.contactFormId ) {
		location = 'https://www.academiadeltransportista.com/gracias-no-resultados-seo/';
	} else if ( '2572' == event.detail.contactFormId ) {
		/*location = 'https://www.academiadeltransportista.com/club-at/gracias-publicar-oferta/';*/
		location = 'https://www.academiadeltransportista.com/gracias-bolsa-empleo/';
	} else if ( '2331' == event.detail.contactFormId ) {
		location = 'https://www.academiadeltransportista.com/club-at/gracias-nuevo-miembro/';
	} else if ( '2336' == event.detail.contactFormId ) {
		location = 'https://www.academiadeltransportista.com/club-at/gracias-nuevo-miembro/';
	} else if ( '2861' == event.detail.contactFormId ) {
		location = 'https://www.academiadeltransportista.com/club-at/gracias-ventajas/';
	} else if ( '2854' == event.detail.contactFormId ) {
		location = 'https://www.academiadeltransportista.com/club-at/gracias-ventajas/';
	} else if ( '2862' == event.detail.contactFormId ) {
		location = 'https://www.academiadeltransportista.com/club-at/gracias-ventajas/';
	} else if ( '2860' == event.detail.contactFormId ) {
		location = 'https://www.academiadeltransportista.com/club-at/gracias-ventajas/';
	} else if ( '2863' == event.detail.contactFormId ) {
		location = 'https://www.academiadeltransportista.com/club-at/gracias-ventajas/';
	} else if ( '4982' == event.detail.contactFormId ) {
		location = 'https://www.academiadeltransportista.com/gracias-por-pedir-informacion-del-curso/';
	} else if ( '8246' == event.detail.contactFormId ) {
		location = 'https://www.academiadeltransportista.com/gracias-por-pedir-informacion/';
	} else if ( '7257' == event.detail.contactFormId ) {
		location = 'https://www.academiadeltransportista.com/gracias-renovacion-cap/';
	} else if ( '8175' == event.detail.contactFormId ) {
		location = 'https://www.academiadeltransportista.com/gracias-blog/';
	} else if ( '8593' == event.detail.contactFormId ) {
		location = 'https://www.academiadeltransportista.com/gracias-planes-microsites/';
	} else if ( '9042' == event.detail.contactFormId ) {
		location = 'https://www.academiadeltransportista.com/gracias-renovacion-cap/';
    } else if ( '9825' == event.detail.contactFormId ) {
		location = 'https://www.academiadeltransportista.com/gracias-contacto-microsite/';
	} else if ( '18278' == event.detail.contactFormId ) {
		location = 'https://www.academiadeltransportista.com/gracias-bolsa-empleo/';
    } else if ( '21487' == event.detail.contactFormId ) {
		location = 'https://www.academiadeltransportista.com/gracias-contacto-autoescuela/';
    } else if ( '21949' == event.detail.contactFormId ) {
		location = 'https://www.academiadeltransportista.com/gracias-otros-cursos/';
    } else {

    }
}, false );
</script>

</body>
</html>