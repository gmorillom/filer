<?php  
require_once("ModelConnection.php");

final class ModelBooking extends ModelConnection {

	public function new( $access_data = array() ){
		foreach( $access_data as $key => $value ) $$key = $value;
		
		$this->sql = "INSERT INTO AccessBooking(username,access) VALUES ('$username','$access');";
		
		return $this->one_result();
	}

	public function list( $username = NULL ){
		
		$this->sql = ( $username !== NULL ) 
		? "SELECT id, username, access FROM AccessBooking WHERE username='$username';" 
		: "SELECT id, username, access FROM AccessBooking;";
		
		$this->multi_results();
		
		return $this->rows;
	}

	public function update(){ }

	public function delete( $username = NULL ){
		$this->sql = ( $username !== NULL ) 
		? "DELETE FROM AccessBooking WHERE username='$username';"
		: "DELETE FROM AccessBooking;";
		
		return $this->one_result();
	}

	public function __destruct(){
		unset($this->sql);
		unset($this->rows);
	}
}
?>