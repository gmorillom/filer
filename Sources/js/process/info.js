function change_password(){
	$.ajax({
		method: "POST",
		data: $("#formPassword").serialize(),
		url: "Sources/php/process/user-actions.php",
		success: function (respuesta){
			if( respuesta === "Cambios realizados correctamente" ){
				swal("=D",respuesta,"success");
				$("#main").load("Views/tables/info.php")
			}
			else
				swal("=(",respuesta,"error");
		}
	});

	return false;
}