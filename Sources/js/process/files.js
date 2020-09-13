function upload(){
	var formData = new FormData(document.getElementById("formUpload"));

	$.ajax(
	{
		url: "Sources/php/process/file-actions.php",
		method: "POST",
		datatype: "html",
		data: formData,
		contentType:false,
		processData:false,
		success: function (respuesta){
			respuesta = respuesta.trim();
				//console.log(respuesta);
				
				if( respuesta ) {
					swal({icon:"success"});
					//$("#main").load("Views/tables/files.php");
					$("#formUpload")[0].reset();
					location.reload();
				}
				else swal("=(","NO SE PUEDE GUARDAR ESTE ARCHIVO EN EL SERVIDOR","error"); 
			}
		}
		);

	return false;
}

function delFile( id ){
	id = parseInt(id);

	if( id > 0 ){
		swal({
			title: "Estás seguro de eliminar este archivo?",
			text: "Una vez lo hagas no podrás descargarlo!",
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
						id: id,
						"file-actions": "delete"
					},
					url: "Sources/php/process/file-actions.php",
					success: function (respuesta){
						respuesta = respuesta.trim();
						//console.log(respuesta);

						if( respuesta ){
							swal("=D","ARCHIVO ELIMINADO CORRECTAMENTE","success");
							$("#main").load("Views/tables/files.php");
						}
						else swal("=(","OCURRIO UN ERROR AL INTENTAR ELIMINAR UN ARCHIVO","error");
					}
				}
				);
				return false;
			}
		});
	}
} 

function view( id ){
	$.ajax(
	{
		method: "POST",
		url: "Sources/php/process/file-actions.php",
		data: {
			"file-actions": "view",
			view_id:id
		},
		success: function (respuesta){
			respuesta = respuesta.trim();
			//console.log(respuesta);
			$("#views").html(respuesta);
		}
	}
	);
	return false;
}