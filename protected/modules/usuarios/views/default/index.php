<?php
/* @var $this DefaultController */

$this->breadcrumbs=array(
	$this->module->id,
        $this->module->nombre,
);
?>
<div>

  <!-- Nav tabs -->
  <ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab"><span class="glyphicon glyphicon-home"></span> Home</a></li>
    <li role="presentation"><a href="#nuevo" aria-controls="nuevo" role="tab" data-toggle="tab" class="btn-success"><span class="glyphicon glyphicon-plus"></span> Nuevo Usuario</a></li>    
    <li role="presentation"><a href="#nuevo-perfil" aria-controls="nuevo-perfil" role="tab" data-toggle="tab" class="btn-primary"><span class="glyphicon glyphicon-plus"></span> Nuevo Perfil</a></li>    
	<li role="presentation"><a href="#nuevo-grupo" aria-controls="nuevo-grupo" role="tab" data-toggle="tab" class="btn-danger"><span class="glyphicon glyphicon-plus"></span> Nuevo Grupo</a></li>
	<li role="presentation"><a href="#nuevo-rol" aria-controls="nuevo-rol" role="tab" data-toggle="tab" class="btn-warning"><span class="glyphicon glyphicon-plus"></span> Nuevo Rol</a></li>
  </ul>

  <!-- Tab panes -->
  <div class="tab-content">
      <div role="tabpanel" class="tab-pane active" id="home">
          <br/>
          <div class="tabbable" id="tabs-40080">
                <ul class="nav nav-pills">
                        <li class="active">
                                <a href="#panel-640942" data-toggle="tab">Usuarios</a>
                        </li>
                        <li>
                                <a href="#panel-438434" data-toggle="tab">Perfiles</a>
                        </li>
                </ul>
                <div class="tab-content">
                        <div class="tab-pane active" id="panel-640942">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Nick</th>                                                                
                                            <th class="text-right">Opciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach($usuarios as $usuario) { ?>
                                        <tr>
                                            <td><?php echo $usuario->nick ?></td>                    
                                            <td class="text-right">                        
                                                <a href="<?php echo Yii::app()->createUrl('/usuarios/default/view',array('id'=>$usuario->id)) ?>" class="btn btn-warning"><span class="glyphicon glyphicon-search"></span></a> 
                                                <a href="<?php echo Yii::app()->createUrl('/usuarios/default/borrar',array('id'=>$usuario->id)) ?>" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span></a>
                                            </td>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                        </div>
                        <div class="tab-pane" id="panel-438434">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Nick</th>                    
                                            <th class="text-right">Opciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach($perfiles as $perfil_mostrar) { ?>
                                        <tr>
                                            <td><?php echo $perfil_mostrar->nombre ?></td>                    
                                            <td class="text-right">                        
                                                <a href="<?php echo Yii::app()->createUrl('/usuarios/default/verperfil',array('id'=>$perfil_mostrar->nombre)) ?>" class="btn btn-warning"><span class="glyphicon glyphicon-search"></span></a> 
                                                <a href="<?php echo Yii::app()->createUrl('/usuarios/default/borrarperfil',array('id'=>$perfil_mostrar->nombre)) ?>" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span></a>
                                            </td>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                        </div>
                </div>
        </div>
          
          
      </div>
      <div role="tabpanel" class="tab-pane" id="nuevo">
          <div class="col-lg-8">
              <?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
          </div>                    
      </div>
      <div role="tabpanel" class="tab-pane" id="nuevo-perfil">
          <div class="col-lg-8">
                <?php echo $this->renderPartial('_perfil', array('perfil'=>$perfil)); ?>
              
          </div> 
      </div> 
	  <div role="tabpanel" class="tab-pane" id="nuevo-grupo">
          <div class="col-lg-8">
                <?php echo $this->renderPartial('_grupo', array('grupo'=>$grupo)); ?>
              
          </div> 
      </div> 
	  <div role="tabpanel" class="tab-pane" id="nuevo-rol">
          <div class="col-lg-8">
                aa
              
          </div> 
      </div> 
  </div>

</div>


