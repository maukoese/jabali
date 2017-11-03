<?php 
/**
* @package Jabali Framework
* @subpackage Admin Transfer Tools
* @link https://docs.jabalicms.org/transfer/
* @author Mauko Maunde
* @since 0.17.04
**/
session_start();
require_once( '../init.php' );
require_once( 'header.php' );
if ( isset( $_GET['page'] ) ) {
	if ( $_GET["page"] =="import" ) { ?>
		<title>Import Data - <?php showOption( 'name' ); ?></title>
		<form action="" style="padding: 15%;">
		    <div class="file-field input-field">
		      <div class="btn">
		        <span>File</span>
		        <input type="file">
		      </div>
		      <div class="file-path-wrapper">
		        <input class="file-path validate" type="text" placeholder="Select a .jbl or .json file to import">
		      </div>
		    </div>
			<button type="submit" name="rewrite" class="mdl-button mdl-button--fab mdl-button--colored"><i class="material-icons">forward</i></button>
		</form><?php
	} elseif ( $_GET["page"] =="export" ) {
		echo "Select export format";
	}
} else { ?>
	<title>Site Tools - <?php showOption( 'name' ); ?></title>
    	<div class="mdl-grid">
    		<div class="mdl-cell mdl-cell--12-col mdl-color--<?php primaryColor(); ?> mdl-grid">
    			<form action="" style="padding: 15%;">
				    <div class="file-field input-field">
				      <div class="btn">
				        <span>File</span>
				        <input type="file">
				      </div>
				      <div class="file-path-wrapper">
				        <input class="file-path validate" type="text" placeholder="Select a .jbl or .json file to import">
				      </div>
				    </div>
    				<button type="submit" name="rewrite" class="mdl-button mdl-button--fab mdl-button--colored"><i class="material-icons">forward</i></button>
    			</form>
    		</div>
    	</div><?php
}

require_once( 'footer.php' );