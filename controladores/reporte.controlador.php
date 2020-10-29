<?php
error_reporting(E_ALL);
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class ControladorReporte{

	/*=============================================
	MOSTRAR CABECERAS
	=============================================*/

	static public function ctrReporteExcelPedido($id_pedido){

		require __DIR__ . '/../extensiones/vendor/autoload.php';

		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment;filename="pedido - '. $id_pedido . '.xlsx"');
		header('Cache-Control: max-age=0');

		$productosPedidos = ModeloVentas::mdlProductosVenta($id_pedido);

		//$productos = ModeloProductos::mdlMostrarProductos('productos', 'id_pedido', $valor);

		$productos = [];

		$spreadsheet = new Spreadsheet();
		$sheet = $spreadsheet->getActiveSheet();
		$sheet->setCellValue('A1', 'Pedido: ' . $id_pedido);

		$spreadsheet->getActiveSheet()->getStyle("A1")->getFont()->setBold(true);
		$spreadsheet->getActiveSheet()->getStyle("A1")->getFont()->setSize(16);

		$spreadsheet->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
		$spreadsheet->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
		$spreadsheet->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
		$spreadsheet->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
		$spreadsheet->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
		$spreadsheet->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);
		$spreadsheet->getActiveSheet()->getColumnDimension('G')->setAutoSize(true);

		$fila = 3;

		$titulos = [
			'A'.$fila => 'Código',
			'B'.$fila => 'Producto',
			'C'.$fila => 'Cantidad',
			'D'.$fila => 'Precio',
			'E'.$fila => 'Dirección de envío',
			'F'.$fila => 'Cliente',
			'G'.$fila => 'Fecha',
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

		foreach ($productosPedidos as $productoCompra) {

			$producto = ModeloProductos::mdlMostrarProducto('productos', 'id', $productoCompra['id_producto']);

			$detalles = json_decode($producto['detalles']);

			$usuario = ModeloUsuarios::mdlMostrarUsuario('usuarios', 'id', $productoCompra['id_usuario']);

			$titulos = [
				'A'.$fila => $detalles->Codigo[0],
				'B'.$fila => $producto['titulo'],
				'C'.$fila => $productoCompra['cantidad'],
				'D'.$fila => $productoCompra['pago'] * $productoCompra['cantidad'],
				'E'.$fila => $productoCompra['direccion'],
				'F'.$fila => $usuario['nombre'],
				'G'.$fila => $productoCompra['fecha'],
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