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

<!-- #Content -->
<div id="Content">
	<div class="content_wrapper clearfix">

		<!-- .sections_group -->
		<div class="sections_group">
			
			<?php /*<div class="extra_content">
				<?php
					if( get_option( 'page_for_posts' ) || mfn_opts_get( 'blog-page' ) ){
						if( category_description() ){
							echo '<div class="section the_content category_description">';
								echo '<div class="section_wrapper">';
									echo '<div class="the_content_wrapper">';
										echo category_description();
									echo '</div>';
								echo '</div>';
							echo '</div>';
						} else {
							mfn_builder_print( mfn_ID(), true );
						}
					}
				?>
			</div>*/ ?>
			
			<div class="section <?php echo $section_class; ?>">
            	<div class="banner_offers">
                	<div class="section_wrapper">
                        <?php $term_actual = get_queried_object(); ?>
                    	<span class="pre-title"><a class="migas-club" href="/bolsa-de-empleo/">Bolsa de empleo</a> - <span class="migas-club-active"><?php echo $term_actual->name; ?></span></span>
                        <h1>Encuentra trabajo en <span class="nombre-tipo-oferta"><?php echo $term_actual->name; ?></span></h1>
                        <form class="form-encontrar-trabajo" action='<?php echo get_term_link(get_queried_object()->term_id); ?>' method="post">
                        	<select name="provincia_club_at" class="wpcf7-form-control wpcf7-select wpcf7-validates-as-required" aria-required="true" aria-invalid="false">
                            	<option value="Selecciona una provincia">Selecciona una provincia</option>
                                <option <?php if($_POST['provincia_club_at'] == 'Álava'){ ?>selected="selected"<?php } ?>  value="Álava">Álava</option>
                                <option <?php if($_POST['provincia_club_at'] == 'Albacete'){ ?>selected="selected"<?php } ?>  value="Albacete">Albacete</option>
                                <option <?php if($_POST['provincia_club_at'] == 'Alicante'){ ?>selected="selected"<?php } ?>  value="Alicante">Alicante</option>
                                <option <?php if($_POST['provincia_club_at'] == 'Almería'){ ?>selected="selected"<?php } ?>  value="Almería">Almería</option>
                                <option <?php if($_POST['provincia_club_at'] == 'Asturias'){ ?>selected="selected"<?php } ?>  value="Asturias">Asturias</option>
                                <option <?php if($_POST['provincia_club_at'] == 'Ávila'){ ?>selected="selected"<?php } ?>  value="Ávila">Ávila</option>
                                <option <?php if($_POST['provincia_club_at'] == 'Badajoz'){ ?>selected="selected"<?php } ?>  value="Badajoz">Badajoz</option>
                                <option <?php if($_POST['provincia_club_at'] == 'Balears (Illes)'){ ?>selected="selected"<?php } ?>  value="Balears (Illes)">Balears (Illes)</option>
                                <option <?php if($_POST['provincia_club_at'] == 'Barcelona'){ ?>selected="selected"<?php } ?>  value="Barcelona">Barcelona</option>
                                <option <?php if($_POST['provincia_club_at'] == 'Burgos'){ ?>selected="selected"<?php } ?>  value="Burgos">Burgos</option>
                                <option <?php if($_POST['provincia_club_at'] == 'Cáceres'){ ?>selected="selected"<?php } ?>  value="Cáceres">Cáceres</option>
                                <option <?php if($_POST['provincia_club_at'] == 'Cádiz'){ ?>selected="selected"<?php } ?>  value="Cádiz">Cádiz</option>
                                <option <?php if($_POST['provincia_club_at'] == 'Cantabria'){ ?>selected="selected"<?php } ?>  value="Cantabria">Cantabria</option>
                                <option <?php if($_POST['provincia_club_at'] == 'Castellón'){ ?>selected="selected"<?php } ?>  value="Castellón">Castellón</option>
                                <option <?php if($_POST['provincia_club_at'] == 'Ceuta'){ ?>selected="selected"<?php } ?>  value="Ceuta">Ceuta</option>
                                <option <?php if($_POST['provincia_club_at'] == 'Ciudad Real'){ ?>selected="selected"<?php } ?>  value="Ciudad Real">Ciudad Real</option>
                                <option <?php if($_POST['provincia_club_at'] == 'Córdoba'){ ?>selected="selected"<?php } ?>  value="Córdoba">Córdoba</option>
                                <option <?php if($_POST['provincia_club_at'] == 'Coruña (A)'){ ?>selected="selected"<?php } ?>  value="Coruña (A)">Coruña (A)</option>
                                <option <?php if($_POST['provincia_club_at'] == 'Cuenca'){ ?>selected="selected"<?php } ?>  value="Cuenca">Cuenca</option>
                                <option <?php if($_POST['provincia_club_at'] == 'Girona'){ ?>selected="selected"<?php } ?>  value="Girona">Girona</option>
                                <option <?php if($_POST['provincia_club_at'] == 'Granada'){ ?>selected="selected"<?php } ?>  value="Granada">Granada</option>
                                <option <?php if($_POST['provincia_club_at'] == 'Guadalajara'){ ?>selected="selected"<?php } ?>  value="Guadalajara">Guadalajara</option>
                                <option <?php if($_POST['provincia_club_at'] == 'Guipúzcoa'){ ?>selected="selected"<?php } ?>  value="Guipúzcoa">Guipúzcoa</option>
                                <option <?php if($_POST['provincia_club_at'] == 'Huelva'){ ?>selected="selected"<?php } ?>  value="Huelva">Huelva</option>
                                <option <?php if($_POST['provincia_club_at'] == 'Huesca'){ ?>selected="selected"<?php } ?>  value="Huesca">Huesca</option>
                                <option <?php if($_POST['provincia_club_at'] == 'Jaén'){ ?>selected="selected"<?php } ?>  value="Jaén">Jaén</option>
                                <option <?php if($_POST['provincia_club_at'] == 'León'){ ?>selected="selected"<?php } ?>  value="León">León</option>
                                <option <?php if($_POST['provincia_club_at'] == 'Lleida'){ ?>selected="selected"<?php } ?>  value="Lleida">Lleida</option>
                                <option <?php if($_POST['provincia_club_at'] == 'Lugo'){ ?>selected="selected"<?php } ?>  value="Lugo">Lugo</option>
                                <option <?php if($_POST['provincia_club_at'] == 'Madrid'){ ?>selected="selected"<?php } ?>  value="Madrid">Madrid</option>
                                <option <?php if($_POST['provincia_club_at'] == 'Málaga'){ ?>selected="selected"<?php } ?>  value="Málaga">Málaga</option>
                                <option <?php if($_POST['provincia_club_at'] == 'Melilla'){ ?>selected="selected"<?php } ?>  value="Melilla">Melilla</option>
                                <option <?php if($_POST['provincia_club_at'] == 'Murcia'){ ?>selected="selected"<?php } ?>  value="Murcia">Murcia</option>
                                <option <?php if($_POST['provincia_club_at'] == 'Navarra'){ ?>selected="selected"<?php } ?>  value="Navarra">Navarra</option>
                                <option <?php if($_POST['provincia_club_at'] == 'Ourense'){ ?>selected="selected"<?php } ?>  value="Ourense">Ourense</option>
                                <option <?php if($_POST['provincia_club_at'] == 'Palencia'){ ?>selected="selected"<?php } ?>  value="Palencia">Palencia</option>
                                <option <?php if($_POST['provincia_club_at'] == 'Palmas (Las)'){ ?>selected="selected"<?php } ?>  value="Palmas (Las)">Palmas (Las)</option>
                                <option <?php if($_POST['provincia_club_at'] == 'Pontevedra'){ ?>selected="selected"<?php } ?>  value="Pontevedra">Pontevedra</option>
                                <option <?php if($_POST['provincia_club_at'] == 'Rioja (La)'){ ?>selected="selected"<?php } ?>  value="Rioja (La)">Rioja (La)</option>
                                <option <?php if($_POST['provincia_club_at'] == 'Salamanca'){ ?>selected="selected"<?php } ?>  value="Salamanca">Salamanca</option>
                                <option <?php if($_POST['provincia_club_at'] == 'Santa Cruz de Tenerife'){ ?>selected="selected"<?php } ?>  value="Santa Cruz de Tenerife">Santa Cruz de Tenerife</option>
                                <option <?php if($_POST['provincia_club_at'] == 'Segovia'){ ?>selected="selected"<?php } ?>  value="Segovia">Segovia</option>
                                <option <?php if($_POST['provincia_club_at'] == 'Sevilla'){ ?>selected="selected"<?php } ?>  value="Sevilla">Sevilla</option>
                                <option <?php if($_POST['provincia_club_at'] == 'Soria'){ ?>selected="selected"<?php } ?>  value="Soria">Soria</option>
                                <option <?php if($_POST['provincia_club_at'] == 'Tarragona'){ ?>selected="selected"<?php } ?>  value="Tarragona">Tarragona</option>
                                <option <?php if($_POST['provincia_club_at'] == 'Teruel'){ ?>selected="selected"<?php } ?>  value="Teruel">Teruel</option>
                                <option <?php if($_POST['provincia_club_at'] == 'Toledo'){ ?>selected="selected"<?php } ?>  value="Toledo">Toledo</option>
                                <option <?php if($_POST['provincia_club_at'] == 'Valencia'){ ?>selected="selected"<?php } ?>  value="Valencia">Valencia</option>
                                <option <?php if($_POST['provincia_club_at'] == 'Valladolid'){ ?>selected="selected"<?php } ?>  value="Valladolid">Valladolid</option>
                                <option <?php if($_POST['provincia_club_at'] == 'Vizcaya'){ ?>selected="selected"<?php } ?>  value="Vizcaya">Vizcaya</option>
                                <option <?php if($_POST['provincia_club_at'] == 'Zamora'){ ?>selected="selected"<?php } ?>  value="Zamora">Zamora</option>
                                <option <?php if($_POST['provincia_club_at'] == 'Zaragoza'){ ?>selected="selected"<?php } ?>  value="Zaragoza">Zaragoza</option>
                            </select>
                            <button type="submit"><img class="icon-flecha-encontrar-trabajo" src="https://www.academiadeltransportista.com/wp-content/uploads/2018/06/icon-flecha.png" title=""></button>
                        </form>
                    </div>
                </div>
				<div class="section_wrapper clearfix">
					<?php /*<div class="column one column_blog columna-encontrar-trabajo">	
						<div class="blog_wrapper isotope_wrapper"><?php
                        	if(have_posts())
							{ ?>
								<div class="posts_group lm_wrapper <?php echo implode(' ', $blog_classes); ?>"><?php
									while(have_posts())
									{
                                        the_post();
										if(is_role('administrator') || is_role('socio-club-at') || is_role('empresa'))
										{
											$enlace=get_the_permalink();
											$tooltip_classes='';
											$tooltip='';
											$target='target="_self"';
										}
										else
										{
											$enlace='#';
											$tooltip_classes='tooltip tooltip-txt';
											$tooltip='data-tooltip="Debes ser miembro del Club AT para acceder a la oferta"';
											$target='';
										} ?>
                                        <a <?php echo $target; ?> class="enlace-oferta" href="<?php echo $enlace; ?>">
                                            <div class="column mcb-column one-fifth column_column oferta1 column-margin- <?php echo $tooltip_classes; ?>" <?php echo $tooltip; ?>>
                                                <div class="column_attr clearfix cuandro-dentro-oferta" style=""><?php
                                                    $logo=get_field('logotipo_de_la_empresa');
                                                    if($logo)
                                                    { ?>
                                                        <figure><img src="<?php echo $logo['sizes']['medium']; ?>" /></figure><?php
                                                    } ?>
                                                    <h2 class="titulo-oferta"><?php the_title(); ?></h2>
                                                    <p class="texto-oferta"><?php echo wp_trim_words(strip_tags(get_the_content()),12,'...'); ?></p>
                                                    <div class="enlace-oferta boton-oferta-club">Ver oferta <img class="icon-arrow-club" src="/wp-content/uploads/2018/11/icon-arrow-right-at.svg"></div>
                                                </div>
                                            </div>
                                        </a><?php
									} ?>
                                </div><?php
							}
							else
							{ ?>
								<div class="section_wrapper clearfix">
									<div class="column one column_blog">	
										<div class="blog_wrapper isotope_wrapper">
                                        	<div class="woocommerce-info alert alert_info">
                                            	<div class="alert_icon"><i class="icon-help"></i></div>
                                                <div class="alert_wrapper">No se encontraron ofertas en esta provincia.</div>
                                            </div>
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
						
						</div>
					</div><?php */
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
				</div>
			</div>
		</div>	
		
		<!-- .four-columns - sidebar -->
		<?php get_sidebar( 'blog' ); ?>

	</div>
</div>

<?php get_footer();

// Omit Closing PHP Tags