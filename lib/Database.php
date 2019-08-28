<?php
Class Database{
	public $host   = DB_HOST;
	public $user   = DB_USER;
	public $pass   = DB_PASS;
	public $dbname = DB_NAME;
	
	
	public $conn;
	public $error;
	
	public function __construct(){
		$this->connectDB();
	}
	
	private function connectDB(){
	$this->conn = new mysqli($this->host, $this->user, $this->pass, $this->dbname);
	if(!$this->conn){
		$this->error ="Connection fail".$this->conn->connect_error;
		return false;
	}
 }
	
	// Select or Read data
	
	public function select($sql){
		$result = $this->conn->query($sql) or die($this->conn->error.__LINE__);
		if($result->num_rows > 0){
			return $result;
		} else {
			return false;
		}
	}
	
	// Insert data
	public function insert($sql){
	$insert_row = $this->conn->query($sql) or die($this->conn->error.__LINE__);
	if($insert_row){
		return $insert_row;
	} else {
		return false;
  	}
  }
    // Update data
  	public function update($sql){
	$update_row = $this->conn->query($sql) or die($this->conn->error.__LINE__);
	if($update_row){
		return $update_row;
	} else {
		return false;
	}
  }
  
  // Delete data
   public function delete($sql){
	$delete_row = $this->conn->query($sql) or die($this->conn->error.__LINE__);
	if($delete_row){
		return $delete_row;
	} else {
		return false;
	}
  }

}

