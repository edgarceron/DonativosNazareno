<?php
class GuardarEventoAction extends CAction
{
    //Reemplazar Model por el modelo que corresponda al modulo
    public function run()
    {                           
		//Carga del modelo
		if(isset($_GET['id'])){
			$id = $_GET['id'];
			$model = Eventos::model()->findByPk($id); 
			$icono = '/images/edit64.png';
		}
		else{
			$model = new Eventos;
			$icono = '/images/new64.png';
		}
		
		//Añadiendo datos al modelo
		$model->attributes=$_POST['Eventos'];
		
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
				'texto_boton' => 'Crear',
				'parametros_get' => '',
				'model' => $model,
			));
		}
    }
}
?>

