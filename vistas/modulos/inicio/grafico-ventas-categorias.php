<?php 

 $ventasCategorias = ControladorVentasCategorias::ctrMostrarVentasCategorias();

 $totalventas = ControladorVentasCategorias::ctrSumarVentasCategorias();




?>


 <script src="vistas/js/Chart.bundle.js"></script>

  <script src="vistas/js/utils.js"></script>



	<!--=====================================
	GRÁFICO DE VENTAS
	======================================-->
	<!-- solid sales graph -->
	<div class="box box-solid bg-white-gradient">

		<!-- box-header -->
		<div class="box-header">

			<i class="fa fa-th"></i>

		    <h3 class="box-title">Gráfico de Ventas</h3>

		    <div class="box-tools pull-right">
		      
		      <button type="button" class="btn bg-teal btn-sm" data-widget="collapse"><i class="fa fa-minus"></i>
		      </button>

		    </div>

		</div>
		<!-- box-header -->

		<!-- box-body -->
		<div class="box-body border-radius-none">

					<div id="canvas-holder" style="width:75%">
						<canvas id="chart-area"></canvas>
					</div>

		</div>
		<!-- box-body -->

		<!-- box-footer -->
	  	<div class="box-footer no-border">

	  	</div>
	  	<!-- box-footer -->

	</div>
	<!-- solid sales graph -->

	
	
	<script>
		var randomScalingFactor = function() {
			return Math.round(Math.random() * 100);
		};
		var config = {
			type: 'doughnut',
			data: {
				datasets: [{
					data: [
					<?php 
						for($i = 0; $i < count($totalventas); $i++){ ?>
							'<?php echo $totalventas[$i]["total"];?>',
						<?php }
					?>
						
					],
					backgroundColor: [
						window.chartColors.red,
						window.chartColors.orange,
						window.chartColors.yellow,
						window.chartColors.green,
						window.chartColors.blue,
						window.chartColors.Gray,
						window.chartColors.purple,
					],
					label: 'Dataset 1'
				}],
				labels: [
				<?php 
						for($i = 0; $i < count($ventasCategorias); $i++){ ?>

									

							        
											'<?php 

											/*=============================================
									        TRAER LAS CATEGORÍAS
									        =============================================*/

									        $item = "id";
									      	$valor = $ventasCategorias[$i]["id_categoria"];

									      $categorias = ControladorCategorias::ctrMostrarCategorias($item, $valor);

									    

									        $categoria = $categorias["categoria"];


											echo $categoria; ?>',
											
	

					<?php }
					?>
				]
			},
			options: {
				responsive: true,
				legend: {
					position: 'top',
				},
				title: {
					display: true,
					text: 'Gráfico de Ventas Por Categorías'
				},
				animation: {
					animateScale: true,
					animateRotate: true
				}
			}
		};
		window.onload = function() {
			var ctx = document.getElementById('chart-area').getContext('2d');
			window.myDoughnut = new Chart(ctx, config);
		};
		
		
		
		
		
	</script>
