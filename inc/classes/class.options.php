<?php 
class _hOptions {

	/**
	* Create menu
	**/
	function create ( $h_alias, $h_code, $h_description, $h_updated ) {
		if( mysqli_query( $GLOBALS['conn'], "INSERT INTO ". hDBPREFIX ."options (h_alias, h_code, h_description, h_updated ) VALUES ( '".$h_alias."', '".$h_code."', '".$h_description."', '".$h_updated."' )" ) ) {
			echo "<script type = \"text/javascript\">
                  alert(\"Preferences Updated Successfully!\" );
              </script>";
          } else {
          	echo "Error: " . $GLOBALS['conn'] -> error;
          }
	}

	function update ( $h_code, $h_description, $h_updated ) {
		if( mysqli_query( $GLOBALS['conn'], "UPDATE ". hDBPREFIX ."options SET h_description = '".$h_description."', h_updated = '".$h_updated."' WHERE h_code='".$h_code."'" ) ){
			echo "<script type = \"text/javascript\">
                  alert(\"Preferences Updated Successfully!\" );
              </script>";
          } else {
          	echo "Error: " . $GLOBALS['conn'] -> error;
          }
	}

} ?>
