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
<div class="switch mdl-cell">
	<label>
		On
			<input id="1" name="ext[]" value="1" type="checkbox" >
			<span class="lever"></span>
		Off
	</label>
</div><br>
<div class="switch mdl-cell">
	<label>
		On
			<input id="2" name="ext[]" value="2" type="checkbox" >
			<span class="lever"></span>
		Off
	</label>
</div><br>
<div class="switch mdl-cell">
	<label>
		On
			<input id="3" name="ext[]" value="3" type="checkbox" checked >
			<span class="lever"></span>
		Off
	</label>
</div><br>
<div class="switch mdl-cell">
	<label>
		On
			<input id="4" name="ext[]" value="4" type="checkbox" >
			<span class="lever"></span>
		Off
	</label>
</div><br>
<button type="submit" class="mdl-button mdl-button--fab mdl-button--colored right" ><i class="material-icons">send</i></button>
</form>
<?php
if (isset( $_POST['ext'])) {
	foreach( $_POST['ext'] as $exts ){
		echo $exts." is active!<br>";
	}
}
include 'footer.php'; ?>
<?php ?>