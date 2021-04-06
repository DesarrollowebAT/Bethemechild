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
<!-- meta -->
<meta charset="<?php bloginfo( 'charset' ); ?>" />
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

<link rel="icon" sizes="192x192" href="<?php bloginfo('stylesheet_directory'); ?>/img/favicon.png">
<link rel="shortcut icon" href="<?php mfn_opts_show( 'favicon-img', THEME_URI .'/images/favicon.ico' ); ?>" />	
<link rel="dns-prefetch" href="//maps.googleapis.com" />
<link rel="dns-prefetch" href="//www.gstatic.com" />
<link rel="dns-prefetch" href="//connect.facebook.net" />
<?php /*<link rel="dns-prefetch" href="//v2.zopim.com" />*/ ?>
<link rel="dns-prefetch" href="//static.hotjar.com" />
<link rel="dns-prefetch" href="//www.google.com" />
<?php if( mfn_opts_get('apple-touch-icon') ): ?>
<link rel="apple-touch-icon" href="<?php mfn_opts_show( 'apple-touch-icon' ); ?>" />
<?php endif; ?>	

<!-- wp_head() -->
<?php wp_head(); ?>

<!-- Rich snippets -->
<script type='application/ld+json'>
{"@context":"http:\/\/schema.org","@type":"Organization","url":"https:\/\/academiadeltransportista.com\/",
"sameAs":["https:\/\/www.facebook.com\/autoescuelasAT\/","https:\/\/plus.google.com\/u\/0\/ 105531205707824507956\/post","https:\/\/twitter.com\/ATautoescuelas","https:\/\/www.youtube.com\/channel\/UCm3_3hZzE9msh6PUo6sB-Kw"],
"@id":"#organization",
"name":"Academia del transportista",
"logo":"https:\/\/www.academiadeltransportista.com\/wp-content\/uploads\/2017\/10\/logo_academia-.png",
"telephone":"+34 900 696 558",
"email":"info@academiadeltransportista.com"
}
</script>

<!-- Facebook Pixel Code -->
<script>
  !function(f,b,e,v,n,t,s)
  {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
  n.callMethod.apply(n,arguments):n.queue.push(arguments)};
  if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
  n.queue=[];t=b.createElement(e);t.async=!0;
  t.src=v;s=b.getElementsByTagName(e)[0];
  s.parentNode.insertBefore(t,s)}(window, document,'script',
  'https://connect.facebook.net/en_US/fbevents.js');
  fbq('init', '111249739517699');
  fbq('track', 'PageView');
</script>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"><noscript><img height="1" width="1" style="display:none"
  src="https://www.facebook.com/tr?id=111249739517699&ev=PageView&noscript=1"
/></noscript>
<!-- End Facebook Pixel Code -->

<!--  Preloads -->
<link rel="preload" href="<?php echo get_bloginfo('stylesheet_directory'); ?>/fonts/Exo2-ExtraBold.otf" as="font" crossorigin />
<link rel="preload" href="<?php echo get_bloginfo('stylesheet_directory'); ?>/fonts/Exo2-SemiBold.otf" as="font" crossorigin />
<link rel="preload" href="<?php echo get_bloginfo('stylesheet_directory'); ?>/fonts/Gordita-Regular.otf" as="font" crossorigin />
<link rel="preload" href="<?php echo get_bloginfo('stylesheet_directory'); ?>/fonts/Gordita-Medium.otf" as="font" crossorigin />
<link rel="preload" href="<?php echo get_bloginfo('url'); ?>/wp-content/themes/betheme/fonts/mfn-icons.woff?23391439" as="font" crossorigin />


<meta name="google-site-verification" content="TnhBR1QwAuq5XiOkqEa6RzI-YZ5Q5z67ZuHUCm5bY6k" /> 	
	
</head>

<!-- body -->
<body <?php body_class(); ?>><?php //print_r(wp_get_post_parent_id(49856)); //phpinfo();  ?>
<?php
if(/*!is_page(8657) && */!is_page(8666) && !is_page(8663) && !is_page(33609) && !is_page(33619) && !is_page(33583) && !is_page(45236) && !is_singular('autoescuela') && !is_page(885))
{ ?>
    <div class="cabecera_linea_900 show_for_mobile test1">
        <div class="tlf"><a href="tel:900696558"><?php _e('Llámanos gratis 900 696 558','academiadeltransportista'); ?></a></div>
        <div class="whatsapp"><a href="https://wa.me/34672035652" target="_blank"><?php echo file_get_contents(get_stylesheet_directory().'/img/whatsapp-blanco.svg'); _e('Escríbenos','academiadeltransportista'); ?></a></div>
    </div><?php
} ?>
<span class="post_id_custom" post_id="<?php echo get_the_id(); ?>"></span>
<?php  if(get_current_user_id() == 6){ 
/*$posts = get_posts(array(
		'numberposts'	=> -1,
		'post_type'		=> 'autoescuela',
		'meta_key'		=> 'teorica_online',
		'meta_value'	=> true
	));
	print_r($posts);*/
	/*$test_order = wc_get_order(42736);
	$order_key = $test_order->get_order_key();
print_r($order_key);*/
	/*global $wpdb;
	$wpdb->insert(
		'wp_redirection_items',
		array(
			'url' => '/testttttttttttttttttttttttttttttt2',
			'match_url' => '/testttttttttttttttttttttttttttttt2',
			'regex' => 0,
			'group_id' => 1,
			'status' => 'enabled',
			'action_type' => 'url',
			'action_code' => 301,
			'action_data' => 'https://www.google.com',
			'match_type' => 'url',
			'title' => ''
		)
	);*/
	
	/*$curso=get_posts(array(
		'post_type' => 'product',
		'posts_per_page' => -1,
		'tax_query' => array(
			array(
				'taxonomy' => 'product_cat',
				'field' => 'term_id',
				'terms' => 27,
				'include_children' => false
			)
		),
		'meta_query' => array(
			'relation' => 'AND',
			array(
				'key' => 'autoescuela',
				'value' => '"14561"',
				'compare'	=> 'LIKE'
			),
			array(
				'key' => 'fecha_inicio',
				'value' => '20200322',
				'type'		=> 'NUMERIC',
				'compare'	=> '='
			),
			array(
				'key' => 'fecha_de_finalizacion',
				'value' => '20200405',
				'type'		=> 'NUMERIC',
				'compare'	=> '='
			),
			array(
				'key' => 'horario',
				'value' => 'mananas',
				'type'		=> 'TEXT'
			)
		)
	));
	print_r($curso);*/
	
	
	/*global $wpdb;
	$results_items = $wpdb->get_results( 'SELECT * FROM wp_gdrts_items WHERE name="autoescuela"' );
	foreach($results_items as $result_items)
	{
		$results_logs = $wpdb->get_results( 'SELECT * FROM wp_gdrts_logs WHERE item_id='.$result_items->item_id );
		if($results_logs)
		{
			foreach($results_logs as $result_logs)
			{
				$results_logmeta = $wpdb->get_results( 'SELECT * FROM wp_gdrts_logmeta WHERE meta_key="vote" AND log_id='.$result_logs->log_id );
				$results_logmeta=$results_logmeta[0];
				$fecha=$result_logs->logged;
				$fecha=explode(' ',$fecha);
				$fecha=$fecha[0];
				$fecha=str_replace('-','',$fecha);
				if($results_logmeta)
				{
					$fila=array(
						'usuario' => 4,
						'puntuacion' => $results_logmeta->meta_value,
						'comentario' => '',
						'fecha' => $fecha
					);
					add_row('votos',$fila,$result_items->id);
					echo 'Añadido voto para el centro '.$result_items->id.': '.$results_logmeta->meta_value.'<br />';
				}
			}
		}
	}*/
	/*$centros=get_posts(array(
		'post_type' => 'autoescuela',
		'posts_per_page' => 2500,
		'paged' => 2
	));
	foreach($centros as $centro)
	{
		$votos=get_field('votos',$centro->ID);
		if($votos)
		{
			$i=1;
			foreach($votos as $voto)
			{
				update_row('votos', $i, array('id_voto' => $centro->ID.'_'.$i), $centro->ID);
				$i++;
			}
			echo 'Votos del centro '.$centro->ID.' actualizados.<br />';
		}
	}*/
	
	/*$id_post=2037;
	$votos=get_field('votos',$id_post);
	$i=1;
	foreach($votos as $voto)
	{
		$fecha=explode('/',$voto['fecha']);
		echo $i.' - puntuacion => '.$voto['puntuacion'].', comentario => '.$voto['comentario'].', fecha => '.$fecha[2].$fecha[1].$fecha[0].'<br />';
		$i++;
	}*/
 }
//global $enqueued_scripts;
//var_dump( $enqueued_scripts );
//global $enqueued_styles;
//var_dump( $enqueued_styles );
if(strpos(get_page_template_slug(),'cursos-ciudades') || is_post_type_archive('autoescuela') || strpos(get_page_template(),'autoescuelas-ciudades') !== 0)
{ ?>
	<div class="sticky_map_container"></div><?php
} ?>
	
	<?php do_action( 'mfn_hook_top' ); ?>

	<?php get_template_part( 'includes/header', 'sliding-area' ); ?>
	
	<?php if( mfn_header_style( true ) == 'header-creative' ) get_template_part( 'includes/header', 'creative' ); ?>
	
	<!-- #Wrapper -->
	<div id="Wrapper">
	
		<?php 
			// Featured Image | Parallax ----------
			$header_style = '';
				
			if( mfn_opts_get( 'img-subheader-attachment' ) == 'parallax' ){
				
				if( mfn_opts_get( 'parallax' ) == 'stellar' ){
					$header_style = ' class="bg-parallax" data-stellar-background-ratio="0.5"';
				} else {
					$header_style = ' class="bg-parallax" data-enllax-ratio="0.3"';
				}
				
			}
		?>
		
		<?php if( mfn_header_style( true ) == 'header-below' ) echo mfn_slider(); ?>

		<!-- #Header_bg -->
		<div id="Header_wrapper" <?php echo $header_style; ?>>
	
			<!-- #Header -->
			<header id="Header">
				<?php if( mfn_header_style( true ) != 'header-creative' ) get_template_part( 'includes/header', 'top-area' ); ?>	
				<?php if( mfn_header_style( true ) != 'header-below' ) echo mfn_slider(); ?>
			</header>
				
			<?php 
				if( ( mfn_opts_get('subheader') != 'all' ) && 
					( ! get_post_meta( mfn_ID(), 'mfn-post-hide-title', true ) ) &&
					( get_post_meta( mfn_ID(), 'mfn-post-template', true ) != 'intro' )	){

					
					$subheader_advanced = mfn_opts_get( 'subheader-advanced' );
					
					$subheader_style = '';
					
					if( mfn_opts_get( 'subheader-padding' ) ){
						$subheader_style .= 'padding:'. mfn_opts_get( 'subheader-padding' ) .';';
					}				
					
					
					if( is_search() ){
						// Page title -------------------------
						
						echo '<div id="Subheader" style="'. $subheader_style .'">';
							echo '<div class="container">';
								echo '<div class="column one">';

									if( trim( $_GET['s'] ) ){
										global $wp_query;
										$total_results = $wp_query->found_posts;
									} else {
										$total_results = 0;
									}

									$translate['search-results'] = mfn_opts_get('translate') ? mfn_opts_get('translate-search-results','results found for:') : __('results found for:','betheme');								
									echo '<h1 class="title">'. $total_results .' '. $translate['search-results'] .' '. esc_html( $_GET['s'] ) .'</h1>';
									
								echo '</div>';
							echo '</div>';
						echo '</div>';
						
						
					} elseif( ! mfn_slider_isset() || ( is_array( $subheader_advanced ) && isset( $subheader_advanced['slider-show'] ) ) ){
						// Page title -------------------------
						
						
						// Subheader | Options
						$subheader_options = mfn_opts_get( 'subheader' );


						if( is_home() && ! get_option( 'page_for_posts' ) && ! mfn_opts_get( 'blog-page' ) ){
							$subheader_show = false;
						} elseif( is_array( $subheader_options ) && isset( $subheader_options[ 'hide-subheader' ] ) ){
							$subheader_show = false;
						} elseif( get_post_meta( mfn_ID(), 'mfn-post-hide-title', true ) ){
							$subheader_show = false;
						} else {
							$subheader_show = true;
						}
						
						
						// title
						if( is_array( $subheader_options ) && isset( $subheader_options[ 'hide-title' ] ) ){
							$title_show = false;
						} else {
							$title_show = true;
						}
						
						
						// breadcrumbs
						if( is_array( $subheader_options ) && isset( $subheader_options[ 'hide-breadcrumbs' ] ) ){
							$breadcrumbs_show = false;
						} else {
							$breadcrumbs_show = true;
						}
						
						if( is_array( $subheader_advanced ) && isset( $subheader_advanced[ 'breadcrumbs-link' ] ) ){
							$breadcrumbs_link = 'has-link';
						} else {
							$breadcrumbs_link = 'no-link';
						}
						
						
						// Subheader | Print
						if( $subheader_show ){
							echo '<div id="Subheader" style="'. $subheader_style .'">';
								echo '<div class="container">';
									echo '<div class="column one">';
										
										// Title
										if( $title_show ){
											$title_tag = mfn_opts_get( 'subheader-title-tag', 'h1' );
											echo '<'. $title_tag .' class="title">'. mfn_page_title() .'</'. $title_tag .'>';
										}
										
										// Breadcrumbs
										if( $breadcrumbs_show ){
											mfn_breadcrumbs( $breadcrumbs_link );
										}
										
									echo '</div>';
								echo '</div>';
							echo '</div>';
						}
						
					}
					
					
				}
			?>
		
		</div>
		
		<?php 
			// Single Post | Template: Intro
			if( get_post_meta( mfn_ID(), 'mfn-post-template', true ) == 'intro' ){
				get_template_part( 'includes/header', 'single-intro' );
			}
		?>
		
		<?php do_action( 'mfn_hook_content_before' ); ?>
        
<div class="menu_movil principal"><?php
	//wp_nav_menu(); ?>
    <div class="menu-menu_principal-container">
    	<ul id="menu-menu_principal-1" class="menu">
        	<li id="menu-item-5765" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-5765"><a href="<?php echo get_bloginfo('url'); ?>/conductor-profesional/">Cómo ser Conductor</a></li>
            <li id="menu-item-18108" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-18108"><a rel="nofollow" href="<?php echo get_bloginfo('url'); ?>/planes-microsites/">¿Eres autoescuela?</a></li>
            <li id="menu-item-18329" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-18329"><a href="<?php echo get_bloginfo('url'); ?>/club-at/">Club AT</a></li>
            <li id="menu-item-18328" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-18328"><a href="<?php echo get_bloginfo('url'); ?>/bolsa-de-empleo/">Bolsa de empleo</a></li>
            <li id="menu-item-272" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-has-children menu-item-272"><a href="<?php echo get_bloginfo('url'); ?>/blog/">Blog</a>
            	<ul class="sub-menu">
                	<li id="menu-item-31564" class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-31564"><a href="<?php echo get_bloginfo('url'); ?>/secciones/noticias/">Noticias</a></li>
                    <li id="menu-item-31565" class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-31565"><a href="<?php echo get_bloginfo('url'); ?>/secciones/sala-prensa/">Sala de Prensa</a></li>
                    <li id="menu-item-75862" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-75862"><a href="<?php echo get_bloginfo('url'); ?>/convocatorias-competencia/?view_id=75782">Convocatorias para cursos de Competencia</a></li>
                    <li id="menu-item-75863" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-75863"><a href="<?php echo get_bloginfo('url'); ?>/convocatorias-consejero/?view_id=75149">Convocatorias para cursos de Consejero</a></li>
                </ul>
            </li>
            <li id="menu-item-751" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-has-children menu-item-751"><a href="<?php echo get_bloginfo('url'); ?>/contacto-at/">Contacto</a>
            	<ul class="sub-menu">
                	<li id="menu-item-39" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-39"><a href="<?php echo get_bloginfo('url'); ?>/sobre-nosotros/">Sobre nosotros</a></li>
                    <li id="menu-item-40" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-40"><a href="<?php echo get_bloginfo('url'); ?>/nuestros-centros/">Nuestros centros</a></li>
                    <li id="menu-item-1027" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-1027"><a href="<?php echo get_bloginfo('url'); ?>/preguntas-frecuentes/">FAQS</a></li>
                    <li id="menu-item-75263" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-75263"><a target="_blank" rel="noopener" href="https://academiadeltransportista.centros.at/">Campus Online</a></li>
                </ul>
            </li>
            <li id="menu-item-731" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-731"><a href="<?php echo get_bloginfo('url'); ?>/mi-cuenta/"><span class="login-icon"><span class="login">Login</span></span></a></li>
        </ul>
    </div>
</div>
<div class="menu_movil cursos_submenu_movil">
    <div class="menu-menu_principal-container"><?php
        /*$items=wp_get_nav_menu_items(57);
        if($items)
        {*/ ?>
            <ul class="menu"><?php
                /*foreach($items as $item)
                {
                    <li><a href="<?php echo $item->url; ?>"><?php echo $item->title; ?></a></li><?php
                }*/ ?>
                <li><a href="<?php echo get_bloginfo('url'); ?>/curso-renovacion-cap/">Renovación CAP</a></li>
                <li><a href="<?php echo get_bloginfo('url'); ?>/curso-cap-inicial/">CAP inicial</a></li>
                <li><a href="<?php echo get_bloginfo('url'); ?>/carnet-c/">Carnet Camión</a></li>
                <li><a href="<?php echo get_bloginfo('url'); ?>/carnet-c-e-trailer/">Carnet Trailer</a></li>
                <li><a href="<?php echo get_bloginfo('url'); ?>/carnet-d/">Carnet Autobús</a></li>
                <li><a href="<?php echo get_bloginfo('url'); ?>/curso-obtencion-adr/">ADR Obtención</a></li>
                <li><a href="<?php echo get_bloginfo('url'); ?>/curso-renovacion-adr/">Renovación ADR</a></li>
                <li><a href="<?php echo get_bloginfo('url'); ?>/titulo-de-transportista/">Título de Transportista</a></li>
                <li><a href="<?php echo get_bloginfo('url'); ?>/conductor-ambulancia/">Conductor de Ambulancias</a></li>
                <li><a href="<?php echo get_bloginfo('url'); ?>/cursos/">Otros cursos</a></li>
            </ul><?php
        /*}*/ ?>
    </div>
</div><?php
// Omit Closing PHP Tags