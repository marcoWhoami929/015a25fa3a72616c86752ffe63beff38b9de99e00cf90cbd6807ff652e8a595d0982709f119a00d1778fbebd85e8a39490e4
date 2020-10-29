<?php

require_once "../controladores/clientes.controlador.php";
require_once "../modelos/clientes.modelo.php";

class AjaxUsuariosMayoreo{

  /*=============================================
  ACTIVAR USUARIOS
  =============================================*/	

  public $activarUsuario;
  public $activarId;

  public function ajaxActivarUsuario(){

  	$respuesta = ModeloUsuariosMayoreo::mdlActualizarUsuario("usuariosmayoreo", "verificacion", $this->activarUsuario, "id", $this->activarId);

  	echo $respuesta;

  }

}

/*=============================================
ACTIVAR CATEGORIA
=============================================*/

if(isset($_POST["activarUsuario"])){

	$activarUsuario = new AjaxUsuariosMayoreo();
	$activarUsuario -> activarUsuario = $_POST["activarUsuario"];
	$activarUsuario -> activarId = $_POST["activarId"];
	$activarUsuario -> ajaxActivarUsuario();

}