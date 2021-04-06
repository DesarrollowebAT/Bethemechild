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
<?php if( mfn_opts_get('apple-touch-icon') ): ?>
<link rel="apple-touch-icon" href="<?php mfn_opts_show( 'apple-touch-icon' ); ?>" />
<?php endif; ?>

<!-- wp_head() -->
<?php wp_head(); ?>
<!-- Google Tag Manager -->
<!-- <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-MCXSWZW');</script> -->
<!-- End Google Tag Manager -->
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"></head>
<?php
$body_class=array();
if($_GET['tipo_curso'] == 29 || $_GET['tipo_curso'] == 30 || $_GET['tipo_curso'] == 31)
{
	$body_class[]='not_linea_900';
}
if($_GET['bkat']=='y'){
	$body_class[]='bkat_search_results';
} ?>

<!-- body -->
<body <?php body_class($body_class); ?>><?php
if(!is_page(8657) && !is_page(8666) && !is_page(33609) && !is_page(33619) && !is_page(33583) && !is_page(45236) && !is_singular('autoescuela'))
{ 
	if($_GET['tipo_curso']==28)
	{ ?>
        <div class="cabecera_linea_900 show_for_mobile test2">
            <div class="tlf"><a href="tel:900696558"><?php _e('Llámanos gratis 900 696 558','academiadeltransportista'); ?></a></div>
            <div class="whatsapp"><a href="https://wa.me/34672035652" target="_blank"><?php echo file_get_contents(get_stylesheet_directory().'/img/whatsapp-blanco.svg'); _e('Escríbenos','academiadeltransportista'); ?></a></div>
        </div><?php
	}
} ?>
<span class="post_id_custom" post_id="<?php echo get_the_id(); ?>"></span>
<!-- Google Tag Manager (noscript) -->
<!-- <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-MCXSWZW"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript> -->
<!-- End Google Tag Manager (noscript) --><?php
$user=wp_get_current_user();
if($user->data->ID!=6)
{ ?>
	<div class="sticky_map_container"></div><?php
} ?>

	<?php do_action( 'mfn_hook_top' ); ?>
	
	<?php get_template_part( 'includes/header', 'sliding-area' ); ?>
	
	<?php if( mfn_header_style( true ) == 'header-creative' ) get_template_part( 'includes/header', 'creative' ); ?>
	
	<!-- #Wrapper -->
	<div id="Wrapper">
	
		<?php 
			// WC < 2.7 backward compatibility
			if( version_compare( WC_VERSION, '2.7', '<' ) ){
				$shop_id = woocommerce_get_page_id( 'shop' );
			} else {
				$shop_id = wc_get_page_id( 'shop' );
			}
			
			// Featured Image -----------
			$header_style = '';

			if( mfn_opts_get('img-subheader-attachment') == 'parallax' ){
				
				if( mfn_opts_get( 'parallax' ) == 'stellar' ){
					$header_style .= ' class="bg-parallax" data-stellar-background-ratio="0.5"';
				} else {
					$header_style .= ' class="bg-parallax" data-enllax-ratio="0.3"';
				}
		
			}
		?>
		
		<?php 
			if( mfn_header_style( true ) == 'header-below' ){
				if( is_shop() || ( mfn_opts_get('shop-slider') == 'all' ) ){
					echo mfn_slider( $shop_id );
				}
			}
		?>
		
		<!-- #Header_bg -->
		<div id="Header_wrapper" <?php echo $header_style; ?>>
	
			<!-- #Header -->
			<header id="Header">
				<?php if( mfn_header_style( true ) != 'header-creative' ) get_template_part( 'includes/header', 'top-area' ); ?>	
				<?php 
					if( mfn_header_style( true ) != 'header-below' ){
						if( is_shop() || ( mfn_opts_get('shop-slider') == 'all' ) ){
							echo mfn_slider( $shop_id );
						}
					}
				?>
			</header>
			
			<?php 
				add_filter( 'woocommerce_show_page_title', create_function( false, 'return false;' ) );
				
				
				$subheader_advanced = mfn_opts_get( 'subheader-advanced' );
				
				$subheader_style = '';
					
				if( mfn_opts_get( 'subheader-padding' ) ){
					$subheader_style .= 'padding:'. mfn_opts_get( 'subheader-padding' ) .';';
				}
				
					
				if( ! mfn_slider_isset( $shop_id ) || is_product() || ( is_array( $subheader_advanced ) && isset( $subheader_advanced['slider-show'] ) ) ){
					
					// Subheader | Options
					$subheader_options = mfn_opts_get( 'subheader' );

					if( is_array( $subheader_options ) && isset( $subheader_options['hide-subheader'] ) ){
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
					if( is_array( $subheader_options ) && isset( $subheader_options['hide-breadcrumbs'] ) ){
						$breadcrumbs_show = false;
					} else {
						$breadcrumbs_show = true;
					}

					
					// Subheader | Print
					if( $subheader_show ){
						echo '<div id="Subheader" style="'. $subheader_style .'">';
							echo '<div class="container">';
								echo '<div class="column one">';
																
									// Title
									if( $title_show ){
										
										$title_tag = mfn_opts_get( 'subheader-title-tag', 'h1' );
										
										// Single Product can't use h1
										if( is_product() && $title_tag == 'h1' ) $title_tag = 'h2';
										
										echo '<'. $title_tag .' class="title">';
										
											if( is_product() && mfn_opts_get('shop-product-title') ){
												the_title();											
											} else {
												woocommerce_page_title();
											}
										
										echo '</'. $title_tag .'>';
										
									}

									// Breadcrumbs
									if( $breadcrumbs_show ){
										
										$home = mfn_opts_get('translate') ? mfn_opts_get('translate-home','Home') : __('Home','betheme');
										$woo_crumbs_args = apply_filters( 'woocommerce_breadcrumb_defaults', array(
											'delimiter'   => false,
											'wrap_before' => '<ul class="breadcrumbs woocommerce-breadcrumb">',
											'wrap_after'  => '</ul>',
											'before'      => '<li>',
											'after'       => '<span><i class="icon-right-open"></i></span></li>',
											'home'        => $home,
										) );
										
										woocommerce_breadcrumb( $woo_crumbs_args );
										
									}
			
								echo '</div>';
							echo '</div>';
						echo '</div>';
					}
					
				}
			?>
			
		</div>
		
		<div class="menu_movil principal"><?php
			wp_nav_menu();?>
        </div>
        <div class="menu_movil cursos_submenu_movil">
            <div class="menu-menu_principal-container"><?php
                $items=wp_get_nav_menu_items(57);
                if($items)
                { ?>
                    <ul class="menu"><?php
                        foreach($items as $item)
                        { ?>
                            <li><a href="<?php echo $item->url; ?>"><?php echo $item->title; ?></a></li><?php
                        } ?>
                    </ul><?php
                } ?>
            </div>
        </div>
		<?php do_action( 'mfn_hook_content_before' );
		
// Omit Closing PHP Tags