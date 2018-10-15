<?php
class ListaAction extends CAction
{
    //Reemplazar Model por el modelo que corresponda al modulo
    public function run()
    {   
	
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
		
		$eventos = $this->getEventos();
			
			
		if(isset($_GET['evento'])){
			$evento = $_GET['evento'];
		}
		else{
			$evento = '';
		}
		
		if(isset($_GET['donante'])){
			$donante = $_GET['donante'];
		}
		else{
			$donante = '';
		}
		
		if(isset($_GET['minimo'])){
			$minimo = $_GET['minimo'];
		}
		else{
			$minimo = '';
		}
		
		if(isset($_GET['maximo'])){
			$maximo = $_GET['maximo'];
		}
		else{
			$maximo = '';
		}
		
		
		
		$errores = '';
		$model = new Donaciones;
		
		$criteria = new CDbCriteria;
		$criteria->with = array(
			'idDonanteDonacion' => array(
				'alias'=> 't1', 
				'together' => true,
				'select' => array('t1.nombre_donante', 't1.apellido_donante'),
			),
		);
		
		$criteria->with = array(
			'idEvento' => array(
				'alias'=> 't2', 
				'together' => true,
				'select' => array('t2.nombre_evento', 't2.fecha_evento'),
			),
		);
		
		//Calculo de errores
		if($minimo != '' && !is_numeric($minimo)){
			$minimo = 0;
			$errores = $errores + "- Desde debe ser un valor numerico<br>";
		}
		if($maximo != '' && !is_numeric($maximo)){
			$maximo = 0;
			$errores = $errores + "- Hasta debe ser un valor numerico<br>";
		}
		//Fin del calculo de errores
		if($errores != ''){
			$errores = '<div class="alert alert-warning" role="alert">' . $errores . '</div>';
		}
		
		if($evento != 0) $criteria->compare('id_evento', $evento);
		$criteria->addCondition('id_donante_donacion IN (SELECT id FROM donantes WHERE numero_documento_donante LIKE "%' . $donante . '%") 
			OR id_representante_donacion IN (SELECT id FROM donantes WHERE numero_documento_donante LIKE "%' . $donante . '%")');
		
		if($minimo == ''){
			$min = -1;
		}
		else{
			$min = $minimo;
		}
		
		if($maximo == ''){
			$max = 1000000000;
		}
		else{
			$max = $maximo;
		}
		
		$criteria->addCondition('valor_donacion > ' . $min . ' AND valor_donacion < ' . $max);

		
        $reporte = new CActiveDataProvider($model, array('criteria' => $criteria));
		
        $this->controller->render('lista',array(
			'evento' => $evento,
			'donante' => $donante,
			'minimo' => $minimo,
			'maximo' => $maximo,
			'errores' => $errores,
			'meses' => $meses,
			'years' => $years,
			'eventos' => $eventos,
			'dataProvider' => $reporte,
        ));
    }
	
	/**
	 * Filtra los eventos del mes y año actual
	 * @return array Lista de eventos
	 */
	public function getEventos(){
		$criteria = new CDbCriteria;
		$criteria->addCondition('YEAR(fecha_evento) = "' . date('Y') . '"');
		$criteria->addCondition('MONTH(fecha_evento) = "' . date('m') . '"');
		
		$eventos = Eventos::model()->findAll($criteria);
		$lista = array();
		$lista[""] = "--";
		foreach($eventos as $ev){
			$lista[$ev['id']] = $ev['nombre_evento'] . " " . $ev['fecha_evento'];
		}
		return $lista;
	}
}
?>

