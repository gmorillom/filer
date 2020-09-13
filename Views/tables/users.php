<?php
session_start(); 
require_once("../../Sources/php/controllers/ModelUsers.php");

$user = new ModelUsers();
$users = $user->find();
?>

<?php
$template = '
<div class="row">
<div class="col" id="main">
<button type="button" class="btn" data-toggle="modal" data-target="#newFile" title="Subir archivo"><span class="fa fa-file text-primary fa-2x"></span></button>
<button type="button" class="btn" data-toggle="modal" data-target="#register"><span class="fa fa-user-plus text-primary fa-2x"></span></button>
<span class="fa mb-2 logo-bg fa-2x"></span><span class="h4 logo-bg">Usuarios</span>
<div class="table-responsive table-hover">
<table class="table table-bordered table-sm" id="users">
<thead class="bg-dark text-white">
<tr>
<td>Usuario</td>
<td>Nivel</td>
<td>Correo electrónico</td>
<td>Resetear contraseña</td>';

if( $_SESSION["level"] === "Root" )
	$template .= '<td>Eliminar Usuario</td></tr></thead>';
else
	$template .= '</tr></thead>';

$template .= '<tbody>';

if( !empty($users) ){
	for( $i=0; $i < count($users); ++$i ){
		$template .= '<tr>
		<td class="font-weight-bold text-center">'.$users[$i]["username"].'</td>
		<td class="font-weight-bold text-center">'.$users[$i]["level"].'</td>
		<td class="font-weight-bold text-center">'.$users[$i]["email"].'</td>
		<td class="font-weight-bold text-center">
		<button type="button" class="btn" onclick=reset_pw(`'.$users[$i]["email"].'`)><span class="fa fa-key logo-bg"></span></button>
		</td>
		';

		if( $_SESSION["level"] === "Root" ){
			$template .= '<td class="font-weight-bold text-center">
			<button type="button" class="btn" onclick=del_user(`'.$users[$i]["username"].'`)><span class="fa fa-trash text-danger"></span></button></td></tr>';
		}
		else 
			$template .= '</tr>';
	}
}
$template .= '</tbody>
</table>
</div>
</div>
</div>';

echo($template);
?>

<div class="modal fade" id="register" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content bg-transparent border-0">
			<div class="modal-header border-0">
				<div class="row">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
			</div>
			<div class="modal-body">
				<div class="container-fluid user_card">
					<h1 class="font-weight-bold text-center">Registrar un usuario</h1><hr>
					<div class="row">
						<div class="col">
							<form method="POST" id="formRegister" onsubmit="return new_user()" autocomplete="off">
								<div class="input-group mb-3">
									<div class="input-group-append">
										<span class="input-group-text"><i class="fa fa-user"></i></span>
									</div>
									<input type="text" name="username" class="form-control input_user" placeholder="Usuario" required>
								</div>
								<div class="input-group mb-3">
									<div class="input-group-append">
										<span class="input-group-text"><i class="fa fa-envelope"></i></span>
									</div>
									<input type="email" name="email" class="form-control input_user" placeholder="example@gmail.com" required>
								</div>
								<div class="input-group mb-2">
									<div class="input-group-append">
										<span class="input-group-text"><i class="fa fa-key"></i></span>
									</div>
									<input type="password" name="password" class="form-control input_pass" placeholder="contraseña" required>
								</div>
								<div class="input-group mb-2">
									<div class="input-group-append">
										<span class="input-group-text"><i class="fa fa-id-card"></i></span>
									</div>
									<input type="radio" name="credential" class="form-control-sm input_pass" value="2"><label for="credential" class="font-weight-bold">Admin</label>
									<input type="radio" name="credential" class="form-control-sm input_pass" value="3" checked><label for="credential" class="font-weight-bold">Cliente</label>
									<input type="hidden" name="user-actions" value="register">
								</div>
								<div class="d-flex justify-content-center mt-3 login_container">
									<input type="submit" value="Registrar" class="btn login_btn">
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="newFile" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content bg-transparent border-0">
			<div class="modal-header border-0">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="container-fluid user_card">
					<div class="row">
						<div class="col">
							<form method="POST" id="formUpload" enctype="multipart/form-data" onsubmit="return upload()">
								<div class="input-group mb-3">
									<div class="input-group-append">
										<span class="input-group-text"><i class="fa fa-file"></i></span>
									</div>
									<input type="file" name="doc" class="form-control input_user" required multiple>
								</div>
								<div class="input-group mb-3">
									<div class="input-group-append">
										<span class="input-group-text"><i class="fa fa-file"></i></span>
									</div>
									<input type="text" name="filename" class="form-control input_user" placeholder="Nombre para el archivo" required>
								</div>
								
								<?php
								
								$template = '<div class="input-group mb-3">
								<div class="input-group-append">
								<span class="input-group-text"><i class="fa fa-users"></i></span>
								</div><select name="users">
								';
								for( $i=0; $i < count($users);++$i ){
									if( $users[$i]["username"] !== $_SESSION["username"]  ){
										$template .= '
										<option value="'.$users[$i]["dirname"].'">'.$users[$i]["username"].'</option>
										';
									}
								}

								$template .= '</select></div>';  
								echo($template);
								
								?>
								
								<input type="hidden" name="file-actions" value="upload">
								<div class="d-flex justify-content-center mt-3 login_container">
									<input type="submit" value="Subir" class="btn login_btn">
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	$.getScript("Sources/js/process/users.js");
</script>

<script type="text/javascript">
	$.getScript("Sources/js/process/files.js");
</script>

<script type="text/javascript">
	$(document).ready(function(){
		$("#users").DataTable();
	});
</script>