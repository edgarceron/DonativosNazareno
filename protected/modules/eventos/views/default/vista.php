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
				<img alt="Bootstrap Image Preview" src="<?php echo Yii::app()->request->baseUrl.'/images/view64.png' ?>"/>
			</div>
			<div class="card-body">
				<?php echo $errores; ?>
				<table class="table">
					<tr>
						<th scope="row"><?php echo $data->getAttributeLabel('nombre_evento') ?></th>
						<td><?php echo $data->nombre_evento ?></th>
					</tr>
					<tr>
						<th scope="row"><?php echo $data->getAttributeLabel('fecha_evento') ?></th>
						<td><?php echo $data->fecha_evento ?></th>
					</tr>
				</table>
				<?php echo CHtml::button('Editar', array('onclick' => 'js:document.location.href="'. Yii::app()->request->baseUrl . '/index.php/eventos/default/editar/id/' . $data->id .'"', 'class' => 'btn btn-primary')); ?>
				<?php echo CHtml::button('Eliminar', array('onclick' => 'js:document.location.href="'. Yii::app()->request->baseUrl . '/index.php/eventos/default/eliminar/id/' . $data->id .'"', 'class' => 'btn btn-primary')); ?>
				<?php echo CHtml::button('Lista de eventos', array('onclick' => 'js:document.location.href="'. Yii::app()->request->baseUrl . '/index.php/eventos/default/lista"', 'class' => 'btn btn-primary')); ?>
			</div>
		</div>
	</div>
