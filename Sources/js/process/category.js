function new_category(){
	$.ajax(
	{
		method: "POST",
		data: $("#formCategory").serialize(),
		url: "Sources/php/process/category-actions.php",
		success: function (respuesta){
			console.log(respuesta);
			respuesta = respuesta.trim();

			if( respuesta ){
				$("#formCategory")[0].reset();
					//$("#main").load("Views/tables/category.php");
					//swal("=D","Categoria agregada correctamente","success");
					swal({icon:"success"});
					location.reload();
				} 
				else swal("=O","No se pudo agregar la nueva categoria","error");
			}
		}
		);
	return false;
}

function del( id ){
	id = parseInt(id);

	if( id > 0 ){
		swal({
			title: "Estás seguro de eliminarla?",
			text: "Una vez lo hagas no podrás recuperar los archivos asociados!",
			icon: "warning",
			buttons: true,
			dangerMode: true,
		})
		.then((willDelete) => {
			if ( willDelete ) {
				$.ajax(
				{
					method: "POST",
					cache:false,
					data: {
						"id_for_del":id,
						"category-actions": "delete"
					},
					url: "Sources/php/process/category-actions.php",
					success: function(respuesta){
						respuesta = respuesta.trim();

						if( respuesta ){
							$("#main").load("Views/tables/category.php");
							swal("Listo, se eliminó la categoria seleccionada!", {icon: "success"});
						}
						else
							swal("Algo ocurrió!", {icon: "success"});
					}

				});
				return false;
			}
		});
	}
}