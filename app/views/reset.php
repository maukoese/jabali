<div style="padding-top:40px;" >
  <div id="login_div">
		<center><?php frontlogo(); ?></center>
      <form enctype="multipart/form-data" method="POST" action="">

      <div class="input-field">
      <i class="material-icons prefix">lock</i>
      <input class="validate" name="pass1" id="pass1" type="password">
      <label for="pass1">New Password</label>
      </div>

      <div class="input-field">
      <i class="material-icons prefix">lock_outline</i>
      <input name="password" id="password" type="password">
      <label for="password">Repeat Password</label>
      </div>

      <input type="hidden" name="id" value="<?php echo( $user[0]['id'] ); ?>">

      <button class="mdl-button mdl-button--fab mdl-button--colored alignright" type="submit" name="reset"><i class="material-icons">send</i></button>

      <p>
      <a href="./register" id="register">Register</a>
      </p>

      <br>
      <br>
      </form>
  </div>
</div>