<?php 

function minify_css($input)
{
    if(trim($input) === "") return $input;
    return preg_replace(
        array(
            // Remove comment(s)
            '#("(?:[^"\\\]++|\\\.)*+"|\'(?:[^\'\\\\]++|\\\.)*+\')|\/\*(?!\!)(?>.*?\*\/)|^\s*|\s*$#s',
            // Remove unused white-space(s)
            '#("(?:[^"\\\]++|\\\.)*+"|\'(?:[^\'\\\\]++|\\\.)*+\'|\/\*(?>.*?\*\/))|\s*+;\s*+(})\s*+|\s*+([*$~^|]?+=|[{};,>~]|\s(?![0-9\.])|!important\b)\s*+|([[(:])\s++|\s++([])])|\s++(:)\s*+(?!(?>[^{}"\']++|"(?:[^"\\\]++|\\\.)*+"|\'(?:[^\'\\\\]++|\\\.)*+\')*+{)|^\s++|\s++\z|(\s)\s+#si',
            // Replace `0(cm|em|ex|in|mm|pc|pt|px|vh|vw|%)` with `0`
            '#(?<=[\s:])(0)(cm|em|ex|in|mm|pc|pt|px|vh|vw|%)#si',
            // Replace `:0 0 0 0` with `:0`
            '#:(0\s+0|0\s+0\s+0\s+0)(?=[;\}]|\!important)#i',
            // Replace `background-position:0` with `background-position:0 0`
            '#(background-position):0(?=[;\}])#si',
            // Replace `0.6` with `.6`, but only when preceded by `:`, `,`, `-` or a white-space
            '#(?<=[\s:,\-])0+\.(\d+)#s',
            // Minify string value
            '#(\/\*(?>.*?\*\/))|(?<!content\:)([\'"])([a-z_][a-z0-9\-_]*?)\2(?=[\s\{\}\];,])#si',
            '#(\/\*(?>.*?\*\/))|(\burl\()([\'"])([^\s]+?)\3(\))#si',
            // Minify HEX color code
            '#(?<=[\s:,\-]\#)([a-f0-6]+)\1([a-f0-6]+)\2([a-f0-6]+)\3#i',
            // Replace `(border|outline):none` with `(border|outline):0`
            '#(?<=[\{;])(border|outline):none(?=[;\}\!])#',
            // Remove empty selector(s)
            '#(\/\*(?>.*?\*\/))|(^|[\{\}])(?:[^\s\{\}]+)\{\}#s'
        ),
        array(
            '$1',
            '$1$2$3$4$5$6$7',
            '$1',
            ':0',
            '$1:0 0',
            '.$1',
            '$1$3',
            '$1$2$4$5',
            '$1$2$3',
            '$1:0',
            '$1$2'
        ),
    $input);
}

add_action( 'wp_head', 'carga_estilos' );
function carga_estilos()
{
	echo '<style>'.minify_css(file_get_contents(get_stylesheet_directory().'/assets/css/style_COMUNES.css')).'</style>';
	if(is_front_page())
	{
		echo '<style>'.minify_css(file_get_contents(get_stylesheet_directory().'/assets/css/style_HOME.css')).'</style>';
	}
	elseif(is_archive() && $_GET['bkat']=='y')
	{
		echo '<style>'.minify_css(file_get_contents(get_stylesheet_directory().'/assets/css/style_HEADERSHOP.css')).'</style>';
		echo '<style>'.minify_css(file_get_contents(get_stylesheet_directory().'/assets/css/style_BKATSEARCHRESULTS.css')).'</style>';
	}
	elseif(is_page_template('page-template-autoescuelas-ciudades.php') || is_page_template('page-template-page-template-cursos-ciudades.php'))
	{
		echo '<style>'.minify_css(file_get_contents(get_stylesheet_directory().'/assets/css/style_GENERAL.css')).'</style>';
		echo '<style>'.minify_css(file_get_contents(get_stylesheet_directory().'/assets/css/style_LISTADOSEO.css')).'</style>';
	}
	else
	{
		echo '<style>'.minify_css(file_get_contents(get_stylesheet_directory().'/assets/css/style_GENERAL.css')).'</style>';
	}
}

add_action( 'wp_enqueue_scripts', 'my_theme_enqueue_styles' );
function my_theme_enqueue_styles() {
	
	wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
	wp_enqueue_style( 'light-youtube-embeds', get_stylesheet_directory_uri() . '/assets/light-youtube-embeds/light-youtube-embeds.css' );
	wp_enqueue_script('light-youtube-embeds-js', get_stylesheet_directory_uri() . '/assets/light-youtube-embeds/light-youtube-embeds.js',array(),false,true);

	wp_enqueue_style( 'hamburgers', get_stylesheet_directory_uri() . '/assets/css/hamburgers.css' );
	wp_enqueue_style( 'animate.min', get_stylesheet_directory_uri() . '/assets/css/animate.min.css' );

	/*wp_enqueue_style( 'Bootstrap-grid-css', get_stylesheet_directory_uri() . '/assets/css/bootstrap-grid.min.css' );
	wp_enqueue_style( 'Bootstrap-grid-js', get_stylesheet_directory_uri() . '/assets/css/bootstrap.min.js' );*/

	//Override Sequra
	//Comprobamos si es un curso de BKAT en cuyo caso cargamos otro JS de Sequra
	// if(has_term(28,'tipo-curso',get_queried_object()) ||
	  // has_term(29,'tipo-curso',get_queried_object()) ||
	  // has_term(30,'tipo-curso',get_queried_object()) ||
	  // has_term(31,'tipo-curso',get_queried_object())
	  // )
	// {
		// wp_dequeue_script('sequra-js');
		// wp_deregister_script('sequra-js');
		// wp_enqueue_script('sequra-js',get_bloginfo('stylesheet_directory').'/js/sequrapayment.js', __FILE__);
	// }

	//Cambiamos el js de scripts
	wp_dequeue_script('jquery-scripts');
	wp_deregister_script('jquery-scripts');
	wp_enqueue_script( 'jquery-scripts', get_bloginfo('stylesheet_directory'). '/js/scripts.js', false, THEME_VERSION, true );
  
  // Check if WooCommerce plugin is active
	if( function_exists( 'is_woocommerce' ) ){
 
		// Check if it's any of WooCommerce page
		if(! is_woocommerce() && ! is_cart() && ! is_checkout() ) { 		
			
			## Dequeue WooCommerce styles
			wp_dequeue_style('woocommerce-layout'); 
			wp_dequeue_style('woocommerce-general'); 
			wp_dequeue_style('woocommerce-smallscreen'); 
 
			## Dequeue WooCommerce scripts
			wp_dequeue_script('wc-cart-fragments');
			wp_dequeue_script('woocommerce'); 
			wp_dequeue_script('wc-add-to-cart'); 
          
            // wp_dequeue_script('sequra-js');
		    // wp_deregister_script('sequra-js');
		
			wp_deregister_script( 'js-cookie' );
			wp_dequeue_script( 'js-cookie' );
		}
	}
	
	/* Scripts wannme */
	if(is_singular('product'))
	{
		wp_enqueue_script('wannme-helpers',get_stylesheet_directory_uri().'/js/wannme-helper.js',array(),'1.0',false);
		wp_enqueue_script('wannme',get_stylesheet_directory_uri().'/js/wannme.js',array(),'1.0',true);
	}
	/* Fin scripts wannme */
	
	/*wp_enqueue_script( 'recaptcha-api', 'https://www.google.com/recaptcha/api.js', false, THEME_VERSION, true );*/
}

function the_login_redirect($redirect_to) {
	if(is_page(8303) || get_post_type() == 'autoescuela')
	{
		$redirect_to=add_query_arg('edit','true',get_permalink(get_the_id()));
	}
	return $redirect_to;
}
add_filter('login_redirect', 'the_login_redirect');

//Para servir las imagenes de media con HTTPS

/**
*
*  Force http/s for images in WordPress
*
*  Source:
*  https://core.trac.wordpress.org/ticket/15928#comment:63
*
*  @param $url
*  @param $post_id
*
*  @return string
*/
function ssl_post_thumbnail_urls( $url, $post_id ) {

    //Skip file attachments
    if ( ! wp_attachment_is_image( $post_id ) ) {
        return $url;
    }

    //Correct protocol for https connections
    list( $protocol, $uri ) = explode( '://', $url, 2 );

    if ( is_ssl() ) {
        if ( 'http' == $protocol ) {
            $protocol = 'https';
        }
    } else {
        if ( 'https' == $protocol ) {
            $protocol = 'http';
        }
    }

    return $protocol . '://' . $uri;
}

add_filter( 'wp_get_attachment_url', 'ssl_post_thumbnail_urls', 10, 2 );

//Sobrescribimos la función woocommerce_subcategory_thumbnail para poner en el alt de la imagen el propio alt de la imagen, en lugar del título de la categoría que es como lo hace la función por defecto
function woocommerce_subcategory_thumbnail( $category ) {
	$small_thumbnail_size  	= apply_filters( 'subcategory_archive_thumbnail_size', 'shop_catalog' );
	$dimensions    			= wc_get_image_size( $small_thumbnail_size );
	$thumbnail_id  			= get_woocommerce_term_meta( $category->term_id, 'thumbnail_id', true );
	$image_alt = get_post_meta( $thumbnail_id, '_wp_attachment_image_alt', true);

	if ( $thumbnail_id ) {
		$image        = wp_get_attachment_image_src( $thumbnail_id, $small_thumbnail_size );
		$image        = $image[0];
		$image_srcset = function_exists( 'wp_get_attachment_image_srcset' ) ? wp_get_attachment_image_srcset( $thumbnail_id, $small_thumbnail_size ) : false;
		$image_sizes  = function_exists( 'wp_get_attachment_image_sizes' ) ? wp_get_attachment_image_sizes( $thumbnail_id, $small_thumbnail_size ) : false;
	} else {
		$image        = wc_placeholder_img_src();
		$image_srcset = $image_sizes = false;
	}

	if ( $image ) {
		// Prevent esc_url from breaking spaces in urls for image embeds.
		// Ref: https://core.trac.wordpress.org/ticket/23605.
		$image = str_replace( ' ', '%20', $image );

		// Add responsive image markup if available.
		if ( $image_srcset && $image_sizes ) {
			echo '<img src="' . esc_url( $image ) . '" alt="' . esc_attr( $image_alt ) . '" width="' . esc_attr( $dimensions['width'] ) . '" height="' . esc_attr( $dimensions['height'] ) . '" srcset="' . esc_attr( $image_srcset ) . '" sizes="' . esc_attr( $image_sizes ) . '" />';
		} else {
			echo '<img src="' . esc_url( $image ) . '" alt="' . esc_attr( $image_alt ) . '" width="' . esc_attr( $dimensions['width'] ) . '" height="' . esc_attr( $dimensions['height'] ) . '" />';
		}
	}
}

// Añadir font awesome
add_action( 'wp_enqueue_scripts', 'enqueue_load_fa' );
function enqueue_load_fa() {

    wp_enqueue_style( 'load-fa', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css' );

}


add_action('woocommerce_before_single_product_summary','reordenar_elementos');
function reordenar_elementos(){
	global $post;
	if($post->ID==101)
	{
		// Cambiar orden en los productos
		remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );
		remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20 );
		add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 10 );
		add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 20 );
	}
}

// Cambiar texto botón woocommerce
add_filter( 'woocommerce_product_single_add_to_cart_text', 'woo_custom_cart_button_text' );    // 2.1 +

function woo_custom_cart_button_text() {
global $post;
if ($post->ID==101) {
        return __( 'MATRICÚLATE', 'woocommerce' );

}
else {return __( 'CONTRATAR CURSO', 'woocommerce' );}
}
/* Añadir más productos relacionados */
add_filter( 'woocommerce_output_related_products_args', 'jk_related_products_args', 20 );
function jk_related_products_args( $args ) {
global $post;
if ($post->ID==101) {
$args['posts_per_page'] = 8; // 4 related products
$args['columns'] = 4; // arranged in 4 columns
}
return $args;
}

/* Enviar formularios a distintas páginas segun id */
/*add_action( 'wp_footer', 'cf7_thank_you_redirect' );

function cf7_thank_you_redirect() {
?>
<script type="text/javascript">
document.addEventListener( 'wpcf7mailsent', function( event ) {
	console.log('test!!!')
    if ( '1242' == event.detail.contactFormId ) {
        location = 'https://www.academiadeltransportista.com/gracias-ciudad/';
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
		location = 'https://www.academiadeltransportista.com/club-at/gracias-publicar-oferta/';
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
		location = 'https://www.academiadeltransportista.com/gracias-por-pedir-informacion-del-curso/';
	} else if ( '7257' == event.detail.contactFormId ) {
		location = 'https://www.academiadeltransportista.com/gracias-renovacion-cap/';
	} else if ( '8175' == event.detail.contactFormId ) {
		location = 'https://www.academiadeltransportista.com/gracias-blog/';
	} else if ( '8593' == event.detail.contactFormId ) {
		location = 'https://www.academiadeltransportista.com/gracias-planes-microsites/';
    } else {
        // do nothing
    }
}, false );
</script>
<?php
}*/

//Sobrescribimos la función que muestra bloques de la home para quitar un h2
function sc_promo_box( $attr, $content = null )
{
	extract(shortcode_atts(array(
		'image' 	=> '',
		'title' 	=> '',
		'btn_text' 	=> '',
		'btn_link' 	=> '',
		'position' 	=> 'left',
		'border' 	=> '',
		'target' 	=> '',
		'animate' 	=> '',
	), $attr));

	// image | visual composer fix
	$image = mfn_vc_image( $image );

	// border
	if( $border ){
		$border = 'has_border';
	} else {
		$border = 'no_border';
	}

	// target
	if( $target == 'lightbox' ){
		$target = 'rel="prettyphoto"';
	} elseif( $target ){
		$target = 'target="_blank"';
	} else {
		$target = false;
	}

	$output = '<div class="promo_box '. $border .'">';
		if( $animate ) $output .= '<div class="animate" data-anim-type="'. $animate .'">';
			$output .= '<div class="promo_box_wrapper promo_box_'. $position .'">';

				$output .= '<div class="photo_wrapper">';
					if( $image ) $output .= '<img class="scale-with-grid" src="'. $image .'" alt="'. mfn_get_attachment_data( $image, 'alt' ) .'" width="'. mfn_get_attachment_data( $image, 'width' ) .'" height="'. mfn_get_attachment_data( $image, 'height' ) .'"/>';
				$output .= '</div>';

				$output .= '<div class="desc_wrapper">';
					if( $title )$output .=  $title;
					if( $content ) $output .= '<div class="desc">'. do_shortcode($content) .'</div>';
					if( $btn_link ) $output .= '<a href="'. $btn_link .'" class="button button_left button_theme button_js" '. $target .'><span class="button_icon"><i class="icon-layout"></i></span><span class="button_label">'. $btn_text .'</span></a>';
				$output .= '</div>';

			$output .= '</div>';
		if( $animate ) $output .= '</div>';
	$output .= '</div>'."\n";

	return $output;
}

function forzar_https()
{
	if($_SERVER['HTTPS']!='on')
	{
		wp_redirect('https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'], 301 );
		exit();
	}
}
add_action('init','forzar_https');


/* Excluimos los cursos de las categorías de BKAT del sitemap */
add_filter( 'wpseo_exclude_from_sitemap_by_post_ids', function () {
	$post_ids=array();
	$posts=get_posts(array(
		'post_type' => 'product',
		'posts_per_page' => -1,
		'tax_query' => array(
    		array(
      			'taxonomy' => 'product_cat',
      			'field' => 'id',
      			'terms' => array(27,53,54,55)
    		)
  		)
	));
	foreach($posts as $post)
	{
		$post_ids[]=$post->ID;
	}
	return $post_ids;
});

// Eliminar las cadenas de consulta de recursos estáticos
function _remove_script_version( $src ){
$parts = explode( '?ver', $src );
return $parts[0];
}
add_filter( 'script_loader_src', '_remove_script_version', 15, 1 );
add_filter( 'style_loader_src', '_remove_script_version', 15, 1 );

// Para detectar si está instalado el plugin. For use on Front End only.
include_once( ABSPATH . 'wp-admin/includes/plugin.php' );

// Comprobamos que el plugin AMP esté activo
//if ( is_plugin_active( 'amp/amp.php' ) ) {
//    define('MY_CUSTOM_AMP_PATH', get_stylesheet_directory().'/amp');
//    add_filter( 'amp_post_template_file', 'my_custom_amp_templates', 10, 3 );
//}

// Incluímos nuestras propias plantillas
function my_custom_amp_templates( $file, $type, $post ) {
    if ( 'style' === $type ) {
        $file = MY_CUSTOM_AMP_PATH . '/style.php';
    }
    if ( 'header-bar' === $type ) {
        $file = MY_CUSTOM_AMP_PATH . '/header-bar.php';
    }
    if ( 'footer' === $type ) {
        $file = MY_CUSTOM_AMP_PATH . '/footer.php';
    }
    if ( 'single' === $type ) {
        $file = MY_CUSTOM_AMP_PATH . '/single.php';
    }
    return $file;
}

// ******************** Crunchify Tips - Clean up WordPress Header START ********************** //
function crunchify_remove_version() {
	return '';
}
add_filter('the_generator', 'crunchify_remove_version');

remove_action('wp_head', 'rest_output_link_wp_head', 10);
remove_action('wp_head', 'wp_oembed_add_discovery_links', 10);
remove_action('template_redirect', 'rest_output_link_header', 11, 0);

remove_action ('wp_head', 'rsd_link');
remove_action( 'wp_head', 'wlwmanifest_link');
remove_action( 'wp_head', 'wp_shortlink_wp_head');
// ******************** Clean up WordPress Header END ********************** //

// Deregister los dashicons si no se muestra la barra de admin
add_action( 'wp_print_styles', function() {
    if (!is_admin_bar_showing()) wp_deregister_style( 'dashicons' );
}, 100);


/*add_filter( 'wpcf7_load_js', '__return_false' );*/

/* Cambios título */
function cambio_titulo_seo($titulo)
{
	if($titulo=='Logística archivos - Academia del transportista')
	{
		return 'Cursos de logística para transportistas - Academia del transportista';
	}
	elseif($titulo=='Seguridad Vial Laboral archivos - Academia del transportista')
	{
		return 'Cursos de seguridad vial laboral para transportistas - Academia del transportista';
	}
	elseif($titulo=='Transporte archivos - Academia del transportista')
	{
		return 'Cursos de transporte para transportistas - Academia del transportista';
	}
	return $titulo;
}
add_action('wpseo_title','cambio_titulo_seo');
/* Fin cambios título */

/*function non_ajax_redirection_custom( $contact_form ) {
	wp_mail('rhurtado@roiting.com','test',$contact_form->ID);
	wp_redirect('https://www.academiadeltransportista.com/gracias-blog/');
	exit;
}
add_action( 'wpcf7_submit', 'non_ajax_redirection_custom'  );*/


function get_private_order_notes( $order_id){
    global $wpdb;

    $table_perfixed = $wpdb->prefix . 'comments';
    $results = $wpdb->get_results("
        SELECT *
        FROM $table_perfixed
        WHERE  `comment_post_ID` = $order_id
        AND  `comment_type` LIKE  'order_note'
    ");

    foreach($results as $note){
        $order_note[]  = array(
            'note_id'      => $note->comment_ID,
            'note_date'    => $note->comment_date,
            'note_author'  => $note->comment_author,
            'note_content' => $note->comment_content,
        );
    }
    return $order_note;
}

/*
 * Add Revision support to WooCommerce Products
 * 
 */

add_filter( 'woocommerce_register_post_type_product', 'cinch_add_revision_support' );

function cinch_add_revision_support( $supports ) {
     $supports['supports'][] = 'revisions';

     return $supports;
}

//Google Maps Shortcode
function fn_googleMaps($atts, $content = null) {
   extract(shortcode_atts(array(
      "width" => '100%',
      "height" => '210',
      "src" => ''
   ), $atts));
   return '<iframe style="border:none;" id="gmaps" width="'.$width.'" height="'.$height.'" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="'.$src.'"></iframe>';
}
add_shortcode("googlemap", "fn_googleMaps");

/*function add_fichaca() {
 
if (is_page('Convocatorias-Competencia')||is_page('Convocatorias-Consejero'))  { 
  wp_enqueue_style( 'styles_fichaca', 'https://www.academiadeltransportista.com/wp-content/themes/betheme-child/mapca/styles_fichaca.css', array(), '1.1', 'all');
} 
}
add_action( 'wp_enqueue_scripts', 'add_fichaca' );*/

function add_customradiobutons() {
if (is_page(74827) || is_page(81889))  { 
  wp_enqueue_style( 'styles_radiobutton', 'https://www.academiadeltransportista.com/wp-content/themes/betheme-child/styles_radiobutton.css', array(), '1.1', 'all');
   wp_enqueue_script( 'validaopciones', 'https://www.academiadeltransportista.com/wp-content/themes/betheme-child/js/validaopciones.js', array(), 1.1, true);
} 
}
add_action( 'wp_enqueue_scripts', 'add_customradiobutons' );

/* Override de funciones del padre para que no haga llamadas ni queries innecesarias */
function mfn_get_attachment_id_url( $image_url ){
	return 893;
}
/* Fin overrides */
?>