<?php  
final class FileManager {
	#GUARDAR UN ARCHIVO
	public function upload( $tmp_name, $path, $filename ){
		if( file_exists($path) ){
			$path .= "/".$filename;
			return move_uploaded_file($tmp_name,$path);
		}
		else{
			if( mkdir($path) ){
				$path .= "/".$filename;
				return move_uploaded_file($tmp_name,$path);
			}
			else return false;
		}
	}

		#VERIFICAR LA VALIDEZ DEL ARCHIVO
	public function testing( $file = array() ){
		$max_size = 16000000;
		return ( !self::disallowed_format($file["name"]) && ($file["size"] <= $max_size) );
	}

		#VERIFICAR SI ES UN TIPO DE ARCHIVO INVALIDO
	private function disallowed_format( $filename ){
		$patterns = ["*.php","*.js","*.css","*.html","*.xhtml","*.htaccess","*.c","*.","*.exe","*.asm","*.bin","*.com","*.asp","*.bash","*.dll","*.shell","*.sql","*.xlsm","*.dotm","*.pptm","*.msi","*.ocx","*.vbs","*.cpio","*.bat","*.cmd","*.chm","*.ins","*.lib","*.isp","*.cpl","*.swf","*.scr"];

		foreach( $patterns as $pattern ){	if( fnmatch($pattern,$filename) ) return true;	}
		return false;
	}

		#ENLISTAR LOS ARCHIVOS EN UN DIRECTORIO
	public function list( $path ){
		if( is_readable($path) ){
			$tmp = array_diff(scandir($path),[".",".."]);
			$filedata = array();
			
			foreach( $tmp as $filename ){
				if( !self::disallowed_format($filename) ){
					$file = $path."/".$filename;
					$info = stat($file);
					$filedata[] = [
						"mtime" => $info["mtime"],
						"name" => basename($file),
						"size" => $info["size"],
						"category" => ( $category !== NULL ) ? $category : NULL,
						"is_dir" => is_dir($file),
						"extension" => pathinfo($file,PATHINFO_EXTENSION),
						"is_deleteable" => is_writable($file),
						"is_readable" => is_readable($file),
						"is_writable" => is_writable($file),
						"is_executable" => is_executable($file)
					];
				}
			}
			return $filedata;
		} 
		else return false;
	}

		#ELIMINAR DIRECTORIOS O ARCHIVOS
	public function delete( $path ){

		if( is_dir($path) ){
			$files = array_diff(scandir($path),[".",".."]);
			$dir = end(explode("/",$path));
			
			foreach( $files as $file ){	self::delete("$dir/$file"); }
			rmdir($path);
		}
		else unlink($path);
	}

	public function download( $path ){
		
		if ( is_file($path) ) {
				#el nombre con el que se descargará, puede ser diferente al original
			$filename = basename($path);
			header("Content-Type: application/force-download");
			header("Content-Disposition: attachment; filename=".$filename."");
			readfile($path);
		} 
		else die("Error: no se encontró el archivo '$filename'");
	}
}

?>