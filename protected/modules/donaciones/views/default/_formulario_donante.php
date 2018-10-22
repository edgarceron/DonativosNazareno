<?php
/* @var $this DonantesController */
/* @var $model Donantes */
/* @var $form CActiveForm */
?>





	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo CHtml::errorSummary($model); ?>

    <div class="form-group col-md-6">
		<?php echo CHtml::activeLabelEx($model,'tipo_documento_donante',array()); ?>
		<?php echo CHtml::activeDropDownList($model,'tipo_documento_donante', array('1' => 'Cedula de ciudadania', '2' => 'Nit', '3' => 'Pasaporte'),array('class'=>'form-control')); ?>
		<?php echo CHtml::error($model,'tipo_documento_donante'); ?>
    </div>
    <div class="form-group col-md-6">
		<?php echo CHtml::activeLabelEx($model,'numero_documento_donante',array()); ?>
		<?php echo CHtml::activeTextField($model,'numero_documento_donante',array('class'=>'form-control')); ?>
		<?php echo CHtml::error($model,'numero_documento_donante'); ?>
    </div>
    <div class="form-group col-md-6">
		<?php echo CHtml::activeLabelEx($model,'nombre_donante',array()); ?>
		<?php echo CHtml::activeTextField($model,'nombre_donante',array('class'=>'form-control')); ?>
		<?php echo CHtml::error($model,'nombre_donante'); ?>
    </div>
    <div class="form-group col-md-6">
		<?php echo CHtml::activeLabelEx($model,'apellido_donante',array()); ?>
		<?php echo CHtml::activeTextField($model,'apellido_donante',array('class'=>'form-control')); ?>
		<?php echo CHtml::error($model,'apellido_donante'); ?>
    </div>
    <div class="form-group col-md-6">
		<?php echo CHtml::activeLabelEx($model,'direccion_donante',array()); ?>
		<?php echo CHtml::activeTextField($model,'direccion_donante',array('class'=>'form-control')); ?>
		<?php echo CHtml::error($model,'direccion_donante'); ?>
    </div>
    <div class="form-group col-md-6">
		<?php echo CHtml::activeLabelEx($model,'correo_donante',array()); ?>
		<?php echo CHtml::activeTextField($model,'correo_donante',array('class'=>'form-control')); ?>
		<?php echo CHtml::error($model,'correo_donante'); ?>
    </div>
    <div class="form-group col-md-6">
		<?php echo CHtml::activeLabelEx($model,'telefono_donante',array()); ?>
		<?php echo CHtml::activeTextField($model,'telefono_donante',array('class'=>'form-control')); ?>
		<?php echo CHtml::error($model,'telefono_donante'); ?>
    </div>
    <div class="col-lg-12">
	<div class="form-group">
		<?php echo CHtml::button($texto_boton,array('class'=>'btn btn-primary', 'onclick' => 'guardar()')); ?>
		<?php echo CHtml::label('', '',array('id' => 'label_mensaje')); ?>
	</div>
    </div>
	
	<script>
	function guardar(){
		
		var tipo_documento_donante = $('#Donaciones_id_donante_donacion').val();
		var numero_documento_donante = $('#Donantes_numero_documento_donante').val();
		var nombre_donante = $('#Donantes_nombre_donante').val();
		var apellido_donante = $('#Donantes_apellido_donante').val();
		var direccion_donante = $('#Donantes_direccion_donante').val();
		var correo_donante = $('#Donantes_correo_donante').val();
		var telefono_donante = $('#Donantes_telefono_donante').val();
		var id = '<?php echo $parametros_get ?>';
		
		$.get(
			'<?php echo Yii::app()->createAbsoluteUrl('/donaciones/default/donanteGuardar') ?>', 
			{
				tipo_documento_donante: tipo_documento_donante, 
				numero_documento_donante: numero_documento_donante,
				nombre_donante: nombre_donante,
				apellido_donante: apellido_donante,
				direccion_donante: direccion_donante,
				correo_donante: correo_donante,
				telefono_donante: telefono_donante,
				id: id,
			}, 
			function(r) {
				$('#label_mensaje').empty();
				$('#label_mensaje').append(r);
				//alert(r);
			}
		);
		<?php /*
		echo CHtml::ajax(
			array(
				'type'=>'GET',
				'dataType'=>'html',
				'async'=>'false',
				'url' => 'donanteGuardar',
				'data' => array(
					'tipo_documento_donante' => 'js:tipo_documento_donante',	
					'numero_documento_donante' => 'js:numero_documento_donante',	
					'nombre_donante' => 'js:nombre_donante',	
					'apellido_donante' => 'js:apellido_donante',	
					'direccion_donante' => 'js:direccion_donante',	
					'correo_donante' => 'js:correo_donante',	
					'telefono_donante' => 'js:telefono_donante',	
					'id' => 'js:id',	
				),
				'complete'=>"function(r) {alert(JSON.parse(r));}",
			)
		); */?>
	}
	</script>

<!-- form -->