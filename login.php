<?php
/**
* @package Jabali Framework
* @subpackage Login
* @link https://docs.mauko.co.ke/jabali/login
* @author Mauko Maunde
* @version 0.17.06
**/

session_start();

if (isset($_SESSION['myCode'])) {
    header('Location: ./portal/user?view='.$_SESSION['myCode'].'&key='.$_SESSION['myAlias'].'');
    exit();
}

if (isset($_POST['login']) && $_POST['user'] != "" && $_POST['password'] != "") {

    include 'functions/jabali.php';
    connectDb();

    function isEmail($data) {
      if (filter_var($data, FILTER_VALIDATE_EMAIL)) {
        return true;
      } else {
        return false;
      }
    }

    $user = $_POST['user'];
    $password = md5($_POST['password']);

    $checkMail = isEmail($user);
    if ($checkMail) {
      $result = mysqli_query($GLOBALS['conn'], "SELECT * FROM husers WHERE h_email = '".$user."'");
    } else {
      $result = mysqli_query($GLOBALS['conn'], "SELECT * FROM husers WHERE h_username = '".$user."'");
    }

    if( $result->num_rows > 0 ) {
      while ($row = mysqli_fetch_assoc($result)) {
        $userDetails[] = $row;
      }
    } else {
      ?><div class="alert mdl-color--red">
          <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span> 
          Oops! Something went wrong. Please try again
          </div><?php
    }

    if (!empty($userDetails) && $userDetails[0]['h_password'] = $password ) { 
      $_SESSION['myAlias'] = $userDetails[0]['h_alias'];
      $_SESSION['myUsername'] = $userDetails[0]['h_username'];
      $_SESSION['myCode'] = $userDetails[0]['h_code'];
      $_SESSION['myEmail'] = $userDetails[0]['h_email'];
      $_SESSION['myPhone'] = $userDetails[0]['h_phone'];
      $_SESSION['myCenter'] = $userDetails[0]['h_center'];
      $_SESSION['myCap'] = $userDetails[0]['h_type'];
      $_SESSION['myLocation'] = $userDetails[0]['h_location'];
      $_SESSION['myAvatar'] = $userDetails[0]['h_avatar'];
      $_SESSION['myGender'] = $userDetails[0]['h_gender'];

      header('Location: ./portal/user?view='.$_SESSION['myCode'].'&key='.$_SESSION['myAlias'].'');
      exit();

    } else {
      ?><div class="alert mdl-color--red">
      <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
      Wrong Password
      </div><?php
    } 

} else {
  include 'header.php'; ?>
  <title>Login [ <?php getOption( 'name' ); ?> ]</title>
  <div style="padding-top:40px;" >
      <div id="login_div">
          <center><?php frontlogo(); ?></center>
          <form method="POST" action="">
          <div class="input-field">
          <i class="material-icons prefix">account_circle</i>
          <input name="user" id="email" type="text">
          <label for="email" class="center-align">Username or Email</label>
          </div>

          <div class="input-field">
          <i class="material-icons prefix">lock</i>
          <input name="password" id="password" type="password">
          <label for="password">Password</label>
          </div>
                  
          <div class="input-field">
          <span class="prefix"></span>
          <input type="checkbox" id="remember-me"/>
          <label for="remember-me">Remember me</label>
          </div>
          <button class="mdl mdl-button mdl-button--fab mdl-js-button mdl-button--raised mdl-button--colored" type="submit" name="login"><i class="material-icons">send</i></button>
    

          <p>
          <a href="./register" id="register">Register Now!</a>
          <a href="./forgot" id="forgot">Forgot password?</a>
          </p>

          <br>
          <br>
          </form>
      </div>
  </div><?php
  include 'footer.php';
}  ?>