
<!-- Block One -->
    <?php
    $ImptCourse = get_field('ImptCourse');
    if( !empty($ImptCourse)): ?>
    <div class="DivEmpty">
      <?php echo $ImptCourse['TitleImptCourse']; ?>
      <?php echo $ImptCourse['PharImptCourse']; ?>
    </div>
  <?php endif; ?>
<!-- End block One -->

<!-- Block two -->
<?php
if( have_rows('SubjectCourse')): ?>
  <?php while( have_rows('SubjectCourse')): the_row(); ?>

  <?php if(get_sub_field('Unityname')) {
  ?>
<div class="BlockTwo">
  <span><img src="<?php echo get_stylesheet_directory_uri(); ?>/img/check-subject.png" alt="Logo" class="logo-img"/></span><?php the_sub_field('Unityname'); ?>
</div>
<?php
}
?>
<?php endwhile; ?>
<?php endif; ?>
<!-- End block two -->

<!-- Block three -->
<?php if(get_field('GeneralContent')): ?>
  <?php the_field('GeneralContent'); ?>
<?php endif; ?>
<!-- Block three -->

<!-- Block four -->
<?php
$fileD = get_field('DownloadFiles');
if( !empty($fileD) ): ?>
<div class="DownFileSubj">
  <a href="<?php echo $fileD['url']; ?>"><?php echo $fileD['filename']; ?></a>
</div>
<?php endif; ?>
<!-- End block four -->
