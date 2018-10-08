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
				</table>
			</div>

		</div>
	</div>
</div>