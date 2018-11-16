<?php
class DonanteGuardarAction extends CAction
{
    //Reemplazar Model por el modelo que corresponda al modulo
    public function run()
    {                           
        //Carga del modelo
		$id = $_GET['id'];
		
		if($id != ''){
			$model = Donantes::model()->findByPk($id);
			$model->attributes = $_GET;
		}
		else{
			unset($_GET['id']);
			$model = new Donantes;
			$model->attributes = $_GET;
		}
		//Guardado
		if($model->save()){
			$id = $model['id'];
			print("Guardado existosamente");
			/*
			$this->controller->redirect(array(
				'vista', 'id' => $id
			));*/
		}
		else{
			print("Error al guardar");
			print_r($model);
			/*
			$this->controller->render('formulario',array(
				'icono' => $icono,
				'texto_boton' => $texto_boton,
				'parametros_get' => '',
				'model' => $model,
			));*/
		}
    }
}

