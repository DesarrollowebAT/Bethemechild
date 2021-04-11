<?php
/**
 * Template name: Landing_page_pedagogica
 * The template for displaying all pages.
 *
 * @package Betheme

 * @author Muffin group
 * @link http://muffingroup.com
 */
get_header();
?>

<section>
  <div class="LP_Learning">
    <!-- Block header -->
      <?php get_template_part('template-parts/head-learning-page'); ?>
    <!-- End block header -->
    <div>
        <div class="BoxWhiteShadow XLSpacedPaddTop">
          <!-- Block content courses -->
            <?php get_template_part('template-parts/content-learning-page'); ?>
          <!-- end block content courses -->

          <!-- Block I'm driving! -->
            <?php get_template_part('template-parts/driving-learning-page');  ?>
          <!-- End block I'm driving! -->

          <!-- Block FAQ & contact form -->
            <?php get_template_part('template-parts/faqform-learning-page');  ?>
          <!-- End block FAQ -->

        </div>
      </div>
  </div>
</section>

<?php get_footer();
