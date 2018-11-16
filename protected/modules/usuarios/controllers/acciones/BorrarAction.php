<?php
class BorrarAction extends CAction
{
    public function run($id)
    {
		$usuario = Usuarios::model()->findByPk($id);
		$nick = $usuario['nick'];
		Yii::app()->user->setFlash('success', "Se ha borrado existosamente el usuario $nick");
        $model = Usuarios::deleteUsuario($id);
        $this->controller->redirect(Yii::app()->createUrl('/usuarios/default/index'));
    }
}
