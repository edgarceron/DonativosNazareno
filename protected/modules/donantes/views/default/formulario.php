<?php
/* @var $this DonantesController */
/* @var $model Donantes */
/* @var $form CActiveForm */
?>



<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'donantes-formulario-form',
    'action'=>Yii::app()->createAbsoluteUrl('/donantes/default/guardar'.$parametros_get),
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// See class documentation of CActiveForm for details on this,
	// you need to use the performAjaxValidation()-method described there.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

    <div class="form-group col-md-6">
		<?php echo $form->labelEx($model,'tipo_documento_donante',array()); ?>
		<?php echo $form->dropDownList($model,'tipo_documento_donante', array('1' => 'Cedula de ciudadania', '2' => 'Nit', '3' => 'Pasaporte'),array('class'=>'form-control')); ?>
		<?php echo $form->error($model,'tipo_documento_donante'); ?>
    </div>
    <div class="form-group col-md-6">
		<?php echo $form->labelEx($model,'numero_documento_donante',array()); ?>
		<?php echo $form->textField($model,'numero_documento_donante',array('class'=>'form-control')); ?>
		<?php echo $form->error($model,'numero_documento_donante'); ?>
    </div>
    <div class="form-group col-md-6">
		<?php echo $form->labelEx($model,'nombre_donante',array()); ?>
		<?php echo $form->textField($model,'nombre_donante',array('class'=>'form-control')); ?>
		<?php echo $form->error($model,'nombre_donante'); ?>
    </div>
    <div class="form-group col-md-6">
		<?php echo $form->labelEx($model,'apellido_donante',array()); ?>
		<?php echo $form->textField($model,'apellido_donante',array('class'=>'form-control')); ?>
		<?php echo $form->error($model,'apellido_donante'); ?>
    </div>
    <div class="form-group col-md-6">
		<?php echo $form->labelEx($model,'direccion_donante',array()); ?>
		<?php echo $form->textField($model,'direccion_donante',array('class'=>'form-control')); ?>
		<?php echo $form->error($model,'direccion_donante'); ?>
    </div>
    <div class="form-group col-md-6">
		<?php echo $form->labelEx($model,'correo_donante',array()); ?>
		<?php echo $form->textField($model,'correo_donante',array('class'=>'form-control')); ?>
		<?php echo $form->error($model,'correo_donante'); ?>
    </div>
    <div class="form-group col-md-6">
		<?php echo $form->labelEx($model,'telefono_donante',array()); ?>
		<?php echo $form->textField($model,'telefono_donante',array('class'=>'form-control')); ?>
		<?php echo $form->error($model,'telefono_donante'); ?>
    </div>
    <div class="col-lg-12">
	<div class="form-group">
		<?php echo CHtml::submitButton($texto_boton,array('class'=>'btn btn-primary')); ?>
	</div>
    </div>
<?php $this->endWidget(); ?>

<!-- form -->