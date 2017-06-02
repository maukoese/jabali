<?php
/**
* @package Jabali Framework
* @subpackage Database
* @link https://docs.mauko.co.ke/jabali/classes/hdb
* @author Mauko Maunde
* @version 0.17.06
**/

//Date
date_default_timezone_set("Africa/Nairobi");

include 'config.php';
function connectDb() {
	$GLOBALS['conn'] = mysqli_connect( hDBHOST, hDBUSER, hDBPASS, hDBNAME );

	if ( mysqli_connect_errno() ) {
		printf("Connection failed: %s\ ", mysqli_connect_error());
		exit();
	}
	return true;
	
}

//Directories
define('hPORTAL', hROOT.'portal/');
define('hFUNCTIONS', hROOT.'functions/');
define('hUPLOADS', hROOT.'uploads/');


//Assets
define('hASSETS', hROOT.'assets/');
define('hSTYLES', hASSETS.'css/');
define('hSCRIPTS', hASSETS.'js/');
define('hIMAGES', hASSETS.'images/');
define('hFONTS', hASSETS.'fonts/');

//Actions
define('hLOGIN', hROOT.'login/');
define('hREGISTER', hROOT.'register/');

define('hEMAIL', 'portal@mtaandao.co.ke');
define('hPHONE', '254702630550');

define('hAPI', hROOT.'api/');

function getFile($path, $file) {

	include $path.$file.'.php';
}

function getStyle($link) {
	?><link rel="stylesheet" type="text/css" href="<?php echo $link; ?>"><?php
}

function getScript($link) {
	?><script src="<?php echo $link; ?>"></script><?php
}

function frontlogo() {

        echo '<a href="'.hROOT.'"><img src="'.hIMAGES.'logo.png" width="250px;"></a>';
}

function show($what) {
	echo $what;
}

function showAlert($alert) {
	?><script>
	function showText() {
	    alert("<?php echo $alert; ?>");
	}

	showText();
	</script><?php
}

function showConf($message, $yes, $no, $where) {
	?><script>
	function confirmAcion() {
    var txt;
    if (confirm("<?php echo $message; ?>") == true) {
        txt = "<?php echo $yes; ?>";
    } else {
        txt = "<?php echo $no; ?>";
    }
    document.getElementById("<?php echo $where; ?>").innerHTML = txt;
	}

	confirmAcion();
	</script><?php
}

//Check if user has appropriate permisions
function isCap($cap) {
	if ($_SESSION['myCap'] == $cap) {
		return true;
	} else {
		return false;
	}
}

//Show/hide edit/delete buttons
// if (isCap( 'admin' ) && isCap( 'doctor' ) && $_SESSION['myCode'] == $_GET['view']) {
// 	# show
// } else {
// 	# hide
// }

//fav button
// if ($_SESSION['myCode'] !== $_GET['view']) {
// 	# show
//}

function uploadFile() {
	$uploaddir = "uploads/$year/$month/$day";
	$uploadfile = $uploaddir. basename($_FILES['file']['name']);
	move_uploaded_file(filename, destination);

}

function getMsgCount() {
    $getMessages = mysqli_query($GLOBALS['conn'], "SELECT * FROM hmessages WHERE h_status='unread'");
    if ($getMessages -> num_rows >= 0) {
      $messagecount = $getMessages -> num_rows;
      echo $messagecount;
    } else {
      show( '0' );
    }
}

function getNoteCount() {
	$getMessages = mysqli_query($GLOBALS['conn'], "SELECT * FROM hnotifications");
	if ($getMessages -> num_rows >= 0) {
	  	$messagecount = $getMessages -> num_rows;
	  	echo $messagecount;
	} else {
	  	show( '0' );
	}
}

function primaryColor($code) {
	$getColor = mysqli_query($GLOBALS['conn'], "SELECT h_style FROM husers  WHERE h_code='".$code."'");
	if ($getColor) {
		while ($themes = mysqli_fetch_assoc($getColor)) {
			if ($themes['h_style'] == "love") {
				echo "cyan";
			} elseif ($themes['h_style'] == "zahra") {
				echo "teal";
			} elseif ($themes['h_style'] == "wizz") {
				echo "yellow";
			} elseif ($themes['h_style'] == "pint") {
				echo "blue";
			} elseif ($themes['h_style'] == "stack") {
				echo "grey";
			} elseif ($themes['h_style'] == "hot") {
				echo "red";
			} elseif ($themes['h_style'] == "princess") {
				echo "pink";
			} elseif ($themes['h_style'] == "haze") {
				echo "purple";
			} elseif ($themes['h_style'] == "prince") {
				echo "deep-purple";
			} elseif ($themes['h_style'] == "indie") {
				echo "indigo";
			} elseif ($themes['h_style'] == "sky") {
				echo "light-blue";
			} elseif ($themes['h_style'] == "greene") {
				echo "green";
			} elseif ($themes['h_style'] == "vegan") {
				echo "light-green";
			} elseif ($themes['h_style'] == "lemon") {
				echo "lime";
			} elseif ($themes['h_style'] == "wait") {
				echo "amber";
			} elseif ($themes['h_style'] == "orange") {
				echo "orange";
			} elseif ($themes['h_style'] == "sun") {
				echo "deep-orange";
			} elseif ($themes['h_style'] == "earth") {
				echo "brown";
			} elseif ($themes['h_style'] == "ghost") {
				echo "blue-grey";
			} elseif ($themes['h_style'] == "zebra") {
				echo "black";
			}
		}
	}
}

function secondaryColor($code) {
	$getColor = mysqli_query($GLOBALS['conn'], "SELECT h_style FROM husers  WHERE h_code='".$code."'");
	if ($getColor) {
		while ($themes = mysqli_fetch_assoc($getColor)) {
			if ($themes['h_style'] == "love") {
				echo "cyan";
			} elseif ($themes['h_style'] == "zahra") {
				echo "teal";
			} elseif ($themes['h_style'] == "wizz") {
				echo "brown";
			} elseif ($themes['h_style'] == "bluepint") {
				echo "blue";
			} elseif ($themes['h_style'] == "stack") {
				echo "grey";
			}
		}
	}
}

function textColor($code) {
	$getColor = mysqli_query($GLOBALS['conn'], "SELECT h_style FROM husers  WHERE h_code='".$code."'");
	if ($getColor) {
		while ($themes = mysqli_fetch_assoc($getColor)) {
			if ($themes['h_style'] == "love") {
				echo "cyan";
			} elseif ($themes['h_style'] == "zahra") {
				echo "teal";
			} elseif ($themes['h_style'] == "wizz") {
				echo "brown";
			} elseif ($themes['h_style'] == "bluepint") {
				echo "blue";
			} elseif ($themes['h_style'] == "stack") {
				echo "grey";
			}
		}
	}
}

function getOption($code) {
    $getOptions = mysqli_query($GLOBALS['conn'], "SELECT * FROM hoptions WHERE h_code='".$code."'");
    if ($getOptions -> num_rows > 0) {
        while ($siteOption = mysqli_fetch_assoc($getOptions)) { 
            show( $siteOption['h_description']);
        }
    }
}

 include 'forms.php';
 include 'users.php';
 include 'resources.php';
 include 'services.php';
 include 'messages.php';
 include 'notifications.php';
 include 'articles.php';
 include 'social.php';

?>
