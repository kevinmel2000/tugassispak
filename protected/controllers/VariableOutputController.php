<?php

class VariableOutputController extends CoreController
{
	public $moduleName = 'Variable Output';
	
	public function actionIndex()
	{
        
        if(isset($_POST) && count($_POST) > 0)
        {
            $this->saveToActiveProject($_POST);
            
        }
      
        
        $vars = $this->loadFromActiveProject();
        
		$this->render('index', array(
            'vars' => $vars
        ));
	}
    
    private function saveToActiveProject($arrPost)
    {
        $fis = Fis::model()->find('status=:active', array(':active'=> Fis::$STATUS_ACTIVE));
        
        if(!isset($fis) || count($fis) ==0)
        {
            Yii::app()->user->setFlash('error', 'Fuzzy inference system setting failed to load!');
            $this->render('index');
        }
        
        $model = new Variable();
        $tr = $model->dbConnection->beginTransaction();
        
        
        Rule::model()->deleteAll(
                    'id_fis=:id_fis', array(
                    ':id_fis' => $fis->id,
                ));
        
        Variable::model()->deleteAll('id_fis=:id_fis AND type_input=:input', array(
                    ':id_fis' => $fis->id,
                    ':input' => Variable::$TYPE_OUTPUT
                ));
        
        try
        {
            foreach($arrPost as $varFuzzyName => $mf)
            {
                $var = new Variable();
                $var->name = $varFuzzyName;
                $var->type_input = Variable::$TYPE_OUTPUT;
                $var->id_fis = $fis->id;
                
                $var->save();

                $countMf =  count($mf['name']);

                for($x=0;$x<$countMf;$x++)
                {
                    $mfs = new Mf();
                    $mfs->id_variable = $var->id;
                    $mfs->name = $mf['name'][$x];
                    $mfs->type = $mf['type'][$x];
                    $mfs->value = $mf['param'][$x];
                    
                    $mfs->save();
                }
            }

            $tr->commit();
            Yii::app()->user->setFlash('success', 'Variable inputs saved!');
        }
        catch(Exception $e)
        {
            $tr->rollback();
            Yii::app()->user->setFlash('error', 'Variabel input failed to save!');
        }
        
        
    }
    
    private function loadFromActiveProject()
    {
        $fis = Fis::model()->find('status=:active', array(':active'=> Fis::$STATUS_ACTIVE));
        
        if(!isset($fis) || count($fis) ==0)
        {
            Yii::app()->user->setFlash('error', 'Fuzzy inference system setting failed to load!');
            $this->render('index');
        }
        
        $vars = Variable::model()->findAll(
                'id_fis=:id_fis AND type_input=:input', array(
                    ':id_fis' => $fis->id,
                    ':input' => Variable::$TYPE_OUTPUT
                ));
        
        return $vars;
    }
}