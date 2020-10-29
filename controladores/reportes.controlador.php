<?php

require __DIR__ . '/../extensiones/vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class ControladorReportes{

	/*=============================================
	DESCARGAR REPORTE EN EXCEL
	=============================================*/

	public function ctrDescargarReporte(){

		if(isset($_GET["reporte"])){

			$tabla = $_GET["reporte"];

			$reporte = ModeloReportes::mdlDescargarReporte($tabla);

			/*=============================================
			CREAMOS EL ARCHIVO DE EXCEL
			=============================================*/

			$nombre = $_GET["reporte"].'.xls';

			header('Expires: 0');
			header('Cache-control: private');
			header('Content-type: application/vnd.ms-excel');// Archivo de Excel
			header("Cache-Control: cache, must-revalidate"); 
			header('Content-Description: File Transfer');
			header('Last-Modified: '.date('D, d M Y H:i:s'));
			header("Pragma: public"); 
			header('Content-Disposition:; filename="'.$nombre.'"');
			header("Content-Transfer-Encoding: binary");

			/*=============================================
			REPORTE DE COMPRAS Y VENTAS
			=============================================*/

			if($_GET["reporte"] == "compras"){	

				echo utf8_decode("

					<table style='border:1px solid black;'> 

						
						<tr> 
							<td style='font-weight:bold; border:1px solid;  background:#000000; color:white;'></td>
							<td style='font-weight:bold; border:1px solid;  background:#000000; color:white;'></td>
							<td style='font-weight:bold; border:1px solid;  background:#000000; color:white;'></td>
							<td style='font-weight:bold; border:1px solid;  background:#000000; color:white;'></td>
							<td style='font-weight:bold; border:1px solid;  background:#000000; color:white;'></td>
							<td style='font-weight:bold; border:1px solid;  background:#000000; color:white;'></td>
							<td style='font-weight:bold; border:1px solid;  background:#000000; color:white;'></td>
							<td style='font-weight:bold; border:1px solid;  background:#000000; color:white;'></td>
							<td style='font-weight:bold; border:1px solid;  background:#000000; color:white;'></td>
							<td style='font-weight:bold; border:1px solid;  background:#000000; color:white;'></td>
							
									

						</tr>
						<tr> 
							<td style='font-weight:bold; border:1px solid;  background:#000000; color:white;'></td>
							<td style='font-weight:bold; border:1px solid;  background:#000000; color:white;'></td>
							<td style='font-weight:bold; border:1px solid;  background:#000000; color:white;'></td>
							<td style='font-weight:bold; border:1px solid;  background:#000000; color:white;'></td>
							<td style='font-weight:bold; border:1px solid;  background:#000000; color:white; font-size:20px'> REPORTE DE VENTAS</td>
							<td style='font-weight:bold; border:1px solid;  background:#000000; color:white;'></td>
							<td style='font-weight:bold; border:1px solid;  background:#000000; color:white;'></td>
							<td style='font-weight:bold; border:1px solid;  background:#000000; color:white;'></td>
							<td style='font-weight:bold; border:1px solid;  background:#000000; color:white;'></td>
							<td style='font-weight:bold; border:1px solid;  background:#000000; color:white;'></td>
							
									

						</tr>
						<tr> 
							<td style='font-weight:bold; border:1px solid;  background:#000000; color:white;'></td>
							<td style='font-weight:bold; border:1px solid;  background:#000000; color:white;'></td>
							<td style='font-weight:bold; border:1px solid;  background:#000000; color:white;'></td>
							<td style='font-weight:bold; border:1px solid;  background:#000000; color:white;'></td>
							<td style='font-weight:bold; border:1px solid;  background:#000000; color:white;'></td>
							<td style='font-weight:bold; border:1px solid;  background:#000000; color:white;'></td>
							<td style='font-weight:bold; border:1px solid;  background:#000000; color:white;'></td>
							<td style='font-weight:bold; border:1px solid;  background:#000000; color:white;'></td>
							<td style='font-weight:bold; border:1px solid;  background:#000000; color:white;'></td>
							<td style='font-weight:bold; border:1px solid;  background:#000000; color:white;'></td>
							
									

						</tr>
						<tr> 
							<td style='font-weight:bold; background:#000000; color:white;'>PRODUCTO</td>
							<td style='font-weight:bold; background:#000000; color:white;'>CLIENTE</td>
							<td style='font-weight:bold; background:#000000; color:white;'>VENTA</td>
							<td style='font-weight:bold; background:#000000; color:white;'>TIPO</td>
							<td style='font-weight:bold; background:#000000; color:white;'>PROCESO DE ENVÍO</td>
							<td style='font-weight:bold; background:#000000; color:white;'>MÉTODO</td>
							<td style='font-weight:bold; background:#000000; color:white;'>EMAIL</td>		
							<td style='font-weight:bold; background:#000000; color:white;'>DIRECCIÓN</td>		
							<td style='font-weight:bold; background:#000000; color:white;'>PAÍS</td	
							<td style='font-weight:bold; background:#000000; color:white;'>FECHA</td>		

						</tr>");

				foreach ($reporte as $key => $value) {

					/*=============================================
					TRAER PRODUCTO
					=============================================*/
					$item = "id";
					$valor = $value["id_producto"];

					$traerProducto = ControladorProductos::ctrMostrarProductos($item, $valor);

					/*=============================================
					TRAER CLIENTE
					=============================================*/

					$item2 = "id";
					$valor2 = $value["id_usuario"];

					$traerCliente = ControladorUsuarios::ctrMostrarUsuarios($item2, $valor2);

					 echo utf8_decode("

					 	<tr>
							<td style='border:1px solid black; background:transparent; color:black;'>".$traerProducto[0]["titulo"]."</td>
							<td style='border:1px solid black; background:transparent; color:black;'>".$traerCliente["nombre"]."</td>
							<td style='border:1px solid black; background:transparent; color:black;'>$ ".number_format($value["pago"],2)."</td>
							<td style='border:1px solid black; background:transparent; color:black;'>".$traerProducto[0]["tipo"]."</td>
							<td style='border:1px solid black; background:transparent; color:black;'>

					 ");

				 	/*=============================================
					TRAER PROCESO DE ENVÍO
					=============================================*/

					if($value["envio"] == 0 && $traerProducto[0]["tipo"] == "virtual"){

						$envio = "Entrega inmediata";
					
					}else if($value["envio"] == 0 && $traerProducto[0]["tipo"] == "fisico"){

						$envio ="Preparando Pedido";

					}else if($value["envio"] == 1 && $traerProducto[0]["tipo"] == "fisico"){

						$envio = "Enviando el producto";

					}else{

						$envio = "Producto entregado";

					}

					 echo utf8_decode($envio."</td>
									<td style='border:2px solid black; background:transparent; color:black;'>".$value["metodo"]."</td>
									<td style='border:2px solid black; background:transparent; color:black;'>
					 ");

				  /*=============================================
					TRAER EMAIL CLIENTE
					=============================================*/

					if($value["email"] == ""){

						$email = $traerCliente["email"];

					}else{

						$email = $value["email"];
					
					}

					echo utf8_decode($email."</td>
			 					  	 <td style='border:2px solid black; background:transparent; color:black;'>".$value["direccion"]."</td>
			 					  	 <td style='border:2px solid black; background:transparent; color:black;'>".$value["pais"]."</td>
			 					  	 <td style='border:2px solid black; background:transparent; color:black;'>".$value["fecha"]."</td>
			 					  	 </tr>"); 		

				}


				echo utf8_decode("</table>

					");

			}

			/*============================================
			REPORTE DE INVENTARIOS
			============================================*/
				if($_GET["reporte"] == "productos"){	

				echo utf8_decode("

					<table style='border:1px solid black;'> 

						
						<tr> 
							<td style='font-weight:bold; border:1px solid;  background:#000000; color:white;'></td>
							<td style='font-weight:bold; border:1px solid;  background:#000000; color:white;'></td>
							<td style='font-weight:bold; border:1px solid;  background:#000000; color:white;font-size:20px'>REPORTE DE INVENTARIO</td>
							<td style='font-weight:bold; border:1px solid;  background:#000000; color:white;'></td>
							<td style='font-weight:bold; border:1px solid;  background:#000000; color:white;'></td>
							<td style='font-weight:bold; border:1px solid;  background:#000000; color:white;'></td>
							<td style='font-weight:bold; border:1px solid;  background:#000000; color:white;'></td>
							<td style='font-weight:bold; border:1px solid;  background:#000000; color:white;'></td>

							
									

						</tr>
						<tr> 
							<td style='font-weight:bold; border:1px solid;  background:#000000; color:white;'></td>
							<td style='font-weight:bold; border:1px solid;  background:#000000; color:white;'></td>
							<td style='font-weight:bold; border:1px solid;  background:#000000; color:white;'></td>
							<td style='font-weight:bold; border:1px solid;  background:#000000; color:white;'></td>
							<td style='font-weight:bold; border:1px solid;  background:#000000; color:white;'></td>
							<td style='font-weight:bold; border:1px solid;  background:#000000; color:white;'></td>
							<td style='font-weight:bold; border:1px solid;  background:#000000; color:white;'></td>
							<td style='font-weight:bold; border:1px solid;  background:#000000; color:white;'></td>

							
									

						</tr>
						<tr> 
							<td style='font-weight:bold; border:1px solid;  background:#000000; color:white;'></td>
							<td style='font-weight:bold; border:1px solid;  background:#000000; color:white;'></td>
							<td style='font-weight:bold; border:1px solid;  background:#000000; color:white;'></td>
							<td style='font-weight:bold; border:1px solid;  background:#000000; color:white;'></td>
							<td style='font-weight:bold; border:1px solid;  background:#000000; color:white;'></td>
							<td style='font-weight:bold; border:1px solid;  background:#000000; color:white;'></td>
							<td style='font-weight:bold; border:1px solid;  background:#000000; color:white;'></td>
							<td style='font-weight:bold; border:1px solid;  background:#000000; color:white;'></td>

									

						</tr>
						<tr> 
							<td style='font-weight:bold; border:1px solid white;  background:#000000; color:white;'>CÓDIGO</td>
							<td style='font-weight:bold; border:1px solid white;  background:#000000; color:white;'>PRODUCTO</td>
							<td style='font-weight:bold; border:1px solid white;  background:#000000; color:white;'>CATEGORÍA</td>
							<td style='font-weight:bold; border:1px solid white;  background:#000000; color:white;'>PRECIO</td>
							<td style='font-weight:bold; border:1px solid white;  background:#000000; color:white;'>STOCK INICIAL</td>
							<td style='font-weight:bold; border:1px solid white;  background:#000000; color:white;'>ENTRADAS</td>
							<td style='font-weight:bold; border:1px solid white;  background:#000000; color:white;'>SALIDAS</td>		
							<td style='font-weight:bold; border:1px solid white;  background:#000000; color:white;'>EXISTENCIAS</td>				

						</tr>");

				foreach ($reporte as $key => $value2) {
					
					$detalles = json_decode($value2['detalles']);

					/*=============================================
					TRAER CATEGORIAS
					=============================================*/

					$item2 = "id";
					$valor2 = $value2["id_categoria"];
					$entradas = $value2["stock"]+$value2["entradas"];
					$traerCategoria = ControladorCategorias::ctrMostrarCategorias($item2, $valor2);
					 echo utf8_decode("

					 		<tr>
					 		<td style='border:2px solid black; background:transparent; color:black; text-align:left;'>".$detalles->Codigo[0]."</td>
							<td style='border:2px solid black; background:transparent; color:black;'>".$value2["titulo"]."</td>
							<td style='border:2px solid black; background:transparent; color:black;'>".$traerCategoria["categoria"]."</td>
							<td style='border:2px solid black; background:transparent; color:black;'>$ ".number_format($value2["precio"],2)."</td>
							<td style='border:2px solid black; background:transparent; color:black;'>".$value2["stock"]."</td>
							<td style='border:2px solid black; background:transparent; color:black;'>".$entradas."</td>
							<td style='border:2px solid black; background:transparent; color:black;'>".$value2["ventas"]."</td>
							<td style='border:2px solid black; background:transparent; color:black;'>".$value2["existencias"]."</td>
							</tr>"); 
				}


				echo "</table>";

			}
			/*=============================================
			REPORTE DE VISITAS
			=============================================*/

			if($_GET["reporte"] == "visitaspersonas"){	

				echo utf8_decode("<table style='border:1px solid black;'> 
						
						<tr> 
							<td style='font-weight:bold; border:1px solid;  background:#000000; color:white;'></td>
							<td style='font-weight:bold; border:1px solid;  background:#000000; color:white;'></td>
							<td style='font-weight:bold; border:1px solid;  background:#000000; color:white;'></td>
							<td style='font-weight:bold; border:1px solid;  background:#000000; color:white;'></td>
							<td style='font-weight:bold; border:1px solid;  background:#000000;  color:white;'></td>
							<td style='font-weight:bold; border:1px solid;  background:#000000; color:white;'></td>
							<td style='font-weight:bold; border:1px solid;  background:#000000; color:white;'></td>
							<td style='font-weight:bold; border:1px solid;  background:#000000; color:white;'></td>
							<td style='font-weight:bold; border:1px solid;  background:#000000; color:white;'></td>
							<td style='font-weight:bold; border:1px solid;  background:#000000; color:white;'></td>
							
									

						</tr>
						<tr> 
							<td style='font-weight:bold; border:1px solid;  background:#000000; color:white;'></td>
							<td style='font-weight:bold; border:1px solid;  background:#000000; color:white;'></td>
							<td style='font-weight:bold; border:1px solid;  background:#000000; color:white;'></td>
							<td style='font-weight:bold; border:1px solid;  background:#000000; color:white;'></td>
							<td style='font-weight:bold; border:1px solid;  background:#000000; color:white;'></td>
							<td style='font-weight:bold; border:1px solid;  background:#000000; color:white;'></td>
							<td style='font-weight:bold; border:1px solid;  background:#000000; color:white;'></td>
							<td style='font-weight:bold; border:1px solid;  background:#000000; color:white;'></td>
							<td style='font-weight:bold; border:1px solid;  background:#000000; color:white;'></td>
							<td style='font-weight:bold; border:1px solid;  background:#000000; color:white;'></td>
							
									

						</tr>
						<tr> 
							<td style='font-weight:bold; border:1px solid;  background:#000000; color:white;'></td>
							<td style='font-weight:bold; border:1px solid;  background:#000000; color:white;'></td>
							<td style='font-weight:bold; border:1px solid;  background:#000000; color:white;'></td>
							<td style='font-weight:bold; border:1px solid;  background:#000000; color:white;'></td>
							<td style='font-weight:bold; border:1px solid;  background:#000000; color:white;'></td>
							<td style='font-weight:bold; border:1px solid;  background:#000000; color:white;'></td>
							<td style='font-weight:bold; border:1px solid;  background:#000000; color:white;'></td>
							<td style='font-weight:bold; border:1px solid;  background:#000000; color:white;'></td>
							<td style='font-weight:bold; border:1px solid;  background:#000000; color:white;'></td>
							<td style='font-weight:bold; border:1px solid;  background:#000000; color:white;'></td>
							
									

						</tr>
						
						<tr> 
						<td style='font-weight:bold; border:2px solid white;  background:#000000; color:white;'>IP</td> 
						<td style='font-weight:bold; border:2px solid white;  background:#000000; color:white;'>PAÍS</td>
						<td style='font-weight:bold; border:2px solid white;  background:#000000; color:white;'>VISITAS</td>
						<td style='font-weight:bold; border:2px solid white;  background:#000000; color:white;'>FECHA</td>	
						</tr>");

				foreach ($reporte as $key => $value) {

					 echo utf8_decode("<tr>
				 			
				 						<td style='border:2px solid black; background:transparent; color:black;'>".$value["ip"]."</td>
				 						<td style='border:2px solid black; background:transparent; color:black;'>".$value["pais"]."</td>
				 						<td style='border:2px solid black; background:transparent; color:black;'>".$value["visitas"]."</td>
				 						<td style='border:2px solid black; background:transparent; color:black;'>".$value["fecha"]."</td>
			 					  	 
			 					  	 </tr>"); 		
							
				}
	
				echo "</table>";

			}

			/*=============================================
			REPORTE DE USUARIOS
			=============================================*/

			if($_GET["reporte"] == "usuarios"){	

				echo utf8_decode("<table style='border:1px solid black;'> 

						<tr> 
							<td style='font-weight:bold; border:1px solid;  background:#000000; color:white;'></td>
							<td style='font-weight:bold; border:1px solid;  background:#000000; color:white;'></td>
							<td style='font-weight:bold; border:1px solid;  background:#000000; color:white;'></td>
							<td style='font-weight:bold; border:1px solid;  background:#000000; color:white;'></td>
							<td style='font-weight:bold; border:1px solid;  background:#000000; color:white;'></td>
							<td style='font-weight:bold; border:1px solid;  background:#000000; color:white;'></td>
							<td style='font-weight:bold; border:1px solid;  background:#000000; color:white;'></td>
							
									

						</tr>
						<tr> 
							<td style='font-weight:bold; border:1px solid;  background:#000000; color:white;'></td>
							<td style='font-weight:bold; border:1px solid;  background:#000000; color:white;'></td>
							<td style='font-weight:bold; border:1px solid;  background:#000000; color:white;'></td>
							<td style='font-weight:bold; border:1px solid;  background:#000000; color:white;'></td>
							<td style='font-weight:bold; border:1px solid;  background:#000000; color:white;'></td>
							<td style='font-weight:bold; border:1px solid;  background:#000000; color:white;'></td>
							<td style='font-weight:bold; border:1px solid;  background:#000000; color:white;'></td>
							
									

						</tr>
						<tr> 
							<td style='font-weight:bold; border:1px solid;  background:#000000; color:white;'></td>
							<td style='font-weight:bold; border:1px solid;  background:#000000; color:white;'></td>
							<td style='font-weight:bold; border:1px solid;  background:#000000; color:white;'></td>
							<td style='font-weight:bold; border:1px solid;  background:#000000; color:white;'></td>
							<td style='font-weight:bold; border:1px solid;  background:#000000; color:white;'></td>
							<td style='font-weight:bold; border:1px solid;  background:#000000; color:white;'></td>
							<td style='font-weight:bold; border:1px solid;  background:#000000; color:white;'></td>
							
							
									

						</tr>

						<tr> 
						<td style='font-weight:bold; background:#000000; color:white;'>NOMBRE</td> 
						<td style='font-weight:bold; background:#000000; color:white;'>EMAIL</td>
						<td style='font-weight:bold; background:#000000; color:white;'>MODO</td>
						<td style='font-weight:bold; background:#000000; color:white;'>ESTADO</td>
						<td style='font-weight:bold; background:#000000; color:white;'>FECHA</td>	
						</tr>");

				foreach ($reporte as $key => $value) {

					 echo utf8_decode("<tr>
				 			
				 						<td style='border:2px solid black; background:transparent; color:black;'>".$value["nombre"]."</td>
				 						<td style='border:2px solid black; background:transparent; color:black;'>".$value["email"]."</td>
				 						<td style='border:2px solid black; background:transparent; color:black;'>".$value["modo"]."</td>
				 						<td style='border:2px solid black; background:transparent; color:black;'>");

					 /*=============================================
  					REVISAR ESTADO
  					=============================================*/

		  			if($value["modo"] == "directo"){

			  			if( $value["verificacion"] == 1){
			  				
		  					$estado = "Desactivado";			  			

			  			}else{
			  				
			  				$estado = "Activado";
			  			
			  			}		  			

			  		}else{

			  			$estado = "Activado";

			  		}

				 	echo utf8_decode($estado."</td>
				 					<td style='border:2px solid black; background:transparent; color:black;'>".$value["fecha"]."</td>
			 					  	 
			 					  </tr>"); 		

				}


			echo "</table>";

			}


		}

	}

	/*=============================================
	DESCARGAR REPORTE EN EXCEL
	=============================================*/

	public function ctrDescargarReporteCategorias(){

		if(isset($_GET["reportes"])){

			$tabla = $_GET["reportes"];

			$reportes = ModeloReportes::mdlDescargarReporteCategorias($tabla);

			/*=============================================
			CREAMOS EL ARCHIVO DE EXCEL
			=============================================*/

			$nombre = $_GET["reportes"].'.xls';

			header('Expires: 0');
			header('Cache-control: private');
			header('Content-type: application/vnd.ms-excel');// Archivo de Excel
			header("Cache-Control: cache, must-revalidate"); 
			header('Content-Description: File Transfer');
			header('Last-Modified: '.date('D, d M Y H:i:s'));
			header("Pragma: public"); 
			header('Content-Disposition:; filename="'.$nombre.'"');
			header("Content-Transfer-Encoding: binary");

			
			/*============================================
			REPORTE DE VENTAS CATEGORIAS
			============================================*/
				if($_GET["reportes"] == "productos"){	

				echo utf8_decode("

					<table style='border:1px solid black;'> 

						
						<tr> 
							<td style='font-weight:bold; border:1px solid;  background:#000000; color:white;font-size:20px'>REPORTE DE VENTAS POR CATEGORIA</td>
							<td style='font-weight:bold; border:1px solid;  background:#000000; color:white;'></td>
							<td style='font-weight:bold; border:1px solid;  background:#000000; color:white;'></td>


							
									

						</tr>
						<tr> 
							<td style='font-weight:bold; border:1px solid;  background:#000000; color:white;'></td>
							<td style='font-weight:bold; border:1px solid;  background:#000000; color:white;'></td>
							<td style='font-weight:bold; border:1px solid;  background:#000000; color:white;'></td>


							
									

						</tr>
						<tr> 
							<td style='font-weight:bold; border:1px solid;  background:#000000; color:white;'></td>
							<td style='font-weight:bold; border:1px solid;  background:#000000; color:white;'></td>
							<td style='font-weight:bold; border:1px solid;  background:#000000; color:white;'></td>

									

						</tr>
						<tr> 
							<td style='font-weight:bold; border:1px solid white;  background:#000000; color:white;'>ID CATEGORIA</td>
							<td style='font-weight:bold; border:1px solid white;  background:#000000; color:white;'>CATEGORÍA</td>
							<td style='font-weight:bold; border:1px solid white;  background:#000000; color:white;'>VENTAS</td>		

						</tr>");

				foreach ($reportes as $key => $value2 ) {
					/*=============================================
					TRAER CATEGORIAS
					=============================================*/

					$item2 = "id";
					$valor2 = $value2["id_categoria"];
					$traerCategoria = ControladorCategorias::ctrMostrarCategorias($item2, $valor2);

					$categoria = $traerCategoria["categoria"];

					$item3 ="id";
					$valor3 = $value2["id_categoria"];
					$ventas = ControladorVentasCategorias::ctrMostrarVentasCategorias($item3,$valor3);

					$total = ControladorVentasCategorias::ctrSumarVentasCategorias();

					foreach ($total as $key => $value3) {
						$totalv = $value3;
					}
						

						 echo utf8_decode('
					 		
					 		<tr>
					 		
							<td style="border:2px solid black; background:transparent; color:black; text-align:left;"">'.$value2["id_categoria"].'</td>
							<td style="border:2px solid black; background:transparent; color:black;">'.$categoria.'</td>
								
							<td style="border:2px solid black; background:transparent; color:black;">
							
							'.$totalv["total"].'
							
							</td>
							 
							</tr> '

						); 
					
						
						
				}


				echo "</table>";

			}



		}

	}

	public function reportePedidos(){
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment;filename="pedidos.xlsx"');
		header('Cache-Control: max-age=0');

		$pedidos = ModeloPedidos::mdlMostrarPedidos();

		$spreadsheet = new Spreadsheet();
		$sheet = $spreadsheet->getActiveSheet();
		$sheet->setCellValue('A1', 'Pedido: ' . $id_pedido);

		$spreadsheet->getActiveSheet()->getStyle("A1")->getFont()->setBold(true);
		$spreadsheet->getActiveSheet()->getStyle("A1")->getFont()->setSize(16);

		$spreadsheet->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
		$spreadsheet->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
		$spreadsheet->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
		$spreadsheet->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);

		$fila = 3;

		$titulos = [
			'A'.$fila => 'ID Producto',
			'B'.$fila => 'Usuario',
			'C'.$fila => 'Cantidad',
			'D'.$fila => 'Fecha'
		];

		foreach ($titulos as $celda => $titulo) {
			$sheet->setCellValue($celda, $titulo);

			$spreadsheet->getActiveSheet()->getStyle($celda)->getFill()
		    	->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
		    	->getStartColor()->setARGB('000000');

			$spreadsheet->getActiveSheet()->getStyle($celda)
    			->getFont()->getColor()->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_WHITE);
		}

		$fila++;

		foreach ($pedidos as $pedido) {

			$usuario = ModeloUsuarios::mdlMostrarUsuario('usuarios', 'id', $productoCompra['id_usuario']);

			$titulos = [
				'A'.$fila => $pedido['id_pedido'],
				'B'.$fila => $usuario['nombre'],
				'C'.$fila => $productoCompra['total_productos']
			];

			foreach ($titulos as $celda => $titulo) {

				$sheet->setCellValue($celda, $titulo);
			}

			$fila++;
		}

		$writer = new Xlsx($spreadsheet);
		$writer->save('php://output');
	}

}

?>