<?php
/* @var $this DefaultController */

$this->breadcrumbs=array(
	$this->module->id,
        $this->module->nombre,
);
?>


<br>
<div class="col-sm-12">
	<div class="card">
		<div class="card-header">
			<img alt="Bootstrap Image Preview" src="<?php echo Yii::app()->request->baseUrl.'/images/edit64.png' ?>"/>
		</div>
		
		<div class="card-body">
			  
			<?php $form=$this->beginWidget('CActiveForm', array(
				'id'=>'eventos-eventos-form',
				'action'=>Yii::app()->createAbsoluteUrl('/donantes/default/vista/id/' . $id),
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
						'idEvento.nombre_evento',
						'idEvento.fecha_evento',
						'valor_donacion',
						array
						(
							'class'=>'CButtonColumn',
							'template'=>'{view}{edit}' /* . '{delete}' */,
							'buttons'=>array
							(
								'view' => array
								(
									'label'=>'Ver donación',
									'imageUrl'=>Yii::app()->request->baseUrl.'/images/view.png',
									'url'=>'Yii::app()->createUrl("donaciones/default/vista", array("id"=>$data->id))',
								),
								'edit' => array
								(
									'label'=>'Editar donación',
									'imageUrl'=>Yii::app()->request->baseUrl.'/images/edit.png',
									'url'=>'Yii::app()->createUrl("donaciones/default/editar", array("id"=>$data->id))',
								),
							),
						)
						
					),
				)
			);			
		?>
		
		<div class="form-group col-md-3">
			<?php
				echo CHtml::link(
					'Generar certificado', 
					Yii::app()->createUrl("/donantes/default/certificado", array(
						'desde' => $desde,
						'hasta' => $hasta,
						'id' => $id,
					)), 
					array(
						'submit'=>array('/donaciones/default/reportePdf'),
						'class'=>'btn btn-primary'
					)
				);
			?>
		</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	
	function limpiarCampos(){
		document.getElementById("desde").valueAsDate = null;
		document.getElementById("hasta").valueAsDate = null;
	}
</script>