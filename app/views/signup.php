<div style="padding-top:40px;" class="mdl-grid">
	<div class="mdl-cell mdl-cell--2-col"></div>
	<div id="login_div" class="mdl-cell mdl-cell--8-col mdl-color--<?php if ( isset( $_SESSION[JBLSALT.'Code'] ) ) { primaryColor(); } else { echo "madge"; } ?>">
		<center>
			<?php frontLogo(); ?>
		</center>

		<form enctype="multipart/form-data" name="registerUser" method="POST" action="" class="mdl-grid">

		  <div class="input-field mdl-cell mdl-cell--5-col">
		  <i class="material-icons prefix">label</i>
		  <input id="fname" name="fname" type="text">
		  <label for="fname">First Name</label>
		  </div>
		         
		  <div class="input-field mdl-cell mdl-cell--6-col">
		  <i class="material-icons prefix">label_outline</i>
		  <input id="lname" name="lname" type="text">
		  <label for="lname">Last Name</label>
		  </div>

		  <div class="input-field mdl-cell mdl-cell--6-col">
		  <i class="material-icons prefix">mail</i>
		  <input class="validate" id="email" name="email" type="email" value="<?php _show_( $_GET['email'] ); ?>">
		  <label for="email" data-error="Please enter a valid email" data-success="OK!" class="center-align">Email Address</label>
		  </div>

		  <div class="input-field mdl-cell mdl-cell--5-col">
		  <i class="material-icons prefix">phone</i>
		  <input  id="phone" name="phone" type="text" value="254">
		  <label for="phone" >Phone Number</label>
		  </div>

		  <?php if ( $_GET['ilk'] !== "organization" ) { ?>
		  <div class="input-field mdl-cell mdl-cell--4-col">
		  <i class="material-icons prefix">lock</i>
		  <input id="password" name="password" type="text">
		  <label for="password">Password</label>
		  </div><?php } ?>

		  <input type="hidden" name="ilk" value="<?php _show_( $_GET['ilk'] ); ?>">

		  <div class="input-field mdl-cell mdl-cell--4-col mdl-js-textfield getmdl-select getmdl-select__fix-height">
		    <i class="material-icons prefix">room</i>
		  <input class="mdl-textfield__input" type="text" id="counties" name="location" readonly tabIndex="-1" placeholder="Location"><label for="counties">
		      <i class="mdl-icon-toggle__label material-icons">keyboard_arrow_down</i>
		  </label>
		  <ul for="counties" class="mdl-menu mdl-menu--top-left mdl-js-menu mdl-color--<?php if ( isset( $_SESSION[JBLSALT.'Code'] ) ) { primaryColor(); } else { echo "madge"; } ?>" style="max-height: 250px !important; overflow-y: auto;">
		      <?php 
		      $county_list = "baringo, bomet, bungoma, busia, elgeyo-marakwet, embu, garissa, homa bay, isiolo, kajiado, kakamega, kericho, kiambu, kilifi, kirinyanga, kisii, kisumu, kitui, kwale, laikipia, lamu, machakos, makueni, mandera, marsabit, meru, migori, mombasa, muranga, nairobi, nakuru, nandi, narok, nyamira, nyandarua, nyeri, samburu, siaya, taita-taveta, tana river, tharaka-nithi, trans-nzoia, turkana, uasin-gishu, vihiga, wajir, west pokot";

		      $cities = "baringo, bomet, Bungoma, Busia, Elgeyo/Marakwet, Embu, Garissa, Homa Bay, Isiolo, Kajiado, Kakamega, Kericho, Kiambu, Kilifi, Kirinyaga, Kisii, Kisumu, Kitui, Kwale, Laikipia, Lamu, Machakos, Makueni, Mandera, Marsabit, Meru, Migori, Mombasa, Murang'a, nairobi city, Nakuru, Nandi, Narok, Nyamira, Nyandarua, Nyeri, Samburu, Siaya, Taita/Taveta, Tana River, Tharaka-Nithi, Trans Nzoia, Turkana, Uasin Gishu, Vihiga, Wajir, West Pokot";
		      $counties = explode( ", ", $county_list );
		      for ( $c=0; $c < count( $counties ); $c++) {
		          $label = ucwords( $counties[$c] );
		          echo '<li class="mdl-menu__item" data-val="'.$counties[$c].'">'.$label.'</li>';
		      }
		       ?>
		  </ul>
		  </div>

		  <?php if ( $ilk !== "organization" ) { ?>
		  <div class="input-field  mdl-cell mdl-cell--3-col mdl-js-textfield mdl-textfield--floating-label getmdl-select">
		    <i class="mdi mdi-gender-transgender prefix"></i>
		   <input class="mdl-textfield__input" id="gender" name="gender" type="text" readonly tabIndex="-1" placeholder="Gender" >
		     <ul class="mdl-menu mdl-menu--top-left mdl-js-menu mdl-color--<?php if ( isset( $_SESSION[JBLSALT.'Code'] ) ) { primaryColor(); } else { echo "madge"; } ?>" for="gender">
		       <li class="mdl-menu__item" data-val="male">Male</li>
		       <li class="mdl-menu__item" data-val="female">Female</li>
		       <li class="mdl-menu__item" data-val="other">Other</li>
		     </ul>
		  </div>
		  
		  <div class="input-field mdl-cell mdl-cell--6-col mdl-js-textfield getmdl-select getmdl-select__fix-height">
		    <i class="material-icons prefix">business</i>
		    <input class="mdl-textfield__input" type="text" id="centers" name="company" readonly tabIndex="-1" placeholder="Organization ( Optional )">
		    <ul for="centers" class="mdl-menu mdl-menu--top-left mdl-js-menu mdl-color--<?php if ( isset( $_SESSION[JBLSALT.'Code'] ) ) { primaryColor(); } else { echo "madge"; } ?>" style="max-height: 300px !important; overflow-y: auto;">
		        <?php $hUser -> getCenters(); ?>
		    </ul>
		  </div><?php } ?>
		  <div class="input-field mdl-cell mdl-cell--5-col">
		  <button class="mdl-button mdl-button--fab mdl-button--colored alignright" type="submit" name="create"><i class="material-icons">send</i></button>
		  </div>

		  <br>
		</form>  
	</div>
	<div class="mdl-cell mdl-cell--2-col"></div>
</div>