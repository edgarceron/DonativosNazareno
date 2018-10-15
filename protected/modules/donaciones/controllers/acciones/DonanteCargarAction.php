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

        $this->controller->render('index',array(

        ));
    }
}
?>

