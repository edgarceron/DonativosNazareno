<?php
class DonanteCargarAction extends CAction
{
    //Reemplazar Model por el modelo que corresponda al modulo
    public function run()
    {                           
        /**
		 * Se carga el formulario de donante para la identificación ingresada
		 * Si no hay donantes con la identificación ingresada se abre un formulario
		 * en blanco.
		 *
		 * Esta acción se usara para ambos, donante y representante legal
		 */
		
		$documento = $_GET['documento'];
		$tipo = $_GET['tipo'];
		$donante = Donantes::model()->find('numero_documento_donante = ' . $documento); 
		if($donante == null){
			$model = new Donantes;
			$model['numero_documento_donante'] = $documento;
			$parametros_get = '';
			$icono = '/images/new64.png';
			$texto_boton = 'Crear';
		}
		else{
			$model = Donantes::model()->findByPk($donante['id']);
			$parametros_get = $donante['id'];
			$icono = '/images/edit64.png';
			$texto_boton = "Guardar";
		}

        $this->controller->renderPartial('_formulario_donante',array(
			'icono' => $icono,
			'texto_boton' => $texto_boton,
			'parametros_get' => $parametros_get,
			'model' => $model,
			'tipo' => $tipo,
        ));
    }
}
