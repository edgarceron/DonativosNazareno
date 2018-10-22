<?php
class VistaAction extends CAction
{
    //Reemplazar Model por el modelo que corresponda al modulo
    public function run()
    {                           
        $id = $_GET['id'];
        $model = Donaciones::model()->findByPk($id); 
		
		$errores = '';
		$mensaje = 0;
		
		if(isset($_GET['mensaje'])){
			$mensaje = $_GET['mensaje'];
		}
		
		if($mensaje == 1){
			$errores = '<div class="alert alert-danger" role="alert">El donante no se puede eliminar tiene donaciones asociadas</div>';
		}
		$evento = Eventos::model()->findByPk($model['id_evento']);
		$donante = Donantes::model()->findByPk($model['id_donante_donacion']);
		$model['id_evento'] = $evento['nombre_evento'] . " " . $evento['fecha_evento']; 
		$model['id_donante_donacion'] = $donante['nombre_donante'] . " " . $donante['apellido_donante']; 
		$model['valor_donacion'] = '$' . number_format($model['valor_donacion'], 0, ",", ".");
		
        $this->controller->render('vista',array(
			'data' => $model,
			'errores' => $errores,
        ));
    }
}
?>

