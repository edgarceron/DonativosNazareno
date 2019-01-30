<?php
class EventoGuardarAction extends CAction
{
    //Reemplazar Model por el modelo que corresponda al modulo
    public function run()
    {                 
		$model = new Eventos;
		$model->attributes = $_GET;
		
		
		$model->nombre_evento = strtoupper($model->nombre_evento);
		$model->fecha_evento = strtoupper($model->fecha_evento);
		
		//Guardado
		if($model->save()){
			$id = $model['id'];
			print("Guardado existosamente;".$model->id);
		}
		else{
			print("Error al guardar");
			print_r($model->getErrors());
		}
    }
}

