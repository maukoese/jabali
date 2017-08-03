<?php 
/*
*For Carrying out test SQLs
* TO-Do: Remove in dist
*/ 
include '../inc/config.php';
include '../inc/jabali.php';
include 'header.php';
?>
<title>Jabali SQL Sandbox</title>
<form method="POST" action="./sql" class="mdl-grid">
<input id="1" name="ext[]" value="1" type="text" >
<input id="1" name="ext[]" value="2" type="text" >
<input id="1" name="ext[]" value="3" type="text" >
<input id="1" name="exts[]" value="one" type="text" >
<input id="1" name="exts[]" value="two" type="text" >
<input id="1" name="exts[]" value="three" type="text" >
<button type="submit" class="mdl-button mdl-button--fab mdl-button--colored right" ><i class="material-icons">send</i></button>
</form>
<?php
if ( isset( $_POST['ext'] ) ) {
	var_dump($_POST['ext']);
	var_dump($_POST['exts']);

	$two = array_combine($_POST['ext'], $_POST['exts'] );
	var_dump( $two );
	echo "<br>";
	echo json_encode( $two );
}

include 'footer.php'; ?>
<?php ?>