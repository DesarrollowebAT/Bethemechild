<?php
/**
 * The main template file.
 *
 * @package Betheme
 * @author Muffin group
 * @link http://muffingroup.com
 */

get_header();

// Class
$blog_classes 	= array();
$section_class 	= array();


// Class | Layout
if( $_GET && key_exists( 'mfn-b', $_GET ) ){
	$blog_layout = esc_html( $_GET['mfn-b'] ); // demo
} else {
	$blog_layout = mfn_opts_get( 'blog-layout', 'classic' );
}
$blog_classes[] = $blog_layout;

// Layout | Masonry Tiles | Quick Fix
if( $blog_layout == 'masonry tiles' ){
	$blog_layout = 'masonry';
}


// Class | Columns
if( $_GET && key_exists( 'mfn-bc', $_GET ) ){
	$blog_classes[] = 'col-'. esc_html( $_GET['mfn-bc'] ); // demo
} else {
	$blog_classes[] = 'col-'. mfn_opts_get( 'blog-columns', 3 );
}


if( $_GET && key_exists( 'mfn-bfw', $_GET ) ){
	$section_class[] = 'full-width'; // demo
}
if( mfn_opts_get( 'blog-full-width' ) && ( $blog_layout == 'masonry' ) ){
	$section_class[] = 'full-width';
}
$section_class = implode( ' ', $section_class );


// Isotope
if( $blog_layout == 'masonry' ) $blog_classes[] = 'isotope';


// Ajax | load more
$load_more = mfn_opts_get( 'blog-load-more' );


// Translate
$translate['filter'] 		= mfn_opts_get('translate') ? mfn_opts_get('translate-filter','Filter by') : __('Filter by','betheme');
$translate['tags'] 			= mfn_opts_get('translate') ? mfn_opts_get('translate-tags','Tags') : __('Tags','betheme');
$translate['authors'] 		= mfn_opts_get('translate') ? mfn_opts_get('translate-authors','Authors') : __('Authors','betheme');
$translate['all'] 			= mfn_opts_get('translate') ? mfn_opts_get('translate-all','Show all') : __('Show all','betheme');
$translate['categories'] 	= mfn_opts_get('translate') ? mfn_opts_get('translate-categories','Categories') : __('Categories','betheme');
$translate['item-all'] 		= mfn_opts_get('translate') ? mfn_opts_get('translate-item-all','All') : __('All','betheme');
?>

<?php /*<div class="inner_search_form">
	<div class="section_wrapper clearfix"><?php get_template_part('template-parts/search-form'); ?></div>
</div>*/ ?>
<?php /*print_r($_POST);*/ ?>
<!-- #Content -->
<div id="Content" class="woocommerce-content">
	<div class="content_wrapper clearfix">
    	<div class="sections_group">
        	<div class="section">
            	<div class="section_wrapper clearfix">
                	<div class="items_group clearfix">
                    	<div class="column one woocommerce-content">
                            <div class="search_resuts_count"><?php 
								if($_POST['provincia'] != '')
								{
									_e('Centros'); _e(' en '); echo $_POST['provincia'];
								}
								elseif($_GET['provincia'] != '')
								{
									_e('Centros'); _e(' en '); echo $_GET['provincia'];
								}
								else
								{
									_e('Centros');
								} ?></div>
                            <div class="zona_ubicacion">
                                <button class="accordion" style="display:none;">Ver Mapa</button>
                                <div class="mapa panel">
                                    <iframe src="https://www.google.com/maps/d/embed?mid=1LJM27goWTrtXP1J0I9J_JcM6Dy0&ll=36.27163839144053%2C-5.292713881249938&z=5" width="100%" height="600"></iframe>
                                </div>
                            </div>
                            <div class="zona_cursos">
                                <div class="zona_cursos_resto">
									<div class="products_wrapper isotope_wrapper">
										<ul class="products grid"><?php
											while(have_posts())
											{
												the_post(); ?>
                                                <li class="isotope-item bkat-item post-<?php the_id(); ?> product type-product status-publish tipo-curso-cap-continua product_cat-cap-continua first instock shipping-taxable purchasable product-type-simple">
                                                	<a rel="nofollow" class="desc" href="<?php the_permalink(); ?>">
                                                    	<img src="<?php echo aq_resize(get_the_post_thumbnail_url(get_the_id()),150,150,false,true,true); ?>" />
                                                        <div class="texto">
                                                        	<p class="titulo"><?php the_title(); ?></p><?php
                                                            $provincia=get_field('provincia',$autoescuela->ID);
                                                            $municipio=get_field('municipios_'.$provincia['value'],$autoescuela->ID);
                                                            if($provincia['label']!='' || $municipio['label']!='')
                                                            { ?>
                                                                <p class="ubicacion"><?php
                                                                    if($provincia['label']!='')
                                                                    { ?>
                                                                        <span><?php echo $provincia['label']; ?> |</span> <?php
                                                                    }
                                                                    if($municipio['label']!='')
                                                                    {
                                                                        echo $municipio['label'];
                                                                    } ?>
                                                                </p><?php
                                                            }
															if(get_field('horario',get_the_id())!='')
															{ ?>
																<p class="horario"><span>Horario:</span> <?php the_field('horario',get_the_id()); ?></p><?php
															} ?>
                                                        </div>
                                                    </a>
												</li><?php												
											} // end of the loop. ?>
                                        </ul>
                                    </div>
                                </div>
                            </div><?php	
							// pagination
							/*if( function_exists( 'mfn_pagination' ) )
							{
								echo mfn_pagination( false, $load_more );
							}
							else
							{ ?>
                                <div class="nav-next"><?php next_posts_link(__('&larr; Older Entries', 'betheme')) ?></div>
								<div class="nav-previous"><?php previous_posts_link(__('Newer Entries &rarr;', 'betheme')) ?></div><?php
							}*/ ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div><?php
get_footer();
// Omit Closing PHP Tags