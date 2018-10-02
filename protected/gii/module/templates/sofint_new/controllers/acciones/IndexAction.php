<?php echo "<?php\n"; ?>
class IndexAction extends CAction
{
    //Reemplazar Model por el modelo que corresponda al modulo
    public function run()
    {                           
        if(!isset($_GET['item']))
        {
            $model = new Model;
        }
        else
        {
            $model = Model::model()->findByPk($_GET['item']);
            if(empty($model))
            {
                $model = new Model;
            }
        }
    
        
        $modelview=new Model('search'); //Reemplaze Model por el modelo adecuado para este modulo
        $modelview->unsetAttributes();  // clear any default values
        if(isset($_GET['Model']))//Reemplaze Model por el modelo adecuado para este modulo
                $modelview->attributes=$_GET['Model'];//Reemplaze Model por el modelo adecuado para este modulo

        $this->controller->render('index',array(
                'model'=>$model,
                'modelview'=>$modelview,
        ));
    }
}
<?php echo "?>\n"; ?>

