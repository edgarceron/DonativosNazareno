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
				'action'=>Yii::app()->createAbsoluteUrl('/donantes/default/consolidado'),
				'method'=>'get',
				// Please note: When you enable ajax validation, make sure the corresponding
				// controller action is handling ajax validation correctly.
				// See class documentation of CActiveForm for details on this,
				// you need to use the performAjaxValidation()-method described there.
				'enableAjaxValidation'=>false,
			)); ?>

			
				
				<div class="form-row">
					<div class="form-group col-md-6">
						<?php echo CHtml::label('Tipo de documento', 'tipo'); ?>
						<?php echo CHtml::dropDownList('tipo',$tipo, Donantes::tiposDocumento(), array('id'=>'tipo', 'class'=>'form-control')); ?>
					</div>	
					<div class="form-group col-md-6">
						<?php echo CHtml::label('Numero documento donante', 'donante'); ?>
						<?php echo CHtml::textField('donante',$donante,array('id'=>'donante', 'class'=>'form-control')); ?>
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
					<div class="form-group col-md-4">
						<?php echo CHtml::label('Correo electrónico', 'correo'); ?>
						<?php echo CHtml::textField('correo',$correo,array('id'=>'correo', 'class'=>'form-control')); ?>
					</div>	
					
					<div class="form-group col-md-4">
						<?php echo CHtml::label('Teléfono', 'telefono'); ?>
						<?php echo CHtml::textField('telefono',$telefono,array('id'=>'telefono', 'class'=>'form-control')); ?>
					</div>	
				</div>	
				
				<div class="form-row">
					<div class="form-group col-md-4">
						<?php echo CHtml::label('Año', 'year'); ?>
						<?php echo CHtml::dropDownList('year',date('Y'), $years, array('id'=>'year', 'class'=>'form-control')); ?>
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
							Yii::app()->createUrl("/donantes/default/consolidado", array(
								'donante' => $donante,
								'nombres' => $nombres,
								'apellidos' => $apellidos,
								'tipo' => $tipo,
								'direccion' => $direccion,
								'correo' => $correo,
								'telefono' => $telefono,
								'year' => $year,
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
							Yii::app()->createUrl("/donantes/default/consolidado", array(
								'donante' => $donante,
								'nombres' => $nombres,
								'apellidos' => $apellidos,
								'tipo' => $tipo,
								'direccion' => $direccion,
								'correo' => $correo,
								'telefono' => $telefono,
								'year' => $year,
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
		
		<div class="card-body table-responsive">
		
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
					'htmlOptions'=>array('style'=>'width:150%'),
					//'data'=>$queue,
					'itemsCssClass' => 'table table-bordered table-hover table-striped', 
					'pager'=>array(
						"internalPageCssClass" => "page-item",
					),
					'columns'=>array(
						'numero_documento_donante',
						array(
							'name' => 'idDonanteDonacion.nombre_donante',	
							'value' => '$data->nombre_donante . " " . $data->apellido_donante',
							//'htmlOptions'=>array('style'=>'width:30%'),
						),
						'direccion_donante',
						array(
							'name' => 'idDonanteDonacion.correo_donante',	
							'value' => '$data->correo_donante',
							//'htmlOptions'=>array('style'=>'width:30%'),
						),
						'telefono_donante',
						array(
							'name' => 'enero',
							'type' => 'raw',
							'value' => 'number_format($data->enero, 0, ",", ".")'
						),
						array(
							'name' => 'febrero',
							'type' => 'raw',
							'value' => 'number_format($data->febrero, 0, ",", ".")'
						),
						array(
							'name' => 'marzo',
							'type' => 'raw',
							'value' => 'number_format($data->marzo, 0, ",", ".")'
						),
						array(
							'name' => 'abril',
							'type' => 'raw',
							'value' => 'number_format($data->abril, 0, ",", ".")'
						),
						array(
							'name' => 'mayo',
							'type' => 'raw',
							'value' => 'number_format($data->mayo, 0, ",", ".")'
						),
						array(
							'name' => 'junio',
							'type' => 'raw',
							'value' => 'number_format($data->junio, 0, ",", ".")'
						),
						array(
							'name' => 'julio',
							'type' => 'raw',
							'value' => 'number_format($data->julio, 0, ",", ".")'
						),
						array(
							'name' => 'agosto',
							'type' => 'raw',
							'value' => 'number_format($data->agosto, 0, ",", ".")'
						),
						array(
							'name' => 'septiembre',
							'type' => 'raw',
							'value' => 'number_format($data->septiembre, 0, ",", ".")'
						),
						array(
							'name' => 'octubre',
							'type' => 'raw',
							'value' => 'number_format($data->octubre, 0, ",", ".")'
						),
						array(
							'name' => 'noviembre',
							'type' => 'raw',
							'value' => 'number_format($data->noviembre, 0, ",", ".")'
						),
						array(
							'name' => 'diciembre',
							'type' => 'raw',
							'value' => 'number_format($data->diciembre, 0, ",", ".")'
						),		
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
		document.getElementById("nombres").value = "";
		document.getElementById("apellidos").value = "";
		document.getElementById("direccion").value = "";
		document.getElementById("correo").value = "";
		document.getElementById("telefono").value = "";
	}
</script>