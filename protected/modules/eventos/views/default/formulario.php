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
			<img alt="Bootstrap Image Preview" src="<?php echo Yii::app()->request->baseUrl.$icono ?>"/>
		</div>
		
		<div class="card-body">
			  
			<?php $form=$this->beginWidget('CActiveForm', array(
				'id'=>'eventos-eventos-form',
				'action'=>Yii::app()->createAbsoluteUrl('/eventos/default/guardar'.$parametros_get),
				// Please note: When you enable ajax validation, make sure the corresponding
				// controller action is handling ajax validation correctly.
				// See class documentation of CActiveForm for details on this,
				// you need to use the performAjaxValidation()-method described there.
				'enableAjaxValidation'=>false,
			)); ?>

				<p class="note">Fields with <span class="required">*</span> are required.</p>

				<?php echo $form->errorSummary($model, null, null, array('style' => 'color : #F00')); ?>

				<div class="col-sm-4">
				<div class="form-group">
					<?php echo $form->labelEx($model,'nombre_evento',array('class'=>'label label-success')); ?>
					<?php echo $form->textField($model,'nombre_evento',array('class'=>'form-control')); ?>
					<?php echo $form->error($model,'nombre_evento', array('style' => 'color : #F00')); ?>
				</div>
				</div>
				<div class="col-sm-4">
				<div class="form-group">
					<?php echo $form->labelEx($model,'fecha_evento',array('class'=>'label label-success')); ?>
					<?php echo $form->dateField($model,'fecha_evento',array('class'=>'form-control')); ?>
					<?php echo $form->error($model,'fecha_evento', array('style' => 'color : #F00')); ?>
				</div>
				</div>
				<div class="col-sm-12">
				<div class="form-group">
					<?php echo CHtml::submitButton($texto_boton,array('class'=>'btn btn-primary')); ?>
				</div>
				</div>
			<?php $this->endWidget(); ?>

		</div>
	</div>
</div>
