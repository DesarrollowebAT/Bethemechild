<?php
/**
 * Related Products
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/related.php.
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
 * @version     3.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


// single post navigation | header
echo mfn_post_navigation_header( $post_prev, $post_next, $shop_page_id, $translate );

			

if ( $related_products ) :
	if(has_term(28,'tipo-curso',get_the_ID()) ||
	   has_term(29,'tipo-curso',get_the_ID()) ||
	   has_term(30,'tipo-curso',get_the_ID()) ||
	   has_term(31,'tipo-curso',get_the_ID())
	)
	{ ?>
    	<section class="related products single-bkat">
            <h3 class="text-related-products"><?php esc_html_e( 'CURSOS RELACIONADOS', 'woocommerce' ); ?></h3>
            <ul class="products"><?php
                foreach($related_products as $related_product)
                {
					$post_object = get_post( $related_product->get_id() );
                    setup_postdata( $GLOBALS['post'] =& $post_object );
					wc_get_template_part( 'content', 'product-bkat' );
                } ?>
            </ul>
		</section><?php
	}
	else
	{ ?>
    	<section class="related products">
    
            <h2 class="text-related-products"><?php esc_html_e( 'CURSOS RELACIONADOS', 'woocommerce' ); ?></h2>
    
            <?php woocommerce_product_loop_start(); ?>
    
                <?php foreach ( $related_products as $related_product ) : ?>
    
                    <?php
                        $post_object = get_post( $related_product->get_id() );
    
                        setup_postdata( $GLOBALS['post'] =& $post_object );
                        
                        wc_get_template_part( 'content', 'product' ); ?>
    
                <?php endforeach; ?>
    
            <?php woocommerce_product_loop_end(); ?>
    
        </section><?php		
	} ?>

<?php endif;

wp_reset_postdata();
