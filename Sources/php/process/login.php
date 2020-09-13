<?php 
session_start();
require_once("../controllers/ModelUsers.php");
require_once("../controllers/ModelBooking.php");

//print_r($_POST);
if( isset($_POST["username"]) && isset($_POST["password"]) && is_string($_POST["username"]) ){
	$user = new ModelUsers();
	$access = new ModelBooking();

	$_POST["username"] = strip_tags($_POST["username"]);
	$_POST["password"] = strip_tags($_POST["password"]);
	$found = $user->find($_POST["username"]);

	if( !empty($found) && password_verify($_POST["password"],$found[0]["password"]) ){
		
		#CREANDO LA DATA DE LA SESION 
		$_SESSION["id"] = $found[0]["id"];
		$_SESSION["username"] = $found[0]["username"];
		$_SESSION["email"] = $found[0]["email"];
		$_SESSION["password"] = $found[0]["password"];
		$_SESSION["level"] = $found[0]["level"];
		$_SESSION["dirname"] = $found[0]["dirname"];
		$_SESSION["token"] = bin2hex(random_bytes(10));

		$date = getdate();
		$access_data = array(
			"username" => $_SESSION["username"],
			"access" => $date["year"]."-".$date["mon"]."-".$date["mday"]." ".$date["hours"].":".$date["minutes"].":".$date["seconds"]
		);
		$access->new($access_data);

		echo(isset($_SESSION["token"]) && strlen($_SESSION["token"]) === 20);
	}
	else return false;
}
?>