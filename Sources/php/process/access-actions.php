<?php
session_start(); 
require_once("../controllers/ModelBooking.php");

if( isset($_POST["access-actions"]) && is_string($_POST["access-actions"]) ){

	switch( $_POST["access-actions"] ){
		case "delete":
		$access = new ModelBooking();
		$username = ( $_SESSION["level"] !== "Root" ) ? $_SESSION["username"] : NULL;
		echo($access->delete($username));
		break;

		default: ;break;
	}
}

?>