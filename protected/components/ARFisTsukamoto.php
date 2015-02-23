<?php

class ARFisTsukamoto extends ARFis
{   
    public function __construct() 
    {
        $this->type = ARFisType::$FIS_TSUKAMOTO;
        $this->name = "Tsukamoto";
    }
    
    public function andMethod($arrValue)
    {
        $andMethodType = $this->getAndMethodType();
        
        if($andMethodType == ARFisType::$TSUKAMOTO_AND_METHOD_MIN)
        {
            return $this->andMethodMin($arrValue);
        }
        elseif($andMethodType == ARFisType::$TSUKAMOTO_AND_METHOD_PROD)
        {
            return $this->andMethodProd($arrValue);
        }
    }
    
    private function andMethodMin($arrValue)
    {
        if(count($arrValue) == 1) return $arrValue[0];
            
        $min = $arrValue[0];
        
        foreach($arrValue as $val)
        {
            if($min > $val)
            {
                $min = $val;
            }
        }
        
        return $min;
    }
    
    private function andMethodProd($arrValue)
    {
        return null;
    }
    
    public function orMethod($arrValue)
    {
        $orMethodType = $this->getOrMethodType();
        
        if($orMethodType == ARFisType::$TSUKAMOTO_OR_METHOD_MAX)
        {
            return $this->orMethodMax($arrValue);
        }
        elseif($orMethodType == ARFisType::$TSUKAMOTO_OR_METHOD_PROBOR)
        {
            return $this->orMethodProbor($arrValue);
        }
    }
    
    private function orMethodMax($arrValue)
    {
        if(count($arrValue) == 1) return $arrValue[0];
            
        $max = $arrValue[0];
        
        foreach($arrValue as $val)
        {
            if($max < $val)
            {
                $max = $val;
            }
        }
        
        return $max;
    }
    
    private function orMethodProbor($arrValue)
    {
        return null;
    }
    
    public function aggregationWeightAverage()
    {
        if(count($this->rules) == 0) return null;
        
        $resultInputs = array();
        $weightingAverage = array();
        
        foreach($this->rules as $rule)
        {
            $arrMF = array();
            
            foreach($rule->getInputs() as $varInputName => $detail)
            {
                $varFuzzyName = "";
                $value = "";
                
                foreach($detail as $fuzzyName => $val) 
                {
                    $varFuzzyName = $fuzzyName;
                    $value = $val;    
                }
                
                $arrMF[] =  $this->getMembershipFunction($varInputName, $varFuzzyName, $value);
            }
            
            $val = $this->applyFuzzyLogicOperation($rule->getInputConnection(), $arrMF);
            
            $resultTemp = array();
            
            foreach($rule->getConclusions() as $varOutputName => $detail)
            {
                $varFuzzyName = "";
                $arrFuzzyVar = array();
                
                foreach($detail as $fuzzyName)
                {
                    $varFuzzyName = $fuzzyName;
                    $arrFuzzyVar["$varFuzzyName"] = $val;
//                    $arrFuzzyVar["method"] = $rule->getInputConnection();
                }
                
                $resultTemp["$varOutputName"] =  $arrFuzzyVar;
            }
            
            $resultInputs[] = $resultTemp;
        }
        
        $arrayOutput = array();
        
        foreach($resultInputs as $value => $arrVariableOutput)
        {
            foreach($arrVariableOutput as $variableOutputName => $arrFuzzyName) 
            {
               $varOutputName = "";
               $varOutputName = $variableOutputName;
               
               foreach($arrFuzzyName as $fuzzyName => $value)
               {
                   $crispValue = $this->getCrispVariable($varOutputName, $fuzzyName, $value);
                   
                   //$arrayOutput[$variableOutputName][] = "$value x $crispValue";
                   
                   if(!isset($arrayOutput[$variableOutputName]["penyebut"])) $arrayOutput[$variableOutputName]["penyebut"] = 0;
                   if(!isset($arrayOutput[$variableOutputName]["pembilang"])) $arrayOutput[$variableOutputName]["pembilang"] = 0;
                   
                   $arrayOutput[$variableOutputName]["penyebut"] += $value;
                   $arrayOutput[$variableOutputName]["pembilang"] +=  $value * $crispValue;
               }
            }
        }
        
        foreach($arrayOutput as $fuzzyName => $value)
        {
            $arrayOutput["$fuzzyName"]["hasil"] = $arrayOutput["$fuzzyName"]["pembilang"] / ((double) $arrayOutput["$fuzzyName"]["penyebut"] + ARFis::$BILANGAN_KECIL);
        }
        
        $weightingAverage["fuzzyAndOrMethod"] = $resultInputs;
        $weightingAverage["results"] = $arrayOutput;
        
        return $weightingAverage;
    }
    
    private function applyFuzzyLogicOperation($connectionType, $arrValue)
    {
        if($connectionType == ARRule::$CONNECTION_AND)
        {
            return $this->andMethod($arrValue);
        }
        else
        {
            return $this->orMethod($arrValue);
        }
    }
    
    private function getMembershipFunction($varInputName, $varFuzzyName, $value)
    {
        if(count($this->getVariableInputs()) == 0) return null; 
        
        return $this->getValue($varInputName, $varFuzzyName, $value, $this->getVariableInputs(), ARVariableType::$VARIABLE_INPUT);
    }
    
    private function getCrispVariable($varInputName, $varFuzzyName, $value)
    {
        if(count($this->getVariableOutputs()) == 0) return null; 
        
        return $this->getValue($varInputName, $varFuzzyName, $value, $this->getVariableOutputs(), ARVariableType::$VARIABLE_OUTPUT);
    }
    
    private function getValue($varName, $varFuzzyName, $value, $arrayVariable, $type)
    {
        if(count($arrayVariable) == 0) return null; 
        
        $var = null;
        $result = null;
        
        foreach($arrayVariable as $input)
        {
            if($input->getName() == $varName)
            {
                $var = $input;
                break;
            }
        }
        
        if(count($var->getShapes()) == 0) return null; 
        
        foreach($var->getShapes() as $shape)
        {
            if($shape->getName() == $varFuzzyName)
            {
                if($type == ARVariableType::$VARIABLE_INPUT)
                {
                    $result =  $shape->getMembershipFunction($value);
                }
                else
                {
                    // true is monoatomic
                    // tsukamoto
                    $result = $shape->getCrispValue($value, true);
                }
                break;
            }
        }
        
        return $result;
    }
    
    public function splitNumber($string)
    {
        $result = preg_split("/\s+/", trim($string));
        
        return $result;
    }
    
    /* @var $mf Mf */
    private function fetchMf($mf)
    {
        $result = null;
        
        if($mf->type == ARVariableShapeType::$VARIABLE_TRI_MF)
        {
            $result = new ARShapeTrimf();
            $result->setName($mf->name);
            $arr = $this->splitNumber($mf->value);
            $result->setA($arr[0]);
            $result->setB($arr[1]);
            $result->setC($arr[2]);
            
        }
        else if($mf->type == ARVariableShapeType::$VARIABLE_TRAF_MF)
        {
            $result = new ARShapeTrafmf();
            $result->setName($mf->name);
            $arr = $this->splitNumber($mf->value);
            $result->setA($arr[0]);
            $result->setB($arr[1]);
            $result->setC($arr[2]);
            $result->setD($arr[3]);
        }
        
        return $result;
    }
    
    /*@var $modelFis Fis */
    public function setInput($idProject, $userInput)
    {
//        $userInput = array(100 => 4000, 99 => 300);
        $modelFis = Fis::model()->find('id=:id', array(':id' => $idProject));
        
        // fis 
        $fuzzy = new ARFisTsukamoto();
        $fuzzy->setAndMethodType($modelFis->and_method);
        $fuzzy->setOrMethodType($modelFis->or_method);
        
        $arrVarInput = array();
        $arrVarOutput = array();
        
        // variable input 
        /*@var $variable Variable */
        foreach($modelFis->variables as $variable)
        {
            if($variable->type_input == Variable::$TYPE_INPUT)
            {
                $varInput = new ARVariableInput();
                $varInput->setName($variable->name);
                
                $arrMfs = array();
                
                // untuk setiap mf
                foreach($variable->mfs as $mf)
                {
                    $varMf = $this->fetchMf($mf);
                    $arrMfs[] = $varMf;
                }
                
                $varInput->setShapes($arrMfs);
                
                $arrVarInput[] = $varInput;
            }
            else if($variable->type_input == Variable::$TYPE_OUTPUT)
            {
                $varOutput = new ARVariableOutput();
                $varOutput->setName($variable->name);
                
                $arrMfs = array();
                
                // untuk setiap mf
                foreach($variable->mfs as $mf)
                {
                    $varMf = $this->fetchMf($mf);
                    $arrMfs[] = $varMf;
                }
                
                $varOutput->setShapes($arrMfs);
                
                $arrVarOutput[] = $varOutput;
            }
        }
        
        $fuzzy->setVariableInputs($arrVarInput);
        $fuzzy->setVariableOutputs($arrVarOutput);
        
        
        $arrRule = array();
        // rules
        /*@var $rule Rule */
        /*@var $detail RuleDetail*/ 
        foreach($modelFis->rules as $rule)
        {
            $varRule = new ARRule();
            $varRule->setInputConnection($rule->connection);
            
            $arrInput = array();
            $arrConclusion = array();
            
            foreach($rule->ruleDetails as $detail)
            {
                $varFuzzyName = $detail->variable->name;
                $varMfName = $detail->mf->name;
                
                if($detail->type_rule == Rule::$TYPE_INPUT)
                {
                    // foreach user input
                    foreach($userInput as $key => $value)
                    {
                        if($detail->variable->id == $key)
                         {
                            $arrInput["$varFuzzyName"] = array("$varMfName" => $value);
                         }
                    }
                }
                else if($detail->type_rule == Rule::$TYPE_CONCLUSION)
                {
                    $arrConclusion["$varFuzzyName"] = array("$varMfName");
                }
            }
            
            $varRule->setInputs($arrInput);
            $varRule->setConclusions($arrConclusion);
            
            $arrRule[] = $varRule;
        }
        
        $fuzzy->setRules($arrRule);
        
//        print_r($fuzzy->aggregationWeightAverage());
        
        return $fuzzy->aggregationWeightAverage();
    }
}

?>
