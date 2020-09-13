<?php 
include_once("Views/header.php");

if( isset($_SESSION["token"]) ) header("Location: app.php");
?>

<div class="d-flex justify-content-center h-100">
	<div class="user_card" style="width:360px;">
		<div class="d-flex justify-content-center">
			<div class="brand_logo_container">
				<img src="Sources/img/logo.png" class="brand_logo" alt="Logo">
			</div>
		</div>
		<div class="d-flex justify-content-center form_container">
			<form method="POST" id="formLogin" onsubmit="return login()" autocomplete="off">
				<div class="input-group mb-3">
					<div class="input-group-append">
						<span class="input-group-text"><i class="fa fa-user"></i></span>
					</div>
					<input type="text" name="username" class="form-control input_user" placeholder="Usuario registrado" required>
				</div>
				<div class="input-group mb-2">
					<div class="input-group-append">
						<span class="input-group-text"><i class="fa fa-key"></i></span>
					</div>
					<input type="password" name="password" class="form-control input_pass" placeholder="Contraseña" required>
				</div>
				<div class="d-flex justify-content-center mt-3 login_container">
					<input type="submit" class="btn login_btn" value="Ingresar">
				</div>
			</form>
		</div>
		<div class="mt-4">
			<div class="d-flex justify-content-center">
				<span class="text-danger font-weight-bold">¿No recuerdas tu contraseña?</span>
			</div>
		</div>
	</div>
</div>

<?php  
include_once("Views/footer.php");
?>

<script type="text/javascript">
	function login(){
		$.ajax(
		{
			method: "POST",
			data: $("#formLogin").serialize(),
			url: "Sources/php/process/login.php",
			success: function (respuesta){
				if( respuesta ) window.location = "app.php";
				else swal("=(","Los datos introducidos son incorrectos","error");
				console.log(respuesta);
			}
		}
		);
		return false;
	}
</script>