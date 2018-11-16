<?php
class EliminarAction extends CAction
{
    //Reemplazar Model por el modelo que corresponda al modulo
    public function run($id)
    {                      
		$donacion = Donaciones::model()->findByPk($id);
		if($donacion['validez_donacion']){
			$donacion['validez_donacion'] = 0;
			Yii::app()->user->setFlash('success', "Se ha invalidado la donación correctamente");
			$donacion->save();
			$this->controller->redirect(Yii::app()->createUrl("donaciones/default/vista/id/$id"));
		}
		else{
			$donacion['validez_donacion'] = 1;
			Yii::app()->user->setFlash('success', "Se ha activado la donación correctamente");
			$donacion->save();
			$this->controller->redirect(Yii::app()->createUrl("donaciones/default/vista/id/$id"));
		}
		
    }
}

