<div style="padding-top:40px;" class="mdl-grid">
	<div class="mdl-cell mdl-cell--2-col"></div>
	<div id="login_div" class="mdl-cell mdl-cell--8-col mdl-color--<?php if ( isset( $_SESSION[JBLSALT.'Code'] ) ) { primaryColor(); } else { echo "madge"; } ?>">
	<center><br><?php echo '<a href="'._ROOT.'"><img src="'._IMAGES.'logo-w.png" width="150px;"></a>'; 
	if ( isset( $_GET['create'] ) ) {
	if ( $_GET['create'] == "success" ) { ?>
	<div id="success" class="alert mdl-color--green">
	  <span>Success!<br>Check your email for a confirmation link</span>
	</div><?php 
	} elseif ( $_GET['create'] == "fail" ) { ?>
	<div id="fail" class="alert mdl-color--red">
	<span>Oops!<br>We Ran Into A Problem. Please Try Again</span>
	</div><?php 
	} elseif ( $_GET['create'] == "exists" ) { ?>
	<div id="exists" class="alert mdl-color--red">
	<span>Oops!<br>A User Already Exists With That Email. Please Try Again With A Different Email.</span>
	</div><?php 
	}
	} ?>
	</center>

	<form enctype="multipart/form-data" name="registerUser" method="GET" action="" class="mdl-grid">

	<div class="input-field mdl-cell mdl-cell--12-col">
	<i class="material-icons prefix">mail</i>
	<input id="email" name="email" type="text">
	<label for="email">Email Address</label>
	</div>

	<div class="input-field mdl-cell mdl-cell--3-col mdl-js-textfield getmdl-select">
	<i class="material-icons prefix">perm_identity</i>
	 <input class="mdl-textfield__input" id="ilk" name="ilk" type="text" readonly tabIndex="-1" placeholder="Type"><label for="ilk">
	<i class="mdl-icon-toggle__label material-icons">keyboard_arrow_down</i>
	</label>
	   <ul class="mdl-menu mdl-menu--bottom-left mdl-js-menu mdl-color--<?php if ( isset( $_SESSION[JBLSALT.'Code'] ) ) { primaryColor(); } else { echo "madge"; } ?>" for="ilk" ><?php 
	     if ( $_SESSION[JBLSALT.'Cap'] == "admin"  ) {
	      echo( '<li class="mdl-menu__item" data-val="admin">Admin<i class="mdl-color-text--white mdi mdi-lock alignright" role="presentation"></i></li>' );
	     } ?>
	     <li class="mdl-menu__item" data-val="organization">Organization<i class="mdl-color-text--white mdi mdi-city alignright" role="presentation"></i></li>
	     <li class="mdl-menu__item" data-val="editor">Buyer<i class="mdl-color-text--white mdi mdi-note alignright" role="presentation"></i></li>
	     <li class="mdl-menu__item" data-val="author">Seller<i class="mdl-color-text--white mdi mdi-note-plus alignright" role="presentation"></i></li>
	     <li class="mdl-menu__item" data-val="subscriber">Subscriber<i class="mdl-color-text--white mdi mdi-email alignright" role="presentation"></i></li>
	   </ul>
	</div>
	<div class="input-field mdl-cell mdl-cell--6-col"></div>

	<input type="hidden" name="ilk" value="<?php echo( $ilk ); ?>">
	<div class="input-field mdl-cell mdl-cell--3-col">
	<button class="mdl-button mdl-button--fab mdl-button--colored alignright" type="submit" name="register" value="true"><i class="material-icons">arrow_forward</i></button>
	</div>
	</form>  
	</div>
	<div class="mdl-cell mdl-cell--2-col"></div>
</div>