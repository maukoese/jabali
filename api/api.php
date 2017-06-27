<?php
if ( isset( $_GET['table'] ) ) {
	if ( isset( $_GET['action'] ) ) {
		if ($_GET['action'] == "view") {
			if ( isset( $_GET['type'] ) ) {
				if ( isset( $_GET['location'] ) ) {
				$hAPI -> typeLoc( $_GET['table'], $_GET['type'], $_GET['location'] );
				} else {
					$hAPI -> type( $_GET['table'], $_GET['type'] );
				}
			} elseif ( isset( $_GET['location'] ) ) {
				$hAPI -> typeLoc( $_GET['table'], $_GET['type'], $_GET['location'] );
			} else {
				$hAPI -> fetch( $_GET['table'] );
			}
		} elseif ( $_GET['action'] == "update" ) {
			$hAPI -> update ( $_GET['table'], $data, $cols, $row );
		} elseif ( $_GET['action'] == "delete" ) {
			$hAPI -> delete ( $_GET['table'], $row );
		} else {
			$hAPI -> fetch( $_GET['table'] );
		}
	} else {
		$hAPI -> fetch( $_GET['table'] );
	}
}
?>
