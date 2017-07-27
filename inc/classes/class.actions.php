<?php 
/**
* Front Actions
*/
class _hActions {

	/**
	* 
	**/
	function connectDB() {
		$conn = mysqli_connect( hDBHOST, hDBUSER, hDBPASS, hDBNAME );

		if ( mysqli_connect_errno() ) {
			printf( "Connection failed: %s\ ", mysqli_connect_error() );
			exit();
		} else {
			return $conn;
		}
	}

	function frontlogo() {

		echo '<a href="'.hROOT.'"><img src="'.hIMAGES.'logo-w.png" width="150px;"></a>';
	}

	function isEmail( $data ) {
	  if ( filter_var( $data, FILTER_VALIDATE_EMAIL) ) {
	    return true;
	  } else {
	    return false;
	  }
	}

	function emailExists( $email ) {
		$theEmail = mysqli_query( _hActions::connectDB(), "SELECT h_email FROM ". hDBPREFIX ."users WHERE h_email ='".$email."'" );
		if ( $theEmail -> num_rows > 0 ) {
			return true;
		} else {
			return false;
		}
	}

	function error404( $code ) { ?>
		<title>Error 404</title>
		<div style="margin:1%;" class="mdl-grid" >
			<center>
				<div class="mdl-cell mdl-cell--7-col mdl-card mdl-color--red" >
					<div class="mdl-card-media">
						<img src="<?php _show_( hIMAGES.'404.jpg'); ?>" width="100%" style="overflow: hidden;" >
					</div>
					<div class="mdl-card__title mdl-card--expand">
						<div class="mdl-card__title-text">
						<center>Error 404! <?php _show_( ucwords( $code ) ); ?> Not Found!</center>
					</div>
				  	<div class="mdl-layout-spacer"></div>
				  	<div class="mdl-card__subtitle-text">
				    	<i class="material-icons">search</i>
				 	</div>
				</div>
				<div class="mdl-card__menu">
				<a href="./index.php" class="mdl-button mdl-js-ripple-effect mdl-button--icon"><i class="material-icons">home</i></a>
				</div>
				</div>
			</center>
		</div><?php 
	}

	function login() {
		if ( isset( $_SESSION['myCode'] ) ) {
			header( 'Location: admin/index?page=my dashboard' );
			exit();
		} else {
			if ( isset( $_GET['provider'] ) ) { 
				if ( $_GET['provider'] == "jabali" ) {
				  	include 'header.php'; ?>
				  	<title>Login <?php _show_( ucfirst( $_GET['alert'] ) ); ?> [ <?php showOption( 'name' ); ?> ]</title>
				  	<div style="padding-top:40px;" class="mdl-grid" >
					  	<div class="mdl-cell mdl-cell--2-col"></div>
						<div id="login_div" class="mdl-cell mdl-cell--8-col>
							<center><?php echo '<a href="'.hROOT.'"><img src="'.hIMAGES.'logo-w.png" width="150px;"></a>'; 
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
							</center>
						  <form enctype="multipart/form-data" method="POST" action="" class="mdl-grid mdl-color--madge"">
						      <div class="input-field mdl-cell mdl-cell--11-col">
						      <i class="material-icons prefix">perm_identity</i>
						      <input name="user" id="email" type="text">
						      <label for="email" class="center-align">Username or Email</label>
						      </div>

						      <div class="input-field mdl-cell mdl-cell--11-col">
						      <i class="material-icons prefix">lock</i>
						      <input name="password" id="password" type="password">
						      <label for="password">Password</label>
						      </div>
						              
						      <div class="input-field inline">
						      <span class="prefix"></span>
						      <input type="checkbox" id="remember-me" name="stay" />
						      <label for="remember-me">Remember me</label>
						      </div>
						      <div class="input-field inline">
						      <a class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-color--red" href="./forgot">Forgot password?</a>
						      </div>
						      <div class="input-field inline">
						      	<button class="mdl mdl-button mdl-button--fab mdl-js-button mdl-button--raised mdl-color--green alignright" type="submit" name="login"><i class="material-icons">send</i></button><br>
						      </div>
						  </form>
						</div>
					  	<div class="mdl-cell mdl-cell--2-col"></div>
				  	</div><?php
				  	include 'footer.php'; 
				} else { 
					require_once( 'inc/config.php' );
				  	require_once( 'inc/jabali.php' );
				  	connectDb(); ?>
				  	<title>Login <?php _show_( ucfirst( $_GET['alert'] ) ); ?> [ <?php showOption( 'name' ); ?> ]</title><?php
				  	include 'inc/lib/hybridauth/config.php';
				  	require_once( 'inc/lib/hybridauth/Hybrid/Auth.php' );
					$provider = $_GET['provider'];
					try{
				    $hybridauth = new Hybrid_Auth( $config );
				    $authProvider = $hybridauth->authenticate($provider);
				    $user_profile = $authProvider->getUserProfile();
					    if($user_profile && isset($user_profile->identifier))
					    {
					        echo "<b>Name</b> :".$user_profile->displayName."<br>";
					        echo "<b>Profile URL</b> :".$user_profile->profileURL."<br>";
					        echo "<b>Image</b> :".$user_profile->photoURL."<br> ";
					        echo "<img src='".$user_profile->photoURL."'/><br>";
					        echo "<b>Email</b> :".$user_profile->email."<br>";
					        echo "<br> <a href='logout.php'>Logout</a>";
					    }           
				    }

				    catch( Exception $e ) { 
				        switch( $e->getCode() )
				        {
				                case 0 : echo "Unspecified error."; break;
				                case 1 : echo "Hybridauth configuration error."; break;
				                case 2 : echo "Provider not properly configured."; break;
				                case 3 : echo "Unknown or disabled provider."; break;
				                case 4 : echo "Missing provider application credentials."; break;
				                case 5 : echo "Authentication failed The user has canceled the authentication or the provider refused the connection.";
				                         break;
				                case 6 : echo "User profile request failed. Most likely the user is not connected to the provider and he should to authenticate again.";
				                         $authProvider->logout();
				                         break;
				                case 7 : echo "User not connected to the provider.";
				                         $authProvider->logout();
				                         break;
				                case 8 : echo "Provider does not support this feature."; break;
				        }
				 
				        echo "<br /><br /><b>Original error message:</b> " . $e->getMessage();
				 
				        echo "<hr /><h3>Trace</h3> <pre>" . $e->getTraceAsString() . "</pre>";
				    }
				}
			} else {
			  	include 'header.php'; ?>
			  	<title>Login <?php _show_( ucfirst( $_GET['alert'] ) ); ?> [ <?php showOption( 'name' ); ?> ]</title>
			  	<div class="mdl-grid" >
			  	<div class="mdl-cell mdl-cell--2-col"></div>
				<div id="login_div" class="mdl-cell mdl-cell--8-col mdl-color--madge">
					<center><?php echo '<a href="'.hROOT.'"><img src="'.hIMAGES.'logo-w.png" width="150px;"></a>'; 
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
							<a class="mdl-button mdl-color--indigo" href="./login?provider=facebook"><i class="mdi mdi-24px mdi-facebook	 mdl-color-text--white"></i> Login With Facebook</a></div>
							<div class="mdl-cell">
							<a class="mdl-button mdl-color--light-blue" href="./login?provider=twitter"><i class="mdi mdi-24px mdi-twitter fa-2x mdl-color-text--white"></i> Login With Twitter</a></div>
							<div class="mdl-cell">
							<a class="mdl-button mdl-color--red" href="./login?provider=google"><i class="mdi mdi-24px mdi-google fa-2x mdl-color-text--white"></i> Login With Google</a></div>
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
						              
						      <div class="input-field mdl-cell">
						      <span class="prefix"></span>
						      <input type="checkbox" id="remember-me" name="stay" />
						      <label for="remember-me">Remember me</label>
						      </div>
						      <div class="input-field mdl-cell">
						      <a class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-color--red" href="./forgot">Forgot password?</a>
						      </div>

						      <div class="input-field mdl-cell">
						      	<button class="mdl mdl-button mdl-button--fab mdl-js-button mdl-button--raised mdl-color--green alignright" type="submit" name="login"><i class="material-icons">send</i></button><br>
						      </div>
						  </form>
							</div>
					</center>
				</div>
			  	<div class="mdl-cell mdl-cell--2-col"></div>
			  	</div><?php
			  	include 'footer.php';
			}
		}
	}

	function loginUser() {
		session_start();

		$user=$_POST['user'];
		$password=$_POST['password'];

		$user = stripslashes($user);
		$password = stripslashes($password);
		$user = mysqli_real_escape_string( _hActions::connectDB(), $user);
		$password = mysqli_real_escape_string( _hActions::connectDB(), $password);
		$password = md5($password);

		if ( _hActions::isEmail( $user ) ) {
		  $result = mysqli_query( _hActions::connectDB(), "SELECT * FROM ". hDBPREFIX ."users WHERE h_email = '".$user."'" );
		} else {
		  $result = mysqli_query( _hActions::connectDB(), "SELECT * FROM ". hDBPREFIX ."users WHERE h_username = '".$user."'" );
		}

		if ( $result -> num_rows > 0 ) {
			while ( $userDetails = mysqli_fetch_assoc( $result ) ) {
				if ( $userDetails['h_password'] == $password ) {
					$_SESSION['myAlias'] = $userDetails['h_alias'];
					$_SESSION['myUsername'] = $userDetails['h_username'];
					$_SESSION['myCode'] = $userDetails['h_code'];
					$_SESSION['myEmail'] = $userDetails['h_email'];
					$_SESSION['myPhone'] = $userDetails['h_phone'];
					$_SESSION['myOrg'] = $userDetails['h_organization'];
					$_SESSION['myCap'] = $userDetails['h_type'];
					$_SESSION['myLocation'] = $userDetails['h_location'];
					$_SESSION['myAvatar'] = $userDetails['h_avatar'];
					$_SESSION['myGender'] = $userDetails['h_gender'];

					header( 'Location: admin/index?page=my dashboard' );
					exit();
				} else {
					header('Location: ./login?alert=password' );
					exit();
				}
			}
		} else {
			header('Location: ./login?alert=user' );
			exit();
		}
	}

	function register(){
		if ( isset( $_GET['register'] ) && $_GET['email'] !== "") {
			if ( _hActions::emailExists( $_GET['email'] ) ) {
				header("Location: ./register?create=exists");
			} else {
				include 'header.php'; ?>
				<title>New <?php _show_( ucwords( $_GET['type'] ) ); ?> [ <?php showOption( 'name' ); ?> ]</title>
				<div style="padding-top:40px;" class="mdl-grid">
				  <div class="mdl-cell mdl-cell--2-col"></div>
				  <div id="login_div" class="mdl-cell mdl-cell--8-col mdl-color--madge">
				      <center><?php echo '<a href="'.hROOT.'"><img src="'.hIMAGES.'logo-w.png" width="150px;"></a>'; ?>
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
					          <input class="validate" id="email" name="h_email" type="email" value="<?php _show_( $_GET['email'] ); ?>">
					          <label for="email" data-error="Please enter a valid email" data-success="OK!" class="center-align">Email Address</label>
					          </div>

					          <div class="input-field mdl-cell mdl-cell--5-col">
					          <i class="material-icons prefix">phone</i>
					          <input  id="h_phone" name="h_phone" type="text" value="254">
					          <label for="h_phone" data-error="wrong" data-success="right" class="center-align">Phone Number</label>
					          </div>

					          <?php if ( $_GET['type'] !== "organization" ) { ?>
					          <div class="input-field mdl-cell mdl-cell--4-col">
					          <i class="material-icons prefix">lock</i>
					          <input id="password" name="h_password" type="text">
					          <label for="password">Password</label>
					          </div><?php } ?>

					          <input type="hidden" name="h_type" value="<?php _show_( $_GET['type'] ); ?>">

					          <div class="input-field  mdl-cell mdl-cell--4-col mdl-js-textfield mdl-textfield--floating-label getmdl-select getmdl-select__fix-height">
					            <i class="material-icons prefix">room</i>
					          <input class="mdl-textfield__input" type="text" id="counties" name="h_location" readonly tabIndex="-1" placeholder="Location"><label for="counties">
					              <i class="mdl-icon-toggle__label material-icons">keyboard_arrow_down</i>
					          </label>
					          <ul for="counties" class="mdl-menu mdl-menu--top-left mdl-js-menu mdl-color--<?php if ( isset( $_SESSION['myCode'] ) ) { primaryColor(); } else { echo "grey"; } ?>" style="max-height: 250px !important; overflow-y: auto;">
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

					          <?php if ( $_GET['type'] !== "organization" ) { ?>
					          <div class="input-field  mdl-cell mdl-cell--3-col mdl-js-textfield mdl-textfield--floating-label getmdl-select">
					            <i class="mdi mdi-gender-transgender prefix"></i>
					           <input class="mdl-textfield__input" id="h_gender" name="h_gender" type="text" readonly tabIndex="-1" placeholder="Gender" >
					             <ul class="mdl-menu mdl-menu--top-left mdl-js-menu mdl-color--<?php if ( isset( $_SESSION['myCode'] ) ) { primaryColor(); } else { echo "grey"; } ?>" for="h_gender">
					               <li class="mdl-menu__item" data-val="male">Male</li>
					               <li class="mdl-menu__item" data-val="female">Female</li>
					               <li class="mdl-menu__item" data-val="other">Other</li>
					             </ul>
					          </div>
					          
					          <div class="input-field mdl-cell mdl-cell--6-col mdl-js-textfield mdl-textfield--floating-label getmdl-select getmdl-select__fix-height">
					            <i class="material-icons prefix">business</i>
					            <input class="mdl-textfield__input" type="text" id="centers" name="h_organization" readonly tabIndex="-1" placeholder="Organization ( Optional )">
					            <ul for="centers" class="mdl-menu mdl-menu--top-left mdl-js-menu mdl-color--<?php if ( isset( $_SESSION['myCode'] ) ) { primaryColor(); } else { echo "grey"; } ?>" style="max-height: 300px !important; overflow-y: auto;">
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
				</div><?php 
		    	include 'footer.php';
			}
		} elseif (isset( $_GET['confirm'] ) && $_GET['key'] !== "" ) {
			_hActions::confirmUser( $_GET['confirm'], $_GET['key'] );
		} else {
				include 'header.php'; ?>
				<title>Register <?php _show_( ucwords( $_GET['type'] ) ); ?> [ <?php showOption( 'name' ); ?> ]</title>
				<div style="padding-top:40px;" class="mdl-grid">
				  <div class="mdl-cell mdl-cell--2-col"></div>
				  <div id="login_div" class="mdl-cell mdl-cell--8-col mdl-color--madge">
				      <center><?php echo '<a href="'.hROOT.'"><img src="'.hIMAGES.'logo-w.png" width="150px;"></a>'; 
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
				                 <input class="mdl-textfield__input" id="h_type" name="h_type" type="text" readonly tabIndex="-1" placeholder="Type"><label for="h_type">
				               <i class="mdl-icon-toggle__label material-icons">keyboard_arrow_down</i>
				              </label>
				                   <ul class="mdl-menu mdl-menu--bottom-left mdl-js-menu mdl-color--madge" for="h_type" ><?php 
				                     if ( $_SESSION['myCap'] == "admin"  ) {
				                      _show_( '<li class="mdl-menu__item" data-val="admin">Admin<i class="mdl-color-text--white mdi mdi-lock alignright" role="presentation"></i></li>' );
				                     } ?>
				                     <li class="mdl-menu__item" data-val="organization">Organization<i class="mdl-color-text--white mdi mdi-city alignright" role="presentation"></i></li>
				                     <li class="mdl-menu__item" data-val="editor">Buyer<i class="mdl-color-text--white mdi mdi-note alignright" role="presentation"></i></li>
				                     <li class="mdl-menu__item" data-val="author">Seller<i class="mdl-color-text--white mdi mdi-note-plus alignright" role="presentation"></i></li>
				                     <li class="mdl-menu__item" data-val="subscriber">Subscriber<i class="mdl-color-text--white mdi mdi-email alignright" role="presentation"></i></li>
				                   </ul>
				                </div>
				                <div class="input-field mdl-cell mdl-cell--6-col"></div>

					          <input type="hidden" name="h_type" value="<?php _show_( $_GET['type'] ); ?>">
					          <div class="input-field mdl-cell mdl-cell--3-col">
					          <button class="mdl-button mdl-button--fab mdl-button--colored alignright" type="submit" name="register" value="true"><i class="material-icons">arrow_forward</i></button>
					          </div>
				          </form>  
				  </div>
				  	<div class="mdl-cell mdl-cell--2-col"></div>
				</div><?php 
		    	include 'footer.php';}
	}

	function registerUser() {
		$conn = _hActions::connectDB();
		define('hIMAGES', hROOT.'inc/assets/images/');
		
		if ( _hActions::emailExists( $_POST['h_email'] ) )
		{
			header( "Location: ./register?create=exists" );
		} else 
		{
		    $date = date( "YmdHms" );
		    $email = $_POST['h_email'];

		    $hash = str_shuffle(md5( $email.$date ) );
		    $abbr = substr( $_POST['lname'], 0,3 );

		    $h_alias = $_POST['fname'].' '.$_POST['lname'];
		    $h_author = substr( $hash, 20 );
		    
		    $h_avatar = hIMAGES.'avatar.svg';
		    $h_organization = mysqli_real_escape_string( $conn, $_POST['h_organization'] );
		    $h_code = md5(date('l jS \of F Y h:i:s A').rand(10,1000) );
		    $h_description = "";
		    $h_created = date('Ymd' );
		    $h_email = mysqli_real_escape_string( $conn, $_POST['h_email'] );
		    $h_gender = strtolower( $_POST['h_gender'] );
		    $h_key = $hash;
		    $h_level = mysqli_real_escape_string( $conn, $_POST['h_level'] );
		    $h_link = hROOT."user?view=$h_code&key=$h_alias";
		    $h_location = strtolower( $_POST['h_location'] );
		    $h_notes = "Account created on ".$date;
		    $h_password = md5( $_POST['h_password'] );
		    $h_phone = mysqli_real_escape_string( $conn, $_POST['h_phone'] );

		    if ( !$_POST['h_status'] ) {
		      $h_status = "pending";
		    } else {
		      $h_status = $_POST['h_status'];
		    }
		    $h_social = '{"facebook":"https://www.facebook.com/","twitter":"https://twitter.com/","instagram":"https://instagram.com/","github":"https://github.com/"}';
		    $h_style = "zahra";
		    $h_type = strtolower( $_POST['h_type'] );
		    $h_username = strtolower( $_POST['fname'].$abbr );

			if ( mysqli_query( $GLOBALS['conn'], "INSERT INTO ". hDBPREFIX ."users (h_alias, h_author, h_avatar, h_organization, h_code, h_created, h_description, h_email, h_gender, h_key, h_level, h_link, h_location, h_notes, h_password, h_phone, h_social, h_status, h_style, h_type, h_username) 
    VALUES ('".$h_alias."', '".$h_author."', '".$h_avatar."', '".$h_organization."', '".$h_code."', '".$h_created."', '".$h_description."', '".$h_email."', '".$h_gender."', '".$h_key."', '".$h_level."', '".$h_link."', '".$h_location."', '".$h_notes."', '".$h_password."', '".$h_phone."', '".$h_social."', '".$h_status."', '".$h_style."', '".$h_type."', '".$h_username."' )" ) ) {
			header( "Location: ./register?create=success" );
			} else {
			//header( "Location: ./register?create=fail" );
			echo "Error: " . $conn -> error;
			}
		}
	}

	function postTypes() {
		$getTypes = mysqli_query( $GLOBALS['conn'], "SELECT DISTINCT h_type FROM ". hDBPREFIX ."posts");
		$types = mysqli_fetch_assoc( $getTypes );
		return $types;
	}

	function fetchPosts( $code ) { 
		include 'header.php' ;
			$getPosts = mysqli_query( $GLOBALS['conn'], "SELECT * FROM ". hDBPREFIX ."posts WHERE h_link = '".$code."'" );
			if ( $getPosts -> num_rows > 0) { ?>
				<div class="mdl-grid"><?php 
					while ( $postsDetails = mysqli_fetch_assoc( $getPosts)){  ?>
						<title><?php _show_( $postsDetails['h_alias']); ?> [ <?php showOption( 'name' ); ?> ]</title>
					      <div class="mmm-ribbon mdl-color--<?php if ( isset( $_SESSION['myCode'] ) ){ primaryColor(); } else { echo "madge"; } ?>" style="background: url( <?php _show_( $postsDetails['h_avatar']); ?> ); background-repeat:no-repeat; background-size: cover; background-position: center;">
					      <center><h1><b><?php _show_( $postsDetails['h_alias']); ?></b></h1>
					      <span><h6>Published by <b><?php _show_( $postsDetails['h_by']); ?></b> on <b><?php $date = $postsDetails['h_created'];
              $date = explode(" ", $date); _show_( $date[0].' at '.$date[1] ); ?></b></h6></span></center>
					      </div>
					      
					        <div class="demo-container">
					          	<div class="demo-content mdl-color--white content mdl-color-text--black mdl-grid">
						            <article class="mdl-color-text--black">
						            	<?php _show_( $postsDetails['h_description']); ?>
						            </article>
						            <?php _hForms::commentForm(); ?>
						        </div>
					      </div>
					<?php } ?>
				</div><?php _hSocial::bottomShare( $postsDetails['h_code'] );
				include 'footer.php';
			} else {
				_hActions::error404( 'post' );
			}
 
	  	include 'footer.php';
	}

	function blog() { 
		include 'header.php' ; ?>
		<title>Blog [ <?php showOption( 'name' ); ?> ]</title><?php
		$this -> connectDB();
		$getPosts = mysqli_query( $conn, "SELECT * FROM ". hDBPREFIX ."posts WHERE h_status = 'published' ORDER BY h_created DESC" );
		if ( $getPosts -> num_rows > 0) { ?>
			<div class="mdl-grid">
				<div class="mdl-cell mdl-cell--9-col mdl-grid"><?php 
				while ( $postsDetails = mysqli_fetch_assoc( $getPosts)){ ?>
					<div class="mdl-cell card">
						<div class="card-image waves-effect waves-block waves-light">
							<img class="activator" src="<?php _show_( $postsDetails['h_avatar'] ); ?>">
						</div>

						<div class="card-content mdl-color-text--black">
							<a href="<?php _show_( hROOT.$postsDetails['h_link'] ); ?>"><span class="card-title grey-text text-darken-4"><?php _show_( $postsDetails['h_alias'] ); ?><i class="material-icons right">arrow_forward</i></span></a>
							<span class="mdl-list__item mdl-color-text--black"><i class="material-icons mdl-list__item-icon mdl-color-text--black">today</i><span style="padding-left: 20px"><?php $date = $postsDetails['h_created'];
							$date = explode(" ", $date); _show_( $date[0] ); ?></span>
						</div>

						<div class="card-reveal mdl-color-text--black">
							<span class="card-title grey-text text-darken-4"><i class="material-icons left">perm_identity</i> <a href="./user/<?php _show_( $postsDetails['h_by'] ); ?>"><?php _show_( $postsDetails['h_by'] ); ?></a><i class="material-icons right">close</i></span><br>
							<article>
							<?php _show_( substr( $postsDetails['h_description'], 0, 240 ) ); 
							?> ...

							</article> 
							<a class="mdl-button mdl-button--colored" href="<?php _show_( hROOT.$postsDetails['h_link'] ); ?>">read more</a><br>
							<p>Posted In: <a href="./category/<?php _show_( $postsDetails['h_category'] ); ?>"><?php _show_( ucwords( $postsDetails['h_category'] ) ); ?></a></p>
							<p>Tagged: <a href="./tag/<?php _show_( $postsDetails['h_tags'] ); ?>"><?php _show_( ucwords( $postsDetails['h_tags'] ) ); ?></a></p>
						</div>
					</div><?php 
				} ?>
				</div>
				<div class="mdl-cell mdl-cell--3-col" >
				<form>
					<center>
						<div class="input-field">
							<i class="material-icons prefix">search</i>
							<input type="text" placeholder="Search Blog">
						</div>
					</center>
				</form>
				</div>
			</div><?php 
			include 'footer.php';
		} else {
			_hActions::error404( 'posts' );
		}
	}

	function category( $cat ) { 
		include 'header.php' ; ?>
		<title>Category : <?php _show_( ucwords( $cat ) ); ?> [ <?php showOption( 'name' ); ?> ]</title><?php
		$this -> connectDB();
		$getPosts = mysqli_query( $conn, "SELECT * FROM ". hDBPREFIX ."posts WHERE ( h_status = 'published' AND h_category = '".$cat."' ) ORDER BY h_created DESC" );
		if ( $getPosts -> num_rows > 0) { ?>
			<div class="mdl-grid">
				<div class="mdl-cell mdl-cell--9-col mdl-grid"><?php 
				while ( $postsDetails = mysqli_fetch_assoc( $getPosts)){ ?>
					<div class="mdl-cell card">
						<div class="card-image waves-effect waves-block waves-light">
							<img class="activator" src="<?php _show_( $postsDetails['h_avatar'] ); ?>">
						</div>

						<div class="card-content mdl-color-text--black">
							<a href="<?php _show_( hROOT.$postsDetails['h_link'] ); ?>"><span class="card-title grey-text text-darken-4"><?php _show_( $postsDetails['h_alias'] ); ?><i class="material-icons right">arrow_forward</i></span></a>
							<span class="mdl-list__item mdl-color-text--black"><i class="material-icons mdl-list__item-icon mdl-color-text--black">today</i><span style="padding-left: 20px"><?php $date = $postsDetails['h_created'];
							$date = explode(" ", $date); _show_( $date[0] ); ?></span>
						</div>

						<div class="card-reveal mdl-color-text--black">
							<span class="card-title grey-text text-darken-4"><i class="material-icons left">perm_identity</i> <a href="./user/<?php _show_( $postsDetails['h_by'] ); ?>"><?php _show_( $postsDetails['h_by'] ); ?></a><i class="material-icons right">close</i></span><br>
							<article>
							<?php _show_( substr( $postsDetails['h_description'], 0, 240 ) ); 
							?> ...

							</article> 
							<a class="mdl-button mdl-button--colored" href="<?php _show_( hROOT.$postsDetails['h_link'] ); ?>">read more</a><br>
							<p>Posted In: <a href="./category/<?php _show_( $postsDetails['h_category'] ); ?>"><?php _show_( ucwords( $postsDetails['h_category'] ) ); ?></a></p>
							<p>Tagged: <a href="./tag/<?php _show_( $postsDetails['h_tags'] ); ?>"><?php _show_( ucwords( $postsDetails['h_tags'] ) ); ?></a></p>
						</div>
					</div><?php 
				} ?>
				</div>
				<div class="mdl-cell mdl-cell--3-col" >
				<form>
					<center>
						<div class="input-field">
							<i class="material-icons prefix">search</i>
							<input type="text" placeholder="Search Blog">
						</div>
					</center>
				</form>
				</div>
			</div><?php 
			include 'footer.php';
		} else {
			_hActions::error404( 'posts' );
		}
	}

	function tags( $tag ) { 
		include 'header.php' ; ?>
		<title>Tag : <?php _show_( ucwords( $tag ) ); ?> [ <?php showOption( 'name' ); ?> ]</title><?php
		$this -> connectDB();
		$getPosts = mysqli_query( $conn, "SELECT * FROM ". hDBPREFIX ."posts WHERE ( h_status = 'published' AND h_tags = '".$tag."' ) ORDER BY h_created DESC" );
		if ( $getPosts -> num_rows > 0) { ?>
			<div class="mdl-grid">
				<div class="mdl-cell mdl-cell--9-col mdl-grid"><?php 
				while ( $postsDetails = mysqli_fetch_assoc( $getPosts)){ ?>
					<div class="mdl-cell card">
						<div class="card-image waves-effect waves-block waves-light">
							<img class="activator" src="<?php _show_( $postsDetails['h_avatar'] ); ?>">
						</div>

						<div class="card-content mdl-color-text--black">
							<a href="<?php _show_( hROOT.$postsDetails['h_link'] ); ?>"><span class="card-title grey-text text-darken-4"><?php _show_( $postsDetails['h_alias'] ); ?><i class="material-icons right">arrow_forward</i></span></a>
							<span class="mdl-list__item mdl-color-text--black"><i class="material-icons mdl-list__item-icon mdl-color-text--black">today</i><span style="padding-left: 20px"><?php $date = $postsDetails['h_created'];
							$date = explode(" ", $date); _show_( $date[0] ); ?></span>
						</div>

						<div class="card-reveal mdl-color-text--black">
							<span class="card-title grey-text text-darken-4"><i class="material-icons left">perm_identity</i> <a href="./user/<?php _show_( $postsDetails['h_by'] ); ?>"><?php _show_( $postsDetails['h_by'] ); ?></a><i class="material-icons right">close</i></span><br>
							<article>
							<?php _show_( substr( $postsDetails['h_description'], 0, 240 ) ); 
							?> ...

							</article> 
							<a class="mdl-button mdl-button--colored" href="<?php _show_( hROOT.$postsDetails['h_link'] ); ?>">read more</a><br>
							<p>Posted In: <a href="./category/<?php _show_( $postsDetails['h_category'] ); ?>"><?php _show_( ucwords( $postsDetails['h_category'] ) ); ?></a></p>
							<p>Tagged: <a href="./tag/<?php _show_( $postsDetails['h_tags'] ); ?>"><?php _show_( ucwords( $postsDetails['h_tags'] ) ); ?></a></p>
						</div>
					</div><?php 
				} ?>
				</div>
				<div class="mdl-cell mdl-cell--3-col" >
				<form>
					<center>
						<div class="input-field">
							<i class="material-icons prefix">search</i>
							<input type="text" placeholder="Search Blog">
						</div>
					</center>
				</form>
				</div>
			</div><?php 
			include 'footer.php';
		} else {
			_hActions::error404( 'posts' );
		}
	}

	function home() {
		include 'header.php';
		$getPosts = mysqli_query( $GLOBALS['conn'], "SELECT * FROM ". hDBPREFIX ."posts WHERE h_link = 'home'" );
		if ( $getPosts -> num_rows > 0) { ?>
			<div class="mdl-grid"><?php 
					while ( $postsDetails = mysqli_fetch_assoc( $getPosts)){  ?>
						<title><?php showOption( 'name' ); ?> [ <?php showOption( 'description' ); ?> ]</title>
					      <div class="mmm-ribbon mdl-color--<?php if ( isset( $_SESSION['myCode'] ) ){ primaryColor(); } else { echo "madge"; } ?>" style="background: url( <?php _show_( $postsDetails['h_avatar']); ?> ); background-repeat:no-repeat; background-size: cover; background-position: center; min-height: 600px; max-height: 750px;">
					      <center><h1><br><b><?php showOption ( 'name' ); ?></b></h1>
					      <span><h3><b><?php showOption ( 'description' ); ?></b></h3></span>
					      <a class="btn btn-large mdl-color--red" href="#">GET STARTED</a></center>
					      </div>
					      
					        <div class="demo-container">
					          	<div class="demo-content mdl-color--white content mdl-color-text--black mdl-grid mdl-shadow--2dp">
					          	<div class="mdl-cell mdl-cell--12-col mdl-grid mdl-shadow--2dp">
					          	<div class="mdl-cell mdl-cell--12-col">
					          	<center>
							      <h3 class=""><?php showOption( 'name' ) ?></h3>
						      	</center>
						      	</div>
					          		<div class="mdl-cell mdl-cell--3-col mdl-color--madge card">
										    <div class="card-image waves-effect waves-block waves-light">
										      <center>
										      <h1 class="fa fa-user fa-4x"></h1>
										      </center>
										    </div>
										    <div class="card-content mdl-color-text--black">
										      <center><b class="card-title grey-text text-darken-4">Bold</b>
										      <p>The foundational elements of print-based design – typography, grids, space, scale, color, and use of imagery – guide visual treatments. These elements do far more than please the eye.</p></center>
										    </div>
					          		</div>
					          		<div class="mdl-cell mdl-cell--3-col mdl-color--madge card">
										    <div class="card-image waves-effect waves-block waves-light">
										      <center>
										      <h1 class="fa fa-user fa-4x"></h1>
										      </center>
										    </div>
										    <div class="card-content mdl-color-text--black">
										      <center><b class="card-title grey-text text-darken-4">Bold</b>
										      <p>The foundational elements of print-based design – typography, grids, space, scale, color, and use of imagery – guide visual treatments. These elements do far more than please the eye.</p></center>
										    </div>
					          		</div>
					          		<div class="mdl-cell mdl-cell--3-col mdl-color--madge card">
										    <div class="card-image waves-effect waves-block waves-light">
										      <center>
										      <h1 class="fa fa-user fa-4x"></h1>
										      </center>
										    </div>
										    <div class="card-content mdl-color-text--black">
										      <center><b class="card-title grey-text text-darken-4">Bold</b>
										      <p>The foundational elements of print-based design – typography, grids, space, scale, color, and use of imagery – guide visual treatments. These elements do far more than please the eye.</p></center>
										    </div>
					          		</div>
					          		<div class="mdl-cell mdl-cell--3-col mdl-color--madge card">
										    <div class="card-image waves-effect waves-block waves-light">
										      <center>
										      <h1 class="fa fa-user fa-4x"></h1>
										      </center>
										    </div>
										    <div class="card-content mdl-color-text--black">
										      <center><b class="card-title grey-text text-darken-4">Bold</b>
										      <p>The foundational elements of print-based design – typography, grids, space, scale, color, and use of imagery – guide visual treatments. These elements do far more than please the eye.</p></center>
										    </div>
					          		</div>
					          	</div>
					          	<div class="mdl-cell mdl-cell--12-col mdl-grid mdl-shadow--2dp">

					          	<div class="mdl-cell mdl-cell--12-col">
					          	<center>
							      <h3 class="">Blog</h3>
						      	</center>
						      	</div>
					          		<?php $posts = mysqli_query( $GLOBALS['conn'], "SELECT * FROM ". hDBPREFIX ."posts WHERE h_type = 'article' AND h_status = 'published' LIMIT 3");
					          		if ( $posts -> num_rows > 0 ) {
					          		 	while ( $postsDetails = mysqli_fetch_assoc( $posts ) ) { ?>
					          		 	<div class="mdl-cell card mdl-shadow--2dp">
										    <div class="card-image waves-effect waves-block waves-light">
										      <img class="activator" src="<?php _show_( $postsDetails['h_avatar'] ); ?>">
										    </div>
										    <div class="card-content mdl-color-text--black">
										      <span class="card-title activator grey-text text-darken-4"><?php _show_( $postsDetails['h_alias'] ); ?><i class="material-icons right">more_vert</i></span>
										      <span class="mdl-list__item mdl-color-text--black"><i class="material-icons mdl-list__item-icon mdl-color-text--black">today</i><span style="padding-left: 20px"><?php $date = $postsDetails['h_created'];
              $date = explode(" ", $date); _show_( $date[0] ); ?></span>
										      <a class="mdl-button mdl-button--colored alignright" href="<?php _show_( hROOT.$postsDetails['h_link'] ); ?>">read more</a>
										    </div>
										    <div class="card-reveal mdl-color-text--black">
										      <span class="card-title grey-text text-darken-4"><i class="material-icons left">perm_identity</i> <a href="./user/<?php _show_( $postsDetails['h_by'] ); ?>"><?php _show_( $postsDetails['h_by'] ); ?></a><i class="material-icons right">close</i></span><br>
										      <article>
										      	<?php _show_( substr( $postsDetails['h_description'], 0, 250 ) ); 
										      ?> ...
										      	
										      </article> <a class="mdl-button mdl-button--colored" href="<?php _show_( hROOT.$postsDetails['h_link'] ); ?>">read more</a><br>
										      <p>Posted In: <a href="./category/<?php _show_( $postsDetails['h_category'] ); ?>"><?php _show_( ucwords( $postsDetails['h_category'] ) ); ?></a></p>
										      <p>Tagged: <a href="./tag/<?php _show_( $postsDetails['h_tags'] ); ?>"><?php _show_( ucwords( $postsDetails['h_tags'] ) ); ?></a></p>
										    </div>
									  	</div><?php 
					          		 	}
					          		 } ?>
					          	<div class="mdl-cell mdl-cell--12-col">
					          	<center>
							      <a class="btn btn-large mdl-color--red" href="./blog">View All Posts</a>
						      	</center>
						      	<form>
						      		<button type="submit" name="rate" value="1" class="material-icons mdl-button--icon mdl-color--red">star</button>
						      		<button type="submit" name="rate" value="2" class="material-icons mdl-button--icon mdl-color--red">star</button>
						      		<button type="submit" name="rate" value="3" class="material-icons mdl-button--icon mdl-color--red">star</button>
						      		<button type="submit" name="rate" value="4" class="material-icons mdl-button--icon mdl-button--colored">star</button>
						      		<button type="submit" name="rate" value="5" class="material-icons mdl-button--icon mdl-button--colored">star</button>
						      	</form>
						      	</div>
					          	</div>
					          	<div class="mdl-cell mdl-cell--12-col mdl-grid mdl-shadow--2dp">
					          		<div class="mdl-cell mdl-cell--8-col mdl-color--madge">
					          			<iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d15955.735909615176!2d36.7762801!3d-1.206367!3m2!1i1024!2i768!4f13.1!4m3!3e6!4m0!4m0!5e0!3m2!1sen!2ske!4v1499095612591" width="100%" height="400" frameborder="0" style="border:0" allowfullscreen>
					          			</iframe>
					          		</div>
					          		<div class="mdl-cell mdl-cell--4-col mdl-color--madge">
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
					          					<button type="submit" class="mdl-button mdl-button--fab mdl-button--colored right"><i class="material-icons">send</i></button>
					          			</form>
					          		</div>
					          	</div>
						        </div>
					      </div>
					<?php } ?>
			</div><?php
		} else { ?>
		<title>Error 404</title>
			<div style="margin:1%;" class="mdl-grid" >
				<center>
					<div class="mdl-cell mdl-cell--7-col mdl-card mdl-color--red" >
						<div class="mdl-card-media">
							<img src="<?php _show_( hIMAGES.'404.jpg'); ?>" width="100%" style="overflow: hidden;" >
						</div>
						<div class="mdl-card__title mdl-card--expand">
							<div class="mdl-card__title-text">
							<center>Error 404! Post Not Found!</center>
						</div>
					  	<div class="mdl-layout-spacer"></div>
					  	<div class="mdl-card__subtitle-text">
					    	<i class="material-icons">search</i>
					 	</div>
					</div>
					<div class="mdl-card__menu">
					<a href="./index.php" class="mdl-button mdl-js-ripple-effect mdl-button--icon"><i class="material-icons">home</i></a>
					</div>
					</div>
				</center>
			</div><?php 
		}
	}  

	function forgot() {
	  include 'header.php';?>
	  <title>Forgot Password [ <?php showOption( 'name' ); ?> ]</title>
		<div style="padding-top:40px;" class="mdl-grid">
			<div class="mdl-cell mdl-cell--2-col"></div>
			<div id="login_div" class="mdl-cell mdl-cell--8-col">
				<center><?php _hActions::frontlogo(); ?></center>
				<form enctype="multipart/form-data" method="POST" action="" class="mdl-grid">

					<div class="input-field mdl-cell mdl-cell--7-col">
					<i class="material-icons prefix">mail</i>
					<input class="validate" name="email" id="email" type="email" placeholder="jabali@mauko.co.ke">
					<label for="email" data-error="Please Enter A Valid Email Address" data-success="Okay. Press the buton to submit" class="center-align">Enter Your Email</label>
					</div>

					<div class="input-field mdl-cell mdl-cell--3-col">
					<button class="mdl-button mdl-button--fab mdl-button--colored alignright" type="submit" name="forgot"><i class="material-icons">send</i></button>
					</div>

				</form>
			</div>
			<div class="mdl-cell mdl-cell--2-col"></div>
		</div><?php 
	  include 'footer.php';
	}

	function reset(){
		include 'header.php';
		if ( _hActions::emailExists( $_GET['email'] ) ) {
	    $theUser = mysqli_query( $GLOBALS['conn'], "SELECT h_email, h_key FROM ". hDBPREFIX ."users WHERE h_email = '".$_GET['email']."'" );
	    if ( $theUser -> num_rows > 0 ) {
	      while ( $thisuser = mysqli_fetch_assoc( $theUser) ) {
	        $user[] = $thisuser;
	      }
	    }

	    if ( !empty( $user) && $user[0]['h_key'] = $_GET['key'] ) {
	      include 'header.php'; ?>
	      <title>Reset Password [ <?php showOption( 'name' ); ?> ]</title>
	      <div style="padding-top:40px;" >
	          <div id="login_div">
	      <center><?php _hActions::frontlogo(); ?></center>
	              <form enctype="multipart/form-data" method="POST" action="">

	              <div class="input-field">
	              <i class="material-icons prefix">lock</i>
	              <input class="validate" name="pass1" id="pass1" type="password">
	              <label for="pass1">New Password</label>
	              </div>

	              <div class="input-field">
	              <i class="material-icons prefix">lock_outline</i>
	              <input name="h_password" id="password" type="password">
	              <label for="password">Repeat Password</label>
	              </div>

	              <input type="hidden" name="h_code" value="<?php _show_( $user[0]['h_code'] ); ?>">

	              <button class="mdl-button mdl-button--fab mdl-button--colored alignright" type="submit" name="reset"><i class="material-icons">send</i></button>

	              <p>
	              <a href="./register" id="register">Register</a>
	              </p>

	              <br>
	              <br>
	              </form>
	          </div>
	      </div><?php 
	      include 'footer.php';
	    }
	  }
	}

	function resetPass() {
		if ( mysqli_query( $GLOBALS['conn'], "UPDATE ". hDBPREFIX ."users SET h_password = '".md5( $_POST['h_password'] )."', h_key = '".md5(date('YmdHms' ))."' WHERE h_code = '".$_POST['h_code']."'" ) ) {
	    if ( $hUser -> emailUser( $user[0]['h_email'], "reset", $user[0]['h_key'] ) ) {
	      header( "Location: ./forgot?error=null" );
	    } else {
	      header( "Location: ./forgot?error=email" );
	    }
	  } else {
	    header( "Location: ./reset?error=update" );
	  }
	}
} ?>