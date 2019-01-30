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
				<p class="note">Fields with <span class="required">*</span> are required.</p>
				<div class="row">
					<div class="col-sm-4 form-group">
					
						<?php echo CHtml::activeLabelEx($model,'nombre_evento',array('class'=>'label label-success')); ?>
						<?php echo CHtml::activeTextField($model,'nombre_evento',array('class'=>'form-control', 'id' => 'nombre_evento')); ?>
						<?php echo CHtml::error($model,'nombre_evento', array('style' => 'color : #F00')); ?>
					</div>
					<div class="col-sm-4 form-group">
						<?php echo CHtml::activeLabelEx($model,'fecha_evento',array('class'=>'label label-success')); ?>
						<?php echo CHtml::activeDateField($model,'fecha_evento',array('class'=>'form-control', 'id' => 'fecha_evento')); ?>
						<?php echo CHtml::error($model,'fecha_evento', array('style' => 'color : #F00')); ?>
					</div>
					<div class="col-sm-12 form-group">
						<?php echo CHtml::button($texto_boton,array('class'=>'btn btn-primary', 'onclick' => 'guardarEvento()', 'id' => 'btn_crear_evento')); ?>
						<?php echo CHtml::label('', '',array('id' => 'evento_label_mensaje')); ?>
					</div>
				</div>
		</div>
	</div>
	
	<script>
		function guardarEvento(){
			var nombre_evento = $('#nombre_evento').val();
			var fecha_evento = $('#fecha_evento').val();
			var id = '<?php echo $parametros_get ?>';
			jQuery.ajaxSetup({async:false});
			$.get(
				'<?php echo Yii::app()->createAbsoluteUrl('/donaciones/default/eventoGuardar') ?>', 
				{
					nombre_evento: nombre_evento, 
					fecha_evento: fecha_evento,
				}, 
				function(r) {
					$('#evento_label_mensaje').empty();
					var respupesta = r.split(';');
					$('#evento_label_mensaje').append(respupesta[0]);
					if(respupesta[0] == "Guardado existosamente"){
						var fecha = fecha_evento.split('-');
						$('#year').val(fecha[0]);
						$('#mes').val(fecha[1]);
						filtrarEventos();
						$('#id_evento').val(respupesta[1]);
						$('#btn_crear_evento').prop('disabled', true);
					}	
				}
			);
		}
	</script>
</div>
