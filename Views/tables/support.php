<div class="container" id="main">
	<h1 class="font-weight-bold text-center">Soporte de usuario</h1><br>
	<div class="row justify-content-center">
		<div class="col col-md-5 user_card">
			<form method="POST" id="formMail" onsubmit="return support()" autocomplete="off">
				<div class="input-group mb-3">
					<div class="input-group-append">
						<span class="input-group-text"><i class="fa fa-info"></i></span>
					</div>
					<input type="text" name="issue" class="form-control input_user" placeholder="Motivo para requerir soporte" required>
				</div>
				<div class="input-group mb-3">
					<div class="input-group-append">
						<span class="input-group-text">...</span>
					</div>
					<textarea class="form-control input_user" placeholder="Describe el motivo" name="message" rows="7" required></textarea>
				</div>
				<input type="hidden" name="user-actions" value="support">
				<div class="d-flex justify-content-center mt-3 login_container">
					<input type="submit" value="Enviar" class="btn login_btn">
				</div>
			</form>
		</div>
	</div>
</div>

<script type="text/javascript">
	$.getScript("Sources/js/process/support.js");
</script>