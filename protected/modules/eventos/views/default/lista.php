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
				'action'=>Yii::app()->createAbsoluteUrl('/eventos/default/lista'),
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
						<?php echo CHtml::label('Nombre evento', 'nombre'); ?>
						<?php echo CHtml::textField('nombre',$nombre,array('id'=>'nombre', 'class'=>'form-control')); ?>
					</div>	
				</div>
				
				<div class="form-row">
					<div class="form-group col-md-6">
						<?php echo CHtml::label('Desde', 'desde'); ?>
						<?php echo CHtml::dateField('desde',$desde,array('id'=>'desde', 'class'=>'form-control')); ?>
					</div>
					
					<div class="form-group col-md-6">
						<?php echo CHtml::label('Hasta', 'hasta'); ?>
						<?php echo CHtml::dateField('hasta',$hasta,array('id'=>'hasta', 'class'=>'form-control')); ?>
					</div>
				</div>	
				
				<div class="form-row">
					<div class="form-group col-md-12">
						<?php echo CHtml::submitButton('Filtrar',array('class'=>'btn btn-primary')); ?>
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
					'columns'=>array(
						'nombre_evento',
						'fecha_evento',					
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
									'url'=>'Yii::app()->createUrl("eventos/default/vista", array("id"=>$data->id))',
								),
								'edit' => array
								(
									'label'=>'Editar el evento',
									'imageUrl'=>Yii::app()->request->baseUrl.'/images/edit.png',
									'url'=>'Yii::app()->createUrl("eventos/default/editar", array("id"=>$data->id))',
								),
								'delete' => array
								(
									'label'=>'Ver el evento',
									'imageUrl'=>Yii::app()->request->baseUrl.'/images/delete.png',
									'url'=>'Yii::app()->createUrl("eventos/default/eliminar", 
										array("id"=>$data->id, "lugar" => "reporte", 
										"desde" => "'. $desde .'",
										"hasta" => "'. $hasta .'",
										"nombre" => "'. $nombre .'",))',
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