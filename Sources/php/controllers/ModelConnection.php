<?php  
abstract class ModelConnection {
	private static $host = "localhost";
	private static $user = "root";
	private static $password = "";
	private static $database = "filer2";
	private $connection; 
	protected $sql;
	protected $rows = array();

	private function connection(){
		$this->connection = new mysqli(self::$host, self::$user, self::$password, self::$database);
	}

	private function disconnection(){
		$this->connection->close();
	}

	protected function one_result(){
		self::connection();
		$catch = $this->connection->query($this->sql);
		self::disconnection();
		return $catch;
	}

	protected function multi_results(){
		self::connection();
		$tmp = $this->connection->query($this->sql);
		while( $this->rows[] = $tmp->fetch_assoc() );
		$tmp->close();
		self::disconnection();
		array_pop($this->rows);
	}
}

?>