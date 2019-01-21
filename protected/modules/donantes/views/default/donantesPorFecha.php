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
			<table>
				<tr>
					<th>
						<img alt="Bootstrap Image Preview" src="<?php echo Yii::app()->request->baseUrl.'/images/edit64.png' ?>"/>
					</th>
					<th>
						<h2>Filtrar busqueda</h2>
					</th>
				</tr>
			</table>
		</div>
		
		<div class="card-body">
			  
			<?php $form=$this->beginWidget('CActiveForm', array(
				'id'=>'eventos-eventos-form',
				'action'=>Yii::app()->createAbsoluteUrl('/donantes/default/reporte'),
				'method'=>'get',
				// Please note: When you enable ajax validation, make sure the corresponding
				// controller action is handling ajax validation correctly.
				// See class documentation of CActiveForm for details on this,
				// you need to use the performAjaxValidation()-method described there.
				'enableAjaxValidation'=>false,
			)); ?>

				<?php echo $errores; ?>
			
				
				<div class="form-row">
					<div class="form-group col-md-6">
						<?php echo CHtml::label('Numero documento donante', 'donante'); ?>
						<?php echo CHtml::textField('donante',$donante,array('id'=>'donante', 'class'=>'form-control')); ?>
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
							Yii::app()->createUrl("/donantes/default/reporte", array(
								'donante' => $donante,
								'desde' => $desde,
								'hasta' => $hasta,
								'reporte' => 'pdf',
							)), 
							array(
								'submit'=>array('/donantes/default/reportePdf'),
								'class'=>'btn btn-primary form-control'
							)
						);
					?>
					</div>
					
					<div class="form-group col-md-3">
					<?php
						echo CHtml::link(

							'Descargar excel', 
							Yii::app()->createUrl("/donantes/default/reporte", array(
								'donante' => $donante,
								'desde' => $desde,
								'hasta' => $hasta,
								'reporte' => 'excel',
							)), 
							array(
								'submit'=>array('/donantes/default/reportePdf'),
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
			<table>
				<tr>
					<th>
						<img alt="Bootstrap Image Preview" src="<?php echo Yii::app()->request->baseUrl.'/images/list64.png' ?>"/>
					</th>
					<th>
						<h2>Resultados de la busqueda</h2>
					</th>
				</tr>
			</table>
		</div>
		
		<div class="card-body">
		<?php
			//print_r($dataProvider);
		?>
		<?php
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
						'idDonanteDonacion.numero_documento_donante',
						array(
							'name' => 'idDonanteDonacion.nombre_donante',	
							'value' => '$data->idDonanteDonacion->nombre_donante . " " . $data->idDonanteDonacion->apellido_donante',
						),	
						array(
							"name" => "Total donaciones",
							"value" => '$data->valor_donacion',
						),
						'idDonanteDonacion.direccion_donante',
						'idDonanteDonacion.correo_donante',
						'idDonanteDonacion.telefono_donante',
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
									'url'=>'Yii::app()->createUrl("donantes/default/vista", array("id"=>$data->id_donante_donacion, "desde" => "' . $desde . '", "hasta" => "' . $hasta . '"))',
								),
								'edit' => array
								(
									'label'=>'Editar el evento',
									'imageUrl'=>Yii::app()->request->baseUrl.'/images/edit.png',
									'url'=>'Yii::app()->createUrl("donantes/default/editar", array("id"=>$data->id_donante_donacion, "desde" => "' . $desde . '", "hasta" => "' . $hasta . '"))',
								),
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
	
	function limpiarCampos(){
		document.getElementById("donante").value = "";
		document.getElementById("desde").valueAsDate = null;
		document.getElementById("hasta").valueAsDate = null;
	}
</script>