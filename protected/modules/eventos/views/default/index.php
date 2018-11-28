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
			Eventos
		</div>
		
		<div class="card-body">
			  
			<div class="card-body">
				<table class="table">
					<tr>
						<td><?php echo CHtml::button('Lista de eventos', array('onclick' => 'js:document.location.href="'. Yii::app()->request->baseUrl . '/index.php/eventos/default/lista"', 'class' => 'btn btn-primary form-control')); ?></th>
					</tr>
					<tr>
						<td><?php echo CHtml::button('Nuevo evento', array('onclick' => 'js:document.location.href="'. Yii::app()->request->baseUrl . '/index.php/eventos/default/crear/"', 'class' => 'btn btn-secondary form-control')); ?></th>
					</tr>
				</table>
			</div>

		</div>
	</div>
</div>