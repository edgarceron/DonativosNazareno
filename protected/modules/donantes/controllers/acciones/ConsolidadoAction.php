<?php
require 'vendor/autoload.php';
use Mpdf\Mpdf;

class ConsolidadoAction extends CAction
{
	public $years;
	public $donante;
	public $reporte;
	public $tipo;
	public $nombres;
	public $apellidos;
	public $direccion;
	public $correo;
	public $telefono;
	public $year;
	
    public function run()
    {  
		$this->inicializar();
		$criteria = $this->createCriteria();
		if($this->reporte == ''){
			$model = new Donantes;
			$dataProvider = new CActiveDataProvider($model, array('criteria' => $criteria));
				
			$this->controller->render('consolidado',array(
				'donante' => $this->donante,
				'nombres' => $this->nombres,
				'apellidos' => $this->apellidos,
				'tipo' => $this->tipo,
				'direccion' => $this->direccion,
				'correo' => $this->correo,
				'telefono' => $this->telefono,
				'years' => $this->years,
				'year' => $this->year,
				'dataProvider' => $dataProvider,
			));
		}
		else if($this->reporte == 'pdf'){
			$donaciones = Donantes::model()->findAll($criteria);
			if($donaciones){
				$mesesN=array(1=>"enero","febrero","marzo","abril","mayo","junio","julio",
					"agosto","septiembre","octubre","noviembre","diciembre");
				$columnas = array_merge(array('nombre_donante', 'apellido_donante'), $mesesN);
				$select = array(
					"principal" => $columnas);
				$tabla = $this->htmlTable($donaciones, $select);
				$html = $this->controller->renderPartial('reportePdf',array('tabla' => $tabla), true);
			}
			else{
				$html = 'No hay datos para mostar';
			}
			
			
			$mpdf = new Mpdf();
			$mpdf->writeHTML($html);
			$mpdf->Output();
		}
		else if($this->reporte == 'excel'){
			$donaciones = Donantes::model()->findAll($criteria);
			if($donaciones){
				$mesesN=array(1=>"enero","febrero","marzo","abril","mayo","junio","julio",
					"agosto","septiembre","octubre","noviembre","diciembre");
				$columnas = array_merge(array('nombre_donante', 'apellido_donante'), $mesesN);
				$select = array(
					"principal" => $columnas );
				$tabla = $this->arrayTable($donaciones, $select);
				Yii::import('application.extensions.phpexcel.JPhpExcel');
				$xls = new JPhpExcel('UTF-8', false, 'My Test Sheet');
				$xls->addArray($tabla);
				$xls->generateXML('reporte');
			}
			else{
				
			}
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
			if(isset($attributeLabels[$columna])){
				array_push($headers, $attributeLabels[$columna]);
			}
			else{
				array_push($headers, $columna);
			}
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
	
	public function createCriteria(){
		$mesesN=array(1=>"enero","febrero","marzo","abril","mayo","junio","julio",
             "agosto","septiembre","octubre","noviembre","diciembre");
			 
		$criteria = new CDbCriteria();
		$model = new Donantes;
		$select = "id AS idDonante , numero_documento_donante, nombre_donante, apellido_donante";
		for($month = 1; $month < count($mesesN) + 1; $month++){
			$day = cal_days_in_month(CAL_GREGORIAN, $month, $this->year);
			$fecha_inicio = $this->year . "-" . $month . "-1";
			$fecha_fin = $this->year . "-" . $month . "-" . $day;
			$mes = $mesesN[$month];
			$sql = "(SELECT IFNULL(SUM(valor_donacion), 0) as total FROM donaciones JOIN eventos 
			ON donaciones.id_evento = eventos.id 
			WHERE 
			validez_donacion = 1 AND
			fecha_evento BETWEEN '$fecha_inicio' 
			AND '$fecha_fin' AND id_donante_donacion = idDonante ) AS $mes";
			$select .= ", " . $sql;
		}
		$criteria->select = $select;
		$criteria->addCondition('id != 0');
		$criteria->addCondition('tipo_documento_donante LIKE "%' . $this->tipo . '%"');
		$criteria->addCondition('numero_documento_donante LIKE "%' . $this->donante . '%"');
		$criteria->addCondition('nombre_donante LIKE "%' . $this->nombres . '%"');
		$criteria->addCondition('apellido_donante LIKE "%' . $this->apellidos . '%"');
		$criteria->addCondition('direccion_donante LIKE "%' . $this->direccion . '%"');
		$criteria->addCondition('correo_donante LIKE "%' . $this->correo . '%"');
		$criteria->addCondition('telefono_donante LIKE "%' . $this->telefono . '%"');
		return $criteria;
	}
	
	public function inicializar(){
		
		$this->years = array(
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
		
		if(isset($_GET['donante'])){
			$this->donante = $_GET['donante'];
		}
		else{
			$this->donante = '';
		}
		
		if(isset($_GET['reporte'])){
			$this->reporte = $_GET['reporte'];
		}
		else{
			$this->reporte = '';
		}
		
		if(isset($_GET['tipo'])){
			$this->tipo = $_GET['tipo'];
		}
		else{
			$this->tipo = '';
		}
		
        if(isset($_GET['nombres'])){
			$this->nombres = $_GET['nombres'];
		}
		else{
			$this->nombres = '';
		}
		
		if(isset($_GET['apellidos'])){
			$this->apellidos = $_GET['apellidos'];
		}
		else{
			$this->apellidos = '';
		}
		
		if(isset($_GET['direccion'])){
			$this->direccion = $_GET['direccion'];
		}
		else{
			$this->direccion = '';
		}
		
		if(isset($_GET['correo'])){
			$this->correo = $_GET['correo'];
		}
		else{
			$this->correo = '';
		}
		
		if(isset($_GET['telefono'])){
			$this->telefono = $_GET['telefono'];
		}
		else{
			$this->telefono = '';
		}
		
		if(isset($_GET['year'])){
			$this->year = $_GET['year'];
		}
		else{
			$this->year = date('Y');
		}
		
	}
}

