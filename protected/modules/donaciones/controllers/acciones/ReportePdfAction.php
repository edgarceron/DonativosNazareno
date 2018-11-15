<?php
require 'vendor/autoload.php';
use Mpdf\Mpdf;

class ReportePdfAction extends CAction
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
		//echo '<pre>' . print_r($reporte , true) . '</pre>';
		if($reporte){
			$select = array(
				"principal" => array('valor_donacion'), 
				"idDonanteDonacion" => array('numero_documento_donante', 'nombre_donante', 'apellido_donante'),
				"idEvento" => array('nombre_evento', 'fecha_evento'));
			$tabla = $this->htmlTable($reporte, $select);
			$html = $this->controller->renderPartial('reportePdf',array('tabla' => $tabla), true);
		}
		else{
			$html = 'No hay datos para mostar';
		}
		
		
		$mpdf = new Mpdf();
		$mpdf->writeHTML($html);
		$mpdf->Output();
    }
	
	/*
	 * @param $records array de CActiveRecord Object
	 * @param $select array que contiene la información de las columnas a mostrar del CActiveRecord
	 * principal en la posición "principal", en las siguientes posiciones se encuentran las columnas
	 * a mostrar de las relaciones (Ver CActiveRecord 
	 * del modelo especificado, metodo "relations()"). Ejemplo:
	 * array( "principal" => array('columna1', 'columna2'), 
	 *		  "nombreRelacion1" => array('columna1', 'columna2'),
	 *	      "nombreRelacion2" => array('columna1', 'columna2'))
	 */
	
	public function htmlTable($records, $select){
		$html = '<table>';
		$html .= $this->construirHeader($this->joinHeaders(current($records), $select));
		$html .= '<tbody>';
		$contador = 1;
		foreach($records as $record){
			$html .= $this->construirColumna($this->joinContents($record, $select), $contador);
			$contador++;
		}
		$html .= '</tbody>';
		$html .= '</table>';
		return $html;
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
	 * Obtiene los td de un record con sus joins
	 * @param $record CActiveRecord object 
	 * @param $select array que contiene la información de las columnas a mostrar del CActiveRecord
	 * principal en la posición "principal", en las siguientes posiciones se encuentran las columnas
	 * a mostrar de las relaciones. Ejemplo:
	 * array( "principal" => array('columna1', 'columna2'), 
	 *		  "nombreRelacion1" => array('columna1', 'columna2'),
	 *	      "nombreRelacion2" => array('columna1', 'columna2'))
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
	 * Devuelve el html con el thead de una tabla de acuerdo a una lista de cabeceras
	 * @param @headers array con los nombres de las cabeceras
	 * @return String html con el thead de una tabla
	 */
	public function construirHeader($headers){
		$html = "<thead><tr>";
		foreach($headers as $h){
			$html .= "<th>" . $h . "</th>";
		}
		$html .= "</tr></thead>";
		return $html;
	}
	
	/**
	 * Devuelve el html con el tr de una columna de tabla de acuerdo a una lista de campos
	 * @param @contents array con los contenidos de cada td
	 * @return String html con el tr de una tabla
	 */
	public function construirColumna($contents, $contador){
		if( ($contador % 2) == 1){
			$style = "background-color: rgba(0,0,0,.05);";
		}
		else{
			$style = "background-color: rgba(0,0,0,0);";
		}
		$html = "<tr style = \"$style\">";
		foreach($contents as $h){
			$html .= "<td>" . $h . "</td>";
		}
		$html .= "</tr>";
		return $html;
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

