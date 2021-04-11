<div>
  <div class="HeadLineB TextCenter SmallSpaced titulo-faq-transportista"><?php the_field('FaqTitleLPLearning'); ?></div>
  <div class="FaqGLearning container">
    <?php if( have_rows('FaqGroupLPLearning') ):
      while( have_rows('FaqGroupLPLearning') ): the_row();
      //vars
      $IconFaq = get_sub_field('ArrowDownLP');
      ?>
      <div class="item FaqS">
        <!-- <div><img src="<?php echo $IconFaq ['url']; ?>" /></div> -->
        <div class="SubHeadLineB"><?php the_sub_field('QuestionsLP'); ?></div>
          <div class="TogglE"><img src="<?php echo get_bloginfo('stylesheet_directory'); ?>/img/arow-down-icon.png" /></div>
            <div class="ItemS ChildFaqS"><?php the_sub_field('RespuestasLP'); ?></div>

      </div>
    <?php endwhile; ?>
    <?php endif; ?>
  </div>

  <div class="XLSpacedPaddBott">
    <div class="HeadLineB TextCenter SmallSpaced titulo-form-transportista"><?php the_field('TitleFormLPlearning'); ?></div>
      <div class="FormLPLearninG">
        <div></div>
        <div class="ContactFormLPLearning"><?php echo do_shortcode('[contact-form-7 id="8246" title="Contact-form-test"]'); ?></div>
        <div></div>
      </div>
  </div>
</div>
