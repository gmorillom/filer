<?php  
require_once("ModelConnection.php");

final class ModelUsers extends ModelConnection {

	public function new( $data_user = array() ){
		foreach ($data_user as $key => $value) $$key = $value;
		
		$this->sql = "INSERT INTO Users(username,email,password,level,dirname) VALUES ('$username','$email','$password','$level','$dirname');";
		
		return $this->one_result();
	}

	public function find( $username = NULL ){
		$this->sql = ( $username !== NULL ) 
		? "SELECT id, email, username, password, level, dirname FROM Users WHERE username='$username';"
		: "SELECT id, email, username, level, dirname FROM Users;";
		$this->multi_results();

		return $this->rows;
	}

	public function change_info( $data_user = array() ){
		foreach ($data_user as $key => $value) $$key = $value;

		$this->sql = "UPDATE Users SET email='$email', password='$password' WHERE id=$id;";

		return $this->one_result();
	}

	public function reset_password( $email, $password ){
		$this->sql = "UPDATE Users SET email='$email',password='$password' WHERE email='$email';";

		return $this->one_result();
	}

	public function delete( $username ){
		$this->sql = "DELETE FROM Users WHERE username='$username';";
		return $this->one_result();
	}

	public function __destruct(){
		unset($this->connection);
	}
}
?>