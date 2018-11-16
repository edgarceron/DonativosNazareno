<?php
class VistaAction extends CAction
{
    //Reemplazar Model por el modelo que corresponda al modulo
    public function run()
    {                           
        $id = $_GET['id'];
        $model = Donantes::model()->findByPk($id); 
		
		if(isset($_GET['desde'])){
			$desde = $_GET['desde'];
		}
		else{
			$desde = '';
		}
		
		if(isset($_GET['hasta'])){
			$hasta = $_GET['hasta'];
		}
		else{
			$hasta = '';
		}
		
		$errores = '';
		$criteria = new CDbCriteria;
		
		$criteria->with = array(
			'idEvento' => array(
				'alias'=> 't2', 
				'together' => true,
				'select' => array('t2.nombre_evento', 't2.fecha_evento'),
			),
		);
		$criteria->compare('id_donante_donacion', $model['id']);
		$criteria->compare('validez_donacion', 1);
		if($desde != '' && $hasta != ''){
			$criteria->addCondition('t2.fecha_evento BETWEEN "'.$desde.'" AND DATE_ADD("'.$hasta.'", INTERVAL 1 DAY)');
		}
		else if($desde != ''){
			$criteria->addCondition('t2.fecha_evento > "'.$desde.'"');
		}
		else if($hasta != ''){
			$criteria->addCondition('t2.fecha_evento < "'.$hasta.'"');
		}
		
		
        $reporte = new CActiveDataProvider(new Donaciones, array('criteria' => $criteria));
		
		$mensaje = 0;
		
		if(isset($_GET['mensaje'])){
			$mensaje = $_GET['mensaje'];
			if($mensaje == 1){
				Yii::app()->user->setFlash('danger', 'El donante no se puede eliminar tiene donaciones asociadas');
			}
		}
		
		
		

        $this->controller->render('vista',array(
			'data' => $model,
			'errores' => $errores,
			'desde' => $desde,
			'hasta' => $hasta,
			'id' => $id,
			'dataProvider' => $reporte,
        ));
    }
}

