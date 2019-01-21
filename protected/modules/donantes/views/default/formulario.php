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

	<?php echo $form->errorSummary($model, null, null, array('style' => 'color : #F00')); ?>
	<div class="row">
		<div class="form-group col-md-6">
			<?php echo $form->labelEx($model,'tipo_documento_donante',array()); ?>
			<?php echo $form->dropDownList($model,'tipo_documento_donante', Donantes::tiposDocumento(),array('class'=>'form-control', 'id' => 'tipo_documento', 'onchange' => 'verificarCampos()')); ?>
			<?php echo $form->error($model,'tipo_documento_donante', array('style' => 'color : #F00')); ?>
		</div>
	</div>
	<div class="row">
		<div class="form-group col-md-4">
			<?php echo $form->labelEx($model,'numero_documento_donante',array()); ?>
			<?php echo $form->textField($model,'numero_documento_donante',array('class'=>'form-control')); ?>
			<?php echo $form->error($model,'numero_documento_donante', array('style' => 'color : #F00')); ?>
		</div>
		<div class="form-group col-md-2">
			<?php echo CHtml::label('Digito de verificación','digito',array('class'=>'invisible', 'id' => 'digito_label')); ?>
			<?php echo CHtml::textField('digito','',array('class'=>'invisible form-control', 'id' => 'digito', 'maxlength'=> 1)); ?>
		</div>
	</div>
	<div class="row">
		<div class="form-group col-md-6">
			<?php echo $form->labelEx($model,'nombre_donante',array()); ?>
			<?php echo $form->textField($model,'nombre_donante',array('class'=>'form-control')); ?>
			<?php echo $form->error($model,'nombre_donante', array('style' => 'color : #F00')); ?>
		</div>
		<div class="form-group col-md-6">
			<?php echo $form->labelEx($model,'apellido_donante',array()); ?>
			<?php echo $form->textField($model,'apellido_donante',array('class'=>'form-control', 'id' => 'apellido_donante')); ?>
			<?php echo $form->error($model,'apellido_donante', array('style' => 'color : #F00')); ?>
		</div>
		<div class="form-group col-md-6">
			<?php echo $form->labelEx($model,'direccion_donante',array()); ?>
			<?php echo $form->textField($model,'direccion_donante',array('class'=>'form-control')); ?>
			<?php echo $form->error($model,'direccion_donante', array('style' => 'color : #F00')); ?>
		</div>
		<div class="form-group col-md-6">
			<?php echo $form->labelEx($model,'correo_donante',array()); ?>
			<?php echo $form->textField($model,'correo_donante',array('class'=>'form-control')); ?>
			<?php echo $form->error($model,'correo_donante', array('style' => 'color : #F00')); ?>
		</div>
		<div class="form-group col-md-6">
			<?php echo $form->labelEx($model,'telefono_donante',array()); ?>
			<?php echo $form->textField($model,'telefono_donante',array('class'=>'form-control')); ?>
			<?php echo $form->error($model,'telefono_donante', array('style' => 'color : #F00')); ?>
		</div>
		<div class="col-lg-12">
			<div class="form-group">
				<?php echo CHtml::submitButton($texto_boton,array('class'=>'btn btn-primary')); ?>
			</div>
		</div>
	</div>
<?php $this->endWidget(); ?>

<script>
	function verificarCampos(){
		var tipdoc = $('#tipo_documento').val();
		var apellid = $('#apellido_donante');
		if(tipdoc == 2){
			apellid.val("");
			apellid.prop('disabled', true);
			$('#digito').removeClass('invisible');
			$('#digito_label').removeClass('invisible');
			$('#digito').addClass('visible');
			$('#digito_label').addClass('visible');
		}
		else{
			apellid.prop('disabled', false);
			$('#digito').removeClass('visible');
			$('#digito_label').removeClass('visible');
			$('#digito').addClass('invisible');
			$('#digito_label').addClass('invisible');
		}
	}
	
	window.onload = function load(){
		var t = $('#tipo_documento').val();
		if(t == 2){
			$('#apellido_donante').prop('disabled', true);
			$('#digito').removeClass('invisible');
			$('#digito_label').removeClass('invisible');
			$('#digito').addClass('visible');
			$('#digito_label').addClass('visible');
		}
	}
</script>

<!-- form -->