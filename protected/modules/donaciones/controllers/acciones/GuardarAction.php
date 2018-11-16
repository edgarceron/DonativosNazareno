<?php
class GuardarAction extends CAction
{
    //Reemplazar Model por el modelo que corresponda al modulo
    public function run()
    {         
		if(isset($_GET['evento'])){
			$eventos = $this->getEventos($_GET['evento']);
		}
		else{
			$eventos = $this->getEventos();
		}
		
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
		
        //Carga del modelo
		if(isset($_GET['id'])){
			$id = $_GET['id'];
			$model = Donaciones::model()->findByPk($id); 
			$icono = '/images/edit64.png';
			$texto_boton = 'Guardar';
		}
		else{
			$model = new Donaciones;
			$icono = '/images/new64.png';
			$texto_boton = 'Crear';
		}
		
		//Añadiendo datos al modelo
		$model->attributes=$_POST['Donaciones'];
		$evento = $model->id_evento;
		$model['validez_donacion'] = 1;
		
		$donante = Donantes::model()->find('numero_documento_donante = "' . $model['id_donante_donacion'] . '"');
		$aux_donante = $model['id_donante_donacion'];
		if($donante == null){
			$model['id_donante_donacion'] = '';
		}
		else{
			$model['id_donante_donacion'] = $donante['id'];
		}
		
		$representante = Donantes::model()->find('numero_documento_donante = "' . $model['id_representante_donacion'] . '"');
		$aux_representante = $model['id_representante_donacion'];
		if($representante == null){
			$model['id_representante_donacion'] = '';
		}
		else{
			$model['id_representante_donacion'] = $representante['id'];
		}
		
		//Guardado
		if($model->save()){
			$id = $model['id'];
			$this->controller->redirect(array('crear', 'mensaje' => '1', 'evento' => $model['id_evento']));
			/*
			$this->controller->redirect(array(
				'vista', 'id' => $id
			));*/
		}
		else{
			if($donante == null && $aux_donante != ''){
				$model->clearErrors('id_donante_donacion');
				$model->addError('id_donante_donacion', 'Donante no existe, debe guardar el donante antes de enviar el formulario');
			}
			$model['id_donante_donacion'] = $aux_donante;
			
			if($representante == null && $aux_representante != ''){
				$model->clearErrors('id_representante_donacion');
				$model->addError('id_representante_donacion', 'Representante no existe, debe guardar el donante antes de enviar el formulario');
			}
			$model['id_representante_donacion'] = $aux_representante;
			
			$this->controller->render('formulario',array(
				'icono' => $icono,
				'texto_boton' => $texto_boton,
				'meses' => $meses,
				'years' => $years,
				'eventos' => $eventos,
				'mensaje' => '',
				'parametros_get' => '',
				'model' => $model,
			));
		}
    }
	
	
	/**
	 * Filtra los eventos del mes y año actual
	 * @return array Lista de eventos
	 */
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
}

