<?php
session_start();
require_once("../controllers/ModelFiles.php");
require_once("../controllers/FileManager.php");

if( isset($_POST["file-actions"]) && is_string($_POST["file-actions"]) ){
	$filer = new ModelFiles();
	$filerP = new FileManager();

	switch( $_POST["file-actions"] ){
		case "upload": 
		
		if( isset($_FILES["doc"]) && $_FILES["doc"]["size"] > 0 ){
			
			$_POST["filename"] = strip_tags($_POST["filename"]);
			$_POST["users"] = strip_tags($_POST["users"]);

			$extension = pathinfo($_FILES["doc"]["name"],PATHINFO_EXTENSION);
			$final_folder = "../../../Files/".$_POST["users"];
			$filename = $_POST["filename"].".".$extension;

			$filedata = array(
				"filename" => $filename,
				"dirname" => $_POST["users"],
				"created" => date("Y/m/d",time())
			);

			
			if( $filerP->testing($_FILES["doc"]) ){
				if( $filerP->upload($_FILES["doc"]["tmp_name"], $final_folder, $filename) ){

					if( $filer->save($filedata) ) echo(true);
					else echo(false);
				}
				else echo(false);
			}
			else echo(false);
		}
		exit();
		break;

		case "view":
		
		if( isset($_POST["view_id"]) && is_numeric($_POST["view_id"]) ){
			settype($_POST["view_id"],"int");

			$found = $filer->find($_POST["view_id"]);
			$path = "Files/".$found[0]["dirname"]."/".$found[0]["filename"];
			$extension = pathinfo($path,PATHINFO_EXTENSION);

			switch( $extension ){
				case "png":
				echo('<img src="'.$path.'" class="w-100">');
				exit();
				break;

				case "jpg":
				echo('<img src="'.$path.'" class="w-100">');
				exit();
				break;

				case "pdf":
				echo('<embed src="'.$path.'#toolbar=0&navpanes=0&scrollbar=0" type="application/pdf" height="600px" class="w-100" />');
				exit();
				break;

				case "mp3":
				echo('<audio src="'.$path.'" preload="none" class="w-100" controls></audio>');
				exit();
				break;

				case "mp4":
				echo('<video src="'.$path.'" class="w-100" controls></video>');
				exit();
				break;

				default: 
				echo('<iframe src="https://docs.google.com/viewer?url=http://127.0.0.1/filer/'.$path.'&embedded=true" height="600" class="w-100" style="border: none;"></iframe>');
				break;
			}
		}
		break;

		case "delete":
		
		if( isset($_POST["id"]) && is_numeric($_POST["id"]) ){
			settype($_POST["id"],"int");
			
			$found = $filer->find($_POST["id"]);
			$filerP->delete("../../../Files/".$found[0]["dirname"]."/".$found[0]["filename"]);
			echo($filer->delete_by_id($_POST["id"]));
		}
		break;

		default: ;break;
	}
}

?>

