<?php
require 'vendor/autoload.php';

class ReporteDianAction extends CAction
{
    //Reemplazar Model por el modelo que corresponda al modulo
    public function run()
    {                     
        if(isset($_GET['year'])){
			$year = $_GET['year'];
		
			$com = "SELECT donantes.*, SUM(valor_donacion) as donaciones_anuales FROM donaciones JOIN donantes 
			ON donaciones.id_donante_donacion = donantes.id JOIN eventos 
			ON donaciones.id_evento = eventos.id WHERE donaciones.validez_donacion = 1 
			AND eventos.fecha_evento  BETWEEN \"$year-01-01\" AND \"$year-12-31\" 
			GROUP BY donantes.id";
			
			$lista_donantes = Yii::app()->donativos->createCommand($com)->queryAll();
			
			$equivalencia = array('1' => '13', '2' => '31', '3' => '22', '4' => '41', '5' => '21', '6' => '11', '7' => '12');
			
			for($i = 0; $i<count($lista_donantes);$i++){
				$lista_donantes[$i]['tipo_documento_donante'] = $equivalencia[$lista_donantes[$i]['tipo_documento_donante']];
				
				$lista_donantes[$i]['razon_social_donante'] = "";
				if($lista_donantes[$i]['apellido_donante'] == ''){
					$lista_donantes[$i]['razon_social_donante'] = $lista_donantes[$i]['nombre_donante'];
					$lista_donantes[$i]['nombre_donante'] = '';
				}
				
				$nombres = explode(" ", $lista_donantes[$i]['nombre_donante']);
				$apelldios = explode(" ", $lista_donantes[$i]['apellido_donante']);
				if(isset($nombres[0]))
					$lista_donantes[$i]['nombre_donante'] = $nombres[0];
				$lista_donantes[$i]['otros_nombres_donante'] = "";
				for($j = 1;$j < count($nombres); $j++){
					$lista_donantes[$i]['otros_nombres_donante'] .= $nombres[$j] . " ";
				}
				
				$lista_donantes[$i]['segundo_apellido_donante'] = "";
				if(isset($apelldios[1])){
					$lista_donantes[$i]['segundo_apellido_donante'] = $apelldios[1];
				}
				
				$lista_donantes[$i]['dv_donante'] = "";
				$documento = explode("-", $lista_donantes[$i]['numero_documento_donante']);
				if(count($documento) == 2){
					$lista_donantes[$i]['numero_documento_donante'] = $documento[0];
					$lista_donantes[$i]['dv_donante'] = $documento[1];
				}
			}
			
			$reporte[0]['tipo_documento_donante'] = "Tipo de documento";
			$reporte[0]['numero_documento_donante'] = "Número de identificación";
			$reporte[0]['dv_donante'] = "DV";
			$reporte[0]['apellido_donante'] = "Primer apellido";
			$reporte[0]['segundo_apellido_donante'] = "Segundo apellido";
			$reporte[0]['nombre_donante'] = "Primer nombre";
			$reporte[0]['otros_nombres_donante'] = "Otros nombres";
			$reporte[0]['razon_social_donante'] = "Razon social";
			$reporte[0]['donaciones_anuales'] = "Donaciones anuales";
			
			for($i = 0; $i<count($lista_donantes);$i++){
				$reporte[$i + 1]['tipo_documento_donante'] = $lista_donantes[$i]['tipo_documento_donante'];
				$reporte[$i + 1]['numero_documento_donante'] = $lista_donantes[$i]['numero_documento_donante'];
				$reporte[$i + 1]['dv_donante'] = $lista_donantes[$i]['dv_donante'];
				$reporte[$i + 1]['apellido_donante'] = $lista_donantes[$i]['apellido_donante'];
				$reporte[$i + 1]['segundo_apellido_donante'] = $lista_donantes[$i]['segundo_apellido_donante'];
				$reporte[$i + 1]['nombre_donante'] = $lista_donantes[$i]['nombre_donante'];
				$reporte[$i + 1]['otros_nombres_donante'] = $lista_donantes[$i]['otros_nombres_donante'];
				$reporte[$i + 1]['razon_social_donante'] = $lista_donantes[$i]['razon_social_donante'];
				$reporte[$i + 1]['donaciones_anuales'] = $lista_donantes[$i]['donaciones_anuales'];
			}
			
			Yii::import('application.extensions.phpexcel.JPhpExcel');
			$xls = new JPhpExcel('UTF-8', false, 'My Test Sheet');
			$xls->addArray($reporte);
			$xls->generateXML('reporte_dian');
		}
		else{
			$this->controller->render('reporteDian',array(

			));
		}
    }
}

