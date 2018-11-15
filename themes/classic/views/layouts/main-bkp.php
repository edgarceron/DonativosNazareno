<?php /* @var $this Controller */ ?>
<?php  
        $tipo = 0;
        if(Yii::app()->user->name != "Guest"){
            $usuario = SofintUsers::model()->findByPk(Yii::app()->user->id); 
            $tipo = $usuario->estado;
        }        
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
                    
        <meta name="description" content="Source code generated using layoutit.com">
        <meta name="author" content="LayoutIt!">
        <!-- Bootstrap core CSS -->        
        <link href="<?php echo Yii::app()->request->baseUrl; ?>/css/bootstrap.min.css" rel="stylesheet">
        <link href="<?php echo Yii::app()->request->baseUrl; ?>/css/style.css" rel="stylesheet">   
            
        <link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.2/themes/base/jquery-ui.css" rel="stylesheet" type="text/css" /> 

	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>
    <style>
        a{
            color: #0783af !important;
        }
        a .btn-primary{
            color: #f8f5f0 !important;
        }
        .label-success {
            background-color: #0783af !important;
        }
    </style>
<body>
    
    <div class="container-fluid">
	<div class="row">
		<div class="col-md-12">
			<nav class="navbar" style="background-color: #f8f5f0" role="navigation">
				<div class="navbar-header">
					 
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
						 <span class="glyphicon glyphicon-align-justify" aria-hidden="true"></span></span><span class="icon-bar"></span><span class="icon-bar"></span>
                                        </button>
                                        <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/logo_vozip.png"/></a>
				</div>
				
				<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
					<ul class="nav navbar-nav">						                                               
					
					<?php 
					foreach(array_keys(Yii::app()->modules) as $modulos){                                               
					   if($modulos != "gii"){
						   $info_modulo = Modulos::model()->findByPk($modulos);   
						   if(!empty($info_modulo)){
								if(Yii::app()->getModule($modulos)->padre == "" 
									&& Yii::app()->getModule($modulos)->version != 0 
									&& $info_modulo->estado != 0){                                                       
									 $padre = $modulos;
									 Yii::app()->getModule($modulos)->nombre;     
									 ?>
									 <li class="dropdown">
										 <a href="<?php echo ((Yii::app()->getModule($modulos)->desplegable)) ? '':Yii::app()->createUrl($modulos) ?>" <?php echo ((Yii::app()->getModule($modulos)->desplegable)) ? 'class="dropdown-toggle" data-toggle="dropdown"':'' ?>><?php echo Yii::app()->getModule($modulos)->nombre ?></a>                                                            
										 <ul class="dropdown-menu">
									 <?php
									 foreach(array_keys(Yii::app()->modules) as $modulos_padre)
									 {
										 if($modulos_padre != "gii")
										 {
											 $info_modulo = Modulos::model()->findByPk($modulos_padre);
											 if(!empty($info_modulo))
											 {
												if($padre == Yii::app()->getModule($modulos_padre)->padre && Yii::app()->getModule($modulos_padre)->version != 0 && $info_modulo->estado != 0)
												{
													?>                                                                                                                                        								
													<li>
														<a href="<?php echo Yii::app()->createUrl($modulos_padre) ?>"><?php echo Yii::app()->getModule($modulos_padre)->nombre; ?></a>
													</li>                                                                    								                                                                    
													<?php
												}
											 }
										 }
									 } 
								  
									 ?>
									
										  </ul>
									 </li>
									<?php
								}
							}
					   }
					} 
					?>
                                            </ul>
					<ul class="nav navbar-nav navbar-right">						
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-user"></span></a>							
							<ul class="dropdown-menu">
								<?php if(Yii::app()->user->name == "Guest") { ?>
								<li>
									<a href="<?php echo Yii::app()->createUrl("/site/login") ?>">Login</a>
								</li>
								<?php }else{ ?>
								<li>
									<a href="<?php echo Yii::app()->createUrl("/site/logout") ?>">Logout(<?php echo Yii::app()->user->name ?>)</a>
								</li>
								<?php } ?>
								<li>
									<a href="<?php echo Yii::app()->createUrl('/usuarios/default/view',array('id'=>Yii::app()->user->id)) ?>">Mi Cuenta</a>
								</li>
								<?php if($tipo == -1) { ?>
								<li>
									<a href="<?php echo Yii::app()->createUrl("/usuarios") ?>">Configuracion</a>
								</li>
								<?php }?>
							</ul>
						</li>
					</ul>
				</div>
				
			</nav>
			
		</div>
	</div>
      		
	
        <?php if(isset($this->breadcrumbs)):?>
        <ol class="breadcrumb"> 
           
            <li><a href="<?php echo Yii::app()->createUrl(Yii::app()->defaultController); ?>">Home</a></li>  
            <?php if(isset($this->breadcrumbs[0]) && isset($this->breadcrumbs[1])) { ?>
            <li><a href="<?php echo Yii::app()->createUrl($this->breadcrumbs[0]) ?>"><?php echo $this->breadcrumbs[1] ?></a></li>            
            <?php } ?>
        </ol>
        
        <?php
        foreach(Yii::app()->user->getFlashes() as $key => $message) 
        {            
            echo '<div class="alert alert-'.$key.' alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    '.$message.'.
                 </div>';
        }
        ?>
        
        <?php endif?>
	<div class="container-fluid">
		<?php echo $content ?>
	</div>
        <hr/>
        <div class="col-lg-12 text-center" style="background-color: #f8f5f0;padding: 20px;" >
            <strong>Powered By <a href="http://www.grupoingsolutions.com" target="_blank">Grupo Ingenieros Solutions</a></strong><br/>
            <strong><?php echo date('Y') ?></strong>
        </div>
</div>

    
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.min.js"></script>
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/bootstrap.min.js"></script>    
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/scripts.js"></script>              
    <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.2/jquery-ui.min.js" type="text/javascript"></script>
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.PrintArea.js"></script>
   
    
</body>
</html>
