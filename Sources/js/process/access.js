function del_access(){
	swal({
		title: "Estás seguro de eliminar el registro de ingresos?",
		text: "Una vez lo hagas no sabrás quien había ingresado al sistema!",
		icon: "warning",
		buttons: true,
		dangerMode: true,
	})
	.then((willDelete) => {
		if ( willDelete ) {
			$.ajax({
				method: "POST",
				data: "access-actions="+"delete",
				url: "Sources/php/process/access-actions.php",
				success: function (respuesta){
					if( respuesta ) {
						swal("=D","Registro de ingresos borrado exitosamente","success");
						$("#main").load("Views/tables/access.php");
					}

				}
			});
			return false;
		}
	});
}