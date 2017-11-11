<?php
/**
* @package Jabali - The Plug-N-Play Framework
* @subpackage Forgot password page Layout
* @link https://docs.jabalicms.org/views/forgot/
* @author Mauko Maunde
* @since 0.17.09
* @license MIT - https://opensource.org/licenses/MIT
**/ ?>
<div style="padding-top:40px;" class="mdl-grid">
	<div class="mdl-cell mdl-cell--2-col"></div>
	<div id="login_div" class="mdl-cell mdl-cell--8-col mdl-color--<?php if ( isset( $_SESSION[JBLSALT.'Code'] ) ) { primaryColor(); } else { echo "madge"; } ?>">
		<center><?php frontlogo(); ?></center>
		<form enctype="multipart/form-data" method="POST" action="" class="mdl-grid">

			<div class="input-field mdl-cell mdl-cell--7-col">
			<i class="material-icons prefix">mail</i>
			<input class="validate" name="email" id="email" type="email">
			<label for="email" data-error="Please Enter A Valid Email Address" data-success="Okay. Press the buton to submit" class="center-align">Enter Your Email</label>
			</div>

			<div class="input-field mdl-cell mdl-cell--3-col">
			<button class="mdl-button mdl-button--fab mdl-button--colored alignright" type="submit" name="forgot"><i class="material-icons">send</i></button>
			</div>

		</form>
	</div>
	<div class="mdl-cell mdl-cell--2-col"></div>
</div>