<?php
class EditarAction extends CAction
{
    //Reemplazar Model por el modelo que corresponda al modulo
    public function run(){           
	
        $id = $_GET['id'];
        $model = Donaciones::model()->findByPk($id); 
		$model['id_donante_donacion'] = $this->getDonante($model['id_donante_donacion']);
		$eventos = $this->getEventos($model['id_evento']);
		
		$meses = array(
			"" => "--",
			"01" => "Enero", 
			"02" => "Febrero", 
			"03" => "Marzo", 
			"04" => "Abril", 
			"05" => "Mayo", 
			"06" => "Junio", 
			"07" => "Julio",
			"08" => "Agosto",
			"09" => "Septiembre",
			"10" => "Octubre",
			"11" => "Noviembre",
			"12" => "Diciembre",
			);
		
		$years = array(
			"" => "--",
			"2018" => "2018",
			"2019" => "2019",
			"2020" => "2020",
			"2021" => "2021",
			"2021" => "2021",
			"2022" => "2022",
			"2023" => "2023",
			"2024" => "2024",
			"2025" => "2025",
			"2026" => "2026",
			"2027" => "2027",
			"2028" => "2028",
		);
		
		$mensaje = '';
		
       $this->controller->render('formulario',array(
			'icono' => '/images/new64.png',
			'texto_boton' => 'Crear',
			'parametros_get' => '',
			'meses' => $meses,
			'years' => $years,
			'eventos' => $eventos,
			'mensaje' => $mensaje,
			'model' => $model,
        ));
    }
	
	public function getEventos($id = 0){
		if($id != 0){
			$evento = Eventos::model()->findByPk($id);
			$fecha = $evento['fecha_evento'];
			$aux = explode('-', $fecha);
			$y = $aux[0];
			$m = $aux[1];
		}
		else{
			$y = date('Y');
			$m = date('m');
		}
		$criteria = new CDbCriteria;
		$criteria->addCondition('YEAR(fecha_evento) = "' . $y . '"');
		$criteria->addCondition('MONTH(fecha_evento) = "' . $m . '"');
		
		$eventos = Eventos::model()->findAll($criteria);
		$lista = array();
		$lista[""] = "--";
		foreach($eventos as $ev){
			$lista[$ev['id']] = $ev['nombre_evento'] . " " . $ev['fecha_evento'];
		}
		return $lista;
	}
	
	public function getDonante($id_donante){
		$donante = Donantes::model()->findByPk($id_donante);
		return $donante['numero_documento_donante'];
	}
}
?>

