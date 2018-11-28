<?php
class GuardarAction extends CAction
{
    //Reemplazar Model por el modelo que corresponda al modulo
    public function run()
    {                           
        //Carga del modelo
		if(isset($_GET['id'])){
			$id = $_GET['id'];
			$model = Donantes::model()->findByPk($id); 
			$icono = '/images/edit64.png';
			$texto_boton = 'Guardar';
			$parametros_get = '?id='.$id;
		}
		else{
			$model = new Donantes;
			$icono = '/images/new64.png';
			$texto_boton = 'Crear';
			$parametros_get = '';
		}
		
		//Añadiendo datos al modelo
		$model->attributes=$_POST['Donantes'];
		$errores = false;
		if($model->getIsNewRecord() && $this->existenDuplicados($model['numero_documento_donante'], $model['tipo_documento_donante'])){
			$model->addError('numero_documento_donante', 'Existe otro donante con este numero de documento');
			$errores = true;
		}
		
		if($model['tipo_documento_donante'] != 2){
			if($model['apellido_donante'] == ''){
				$model->addError('apellido_donante', 'Apellido no puede ser nulo si el donante es persona natural');
				$errores = true;
			}
		}
		$model->nombre_donante = strtoupper($model->nombre_donante);
		$model->apellido_donante = strtoupper($model->apellido_donante);
		$model->direccion_donante = strtoupper($model->direccion_donante);
		$model->correo_donante = strtoupper($model->correo_donante);
		
		if($model->tipo_documento_donante == 2){
			$documento = $model->numero_documento_donante;
			$aux = explode('-', $documento);
			if(count($aux) == 2){
				$digito = $aux[1];
				if(!(is_numeric($digito) && (strlen($digito) == 1))){
					$model->numero_documento_donante = "";
					$error = "Error en el digito de verificación";
				}
			}
			else{
				$model->numero_documento_donante = "";
				$error = "Ingrese el digito de verificación";
			}
		}
		
		//Guardado
		if(!$errores && $model->save()){
			$id = $model['id'];
			$this->controller->redirect(array(
				'vista', 'id' => $id
			));
		}
		else{
			if(isset($error)){
				$model->numero_documento_donante = $documento;
				$model->clearErrors('numero_documento_donante');
				$model->addError('numero_documento_donante', $error);
			}
			$this->controller->render('formulario',array(
				'icono' => $icono,
				'texto_boton' => $texto_boton,
				'parametros_get' => $parametros_get,
				'model' => $model,
			));
		}
    }
	
	public function existenDuplicados($numero_documento, $tipo_documento){
		$criteria = new CDbCriteria;
		$criteria->compare('numero_documento_donante', $numero_documento);
		$duplicados = Donantes::model()->find($criteria);
		if($duplicados != null){
			return true;
		}
		return false;
	}
}

