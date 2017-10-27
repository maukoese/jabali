
<div class="mdl-grid" >
	<div class="mdl-cell mdl-cell--3-col"></div>
	<div id="login_div" class="mdl-cell mdl-cell--6-col mdl-color--madge">
		<center>
			<?php echo '<br><a href="'._ROOT.'"><img src="'._IMAGES.'logo-w.png" width="150px;"></a>'; 
			if ( isset( $_GET['alert'] ) ) {
			if ( $_GET['alert'] == "password" ) { ?>
			<div id="fail" class="alert mdl-color--red">
			<span>Wrong Password!<br>Please Try Again</span>
			</div><?php 
			} elseif ( $_GET['alert'] == "user" ) { ?>
			<div id="fail" class="alert mdl-color--red">
			<span>Wrong Email/Username!<br>Please Try Again</span>
			</div><?php 
			}
			} ?>
			<div class="mdl-grid">
			<div class="mdl-cell mdl-cell--12-col mdl-grid">
				<div class="mdl-cell">
					<a class="mdl-button mdl-button--fab mdl-color--indigo" href="<?php echo _ROOT; ?>signin/facebook">
						<i class="fa fa-facebook fa-2x mdl-color-text--white"></i>
					</a>
				</div>
				<div class="mdl-cell">
					<a class="mdl-button mdl-button--fab mdl-color--light-blue" href="<?php echo _ROOT; ?>signin/twitter">
						<i class="fa fa-twitter fa-2x mdl-color-text--white"></i>
					</a>
				</div>
				<div class="mdl-cell">
					<a class="mdl-button mdl-button--fab mdl-color--red" href="<?php echo _ROOT; ?>signin/google">
						<i class="fa fa-google fa-2x mdl-color-text--white"></i>
					</a>
				</div>
			</div>
			<div class="mdl-cell mdl-cell--12-col">
				<form enctype="multipart/form-data" method="POST" action="" class="mdl-grid">
					<div class="input-field mdl-cell mdl-cell--12-col">
						<i class="material-icons prefix">perm_identity</i>
						<input name="user" id="email" type="text">
						<label for="email" class="center-align">Username or Email</label>
					</div>

					<div class="input-field mdl-cell mdl-cell--12-col">
						<i class="material-icons prefix">lock</i>
						<input name="password" id="password" type="password">
						<label for="password">Password</label>
					</div>

					<div class="mdl-cell mdl-cell--12-col">
						<span class="prefix"></span>
						<input type="checkbox" id="remember-me" name="stay" />
						<label for="remember-me">Remember me</label>
					</div>
					<br>
					<div class="input-field mdl-cell mdl-cell--12-col">
						<span class="prefix"></span>
						<a class="" href="forgot">Forgot password?</a>
					</div>

					<?php csrf(); ?>

					<div class="input-field input-field mdl-cell mdl-cell--12-col">
						<button class="mdl mdl-button mdl-button--fab mdl-js-button mdl-button--raised mdl-color--green alignright" type="submit" name="login"><i class="material-icons">send</i></button><br>
					</div>
				</form>
			</div>
		</center>
	</div>
	<div class="mdl-cell mdl-cell--3-col"></div>
</div>