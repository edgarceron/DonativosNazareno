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
				'action'=>Yii::app()->createAbsoluteUrl('/donantes/default/lista'),
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
						<?php echo CHtml::label('Tipo de documento', 'tipo'); ?>
						<?php echo CHtml::dropDownList('tipo',$tipo, array('1' => 'Cedula de ciudadania', '2' => 'Nit', '3' => 'Cedula de extrangeria'), array('id'=>'tipo', 'class'=>'form-control')); ?>
					</div>	
					
					<div class="form-group col-md-6">
						<?php echo CHtml::label('Numero documento', 'documento'); ?>
						<?php echo CHtml::textField('documento',$documento,array('id'=>'documento', 'class'=>'form-control')); ?>
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
						<?php echo CHtml::label('Dirrecciom', 'direccion'); ?>
						<?php echo CHtml::textField('direccion',$direccion,array('id'=>'direccion', 'class'=>'form-control')); ?>
					</div>	
					
					<div class="form-group col-md-4">
						<?php echo CHtml::label('Correo electronico', 'correo'); ?>
						<?php echo CHtml::textField('correo',$correo,array('id'=>'correo', 'class'=>'form-control')); ?>
					</div>	
					
					<div class="form-group col-md-4">
						<?php echo CHtml::label('telefono', 'telefono'); ?>
						<?php echo CHtml::textField('telefono',$telefono,array('id'=>'telefono', 'class'=>'form-control')); ?>
					</div>	
				</div>	
				
				<div class="form-row">
					<div class="form-group col-md-3">
						<?php echo CHtml::submitButton('Filtrar',array('class'=>'btn btn-primary')); ?>
					</div>
					<div class="form-group col-md-3">
						<?php echo CHtml::button('Limpiar', array('class' => 'btn btn-primary form-control', 'onclick' => 'limpiarCampos()')) ?>
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
						'numero_documento_donante',
						'nombre_donante',	
						'apellido_donante',
						array
						(
							'class'=>'CButtonColumn',
							'template'=>'{view}{edit}{delete}',
							'buttons'=>array
							(
								'view' => array
								(
									'label'=>'Ver el evento',
									'imageUrl'=>Yii::app()->request->baseUrl.'/images/view.png',
									'url'=>'Yii::app()->createUrl("donantes/default/vista", array("id"=>$data->id))',
								),
								'edit' => array
								(
									'label'=>'Editar el evento',
									'imageUrl'=>Yii::app()->request->baseUrl.'/images/edit.png',
									'url'=>'Yii::app()->createUrl("donantes/default/editar", array("id"=>$data->id))',
								),
								'delete' => array
								(
									'label'=>'Ver el evento',
									'imageUrl'=>Yii::app()->request->baseUrl.'/images/delete.png',
									'url'=>'Yii::app()->createUrl("donantes/default/eliminar", 
										array("id"=>$data->id, "lugar" => "reporte", 
										"tipo" => "'. $tipo .'",
										"documento" => "'. $documento .'",
										"nombres" => "'. $nombres .'",
										"apellidos" => "'. $apellidos .'",
										"direccion" => "'. $direccion .'",
										"correo" => "'. $correo .'",
										"telefono" => "'. $telefono .'",
										))',
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
		document.getElementById("documento").value = "";
		document.getElementById("nombres").value = "";
		document.getElementById("apellidos").value = "";
		document.getElementById("direccion").value = "";
		document.getElementById("correo").value = "";
		document.getElementById("telefono").value = "";
	}
</script>