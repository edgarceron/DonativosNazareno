<?php

class ReporteExcelAction extends CAction
{
    //Reemplazar Model por el modelo que corresponda al modulo
    public function run()
    {                     
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
		
		if(isset($_GET['anuladas'])){
			$anuladas = $_GET['anuladas'];
		}
		else{
			$anuladas = 0;
		}
		
		
		$criteria = $this->createCriteria($evento, $donante, $minimo, $maximo, $desde, $hasta, $anuladas); 
        $reporte = Donaciones::model()->findAll($criteria);
		if($reporte){
			$select = array(
				"principal" => array('valor_donacion'), 
				"idDonanteDonacion" => array('numero_documento_donante', 'nombre_donante', 'apellido_donante'),
				"idEvento" => array('nombre_evento', 'fecha_evento'));
			$tabla = $this->arrayTable($reporte, $select);
			Yii::import('application.extensions.phpexcel.JPhpExcel');
			$xls = new JPhpExcel('UTF-8', false, 'My Test Sheet');
			$xls->addArray($tabla);
			$xls->generateXML('reporte');
		}
		else{
			
		}
		
    }
	
	/*
	 * Construye un array a partir de un conjunto de datos 
	 * @param $records array de CActiveRecord Object
	 * @param $select array que contiene la información de las columnas a mostrar del CActiveRecord
	 * principal en la posición "principal", en las siguientes posiciones se encuentran las columnas
	 * a mostrar de las relaciones (Ver CActiveRecord 
	 * del modelo especificado, metodo "relations()"). Ejemplo:
	 * array( "principal" => array('columna1', 'columna2'), 
	 *		  "nombreRelacion1" => array('columna1', 'columna2'),
	 *	      "nombreRelacion2" => array('columna1', 'columna2'))
	 * @return array con cabeceras y datos, cada array representa una fila
	 */
	
	public function arrayTable($records, $select){
		$table = array();
		$headers = $this->joinHeaders(current($records), $select);
		$table[1] = $headers;
		$contador = 2;
		foreach($records as $record){
			$table[$contador] = $this->joinContents($record, $select);
			$contador++;
		}
		return $table;
	}
	
	/**
	 * Obtiene los headers de un record con sus joins
	 * @param $record CActiveRecord object 
	 * @param $select array que contiene la información de las columnas a mostrar del CActiveRecord
	 * principal en la posición "principal", en las siguientes posiciones se encuentran las columnas
	 * a mostrar de las relaciones. Ejemplo:
	 * array( "principal" => array('columna1', 'columna2'), 
	 *		  "nombreRelacion1" => array('columna1', 'columna2'),
	 *	      "nombreRelacion2" => array('columna1', 'columna2'))
	 * @return array con los headers a mostrar
	 */
	
	public function joinHeaders($record, $select){
		$headers = array();
		$relaciones = array_keys($select);
		foreach($relaciones as $relacion){
			if($relacion == 'principal'){
				$r = $record;
			}
			else{
				$r = $record[$relacion];
			}
			$s = $select[$relacion];
			$labels = $r->attributeLabels();
			$headers = array_merge($headers, $this->obtainHeaders($labels, $s));
		}
		return $headers;
	}
	
	/**
	 * Obtiene las columnas en forma de array a partir de de un record con sus joins
	 * @param $record CActiveRecord object 
	 * @param $select array que contiene la información de las columnas a mostrar del CActiveRecord
	 * principal en la posición "principal", en las siguientes posiciones se encuentran las columnas
	 * a mostrar de las relaciones. Ejemplo:
	 * array( "principal" => array('columna1', 'columna2'), 
	 *		  "nombreRelacion1" => array('columna1', 'columna2'),
	 *	      "nombreRelacion2" => array('columna1', 'columna2'))
	 * @return array cos los datos a mostrar
	 */
	
	public function joinContents($record, $select){
		$columns = array();
		$relaciones = array_keys($select);
		foreach($relaciones as $relacion){
			if($relacion == 'principal'){
				$r = $record;
			}
			else{
				$r = $record[$relacion];
			}
			$s = $select[$relacion];
			$columns = array_merge($columns, $this->obtainContents($r, $s));
		}
		return $columns;
	}
	
	
	/**
	 * Obtiene la información de las celdas a crear para una fila
	 * @param $record CActiveRecord object con los datos del registro
	 * @param $select array con las columnas a utilizar
	 * @return array con el contenido de los campos
	 */
	 
	public function obtainContents($record, $select){
		$contents = array();
		foreach($select as $columna){
			array_push($contents, $record[$columna]);
		}
		return $contents;
	}
	/**
	 * Obtiene los nombres de la columnas para la cabecera
	 * @param $attributeLabels array con las etiquetas para cada columna de la tabla
	 * @param $select array con las columnas a utilizar
	 * @return array con las etiquetas para las cabeceras;
	 */
	public function obtainHeaders($attributeLabels, $select){
		$headers = array();
		foreach($select as $columna){
			array_push($headers, $attributeLabels[$columna]);
		}
		return $headers;
	}
	
	/**
	 * Crea un objeto CDbCriteria de acuerdo a las condiciones de entrada
	 * @param $evento int Id del evento
	 * @param $donante String que contiene de forma parcial o total el documento de un donante
	 * @param $minimo int Valor minimo de las donaciones a filtrar
	 * @param $maximo int Valor maximo de las donaciones a filtrar
	 * @param $desde String Fecha en formato dd/mm/aaaa que contiene la fecha más antigua desde la cual
	 * se buscaran donaciones.
	 * @param $hasta String Fecha en formato dd/mm/aaaa que contiene la fecha más actual hasta la cual
	 * se buscaran donaciones.
	 * @return CDbCriteria object
	 */
	public function createCriteria($evento, $donante, $minimo, $maximo, $desde, $hasta, $anuladas){
		$errores = '';
		
		$criteria = new CDbCriteria;
		
		$criteria->with = array(
			'idDonanteDonacion' => array(
				'alias'=> 't1', 
				'together' => true,
				'select' => array('t1.nombre_donante', 't1.apellido_donante', 't1.numero_documento_donante'),
			),
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
		
		if($anuladas == 0){
			$criteria->compare('validez_donacion', 1);
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
		
		if($desde != '' && $hasta != ''){
			$criteria->addCondition('t2.fecha_evento BETWEEN "'.$desde.'" AND DATE_ADD("'.$hasta.'", INTERVAL 1 DAY)');
		}
		else if($desde != ''){
			$criteria->addCondition('t2.fecha_evento > "'.$desde.'"');
		}
		else if($hasta != ''){
			$criteria->addCondition('t2.fecha_evento < "'.$hasta.'"');
		}
		
		return $criteria;
	}
}
?>

