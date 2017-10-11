<title><?php showOption( 'name' ); ?></title>
<div class="mdl-grid">
			<title><?php showOption( 'name' ); ?> [ <?php showOption( 'description' ); ?> ]</title>
		      <div class="mmm-ribbon mdl-color--<?php if ( isset( $_SESSION[JBLSALT.'Code'] ) ){ primaryColor(); } else { echo "madge"; } ?>" style="background: url( <?php _show_( $post['avatar']); ?> ); background-repeat:no-repeat; background-size: cover; background-position: center; background-blend-mode: color-dodge; min-height: 600px; max-height: 750px;">
		      <center><h1><br><b><?php showOption ( 'name' ); ?></b></h1>
		      <span><h3><b><?php showOption ( 'description' ); ?></b></h3></span>
		      <a href="<?php _show_( _ROOT.'/purchase' ); ?>" class="waves-effect waves-light btn-large mdl-color--<?php if ( isset( $_SESSION[JBLSALT.'Code'] ) ){ primaryColor(); } else { echo "madge"; } ?>"><i class="material-icons left">shopping_cart</i>GET BOOK</a></center>
		      </div>
		      
			<div class="demo-container">
			<div class="demo-content mdl-color--white content mdl-color-text--black mdl-shadow--2dp mdl-grid">
				<div class="mdl-cell mdl-cell--3-col-desktop mdl-cell--3-col-tablet mdl-cell--12-col-phone mdl-color--<?php if ( isset( $_SESSION[JBLSALT.'Code'] ) ){ primaryColor(); } else { echo "madge"; } ?> card">
					<div class="card-image waves-effect waves-block waves-light">
						<center>
							<h1 class="fa fa-globe fa-3x blue-text"></h1>
						</center>
					</div>
					<div class="card-content mdl-color-text--white">
						<center>
							<b class="card-title grey-text text-darken-4">Web</b>
							<p>Read the book online and engage in discussions with other readers.</p>
						</center>
					</div>
				</div>
				<div class="mdl-cell mdl-cell--3-col-desktop mdl-cell--3-col-tablet mdl-cell--12-col-phone mdl-color--<?php if ( isset( $_SESSION[JBLSALT.'Code'] ) ){ primaryColor(); } else { echo "madge"; } ?> card">
					<div class="card-image waves-effect waves-block waves-light">
						<center>
							<h1 class="fa fa-android fa-3x green-text"></h1>
						</center>
					</div>
					<div class="card-content mdl-color-text--black">
						<center>
							<b class="card-title grey-text text-darken-4">Mobile</b>
							<p>Engage interactively with the book on your Android phone as a native app.</p>
						</center>
					</div>
				</div>
				<div class="mdl-cell mdl-cell--3-col-desktop mdl-cell--3-col-tablet mdl-cell--12-col-phone mdl-color--<?php if ( isset( $_SESSION[JBLSALT.'Code'] ) ){ primaryColor(); } else { echo "madge"; } ?> card">
					<div class="card-image waves-effect waves-block waves-light">
						<center>
							<h1 class="fa fa-tablet fa-3x snow-text"></h1>
						</center>
					</div>
					<div class="card-content mdl-color-text--white">
						<center>
							<b class="card-title grey-text text-darken-4">E-book/Audiobook</b>
							<p>Download book in epub/pdf/txt or mp3/mp4 to read/listen to wherever you go.</p>
						</center>
					</div>
				</div>
				<div class="mdl-cell mdl-cell--3-col-desktop mdl-cell--3-col-tablet mdl-cell--12-col-phone mdl-color--<?php if ( isset( $_SESSION[JBLSALT.'Code'] ) ){ primaryColor(); } else { echo "madge"; } ?> card">
					<div class="card-image waves-effect waves-block waves-light">
						<center>
							<h1 class="fa fa-book fa-3x white-text"></h1>
						</center>
					</div>
					<div class="card-content mdl-color-text--white">
						<center>
							<b class="card-title grey-text text-darken-4">Hard Copy</b>
							<p>Get the print edition to gift to someone or even for yourself.</p>
						</center>
					</div>
				</div>

				<div class="mdl-card mdl-cell mdl-cell--7-col mdl-color--<?php if ( isset( $_SESSION[JBLSALT.'Code'] ) ){ primaryColor(); } else { echo "madge"; } ?>">
					<article class="mdl-card__supporting-text white-text">
					<p class="white-text">This 21-poem collection is a labor of love for a gift that was sent but has not yet been delivered. The poems included in this book touch on various subjects, issues and thoughts; it is a peek into a dream of mine as well as a record of sorts for posterity. When it is her time, I want Zahra to read this and get a glimpse of my time.</p>
					<p class="white-text"><span class="mdl-button mdl-button--fab mdl-button--icon"><i class="fa fa-facebook blue-text"></i></span> Zahra Books & Publication
					<br><span class="mdl-button mdl-button--fab mdl-button--icon"><i class="fa fa-twitter light-blue-text"></i></span> @zahrabks
					<br><span class="mdl-button mdl-button--fab mdl-button--icon"><i class="fa fa-phone black-text"></i></span> <?php showOption( 'phone' ); ?>
					<br><span class="mdl-button mdl-button--fab mdl-button--icon"><i class="fa fa-envelope snow-text"></i></span> <?php showOption( 'email' ); ?></p>
					</article>
				</div>

				<div class="mdl-cell mdl-cell--5-col <?php if ( isset( $_SESSION[JBLSALT.'Code'] ) ){ primaryColor(); } else { echo "madge"; } ?> white-text">
					<center><h5>Get In Touch</h5></center>
					<form class="mdl-grid">
						<div class="input-field mdl-cell mdl-cell--12-col">
							<i class="material-icons prefix">mail</i>
							<input type="text" name="">
							<label>Your Email</label>
						</div>

						<div class="input-field mdl-cell mdl-cell--12-col">
							<i class="material-icons prefix">description</i>
							<textarea class="materialize-textarea"></textarea>
							<label>Your Message</label>
						</div>
						<div class="input-field mdl-cell mdl-cell--12-col">
						  <button class="btn waves-effect waves-light green" type="submit" name="contact"> Submit
						    <i class="material-icons right">send</i>
						  </button>
						</div>
					</form>
				</div>
			</div>
			</div>
</div>