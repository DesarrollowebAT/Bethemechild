<div class="container">
  <?php if( have_rows('HeadLPLearning') ):
    while( have_rows('HeadLPLearning') ): the_row();
    //vars
    $LinkCTAOn = get_sub_field('ctaLP');
  ?>
  <div class="HeroLPLearning MediumSpacedPadd">
    <div class="item">
      <div class="SubHeadLineB"><?php the_sub_field('TitLP'); ?></div>
      <div class="HeadLineB"><h1 class="titulo-pedagogica"><?php the_sub_field('SubTitLP'); ?></h1></div>
        <a href="<?php echo $LinkCTAOn ['url']; ?>"><div class="HeroPush SmallSpacedTop"><?php echo $LinkCTAOn['title']; ?></div></a>
    </div>
    <?php endwhile; ?>
    <?php endif; ?>
    <div class="item">
        <div class="HeroForm">
          <?php echo do_shortcode('[contact-form-7 id="8246" title="Contact-form-test"]'); ?>
        </div>
    </div>
  </div>

</div>
