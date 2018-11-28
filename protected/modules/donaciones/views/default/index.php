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
			Donaciones
		</div>
		
		<div class="card-body">
			  
			<div class="card-body">
				<table class="table">
					<tr>
						<td><?php echo CHtml::button('Consultar donaciones', array('onclick' => 'js:document.location.href="'. Yii::app()->createUrl('/donaciones/default/lista'). '"', 'class' => 'btn btn-primary form-control')); ?></th>
					</tr>
					<tr>
						<td><?php echo CHtml::button('Nueva donación', array('onclick' => 'js:document.location.href="'. Yii::app()->createUrl('/donaciones/default/crear'). '"', 'class' => 'btn btn-secondary form-control')); ?></th>
					</tr>
				</table>
			</div>

		</div>
	</div>
</div>