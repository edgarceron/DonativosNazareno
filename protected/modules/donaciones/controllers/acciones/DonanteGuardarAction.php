<?php
class DonanteGuardarAction extends CAction
{
    //Reemplazar Model por el modelo que corresponda al modulo
    public function run()
    {                           
        //Carga del modelo
		$id = $_GET['id'];
		$digito = $_GET['digito'];
		unset($_GET['digito']);
		
		if($id != ''){
			$model = Donantes::model()->findByPk($id);
			$model->attributes = $_GET;
		}
		else{
			unset($_GET['id']);
			$model = new Donantes;
			$model->attributes = $_GET;
		}
		
		$model->nombre_donante = strtoupper($model->nombre_donante);
		$model->apellido_donante = strtoupper($model->apellido_donante);
		$model->direccion_donante = strtoupper($model->direccion_donante);
		$model->correo_donante = strtoupper($model->correo_donante);
		
		if($model->tipo_documento_donante == 2){
			if($digito != ''){
				$model->numero_documento_donante = $model->numero_documento_donante . "-" . $digito;
			}
			$documento = $model->numero_documento_donante;
			$aux = explode('-', $documento);
			if(count($aux) == 2){
				$digito = $aux[1];
				if(!(is_numeric($digito) && (strlen($digito) == 1))){
					print("Error en el digito de verificación");
					exit;
				}
			}
			else{
				print("Ingrese el digito de verificación");
				exit;
			}
		}
		//Guardado
		if($model->save()){
			$id = $model['id'];
			print("Guardado existosamente");
		}
		else{
			print("Error al guardar");
			print_r($model);
		}
    }
}

