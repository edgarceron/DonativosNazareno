<?php
require 'vendor/autoload.php';
use Mpdf\Mpdf;

class CertificadoAction extends CAction
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
		
		
		
		
		$valor_donaciones = $this->calcularDonaciones($id, $desde, $hasta);
		
		$nombre = $model['nombre_donante'] . " " . $model['apellido_donante'];
		$tipo_documento = $model->tiposDocumento()[$model['tipo_documento_donante']];
		$numero_documento = $model['numero_documento_donante'];
		$firma_contador = '<img src="images/firmaContador.png"/>';
		$fecha_deletreada = $this->fechaDeletreada();
		
        $html = $this->controller->renderPartial('certificado',
			array(
				'nombre' => $nombre, 
				'tipo_documento' => $tipo_documento,
				'numero_documento' => $numero_documento,
				'valor_donaciones' => $valor_donaciones,
				'fecha_deletreada' => $fecha_deletreada,
				'firma_contador' => $firma_contador), 
			true
		);
		$mpdf=new mPDF(
		[
			'mode' => '',
			'format' => 'Letter',
			'default_font_size' => 0,
			'default_font' => '',
			'margin_left' => 0,
			'margin_right' => 0,
			'margin_top' => 40,
			'margin_bottom' => 0,
			'margin_header' => 0,
			'margin_footer' => 0,
			'orientation' => 'P',]
		);
		
		$mpdf->SetHTMLHeader('<img src="images/cabeceraCertificado.png"/>');
		$mpdf->SetHTMLFooter('<img src="images/pieCertificado.png"/>');
		$mpdf->showImageErrors = true;
		$mpdf->writeHTML($html);
		$mpdf->Output();
    }
	
	public function calcularDonaciones($id, $desde, $hasta){
		$criteria = new CDbCriteria;
		$criteria->with = array(
			'idEvento' => array(
				'alias'=> 't2', 
				'together' => true,
				'select' => array('t2.nombre_evento', 't2.fecha_evento'),
			),
		);
		$criteria->select = 'SUM(valor_donacion) as valor_donacion';
		$criteria->compare('id_donante_donacion', $id);
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
		$resultado = Donaciones::model()->find($criteria);
		$formatter = new NumberFormatter("es-CO", NumberFormatter::CURRENCY);
		$speller = new NumberFormatter("es-CO", NumberFormatter::SPELLOUT);
		$texto_valor = $speller->format($resultado['valor_donacion']);
		$valor_donaciones = $formatter->format($resultado['valor_donacion']);
		
		return $valor_donaciones . " ($texto_valor pesos)";
	}
	
	public function fechaDeletreada(){
		$speller = new NumberFormatter("es-CO", NumberFormatter::SPELLOUT);
		$mesesN=array(1=>"Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio",
             "Agosto","Septiembre","Octubre","Noviembre","Diciembre");
		$dias = date('j');
		$dias_texto = $speller->format($dias);
		$mes = $mesesN[date('n')];
		$año = date('Y');
		$fecha = $dias_texto . "($dias) días del mes de " . $mes . " de " . $año;
		return $fecha;
	}
}
?>

