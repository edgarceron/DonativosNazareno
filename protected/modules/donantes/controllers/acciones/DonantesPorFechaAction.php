<?php
require 'vendor/autoload.php';
use Mpdf\Mpdf;

class DonantesPorFechaAction extends CAction
{
	public $meses;
	public $years;
	public $donante;
	public $desde;
	public $hasta;
	public $reporte;
    //Reemplazar Model por el modelo que corresponda al modulo
    public function run()
    {   
		$this->inicializar();
	
		$errores = '';
		$model = new Donaciones;
		$criteria = $this->createCriteria();
		
		if($this->reporte == ''){
			$dataProvider = new CActiveDataProvider($model, array('criteria' => $criteria));
			
			$this->controller->render('donantesPorFecha',array(
				'donante' => $this->donante,
				'desde' => $this->desde,
				'hasta' => $this->hasta,
				'errores' => $errores,
				'meses' => $this->meses,
				'years' => $this->years,
				'dataProvider' => $dataProvider,
			));
		}
		else if($this->reporte == 'pdf'){
			$donaciones = Donaciones::model()->findAll($criteria);
			if($donaciones){
				$select = array(
					"idDonanteDonacion" => array('numero_documento_donante', 'nombre_donante', 'apellido_donante'),
					"idEvento" => array(),
					"principal" => array('valor_donacion'));
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
			$donaciones = Donaciones::model()->findAll($criteria);
			if($donaciones){
				$select = array(
					"idDonanteDonacion" => array('nombre_donante', 'apellido_donante'),
					"idEvento" => array(),
					"principal" => array('valor_donacion') );
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
	
	/**
	 * Crea un objeto CDbCriteria de acuerdo a las condiciones de entrada
	 * @return CDbCriteria object
	 */
	public function createCriteria(){
		$criteria = new CDbCriteria;
		
		$criteria->select = 'id_donante_donacion, SUM(valor_donacion) as valor_donacion';
		$criteria->group = 'id_donante_donacion';
		$criteria->order = 'valor_donacion DESC';
		
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

		$criteria->compare('validez_donacion', 1);
		$criteria->addCondition('id_donante_donacion IN (SELECT id FROM donantes WHERE numero_documento_donante LIKE "%' . $this->donante . '%") 
			OR id_representante_donacion IN (SELECT id FROM donantes WHERE numero_documento_donante LIKE "%' . $this->donante . '%")');
		
		
		if($this->desde != '' && $this->hasta != ''){
			$criteria->addCondition('t2.fecha_evento BETWEEN "'.$this->desde.'" AND DATE_ADD("'.$this->hasta.'", INTERVAL 1 DAY)');
		}
		else if($this->desde != ''){
			$criteria->addCondition('t2.fecha_evento > "'.$this->desde.'"');
		}
		else if($this->hasta != ''){
			$criteria->addCondition('t2.fecha_evento < "'.$this->hasta.'"');
		}
		
		return $criteria;
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
	 * Inicializa las variables de la acción
	 */
	
	public function inicializar(){
		$this->meses = array(
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
		
		if(isset($_GET['desde'])){
			$this->desde = $_GET['desde'];
		}
		else{
			$this->desde = '';
		}
		
		if(isset($_GET['hasta'])){
			$this->hasta = $_GET['hasta'];
		}
		else{
			$this->hasta = '';
		}
		
		if(isset($_GET['reporte'])){
			$this->reporte = $_GET['reporte'];
		}
		else{
			$this->reporte = '';
		}
		
	}
}
?>

