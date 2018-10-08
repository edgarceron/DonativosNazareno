<?php
/* @var $this SofintUsersController */
/* @var $model SofintUsers */
/* @var $form CActiveForm */
?>

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
		<?php echo $form->textField($model,'nick',array('class'=>'form-control')); ?>
		<?php echo $form->error($model,'nick'); ?>
	</div>
    </div>
    <?php if($model->isNewRecord){ ?>
    <div class="col-lg-6">
	<div class="form-group">
		<?php echo $form->labelEx($model,'password',array('class'=>'label label-success')); ?>
		<?php echo $form->textField($model,'password',array('class'=>'form-control')); ?>
		<?php echo $form->error($model,'password'); ?>
	</div>
    </div>
    <?php } ?>
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
    <div class="col-lg-6">
	<div class="form-group">
		<?php echo $form->labelEx($model,'email',array('class'=>'label label-success')); ?>
		<?php echo $form->textField($model,'email',array('class'=>'form-control')); ?>
		<?php echo $form->error($model,'email'); ?>
	</div>
    </div>
    <div class="col-lg-6">
	<div class="form-group">
		<?php echo $form->labelEx($model,'dat3',array('class'=>'label label-success')); ?>
		<?php echo $form->textField($model,'dat3',array('class'=>'form-control')); ?>
		<?php echo $form->error($model,'dat3'); ?>
	</div>
    </div>
    <div class="col-lg-6">
	<div class="form-group">
		<?php echo $form->labelEx($model,'perfil',array('class'=>'label label-success')); ?>
		<?php echo $form->dropDownList($model,'perfil', CHtml::listData(Perfil::model()->findAll(),'id','nombre'),array('class'=>'form-control')); ?>
		<?php echo $form->error($model,'perfil'); ?>
	</div>
    </div>
    
    <div class="col-lg-6">
	<div class="form-group">
		<?php echo $form->labelEx($model,'dat1',array('class'=>'label label-success')); ?>
		<?php echo $form->dropDownList($model,'dat1', CHtml::listData(Grupo::model()->findAll(),'id','nombre'),array('class'=>'form-control')); ?>
		<?php echo $form->error($model,'dat1'); ?>
	</div>
    </div>
    
    <div class="col-lg-6">
	<div class="form-group">
		<?php echo $form->labelEx($model,'dat2',array('class'=>'label label-success')); ?>
		<?php echo $form->dropDownList($model,'dat2',CHtml::listData(Usuarios::model()->findAll(),'id','nick'),array('class'=>'form-control')); ?>
		<?php echo $form->error($model,'dat2'); ?>
	</div>
    </div>
 
    <div class="col-lg-6">
	<div class="form-group">
		<?php echo $form->labelEx($model,'estado',array('class'=>'label label-success')); ?>
		<?php echo $form->dropDownList($model,'estado',array(1=>'ACTIVO', 0=>'INACTIVO', -1=>'ROOT'),array('class'=>'form-control')); ?>
		<?php echo $form->error($model,'estado'); ?>
	</div>
    </div>    
   
    
    <div class="col-lg-12">
	<div class="form-group">
		<?php echo CHtml::submitButton('Submit',array('class'=>'btn btn-primary')); ?>
	</div>
    </div>
<?php $this->endWidget(); ?>

</div><!-- form -->