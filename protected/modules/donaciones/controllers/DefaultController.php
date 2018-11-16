<?php

class DefaultController extends Controller
{
	public function beforeAction($action) 
	{
		$modulo = $this->module->id;
		$cri_val = new CDbCriteria();
		$cri_val->compare('id', $modulo);
		$verificar = Modulos::model()->find($cri_val);
		if(empty($verificar))
		{
			$model = new Modulos;
			$model->id = $modulo; 
			$model->nombre = $modulo;
			$model->estado = 1;
			$model->fecha_creacion = time();
			$model->version = 1;
			$model->desarrollador = "edgar.ceron@correounivalle.edu.co";
			$model->save();
		}
		
		$acciones = Yii::app()->getController()->actions();
		
		foreach($acciones as $clave => $valor)    
		{
			$cri_val = new CDbCriteria();
			$cri_val->compare('modulo', $modulo);
			$cri_val->compare('accion', $clave);
			$verificar = Acciones::model()->find($cri_val);
			if(empty($verificar))
			{
				$validacion = new Acciones;
				$validacion->modulo = $modulo;
				$validacion->accion = $clave;
				$validacion->ruta = $valor;
				$validacion->save();
			}                    
			DefaultController::crearPermisos($modulo, $clave);
		}
		return true;
	}
	
	public static function crearPermisos($modulo, $accion){
		if(!DefaultController::existePermiso($modulo, $accion)){
			$perfil = 1;
			$estado = 1;
			$model = new PerfilContenido;
			$model->modulo = $modulo;
			$model->controlador = $modulo;
			$model->accion = $accion;
			$model->estado = $estado;
			$model->perfil = $perfil;
			$model->fecha_creacion = time();	
			if($model->save()){
				return true;
			}
			else{
				return false;
			}
		}
		else{
			return true;
		}	
	}

	public static function existePermiso($modulo, $accion){
		$perfil = 1;
		$estado = 1;
		$criteria = new CDbCriteria();            
		$criteria->compare('perfil', $perfil);
		$criteria->compare('estado', $estado);
		$criteria->compare('modulo', $modulo);
		$criteria->compare('accion', $accion);
		$permisos = PerfilContenido::model()->find($criteria);
		if(count($permisos) == 1){
			return true;
		}
		return false;
    }
        
    public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}
        
	public function actions()
	{
		return array(
			'index'=>'application.modules.'.$this->module->id.'.controllers.acciones.IndexAction',   
			'crear'=>'application.modules.'.$this->module->id.'.controllers.acciones.CrearAction',
			'lista'=>'application.modules.'.$this->module->id.'.controllers.acciones.ListaAction',
			'editar'=>'application.modules.'.$this->module->id.'.controllers.acciones.EditarAction',
			'guardar'=>'application.modules.'.$this->module->id.'.controllers.acciones.GuardarAction', 
			'eliminar'=>'application.modules.'.$this->module->id.'.controllers.acciones.EliminarAction',  
			'vista'=>'application.modules.'.$this->module->id.'.controllers.acciones.VistaAction',                         
			'eventosFiltrar'=>'application.modules.'.$this->module->id.'.controllers.acciones.EventosFiltrarAction',                         
			'donanteCargar'=>'application.modules.'.$this->module->id.'.controllers.acciones.DonanteCargarAction',                         
			'donanteGuardar'=>'application.modules.'.$this->module->id.'.controllers.acciones.DonanteGuardarAction',                         
			'donanteTipo'=>'application.modules.'.$this->module->id.'.controllers.acciones.DonanteTipoAction',                         
			'reportePdf'=>'application.modules.'.$this->module->id.'.controllers.acciones.ReportePdfAction',                         
			'reporteExcel'=>'application.modules.'.$this->module->id.'.controllers.acciones.ReporteExcelAction',                         
		);
	}
        
    public function accessRules()
	{
		return array(	
                        				
			array('allow', // allow only the owner to perform 'view' 'update' 'delete' actions
                                'actions' => array('index'),
                                'expression' => array(__CLASS__,'allowIndex'),
                            ),
			array('allow', // allow only the owner to perform 'view' 'update' 'delete' actions
                                'actions' => array('crear'),
                                'expression' => array(__CLASS__,'allowCrear'),
                            ),
			array('allow', // allow only the owner to perform 'view' 'update' 'delete' actions
                                'actions' => array('vista'),
                                'expression' => array(__CLASS__,'allowVista'),
                            ),
			array('allow', // allow only the owner to perform 'view' 'update' 'delete' actions
                                'actions' => array('guardar'),
                                'expression' => array(__CLASS__,'allowGuardar'),
                            ),
			array('allow', // allow only the owner to perform 'view' 'update' 'delete' actions
                                'actions' => array('editar'),
                                'expression' => array(__CLASS__,'allowEditar'),
                            ),
			array('allow', // allow only the owner to perform 'view' 'update' 'delete' actions
                                'actions' => array('lista'),
                                'expression' => array(__CLASS__,'allowLista'),
                            ),
			array('allow', // allow only the owner to perform 'view' 'update' 'delete' actions
                                'actions' => array('eliminar'),
                                'expression' => array(__CLASS__,'allowElminar'),
                            ),
			array('allow', // allow only the owner to perform 'view' 'update' 'delete' actions
                                'actions' => array('eventosFiltrar'),
                                'expression' => array(__CLASS__,'allowEventosFiltrar'),
                            ),
			array('allow', // allow only the owner to perform 'view' 'update' 'delete' actions
                                'actions' => array('donanteCargar'),
                                'expression' => array(__CLASS__,'allowDonanteCargar'),
                            ),
			array('allow', // allow only the owner to perform 'view' 'update' 'delete' actions
                                'actions' => array('donanteGuardar'),
                                'expression' => array(__CLASS__,'allowDonanteGuardar'),
                            ),
			array('allow', // allow only the owner to perform 'view' 'update' 'delete' actions
                                'actions' => array('donanteTipo'),
                                'expression' => array(__CLASS__,'allowDonanteTipo'),
                            ),
			array('allow', // allow only the owner to perform 'view' 'update' 'delete' actions
                                'actions' => array('reportePdf'),
                                'expression' => array(__CLASS__,'allowReportePdf'),
                            ),
			array('allow', // allow only the owner to perform 'view' 'update' 'delete' actions
                                'actions' => array('reporteExcel'),
                                'expression' => array(__CLASS__,'allowReporteExcel'),
                            ),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
			
		);
	}
        
    public static function allowIndex()
	{
		$accion = 'index'; //Cambiar esto cada ves que lo copie para una accion diferente
		if(Yii::app()->user->name != "Guest"){
			$usuario = SofintUsers::model()->findByPk(Yii::app()->user->id);
			$criteria = new CDbCriteria();            
			$modulo = 'donaciones';
			$criteria->compare('perfil', $usuario->perfil);
			$criteria->compare('modulo', $modulo);
			$criteria->compare('accion', $accion);
			$permisos = PerfilContenido::model()->find($criteria);
			if(count($permisos) == 1)
			{
				$criteria_log = new CDbCriteria();
				$criteria_log->compare('modulo', $modulo);
				$criteria_log->compare('accion', $accion); 
				$accion_log = Acciones::model()->find($criteria_log);
				$log = new Logs;
				$log->accion = $accion_log->id;
				$log->usuario = Yii::app()->user->id;
				$log->save();
				return true;
			}
			else
			{
				return false;
			}
		}
		else
		{
			return false;
		}
	}
	
	public static function allowCrear()
	{
		$accion = 'crear'; //Cambiar esto cada ves que lo copie para una accion diferente
		if(Yii::app()->user->name != "Guest"){
			$usuario = SofintUsers::model()->findByPk(Yii::app()->user->id);
			$criteria = new CDbCriteria();            
			$modulo = 'donaciones';
			$criteria->compare('perfil', $usuario->perfil);
			$criteria->compare('modulo', $modulo);
			$criteria->compare('accion', $accion);
			$permisos = PerfilContenido::model()->find($criteria);
			if(count($permisos) == 1)
			{
				$criteria_log = new CDbCriteria();
				$criteria_log->compare('modulo', $modulo);
				$criteria_log->compare('accion', $accion); 
				$accion_log = Acciones::model()->find($criteria_log);
				$log = new Logs;
				$log->accion = $accion_log->id;
				$log->usuario = Yii::app()->user->id;
				$log->save();
				return true;
			}
			else
			{
				return false;
			}
		}
		else
		{
			return false;
		}
	}
	
	public static function allowVista()
	{
		$accion = 'vista'; //Cambiar esto cada ves que lo copie para una accion diferente
		if(Yii::app()->user->name != "Guest"){
			$usuario = SofintUsers::model()->findByPk(Yii::app()->user->id);
			$criteria = new CDbCriteria();            
			$modulo = 'donaciones';
			$criteria->compare('perfil', $usuario->perfil);
			$criteria->compare('modulo', $modulo);
			$criteria->compare('accion', $accion);
			$permisos = PerfilContenido::model()->find($criteria);
			if(count($permisos) == 1)
			{
				$criteria_log = new CDbCriteria();
				$criteria_log->compare('modulo', $modulo);
				$criteria_log->compare('accion', $accion); 
				$accion_log = Acciones::model()->find($criteria_log);
				$log = new Logs;
				$log->accion = $accion_log->id;
				$log->usuario = Yii::app()->user->id;
				$log->save();
				return true;
			}
			else
			{
				return false;
			}
		}
		else
		{
			return false;
		}
	}
	
	public static function allowGuardar()
	{
		$accion = 'guardar'; //Cambiar esto cada ves que lo copie para una accion diferente
		if(Yii::app()->user->name != "Guest"){
			$usuario = SofintUsers::model()->findByPk(Yii::app()->user->id);
			$criteria = new CDbCriteria();            
			$modulo = 'donaciones';
			$criteria->compare('perfil', $usuario->perfil);
			$criteria->compare('modulo', $modulo);
			$criteria->compare('accion', $accion);
			$permisos = PerfilContenido::model()->find($criteria);
			if(count($permisos) == 1)
			{
				$criteria_log = new CDbCriteria();
				$criteria_log->compare('modulo', $modulo);
				$criteria_log->compare('accion', $accion); 
				$accion_log = Acciones::model()->find($criteria_log);
				$log = new Logs;
				$log->accion = $accion_log->id;
				$log->usuario = Yii::app()->user->id;
				$log->save();
				return true;
			}
			else
			{
				return false;
			}
		}
		else
		{
			return false;
		}
	}
	
	public static function allowEditar()
	{
		$accion = 'editar'; //Cambiar esto cada ves que lo copie para una accion diferente
		if(Yii::app()->user->name != "Guest"){
			$usuario = SofintUsers::model()->findByPk(Yii::app()->user->id);
			$criteria = new CDbCriteria();            
			$modulo = 'donaciones';
			$criteria->compare('perfil', $usuario->perfil);
			$criteria->compare('modulo', $modulo);
			$criteria->compare('accion', $accion);
			$permisos = PerfilContenido::model()->find($criteria);
			if(count($permisos) == 1)
			{
				$criteria_log = new CDbCriteria();
				$criteria_log->compare('modulo', $modulo);
				$criteria_log->compare('accion', $accion); 
				$accion_log = Acciones::model()->find($criteria_log);
				$log = new Logs;
				$log->accion = $accion_log->id;
				$log->usuario = Yii::app()->user->id;
				$log->save();
				return true;
			}
			else
			{
				return false;
			}
		}
		else
		{
			return false;
		}
	}
	
	public static function allowLista()
	{
		$accion = 'lista'; //Cambiar esto cada ves que lo copie para una accion diferente
		if(Yii::app()->user->name != "Guest"){
			$usuario = SofintUsers::model()->findByPk(Yii::app()->user->id);
			$criteria = new CDbCriteria();            
			$modulo = 'donaciones';
			$criteria->compare('perfil', $usuario->perfil);
			$criteria->compare('modulo', $modulo);
			$criteria->compare('accion', $accion);
			$permisos = PerfilContenido::model()->find($criteria);
			if(count($permisos) == 1)
			{
				$criteria_log = new CDbCriteria();
				$criteria_log->compare('modulo', $modulo);
				$criteria_log->compare('accion', $accion); 
				$accion_log = Acciones::model()->find($criteria_log);
				$log = new Logs;
				$log->accion = $accion_log->id;
				$log->usuario = Yii::app()->user->id;
				$log->save();
				return true;
			}
			else
			{
				return false;
			}
		}
		else
		{
			return false;
		}
	}
	
	public static function allowElminar()
	{
		$accion = 'eliminar'; //Cambiar esto cada ves que lo copie para una accion diferente
		if(Yii::app()->user->name != "Guest"){
			$usuario = SofintUsers::model()->findByPk(Yii::app()->user->id);
			$criteria = new CDbCriteria();            
			$modulo = 'donaciones';
			$criteria->compare('perfil', $usuario->perfil);
			$criteria->compare('modulo', $modulo);
			$criteria->compare('accion', $accion);
			$permisos = PerfilContenido::model()->find($criteria);
			if(count($permisos) == 1)
			{
				$criteria_log = new CDbCriteria();
				$criteria_log->compare('modulo', $modulo);
				$criteria_log->compare('accion', $accion); 
				$accion_log = Acciones::model()->find($criteria_log);
				$log = new Logs;
				$log->accion = $accion_log->id;
				$log->usuario = Yii::app()->user->id;
				$log->save();
				return true;
			}
			else
			{
				return false;
			}
		}
		else
		{
			return false;
		}
	}
	
	public static function allowEventosFiltrar()
	{
		$accion = 'eventosFiltrar'; //Cambiar esto cada ves que lo copie para una accion diferente
		if(Yii::app()->user->name != "Guest"){
			$usuario = SofintUsers::model()->findByPk(Yii::app()->user->id);
			$criteria = new CDbCriteria();            
			$modulo = 'donaciones';
			$criteria->compare('perfil', $usuario->perfil);
			$criteria->compare('modulo', $modulo);
			$criteria->compare('accion', $accion);
			$permisos = PerfilContenido::model()->find($criteria);
			if(count($permisos) == 1)
			{
				$criteria_log = new CDbCriteria();
				$criteria_log->compare('modulo', $modulo);
				$criteria_log->compare('accion', $accion); 
				$accion_log = Acciones::model()->find($criteria_log);
				$log = new Logs;
				$log->accion = $accion_log->id;
				$log->usuario = Yii::app()->user->id;
				$log->save();
				return true;
			}
			else
			{
				return false;
			}
		}
		else
		{
			return false;
		}
	}
	
	public static function allowDonanteCargar()
	{
		$accion = 'donanteCargar'; //Cambiar esto cada ves que lo copie para una accion diferente
		if(Yii::app()->user->name != "Guest"){
			$usuario = SofintUsers::model()->findByPk(Yii::app()->user->id);
			$criteria = new CDbCriteria();            
			$modulo = 'donaciones';
			$criteria->compare('perfil', $usuario->perfil);
			$criteria->compare('modulo', $modulo);
			$criteria->compare('accion', $accion);
			$permisos = PerfilContenido::model()->find($criteria);
			if(count($permisos) == 1)
			{
				$criteria_log = new CDbCriteria();
				$criteria_log->compare('modulo', $modulo);
				$criteria_log->compare('accion', $accion); 
				$accion_log = Acciones::model()->find($criteria_log);
				$log = new Logs;
				$log->accion = $accion_log->id;
				$log->usuario = Yii::app()->user->id;
				$log->save();
				return true;
			}
			else
			{
				return false;
			}
		}
		else
		{
			return false;
		}
	}
	
	public static function allowDonanteGuardar()
	{
		$accion = 'donanteGuardar'; //Cambiar esto cada ves que lo copie para una accion diferente
		if(Yii::app()->user->name != "Guest"){
			$usuario = SofintUsers::model()->findByPk(Yii::app()->user->id);
			$criteria = new CDbCriteria();            
			$modulo = 'donaciones';
			$criteria->compare('perfil', $usuario->perfil);
			$criteria->compare('modulo', $modulo);
			$criteria->compare('accion', $accion);
			$permisos = PerfilContenido::model()->find($criteria);
			if(count($permisos) == 1)
			{
				$criteria_log = new CDbCriteria();
				$criteria_log->compare('modulo', $modulo);
				$criteria_log->compare('accion', $accion); 
				$accion_log = Acciones::model()->find($criteria_log);
				$log = new Logs;
				$log->accion = $accion_log->id;
				$log->usuario = Yii::app()->user->id;
				$log->save();
				return true;
			}
			else
			{
				return false;
			}
		}
		else
		{
			return false;
		}
	}
	
	public static function allowDonanteTipo()
	{
		$accion = 'donanteTipo'; //Cambiar esto cada ves que lo copie para una accion diferente
		if(Yii::app()->user->name != "Guest"){
			$usuario = SofintUsers::model()->findByPk(Yii::app()->user->id);
			$criteria = new CDbCriteria();            
			$modulo = 'donaciones';
			$criteria->compare('perfil', $usuario->perfil);
			$criteria->compare('modulo', $modulo);
			$criteria->compare('accion', $accion);
			$permisos = PerfilContenido::model()->find($criteria);
			if(count($permisos) == 1)
			{
				$criteria_log = new CDbCriteria();
				$criteria_log->compare('modulo', $modulo);
				$criteria_log->compare('accion', $accion); 
				$accion_log = Acciones::model()->find($criteria_log);
				$log = new Logs;
				$log->accion = $accion_log->id;
				$log->usuario = Yii::app()->user->id;
				$log->save();
				return true;
			}
			else
			{
				return false;
			}
		}
		else
		{
			return false;
		}
	}
	
	public static function allowReportePdf()
	{
		$accion = 'reportePdf'; //Cambiar esto cada ves que lo copie para una accion diferente
		if(Yii::app()->user->name != "Guest"){
			$usuario = SofintUsers::model()->findByPk(Yii::app()->user->id);
			$criteria = new CDbCriteria();            
			$modulo = 'donaciones';
			$criteria->compare('perfil', $usuario->perfil);
			$criteria->compare('modulo', $modulo);
			$criteria->compare('accion', $accion);
			$permisos = PerfilContenido::model()->find($criteria);
			if(count($permisos) == 1)
			{
				$criteria_log = new CDbCriteria();
				$criteria_log->compare('modulo', $modulo);
				$criteria_log->compare('accion', $accion); 
				$accion_log = Acciones::model()->find($criteria_log);
				$log = new Logs;
				$log->accion = $accion_log->id;
				$log->usuario = Yii::app()->user->id;
				$log->save();
				return true;
			}
			else
			{
				return false;
			}
		}
		else
		{
			return false;
		}
	}
	
	public static function allowReporteExcel()
	{
		$accion = 'reporteExcel'; //Cambiar esto cada ves que lo copie para una accion diferente
		if(Yii::app()->user->name != "Guest"){
			$usuario = SofintUsers::model()->findByPk(Yii::app()->user->id);
			$criteria = new CDbCriteria();            
			$modulo = 'donaciones';
			$criteria->compare('perfil', $usuario->perfil);
			$criteria->compare('modulo', $modulo);
			$criteria->compare('accion', $accion);
			$permisos = PerfilContenido::model()->find($criteria);
			if(count($permisos) == 1)
			{
				$criteria_log = new CDbCriteria();
				$criteria_log->compare('modulo', $modulo);
				$criteria_log->compare('accion', $accion); 
				$accion_log = Acciones::model()->find($criteria_log);
				$log = new Logs;
				$log->accion = $accion_log->id;
				$log->usuario = Yii::app()->user->id;
				$log->save();
				return true;
			}
			else
			{
				return false;
			}
		}
		else
		{
			return false;
		}
	}
}