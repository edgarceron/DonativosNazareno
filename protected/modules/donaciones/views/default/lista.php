<?php
/* @var $this DefaultController */

$this->breadcrumbs=array(
	$this->module->id,
        $this->module->nombre,
);
?>



<div class="col-sm-12">
	<div class="card">
		<div class="card-header">
			<img alt="Bootstrap Image Preview" src="<?php echo Yii::app()->request->baseUrl.'/images/edit64.png' ?>"/>
		</div>
		
		<div class="card-body">
			  
			<?php $form=$this->beginWidget('CActiveForm', array(
				'id'=>'eventos-eventos-form',
				'action'=>Yii::app()->createAbsoluteUrl('/donaciones/default/lista'),
				'method'=>'get',
				// Please note: When you enable ajax validation, make sure the corresponding
				// controller action is handling ajax validation correctly.
				// See class documentation of CActiveForm for details on this,
				// you need to use the performAjaxValidation()-method described there.
				'enableAjaxValidation'=>false,
			)); ?>

				<?php echo $errores; ?>
				
				<div class="form-row">
					<div class="form-group col-md-4">
						<?php echo CHtml::label('Evento: ', 'evento'); ?>
						<?php echo CHtml::dropDownList('evento',$evento, $eventos, array('id'=>'evento', 'class'=>'form-control')); ?>
					</div>	
					
					<div class="form-group col-md-4">
						<?php echo CHtml::label('Eventos en el año:', 'year'); ?>
						<?php echo CHtml::dropDownList('year',date('Y'), $years, array('id'=>'year', 'class'=>'form-control')); ?>
					</div>	
					
					<div class="form-group col-md-4">
						<?php echo CHtml::label('Eventos en el mes:', 'mes'); ?>
						<?php echo CHtml::dropDownList('mes',date('m'), $meses, array('id'=>'mes', 'class'=>'form-control', 'onchange' => 'filtrarEventos()')); ?>
					</div>	
					
				</div>
				
				<div class="form-row">
					<div class="form-group col-md-6">
						<?php echo CHtml::label('Numero documento donante', 'donante'); ?>
						<?php echo CHtml::textField('donante',$donante,array('id'=>'donante', 'class'=>'form-control')); ?>
					</div>
					<div class="form-group col-md-3">
						<?php echo CHtml::label('Mostrar donaciones anuladas', 'anuladas'); ?>
						<?php echo CHtml::dropDownList('anuladas',$anuladas,array(1 => 'Si', 0 => 'No') ,array('id'=>'anuladas', 'class'=>'form-control')); ?>
					</div>	
				</div>	
				
				<div class="form-row">
					<div class="form-group col-md-6">
						<?php echo CHtml::label('Nombres', 'nombres'); ?>
						<?php echo CHtml::textField('nombres',$nombres,array('id'=>'nombres', 'class'=>'form-control')); ?>
					</div>	
					
					<div class="form-group col-md-6">
						<?php echo CHtml::label('Apellidos', 'apellidos'); ?>
						<?php echo CHtml::textField('apellidos',$apellidos,array('id'=>'apellidos', 'class'=>'form-control')); ?>
					</div>	
				</div>	 
				
				<div class="form-row">
					<div class="form-group col-md-6">
						<?php echo CHtml::label('Valor donación desde', 'minimo'); ?>
						<?php echo CHtml::textField('minimo',$minimo,array('id'=>'minimo', 'class'=>'form-control','oninput'=>'formatoMoneda(this)')); ?>
					</div>	
					
					<div class="form-group col-md-6">
						<?php echo CHtml::label('hasta', 'maximo'); ?>
						<?php echo CHtml::textField('maximo',$maximo,array('id'=>'maximo', 'class'=>'form-control', 'oninput'=>'formatoMoneda(this)')); ?>
					</div>	
				</div>	
				
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
					<div class="form-group col-md-3">
						<?php echo CHtml::button('Limpiar', array('class' => 'btn btn-primary form-control', 'onclick' => 'limpiarCampos()')) ?>
					</div>
					<div class="form-group col-md-3">
					<?php
						echo CHtml::link(

							'Generar pdf', 
							Yii::app()->createUrl("/donaciones/default/reportePdf", array(
								'evento' => $evento,
								'donante' => $donante,
								'minimo' => $minimo,
								'maximo' => $maximo,
								'desde' => $desde,
								'hasta' => $hasta,
							)), 
							array(
								'submit'=>array('/donaciones/default/reportePdf'),
								'class'=>'btn btn-primary form-control'
							)
						);
					?>
					</div>
					
					<div class="form-group col-md-3">
					<?php
						echo CHtml::link(

							'Descargar excel', 
							Yii::app()->createUrl("/donaciones/default/reporteExcel", array(
								'evento' => $evento,
								'donante' => $donante,
								'minimo' => $minimo,
								'maximo' => $maximo,
								'desde' => $desde,
								'hasta' => $hasta,
							)), 
							array(
								'submit'=>array('/donaciones/default/reportePdf'),
								'class'=>'btn btn-primary form-control'
							)
						);
					?>
					</div>
				</div>
			<?php $this->endWidget(); ?>

		</div>
	</div>
	<br>
	<div class="card">
		<div class="card-header">
			<img alt="Bootstrap Image Preview" src="<?php echo Yii::app()->request->baseUrl.'/images/list64.png' ?>"/>
		</div>
		
		<div class="card-body">
		<?php
			//print_r($dataProvider);
		?>
		<?php
			setlocale(LC_MONETARY, 'es_CO');
			Yii::app()->controller->widget(
				'zii.widgets.grid.CGridView', array(	
					'id'=>'reporte-grid',
					'dataProvider'=>$dataProvider,
					'pager' => array('cssFile' => Yii::app()->baseUrl . '/css/bootstrap.min.css'),
					'cssFile' => Yii::app()->baseUrl . '/css/bootstrap.min.css',
					//'data'=>$queue,
					'itemsCssClass' => 'table table-hover table-striped', 
					'pager'=>array(
						"internalPageCssClass" => "page-item",
					),
					'columns'=>array(
						'idDonanteDonacion.nombre_donante',	
						'idDonanteDonacion.apellido_donante',
						'idEvento.nombre_evento',
						'idEvento.fecha_evento',
						array(
							'name' => 'valor_donacion',
							'type' => 'raw',
							'value' => 'number_format($data->valor_donacion, 0, ",", ".")'
						),
						array
						(
							'class'=>'CButtonColumn',
							'template'=>'{view}{edit}' /* . '{delete}' */,
							'buttons'=>array
							(
								'view' => array
								(
									'label'=>'Ver el evento',
									'imageUrl'=>Yii::app()->request->baseUrl.'/images/view.png',
									'url'=>'Yii::app()->createUrl("donaciones/default/vista", array("id"=>$data->id))',
								),
								'edit' => array
								(
									'label'=>'Editar el evento',
									'imageUrl'=>Yii::app()->request->baseUrl.'/images/edit.png',
									'url'=>'Yii::app()->createUrl("donaciones/default/editar", array("id"=>$data->id))',
								),
								/*
								'delete' => array
								(
									'label'=>'Ver el evento',
									'imageUrl'=>Yii::app()->request->baseUrl.'/images/delete.png',
									'url'=>'Yii::app()->createUrl("donaciones/default/eliminar", 
										array("id"=>$data->id, "lugar" => "reporte", 
										"evento" => "'. $evento .'",
										"donante" => "'. $donante .'",
										"minimo" => "'. $minimo .'",
										"maximo" => "'. $maximo .'",
										))',
								),*/
							),
						)
						
					),
				)
			);			
		?>
		</div>
	</div>
</div>

<script type="text/javascript">
	function createOption(ddl, text, value) {
        var opt = document.createElement('option');
        opt.value = value;
        opt.text = text;
        ddl.options.add(opt);
    }

    function createOptions(optionsArray, ddl) {
		
		for(x in optionsArray){
			createOption(ddl, optionsArray[x], x );
		}
    }
	
	
	function filtrarEventos(){
		var eMes = document.getElementById("mes");
		var mes = eMes.options[eMes.selectedIndex].value;
		
		var eYear = document.getElementById("year");
		var year = eYear.options[eYear.selectedIndex].value;
		
		$.get(
			'<?php echo Yii::app()->createAbsoluteUrl('/donaciones/default/eventosFiltrar') ?>', 
			{mes: mes, year: year}, 
			function(r) {
				var response = JSON.parse(r);
				var e = document.getElementById("evento");
				e.options.length = 0;
				createOption(e, "--", "");
				if(response.length != 0) createOptions(response, e);
			}
		);
	}
	
	function limpiarCampos(){
		document.getElementById("evento").value = "";
		document.getElementById("year").value = "";
		document.getElementById("mes").value = "";
		document.getElementById("donante").value = "";
		document.getElementById("minimo").value = "";
		document.getElementById("maximo").value = "";
		document.getElementById("desde").valueAsDate = null;
		document.getElementById("hasta").valueAsDate = null;
	}
</script>