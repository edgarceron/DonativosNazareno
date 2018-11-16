<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;
?>


<h1>Bienvenido al <i>Sistema de donaciones</i></h1>

<div class="col-sm-12">
	<div class="card">
		<div class="card-header">
			Menu
		</div>
		
		<div class="card-body">
			  
			<div class="card-body">
				<table class="table">
					<tr>
						<td><?php echo CHtml::button('Donantes', array('onclick' => 'js:document.location.href="'. Yii::app()->createUrl('/donantes/'). '"', 'class' => 'btn btn-primary form-control')); ?></th>
					</tr>
					<tr>
						<td><?php echo CHtml::button('Eventos', array('onclick' => 'js:document.location.href="'. Yii::app()->createUrl('/eventos/'). '"', 'class' => 'btn btn-primary form-control')); ?></th>
					</tr>
					<tr>
						<td><?php echo CHtml::button('Donaciones', array('onclick' => 'js:document.location.href="'. Yii::app()->createUrl('/donaciones/'). '"', 'class' => 'btn btn-primary form-control')); ?></th>
					</tr>
				</table>
			</div>

		</div>
	</div>
</div>