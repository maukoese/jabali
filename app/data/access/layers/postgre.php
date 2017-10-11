<?php 
namespace Jabali\Data\Access\Layers;

/**
* 
*/
class PostgreSQL {

	public function __construct( $dbhost, $dbuser, $dbpass, $dbname, $dbport, $dbip ){
		   $host = "host = ".$dbhost;
		   $port = "port = ".$dbport;
		   $dbname = "dbname = ".$dbname;
		   $user = "user = ".$dbuser;
		   $password = "password = ".$dbpass;

		   $this -> conn = pg_connect( $host $port $dbname $user $password );
		   if( !$this -> conn ) {
		      echo "Error : Unable to open database\n";
		   }
	}


	function create ( $table ){
	   $sql =<<<EOF
	      CREATE TABLE COMPANY
	      (ID INT PRIMARY KEY     NOT NULL,
	      NAME           TEXT    NOT NULL,
	      AGE            INT     NOT NULL,
	      ADDRESS        CHAR(50),
	      SALARY         REAL);
EOF;

	   $ret = pg_query($db, $sql);
	   if(!$ret) {
	      echo pg_last_error($db);
	   } else {
	      echo "Table created successfully\n";
	   }
	   pg_close( $this -> conn );
	}


	function insert(){

	   $sql = <<<EOF
	      INSERT INTO COMPANY (ID,NAME,AGE,ADDRESS,SALARY)
	      VALUES (1, 'Paul', 32, 'California', 20000.00 );

	      INSERT INTO COMPANY (ID,NAME,AGE,ADDRESS,SALARY)
	      VALUES (2, 'Allen', 25, 'Texas', 15000.00 );

	      INSERT INTO COMPANY (ID,NAME,AGE,ADDRESS,SALARY)
	      VALUES (3, 'Teddy', 23, 'Norway', 20000.00 );

	      INSERT INTO COMPANY (ID,NAME,AGE,ADDRESS,SALARY)
	      VALUES (4, 'Mark', 25, 'Rich-Mond ', 65000.00 );
EOF;

	   $ret = pg_query($db, $sql);
	   if(!$ret) {
	      echo pg_last_error($db);
	   } else {
	      echo "Records created successfully\n";
	   }
	   pg_close( $this -> conn );
	}


	function select(){

	   $sql =<<<EOF
	      SELECT * from COMPANY;
EOF;

	   $ret = pg_query($db, $sql);
	   if(!$ret) {
	      echo pg_last_error($db);
	      exit;
	   } 
	   while($row = pg_fetch_row($ret)) {
	      echo "ID = ". $row[0] . "\n";
	      echo "NAME = ". $row[1] ."\n";
	      echo "ADDRESS = ". $row[2] ."\n";
	      echo "SALARY =  ".$row[4] ."\n\n";
	   }
	   echo "Operation done successfully\n";
	   pg_close( $this -> conn );
	}

	function update(){
	   $sql =<<<EOF
	      UPDATE COMPANY set SALARY = 25000.00 where ID=1;
EOF;
	   $ret = pg_query($db, $sql);
	   if(!$ret) {
	      echo pg_last_error($db);
	      exit;
	   } else {
	      echo "Record updated successfully\n";
	   }
	   
	   $sql =<<<EOF
	      SELECT * from COMPANY;
EOF;

	   $ret = pg_query($db, $sql);
	   if(!$ret) {
	      echo pg_last_error($db);
	      exit;
	   } 
	   while($row = pg_fetch_row($ret)) {
	      echo "ID = ". $row[0] . "\n";
	      echo "NAME = ". $row[1] ."\n";
	      echo "ADDRESS = ". $row[2] ."\n";
	      echo "SALARY =  ".$row[4] ."\n\n";
	   }
	   echo "Operation done successfully\n";
	   pg_close( $this -> conn );
	}

	function delete(){

	   $sql =<<<EOF
	      SELECT * from COMPANY;
EOF;

	   $ret = pg_query($db, $sql);
	   if(!$ret) {
	      echo pg_last_error($db);
	      exit;
	   } 
	   while($row = pg_fetch_row($ret)) {
	      echo "ID = ". $row[0] . "\n";
	      echo "NAME = ". $row[1] ."\n";
	      echo "ADDRESS = ". $row[2] ."\n";
	      echo "SALARY =  ".$row[4] ."\n\n";
	   }
	   echo "Operation done successfully\n";
	   pg_close( $this -> conn );
	}
}