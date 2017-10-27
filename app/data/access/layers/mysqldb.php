<?php 
namespace Jabali\Data\Access\Layers;

/**
* Jabali MySQL Data Access Layer
*/
class MySQLDB {

	private $host;
	private $user;
	private $pass;
	private $name;

	private $conn;

	function __construct( $dbhost, $dbuser, $dbpass, $dbname ) {
		$temp_conn = new \mysqli( $dbhost, $dbuser, $dbpass );
		mysqli_query( $temp_conn, "CREATE DATABASE IF NOT EXISTS ". $dbname );
		if ($temp_conn -> connect_errno) {
		    printf("Connection failed: %s\n", $temp_conn -> connect_error );
		    exit();
		}

		$this -> host = $dbhost;
		$this -> user = $dbuser;
		$this -> pass = $dbpass;
		$this -> name = $dbname;

		$this -> conn = new \mysqli( $this -> host, $this -> user, $this -> pass, $this -> name );
		if ($this -> conn -> connect_errno) {
		    printf("Connection failed: %s\n", $this -> conn -> connect_error);
		    exit();
		}

	}

	function __destruct(){
		$this -> conn -> close();
	}

	function query( $sql ){
		return $this -> conn -> query( $sql );
	}

	function error(){
		return $this -> conn -> error;
	}

	/**
	* @return Returns an associative array of database records from a query result, 
	* or null if there are no rows in the result
	**/
	function 	fetchArray( $result ){
		return $result -> fetch_assoc();
	}

	/**
	* @return Returns an object of database records from a query result, 
	* or null if there are no rows in the result
	**/
	function fetchObject( $result ){
		return $result -> fetch_object();
	}

	/**
	* Preparing our data
	**/

	/**
	* @return Returns escaped data to prevent mysqli injection
	**/
	function clean( $data ){
		return mysqli_real_escape_string( $this -> conn, $data );
	}



	function setCols( $cols ){
		if ( is_array( $cols ) ) {

			array_walk( $cols, array($this, 'clean' ) );

			$sql = implode(", ", $cols);
		} else {
			$sql = $this -> clean( $cols );
		}

		return $sql;
	}

	function setVals( $vals ){
		$sql = " VALUES ( ";
		if ( is_array( $vals ) ) {

			array_walk( $vals, array( $this, 'clean' ) );
			
			foreach ( $vals as $val ) {
				$values[] = "'" . $val . "'";
			}

			if ( count( $values ) > 0 ) {
				$sql .= implode(", ", $values );
			}

		} else {
			$sql .= "'" .$this -> clean( $vals ) . "'";
		}

		$sql .= " ) ";

		return $sql;
	}

	function setVal( $cols, $vals ){
		$sql = "SET ";
		if ( is_array( $cols ) && is_array( $vals ) ) {
			array_walk( $cols, array( $this, 'clean' ) );
			array_walk( $vals, array( $this, 'clean' ) );
			$colvals = array_combine( $cols, $vals );
			foreach ( $colvals as $col => $val ) {
				$values[] = $col." = '" . $val . "'";
			}

			if ( count( $values ) > 0 ) {
				$sql .= implode(", ", $values );
			}

		} else {
			$sql .= $this -> clean( $cols ) . " = '" . $this -> clean( $vals ) . "'";
		}

		return $sql;
	}

	function setCond( $conds ){
		$sql = "";
		$where = array();

		foreach ( $conds as $id => $val ) {
	        $where[] = $id . "='" . $val . "'";
	    }

	    if ( count( $where ) > 0){
	      $sql .= " WHERE " . implode( ' AND ', $where );
	    }

		return $sql;
	}

	function setLike( $data ){
		$sql = "LIKE '%" . $data . "%'";

		return $sql;
	}



	/**
	* Creating Data
	**/
	function insert( $table, $cols, $vals, $conds = null ){
		$sql = "INSERT INTO " . _DBPREFIX.$table . " ( ";
		$sql .= $this -> setCols( $cols );
		$sql .= " )";
		$sql .= $this -> setVals( $vals );

		if ( $conds !== null ) {
		 	$sql .= $this -> setCond( $conds );
		}

		return $this -> query( $sql ); 
	}

	function insertId(){
		return $this -> conn -> insert_id;
	}

	function update( $table, $cols, $vals, $conds = null ){
		$sql = "UPDATE " . _DBPREFIX . $table . " ";
		$sql .= $this -> setVal( $cols, $vals );

		if ( $conds !== null ) {
		 	$sql .= $this -> setCond( $conds );
		}

		return $this -> query( $sql ); 
	}

	/**
	* Creating Data
	**/
	function sweep( $table ) {
		$sql = "SELECT * FROM " . _DBPREFIX . $table;

		return $this -> query( $sql ); 
	}

	function select( $table, $cols, $conds = null, $order = null, $limit = null, $offset = null ){
		$sql = "SELECT ";
		$sql .= $this -> setCols( $cols );
		$sql .= " FROM ". _DBPREFIX . $table . " ";

		if ( $conds !== null ) {
			$sql .= $this -> setCond( $conds );
		}

		if ( $order !== null ) {
			$sql .= "ORDER BY ";
			if ( is_array( $order ) ) {
				$sql .= $order[0] ." ". $order[1];
			} else {
				$sql .= $order . " ASC";
			}
		}

		if ( $offset !== null ) {
			$sql .= "OFFSET " . $offset;
		}

		if ( $limit !== null ) {
			$sql .= "LIMIT " . $limit;
		}

		return $this -> query( $sql );
	}



	function search( $table, $cols, $conds, $val = null ){
		$sql = "SELECT ";
		$sql .= $this -> setCols( $cols );
		$sql .= " FROM". _DBPREFIX . $table . " ";

		if ( $conds !== null ) {
			$sql .= $this -> setCond( $conds );
		}

		$sql .= $this -> setLike( $val );

		return $this -> query( $sql ); 
	}
	/**
	* Deleting Data
	**/
	function delete( $table, $conds ){
		$sql = "DELETE FROM " . _DBPREFIX . $table . " ";
		
		if ( $conds !== null ) {
		 	$sql .= $this -> setCond( $conds );
		}

		return $this -> query( $sql );
	}

	/**
	* Query Reports
	**/
	function rowsCount( $table, $cols ){
		$sql = "SELECT ";
		$sql .= $this -> setCols( $cols );
		$sql .= "FROM " . _DBPREFIX . $table . " ";

		$result = $this -> query( $sql );

		return $result -> num_rows;
	}

	/**
	* Query Reports
	**/
	function numRows( $result ){
		return $result -> num_rows;
	}

	function rowExists ( $sql ){
		if ( $this -> query( $sql -> num_rows > 0 ) ) {
			return true;
		} else {
			return false;
		}
	}

	function affectedRows(){
		return $this -> conn -> affected_rows;
	}

	function reset( $result ){
    	return mysqli_data_seek( $result, 0 );
  	}
}