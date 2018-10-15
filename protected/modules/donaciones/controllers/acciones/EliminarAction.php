<?php
class EliminarAction extends CAction
{
    //Reemplazar Model por el modelo que corresponda al modulo
    public function run()
    {                           
        $id = $_GET['id'];
		
		$lugar = '';
		if(isset($_GET['lugar'])){
			$lugar = $_GET['lugar'];
			
			if(isset($_GET['tipo'])){
				$tipo = $_GET['tipo'];
			}
			else{
				$tipo = '';
			}
			
			if(isset($_GET['documento'])){
				$documento = $_GET['documento'];
			}
			else{
				$documento = '';
			}
			
			if(isset($_GET['nombres'])){
				$nombres = $_GET['nombres'];
			}
			else{
				$nombres = '';
			}
			
			if(isset($_GET['apellidos'])){
				$apellidos = $_GET['apellidos'];
			}
			else{
				$apellidos = '';
			}
			
			if(isset($_GET['direccion'])){
				$direccion = $_GET['direccion'];
			}
			else{
				$direccion = '';
			}
			
			if(isset($_GET['correo'])){
				$correo = $_GET['correo'];
			}
			else{
				$correo = '';
			}
			
			if(isset($_GET['telefono'])){
				$telefono = $_GET['telefono'];
			}
			else{
				$telefono = '';
			}
		}

		$criteria = new CDbCriteria;
		$criteria->compare('id_donante_donacion',$id);
		$criteria->compare('validez_donacion', 1);
		$donaciones = Donaciones::model()->findAll($criteria);
		if(count($donaciones) > 0){
			$this->controller->redirect(array(
				'vista', 'id' => $id, 'mensaje' => '1'
			));
		}
		else{
			$model = Donantes::model()->findByPk($id);
			$model->delete();
			if($lugar == 'reporte'){
				$this->controller->redirect(
					Yii::app()->createUrl(
					"donantes/default/lista", 
					array(
					'nombres' => $nombres,
					'apellidos' => $apellidos,
					'tipo' => $tipo,
					'documento' => $documento,
					'direccion' => $direccion,
					'correo' => $correo,
					'telefono' => $telefono,)));
			}
			else{
				$this->controller->redirect(Yii::app()->createUrl("donantes"));
			}
		}
        
    }
}
?>

