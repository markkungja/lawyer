<?php
date_default_timezone_set("Asia/Bangkok");
define('DB_SERVER','localhost');
define('DB_USER','techprogro_t9test');
define('DB_PASS' ,'tarnine12345');
define('DB_NAME', 'techprogro_t9test');
class db_conn{
	var $DB;
	function __construct(){
		$conDB = mysqli_connect(DB_SERVER,DB_USER,DB_PASS) or die('localhost connection problem'.mysqli_error());
		$this->DB = $conDB;
		mysqli_select_db($conDB,DB_NAME);
		mysqli_query($this->DB,"SET NAMES utf8");
	}
	public function sqlQuery($strSQL){
		mysqli_query($this->DB,"SET NAMES utf8");
		$objQuery = mysqli_query($this->DB, $strSQL);
		return $objQuery;
	}
	public function sqlEscapestr($value){
		if($value != ''){
			$obj = mysqli_real_escape_string($this->DB,$value);
		}else{
			$obj = $value;
		}
		return $obj;
	}
	public function sqlNumrows($strSQL){
		$objQuery = mysqli_query($this->DB,$strSQL);
		$numRows = mysqli_num_rows($objQuery);
		return $numRows;
	}
	public function close_db(){
		mysqli_close($conn);
	}
}
?>