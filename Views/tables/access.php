<?php
session_start(); 
require_once("../../Sources/php/controllers/ModelBooking.php");

$access = new ModelBooking();

if( $_SESSION["level"] === "Root" ) $list = $access->list();
else $list = $access->list($_SESSION["username"]);
?>

<?php
$template = '
<div class="row justify-content-center">
<div class="col-sm-9" id="main">
<button id="deleteAccess" class="btn" onclick="return del_access()"><span class="fa fa-trash fa-2x text-danger"></span></button>
<span class="fa mb-2 logo-bg fa-2x"></span><span class="h4 logo-bg">Ingresos al sistema</span> 
<hr>
<div class="table-responsive table-hover">
<table class="table table-bordered table-sm" id="accesses">
<thead class="bg-dark text-white">
<tr>
<td>Usuario</td>
<td>Fecha</td>
</tr>
</thead>
<tbody>';

if( !empty($list) ){
	for( $i=0; $i < count($list); ++$i ){
		$template .= '<tr>
		<td class="font-weight-bold text-center">'.$list[$i]["username"].'</td>
		<td class="font-weight-bold text-center">'.$list[$i]["access"].'</td>
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

<script type="text/javascript">
	$.getScript("Sources/js/process/access.js");
</script>

<script type="text/javascript">
	$(document).ready(function(){
		$("#accesses").DataTable();
	});
</script>