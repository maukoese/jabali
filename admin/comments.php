<?php  
include '../inc/jabali.php';
include './header.php';

if ( isset( $_GET['create'] ) ) {
	$hForm -> commentForm();
}

if ( isset( $_GET['edit'] ) ) {
	$hForm -> editCommentForm( $_GET['edit'] );
}

if ( isset( $_GET['fav'] ) ) {
	$getRate = mysqli_query( $GLOBALS['conn'], "INSERT INTO hratings (h_author, h_for, h_type ) 
		VALUES ('".$_SESSION['myCode']."', '".$_GET['fav']."', 'comment' )" );
}

if ( isset( $_GET['view'] )){
	if ( $_GET['view'] == "list" ) {
		if ( isset( $_GET['type'] ) ) {
			$hComment -> getCommentsType( $_GET['type'] );
		} elseif ( isset( $_GET['location'] ) ) {
			$hComment -> getCommentsLoc( $_GET['location'] );
		} else {
			$hComment -> getComments();
		}
	} else {
		$hComment -> getComment( $_GET['view'] );
	}

}

if ( isset( $_POST['create'] ) ) {
	$hComment -> create();
}
?>
<a href="./comments?create=note" class="addfab mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect mdl-button--colored">
  <i class="material-icons">comment</i></a>
<?php 
include './footer.php';
?>