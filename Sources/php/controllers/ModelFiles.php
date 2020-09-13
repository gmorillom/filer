<?php 
require_once("ModelConnection.php");

final class ModelFiles extends ModelConnection{

	public function save( $filedata = array() ){
		foreach( $filedata as $key => $value ) $$key = $value;

		$this->sql = "INSERT INTO Files(filename,dirname,created) VALUES ('$filename','$dirname','$created');";

		return $this->one_result();
	}
	
	public function list( $dirname ){
		$this->sql = "SELECT id, filename, created FROM Files WHERE dirname='$dirname';";

		$this->multi_results();

		return $this->rows;
	}

	public function find( $id ){
		$this->sql = "SELECT filename, dirname FROM Files WHERE id=$id;";

		$this->multi_results();

		return $this->rows;
	}

	public function delete_by_id( $id ){
		$this->sql = "DELETE FROM Files WHERE id=$id;";

		return $this->one_result();
	}

	public function delete_by_dir( $dirname ){
		$this->sql = "DELETE FROM Files WHERE dirname='$dirname';";

		return $this->one_result();
	}
}

?>