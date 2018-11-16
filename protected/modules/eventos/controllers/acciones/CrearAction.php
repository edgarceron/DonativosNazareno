<?php
class CrearAction extends CAction
{
    //Reemplazar Model por el modelo que corresponda al modulo
    public function run()
    {                           
        $model = new Eventos;

        $this->controller->render('formulario',array(
			'icono' => '/images/new64.png',
			'texto_boton' => 'Crear',
			'parametros_get' => '',
			'model' => $model,
        ));
    }
}

