function support(){
	$.ajax({
		method: "POST",
		data: $("#formMail").serialize(),
		url: "Sources/php/process/user-actions.php",
		success: function (respuesta){
			if( respuesta ){
				swal("=D","Mensaje enviado correctamente","success");
				$("#main").load("Views/tables/support.php")
			}
			else
				swal("=(","No se pudo enviar el mensaje","error");
		}
	});
	return false;
}