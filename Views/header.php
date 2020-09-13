<?php
session_start();
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
	<title>Manager</title>
	<link rel="stylesheet" href="Sources/css/bootstrap/dist/css/bootstrap.min.css">
	<link rel="stylesheet" href="Sources/css/font-awesome/css/font-awesome.min.css">
	<link rel="stylesheet" href="Sources/css/extra.css">
	<link rel="stylesheet" href="Sources/css/dataTables.bootstrap4.min.css">
	<link rel="shortcut icon" href="Sources/img/logo.png">
</head>
<body>
	<div class="container-fluid h-100">

		<?php
		if( isset($_SESSION["level"]) && isset($_SESSION["token"]) ){
			?>
			<div class="row bg-light d-none d-md-flex">
				<div class="col-3 col-md-2 col-lg-1">
					<img src="Sources/img/logo.png" class="img-fluid p-2">
				</div>
				<div class="col d-flex align-self-center offset-md-2">
					<form method="POST">
						<input type="hidden" name="dashboard" value="files">
						<button type="submit" class="btn logo-bg"><i class="fa fa-file fa-2x"></i><span class="h4">Archivos</span></button>
					</form>
				</div>
				<div class="col d-flex align-self-center ml-md-3">
					<button type="button" data-toggle="collapse" data-target="#dashboard" aria-expanded="false" class="btn logo-bg"><i class="fa fa-dashboard fa-2x"></i><span class="h4"> Panel</span></button>
				</div>
				<div class="col d-flex align-self-center">
					<a href="Sources/php/process/logout.php" class="btn logo-bg"><i class="fa fa-external-link fa-2x"></i><span class="h4"> Cerrar</span></a>
				</div>
			</div>

			<div class="row bg-light d-md-none">
				<div class="col-3 d-flex align-self-center">
					<img src="Sources/img/logo.png" class="img-fluid p-2">
				</div>
				<div class="col-3 d-flex align-self-center">
					<form method="POST">
						<input type="hidden" name="dashboard" value="files">
						<button type="submit" class="btn logo-bg"><i class="fa fa-file fa-2x"></i></button>
					</form>
				</div>
				<div class="col-3 d-flex align-self-center">
					<button type="button" data-toggle="collapse" data-target="#dashboard" aria-expanded="false" class="btn logo-bg"><i class="fa fa-dashboard fa-2x"></i></button>
				</div>
				<div class="col-3 d-flex align-self-center">
					<a href="Sources/php/process/logout.php" class="btn logo-bg"><i class="fa fa-lock fa-2x"></i></a>
				</div>
			</div>

			<div class="row">
				<div class="collapse col-11 col-md-9 offset-md-3" id="filer">
					<div class="row">
						<div class="col d-flex align-self-center">
							<form method="POST">
								<input type="hidden" name="dashboard" value="files">
								<button type="submit" class="btn text-dark"><i class="fa fa-file">Archivos</i></button>
							</form>
						</div>
						<div class="col d-flex align-self-center">
							<form method="POST">
								<input type="hidden" name="dashboard" value="category">
								<button type="submit" class="btn text-dark"><i class="fa fa-folder">Categorias</i></button>
							</form>
						</div>
					</div>
				</div>
			</div>

			<?php
			if( $_SESSION["level"] === "Root" ){
				echo('
					<div class="row">
					<div class="collapse col-11 col-md-9 offset-md-3" id="dashboard">
					<div class="row">
					<div class="col d-flex align-self-center">
					<form method="POST">
					<input type="hidden" name="dashboard" value="change-info">
					<button type="submit" class="btn text-dark"><i class="fa fa-key">Actualizar datos</i></button>
					</form>
					</div>
					<div class="col d-flex align-self-center">
					<form method="POST">
					<input type="hidden" name="dashboard" value="access">
					<button type="submit" class="btn text-dark"><i class="fa fa-address-book">Acceso</i></button>
					</form>
					</div>
					<div class="col d-flex align-self-center">
					<form method="POST">
					<input type="hidden" name="dashboard" value="users">
					<button type="submit" class="btn text-dark"><i class="fa fa-users">Usuarios</i></button>
					</form>
					</div>
					</div>
					</div>
					</div>
					');
			}
			else if( $_SESSION["level"] === "Admin" ){
				echo('
					<div class="row">
					<div class="collapse col-11 col-md-9 offset-md-3" id="dashboard">
					<div class="row">
					<div class="col d-flex align-self-center">
					<form method="POST">
					<input type="hidden" name="dashboard" value="change-info">
					<button type="submit" class="btn text-dark"><i class="fa fa-key">Actualizar datos</i></button>
					</form>
					</div>
					<div class="col d-flex align-self-center">
					<form method="POST">
					<input type="hidden" name="dashboard" value="access">
					<button type="submit" class="btn text-dark"><i class="fa fa-address-book">Accesos</i></button>
					</form>
					</div>
					<div class="col d-flex align-self-center">
					<form method="POST">
					<input type="hidden" name="dashboard" value="users">
					<button type="submit" class="btn text-dark"><i class="fa fa-users">Usuarios</i></button>
					</form>
					</div>
					</div>
					</div>
					</div>
					');
			}
			else if( $_SESSION["level"] === "Client" ){
				echo('
					<div class="row">
					<div class="collapse col-11 col-md-9 offset-md-3" id="dashboard">
					<div class="row">
					<div class="col d-flex align-self-center">
					<form method="POST">
					<input type="hidden" name="dashboard" value="change-info">
					<button type="submit" class="btn text-dark"><i class="fa fa-key">Actualizar datos</i></button>
					</form>
					</div>
					<div class="col d-flex align-self-center">
					<form method="POST">
					<input type="hidden" name="dashboard" value="access">
					<button type="submit" class="btn text-dark"><i class="fa fa-address-book">Accesos</i></button>
					</form>
					</div>
					<div class="col d-flex align-self-center">
					<form method="POST">
					<input type="hidden" name="dashboard" value="support">
					<button type="submit" class="btn text-dark"><i class="fa fa-info">Soporte</i></button>
					</form>
					</div>
					</div>
					</div>
					</div>
					');
			}
		}
		?>
