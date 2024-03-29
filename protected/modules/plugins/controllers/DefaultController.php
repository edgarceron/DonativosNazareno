<?php

class DefaultController extends Controller
{
        public function beforeAction($action) 
        {
            
             $acciones = Yii::app()->getController()->actions();
             

                foreach($acciones as $clave => $valor)    
                {
                    $cri_val = new CDbCriteria();
                    $cri_val->compare('modulo', $this->module->id);
                    $cri_val->compare('accion', $clave);
                    $verificar = Acciones::model()->find($cri_val);
                    if(empty($verificar))
                    {
                        $validacion = new Acciones;
                        $validacion->modulo = $this->module->id;
                        $validacion->accion = $clave;
                        $validacion->ruta = $valor;
                        $validacion->save();
                    }                    
                    
                }
                return true;
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
			'registrarplugin'=>'application.modules.'.$this->module->id.'.controllers.acciones.RegistrarpluginAction',
			'unregistrarplugin'=>'application.modules.'.$this->module->id.'.controllers.acciones.UnregistrarpluginAction',
			
		);
	}
        
    public function accessRules()
	{
		return array(	
                        				
			array('allow', // allow only the owner to perform 'view' 'update' 'delete' actions
                                'actions' => array('index','registrarplugin'),
                                'expression' => array(__CLASS__,'allowIndex'),
                            ),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
			
		);
	}
        
    public static function allowIndex()
	{		
			
            $usuario = SofintUsers::model()->findByPk(Yii::app()->user->id);
            $criteria = new CDbCriteria();            
            $modulo = 'plugins';
            $criteria->compare('perfil', $usuario->perfil);
            $criteria->compare('modulo', $modulo);
            $criteria->compare('accion', 'index');
            $permisos = PerfilContenido::model()->find($criteria);
            if(!is_null($permisos))
            {
                return true;
            }
            else
            {
                return false;
            }
			
			
        }
        
    public static function allowRegistrarplugins()
	{					
		$usuario = SofintUsers::model()->findByPk(Yii::app()->user->id);
		$criteria = new CDbCriteria();            
		$modulo = 'plugins';
		$criteria->compare('perfil', $usuario->perfil);
		$criteria->compare('modulo', $modulo);
		$criteria->compare('accion', 'registrarplugins');
		$permisos = PerfilContenido::model()->find($criteria);
		if(!is_null($permisos))
		{
			return true;
		}
		else
		{
			return false;
		}
		
	}        	               
}