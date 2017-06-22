<?php
require_once("config.php");

class Database {

	private $host = DB_HOST;
	private $user = DB_USER;
	private $pass = DB_PASS;
	private $dbname = DB_NAME;
	
	public $link;
	
	function __construct() {
		$this->connetti();
	}

	public function connetti() {
		$this->link = mysqli_connect($this->host, $this->user, $this->pass, $this->dbname);
	}
	
	public function query($query) {
		return $this->link->query($query);
	}

	public function select($query) {
		 $result = mysqli_query($this->link, $query);
		if ($result->num_rows > 0){
			return $result;
		} else			
			return false;
	}
	public function numRecord($query) {
		return mysqli_query($this->link, $query)->num_rows;	
	}
}

?>