<?php
class GuardarAction extends CAction
{
    //Reemplazar Model por el modelo que corresponda al modulo
    public function run()
    {                           
        //Carga del modelo
		if(isset($_GET['id'])){
			$id = $_GET['id'];
			$model = Donantes::model()->findByPk($id); 
			$icono = '/images/edit64.png';
			$texto_boton = 'Guardar';
		}
		else{
			$model = new Donantes;
			$icono = '/images/new64.png';
			$texto_boton = 'Crear';
		}
		
		//Añadiendo datos al modelo
		$model->attributes=$_POST['Donantes'];
		
		//Guardado
		if($model->save()){
			$id = $model['id'];
			$this->controller->redirect(array(
				'vista', 'id' => $id
			));
		}
		else{
			$this->controller->render('formulario',array(
				'icono' => $icono,
				'texto_boton' => $texto_boton,
				'parametros_get' => '',
				'model' => $model,
			));
		}
    }
}
?>

