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
				<?php
					if($data->validez_donacion == 1){
						$boton = 'Anular';
					}
					else{
						$boton = 'Activar';
						echo '<div class="alert alert-danger" role="alert">Esta donación esta anulada</div>';
					}
				?>
				<table class="table">
					<tr>
						<th scope="row"><?php echo $data->getAttributeLabel('id_evento') ?></th>
						<td><?php echo $data->id_evento ?></th>
					</tr>
					<tr>
						<th scope="row"><?php echo $data->getAttributeLabel('id_donante_donacion') ?></th>
						<td><?php echo $data->id_donante_donacion ?></th>
					</tr>
					<?php
						if($data->id_representante_donacion != null){
					?>
					<tr>
						<th scope="row"><?php echo $data->getAttributeLabel('id_representante_donacion') ?></th>
						<td><?php echo $data->id_representante_donacion ?></th>
					</tr>
					<?php
						}
					?>
					<tr>
						<th scope="row"><?php echo $data->getAttributeLabel('valor_donacion') ?></th>
						<td><?php echo $data->valor_donacion ?></th>
					</tr>
					
				</table>
				<?php echo CHtml::button('Editar', array('onclick' => 'js:document.location.href="'. Yii::app()->request->baseUrl . '/index.php/donantes/default/editar/id/' . $data->id .'"', 'class' => 'btn btn-primary')); ?>
				<?php echo CHtml::button('Lista de donantes', array('onclick' => 'js:document.location.href="'. Yii::app()->request->baseUrl . '/index.php/donantes/default/lista"', 'class' => 'btn btn-primary')); ?>
				<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modalBorrar"><?php echo $boton; ?></button>
			</div>
		</div>
	</div>
	
<div class="modal fade" id="modalBorrar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				¿Esta seguro de querer anular esta donación?
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
				<a href="<?php echo Yii::app()->request->baseUrl . '/index.php/donaciones/default/eliminar/id/' . $data->id ?>" class="btn btn-danger">Si</a>
			</div>
		</div>
	</div>
</div>