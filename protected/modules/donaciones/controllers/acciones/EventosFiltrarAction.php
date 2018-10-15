<?php
class EventosFiltrarAction extends CAction
{
    //Reemplazar Model por el modelo que corresponda al modulo
    public function run()
    {                           
        if(isset($_GET['mes'])){
			$mes = $_GET['mes'];
		}
		else{
			$mes = '';
		}
		
		if(isset($_GET['year'])){
			$year = $_GET['year'];
		}
		else{
			$year = '';
		}
		
		$criteria = new CDbCriteria;
		
		if($year != ''){
			$criteria->addCondition('YEAR(fecha_evento) = "' . $year . '"');
		}
		
		if($mes != ''){
			$criteria->addCondition('MONTH(fecha_evento) = "' . $mes . '"');
		}
		
		$eventos = Eventos::model()->findAll($criteria);
		$lista = array();
		foreach($eventos as $ev){
			$lista[$ev['id']] = $ev['nombre_evento'] . " " . $ev['fecha_evento'];
		}

        print_r(json_encode($lista));
    }
}
?>

