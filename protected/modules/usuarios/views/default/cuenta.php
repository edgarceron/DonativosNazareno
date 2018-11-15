<?php
/* @var $this DefaultController */

$this->breadcrumbs=array(
	$this->module->id,
        $this->module->nombre,
);
?>
    <ul class="nav nav-tabs" role="tablist">        
        <li class="nav-item active"><a href="#actualizar" aria-controls="actualizar" role="tab" data-toggle="tab" class="nav-link active"><span class="glyphicon glyphicon-refresh"></span> Actualizar</a></li>
    </ul>
    <!-- Tab panes -->
    <div class="tab-content">              
        <div role="tabpanel" class="tab-pane active" id="actualizar">
			<div class="col-lg-12">

				<?php $form=$this->beginWidget('CActiveForm', array(
					'id'=>'sofint-users-_form-form',
					// Please note: When you enable ajax validation, make sure the corresponding
					// controller action is handling ajax validation correctly.
					// See class documentation of CActiveForm for details on this,
					// you need to use the performAjaxValidation()-method described there.
					'enableAjaxValidation'=>false,
				)); ?>	
					<br/>
					<?php echo $form->errorSummary($model); ?>

					<div class="col-lg-6">
					<div class="form-group">
						<?php echo $form->labelEx($model,'nick',array('class'=>'label label-success')); ?>
						<?php echo CHtml::label($model['nick'], '',array('class'=>'form-control')); ?>
						<?php echo $form->error($model,'nick'); ?>
					</div>
					</div>
				   <div class="col-lg-6">
					<div class="form-group">
						<?php echo $form->labelEx($model,'nombre',array('class'=>'label label-success')); ?>
						<?php echo $form->textField($model,'nombre',array('class'=>'form-control')); ?>
						<?php echo $form->error($model,'nombre'); ?>
					</div>
					</div>
					<div class="col-lg-6">
					<div class="form-group">
						<?php echo $form->labelEx($model,'apellido',array('class'=>'label label-success')); ?>
						<?php echo $form->textField($model,'apellido',array('class'=>'form-control')); ?>
						<?php echo $form->error($model,'apellido'); ?>
					</div>
					</div>
					
					<div class="col-lg-12">
						<div class="form-group">
							<?php echo CHtml::submitButton('Actualizar',array('class'=>'btn btn-primary')); ?>
							<?php 
								$id_app_user = Yii::app()->user->id;
								$id_user = $model['id'];
								if($id_user == $id_app_user){
									echo CHtml::button('Cambiar mi contraseña', array('onclick' => 'js:document.location.href="'. Yii::app()->createAbsoluteUrl('/usuarios/default/cambiar', array('id' => $id_user)) . '"', 'class' => 'btn btn-primary')); 
								}
							?>
						</div>
					</div>
				<?php $this->endWidget(); ?>

			</div><!-- form -->
        </div>
    </div>
