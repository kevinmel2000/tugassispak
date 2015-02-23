<?php

class InferenceSystemController extends CoreController
{
    public $moduleName = 'Inference System';
    
	public function actionIndex()
	{
        if(isset($_POST) && count($_POST) > 0)
        {
            $this->saveToActiveProject($_POST);
        }
        
        $fis = $this->loadFromActiveProject();
        
		$this->render('index', array(
            'fis' => $fis
        ));
	}
    
    private function saveToActiveProject($arrPost)
    {
        $fis = Fis::model()->find('status=:active', array(':active'=> Fis::$STATUS_ACTIVE));
        
        if(!isset($fis) || count($fis) ==0)
        {
            Yii::app()->user->setFlash('error', 'Fuzzy inference system setting failed to save!');
            $this->render('index');
        }
        
        $fis->and_method = $arrPost['andMethod'];
        $fis->or_method = $arrPost['orMethod'];
        $fis->defuzzification = $arrPost['defuzzification'];
        
        // tsukamoto
        $fis->id_fis = ARFisType::$FIS_TSUKAMOTO;
        
        $fis->save();
        
        Yii::app()->user->setFlash('success', 'Fuzzy inference system setting saved!');
    }
    
    private function loadFromActiveProject()
    {
        $fis = Fis::model()->find('status=:active', array(':active'=> Fis::$STATUS_ACTIVE));
        
        if(!isset($fis) || count($fis) ==0)
        {
            Yii::app()->user->setFlash('error', 'Fuzzy inference system setting failed to load!');
            $this->render('index');
        }
        
        return $fis;
    }
}