<?php
class VistaAction extends CAction
{
    //Reemplazar Model por el modelo que corresponda al modulo
    public function run()
    {                           
        $id = $_GET['id'];
        $model = Eventos::model()->findByPk($id); 
		
		$errores = '';
		$mensaje = 0;
		
		if(isset($_GET['mensaje'])){
			$mensaje = $_GET['mensaje'];
		}
		
		if($mensaje == 1){
			$errores = '<div class="alert alert-danger" role="alert">El evento no se puede eliminar tiene donaciones asociadas</div>';
		}
		

        $this->controller->render('vista',array(
			'data' => $model,
			'errores' => $errores,
        ));
    }
}
?>

