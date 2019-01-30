<?php
class EventoCargarAction extends CAction
{
    //Reemplazar Model por el modelo que corresponda al modulo
    public function run()
    {                           
        /**
		 * Se carga el formulario de un evento dependiendo de su id
		 * o se carga un formulario vacio.
		 * Esta acción se usara para ambos, donante y representante legal
		 */
	
		$model = new Eventos;
		$parametros_get = '';
		$icono = '/images/new64.png';
		$texto_boton = 'Crear';
	
        $this->controller->renderPartial('_formulario_evento',array(
			'icono' => $icono,
			'texto_boton' => $texto_boton,
			'parametros_get' => $parametros_get,
			'model' => $model,
        ));
    }
}
