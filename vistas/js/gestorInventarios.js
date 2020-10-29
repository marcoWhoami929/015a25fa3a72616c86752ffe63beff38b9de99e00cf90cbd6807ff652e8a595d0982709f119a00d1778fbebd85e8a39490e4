/*=============================================
CARGAR LA TABLA DINÁMICA DE INVENTARIOS
=============================================*/
/*
 $.ajax({

	url:"ajax/tablaProductos.ajax.php",
	success:function(respuesta){
		
		console.log("respuesta", respuesta);

 	}

})
*/
$('.tablaInventarios').DataTable({
	"ajax":"ajax/tablaInventarios.ajax.php",
	"deferRender": true,
	"retrieve": true,
	"processing": true,
    "language": {

			"sProcessing":     "Procesando...",
			"sLengthMenu":     "Mostrar _MENU_ registros",
			"sZeroRecords":    "No se encontraron resultados",
			"sEmptyTable":     "Ningún dato disponible en esta tabla",
			"sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_",
			"sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0",
			"sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
			"sInfoPostFix":    "",
			"sSearch":         "Buscar:",
			"sUrl":            "",
			"sInfoThousands":  ",",
			"sLoadingRecords": "Cargando...",
			"oPaginate": {
			"sFirst":    "Primero",
			"sLast":     "Último",
			"sNext":     "Siguiente",
			"sPrevious": "Anterior"
			},
			"oAria": {
				"sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
				"sSortDescending": ": Activar para ordenar la columna de manera descendente"
			}

	}

});

/*===============================================================
VALIDAR ENTRADAS
================================================================*/
$('.tablaInventarios tbody').on("click", ".btnAlertaStock", function(){
	  
   swal({
                      title: "No puede agregar stock porque está al límite",
                      type: "error",
                      confirmButtonText: "¡Cerrar!"
                    });
})



/*=============================================
ACTIVAR INVENTARIO
=============================================*/
$('.tablaInventarios').on("click", ".btnActivar", function(){

	var idProducto = $(this).attr("idProducto");
	var estadoProducto = $(this).attr("estadoProducto");

	var datos = new FormData();
 	datos.append("activarId", idProducto);
  	datos.append("activarProducto", estadoProducto);

  	$.ajax({

	  url:"ajax/inventarios.ajax.php",
	  method: "POST",
	  data: datos,
	  cache: false,
      contentType: false,
      processData: false,
      success: function(respuesta){    
          
          // console.log("respuesta", respuesta);

      }

  	})

	if(estadoProducto == 0){

  		$(this).removeClass('btn-success');
  		$(this).addClass('btn-danger');
  		$(this).html('Desactivado');
  		$(this).attr('estadoProducto',1);

  	}else{

  		$(this).addClass('btn-success');
  		$(this).removeClass('btn-danger');
  		$(this).html('Activado');
  		$(this).attr('estadoProducto',0);

  	}

})



/*=============================================
VALIDAR CAMPO STOCK
=============================================*/

$(".validarStock").change(function(){

	$(".alert").remove();

	var inventario = $(this).val();

	var datos = new FormData();
	datos.append("validarStock", inventario);

	 $.ajax({
	    url:"ajax/inventarios.ajax.php",
	    method:"POST",
	    data: datos,
	    cache: false,
	    contentType: false,
	    processData: false,
	    dataType: "json",
	    success:function(respuesta){

    		if(respuesta.length != 0){

    			$(".validarStock").parent().after('<div class="alert alert-warning">Ingrese una cantidad menor al stock máximo</div>');
    			$('#guardarCambiosInventario').attr("disabled", true);

	    		$(".validarStock").val("");

    		}

	    }

   	})

})

/*=============================================
RUTA PRODUCTO
=============================================*/

function limpiarUrl(texto){
  var texto = texto.toLowerCase(); 
  texto = texto.replace(/[á]/, 'a');
  texto = texto.replace(/[é]/, 'e');
  texto = texto.replace(/[í]/, 'i');
  texto = texto.replace(/[ó]/, 'o');
  texto = texto.replace(/[ú]/, 'u');
  texto = texto.replace(/[ñ]/, 'n');
  texto = texto.replace(/ /g, "-")
  return texto;
}

$(".tituloProducto").change(function(){

	$(".rutaProducto").val(limpiarUrl($(".tituloProducto").val()));

})

/*=============================================
AGREGAR MULTIMEDIA
=============================================*/

var tipo = null;

$(".seleccionarTipo").change(function(){

	tipo = $(this).val();

	if(tipo == "virtual"){

		$(".multimediaVirtual").show();
		$(".multimediaFisica").hide();

		$(".detallesVirtual").show();
		$(".detallesFisicos").hide();
	
	}else{

		$(".multimediaFisica").show();
		$(".multimediaVirtual").hide();
		
		$(".detallesFisicos").show();
		$(".detallesVirtual").hide();	

	}
})


/*=============================================
SELECCIONAR SUBCATEGORÍA
=============================================*/

$(".seleccionarCategoria").change(function(){

	var categoria = $(this).val();

	$(".seleccionarSubCategoria").html("");

	$("#modalEditarInventario .seleccionarSubCategoria").html("");

	var datos = new FormData();
	datos.append("idCategoria", categoria);

	 $.ajax({
	    url:"ajax/subCategorias.ajax.php",
	    method:"POST",
	    data: datos,
	    cache: false,
	    contentType: false,
	    processData: false,
	    dataType: "json",
	    success:function(respuesta){
	    	
	    	// console.log("respuesta", respuesta);

	    	$(".entradaSubcategoria").show();

	    	respuesta.forEach(funcionForEach);

	        function funcionForEach(item, index){

	        	$(".seleccionarSubCategoria").append(

    				'<option value="'+item["id"]+'">'+item["subcategoria"]+'</option>'

    			)

	        }

	    }

	})

})


/*=============================================
SUBIENDO LA FOTO DE PORTADA
=============================================*/

var imagenPortada = null;

$(".fotoPortada").change(function(){

	imagenPortada = this.files[0];
	
	/*=============================================
  	VALIDAMOS EL FORMATO DE LA IMAGEN SEA JPG O PNG
  	=============================================*/

  	if(imagenPortada["type"] != "image/jpeg" && imagenPortada["type"] != "image/png"){

  		$(".fotoPortada").val("");

  		 swal({
		      title: "Error al subir la imagen",
		      text: "¡La imagen debe estar en formato JPG o PNG!",
		      type: "error",
		      confirmButtonText: "¡Cerrar!"
		    });

  	}else if(imagenPortada["size"] > 2000000){

  		$(".fotoPortada").val("");

  		 swal({
		      title: "Error al subir la imagen",
		      text: "¡La imagen no debe pesar más de 2MB!",
		      type: "error",
		      confirmButtonText: "¡Cerrar!"
		    });

  	}else{

  		var datosImagen = new FileReader;
  		datosImagen.readAsDataURL(imagenPortada);

  		$(datosImagen).on("load", function(event){

  			var rutaImagen = event.target.result;

  			$(".previsualizarPortada").attr("src", rutaImagen);

  		})

  	}

})

/*=============================================
SUBIENDO LA FOTO PRINCIPAL
=============================================*/

var imagenFotoPrincipal = null;

$(".fotoPrincipal").change(function(){

	imagenFotoPrincipal = this.files[0];
	
	/*=============================================
  	VALIDAMOS EL FORMATO DE LA IMAGEN SEA JPG O PNG
  	=============================================*/

  	if(imagenFotoPrincipal["type"] != "image/jpeg" && imagenFotoPrincipal["type"] != "image/png"){

  		$(".fotoPrincipal").val("");

  		 swal({
		      title: "Error al subir la imagen",
		      text: "¡La imagen debe estar en formato JPG o PNG!",
		      type: "error",
		      confirmButtonText: "¡Cerrar!"
		    });

  	}else if(imagenFotoPrincipal["size"] > 2000000){

  		$(".fotoPrincipal").val("");

  		 swal({
		      title: "Error al subir la imagen",
		      text: "¡La imagen no debe pesar más de 2MB!",
		      type: "error",
		      confirmButtonText: "¡Cerrar!"
		    });

  	}else{

  		var datosImagen = new FileReader;
  		datosImagen.readAsDataURL(imagenFotoPrincipal);

  		$(datosImagen).on("load", function(event){

  			var rutaImagen = event.target.result;

  			$(".previsualizarPrincipal").attr("src", rutaImagen);

  		})

  	}

})

/*=============================================
ACTIVAR OFERTA
=============================================*/

function activarOferta(event){

	if(event == "oferta"){

		$(".datosOferta").show();
		$(".valorOferta").prop("required",true);
		$(".valorOferta").val("");


	}else{

		$(".datosOferta").hide();
		$(".valorOferta").prop("required",false);
		$(".valorOferta").val("");

	}
}


$(".selActivarOferta").change(function(){

	activarOferta($(this).val())

})

/*=============================================
VALOR OFERTA
=============================================*/

$("#modalCrearInventario .valorOferta").change(function(){

	if($(".precio").val()!= 0){

		if($(this).attr("tipo") == "oferta"){

			var descuento = 100 - (Number($(this).val())*100/Number($(".precio").val()));

			$(".precioOferta").prop("readonly",true);
			$(".descuentoOferta").prop("readonly",false);
			$(".descuentoOferta").val(Math.ceil(descuento));	

		}

		if($(this).attr("tipo") == "descuento"){

			var oferta = Number($(".precio").val())-(Number($(this).val())*Number($(".precio").val())/100);
			
			$(".descuentoOferta").prop("readonly",true);
			$(".precioOferta").prop("readonly",false);
			$(".precioOferta").val(oferta);

		}

	}else{

	 swal({
	      title: "Error al agregar la oferta",
	      text: "¡Primero agregue un precio al producto!",
	      type: "error",
	      confirmButtonText: "¡Cerrar!"
	    });

	 $(".precioOferta").val(0);
	 $(".descuentoOferta").val(0);

	 return;

	}

})

/*=============================================
SUBIENDO LA FOTO DE LA OFERTA
=============================================*/

var imagenOferta = null;

$(".fotoOferta").change(function(){

	imagenOferta = this.files[0];
	
	/*=============================================
  	VALIDAMOS EL FORMATO DE LA IMAGEN SEA JPG O PNG
  	=============================================*/

  	if(imagenOferta["type"] != "image/jpeg" && imagenOferta["type"] != "image/png"){

  		$(".fotoOferta").val("");

  		 swal({
		      title: "Error al subir la imagen",
		      text: "¡La imagen debe estar en formato JPG o PNG!",
		      type: "error",
		      confirmButtonText: "¡Cerrar!"
		    });

  	}else if(imagenOferta["size"] > 2000000){

  		$(".fotoOferta").val("");

  		 swal({
		      title: "Error al subir la imagen",
		      text: "¡La imagen no debe pesar más de 2MB!",
		      type: "error",
		      confirmButtonText: "¡Cerrar!"
		    });

  	}else{

  		var datosImagen = new FileReader;
  		datosImagen.readAsDataURL(imagenOferta);

  		$(datosImagen).on("load", function(event){

  			var rutaImagen = event.target.result;

  			$(".previsualizarOferta").attr("src", rutaImagen);

  		})

  	}
})

/*=============================================
CAMBIAR EL PRECIO
=============================================*/

$(".precio").change(function(){

	$(".precioOferta").val(0);
	$(".descuentoOferta").val(0);

})

/*=============================================
GUARDAR EL PRODUCTO
=============================================*/

var multimediaFisica = null;
var multimediaVirtual = null;	


$(".guardarInventario").click(function(){

	/*=============================================
	PREGUNTAMOS SI LOS CAMPOS OBLIGATORIOS ESTÁN LLENOS
	=============================================*/

	if($(".tituloProducto").val() != "" && 
	   $(".seleccionarTipo").val() != "" && 
	   $(".seleccionarCategoria").val() != "" &&
	   $(".seleccionarSubCategoria").val() != "" &&
	   $(".descripcionProducto").val() != "" &&
	   $(".pClavesProducto").val() != ""){

		/*=============================================
	   	PREGUNTAMOS SI VIENEN IMÁGENES PARA MULTIMEDIA O LINK DE YOUTUBE
	   	=============================================*/

	   	if(tipo != "virtual"){

	   		if(arrayFiles.length > 0 && $(".rutaProducto").val() != ""){

	   			var listaMultimedia = [];
	   			var finalFor = 0;

	   			for(var i = 0; i < arrayFiles.length; i++){

	   				var datosMultimedia = new FormData();
	   				datosMultimedia.append("file", arrayFiles[i]);
					datosMultimedia.append("ruta", $(".rutaProducto").val());

					$.ajax({
						url:"ajax/inventarios.ajax.php",
						method: "POST",
						data: datosMultimedia,
						cache: false,
						contentType: false,
						processData: false,
						success: function(respuesta){
							
							listaMultimedia.push({"foto" : respuesta.substr(3)})
							multimediaFisica = JSON.stringify(listaMultimedia);
							multimediaVirtual = null;

							if(multimediaFisica == null){

							 	swal({
							      title: "El campo de multimedia no debe estar vacío",
							      type: "error",
							      confirmButtonText: "¡Cerrar!"
							    });

							 	return;

							}

							if((finalFor + 1) == arrayFiles.length){

								agregarMiInventario(multimediaFisica); 
								finalFor = 0; 

							}

							finalFor++;

						}

					})

	   			}

	   		}

	   	}else{

	   		multimediaVirtual = $(".multimedia").val();
	   		multimediaFisica = null;

	   		if(multimediaVirtual == null){	

 			 swal({
			      title: "El campo de multimedia no debe estar vacío",
			      type: "error",
			      confirmButtonText: "¡Cerrar!"
			    });

 			  return;
			
			}	

			agregarMiInventario(multimediaVirtual); 	

	   	}	

	}else{

		 swal({
	      title: "Llenar todos los campos obligatorios",
	      type: "error",
	      confirmButtonText: "¡Cerrar!"
	    });

		return;
	}

})


function agregarMiInventario(imagen){

		/*=============================================
		ALMACENAMOS TODOS LOS CAMPOS DE PRODUCTO
		=============================================*/

		var tituloProducto = $(".tituloProducto").val();
		var rutaProducto = $(".rutaProducto").val();
		var seleccionarTipo = $(".seleccionarTipo").val();
	   	var seleccionarCategoria = $(".seleccionarCategoria").val();
	    var seleccionarSubCategoria = $(".seleccionarSubCategoria").val();
	    var descripcionProducto = $(".descripcionProducto").val();
	    var pClavesProducto = $(".pClavesProducto").val();
	    var precio = $(".precio").val();
	    var peso = $(".peso").val();
	    var entrega = $(".entrega").val();
	    var largo = $(".largo").val();
	    var ancho = $(".ancho").val();
	    var alto = $(".alto").val();
	    var stock = $(".stock").val();
	    var agregarStock = $(".agregarStock").val();
	    var stockMin = $(".stockMin").val();
	    var stockMax = $(".stockMax").val();
	    var selActivarOferta = $(".selActivarOferta").val();
	    var precioOferta = $(".precioOferta").val();
	    var descuentoOferta = $(".descuentoOferta").val();
	    var finOferta = $(".finOferta").val();

	    if(seleccionarTipo == "virtual"){

			var detalles = {"Clases": $(".detalleClases").val(),
		       				"Tiempo": $(".detalleTiempo").val(),
		       				"Nivel": $(".detalleNivel").val(),
		       				"Acceso": $(".detalleAcceso").val(),
		       				"Dispositivo": $(".detalleDispositivo").val(),
		   					"Certificado": $(".detalleCertificado").val()};
		}else{

			var detalles = {"Unidad": $(".detalleUnidad").tagsinput('items'),
			       			"Codigo": $(".detalleCodigo").tagsinput('items'),
			       			"Marca": $(".detalleMarca").tagsinput('items')};

		}

		var detallesString = JSON.stringify(detalles);

	 	var datosInventario = new FormData();
		datosInventario.append("tituloProducto", tituloProducto);
		datosInventario.append("rutaProducto", rutaProducto);
		datosInventario.append("seleccionarTipo", seleccionarTipo);	
		datosInventario.append("detalles", detallesString);	
		datosInventario.append("seleccionarCategoria", seleccionarCategoria);
		datosInventario.append("seleccionarSubCategoria", seleccionarSubCategoria);
		datosInventario.append("descripcionProducto", descripcionProducto);
		datosInventario.append("pClavesProducto", pClavesProducto);
		datosInventario.append("precio", precio);
		datosInventario.append("peso", peso);
		datosInventario.append("entrega", entrega);
		datosInventario.append("largo", largo);
		datosInventario.append("ancho", ancho);
		datosInventario.append("alto", alto);
		datosInventario.append("stock", stock);
		datosInventario.append("agregarStock", agregarStock);
		datosInventario.append("stockMin", stockMin);
		datosInventario.append("stockMax", stockMax);
		datosInventario.append("multimedia", imagen);
		datosInventario.append("fotoPortada", imagenPortada);
		datosInventario.append("fotoPrincipal", imagenFotoPrincipal);
		datosInventario.append("selActivarOferta", selActivarOferta);
		datosInventario.append("precioOferta", precioOferta);
		datosInventario.append("descuentoOferta", descuentoOferta);
		datosInventario.append("finOferta", finOferta);
		datosInventario.append("fotoOferta", imagenOferta);

		$.ajax({
				url:"ajax/inventarios.ajax.php",
				method: "POST",
				data: datosInventario,
				cache: false,
				contentType: false,
				processData: false,
				success: function(respuesta){
					
					// console.log("respuesta", respuesta);

					if(respuesta == "ok"){

						swal({
						  type: "success",
						  title: "El producto ha sido guardado correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "inventario";

							}
						})
					}

				}

		})


}

/*=============================================
EDITAR PRODUCTO
=============================================*/

$('.tablaInventarios tbody').on("click", ".btnEditarInventario", function(){
	
	$(".previsualizarImgFisico").html("");

	var idProducto = $(this).attr("idProducto");
	
	var datos = new FormData();
	datos.append("idProducto", idProducto);

	$.ajax({

		url:"ajax/inventarios.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta){
			
			$("#modalEditarInventario .idProducto").val(respuesta[0]["id"]);
			$("#modalEditarInventario .tituloProducto").val(respuesta[0]["titulo"]);
			$("#modalEditarInventario .rutaProducto").val(respuesta[0]["ruta"]);

			/*=============================================
			TRAER EL TIPO DE PRODUCTO
			=============================================*/

			$("#modalEditarInventario .seleccionarTipo").val(respuesta[0]["tipo"]);

			/*=============================================
			CUANDO EL PRODUCTO ES VIRTUAL
			=============================================*/

			if(respuesta[0]["tipo"] == "virtual"){
		
				$(".multimediaVirtual").show();
				$(".multimediaFisica").hide();

				$("#modalEditarInventario .multimedia").val(respuesta[0]["multimedia"]);

				$(".detallesVirtual").show();
				$(".detallesFisicos").hide();

				var detalles = JSON.parse(respuesta[0]["detalles"]);
				
				$("#modalEditarInventario .detalleClases").val(detalles.Clases);
				$("#modalEditarInventario .detalleTiempo").val(detalles.Tiempo);
				$("#modalEditarInventario .detalleNivel").val(detalles.Nivel);
				$("#modalEditarInventario .detalleAcceso").val(detalles.Acceso);
				$("#modalEditarInventario .detalleDispositivo").val(detalles.Dispositivo);
				$("#modalEditarInventario .detalleCertificado").val(detalles.Certificado);

			/*=============================================
			CUANDO EL PRODUCTO ES FÍSICO
			=============================================*/
			
			}else{

				$(".multimediaVirtual").hide();
				$(".multimediaFisica").show();

				if(respuesta[0]["multimedia"] != ""){

					var imagenesMultimedia = JSON.parse(respuesta[0]["multimedia"]);
					
					for(var i = 0; i < imagenesMultimedia.length; i++){

						$(".previsualizarImgFisico").append(

							  '<div class="col-md-3">'+
							    '<div class="thumbnail text-center">'+
							      '<img class="imagenesRestantes" src="'+imagenesMultimedia[i].foto+'" style="width:100%">'+
							      '<div class="removerImagen" style="cursor:pointer">Remove file</div>'+
							    '</div>'+

							  '</div>'

		                );

		                localStorage.setItem("multimediaFisica", JSON.stringify(imagenesMultimedia));

					}		

					/*=============================================
					CUANDO ELIMINAMOS UNA IMAGEN DE LA LISTA
					=============================================*/

				 	$(".removerImagen").click(function(){

						$(this).parent().parent().remove();

						var imagenesRestantes = $(".imagenesRestantes");
						var arrayImgRestantes = [];

						for(var i = 0; i < imagenesRestantes.length; i++){

							arrayImgRestantes.push({"foto":$(imagenesRestantes[i]).attr("src")})
							
						}

						localStorage.setItem("multimediaFisica", JSON.stringify(arrayImgRestantes));
						
					})

				}

				$(".detallesVirtual").hide();
				$(".detallesFisicos").show();

				var detalles = JSON.parse(respuesta[0]["detalles"]);

				$(".editarUnidad").html(

					'<input class="form-control input-lg tagsInput detalleUnidad" value="'+detalles.Unidad+'" data-role="tagsinput" type="text" style="padding:20px">'

				)

				$("#modalEditarInventario .detalleUnidad").tagsinput('items');

				$(".editarCodigo").html(

					'<input class="form-control input-lg tagsInput detalleCodigo" value="'+detalles.Codigo+'" data-role="tagsinput" type="text" style="padding:20px">'

				)

				$("#modalEditarInventario .detalleCodigo").tagsinput('items');

				$(".editarMarca").html(

					'<input class="form-control input-lg tagsInput detalleMarca" value="'+detalles.Marca+'" data-role="tagsinput" type="text" style="padding:20px">'

				)

				$("#modalEditarInventario .detalleMarca").tagsinput('items');
				
				$(".bootstrap-tagsinput").css({"padding":"12px",
											   "width":"110%"})
			
			}

			/*=============================================
			TRAEMOS LA CATEGORIA
			=============================================*/

			if(respuesta[0]["id_categoria"] != 0){
			
				var datosCategoria = new FormData();
				datosCategoria.append("idCategoria", respuesta[0]["id_categoria"]);
				

				$.ajax({

						url:"ajax/categorias.ajax.php",
						method: "POST",
						data: datosCategoria,
						cache: false,
						contentType: false,
						processData: false,
						dataType: "json",
						success: function(respuesta){

							$("#modalEditarInventario .seleccionarCategoria").val(respuesta["id"]);
							$("#modalEditarInventario .optionEditarCategoria").html(respuesta["categoria"]);

							
						}

					})

			}else{

				
				$("#modalEditarInventario .optionEditarCategoria").html("SIN CATEGORÍA");

			}

			/*=============================================
			TRAEMOS LA SUBCATEGORIA
			=============================================*/

			if(respuesta[0]["id_subcategoria"] != 0){
					
				var datosSubCategoria = new FormData();
				datosSubCategoria.append("idSubCategoria", respuesta[0]["id_subcategoria"]);

				$.ajax({

						url:"ajax/subCategorias.ajax.php",
						method: "POST",
						data: datosSubCategoria,
						cache: false,
						contentType: false,
						processData: false,
						dataType: "json",
						success: function(respuesta){

							$("#modalEditarInventario .optionEditarSubCategoria").val(respuesta[0]["id"]);
							$("#modalEditarInventario .optionEditarSubCategoria").html(respuesta[0]["subcategoria"]);

							var datosCategoria = new FormData();
							datosCategoria.append("idCategoria", respuesta[0]["id_categoria"]);	

							$.ajax({

								url:"ajax/subCategorias.ajax.php",
								method: "POST",
								data: datosCategoria,
								cache: false,
								contentType: false,
								processData: false,
								dataType: "json",
								success: function(respuesta){

									respuesta.forEach(funcionForEach);

							        function funcionForEach(item, index){

						    			$("#modalEditarInventario .seleccionarSubCategoria").append(

						    				'<option value="'+item["id"]+'">'+item["subcategoria"]+'</option>'

						    			)

						    		}

								}

							})												

						}

					})

			}else{
				
				$("#modalEditarInventario  .optionEditarSubCategoria").html("SIN CATEGORÍA");

			}

			/*=============================================
			TRAEMOS DATOS DE CABECERA
			=============================================*/

			var datosCabecera = new FormData();
			datosCabecera.append("ruta", respuesta[0]["ruta"]);

			$.ajax({

					url:"ajax/cabeceras.ajax.php",
					method: "POST",
					data: datosCabecera,
					cache: false,
					contentType: false,
					processData: false,
					dataType: "json",
					success: function(respuesta){

						/*=============================================
						CARGAMOS EL ID DE LA CABECERA
						=============================================*/

						$("#modalEditarInventario .idCabecera").val(respuesta["id"]);

						/*=============================================
						CARGAMOS LA DESCRIPCION
						=============================================*/

						$("#modalEditarInventario .descripcionProducto").val(respuesta["descripcion"]);

						/*=============================================
						CARGAMOS LAS PALABRAS CLAVES
						=============================================*/	
						
						if(respuesta["palabrasClaves"] != null){

							$("#modalEditarInventario .editarPalabrasClaves").html('<div class="input-group">'+
	              
	                		'<span class="input-group-addon"><i class="fa fa-key"></i></span>'+ 

							'<input type="text" class="form-control input-lg tagsInput pClavesProducto" value="'+respuesta["palabrasClaves"]+'" data-role="tagsinput">'+
							

							'</div>');

							$("#modalEditarInventario .pClavesProducto").tagsinput('items');

						}else{

							$("#modalEditarInventario .editarPalabrasClaves").html('<div class="input-group">'+
	              
	                		'<span class="input-group-addon"><i class="fa fa-key"></i></span>'+ 

							'<input type="text" class="form-control input-lg tagsInput pClavesProducto" value="" data-role="tagsinput">'+

							'</div>');

							$("#modalEditarInventario .pClavesProducto").tagsinput('items');

						}

						/*=============================================
						CARGAMOS LA IMAGEN DE PORTADA
						=============================================*/

						$("#modalEditarInventario .previsualizarPortada").attr("src", respuesta["portada"]);
						$("#modalEditarInventario .antiguaFotoPortada").val(respuesta["portada"]);
					
					}
					
			});

			/*=============================================
			CARGAMOS LA IMAGEN PRINCIPAL
			=============================================*/

			$("#modalEditarInventario .previsualizarPrincipal").attr("src", respuesta[0]["portada"]);
			$("#modalEditarInventario .antiguaFotoPrincipal").val(respuesta[0]["portada"]);

			/*=============================================
			CARGAMOS EL PRECIO, PESO Y DIAS DE ENTREGA
			=============================================*/
			$("#modalEditarInventario .precio").val(respuesta[0]["precio"]);
			$("#modalEditarInventario .peso").val(respuesta[0]["peso"]);
			$("#modalEditarInventario .entrega").val(respuesta[0]["entrega"]);
			$("#modalEditarInventario .largo").val(respuesta[0]["largo"]);
			$("#modalEditarInventario .ancho").val(respuesta[0]["ancho"]);
			$("#modalEditarInventario .alto").val(respuesta[0]["alto"]);
			$("#modalEditarInventario .stock").val(respuesta[0]["stock"]);
			$("#modalEditarInventario .agregarStock").val(respuesta[0]["agregarStock"]);
			$("#modalEditarInventario .stockMin").val(respuesta[0]["stockMin"]);
			$("#modalEditarInventario .stockMax").val(respuesta[0]["stockMax"]);

			/*=============================================
			PREGUNTAMOS SI EXITE OFERTA
			=============================================*/

			if(respuesta[0]["oferta"] != 0){

				$("#modalEditarInventario .selActivarOferta").val("oferta");

				$("#modalEditarInventario .datosOferta").show();
				$("#modalEditarInventario .valorOferta").prop("required",true);

				$("#modalEditarInventario .precioOferta").val(respuesta[0]["precioOferta"]);
				$("#modalEditarInventario .descuentoOferta").val(respuesta[0]["descuentoOferta"]);

				if(respuesta[0]["precioOferta"] != 0){

					$("#modalEditarInventario .precioOferta").prop("readonly",true);
					$("#modalEditarInventario .descuentoOferta").prop("readonly",false);

				}

				if(respuesta[0]["descuentoOferta"] != 0){

					$("#modalEditarInventario .descuentoOferta").prop("readonly",true);
					$("#modalEditarInventario .precioOferta").prop("readonly",false);

				}
	
				$("#modalEditarInventario .previsualizarOferta").attr("src", respuesta[0]["imgOferta"]);

				$("#modalEditarInventario .antiguaFotoOferta").val(respuesta[0]["imgOferta"]);
				
				$("#modalEditarInventario .finOferta").val(respuesta[0]["finOferta"]);						

			}else{

				$("#modalEditarInventario .selActivarOferta").val("");
				$("#modalEditarInventario .datosOferta").hide();
				$("#modalEditarInventario .valorOferta").prop("required",false);
				$("#modalEditarInventario .previsualizarOferta").attr("src", "vistas/img/ofertas/default/default.jpg");
				$("#modalEditarInventario .antiguaFotoOferta").val(respuesta[0]["imgOferta"]);

			}

			/*=============================================
			CREAR NUEVA OFERTA AL EDITAR
			=============================================*/

			$("#modalEditarInventario .selActivarOferta").change(function(){

				activarOferta($(this).val())

			})

			$("#modalEditarInventario .valorOferta").change(function(){

				if($(this).attr("tipo") == "oferta"){

					var descuento = 100-(Number($(this).val())*100/Number($("#modalEditarInventario .precio").val()));

					$("#modalEditarInventario .precioOferta").prop("readonly",true);
					$("#modalEditarInventario .descuentoOferta").prop("readonly",false);
					$("#modalEditarInventario .descuentoOferta").val(Math.ceil(descuento));

				}

				if($(this).attr("tipo") == "descuento"){

					var oferta = Number($("#modalEditarInventario .precio").val())-(Number($(this).val())*Number($("#modalEditarInventario .precio").val())/100);	

					$("#modalEditarInventario .descuentoOferta").prop("readonly",true);
					$("#modalEditarInventario .precioOferta").prop("readonly",false);
					$("#modalEditarInventario .precioOferta").val(oferta);

				}

			})

			/*=============================================
			GUARDAR CAMBIOS DEL PRODUCTO
			=============================================*/	

			var multimediaFisica = null;
			var multimediaVirtual = null;

			$(".guardarCambiosInventario").click(function(){
			
					/*=============================================
					PREGUNTAMOS SI LOS CAMPOS OBLIGATORIOS ESTÁN LLENOS
					=============================================*/

					if($("#modalEditarInventario .tituloProducto").val() != "" && 
					   $("#modalEditarInventario .seleccionarTipo").val() != "" && 
					   $("#modalEditarInventario .seleccionarCategoria").val() != "" &&
					   $("#modalEditarInventario .seleccionarSubCategoria").val() != "" &&
					   $("#modalEditarInventario .descripcionProducto").val() != "" &&
					   $("#modalEditarInventario .pClavesProducto").val() != ""){

						/*=============================================
					   	PREGUNTAMOS SI VIENEN IMÁGENES PARA MULTIMEDIA O LINK DE YOUTUBE
					   	=============================================*/

					   	if(tipo != "virtual"){

						   	if(arrayFiles.length > 0 && $("#modalEditarInventario .rutaProducto").val() != ""){

						   		var listaMultimedia = [];
						   		var finalFor = 0;

								for(var i = 0; i < arrayFiles.length; i++){
									
									var datosMultimedia = new FormData();
									datosMultimedia.append("file", arrayFiles[i]);
									datosMultimedia.append("ruta", $("#modalEditarInventario .rutaProducto").val());

									$.ajax({
										url:"ajax/inventarios.ajax.php",
										method: "POST",
										data: datosMultimedia,
										cache: false,
										contentType: false,
										processData: false,
										success: function(respuesta){

											listaMultimedia.push({"foto" : respuesta.substr(3)});
											multimediaFisica = JSON.stringify(listaMultimedia);
											
											if(localStorage.getItem("multimediaFisica") != null){

												var jsonLocalStorage = JSON.parse(localStorage.getItem("multimediaFisica"));

												var jsonMultimediaFisica = listaMultimedia.concat(jsonLocalStorage);

												multimediaFisica = JSON.stringify(jsonMultimediaFisica);												
											}
																			
											multimediaVirtual = null;

											if(multimediaFisica == null){

												 swal({
												      title: "El campo de multimedia no debe estar vacío",
												      type: "error",
												      confirmButtonText: "¡Cerrar!"
												    });

												 return;
											}

											if((finalFor + 1) == arrayFiles.length){

												editarMiInventario(multimediaFisica); 
												finalFor = 0; 

											}

											finalFor++;							
												
										}

									})

								}

							}else{
								var jsonLocalStorage = JSON.parse(localStorage.getItem("multimediaFisica"));
								multimediaFisica = JSON.stringify(jsonLocalStorage);
								editarMiInventario(multimediaFisica);
							}

						}else{

							multimediaVirtual = $("#modalEditarInventario .multimedia").val();
							multimediaFisica = null;

							if(multimediaVirtual == null){

					 			 swal({
								      title: "El campo de multimedia no debe estar vacío",
								      type: "error",
								      confirmButtonText: "¡Cerrar!"
								    });

					 			  return;
							}

							editarMiInventario(multimediaVirtual); 			
							
						}

					}else{

						 swal({
					      title: "Llenar todos los campos obligatorios",
					      type: "error",
					      confirmButtonText: "¡Cerrar!"
					    });

						return;

					}

			})

			function editarMiInventario(imagen){


				var idProducto = $("#modalEditarInventario .idProducto").val();
				var tituloProducto = $("#modalEditarInventario .tituloProducto").val();
				var rutaProducto = $("#modalEditarInventario .rutaProducto").val();
				var seleccionarTipo = $("#modalEditarInventario .seleccionarTipo").val();
					var seleccionarCategoria = $("#modalEditarInventario .seleccionarCategoria").val();
				var seleccionarSubCategoria = $("#modalEditarInventario .seleccionarSubCategoria").val();
				var descripcionProducto = $("#modalEditarInventario .descripcionProducto").val();
				var pClavesProducto = $("#modalEditarInventario .pClavesProducto").val();
				var precio = $("#modalEditarInventario .precio").val();
				var peso = $("#modalEditarInventario .peso").val();
				var entrega = $("#modalEditarInventario .entrega").val();
				var largo = $("#modalEditarInventario .largo").val();
				var ancho = $("#modalEditarInventario .ancho").val();
				var alto = $("#modalEditarInventario .alto").val();
				var stock = $("#modalEditarInventario .stock").val();
				var agregarStock = $("#modalEditarInventario .agregarStock").val();
				var stockMin = $("#modalEditarInventario .stockMin").val();
				var stockMax = $("#modalEditarInventario .stockMax").val();
				var selActivarOferta = $("#modalEditarInventario .selActivarOferta").val();
				var precioOferta = $("#modalEditarInventario .precioOferta").val();
				var descuentoOferta = $("#modalEditarInventario .descuentoOferta").val();
				var finOferta = $("#modalEditarInventario .finOferta").val();

			  	if(seleccionarTipo == "virtual"){

					var detalles = {"Clases": $("#modalEditarInventario .detalleClases").val(),
				       				"Tiempo": $("#modalEditarInventario .detalleTiempo").val(),
				       				"Nivel": $("#modalEditarInventario .detalleNivel").val(),
				       				"Acceso": $("#modalEditarInventario .detalleAcceso").val(),
				       				"Dispositivo": $("#modalEditarInventario .detalleDispositivo").val(),
				   					"Certificado": $("#modalEditarInventario .detalleCertificado").val()};
				}else{

					var detalles = {"Unidad": $("#modalEditarInventario .detalleUnidad").tagsinput('items'),							
					       			"Codigo": $("#modalEditarInventario .detalleCodigo").tagsinput('items'),
					       			"Marca": $("#modalEditarInventario .detalleMarca").tagsinput('items')};

				}

				var detallesString = JSON.stringify(detalles);

				
				var antiguaFotoPortada = $("#modalEditarInventario .antiguaFotoPortada").val();
				var antiguaFotoPrincipal = $("#modalEditarInventario .antiguaFotoPrincipal").val();
				var antiguaFotoOferta = $("#modalEditarInventario .antiguaFotoOferta").val();
				var idCabecera = $("#modalEditarInventario .idCabecera").val();


				var datosInventario = new FormData();
				datosInventario.append("id", idProducto);
				datosInventario.append("editarInventario", tituloProducto);
				datosInventario.append("rutaProducto", rutaProducto);
				datosInventario.append("seleccionarTipo", seleccionarTipo);	
				datosInventario.append("detalles", detallesString);	
				datosInventario.append("seleccionarCategoria", seleccionarCategoria);
				datosInventario.append("seleccionarSubCategoria", seleccionarSubCategoria);
				datosInventario.append("descripcionProducto", descripcionProducto);
				datosInventario.append("pClavesProducto", pClavesProducto);
				datosInventario.append("precio", precio);
				datosInventario.append("peso", peso);
				datosInventario.append("entrega", entrega);
				datosInventario.append("largo", largo);
				datosInventario.append("ancho", ancho);
				datosInventario.append("alto", alto);
				datosInventario.append("stock", stock);
				datosInventario.append("agregarStock", agregarStock);
				datosInventario.append("stockMin", stockMin);
				datosInventario.append("stockMax", stockMax);

				if(multimediaFisica == null && multimediaVirtual == null){

					multimediaFisica = localStorage.getItem("multimediaFisica");
					datosInventario.append("multimedia", multimediaFisica);


				}else{

					datosInventario.append("multimedia", imagen);
				}	

				datosInventario.append("fotoPortada", imagenPortada);
				datosInventario.append("fotoPrincipal", imagenFotoPrincipal);
				datosInventario.append("selActivarOferta", selActivarOferta);
				datosInventario.append("precioOferta", precioOferta);
				datosInventario.append("descuentoOferta", descuentoOferta);
				datosInventario.append("finOferta", finOferta);
				datosInventario.append("fotoOferta", imagenOferta);
				datosInventario.append("antiguaFotoPortada", antiguaFotoPortada);
				datosInventario.append("antiguaFotoPrincipal", antiguaFotoPrincipal);
				datosInventario.append("antiguaFotoOferta", antiguaFotoOferta);
				datosInventario.append("idCabecera", idCabecera);

				$.ajax({
						url:"ajax/inventarios.ajax.php",
						method: "POST",
						data: datosInventario,
						cache: false,
						contentType: false,
						processData: false,
						success: function(respuesta){
												
							
							if(respuesta == "okokok"){

								swal({
								  type: "success",
								  title: "El stock ha sido actualizado",
								  showConfirmButton: true,
								  confirmButtonText: "Cerrar"
								  }).then(function(result){
									if (result.value) {

									localStorage.removeItem("multimediaFisica");
									localStorage.clear();
									window.location = "inventario";

									}
								})
							}

						}

				})


			}
					
		}

	})

})




