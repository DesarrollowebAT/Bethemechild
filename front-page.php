<?php
/**
 * The template for displaying all pages.
 *
 * @package Betheme
 * @author Muffin group
 * @link http://muffingroup.com
 */

/*if($_SERVER['REMOTE_ADDR'] != '79.151.193.47')*/
if(false)
{
	/* HOME ACTUAL */
	get_header(); ?>

	<?php
        if(false)/*$_SERVER['REMOTE_ADDR'] == '79.151.193.47')*/
        {
            /*$SearchForm = get_field('SearchDriSchool');*/
            if(true)/*$SearchForm)*/
            { ?>
                <div>
                  <div class="MainTitlesCAPSearch MediumSpaced"><?php /*echo $SearchForm['TitleDrivSchool'];*/ ?></div>
                  <div class="SearchSchoolAT SearchSchoolATBg">
                    <div class="item TextWhite TitleBannerAT"><?php /*echo $SearchForm['subtdrivschool'];*/ ?></div>
                    <div class="item">
                      <form class="item FormGrid" action="<?php echo get_post_type_archive_link('autoescuela'); ?>" method="post">
                        <input id="provincia-search-centro" name="provincia" type="hidden" />
                        <input class="InpT" type="text" id="pac-input-search-centro" placeholder="Escribe tu ciudad"/>
                        <input class="InpT InpTSec" type="submit" value="Encontrar autoescuela" />
                      </form>
                    </div>
                  </div>
                </div><?php
            }
        }
    ?>

    <!-- #Content -->
    <div class="filtro home">
        <div class="section_wrapper slide-home">
            <div class="form_container">
                <h2 class="titulo_form"><?php _e('Buscador CAP Continua','academiatransportista'); ?></h2>
                <p><?php _e('Contamos con la mayor red de centros de formación. Más de 10.000 cursos en más de 500 autoescuelas y centros CAP de toda España.','academiatransportista'); ?></p><?php
                get_template_part('template-parts/search-form'); ?>
            </div>
            <div class="text-slide">
                <p class="titulo-slide"><?php _e('Descubre todos los beneficios de contratar cursos en AT'); ?></p>
                <ul class="lista-slide">
                    <li><img class="icon-financiacion" src="<?php echo get_bloginfo('url'); ?>/wp-content/uploads/2018/06/icon-centros.png" /> <span class="subtitulo-slide"><?php _e('Red de centros a nivel nacional'); ?></span><br /><span class="texto-slide"><?php _e('Con más de 500 centros en todo el país'); ?></span></li>
                    <li><img class="icon-financiacion" src="<?php echo get_bloginfo('url'); ?>/wp-content/uploads/2018/06/icon-cursos.png" /> <span class="subtitulo-slide"><?php _e('La mayor oferta formativa'); ?></span><br /><span class="texto-slide"><?php _e('Formación para transportistas profesionales'); ?></span></li>
                    <li><img class="icon-financiacion" src="<?php echo get_bloginfo('url'); ?>/wp-content/uploads/2018/07/icon-competente.png" /> <span class="subtitulo-slide"><?php _e('La mejor relación calidad precio'); ?></span><br /><span class="texto-slide"><?php _e('Profesorado altamente cualificado'); ?></span></li>
                    <li><img class="icon-financiacion" src="<?php echo get_bloginfo('url'); ?>/wp-content/uploads/2018/06/icon-financiacion.png" /> <span class="subtitulo-slide"><?php _e('Múltiples opciones de financiación'); ?></span><br /><span class="texto-slide"><?php _e('Facilidades de pago para tu formación'); ?></span></li>
                </ul>
                <ul class="lista-slide-movil">
                    <li><img class="icon-financiacion" src="<?php echo get_bloginfo('url'); ?>/wp-content/uploads/2018/07/icon-centros-oscuro.png" /> <span class="subtitulo-slide"><?php _e('Red de centros a nivel nacional'); ?></span><br /><span class="texto-slide"><?php _e('Con más de 500 centros en todo el país'); ?></span></li>
                    <li><img class="icon-financiacion" src="<?php echo get_bloginfo('url'); ?>/wp-content/uploads/2018/07/icon-cursos-oscuro.png" /> <span class="subtitulo-slide"><?php _e('La mayor oferta formativa'); ?></span><br /><span class="texto-slide"><?php _e('Formación para transportistas profesionales'); ?></span></li>
                    <li><img class="icon-financiacion" src="<?php echo get_bloginfo('url'); ?>/wp-content/uploads/2018/07/icon-competente-oscuro.png" /> <span class="subtitulo-slide"><?php _e('La mejor relación calidad precio'); ?></span><br /><span class="texto-slide"><?php _e('Profesorado altamente cualificado'); ?></span></li>
                    <li><img class="icon-financiacion" src="<?php echo get_bloginfo('url'); ?>/wp-content/uploads/2018/07/icon-financiacion-oscuro.png" /> <span class="subtitulo-slide"><?php _e('Múltiples opciones de financiación'); ?></span><br /><span class="texto-slide"><?php _e('Facilidades de pago para tu formación'); ?></span></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="section_wrapper mcb-section-inner">
        <div class="wrap mcb-wrap one  valign-top clearfix">
            <div class="mcb-wrap-inner">
                <div class="botones_extra column mcb-column one column_column  column-margin-">
                    <h2 class="titulo-home column_attr clearfix align_center"><?php _e('Ofertas flash de cursos a nivel nacional'); ?></h2>
                    <div class="boton_extra chollo column mcb-column one-third column_trailer_box"><?php
                        $el_post=get_curso_home($tipo='elmasbarato'); ?>
                        <a href="<?php echo get_permalink($el_post->ID); ?>">
                            <p class="titulo_bloque"><?php _e('El más barato'); ?></p><?php
                            $autoescuela=get_field('autoescuela',$el_post);
                            $autoescuela=$autoescuela[0]; ?>
                            <div class="icon"><?php echo file_get_contents(ABSPATH.'/wp-content/themes/betheme-child/img/map-marker-alt.svg'); ?></div>
                            <div class="content">
                                <p class="provincia"><?php
                                    $provincia=get_field('provincia',$autoescuela);
                                    $municipio=get_field('municipios_'.$provincia['value'],$autoescuela);
                                    echo $municipio['label']; ?> (<?php echo $provincia['label']; ?>)
                                </p>
                                <p class="titulo_autoescuela <?php if(strlen($autoescuela->post_title)>30){ ?>size-2<?php } ?>"><?php echo $autoescuela->post_title; ?></p><?php
                                $texto_titulo_precio=$el_post->post_title.' desde '.wc_get_product($el_post->ID)->get_price_html(); ?>
                                <p class="titulo_curso_precio <?php if(strlen(strip_tags($texto_titulo_precio))>35){ ?>size-2<?php } ?>"><?php echo $texto_titulo_precio; ?></p>
                            </div>
                        </a>
                    </div>
                    <div class="boton_extra inicio_mas_cercano column mcb-column one-third column_trailer_box"><?php
                        $el_post=get_curso_home($tipo='eliniciomascercano'); ?>
                        <a href="<?php echo get_permalink($el_post->ID); ?>">
                            <p class="titulo_bloque"><?php _e('El inicio más cercano'); echo ' '; ?><span class="fecha">(<?php $fecha=date_create(get_field('fecha_inicio',$el_post)); $fecha=date_format($fecha,"j \d\e F"); echo traduccion_fecha($fecha); ?>)</span></p><?php
                            $autoescuela=get_field('autoescuela',$el_post);
                            $autoescuela=$autoescuela[0]; ?>
                            <div class="icon"><?php echo file_get_contents(ABSPATH.'/wp-content/themes/betheme-child/img/map-marker-alt.svg'); ?></div>
                            <div class="content">
                                <p class="provincia"><?php
                                    $provincia=get_field('provincia',$autoescuela);
                                    $municipio=get_field('municipios_'.$provincia['value'],$autoescuela);
                                    echo $municipio['label']; ?> (<?php echo $provincia['label']; ?>)
                                </p>
                                <p class="titulo_autoescuela <?php if(strlen($autoescuela->post_title)>30){ ?>size-2<?php } ?>"><?php echo $autoescuela->post_title; ?></p><?php
                                $texto_titulo_precio=$el_post->post_title.' desde '.wc_get_product($el_post->ID)->get_price_html(); ?>
                                <p class="titulo_curso_precio <?php if(strlen(strip_tags($texto_titulo_precio))>35){ ?>size-2<?php } ?>"><?php echo $texto_titulo_precio; ?></p>
                            </div>
                        </a>
                    </div>
                    <div class="boton_extra cercania column mcb-column one-third column_trailer_box"><?php
                        $el_post=get_cursos_por_proximidad(1);
                        $el_post=$el_post[0]; ?>
                        <a href="<?php echo get_permalink($el_post->ID); ?>">
                            <p class="titulo_bloque"><?php _e('El más próximo a ti'); echo ' '; ?></p><?php
                            $autoescuela=get_field('autoescuela',$el_post);
                            $autoescuela=$autoescuela[0]; ?>
                            <div class="icon"><?php echo file_get_contents(ABSPATH.'/wp-content/themes/betheme-child/img/map-marker-alt.svg'); ?></div>
                            <div class="content">
                                <p class="provincia"><?php
                                    $provincia=get_field('provincia',$autoescuela);
                                    $municipio=get_field('municipios_'.$provincia['value'],$autoescuela);
                                    echo $municipio['label']; ?> (<?php echo $provincia['label']; ?>)
                                </p>
                                <p class="titulo_autoescuela <?php if(strlen($autoescuela->post_title)>30){ ?>size-2<?php } ?>"><?php echo $autoescuela->post_title; ?></p><?php
                                $texto_titulo_precio=$el_post->post_title.' desde '.wc_get_product($el_post->ID)->get_price_html(); ?>
                                <p class="titulo_curso_precio <?php if(strlen(strip_tags($texto_titulo_precio))>35){ ?>size-2<?php } ?>"><?php echo $texto_titulo_precio; ?></p>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="Content">
        <div class="content_wrapper clearfix">

            <!-- .sections_group -->
            <div class="sections_group">

                <div class="entry-content" itemprop="mainContentOfPage">

                    <?php
                        while ( have_posts() ){
                            the_post();							// Post Loop
                            mfn_builder_print( get_the_ID() );	// Content Builder & WordPress Editor Content
                        }
                    ?>

                    <div class="section section-page-footer">
                        <div class="section_wrapper clearfix">

                            <div class="column one page-pager">
                                <?php
                                    // List of pages
                                    wp_link_pages(array(
                                        'before'			=> '<div class="pager-single">',
                                        'after'				=> '</div>',
                                        'link_before'		=> '<span>',
                                        'link_after'		=> '</span>',
                                        'next_or_number'	=> 'number'
                                    ));
                                ?>
                            </div>

                        </div>
                    </div>

                </div>

                <?php if( mfn_opts_get('page-comments') ): ?>
                    <div class="section section-page-comments">
                        <div class="section_wrapper clearfix">

                            <div class="column one comments">
                                <?php comments_template( '', true ); ?>
                            </div>

                        </div>
                    </div>
                <?php endif; ?>

            </div>

            <!-- .four-columns - sidebar -->
            <?php get_sidebar(); ?>

        </div>
    </div>

    <?php get_footer();
}
else
{
	/* HOME NUEVA */
	get_header();
?>

<section id="home2019">
    <!-- #Content -->

<div class="container">
<!-- One block -->
<section class="OneBlock">
    <!-- Main title -->
    <h1 class="MainTitlesCAPSearch MediumSpaced"><?php echo the_field('MainTitleSearchPage'); ?></h1>
    <!-- Main title -->
	<!-- Search Home -->
    <div class="content-grid-search">
    	<div class="item-grid"><?php 
			get_template_part('template-parts/search-form-front-page'); ?>
        </div>
        <!-- End Search Home -->
        <!-- Benefits -->
        <?php /*<div class="item-grid bannerhome">
	        <img src="<?php echo get_bloginfo('stylesheet_directory'); ?>/img/img-pandemia-at.jpg" />
        </div>*/ ?>
        <div class="item-grid BoxBenefits">
        	<div class="SmallSpacedBottom TextOrange"><?php the_field('MainTitBenefit'); ?></div><?php
				if(have_rows('BenefHome'))
				{
					while(have_rows('BenefHome'))
					{
						the_row();
						//vars
						$ImgIcon = get_sub_field('IconBenefit'); ?>
                        <div class="content-grid BenefitS SmallSpacedBottom">
                        	<div class="item itemImg"><img src="<?php echo $ImgIcon['url']; ?>" /></div>
                            <div class="item">
                                <!-- <p><?//php the_sub_field('TitBenefit'); ?></p> -->
                                <p><?php the_sub_field('ContBenefit'); ?></p>
                            </div>
						</div><?php 
					}
				} ?>
			</div>
		</div><!-- End benefits -->
</section>
<!-- End one block --><?php

if(true)/*get_current_user_id() == 6)*/
{ ?>
	<div class="contenedor_autoescuelas_destacadas">
    	<div class="MainTitlesCAPSearch"><?php _e('Estamos cargando centros recomendados para ti...','bkat'); ?></div>
        <img class="waiting_gif" src="<?php echo get_bloginfo('stylesheet_directory'); ?>/img/camion-espera.gif" />
    </div><?php 
} ?>


<!-- Block: Main Courses -->
<section class="MainCourses">
  <!-- Main courses title -->
  <h2 class="MainTitlesCAPSearch MediumSpaced"><?php the_field('TitlemainCourses'); ?></h2>
  <!-- end main courses title -->

  <?php
    $posts = get_field('MainCours');

    if( $posts ): ?>
        <div class="contentGridMainCourse MainCourseGrid">
        <?php foreach( $posts as $post): // variable must be called $post (IMPORTANT) ?>
            <?php setup_postdata($post); ?>

							<div class="item ItemMainCourse">
								<?php $ImgPdt = get_the_post_thumbnail( $post_id, 'large','style=max-width:100%;height:auto;'); ?>
								<div><?php echo $ImgPdt; ?></div>
                <div class="BoxCItemMainCourse"><?php
					$titulo_home=get_field('titulo_bloque_home',$post_id);
					if($titulo_home == '')
					{ ?>
                    	<h3 class="TitleGen"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3><?php
					}
					else
					{ ?>
                    	<h3 class="TitleGen"><a href="<?php the_permalink(); ?>"><?php echo $titulo_home; ?></a></h3><?php
					} ?>
                    <div class="ButtonGen"><a href="<?php the_permalink(); ?>">Ver este curso</a></div>
                </div>

							</div>

        <?php endforeach; ?>
      </div>
        <?php wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly ?>
    <?php endif; ?>
</section>
 <!-- End block: Main Courses -->


    <!-- Block Club AT banner -->
          <?php
            if(have_rows('CtaBannerClubAT')):
              while(have_rows('CtaBannerClubAT')): the_row();
              // vars
              $ImgOne = get_sub_field('ImgBgClubAT');
              $ImgTwo = get_sub_field('ImgClubAT');
              $Link = get_sub_field('LinkCTA');
          ?>
          <div class="BannerAtFrontPage" style="background-image:url('<?php echo $ImgOne['url']; ?>')">

          <div class="content-grid BannerClubAT">
            <div class="item ImgBanner">
              <img src="<?php echo $ImgTwo['url']; ?>" alt="<?php echo $ImgTwo['alt']; ?>" />
            </div>

            <div class="item">
              <div class="ClubBannerAT"><?php the_sub_field('FirsTitleClubAT'); ?></div>
              <div class="TitleBannerAT"><?php the_sub_field('SecTitleClubAT'); ?></div>
              <div class="TextBannerAT"><?php the_sub_field('ContentClubAT'); ?></div>
            </div>

            <div class="item LinkCklubAT">
              <a href="<?php echo $Link['url']; ?>">
                <div class="LinkBannerAT"><?php echo $Link['title']; ?></div>
              </a>
            </div>
          </div>

          </div>

        <?php endwhile?>
      <?php endif; ?>
    <!-- Block Club AT banner -->


    <!-- Block Search form driving School -->
    <?php
    $SearchForm = get_field('SearchDriSchool');
    if($SearchForm): ?>
    <div>
      <div class="MainTitlesCAPSearch MediumSpaced"><?php echo $SearchForm['TitleDrivSchool']; ?></div>

      <div class="SearchSchoolAT SearchSchoolATBg">
        <div class="item TextWhite TitleBannerAT"><?php echo $SearchForm['subtdrivschool']; ?></div>
        <div class="item forms">
          <form class="item FormGrid buscador_centros_por_ciudad" action="<?php echo get_permalink(18339); /*echo get_post_type_archive_link('autoescuela');*/ ?>" method="get">
            <input class="InpT" type="text" id="pac-input-search-centro" placeholder="Buscar por ciudad"/>
            <input class="InpT InpTSec" type="submit" value="Encontrar centro" />
            <input id="municipio-search-centro" name="municipio" type="hidden" />
            <input id="provincia-search-centro" name="provincia" type="hidden" />
            <input id="places_search-centro_lat" name="lat" type="hidden" />
            <input id="places_search-centro_lng" name="lng" type="hidden" />
          </form><?php
		  if(true)/*current_user_can('administrator'))*/
		  { ?>
              <form class="item FormGrid buscador_centros_por_nombre" style="clear:both;" action="<?php echo get_permalink(18339); /*echo get_post_type_archive_link('autoescuela');*/ ?>" method="get">
                <input class="InpT" type="text" name="nombre" placeholder="Buscar por nombre"/>
                <input class="InpT InpTSec" type="submit" value="Encontrar centro" />
              </form><?php
		  } ?>
        </div>
      </div>

    </div>
  <?php endif; ?>

    <!-- Block Search form driving School -->


    <!-- Title online courses -->
    <h2 class="MainTitlesCAPSearch MediumSpaced"><?php the_field('FirstTitOnlineCourse'); ?></h2>
    <!-- End title online courses -->

    <!-- Online Courses -->
    <div class="contentGridMainCourse OnlineCourses MediumSpacedBottom">

      <div class="item ItemChild">
        <?php
          $posts = get_field('OnlineCourses');
          if( $posts ): ?>
              <div class="contentGridMainCourse OnlineCourseItem">
              <?php foreach( $posts as $post): // variable must be called $post (IMPORTANT) ?>
                  <?php setup_postdata($post); ?>

                    <div class="item ItemMainCourse">
                      <?php $ImgCO = get_the_post_thumbnail( $post_id, 'large','style=max-width:100%;height:auto;'); ?>
                      <?php echo $ImgCO; ?>
                      <div class="BoxCItemMainCourse">
                        <h3 class="TitleGen"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                        <div class="ButtonGen"><a href="<?php the_permalink(); ?>">Ver este curso</a></div>
                      </div>
                    </div>

              <?php endforeach; ?>
            	</div>
              <?php wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly ?>
          <?php endif; ?>
      </div>

      <div class="item ItemChildT ItemMainCourse BoxSellCourse">

	        <!-- CTA online courses -->
	        <?php
	        if(have_rows('CtaOnlineCourse')):
	          while(have_rows('CtaOnlineCourse')):the_row('CtaOnlineCourse');
	          // vars
	          $LinkOC = get_sub_field('LinkPageOnCo');
	        ?>
	        <div class="TextCenter MinTitleOrange"><?php the_sub_field('MiniTitle');?></div>
	        <div class="MainTitlesCAPSearch"><?php the_sub_field('TitleOnlineCourse');?></div>
	        <h3 class="TitleGen"><?php the_sub_field('CtcCtaOnlineCourse');?></h3>
          <div class="ButtonGen">
            <a href="<?php echo $LinkOC['url']; ?>"><?php echo $LinkOC['title']; ?></a>
          </div>


	      	<?php endwhile; ?>
	    		<?php endif; ?>
	    		<!-- End CTA online courses -->

      </div>

    </div>

    <!-- End online Courses -->

    <!-- SEO block -->
    <?php
    $SeoBlock = get_field('SeoTextLast');
    if($SeoBlock): ?>
    <div class="TextSeoLast LargeSpacedBottom">
      <div class="MainTitlesCAPSearch MediumSpaced"><?php echo $SeoBlock['TitSeoText']; ?></div>
      <div class="BlockTwoSeo">
        <div class="item"><?php echo $SeoBlock['SeoContenT']; ?></div>
        <div class="item"><?php echo $SeoBlock['SeoContenTwo']; ?></div>
      </div>
    </div>

  <?php endif; ?>

    <!-- End SEO block -->



</div>
</section>

    <?php get_footer();
}
// Omit Closing PHP Tags
