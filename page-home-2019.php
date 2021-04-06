<?php
/**
 * Template name: Pagina de inicio
 * The template for displaying all pages.
 *
 * @package Betheme
 * @author Muffin group
 * @link http://muffingroup.com
 */

get_header();
?>

<div id="home2019">
    <!-- #Content -->

<div class="container">
<!-- One block -->
<section class="OneBlock">

    <!-- Main title -->
    <?php echo the_field('MainTitleSearchPage'); ?>
    <!-- Main title -->

    <div class="row">
      <!-- Search Home -->
      <div class="col-12 col-sm-12 col-md-8 col-lg-8 col-xl-8">
          <div class="section_wrapper slide-home">
              <div>
                  <h2 class="titulo_form"><?php _e('Buscador CAP Continua','academiatransportista'); ?></h2>
                  <p><?php _e('Contamos con la mayor red de centros de formación. Más de 10.000 cursos en más de 500 autoescuelas y centros CAP de toda España.','academiatransportista'); ?></p><?php
                  get_template_part('template-parts/search-form'); ?>
              </div>
          </div>
      </div>
      <!-- End Search Home -->

      <!-- Benefits -->
      <div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
            <?php
            if(have_rows('BenefHome')):
            while(have_rows('BenefHome')): the_row();
            //vars
            $ImgIcon = get_sub_field('IconBenefit');
            ?>
            <img src="<?php echo $ImgIcon['url']; ?>" />
            <?php the_sub_field('TitBenefit'); ?>
            <?php the_sub_field('ContBenefit'); ?>
          <?php endwhile; ?>
        <?php endif; ?>
      </div>
      <!-- End benefits -->
    </div>

</section>
<!-- End one block -->


<!-- Block: Main Courses -->
<section class="MainCourses">
  <!-- Main courses title -->
  <?php the_field('TitlemainCourses'); ?>
  <!-- end main courses title -->

  <?php
    $posts = get_field('MainCours');

    if( $posts ): ?>
        <div class="row">
        <?php foreach( $posts as $post): // variable must be called $post (IMPORTANT) ?>
            <?php setup_postdata($post); ?>
            <div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
              <?php $ImgPdt = get_the_post_thumbnail( $post_id, 'thumbnail'); ?>
              <?php echo $ImgPdt; ?>
              <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
              <a href="<?php the_permalink(); ?>">Ver este curso</a>
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
          <div style="background-image:url('<?php echo $ImgOne['url']; ?>')">

          <div class="row">
            <div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
              <img src="<?php echo $ImgTwo['url']; ?>" alt="<?php echo $ImgTwo['alt']; ?>" />
            </div>

            <div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
              <?php the_sub_field('FirsTitleClubAT'); ?>
              <?php the_sub_field('SecTitleClubAT'); ?>
              <?php the_sub_field('ContentClubAT'); ?>
            </div>

            <div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
              <a href="<?php echo $Link['url']; ?>"><?php echo $Link['title']; ?></a>
            </div>
          </div>




          </div>

        <?php endwhile?>
      <?php endif; ?>
    <!-- Block Club AT banner -->

    <!-- Title online courses -->
    <?php the_field('FirstTitOnlineCourse'); ?>
    <!-- End title online courses -->



    <!-- Online Courses -->
    <div class="row">
      <div class="col-12 col-sm-8 col-md-8 col-lg-8 col-xl-8">
        <?php
          $posts = get_field('OnlineCourses');
          if( $posts ): ?>
              <div class="row">
              <?php foreach( $posts as $post): // variable must be called $post (IMPORTANT) ?>
                  <?php setup_postdata($post); ?>

                    <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                      <?php $ImgCO = get_the_post_thumbnail( $post_id, 'thumbnail'); ?>
                      <?php echo $ImgCO; ?>
                      <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                    </div>

              <?php endforeach; ?>
            </div>
              <?php wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly ?>
          <?php endif; ?>
      </div>
      <div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
        <!-- CTA online courses -->
        <?php
        if(have_rows('CtaOnlineCourse')):
          while(have_rows('CtaOnlineCourse')):the_row('CtaOnlineCourse');
          // vars
          $LinkOC = get_sub_field('LinkPageOnCo');
        ?>
        <?php the_sub_field('MiniTitle');?>
        <?php the_sub_field('TitleOnlineCourse');?>
        <?php the_sub_field('CtcCtaOnlineCourse');?>
        <a href="<?php echo $LinkOC['url']; ?>"><?php echo $LinkOC['title']; ?></a>
      <?php endwhile; ?>
    <?php endif; ?>
    <!-- End CTA online courses -->
      </div>
    </div>


    <!-- End online Courses -->



</div>
</div>

    <?php get_footer();

    // Omit Closing PHP Tags
