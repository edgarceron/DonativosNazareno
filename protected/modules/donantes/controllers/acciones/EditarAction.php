<?php
class EditarAction extends CAction
{
    //Reemplazar Model por el modelo que corresponda al modulo
    public function run()
    {                           
        $id = $_GET['id'];
        $model = Donantes::model()->findByPk($id); 
		
        $this->controller->render('formulario',array(
			'icono' => '/images/edit64.png',
			'texto_boton' => 'Guardar',
			'parametros_get' => '?id='.$id,
			'model' => $model,
        ));
    }
}
?>

