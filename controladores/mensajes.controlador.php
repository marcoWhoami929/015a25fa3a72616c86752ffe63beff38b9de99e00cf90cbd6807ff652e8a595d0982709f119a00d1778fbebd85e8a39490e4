<?php

class ControladorComentarios{

	/*=============================================
	MOSTRAR COMENTARIOS
	=============================================*/

	static public function ctrMostrarComentarios($tabla){

		$tabla = "comentarios";

		$respuesta = ModeloComentarios::mdlMostrarComentarios($tabla);

		return $respuesta;

	}
	/*=============================================
	ELIMINAR COMENTARIO
	=============================================*/

	public function ctrEliminarComentario(){

		if(isset($_GET["idComentario"])){
		
			$tabla = "comentarios";

			$id = $_GET["idComentario"];

			$respuesta = ModeloComentarios::mdlEliminarComentario($tabla, $id);
			if($respuesta == "ok"){

				echo'<script>

				swal({
					  type: "success",
					  title: "El comentario ha sido borrado correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar"
					  }).then(function(result){
								if (result.value) {

								window.location = "comentarios";

								}
							})

				</script>';

			}		
		

		}

	}
}