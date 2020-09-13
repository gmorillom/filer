<?php
session_start();
require_once("../../Sources/php/controllers/ModelFiles.php");

$filer = new ModelFiles();
$files = $filer->list($_SESSION["dirname"]);
?>

<?php
$template = '
<div class="row>
<div class="col" id="main">
<span class="fa mb-2 logo-bg fa-2x"></span><span class="h4 logo-bg">Tus Archivos</span>
<div class="table-responsive table-hover">
<table class="table table-bordered table-sm" id="files">
<thead class="bg-dark text-white">
<tr>
<td>Nombre</td>
<td>Fecha de creación</td>
<td>Descargar</td>
<td>Vista previa</td>
<td>Eliminar</td>
</tr>
</thead>
<tbody>';

if( !empty($files) ){
	for( $i=0; $i < count($files); ++$i ){
		$path = "Files/".$_SESSION["dirname"]."/".$files[$i]["filename"];
		$filename = $files[$i]["filename"];

		$template .= '<tr>
		<td class="font-weight-bold text-center">'.$files[$i]["filename"].'</td>
		<td class="font-weight-bold text-center">'.$files[$i]["created"].'</td>
		<td class="font-weight-bold text-center">
		<a class="btn" href="'.$path.'" download="'.$filename.'"><span class="fa fa-download text-primary"></span></a>
		</td>
		<td class="font-weight-bold text-center">';
		$visibles = ["*.png","*.jpg","*.mp3","*.pdf","*.mp4"];

		foreach( $visibles as $item ){	
			if( fnmatch($item,$files[$i]["filename"]) ){
				$template .= '<button class="btn" onclick="return view('.$files[$i]["id"].')" data-toggle="modal" data-target="#viewFile"><span class="fa fa-eye text-warning"></span></button>
				';
			}	
		}
		
		$template .= '</td><td class="font-weight-bold text-center">
		<button class="btn" onclick="return delFile('.$files[$i]["id"].')"><span class="fa fa-trash text-danger"></span></button>
		</td>
		</tr>';
	}
}
$template .= '</tbody>
</table>
</div>
</div>
</div>';

echo($template);
?>

<div class="modal fade" id="viewFile" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content bg-transparent border-0">
			<div class="modal-header border-0">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="container-fluid bg-white">
					<div class="row">
						<div class="col" id="views"></div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	$.getScript("Sources/js/process/files.js");
</script>

<script type="text/javascript">
	$(document).ready(function(){
		$("#files").DataTable();
	});
</script>