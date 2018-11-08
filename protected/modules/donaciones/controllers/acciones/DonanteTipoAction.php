<?php
class DonanteTipoAction extends CAction
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
		$donante = Donantes::model()->find('numero_documento_donante = ' . $documento); 
		if($donante == null){
			echo 0;
		}
		else{
			$model = Donantes::model()->findByPk($donante['id']);
			$tipo_documento = $donante['tipo_documento_donante'];
			echo $tipo_documento;
		}

    }
}
?>

