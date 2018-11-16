<?php
/* @var $this DonantesController */
/* @var $model Donantes */
/* @var $form CActiveForm */
?>





	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo CHtml::errorSummary($model); ?>

    <div class="form-group col-md-6">
		<?php echo CHtml::activeLabelEx($model,'tipo_documento_donante',array()); ?>
		<?php echo CHtml::activeDropDownList($model,'tipo_documento_donante', array('1' => 'Cedula de ciudadania', '2' => 'Nit', '3' => 'Pasaporte'),array('class'=>'form-control', 'id' => $tipo. "_tipo_documento_donante", 'onchange' => 'verificarCampos()')); ?>
		<?php echo CHtml::error($model,'tipo_documento_donante'); ?>
    </div>
    <div class="form-group col-md-6">
		<?php echo CHtml::activeLabelEx($model,'numero_documento_donante',array()); ?>
		<?php echo CHtml::activeTextField($model,'numero_documento_donante',array('class'=>'form-control', 'id' => $tipo. "_numero_documento_donante")); ?>
		<?php echo CHtml::error($model,'numero_documento_donante'); ?>
    </div>
    <div class="form-group col-md-6">
		<?php echo CHtml::activeLabelEx($model,'nombre_donante',array()); ?>
		<?php echo CHtml::activeTextField($model,'nombre_donante',array('class'=>'form-control', 'id' => $tipo . "_nombre_donante")); ?>
		<?php echo CHtml::error($model,'nombre_donante'); ?>
    </div>
    <div class="form-group col-md-6">
		<?php echo CHtml::activeLabelEx($model,'apellido_donante',array()); ?>
		<?php echo CHtml::activeTextField($model,'apellido_donante',array('class'=>'form-control', 'id' => $tipo. "_apellido_donante")); ?>
		<?php echo CHtml::error($model,'apellido_donante'); ?>
    </div>
    <div class="form-group col-md-6">
		<?php echo CHtml::activeLabelEx($model,'direccion_donante',array()); ?>
		<?php echo CHtml::activeTextField($model,'direccion_donante',array('class'=>'form-control', 'id' => $tipo. "_direccion_donante")); ?>
		<?php echo CHtml::error($model,'direccion_donante'); ?>
    </div>
    <div class="form-group col-md-6">
		<?php echo CHtml::activeLabelEx($model,'correo_donante',array()); ?>
		<?php echo CHtml::activeTextField($model,'correo_donante',array('class'=>'form-control', 'id' => $tipo. "_correo_donante")); ?>
		<?php echo CHtml::error($model,'correo_donante'); ?>
    </div>
    <div class="form-group col-md-6">
		<?php echo CHtml::activeLabelEx($model,'telefono_donante',array()); ?>
		<?php echo CHtml::activeTextField($model,'telefono_donante',array('class'=>'form-control', 'id' => $tipo. "_telefono_donante")); ?>
		<?php echo CHtml::error($model,'telefono_donante'); ?>
    </div>
    <div class="col-lg-12">
	<div class="form-group">
		<?php echo CHtml::button($texto_boton,array('class'=>'btn btn-primary', 'onclick' => 'guardar'. $tipo . '()')); ?>
		<?php echo CHtml::label('', '',array('id' => $tipo . '_label_mensaje')); ?>
	</div>
    </div>
	
	<script>
	
	
	function verificarCampos(){
		var tipdoc = $('<?php echo '#'. $tipo . '_tipo_documento_donante'?>').val();
		var apellid = $('<?php echo '#'. $tipo . '_apellido_donante'?>');
		if(tipdoc == 2){
			apellid.val("");
			apellid.prop('disabled', true);
		}
		else{
			apellid.prop('disabled', false);
		}
	}
	
	function <?php echo 'guardar'. $tipo . '()'?>{
		
		var tipo_documento_donante = $('<?php echo '#'. $tipo . '_tipo_documento_donante'?>').val();
		var numero_documento_donante = $('<?php echo '#'. $tipo . '_numero_documento_donante'?>').val();
		var nombre_donante = $('<?php echo '#'. $tipo . '_nombre_donante'?>').val();
		var apellido_donante = $('<?php echo '#'. $tipo . '_apellido_donante'?>').val();
		var direccion_donante = $('<?php echo '#'. $tipo . '_direccion_donante'?>').val();
		var correo_donante = $('<?php echo '#'. $tipo . '_correo_donante'?>').val();
		var telefono_donante = $('<?php echo '#'. $tipo . '_telefono_donante'?>').val();
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
				$('#<?php echo $tipo; ?>_label_mensaje').empty();
				$('#<?php echo $tipo; ?>_label_mensaje').append(r);
				//alert(r);
			}
		);
		
		<?php 
		if($tipo == "donante"){
			?>
			
		if(tipo_documento_donante == 2){
			var c = $('#representante').attr('class');
			if(c == 'form-row collapse'){
				$('#representante').addClass('show');
			}
			else{
				//$('#formularioDonante').removeClass('show');
			}
			$('#representante').collapse();	
		}
		else{
			$('#id_representante').val("");
			$('#representante').removeClass('show');
		}
		
		<?php
		}
		?>
	}
	</script>

<!-- form -->