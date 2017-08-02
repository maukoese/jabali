<?php


function put () {
	$data = file_get_contents( 'php://input' );
	$data = json_decode( $data );

	$table = $data['table']; 
	$data = array('fname' => $data['fname'], ); 
	$cols = $data['cols'];
}

function update ( $table, $data, $cols, $row ) {}

function fetch( $table ){
	$query = mysqli_query( $GLOBALS['conn'], "SELECT * FROM h".$table."" );

	if ( $query->num_rows > 0) {

	    while( $row = mysqli_fetch_assoc( $query) ) {
	        $array[] = $row;
	    }

	    header('Content-Type:Application/json' );
	    echo json_encode( $array );
	}
}

function typeLoc( $table, $type, $location ) {
	$query = mysqli_query( $GLOBALS['conn'], "SELECT * FROM h".$table."s WHERE h_type = '".$type."' AND h_location = '".$location."'" );

	if ( $query->num_rows > 0) {

	    while( $row = mysqli_fetch_assoc( $query) ) {
	        $array[] = $row;
	    }

	    header('Content-Type:Application/json' );
	    echo json_encode( $array );
	}
}

function type( $table, $type ) {
	$query = mysqli_query( $GLOBALS['conn'], "SELECT * FROM h".$table."s WHERE h_type = '".$type."'" );

	if ( $query->num_rows > 0) {

	    while( $row = mysqli_fetch_assoc( $query) ) {
	        $array[] = $row;
	    }

	    header('Content-Type:Application/json' );
	    echo json_encode( $array );
	}
}

function loc( $table, $location ) {
	$query = mysqli_query( $GLOBALS['conn'], "SELECT * FROM h".$table."s WHERE h_location = '".$location."'" );

	if ( $query->num_rows > 0) {

	    while( $row = mysqli_fetch_assoc( $query) ) {
	        $array[] = $row;
	    }

	    header('Content-Type:Application/json' );
	    echo json_encode( $array );
	}
}

function delete ( $_GET['table'], $row ) {}

 ?>
