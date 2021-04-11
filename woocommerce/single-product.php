<?php
/**
 * The Template for displaying all single products
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
//Comprobamos si es un curso de CAP contínua, en cuyo caso cargamos la cabecera correspondiente
if(has_term(28,'tipo-curso',get_queried_object()) ||
   has_term(29,'tipo-curso',get_queried_object()) ||
   has_term(30,'tipo-curso',get_queried_object()) ||
   has_term(31,'tipo-curso',get_queried_object())
)
{
	get_header('bkat');
}
else
{
	get_header('shop');
}

/**
 * woocommerce_before_main_content hook.
 *
 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
 * @hooked woocommerce_breadcrumb - 20
 */
do_action( 'woocommerce_before_main_content' );

while(have_posts())
{
	the_post();
	//Comprobamos si es un curso de CAP contínua, en cuyo caso cargamos el single correspondiente
	if(true)/*current_user_can('administrator'))*//*$_SERVER['REMOTE_ADDR'] == '79.151.197.141')*/
	{
		if(has_term(28,'tipo-curso') ||
		   has_term(29,'tipo-curso') ||
		   has_term(30,'tipo-curso') ||
		   has_term(31,'tipo-curso')
		)
		{
			if(true)/*current_user_can('administrator'))*/
			{
				wc_get_template_part('content','single-product-bkat-2019v-2');
			}
			else
			{
				wc_get_template_part('content','single-product-bkat-2019v');
			}
		}
		else
		{
			wc_get_template_part('content','single-product');
		}
	}
	else
	{
		if(has_term(28,'tipo-curso') ||
		   has_term(29,'tipo-curso') ||
		   has_term(30,'tipo-curso') ||
		   has_term(31,'tipo-curso')
		)
		{
			wc_get_template_part('content','single-product-bkat');
		}
		else
		{
			wc_get_template_part('content','single-product');
		}
	}
} // end of the loop.
/**
 * woocommerce_after_main_content hook.
 *
 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
 */
do_action( 'woocommerce_after_main_content' );
/**
 * woocommerce_sidebar hook.
 *
 * @hooked woocommerce_get_sidebar - 10
 */
do_action( 'woocommerce_sidebar' );
get_footer( 'shop' );
/* Omit closing PHP tag at the end of PHP files to avoid "headers already sent" issues. */