<!-- Block One -->
    <?php
    $ImptCourse = get_field('ImptCourse');
    if( !empty($ImptCourse)): ?>
    <div class="DivEmpty">
      <div class="TitlesPPage"><?php echo $ImptCourse['TitleImptCourse']; ?></div>
      <?php echo $ImptCourse['PharImptCourse']; ?>
    </div>
  <?php endif; ?>
<!-- End block One -->

<!-- Block two -->
  <div class="SubjectCourseBlock">
    <div class="TitlesPPage"><?php the_field('LearnigCourse'); ?></div>
       <h2 class="title-temario">Temario <?php echo get_the_title(); ?></h2>
    <?php
    if( have_rows('SubjectCourse')): ?>
    <div class="BlockTwo">
      <?php while( have_rows('SubjectCourse')): the_row(); ?>
      <?php if(get_sub_field('Unityname')) {
      ?>
      <div>
        <span><img class="ChekPoint" src="<?php echo get_stylesheet_directory_uri(); ?>/img/check-subject.png" alt="Logo" class="logo-img"/></span><?php the_sub_field('Unityname'); ?>
      </div>
    <?php
    }
    ?>
    <?php endwhile; ?>
    </div>
    <?php endif; ?>
  </div>

<!-- End block two -->

<!-- What do I get certification -->
<?php if (have_rows('GroupCert')): ?>
  <?php while(have_rows('GroupCert')): the_row();
  //vars
  $ImgGetCert = get_sub_field('ImgCertGroup');
  ?>
  <h3 class="TitlesPPage"><?php the_sub_field('GroupTitle'); ?></h3>


  <div class="JobCert"><?php the_sub_field('CertName'); ?></div>
  <?php the_sub_field('ContentCert'); ?>
  <img src="<?php echo $ImgGetCert['url']; ?>" />
  <?php endwhile; ?>
<?php endif; ?>


<!-- End What do I get certification -->

<!-- Block three -->
<div id="GenMainContent">
  <?php if(get_field('GeneralContent')): ?>
    <?php the_field('GeneralContent'); ?>
  <?php endif; ?>
</div>
<!-- Block three -->

<!-- Block four -->
<?php
$fileD = get_field('DownloadFiles');
$fileDI = get_field('DownloadFilesII');
if( ($fileD) || ($fileDI)): ?>

<div class="BlockDownloads SubjectCourseBlock">
  <div class="TitlesPPage"><?php the_field('DownloadS'); ?></div>
  <?php if($fileD): ?>
  <div class="DownFileSubj">
    <div class="DownOnee">
      <a href="<?php echo $fileD['url']; ?>" target="_blank"><span class="whiteText">Descarga la ficha técnica de este temario </span><?php echo $fileD['filename']; ?></a>
    </div>
    <div><img class="PdfDown" src="<?php echo get_stylesheet_directory_uri(); ?>/img/pdf-icon.png" alt="Logo" class="logo-img"/></div>
  </div>
  <!-- End block four -->
<?php endif; ?>
  <!-- Block four -->
  <?php if($fileDI): ?>
  <div class="DownFileSubj">
    <div class="DownOnee">
      <a href="<?php echo $fileDI['url']; ?>" target="_blank"><span class="whiteText">Descarga real decreto </span><?php echo $fileDI['filename']; ?></a>
    </div>
    <div><img class="PdfDown" src="<?php echo get_stylesheet_directory_uri(); ?>/img/pdf-icon.png" alt="Logo" class="logo-img"/></div>
  </div>
<?php endif; ?>
</div>

  <?php endif; ?>
<!-- End block four -->
