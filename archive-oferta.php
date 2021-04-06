<!DOCTYPE html>
<style type="text/css">
.post-type-archive-oferta .archive_ofertas .offer_container .overlay_not_logged_in {
    position: absolute;
    top: 0;
    bottom: 0;
    left: 0;
    right: 0;
    background-color: rgba(255, 255, 255, 0.75);
    z-index: 10;
    border-radius: 15px 15px 15px 15px;
    -moz-border-radius: 15px 15px 15px 15px;
    -webkit-border-radius: 15px 15px 15px 15px;
    display: none;
}
.post-type-archive-oferta .archive_ofertas .offer_container.not_logged_in:hover .overlay_not_logged_in {
    display: block;
}
.post-type-archive-oferta .archive_ofertas .offer_container .overlay_not_logged_in a {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%,-50%);
    color: #fff;
    background: #e85e02;
    font-size: 18px;
    text-align: center;
    padding: 10px;
    width: 60%;
    border-radius: 15px 15px 15px 15px;
    -moz-border-radius: 15px 15px 15px 15px;
    -webkit-border-radius: 15px 15px 15px 15px;
}
.post-type-archive-oferta .archive_ofertas .offer_container .overlay_not_logged_in a:hover {
    text-decoration: none;
    background: #333;
}
</style>
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
$load_more = mfn_opts_get( 'portfolio-load-more' );

?>

<!-- #Content -->
<div id="Content">
	<div class="content_wrapper clearfix">

		<!-- .sections_group -->
		<div class="sections_group">
			<div class="section <?php echo $section_class; ?>">
            	<div class="banner_offers">
                	<div class="section_wrapper">
                        <?php $term_actual = get_queried_object(); ?>
                    	<span class="pre-title"><a class="migas-club" href="https://www.academiadeltransportista.com/club-at/">Club AT</a> - <span class="migas-club-active"><?php echo $term_actual->name; ?></span></span>
                        <h1 class="title-archive-offer">Ofertas de empleo para transportistas</h1>
                    </div>
                </div>
				<div class="section_wrapper clearfix">
					<?php 
					if(true)//current_user_can('administrator'))
					{
						/*rewind_posts();*/ ?>
                        <div style="clear:both;"></div>
                        <div class="archive_ofertas">	
							<div class="blog_wrapper isotope_wrapper">
                                <div class="posts_group lm_wrapper <?php echo implode(' ', $blog_classes); ?>"><?php
                                    while(have_posts())
                                    {
                                        the_post();
                                        if(is_role('administrator') || is_role('customer') || is_role('empresa'))
                                        {
                                            $enlace=get_the_permalink();
                                            $tooltip_classes='';
                                            $tooltip='';
                                            $target='target="_self"';
											$not_logged_in_class='';
                                        }
                                        else
                                        {
                                            $enlace=get_permalink(100);
                                            $tooltip_classes='tooltip tooltip-txt';
                                            $tooltip='data-tooltip="Debes ser miembro del Club AT para acceder a la oferta"';
                                            $target='';
											$not_logged_in_class='not_logged_in';
                                        } ?>
                                        <div class="offer_container <?php echo $tooltip_classes.' '.$not_logged_in_class; ?>" <?php echo $tooltip; ?>>
											<div class="overlay_not_logged_in"><a href="<?php echo get_permalink(100); ?>">Inicia sesión o regístrate</a></div>
                                            <a <?php echo $target; ?> class="enlace-oferta" href="<?php echo $enlace; ?>"><?php
												if(is_role('administrator') || is_role('customer') || is_role('empresa'))
												{
													$logo=get_field('logotipo_de_la_empresa');
													if($logo)
													{ ?>
														<figure><img src="<?php echo $logo['sizes']['medium']; ?>" /></figure><?php
													}
												} ?>
												<h2 class="titulo-oferta"><?php the_title(); ?></h2>
												<p class="texto-oferta"><?php echo wp_trim_words(strip_tags(get_the_content()),12,'...'); ?></p>
												<p class="boton-oferta-club">Ver oferta <img class="icon-arrow-club" src="/wp-content/uploads/2018/11/icon-arrow-right-at.svg"></p>
                                            </a>
                                        </div><?php
                                    } ?>
                                </div>
							</div>
						</div><?php
					} ?>
                    
                			<?php	
								// pagination
								if( function_exists( 'mfn_pagination' ) ):

									echo mfn_pagination( false, $load_more );
								
								else:
									?>
										<div class="nav-next"><?php next_posts_link(__('&larr; Older Entries', 'betheme')) ?></div>
										<div class="nav-previous"><?php previous_posts_link(__('Newer Entries &rarr;', 'betheme')) ?></div>
									<?php
								endif;
							?>
                            
                            <div class="content-archive-offer">
                            	<h2>¿Eres transportista, y buscas empleo?</h2>
                            		<div class="texto-oferta">
										<p>Dentro de nuestra Academia del transportista, podrás encontrar toda una bolsa de empleo dedicada a los profesionales del transporte. </p>
										<p>Y todo ello gracias a nuestro <a href="https://www.academiadeltransportista.com/club-at/">club AT</a>.  Un lugar donde conductores, empresas de transportes y transportistas autónomos tienen un lugar de encuentro en el que compartir sus necesidades laborales. Tanto la búsqueda de empleo, como la necesidad del mismo.</p>
										<p>Dentro de nuestras ofertas de empleo para transportistas, podrás encontrar distintas segmentaciones para elegir aquel que se adapte más a tus necesidades. Por un lado están las rutas tanto nacionales como internacionales para el transporte de mercancías. Y por otro lado el transporte y reparto urbano.</p>
										<p>Todo y cada uno de ellos vienen presentados por una empresa de transporte, que presenta la oferta de empleo. En la cual se indican los distintos carnets o formación necesaria para estar capacitado a realizar el trabajo solicitado.</p>
										<p>El contacto es directo con la empresa solicitante, por lo que si tienes cualquier duda al respecto de la oferta de trabajo, no dudes en ponerte en contacto con ella.</p>
										<p>Ser socio del club AT presenta múltiples ventajas, desde ofertas de empleo, descuentos, seguros, y estar al día de todas las novedades del sector. ¡Entre otros!</p>									
									</div>
                            </div>
                            
				</div>
			</div>
		</div>	
		
		<!-- .four-columns - sidebar -->
		<?php get_sidebar( 'blog' ); ?>

	</div>
</div>

<?php get_footer();

// Omit Closing PHP Tags