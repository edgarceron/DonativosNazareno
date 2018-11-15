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
			Donantes
		</div>
		
		<div class="card-body">
			  
			<div class="card-body">
				<table class="table">
					<tr>
						<td><?php echo CHtml::button('Lista de donantes', array('onclick' => 'js:document.location.href="'. Yii::app()->createUrl('/donantes/default/lista'). '"', 'class' => 'btn btn-primary')); ?></th>
					</tr>
					<tr>
						<td><?php echo CHtml::button('Nuevo donante', array('onclick' => 'js:document.location.href="'. Yii::app()->createUrl('/donantes/default/crear'). '"', 'class' => 'btn btn-primary')); ?></th>
					</tr>
					<tr>
						<td><?php echo CHtml::button('Donaciones por tipo de donante', array('onclick' => 'js:document.location.href="'. Yii::app()->createUrl('/donantes/default/donantesTipo'). '"', 'class' => 'btn btn-primary')); ?></th>
					</tr>
					<tr>
						<td><?php echo CHtml::button('Reporte de donantes por fecha', array('onclick' => 'js:document.location.href="'. Yii::app()->createUrl('/donantes/default/reporte'). '"', 'class' => 'btn btn-primary')); ?></th>
					</tr>
					<tr>
						<td><?php echo CHtml::button('Consolidado anual de donantes', array('onclick' => 'js:document.location.href="'. Yii::app()->createUrl('/donantes/default/consolidado/year/' . date('Y')). '"', 'class' => 'btn btn-primary')); ?></th>
					</tr>
				</table>
			</div>

		</div>
	</div>
</div>