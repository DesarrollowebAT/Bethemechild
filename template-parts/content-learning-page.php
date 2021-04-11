    <div id="pasos" class="container">
        <!-- Block 1 -->
        <?php
        $ContentOne = get_field('ContLPLearning');
        if($ContentOne): ?>
        <div class="TextCenter LargeSpacedBottom">
          <div class="SubHeadLineB"><h2 class="titulo-content"><?php echo $ContentOne['TitContLPLearning']; ?></h2></div>
          <div class="HeadLineB MinSpacedBottom"><h3 class="subtitulo-content"><?php echo $ContentOne['SubContLPLearning']; ?></h3></div>
          <div class="MaintexT"><?php echo $ContentOne['TextContLPLearning']; ?></div>
        </div>

        <?php endif; ?>

        <!-- Block 2 -->
        <div class="ListCoursesLP">
        <?php if( have_rows('MinTitLPLearning') ):
          while( have_rows('MinTitLPLearning') ) : the_row();
        ?>
          <div class="item TextCenter SmallSpaced">
            <div class="SubHeadLineB"><?php the_sub_field('ItemMinTitle'); ?></div>
          </div>
        <?php endwhile; ?>
        <?php endif; ?>
        </div>

        <!-- Block 3 -->
        <?php
        $posts = get_field('CoursesBlock');
        if( $posts ): ?>
        	<div class="BlockShiP">
        	<?php foreach( $posts as $p ): // variable must NOT be called $post (IMPORTANT) ?>
            <?php setup_postdata($post); ?>
                <?php $Imgcourse = get_the_post_thumbnail( $p->ID, 'large','style=max-width:100%;height:auto;'); ?>
                  <div class="item ItemMainCourse">
                    <a target="_blank" href="<?php the_permalink( $p->ID ); ?>">
                      <div><?php echo $Imgcourse; ?></div>
                      <div class="BoxCItemMainCourse">
                        <div class="TitleGen"><a target="_blank" href="<?php echo get_permalink( $p->ID ); ?>"><?php echo get_the_title( $p->ID ); ?></a></div>
                        <div class="ButtonGen"><a target="_blank" href="<?php the_permalink( $p->ID ); ?>"><div>Sacarse el carnet</div></a></div>
                      </div>

                    </a>
                  </div>
        	<?php endforeach; ?>
        </div>
          <?php wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly ?>
        <?php endif; ?>

        <!-- Block 4 -->
        <div class="ShipCoursE SmallSpaced">
          <?php if( have_rows('CertTranspotLPLearning') ):
            while( have_rows('CertTranspotLPLearning') ): the_row();
            //vars
            $IconCertF = get_sub_field('iconctlplearing');
            ?>
            <div class="item itemCertificatioN">
              <div class="item"><img src="<?php echo $IconCertF['url']; ?>" /></div>
              <div class="item">
                <?php the_sub_field('MinTextctLPlearing'); ?>
                <div class="SubHeadLineB"><?php the_sub_field('TitCerttLPlearing'); ?></div>
              </div>

            </div>
          <?php endwhile; ?>
          <?php endif; ?>
        </div>

        <!-- Block Cap Inicial -->
        <?php
        $ContentOne = get_field('ContLPInicial');
        if($ContentOne): ?>
        <div class="TextCenter LargeSpacedBottom">
          <div class="HeadLineB TextCenter SmallSpacedBotto"><h3 class="titulo-content-inicial"><?php echo $ContentOne['TitContLPInicial']; ?></h3></div>
          <div class="MaintexT"><?php echo $ContentOne['TextContLPInicial']; ?></div>
        </div>

        <?php endif; ?>

        <!-- CTA -->
        <?php

        $link = get_field('WhatIsInitCap');

        if( $link ):
        	$link_url = $link['url'];
        	$link_title = $link['title'];
        	?>
          <div class="WhatIsInitCaP">
            <a target="_blank" href="<?php echo esc_url($link_url); ?>"><div class="HeroPush"><?php echo esc_html($link_title); ?></div></a>
          </div>
        <?php endif; ?>
        
        <!-- Block Obtener Titulo -->
        <?php
        $ContentOne = get_field('ContLPObtener');
        if($ContentOne): ?>
        <div class="TextCenter LargeSpacedBottom">
          <div class="HeadLineB TextCenter SmallSpacedBotto espacio-content"><?php echo $ContentOne['TitContLPObtener']; ?></div>
          <div class="MaintexT"><?php echo $ContentOne['TextContLPObtener']; ?></div>
        </div>

        <?php endif; ?>

        <!-- CTA -->
        <?php

        $link = get_field('WhatIsInitCapCon');

        if( $link ):
        	$link_url = $link['url'];
        	$link_title = $link['title'];
        	?>
          <div class="WhatIsInitCaP margen-cta-obtener">
            <a target="_blank" href="<?php echo esc_url($link_url); ?>"><div class="HeroPush"><?php echo esc_html($link_title); ?></div></a>
          </div>
        <?php endif; ?>

        <!-- Block 5 -->
        <?php if( have_rows('ImDrivingNow') ):
          while( have_rows('ImDrivingNow') ): the_row();
          // vars
          $ImgDriving = get_sub_field('ImgDN');
          $imgBGOrange = get_sub_field('ImgbackOrange');
          $LinkDriving = get_sub_field('CtaBlockDN');
          ?>
      </div>

          <div class="ImDrivingSection XLSpacedPaddBott" style="background-image:url(<?php echo $imgBGOrange['url']; ?>)">
            <div class="container">
              <img class="DrivingS" src="<?php echo $ImgDriving['url']; ?>" />
                <div class="TextCenter SuperPadd">
                  <div class="HeadLineW"><?php the_sub_field('SecSubTextDN'); ?></div>
                  <div class="SubHeadLineW LargeSpacedBottom MinSpacedTop"><?php the_sub_field('PharDN'); ?></div>
                  <a target="_blank" class="LinkDrivingS" href="<?php echo $LinkDriving['url']; ?>"><?php echo$LinkDriving['title']; ?></a>
                </div>
            </div>
          </div>

        <?php endwhile; ?>
        <?php endif; ?>
