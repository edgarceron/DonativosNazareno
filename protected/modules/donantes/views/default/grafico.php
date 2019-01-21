	<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/Chart.bundle.js"></script>
	<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/utils.js"></script>
<div class="col-sm-12">
	<div class="card">
		<div class="card-header">
			<table>
				<tr>
					<th>
						<img alt="Bootstrap Image Preview" src="<?php echo Yii::app()->request->baseUrl.'/images/edit64.png' ?>"/>
					</th>
					<th>
						<h2>Filtrar resultado</h2>
					</th>
				</tr>
			</table>
		</div>
		
		<div class="card-body">
			  
			<?php $form=$this->beginWidget('CActiveForm', array(
				'id'=>'eventos-eventos-form',
				'action'=>Yii::app()->createAbsoluteUrl('/donantes/default/donantesTipo'),
				'method'=>'get',
				// Please note: When you enable ajax validation, make sure the corresponding
				// controller action is handling ajax validation correctly.
				// See class documentation of CActiveForm for details on this,
				// you need to use the performAjaxValidation()-method described there.
				'enableAjaxValidation'=>false,
			)); ?>
	
				<div class="form-row">
					<div class="form-group col-md-6">
						<?php echo CHtml::label('Fecha desde', 'desde'); ?>
						<?php echo CHtml::dateField('desde',$desde,array('id'=>'desde', 'class'=>'form-control')); ?>
					</div>	
					
					<div class="form-group col-md-6">
						<?php echo CHtml::label('hasta', 'hasta'); ?>
						<?php echo CHtml::dateField('hasta',$hasta,array('id'=>'hasta', 'class'=>'form-control')); ?>
					</div>	
				</div>	
				
				<div class="form-row">
					<div class="form-group col-md-3">
						<?php echo CHtml::submitButton('Filtrar',array('class'=>'btn btn-primary form-control')); ?>
					</div>
				</div>
			<?php $this->endWidget(); ?>
			
			<div id="canvas-holder" style="width:90%">
				<?php if(count($reporte) == 0) echo "No hay datos para mostrar";?>
				<canvas id="chart-area"></canvas>
			</div>
		</div>
	</div>	
</div>	
	
	
<script>
	var randomScalingFactor = function() {
		return Math.round(Math.random() * 100);
	};

	var config = {
		type: 'pie',
		data: {
			datasets: [{
				data: [
					<?php foreach($reporte as $r){
						echo $r . ",";
					} ?>
				],
				backgroundColor: [
					<?php
						$colores = array(1 => "red", "orange", "green");
						foreach(array_keys($reporte) as $r){
							echo "window.chartColors." . $colores[$r] . ", ";
						}
					?>
				],
				label: 'Dataset 1'
			}],
			labels: [
				<?php 
					foreach(array_keys($reporte) as $r){
						echo "'" . $tipos[$r] . "',";
					}	
				?>
			]
		},
		options: {
			responsive: true
		}
	};
	
	Chart.plugins.register({
		afterDatasetsDraw: function(chart) {
			var ctx = chart.ctx;

			chart.data.datasets.forEach(function(dataset, i) {
				var meta = chart.getDatasetMeta(i);
				if (!meta.hidden) {
					meta.data.forEach(function(element, index) {
						// Draw the text in black, with the specified font
						ctx.fillStyle = 'rgb(0, 0, 0)';

						var fontSize = 16;
						var fontStyle = 'normal';
						var fontFamily = 'Helvetica Neue';
						ctx.font = Chart.helpers.fontString(fontSize, fontStyle, fontFamily);
						const formatter = new Intl.NumberFormat('es-ES', {
						  style: 'currency',
						  currency: 'COP',
						  minimumFractionDigits: 0
						});
						// Just naively convert to string for now
						var dataString = '$' + formatter.format(dataset.data[index]);

						// Make sure alignment settings are correct
						ctx.textAlign = 'center';
						ctx.textBaseline = 'middle';

						var padding = 5;
						var position = element.tooltipPosition();
						ctx.fillText(dataString, position.x, position.y - (fontSize / 2) - padding);
					});
				}
			});
		}
	});

	window.onload = function() {
		var ctx = document.getElementById('chart-area').getContext('2d');
		window.myPie = new Chart(ctx, config);
	};


	var colorNames = Object.keys(window.chartColors);
	
</script>


