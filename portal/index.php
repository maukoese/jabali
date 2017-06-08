<?php 
include './header.php';

function getCount($utype) {
    $usersCount = mysqli_query($GLOBALS['conn'], "SELECT h_type FROM husers WHERE h_type='".$utype."'");
	if ($usersCount -> num_rows > 0) {
			?><div class="mdl-cell mdl-card mdl-shadow--2dp mdl-color--<?php primaryColor($_SESSION['myCode']); ?>"><i class="material-icons prefix">people</i><center><?php
			echo ucfirst($utype).'s
			<br>'.$usersCount -> num_rows.'
			</center></div>';
	} else {
		?><div class="mdl-cell mdl-card mdl-shadow--2dp mdl-color--<?php primaryColor($_SESSION['myCode']); ?>"><i class="material-icons prefix">people</i><center><?php
		echo ucfirst($utype).'s
		<br>0
		</center></div>';
	}
}

$types = "admin, doctor, nurse, center, patient";
$type = explode(", ", $types);

?>
<title>JABALI PORTAL</title>
  <div class="mdl-grid demo-content">
  	<?php
  		getCount($type[0]);
  		getCount($type[1]);
  		getCount($type[2]);
  		getCount($type[3]);
  		getCount($type[4]);
  	?>
  </div>
<?php 
include './footer.php';
?>