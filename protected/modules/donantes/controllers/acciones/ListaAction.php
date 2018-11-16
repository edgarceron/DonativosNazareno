<?php
class ListaAction extends CAction
{
    //Reemplazar Model por el modelo que corresponda al modulo
    public function run()
    {   
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
		
		$errores = '';
		$model = new Donantes;
		
		$criteria = new CDbCriteria;
		
		//Calculo de errores
		
		//Fin del calculo de errores
		if($errores != ''){
			$errores = '<div class="alert alert-warning" role="alert">' . $errores . '</div>';
		}
		$criteria->addCondition('id != 0');
		$criteria->addCondition('tipo_documento_donante LIKE "%' . $tipo . '%"');
		$criteria->addCondition('numero_documento_donante LIKE "%' . $documento . '%"');
		$criteria->addCondition('nombre_donante LIKE "%' . $nombres . '%"');
		$criteria->addCondition('apellido_donante LIKE "%' . $apellidos . '%"');
		$criteria->addCondition('direccion_donante LIKE "%' . $direccion . '%"');
		$criteria->addCondition('correo_donante LIKE "%' . $correo . '%"');
		$criteria->addCondition('telefono_donante LIKE "%' . $telefono . '%"');
		

        $reporte = new CActiveDataProvider($model, array('criteria' => $criteria));
		
        $this->controller->render('lista',array(
			'nombres' => $nombres,
			'apellidos' => $apellidos,
			'tipo' => $tipo,
			'documento' => $documento,
			'direccion' => $direccion,
			'correo' => $correo,
			'telefono' => $telefono,
			'errores' => $errores,
			'dataProvider' => $reporte,
        ));
    }
}

