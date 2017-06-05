<?php
session_start();

if (isset($_POST['create'])) {

    include 'functions/jabali.php';
    connectDb();

    $date = date('YmdHms');
    if (isset($_SESSION['myEmail'])) {
      $email = $_SESSION['myEmail'];
    } else {
      $email = hEMAIL;
    }

    $hash = str_shuffle(md5($email.$date));
    $abbr = substr($_POST['lname'], 0,2);

    $h_alias = $_POST['fname'].' '.$_POST['lname'];
    $h_author = substr($hash, 20);
    $h_avatar = hIMAGES.'avatar.svg';
    $h_center = $_POST['h_center'];
    $h_code = substr($hash, 20);
    $h_created = date('Ymd');
    $h_email = $_POST['h_email'];
    $h_gender = strtolower($_POST['h_gender']);
    $h_key = $hash;
    $h_level = $_POST['h_level'];
    $h_link = hPORTAL."user?view=$h_code";
    $h_location = strtolower( $_POST['h_location'] );
    $h_notes = "Account created on ".$date;
    $h_password = md5($_POST['h_password']);
    $h_phone = $_POST['h_phone'];
    $h_status = "active"; //Sort emailuser();, Change to "pending"
    $h_style = "zahra";
    $h_type = strtolower( $_POST['h_type'] );
    $h_username = strtolower($_POST['fname'].$abbr);

    if (mysqli_query($GLOBALS['conn'], "INSERT INTO husers (h_alias, h_author, h_avatar, h_center, h_code, h_created, h_email, h_gender, h_key, h_level, h_link, h_location, h_notes, h_password, h_phone, h_status, h_style, h_type, h_username) 
    VALUES ('".$h_alias."', '".$h_author."', '".$h_avatar."', '".$h_center."', '".$h_code."', '".$h_created."', '".$h_email."', '".$h_gender."', '".$h_key."', '".$h_level."', '".$h_link."', '".$h_location."', '".$h_notes."', '".$h_password."', '".$h_phone."', '".$h_status."', '".$h_style."', '".$h_type."', '".$h_username."')")) {
        header("Location: ./register?create=success");
      } else {
        header("Location: ./register?create=fail");
      }

} elseif (isset($_POST['resource'])) {
    # code...
} elseif (isset($_POST['request'])) {
    # code...
} else {
    include 'header.php'; ?>
<title>Register [ <?php getOption('name'); ?> ]</title>
<div style="padding-top:40px;" >
    <div id="login_div">
        <center><?php 
        if (isset($_GET['create'])) {
            if ($_GET['create'] == "success") { ?>
                <div id="success" class="alert mdl-color--green">
                    <span>Success!<br>Check your email for a confirmation link</span>
                </div><?php
            } elseif ($_GET['create'] == "fail") { ?>
            <div id="fail" class="alert mdl-color--red">
                <span>Oops!<br>We Ran Into A Problem. Please Try Again</span>
            </div><?php }
        } 
        frontlogo(); ?>
        </center>

        <center>
        <ul id="tabs-swipe-demo" style="border-radius: 5px;" class="tabs">
            <li class="tab col s3"><a class="active" href="#test-swipe-1">Create Account</a></li>
            <li class="tab col s3"><a href="#test-swipe-2">Add Resource</a></li>
            <li class="tab col s3"><a href="#test-swipe-3">Request Service</a></li>
        </ul>
        </center>

        <div id="test-swipe-1" class="col s12">
            <form name="registerUser" method="POST" action="">

            <div class="input-field">
            <i class="material-icons prefix">label</i>
            <input id="fname" name="fname" type="text">
            <label for="fname">First Name</label>
            </div>
                   
            <div class="input-field">
            <i class="material-icons prefix">label_outline</i>
            <input id="lname" name="lname" type="text">
            <label for="lname">Last Name</label>
            </div>

            <div class="input-field">
            <i class="material-icons prefix">mail</i>
            <input class="validate" id="email" name="h_email" type="email">
            <label for="email" data-error="Please enter a valid email" data-success="OK!" class="center-align">Email Address</label>
            </div>

            <div class="input-field">
            <i class="material-icons prefix">phone</i>
            <input  id="h_phone" name="h_phone" type="text" value="254">
            <label for="h_phone" data-error="wrong" data-success="right" class="center-align">Phone Number</label>
            </div>

            <div class="input-field">
            <i class="material-icons prefix">lock</i>
            <input id="password" name="h_password" type="text">
            <label for="password">Password</label>
            </div>

            <div class="input-field mdl-textfield mdl-js-textfield mdl-textfield--floating-label getmdl-select getmdl-select__fullwidth">
              <i class="material-icons prefix">perm_identity</i>
               <input class="mdl-textfield__input" id="h_type" name="h_type" type="text" readonly tabIndex="-1" placeholder="Type" />
                 <ul class="mdl-menu mdl-menu--top-left mdl-js-menu mdl-color--<?php if (isset($_SESSION['myCode'])) { primaryColor($_SESSION['myCode']); } else { show( 'blue' ); }?>" for="h_type"><?php
                   $getAdmin = mysqli_query($GLOBALS['conn'], "SELECT h_type FROM husers WHERE h_type = 'admin'");
                   if ($getAdmin) {
                    show( '<li class="mdl-menu__item" data-val="admin">Admin</li>' );
                   } ?>
                   <li class="mdl-menu__item" data-val="doctor">Doctor</li>
                   <li class="mdl-menu__item" data-val="manager">Manager</li>
                 </ul>
              </div>

            <div class="input-field mdl-textfield mdl-js-textfield mdl-textfield--floating-label getmdl-select getmdl-select__fix-height">
              <i class="material-icons prefix">room</i>
            <input class="mdl-textfield__input" type="text" id="counties" name="h_location" readonly tabIndex="-1" placeholder="Location">
            <ul for="counties" class="mdl-menu mdl-menu--top-left mdl-js-menu mdl-color--<?php if (isset($_SESSION['myCode'])) { primaryColor($_SESSION['myCode']); } else { echo "blue"; } ?>" style="max-height: 250px !important; overflow-y: auto;">
                <?php 
                $county_list = "baringo, bomet, bungoma, busia, elgeyo-marakwet, embu, garissa, homa bay, isiolo, kakamega, kajiado, kapenguria, kericho, kiambu, kilifi, kirinyanga, kisii, kisumu, kitui, kwale, laikipia, lamu, machakos, makueni, mandera, marsabit, meru, migori, mombasa, muranga, nairobi, nakuru, nandi, narok, nyamira, nyandarua, nyeri, ol kalou, samburu, siaya, taita-taveta, tana river, tharaka-nithi, trans-nzoia, turkana, uasin-gishu, vihiga, wajir, west pokot";
                $counties = explode(", ", $county_list);
                for ($c=0; $c < count($counties); $c++) {
                    $label = ucwords($counties[$c]);
                    echo '<li class="mdl-menu__item" data-val="'.$counties[$c].'">'.$label.'</li>';
                }
                 ?>
            </ul>
            </div>

            <div class="input-field inline mdl-textfield mdl-js-textfield mdl-textfield--floating-label getmdl-select">
              <i class="mdi mdi-gender-transgender prefix"></i>
             <input class="mdl-textfield__input" id="h_gender" name="h_gender" type="text" readonly tabIndex="-1" placeholder="Gender" >
               <ul class="mdl-menu mdl-menu--top-left mdl-js-menu mdl-color--<?php if (isset($_SESSION['myCode'])) { primaryColor($_SESSION['myCode']); } else { echo "blue"; } ?>" for="h_gender">
                 <li class="mdl-menu__item" data-val="male">Male</li>
                 <li class="mdl-menu__item" data-val="female">Female</li>
                 <li class="mdl-menu__item" data-val="other">Other</li>
               </ul>
            </div>

            <div class="input-field inline">
            <i class="material-icons prefix">local_hospital</i>
            <input id="h_center" name="h_center" type="text">
            <label for="h_center">Center</label>
            </div>

            <button class="mdl-button mdl-button--fab mdl-button--colored alignright" type="submit" name="create"><i class="material-icons">send</i></button>

            <br>
            </form>
        </div>

        <div id="test-swipe-2" class="col s12">
            <form name="registerResource" method="POST" action="" ">
              <div class="input-field">
                <i class="material-icons prefix">label</i>
              <input id="rh_alias" name="h_alias" type="text" >
              <label for="rh_alias">Resource Name</label>
              </div>                       

              <div class="input-field inline mdl-textfield mdl-js-textfield mdl-textfield--floating-label getmdl-select">
                <i class="material-icons prefix">business</i>
                 <input class="mdl-textfield__input" id="rh_type" name="h_type" type="text" readonly tabIndex="-1" placeholder="Center" >
                   <ul class="mdl-menu mdl-menu--bottom-left mdl-js-menu mdl-color--<?php if (isset($_SESSION['myCode'])) { primaryColor($_SESSION['myCode']); } else { echo "blue"; } ?>" for="rh_type">
                     <li class="mdl-menu__item" data-val="center">Center</li>
                     <li class="mdl-menu__item" data-val="equipment">Equipment</li>
                     <li class="mdl-menu__item" data-val="lab">Lab</li>
                     <li class="mdl-menu__item" data-val="ward">Ward</li>
                   </ul>
                </div>

              <div class="input-field mdl-textfield mdl-js-textfield mdl-textfield--floating-label getmdl-select getmdl-select__fix-height">
                <i class="material-icons prefix">room</i>
              <input class="mdl-textfield__input" type="text" id="rcounties" name="h_location" readonly tabIndex="-1" placeholder="Location">
              <ul for="rcounties" class="mdl-menu mdl-menu--bottom-left mdl-js-menu mdl-color--<?php if (isset($_SESSION['myCode'])) { primaryColor($_SESSION['myCode']); } else { echo "blue"; } ?>" style="max-height: 300px !important; overflow-y: auto;">
                  <?php 
                  $county_list = "baringo, bomet, bungoma, busia, elgeyo-marakwet, embu, garissa, homa bay, isiolo, kakamega, kajiado, kapenguria, kericho, kiambu, kilifi, kirinyanga, kisii, kisumu, kitui, kwale, laikipia, lamu, machakos, makueni, mandera, marsabit, meru, migori, mombasa, muranga, nairobi, nakuru, nandi, narok, nyamira, nyandarua, nyeri, ol kalou, samburu, siaya, taita-taveta, tana river, tharaka-nithi, trans-nzoia, turkana, uasin-gishu, vihiga, wajir, west pokot";
                  $counties = explode(", ", $county_list);
                  for ($c=0; $c < count($counties); $c++) {
                      $label = ucwords($counties[$c]);
                      echo '<li class="mdl-menu__item" data-val="'.$counties[$c].'">'.$label.'</li>';
                  }
                   ?>
              </ul>
              </div>

              <div class="input-field inline">
                <i class="material-icons prefix">phone</i>
              <input  id="rh_phone" name="h_phone" type="text" placeholder="254" >
              <label for="rh_phone" class="center-align">Contact Phone</label>
              </div>


              <div class="input-field">
                <i class="material-icons prefix">local_hospital</i>
              <input id="rh_center" name="h_center" type="text" >
              <label for="rh_center">Center</label>
              </div>

              <div class="input-field">
                <i class="material-icons prefix">mail</i>
              <input class="validate" id="remail" name="h_email" type="email" >
              <label for="remail" data-error="wrong" data-success="right" class="center-align">Admin Email</label>
              </div><br>

              <button class="mdl-button mdl-button--fab mdl-button--colored mdl-js-button mdl-js-ripple-effect alignright" type="submit" name="rcreate"><i class="material-icons">send</i></button>  
        </form>
        </form>
        </div>


        <div id="test-swipe-3" class="col s12">
        <form name="registerService" method="POST" action="">
              <div class="input-field">
                <i class="material-icons prefix">label</i>
                <input id="sh_alias" name="h_alias" type="text" >
                <label for="sh_alias">Subject</label>
              </div> 

              <input type="hidden" name="h_author" >
              <input type="hidden" name="h_by"  >

            <div class="input-field inline mdl-textfield mdl-js-textfield mdl-textfield--floating-label getmdl-select">
                <i class="material-icons prefix">perm_identity</i>
                <input class="mdl-textfield__input" id="sh_type" name="h_type" type="text" readonly tabIndex="-1" placeholder="Patient" data-val="patient">
               <ul class="mdl-menu mdl-menu--bottom-left mdl-js-menu mdl-color--<?php if (isset($_SESSION['myCode'])) { primaryColor($_SESSION['myCode']); } else { echo "blue"; } ?>" for="sh_type"><?php
                   $getAdmin = mysqli_query($GLOBALS['conn'], "SELECT h_type FROM husers WHERE h_type = 'admin'");
                   if (!$getAdmin) {
                    show( '<li class="mdl-menu__item" data-val="admin">Admin</li>' );
                   } ?>
                 <li class="mdl-menu__item" data-val="doctor">Doctor</li>
                 <li class="mdl-menu__item" data-val="manager">Manager</li>
               </ul>
            </div>

            <div class="input-field inline mdl-textfield mdl-js-textfield mdl-textfield--floating-label getmdl-select">
              <i class="mdi mdi-adjust prefix"></i>
               <input class="mdl-textfield__input" id="sh_gender" name="h_gender" type="text" readonly tabIndex="-1" placeholder="Request" data-val="request">
                 <ul class="mdl-menu mdl-menu--bottom-left mdl-js-menu mdl-color--<?php if (isset($_SESSION['myCode'])) { primaryColor($_SESSION['myCode']); } else { echo "blue"; } ?>" for="sh_gender">
                   <li class="mdl-menu__item" data-val="request">Request</li>
                   <li class="mdl-menu__item" data-val="confirmation">Confirmation</li>
                   <li class="mdl-menu__item" data-val="followup">Follow Up</li>
                 </ul>
              </div>

              <div class="input-field mdl-textfield mdl-js-textfield mdl-textfield--floating-label getmdl-select getmdl-select__fix-height">
                <i class="material-icons prefix">room</i>
                  <input class="mdl-textfield__input" type="text" id="scounties" name="h_location" readonly tabIndex="-1" placeholder="Location">
                  <ul for="scounties" class="mdl-menu mdl-menu--bottom-left mdl-js-menu mdl-color--<?php if (isset($_SESSION['myCode'])) { primaryColor($_SESSION['myCode']); } else { echo "blue"; }; ?>" style="max-height: 300px !important; overflow-y: auto;"><?php 
                      $county_list = "baringo, bomet, bungoma, busia, elgeyo-marakwet, embu, garissa, homa bay, isiolo, kakamega, kajiado, kapenguria, kericho, kiambu, kilifi, kirinyanga, kisii, kisumu, kitui, kwale, laikipia, lamu, machakos, makueni, mandera, marsabit, meru, migori, mombasa, muranga, nairobi, nakuru, nandi, narok, nyamira, nyandarua, nyeri, ol kalou, samburu, siaya, taita-taveta, tana river, tharaka-nithi, trans-nzoia, turkana, uasin-gishu, vihiga, wajir, west pokot";
                      $counties = explode(", ", $county_list);
                      for ($c=0; $c < count($counties); $c++) {
                          $label = ucwords($counties[$c]);
                          echo '<li class="mdl-menu__item" data-val="'.$counties[$c].'">'.$label.'</li>';
                      }
                       ?>
                  </ul>
              </div>

              <div class="input-field inline">
                <i class="material-icons prefix">phone</i>
              <input  id="sh_phone" name="h_phone" type="text" placeholder="254">
              <label for="sh_phone" class="center-align">Phone Number</label>
              </div>


              <div class="input-field inline">
                <i class="material-icons prefix">local_hospital</i>
              <input id="sh_center" name="h_center" type="text" >
              <label for="sh_center">Center</label>
              </div>

              <div class="input-field inline">
                <i class="material-icons prefix">mail</i>
              <input class="validate" id="semail" name="h_email" type="email">
              <label for="semail" class="center-align">Email Address</label>
              </div>
                     
              <div class="input-field">
              <i class="mdi mdi-note-plus prefix"></i>
              <textarea class="materialize-textarea col s12" rows="5" id="sh_notes" name="h_notes" >
                Add your notes here.
              </textarea>
              <script>CKEDITOR.replace( 'sh_notes' );</script>
              </div><br>

              <button class="mdl-button mdl-button--fab mdl-button--colored mdl-js-button mdl-js-ripple-effect alignright" type="submit" name="screate"><i class="material-icons">send</i></button>  
        </form>
        </div>   
</div><?php
    include 'footer.php';
} ?>
