<?php
class ListaAction extends CAction
{
    //Reemplazar Model por el modelo que corresponda al modulo
    public function run()
    {            	
        if(isset($_GET['desde'])){
			$desde = $_GET['desde'];
		}
		else{
			$desde = date('Y-m-d');
		}
		
		if(isset($_GET['hasta'])){
			$hasta = $_GET['hasta'];
		}
		else{
			$hasta = date('Y-m-d');
		}

		if(isset($_GET['nombre'])){
			$nombre = $_GET['nombre'];
		}
		else{
			$nombre = '';
		}
		
		$errores = '';
		$model = new Eventos;
		
		$criteria = new CDbCriteria;
		
		//Calculo de errores
		
		if($desde == null && $hasta == null){
			$errores = $errores . 'Fecha desde o fecha hasta deben estar diligenciados';
		}

		//Fin del calculo de errores
		if($errores != ''){
			$errores = '<div class="alert alert-warning" role="alert">' . $errores . '</div>';
		}
		
		$criteria->addCondition('fecha_evento BETWEEN "'.$desde.'" AND DATE_ADD("'.$hasta.'", INTERVAL 1 DAY)');
		$criteria->addCondition('nombre_evento LIKE "%' . $nombre . '%"');
		$criteria->order = 'fecha_evento DESC';
		
		
		
		$reporte = new CActiveDataProvider($model, array('criteria' => $criteria));
		
        $this->controller->render('lista',array(
			'desde' => $desde,
			'hasta' => $hasta,
			'nombre' => $nombre,
			'errores' => $errores,
			'dataProvider' => $reporte,
        ));
    }
}
?>

