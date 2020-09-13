<div class="container" id="main">
	<h1 class="font-weight-bold text-center">Actualiza tus datos</h1><br>
	<div class="row justify-content-center">
		<div class="col col-md-5 user_card">
			<form method="POST" id="formPassword" onsubmit="return change_password()" autocomplete="off">
				<div class="input-group mb-3">
					<div class="input-group-append">
						<span class="input-group-text"><i class="fa fa-envelope"></i></span>
					</div>
					<input type="email" name="current_email" class="form-control input_user" placeholder="Correo actual" required>
				</div>
				<div class="input-group mb-3">
					<div class="input-group-append">
						<span class="input-group-text"><i class="fa fa-envelope"></i></span>
					</div>
					<input type="email" name="new_email" class="form-control input_user" placeholder="Correo nuevo" required>
				</div>
				<div class="input-group mb-3">
					<div class="input-group-append">
						<span class="input-group-text"><i class="fa fa-key"></i></span>
					</div>
					<input type="password" name="current_password" class="form-control input_user" placeholder="Contraseña actual" required>
				</div>
				<div class="input-group mb-3">
					<div class="input-group-append">
						<span class="input-group-text"><i class="fa fa-key"></i></span>
					</div>
					<input type="password" name="new_password" class="form-control input_user" placeholder="Nueva contraseña" required>
				</div>
				<input type="hidden" name="user-actions" value="change-password">
				<div class="d-flex justify-content-center mt-3 login_container">
					<input type="submit" value="Cambiar" class="btn login_btn">
				</div>
			</form>
		</div>
	</div>
</div>

<script type="text/javascript">
	$.getScript("Sources/js/process/info.js");
</script>