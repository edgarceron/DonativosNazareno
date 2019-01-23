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
			<table>
				<tr>
					<th>
						<img alt="Bootstrap Image Preview" src="<?php echo Yii::app()->request->baseUrl.'/images/edit64.png' ?>"/>
					</th>
					<th>
						<h2>Reporte dian</h2>
					</th>
				</tr>
			</table>
		</div>
		
		<div class="card-body">
			  
			<?php $form=$this->beginWidget('CActiveForm', array(
				'id'=>'eventos-eventos-form',
				'action'=>Yii::app()->createAbsoluteUrl('/donantes/default/reporteDian'),
				'method'=>'get',
				// Please note: When you enable ajax validation, make sure the corresponding
				// controller action is handling ajax validation correctly.
				// See class documentation of CActiveForm for details on this,
				// you need to use the performAjaxValidation()-method described there.
				'enableAjaxValidation'=>false,
			)); ?>

				<?php 
					for($i=2018; $i<2031;$i++){
						$years[$i] = $i;
					}
				?>
				<div class="form-row">
					<div class="form-group col-md-6">
						<?php echo CHtml::label('Año', 'year'); ?>
						<?php echo CHtml::dropDownList('year',date('Y'), $years, array('id'=>'year', 'class'=>'form-control')); ?>
					</div>
				</div>	
				
				<div class="form-row">
					<div class="form-group col-md-3">
						<?php echo CHtml::submitButton('Generar',array('class'=>'btn btn-primary form-control')); ?>
					</div>
				</div>
			<?php $this->endWidget(); ?>

		</div>
	</div>
	