<?php
/**
* @package Jabali
* @subpackage Jabali SQLite Data Access Layer
* @author Mauko Maunde
* @link https://docs.jabalicms.org/data/access/layers/sqlite/
* @license MIT - https://opensource.org/licenses/MIT
* @since 0.17.09
**/

namespace Jabali\Data\Access\Layers;

class SQLiteDB {

	private $host;
	private $user;
	private $pass;
	private $name;

	private $conn;

	public function __construct( $dbname ) {

		$this -> conn = new \SQLite3( _ABSDB_.'sqlite/'.$dbname.'.db' );
		if ( !$this -> conn ) {
		    printf( "Connection failed: %s\n", $this -> error() );
		    exit();
		}
	}

	public function __destruct(){
		$this -> conn -> close();
	}

	public function query( $sql ){
		return $this -> conn -> query( $sql );
	}

	public function execute( $sql ){
		return $this -> conn -> exec( $sql );
	}

	public function error(){
		$this -> errorcode = $this -> conn -> lastErrorCode();
		return $this -> conn -> lastErrorMsg();
	}

	/**
	* @return Returns an associative array of database records from a query result, 
	* or null if there are no rows in the result
	**/
	public function fetchArray( $result ){
		return $result -> fetchArray(SQLITE3_ASSOC);
	}

	/**
	* @return Returns an object of database records from a query result, 
	* or null if there are no rows in the result
	**/
	public function fetchObject( $result ){
		return (object)$result -> fetchArray(SQLITE3_ASSOC);
	}

	/**
	* @return Returns an object of database records from a query result, 
	* or null if there are no rows in the result
	**/
	function fetchAll( $result )
	{
		return $result -> fetchAll(SQLITE_ASSOC);;
	}

	/**
	* Preparing our data
	* @return Returns escaped data to prevent mysqli injection
	**/
	public function clean( $data ){
		return $this -> conn -> escapeString( $data );
	}



	public function setCols( $cols ){
		if ( is_array( $cols ) ) {

			array_walk( $cols, array($this, 'clean' ) );

			$sql = implode(", ", $cols);
		} else {
			$sql = $this -> clean( $cols );
		}

		return $sql;
	}

	public function setVals( $vals ){
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

	public function setVal( $cols, $vals ){
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

	public function setCond( $conds ){
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

	public function setLike( $conds )
	{

		$where = array();

		foreach ( $conds as $id => $val ) {
	        $where[] = $id . " LIKE '%" . $val . "%'";
	    }

	    if ( count( $where ) > 0){
	      $sql = " WHERE " . implode( ' AND ', $where );
	    }

		return $sql;
	}

	/**
	* Creating Data
	**/
	public function insert( $table, $cols, $vals, $conds = null ){
		$sql = "INSERT INTO " . _DBPREFIX.$table . " ( ";
		$sql .= $this -> setCols( $cols );
		$sql .= " )";
		$sql .= $this -> setVals( $vals );

		if ( $conds !== null ) {
		 	$sql .= $this -> setCond( $conds );
		}

		return $this -> query( $sql ); 
	}

	public function insertId(){
		return $this -> conn -> lastInsertRowID();
	}

	public function update( $table, $cols, $vals, $conds = null ){
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
	public function sweep( $table ) {
		$sql = "SELECT * FROM " . _DBPREFIX . $table;

		return $this -> query( $sql ); 
	}

	public function select( $table, $cols, $conds = null, $order = null, $limit = null, $offset = null ){
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

	public function selectLike( $table, $cols, $like = null, $order = null, $limit = null, $offset = null )
	{
		$sql = "SELECT ";
		$sql .= $this -> setCols( $cols );
		$sql .= " FROM ". _DBPREFIX . $table . " ";

		if ( $like !== null ) {
			$sql .= $this -> setLike( $like );
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


	public function search( $table, $cols, $conds, $val = null ){
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
	public function delete( $table, $conds ){
		$sql = "DELETE FROM " . _DBPREFIX . $table . " ";
		
		if ( $conds !== null ) {
		 	$sql .= $this -> setCond( $conds );
		}

		return $this -> query( $sql );
	}

	/**
	* Query Reports
	**/
	public function rowsCount( $table, $cols ){
		$sql = "SELECT ";
		$sql .= $this -> setCols( $cols );
		$sql .= "FROM " . _DBPREFIX . $table . " ";

		$result = $this -> query( $sql );

		return $result -> num_rows;
	}

	/**
	* Query Reports
	**/
	public function numRows( $result ){
		$numRows = 0;
        while($rows = $result->fetchArray()){
            ++$numRows;
        }
        return $numRows;
	}

	public function rowExists ( $sql ){
		if ( $this -> query( $sql -> num_rows > 0 ) ) {
			return true;
		} else {
			return false;
		}
	}

	public function affectedRows(){
		return $this -> conn -> affected_rows;
	}

	public function reset( $result ){
    	return $this -> conn -> seek( $result, 0 );
  	}
}