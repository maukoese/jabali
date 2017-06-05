<?php include './header.php'; ?>
<title>What is JABALI? [ <?php getOption('name'); ?> ]</title>
    <div class="demo-layout mdl-layout mdl-layout--fixed-header mdl-js-layout mdl-color--grey-100">
      <div class="demo-main mdl-layout__content">
      <div class="demo-ribbon mdl-color--<?php primaryColor($_SESSION['myCode']); ?>" style="background: url(<?php echo hIMAGES.'logo.png' ?>);">
      <center><img src="<?php echo hIMAGES.'logo-w.png' ?>" width="250px;"></center></div>
      
        <div class="demo-container mdl-grid">
          <div class="demo-content mdl-color--white mdl-shadow--4dp content mdl-color-text--grey-800 mdl-cell mdl-cell--12-col">
            <b><h3><?php getOption('name'); ?></h3></b><br><br>
            <div>
              <?php getOption('description'); ?>
            </div>
            <div ><br><br>
              <h5>Get In Touch</h5>
              <?php $hForm -> contactForm(); ?>
          </div>
        </div>
      </div>
    </div>
<?php include './footer.php';