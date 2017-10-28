<?php 
namespace Jabali\Data\Access\Layers;

/**
* Jabali SQLite Data Access Layer
*/
class SQLiteDB {

	private $host;
	private $user;
	private $pass;
	private $name;

	private $conn;

	function __construct( $dbname ) {

		$this -> conn = new \SQLite3( _ABSDB_.'sqlite/'.$dbname.'.sq3' );
		if ( !$this -> conn ) {
		    printf( "Connection failed: %s\n", $this -> error() );
		    exit();
		}

	}

	function __destruct(){
		$this -> conn -> close();
	}

	function query( $sql ){
		return $this -> conn -> query( $sql );
	}

	function execute( $sql ){
		return $this -> conn -> exec( $sql );
	}

	function error(){
		$this -> errorcode = $this -> conn -> lastErrorCode();
		return $this -> conn -> lastErrorMsg();
	}

	/**
	* @return Returns an associative array of database records from a query result, 
	* or null if there are no rows in the result
	**/
	function fetchArray( $result ){
		return $result -> fetchArray(SQLITE3_ASSOC);
	}

	/**
	* @return Returns an object of database records from a query result, 
	* or null if there are no rows in the result
	**/
	function fetchObject( $result ){
		return (object)$result -> fetchArray(SQLITE3_ASSOC);
	}

	/**
	* Preparing our data
	* @return Returns escaped data to prevent mysqli injection
	**/
	function clean( $data ){
		return $this -> conn -> escapeString( $data );
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
		return $this -> conn -> lastInsertRowID();
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
		$numRows = 0;
        while($rows = $result->fetchArray()){
            ++$numRows;
        }
        return $numRows;
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