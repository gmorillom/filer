<?php
session_start();
require_once("../controllers/ModelUsers.php");
require_once("../controllers/FileManager.php");
require_once("../controllers/ModelFiles.php");

$user = new ModelUsers();
//echo(!isset($_POST["user-actions"]));
if( isset($_POST["user-actions"]) && is_string($_POST["user-actions"]) ){

	switch ( $_POST["user-actions"] ) {
			#OPERACION DE REGISTRO DE USUARIO
		case "register":
		$_POST["username"] = strip_tags($_POST["username"]);
		$saved = $user->find($_POST["username"]);

		if( empty($saved) ){
			$_POST["password"] = strip_tags($_POST["password"]);
			$password = password_hash($_POST["password"], PASSWORD_ARGON2I, ["cost" => 9]);

			$new_user_data = array(
				"username" => $_POST["username"],
				"email" => strip_tags($_POST["email"]),
				"password" => $password,
				"level" => is_int($_POST["credential"]) ? $_POST["credential"] : 3,
				"dirname" => bin2hex(random_bytes(8))
			);
			echo($user->new($new_user_data));
		}
		break;

		case "change-password":
		if( isset($_POST["current_email"]) && isset($_POST["current_password"]) && isset($_POST["new_email"]) && isset($_POST["new_password"]) ){

			$_POST["current_email"] = strip_tags($_POST["current_email"]);
			$_POST["current_password"] = strip_tags($_POST["current_password"]);
			$_POST["new_email"] = strip_tags($_POST["new_email"]);
			$_POST["new_password"] = strip_tags($_POST["new_password"]);

				#VERIFICANDO SI LAS CONTRASEÑAS COINCIDEN
			if( password_verify($_POST["current_password"],$_SESSION["password"]) ){
				$data_user = array(
					"id" => $_SESSION["id"],
					"email" => $_POST["new_email"],
					"password" => password_hash($_POST["new_password"], PASSWORD_ARGON2I, ["cost" => 9])
				);

				if( $user->change_info($data_user) ) echo("Cambios realizados correctamente");
				else echo("Algo ocurrió");
			}
			else
				echo("La contraseña que introdujiste no coincide con la actual");
		}
		break;

		case "delete":
		if( isset($_POST["username_for_del"]) && is_string($_POST["username_for_del"]) ) {
			$filer = new ModelFiles();
			$filerP = new FileManager();

			$_POST["username_for_del"] = strip_tags($_POST["username_for_del"]);
			$found_user = $user->find($_POST["username_for_del"]);
			$found_files = $filer->list($found_user[0]["dirname"]);

			if( !empty($found_files) ){
				for( $i=0; $i < count($found_files); $i++ ){
					$path_tmp = "../../../Files/".$found_user[0]["dirname"]."/".$found_files[$i]["filename"];
					$filerP->delete($path_tmp);
				}
			}

			$filerP->delete("../../../Files/".$found_user[0]["dirname"]);
			echo($user->delete($_POST["username_for_del"]));
		}
		break;

		case "reset-password":
		if( isset($_POST["email_for_reset"]) && is_string($_POST["email_for_reset"]) ){
			$pw = bin2hex(random_bytes(12));
			$password = password_hash($pw,PASSWORD_ARGON2I,["cost" => 9]);
			$_POST["email_for_reset"] = strip_tags($_POST["email_for_reset"]);

			if( $user->reset_password($_POST["email_for_reset"],$password) ){
				$from = "gestion@gmail.com";
				$to = $_POST["email_for_reset"];
				$issue = "Cambio de contraseña";
				$message = "Felicidades el cambio de contraseña ha sido realizado satisfactoriamente...
				Tu nueva contraseña es  ".$pw."  Guárdala y no se la confies a nadie...";
				$header = "From: ".$from."\r\n"."Reply-To: ".$from;

				echo(mail($to,$issue,$message,$header));
			}
			else echo(false);
		}
		break;

		case "support":
		if( isset($_POST["issue"]) && !is_numeric($_POST["issue"]) && isset($_POST["message"]) ){
			$_POST["issue"] = strip_tags($_POST["issue"]);
			$_POST["message"] = strip_tags($_POST["message"]);

			
			$to = "gestion@gmail.com";
			$from = "gestion@gmail.com";
			$issue = $_POST["issue"];
			$message = $_POST["message"];
			$header = "From: ".$from."\r\n"."Reply-To: ".$_SESSION["email"];

			echo(mail($to,$issue,$message,$header));
		}
		break;

		default:
				# code...
		break;
	}
}
?>