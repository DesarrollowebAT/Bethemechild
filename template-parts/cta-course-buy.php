<div class="SideBarOfflineCourse">
	<div class="CtaCourseBuy">
    	<div class="TitlesPPageForm">Horario, fecha y lugar</div><?php
	    if(have_rows('ItemsRepeater')):
		    while (have_rows('ItemsRepeater')): the_row();
				//vars
				$IconItem = get_sub_field('IconHours'); ?>
				<div class="featProdPag">
					<div class="SpinLine"><img src="<?php echo $IconItem['url']; ?>" /></div>
					<div class="SpinLine"><p><?php the_sub_field('ItemTitle'); ?>: <?php the_sub_field('ItemInfo'); ?> </p></div><br />
				</div><?php 
			endwhile;
		endif; ?>
	</div>
	<div class="CertiFied">
		<div class="TitlesPPageForm">Titulación obtenida</div><?php 
		the_field('DegreeC'); ?>
	</div>
	<!-- Box -->
	<div class="SideBarCourse">
		<div class="TitlesPPageForm">Qué incluye este curso</div><?php
	    // vars
    	$SideBar = get_field('ContentSideBar');
    	// check
	    if( $SideBar ): ?>
		    <div class="ReqExam"><?php 
				foreach( $SideBar as $SideBar ): ?>
                	<div><span class="ExRequerid"><img src="<?php echo get_stylesheet_directory_uri(); ?>/img/check-subject.png" width="" height="" alt="" /></span><?php echo $SideBar; ?></div><?php 
				endforeach; ?>
            </div><?php 
		endif; ?>
	</div>
</div>
