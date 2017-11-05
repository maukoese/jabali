<?php 
/**
* Searching
* TO-DO: Move to individual files
* @link https://tutorialrepublic.com/php-tutorial/php-mysql-ajax-livesearch.php
* @return Requested data from parent
**/
session_start();
require_once( '../init.php' );
require_once( 'header.php' ); ?>
<div class="mdl-grid">
	<script type="text/javascript">
	function loadDoc() {
		var term = parseInt($("#term").val());
		var table = parseInt($("#table").val());
		var xhttp = new XMLHttpRequest();
		xhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			var fer = JSON.parse(this.responseText);
		 document.getElementById("results").innerHTML = "Name: " +fer.name 
		 + "<br>Date: " + fer.created 
		 + "<br>Found By: " + fer.author_name
		 + "<br>Identity Code: " + fer.id
		 + "<br>Status: " + fer.state
		 + "<br>Other Details: " + fer.details;
		}
		};
		xhttp.open("GET", "?table"+table+"search="+term, true);
		xhttp.send();
	}
	</script>
	
        <div class="col m10 s12 input-field inline">
          <i class="material-icons prefix">perm_identity</i>
          <input type="text" id="unumber" name="id" placeholder="Type your ID Number And Click The Search Button">
          <label for="number">Document Number To Search</label>
        </div>
          <button id="check" onclick="loadDoc()" class="right btn btn-floating btn-large accent"><i class="material-icons">search</i></button>
          <div class="mdl-cell mdl-cell--10-col white" id="results"></div>
</div>
<?php

if ( isset( $_REQUEST['search'] ) ) {
	$table = strtoupper( $_REQUEST['table'] );
	$results = $GLOBALS[$table] -> search( $_REQUEST['search'] );
	if ( !isset( $results as $result ) {
			echo '<h1><a href="" class="mdl-list--item" >'.$post['name'].'</a></h1>';
		}
	} else {
		echo "Nothing found!";
	}
}
require_once( 'footer.php' );