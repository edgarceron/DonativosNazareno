<?php
/* @var $this DonantesController */
/* @var $model Donantes */
?>

	<div class="col-sm-12">
		<div class="card">
			<div class="card-header">
				<img alt="Bootstrap Image Preview" src="<?php echo Yii::app()->request->baseUrl.'/images/view64.png' ?>"/>
			</div>
			<div class="card-body">
				<table class="table">
					<tr>
						<th scope="row"><?php echo $data->getAttributeLabel('id_evento') ?></th>
						<td><?php echo $data->id_evento ?></th>
					</tr>
					<tr>
						<th scope="row"><?php echo $data->getAttributeLabel('id_donante_donacion') ?></th>
						<td><?php echo $data->id_donante_donacion ?></th>
					</tr>
					<tr>
						<th scope="row"><?php echo $data->getAttributeLabel('valor_donacion') ?></th>
						<td><?php echo $data->valor_donacion ?></th>
					</tr>
					
				</table>
				<?php echo CHtml::button('Editar', array('onclick' => 'js:document.location.href="'. Yii::app()->request->baseUrl . '/index.php/donantes/default/editar/id/' . $data->id .'"', 'class' => 'btn btn-primary')); ?>
				<?php echo CHtml::button('Eliminar', array('onclick' => 'js:document.location.href="'. Yii::app()->request->baseUrl . '/index.php/donantes/default/eliminar/id/' . $data->id .'"', 'class' => 'btn btn-primary')); ?>
				<?php echo CHtml::button('Lista de donantes', array('onclick' => 'js:document.location.href="'. Yii::app()->request->baseUrl . '/index.php/donantes/default/lista"', 'class' => 'btn btn-primary')); ?>
			</div>
		</div>
	</div>
