<?php

class RulesController extends CoreController
{
    public $moduleName = 'Rule';
    
	public function actionIndex()
	{
        if(isset($_POST) && count($_POST) > 0)
        {
            $this->saveToActiveProject($_POST);
        }
        
        $varInput = $this->loadVariable(Variable::$TYPE_INPUT);
        $varOutput = $this->loadVariable(Variable::$TYPE_OUTPUT);
        
        $rules = $this->loadRules();
        $arrRuleText = array();
        
        foreach($rules as $rule)
        {
            $arrRuleText[] = $this->ruleToText($rule);
        }
        
        $countRule = count($rules);
        
		$this->render('index', array(
            'varInput' => $varInput,
            'varOutput' => $varOutput,
            'rules' => $rules,
            'countRule' => $countRule,
            'arrRuleText' => $arrRuleText,
        ));
	}
    
    private function ruleToText($rule)
    {
        $result = "IF ";
        $connection = $rule->connection;
        
        $countInput = count($rule->ruleDetails);
        
        foreach($rule->ruleDetails as $detail)
        {
            if($detail->type_rule == Rule::$TYPE_INPUT)
            {
                $result .= "( " . $detail->variable->name . " = " . $detail->mf->name ." ) AND ";
            }
        }
        
        $result = substr($result, 0, strlen($result)-4);
        
        $result .= " THEN ";
        
        foreach($rule->ruleDetails as $detail)
        {
            if($detail->type_rule == Rule::$TYPE_CONCLUSION)
            {
                $result .= "( " . $detail->variable->name . " = " . $detail->mf->name ." ) AND ";
            }
        }
        
        $result = substr($result, 0, strlen($result)-4);
         
        return $result;
    }
    
    private function loadRules()
    {
        $fis = Fis::model()->find('status=:active', array(':active'=> Fis::$STATUS_ACTIVE));
        
        if(!isset($fis) || count($fis) ==0)
        {
            Yii::app()->user->setFlash('error', 'Fuzzy inference system setting failed to load!');
            $this->render('index');
        }
        
        $rules = Rule::model()->findAll(
                'id_fis=:id_fis', array(
                    ':id_fis' => $fis->id,
                ));
        
        return $rules;
    }
    
    
    private function loadVariable($type)
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
                    ':input' => $type == Variable::$TYPE_INPUT ? Variable::$TYPE_INPUT : Variable::$TYPE_OUTPUT
                ));
        
        return $vars;
    }
    
    private function saveToActiveProject($arrPost)
    {
//        print_r($arrPost);
//        die();
        $fis = Fis::model()->find('status=:active', array(':active'=> Fis::$STATUS_ACTIVE));
        
        if(!isset($fis) || count($fis) ==0)
        {
            Yii::app()->user->setFlash('error', 'Fuzzy inference system setting failed to load!');
            $this->render('index');
        }
        
        $model = new Rule();
        $tr = $model->dbConnection->beginTransaction();
        
        // delete active rule
        Rule::model()->deleteAll('id_fis=:idFis', array(':idFis' => $fis->id));
        
        try
        {
            foreach($arrPost['connection'] as $key => $connectionName)
            {
                $rule = new Rule();
                $rule->id_fis = $fis->id;
                $rule->connection = $connectionName;
                
                $rule->save();
                
                $countVarFuzzyInput = count($arrPost['varFuzzyInput'][$key]);
                for($x=0;$x<$countVarFuzzyInput;$x++)
                {
                    $ruleDetail = new RuleDetail();
                    $ruleDetail->id_rule = $rule->id;
                    $ruleDetail->type_rule = Rule::$TYPE_INPUT;
                    $ruleDetail->id_variable = $arrPost['varFuzzyInput'][$key][$x];
                    $ruleDetail->id_mf = $arrPost['mfInput'][$key][$x];
                    
                    $ruleDetail->save();
                }

                $countVarFuzzyOutput = count($arrPost['varFuzzyOutput'][$key]);
                for($x=0;$x<$countVarFuzzyOutput;$x++)
                {
                    $ruleDetail = new RuleDetail();
                    $ruleDetail->id_rule = $rule->id;
                    $ruleDetail->type_rule = Rule::$TYPE_CONCLUSION;
                    $ruleDetail->id_variable = $arrPost['varFuzzyOutput'][$key][$x];
                    $ruleDetail->id_mf = $arrPost['mfOutput'][$key][$x];
                    
                    $ruleDetail->save();
                }
            }
            
            $tr->commit();
            Yii::app()->user->setFlash('success', 'Rules saved!');
        }
        catch(Exception $e)
        {
            $tr->rollback();
            Yii::app()->user->setFlash('error', 'Rules failed to save!');   
        }
    }
}