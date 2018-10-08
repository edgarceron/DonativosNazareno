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
			$desde = $_GET['desde'];
			$hasta = $_GET['hasta'];
			$nombre = $_GET['nombre'];
		}

		$criteria = new CDbCriteria;
		$criteria->compare('id_evento',$id);
		$criteria->compare('validez_donacion', 1);
		$donaciones = Donaciones::model()->findAll($criteria);
		if(count($donaciones) > 0){
			$this->controller->redirect(array(
				'vista', 'id' => $id, 'mensaje' => '1'
			));
		}
		else{
			$model = Eventos::model()->findByPk($id);
			$model->delete();
			if($lugar == 'reporte'){
				$this->controller->redirect(
					Yii::app()->createUrl(
					"eventos/default/lista", 
					array('desde' => $desde,
					'hasta' => $hasta,
					'nombre' => $nombre)));
			}
			else{
				$this->controller->redirect(Yii::app()->createUrl("eventos"));
			}
		}
        
    }
}
?>

