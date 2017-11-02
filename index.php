<?php
session_start();
if ( isset( $_GET['logout'] ) ) {
  session_destroy();
}

if ( !file_exists( 'app/config.php' ) ) {
  header( "Location: ./setup.php" );
}

require 'init.php';
updatingJabali();

$year = date( "Y" );
$month = date( "m" );
$day = date( "d" );
$directory = "uploads/$year/$month/$day/";

if ( !is_dir( $directory) ) {
  mkdir( $directory, 0775, true );
}

if ( isset( $_POST['login'] ) && $_POST['user'] != "" && $_POST['password'] != "" ) {
  $USERS -> login();
}

if ( isset( $_POST['create'] ) ) {
  $USERS -> register();
}

if ( isset( $_POST['reset'] ) && $_POST['password'] !== "" ) {
  $USERS -> forgot();
}

if ( isset( $_POST['forgot'] ) && $_POST['email'] !== "" ) {
  $USERS ->reset();
}

if ( isset( $_POST['contact'] ) && $_POST['email'] !== "" ) {
  	$MAILER -> setFrom( getOption( 'email' ), getOption( 'name' ));
	$MAILER -> addAddress( $_POST['email'], $_POST['name'] );
	$MAILER -> Subject  = 'Contact Message From '.getOption( 'name' );
	$MAILER -> Body     = $_POST['message'];
	if(!$MAILER -> send()) {
	  echo '<div class="etoast">Sorry but we could not send your message at this time. Try again</div>';
	  /*Mailer error: ' . $MAILER -> ErrorInfo.'*/
	} else {
	  echo '<div class="toast">Message successfully sent. Thank you.</div>';
	}

	// $mail->From = "from@yourdomain.com";
	// $mail->FromName = "Full Name";

	// $mail->addAddress("recipient1@example.com", "Recipient Name");

	// //Provide file path and name of the attachments
	// $mail->addAttachment("file.txt", "File.txt");        
	// $mail->addAttachment("images/profile.png"); //Filename is optional

	// $mail->isHTML(true);

	// $mail->Subject = "Subject Text";
	// $mail->Body = "<i>Mail body in HTML</i>";
	// $mail->AltBody = "This is the plain text version of the email content";

	//Enable SMTP debugging. 
	// $mail->SMTPDebug = 3;                               
	// //Set PHPMailer to use SMTP.
	// $mail->isSMTP();            
	// //Set SMTP host name                          
	// $mail->Host = "smtp.gmail.com";
	// //Set this to true if SMTP host requires authentication to send email
	// $mail->SMTPAuth = true;                          
	// //Provide username and password     
	// $mail->Username = "name@gmail.com";                 
	// $mail->Password = "super_secret_password";                           
	// //If SMTP requires TLS encryption then set it
	// $mail->SMTPSecure = "tls";                           
	// //Set TCP port to connect to 
	// $mail->Port = 587;                                   

	// $mail->From = "name@gmail.com";
	// $mail->FromName = "Full Name";

	// $mail->addAddress("name@example.com", "Recepient Name");

	// $mail->isHTML(true);

	// $mail->Subject = "Subject Text";
	// $mail->Body = "<i>Mail body in HTML</i>";
	// $mail->AltBody = "This is the plain text version of the email content";
}

if ( isset( $_SESSION[JBLSALT.'Code' ] ) ) {
	$GStyles = $GLOBALS['JBLDB'] -> query( "SELECT style FROM ". _DBPREFIX ."users  WHERE id='".$_SESSION[JBLSALT.'Code']."'" );
	if ( $GLOBALS['JBLDB'] -> numRows( $GStyles ) > 0 ) {
		$f = array();
		while ( $s = $GLOBALS['JBLDB'] -> fetchArray( $GStyles )) {
			$f[] = $s;
		}
		if ( $f[0]['style'] !== "" ) {
			$key = $f[0]['style'];
		} else {
			$key = "zahra";
		}
	} else {
		$key = "zahra";
	}
} else {
	$key = "zahra";
}

$GUSkin = $GLOBALS['SKINS'][$key];
$GLOBALS['GPrimary'] = $GUSkin['primary'];
$GLOBALS['GAccent'] = $GUSkin['accent'];
$GLOBALS['GTextP'] = $GUSkin['textp'];
$GLOBALS['GTextS'] = $GUSkin['texts'];

if ( is_localhost() && ( $_SERVER['DOCUMENT_ROOT'] !== __DIR__ ) ) {
	$dir = '/'.basename( __DIR__ ).'/';
	$l = strlen( $dir );
	$url = substr($_SERVER['REQUEST_URI'], $l );
} else {
  $url = ltrim( '/', $_SERVER['REQUEST_URI'] );
}

$render = new Jabali\Classes\Renders;
$elements = explode('/', $url );
$match = $elements[0];
array_shift( $elements );

if( empty( $match ) || $match == "?logout" ) {
	getHeader();
	if ( getOption( 'homepage' ) == "posts" ) {
		echo( '<title> Home [ '. getOption( 'name' ) .' ]</title>' );
		$render -> blog();
	} else {
		$render -> fetchPosts( getOption( 'homepage' ) );
	}
	getFooter();
} elseif ( in_array( $match, $GLOBALS['GRules'])) {
	rewriteRules( $match, $elements );
} else switch ( $match ) {
	case "login":
		if ( isset( $_SESSION[JBLSALT.'Code'] ) ) {
			header( 'Location: '. _ROOT .'/admin/index?page=my dashboard' );
			exit();
		} else {
			$render -> login( $elements[0] );
		}
		break;
	case "register":
		$render -> register( $elements[0] );
		break;
	case "keygen":
		keyGen( $elements[0] );
		break;
	case "dash":
		header( "Location: admin/index?page=my dashboard");
		break;
	case "dashboard":
		header( "Location: admin/index?page=my dashboard");
		break;
	case "reset":
		theHeader();
		$render -> reset( $elements[0], $elements[1] );
		theFooter();
		break;
	case "forgot":
		$render -> forgot();
		break;
	case 'portfolio':
		getHeader();
		$render -> portfolio( $elements );
		getFooter();
		break;
	case "authors":
		getHeader();
		$render -> authors( $elements[0] );
		getFooter();
		break;
	case "categories":
		getHeader();
		$render -> category( $elements[0] );
		getFooter();
		break;
	case "comments":
		getHeader();
		$render -> comments( $elements );
		getFooter();
		break;
	case "tags":
		getHeader();
		$render -> tag( $elements[0] );
		getFooter();
		break;
	case "users":
		getHeader();
		$render -> users( $elements[0] );
		getFooter();
		break;
	case "api":
		restApi( $elements );
		break;
	case "feed":
		rssFeed( $elements[0] );
		break;
	case 'manifest':
		header('Content-Type:Application/json' );
		$manifest = manifest();
		echo json_encode( $manifest );
		break;
	default:
		getHeader();
		$render -> fetchPosts( $match );
		getFooter();
}