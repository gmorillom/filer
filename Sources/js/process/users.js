function new_user(){
	$.ajax(
	{
		method: "POST",
		data: $("#formRegister").serialize(),
		url: "Sources/php/process/user-actions.php",
		success: function (respuesta){
			respuesta = respuesta.trim();
			//console.log(respuesta);
			if( respuesta ){
				$("#formRegister")[0].reset();
				swal({icon:"success"});
				location.reload();
					//$("#main").load("Views/tables/users.php");
					//swal(":D","Usuario agregado correctamente","success");
				} 
				else
					swal(":O","No se pudo agregar el usuario porque este ya existe","error");
			}
		}
		);
	return false;
}

function del_user(username){
	if( username !== "" ){
		
		swal({
			title: "Estás seguro de eliminarlo?",
			text: "Una vez lo hagas no podrá volver a ingresar!",
			icon: "warning",
			buttons: true,
			dangerMode: true,
		})
		.then((willDelete) => {
			if ( willDelete ) {
				$.ajax(
				{
					method: "POST",
					data: {
						"username_for_del":username,
						"user-actions":"delete"
					},
					url: "Sources/php/process/user-actions.php",
					success: function (respuesta){
						respuesta = respuesta.trim();

						if( respuesta ) {
							swal(":D","Usuario eliminado correctamente","success");
							$("#main").load("Views/tables/users.php");
						}
						else swal(":O","No se pudo eliminar al usuario","error");
					}
				});
				return false;
			}
		});
	}
}

function reset_pw(email){
	if( email !== "" ){
		$.ajax(
		{
			method: "POST",
			data: {
				"email_for_reset":email,
				"user-actions":"reset-password"
			},
			url: "Sources/php/process/user-actions.php",
			success: function (respuesta){
				respuesta = respuesta.trim();

				if( respuesta ) swal("=D","Contraseña cambiada correctamente","success");
				else swal("=O","Ocurrió un error","error");
			}
		}
		);
		return false;
	}
}