<?php
/* @var $this DonacionesController */
/* @var $model Donaciones */
/* @var $form CActiveForm */
?>


<div class="col-sm-12">
	<div class="card">
		<div class="card-header">
			<img alt="Bootstrap Image Preview" src="<?php echo Yii::app()->request->baseUrl.$icono ?>"/>
		</div>
		
		<?php echo $mensaje ?>
		
		<div class="card-body">
			<?php $form=$this->beginWidget('CActiveForm', array(
				'id'=>'donaciones-formulario-form',
				'action'=>Yii::app()->createAbsoluteUrl('/donaciones/default/guardar'),
				// Please note: When you enable ajax validation, make sure the corresponding
				// controller action is handling ajax validation correctly.
				// See class documentation of CActiveForm for details on this,
				// you need to use the performAjaxValidation()-method described there.
				'enableAjaxValidation'=>false,
			)); ?>


			<?php echo $form->errorSummary($model); ?>
			<div class="form-row">
				<div class="form-group col-md-4">
					<?php echo $form->labelEx($model,'id_evento',array()); ?>
					<?php echo $form->dropDownList($model,'id_evento', $eventos, array('class'=>'form-control')); ?>
					<?php echo $form->error($model,'id_evento'); ?>
				</div>
				
				<div class="form-group col-md-4">
					<?php echo CHtml::label('Año', 'year'); ?>
					<?php echo CHtml::dropDownList('year',date('Y'), $years, array('id'=>'year', 'class'=>'form-control')); ?>
				</div>	
				
				<div class="form-group col-md-4">
					<?php echo CHtml::label('Mes', 'mes'); ?>
					<?php echo CHtml::dropDownList('mes',date('m'), $meses, array('id'=>'mes', 'class'=>'form-control', 'onchange' => 'filtrarEventos()')); ?>
				</div>	
			</div>
			
			<div class="form-row">
				<div class="form-group col-md-4">
					<?php echo $form->labelEx($model,'id_donante_donacion',array()); ?>
					<?php echo $form->textField($model,'id_donante_donacion',array('class'=>'form-control')); ?>
					<?php echo $form->error($model,'id_donante_donacion'); ?>
				</div>
				
				<div class="form-group col-md-4">
					<?php echo CHtml::label('-', 'btnIngresar', array("style" => "color:#FFF")); ?>
					<?php echo CHtml::button('Cargar', array('class' => 'btn btn-primary form-control', 'onclick' => 'mostrarDonante()')) ?>
				</div>
			</div>
			
			<div class="form-row">
				<div class="collapse col-md-12" id="formularioDonante">
					<div class="card">
						<div class="card-body text-secondary">
							<div id = "donante_div">
								<?php echo $this->renderPartial('_formulario_donante', 
									array(
										'model'=> new Donantes, 
										'icono' => '/images/new64.png',
										'texto_boton' => 'Crear',
										'parametros_get' => '',)); ?>
							</div>
						</div>
					</div>
				</div>
				
				<div class="collapse">
					<?php echo $form->labelEx($model,'id_representante_donacion',array()); ?>
					<?php echo $form->textField($model,'id_representante_donacion',array('class'=>'form-control')); ?>
					<?php echo $form->error($model,'id_representante_donacion'); ?>
				</div>
			</div>
			<div class="form-row">
				<div class="form-group col-md-6">
					<?php echo $form->labelEx($model,'valor_donacion',array()); ?>
					<?php echo $form->textField($model,'valor_donacion',array('class'=>'form-control')); ?>
					<?php echo $form->error($model,'valor_donacion'); ?>
				</div>
			</div>
			<div class="form-row">
				<div class="form-group col-md-6">
					<?php echo CHtml::submitButton($texto_boton,array('class'=>'btn btn-primary')); ?>
				</div>
			<div class="form-row">
		</div>
	</div>
</div>

<script type="text/javascript">
	function mostrarDonante(){
		var numdoc = $('#Donaciones_id_donante_donacion').val();
		<?php echo CHtml::ajax(
			array(
				'type'=>'GET',
				'dataType'=>'html',
				'async'=>'false',
				'url' => Yii::app()->createAbsoluteUrl('/donaciones/default/donanteCargar'),
				'data' => array("documento" => "js: numdoc"),
				'update'=>'#donante_div',
			)
		); ?>

		var c = $('#formularioDonante').attr('class');
		if(c == 'col-md-12 collapse'){
			$('#formularioDonante').addClass('show');
		}
		else{
			//$('#formularioDonante').removeClass('show');
		}
		$('#formularioDonante').collapse();
	}
	
	function createOption(ddl, text, value) {
        var opt = document.createElement('option');
        opt.value = value;
        opt.text = text;
        ddl.options.add(opt);
    }

    function createOptions(optionsArray, ddl) {
		
		for(x in optionsArray){
			createOption(ddl, optionsArray[x], x );
		}
    }
	
	
	function filtrarEventos(){
		var eMes = document.getElementById("mes");
		var mes = eMes.options[eMes.selectedIndex].value;
		
		var eYear = document.getElementById("year");
		var year = eYear.options[eYear.selectedIndex].value;
		
		$.get(
			'<?php echo Yii::app()->createAbsoluteUrl('/donaciones/default/eventosFiltrar') ?>', 
			{mes: mes, year: year}, 
			function(r) {
				var response = JSON.parse(r);
				var e = document.getElementById("Donaciones_id_evento");
				e.options.length = 0;
				createOption(e, "--", "");
				if(response.length != 0) createOptions(response, e);
			}
		);
	}
</script>
<?php $this->endWidget(); ?>

<!-- form -->