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
						<th scope="row"><?php echo $data->getAttributeLabel('tipo_documento_donante') ?></th>
						<td><?php echo $data->tipo_documento_donante ?></th>
					</tr>
					<tr>
						<th scope="row"><?php echo $data->getAttributeLabel('numero_documento_donante') ?></th>
						<td><?php echo $data->numero_documento_donante ?></th>
					</tr>
					<tr>
						<th scope="row"><?php echo $data->getAttributeLabel('nombre_donante') ?></th>
						<td><?php echo $data->nombre_donante ?></th>
					</tr>
					<tr>
						<th scope="row"><?php echo $data->getAttributeLabel('apellido_donante') ?></th>
						<td><?php echo $data->apellido_donante ?></th>
					</tr>
					<tr>
						<th scope="row"><?php echo $data->getAttributeLabel('direccion_donante') ?></th>
						<td><?php echo $data->direccion_donante ?></th>
					</tr>
					<tr>
						<th scope="row"><?php echo $data->getAttributeLabel('correo_donante') ?></th>
						<td><?php echo $data->correo_donante ?></th>
					</tr>
					<tr>
						<th scope="row"><?php echo $data->getAttributeLabel('telefono_donante') ?></th>
						<td><?php echo $data->telefono_donante ?></th>
					</tr>
				</table>
				<?php echo CHtml::button('Editar', array('onclick' => 'js:document.location.href="'. Yii::app()->request->baseUrl . '/index.php/donantes/default/editar/id/' . $data->id .'"', 'class' => 'btn btn-primary')); ?>
				<?php echo CHtml::button('Eliminar', array('onclick' => 'js:document.location.href="'. Yii::app()->request->baseUrl . '/index.php/donantes/default/eliminar/id/' . $data->id .'"', 'class' => 'btn btn-primary')); ?>
				<?php echo CHtml::button('Lista de donantes', array('onclick' => 'js:document.location.href="'. Yii::app()->request->baseUrl . '/index.php/donantes/default/lista"', 'class' => 'btn btn-primary')); ?>
				
			</div>
		</div>
	</div>
	
	<?php $this->renderPartial('donaciones', array('desde' => $desde, 'hasta' => $hasta, 'dataProvider' => $dataProvider, 'id' => $id));?>
