<?php
class ReporteDianAction extends CAction
{
    //Reemplazar Model por el modelo que corresponda al modulo
    public function run()
    {                     
		$datos = array();
        if(isset$_POST['year']){
			$year = $_POST['year'];
		}
		
		$com = "SELECT donantes.*, SUM(valor_donacion) FROM donaciones JOIN donantes 
		ON donaciones.id_donante_donacion = donantes.id JOIN eventos 
		ON donaciones.id_evento = eventos.id WHERE eventos.fecha_evento 
		BETWEEN \"$year-01-01\" AND \"$year-12-01\"";
		
		$lineas = Yii::app()->tienda->createCommand($com)->queryAll();;

        $this->controller->render('index',array(

        ));
    }
}

