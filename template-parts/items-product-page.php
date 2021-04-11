<!-- Conditonal check product page for "Exam requerid" -->
<?php
// vars
$ReqExam = get_field('RequirExam');
// check
if( $ReqExam ): ?>
<div class="ReqExam">
	<?php foreach( $ReqExam as $ReqExam ): ?>
		<div><span class="ExRequerid"><img src="<?php echo get_stylesheet_directory_uri(); ?>/img/exam-requerid.png" width="" height="" alt="" /></span><?php echo $ReqExam; ?></div>
	<?php endforeach; ?>
</div>
<?php endif; ?>
<!-- End Conditonal check product page for "Exam requerid" -->

<!-- Items block -->
<div class="TimeTable">
<?php
if(have_rows('ItemsRepeater')):
  while (have_rows('ItemsRepeater')): the_row();
    //vars
    $IconItem = get_sub_field('IconHours');
    ?>
    <div class="featProdPag">
      <div class="SpinLine"><img src="<?php echo $IconItem['url']; ?>" /></div>
      <div class="SpinLine"><p><?php the_sub_field('ItemTitle'); ?>: <?php the_sub_field('ItemInfo'); ?> </p></div><br />
    </div>
<?php endwhile; ?>
<?php endif; ?>
</div>
