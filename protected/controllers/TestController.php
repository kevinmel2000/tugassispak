<?php

class TestController extends CoreController
{
	public function actionIndex()
	{
//        // test trimf
//        $v = new ARShapeTrimf();
//        $v->setName("murah");
//        $v->setA(5);
//        $v->setB(10);
//        $v->setC(20);
//        
//        echo $v->getMembershipFunction(3) . "<br/>";
//        echo $v->getMembershipFunction(5) . "<br/>";
//        echo $v->getMembershipFunction(9.5334) . "<br/>";
//        echo $v->getMembershipFunction(10) . "<br/>";
//        echo $v->getMembershipFunction(15.3434) . "<br/>";
//        echo $v->getMembershipFunction(20) . "<br/>";
//        echo $v->getMembershipFunction(25) . "<br/>";
        
//           // test trimf
//        $v = new ARShapeTrafmf();
//        $v->setName("sedag");
//        $v->setA(5);
//        $v->setB(10);
//        $v->setC(20);
//        $v->setD(25);
//        
//        echo $v->getMembershipFunction(3) . "<br/>";
//        echo $v->getMembershipFunction(5) . "<br/>";
//        echo $v->getMembershipFunction(9.9) . "<br/>";
//        echo $v->getMembershipFunction(10) . "<br/>";
//        echo $v->getMembershipFunction(20) . "<br/>";
//        echo $v->getMembershipFunction(20.998) . "<br/>";
//        echo $v->getMembershipFunction(25) . "<br/>";
//        echo $v->getMembershipFunction(26) . "<br/>";
        
        
        $tri = new ARShapeTrimf();
        $tri->setName('naik');
        $tri->setA(1000);
        $tri->setB(5000);
        $tri->setC(7000);
        
        
        echo $tri->getMembershipFunction(1000) . " " . $tri->getCrispValue($tri->getMembershipFunction(1000)) . " 1000 <br/>";
        echo $tri->getMembershipFunction(4988) . " " . $tri->getCrispValue($tri->getMembershipFunction(4988)) . " 4988 <br/>";
        echo $tri->getMembershipFunction(5000) . " " . $tri->getCrispValue($tri->getMembershipFunction(5000)) . " 5000 <br/>";
        echo $tri->getMembershipFunction(6000) . " " . $tri->getCrispValue($tri->getMembershipFunction(6000)) . " 6000 <br/>";
        echo $tri->getMembershipFunction(7000) . " " . $tri->getCrispValue($tri->getMembershipFunction(7000)) . " 7000 <br/>";
        
        
        die();
		$this->render('index');
	}
    
    public function actionHitungTsukamoto()
    {
        // fis
        $fuzzy = new ARFisTsukamoto();
        $fuzzy->setAndMethodType(ARFisType::$TSUKAMOTO_AND_METHOD_MIN);
        $fuzzy->setOrMethodType(ARFisType::$SUGENO_OR_METHOD_MAX);
        
        // input 1
        $varInputPersediaan = new ARVariableInput();
        $varInputPersediaan->setName('permintaan');
        
        $arrayPersediaan = array();
        
        $turun = new ARShapeTrafmf();
        $turun->setName('turun');
        $turun->setA(0);
        $turun->setB(0);
        $turun->setC(1000);
        $turun->setD(5000);
        
        $naik = new ARShapeTrafmf();
        $naik->setName('naik');
        $naik->setA(1000);
        $naik->setB(5000);
        $naik->setC(5000);
        $naik->setD(5000);
        
        $arrayPersediaan[] = $turun;
        $arrayPersediaan[] = $naik;
        $varInputPersediaan->setShapes($arrayPersediaan);
        
        // input 2
        $varInputPermintaan = new ARVariableInput();
        $varInputPermintaan->setName('persediaan');
        
        $arrayPermintaan = array();
        
        $sedikit = new ARShapeTrafmf();
        $sedikit->setName('sedikit');
        $sedikit->setA(0);
        $sedikit->setB(0);
        $sedikit->setC(100);
        $sedikit->setD(600);
        
        $banyak = new ARShapeTrafmf();
        $banyak->setName('banyak');
        $banyak->setA(100);
        $banyak->setB(600);
        $banyak->setC(100000);
        $banyak->setD(100000);
        
        $arrayPermintaan[] = $sedikit;
        $arrayPermintaan[] = $banyak;
        $varInputPermintaan->setShapes($arrayPermintaan);
        
        
        // output 1
        $varOutputProduksi = new ARVariableOutput();
        $varOutputProduksi->setName('produksi');
        
        $varOutputa= new ARVariableOutput();
        $varOutputa->setName('a');
        
        
        $arrayProduksi = array();
        
        $berkurang = new ARShapeTrafmf();
        $berkurang->setName('berkurang');
        $berkurang->setA(2000);
        $berkurang->setB(2000);
        $berkurang->setC(2000);
        $berkurang->setD(7000);
        
//        echo $berkurang->getCrispValue(0.25);
//        echo $berkurang->getCrispValue(0);
//        echo $berkurang->getCrispValue(1);
         
        
        $bertambah = new ARShapeTrafmf();
        $bertambah->setName('bertambah');
        $bertambah->setA(2000);
        $bertambah->setB(7000);
        $bertambah->setC(7000);
        $bertambah->setD(7000);
        
//        echo $bertambah->getCrispValue(0.4);
//        echo $bertambah->getCrispValue(0);
//        echo $bertambah->getCrispValue(1);
         
        $arrayProduksi[] = $berkurang;
        $arrayProduksi[] = $bertambah;
        $varOutputProduksi->setShapes($arrayProduksi);
        
        $varOutputa->setShapes($arrayProduksi);
        
        
        $arrayVariableInputs = array();
        $arrayVariableInputs[] = $varInputPersediaan;
        $arrayVariableInputs[] = $varInputPermintaan;
        
        $arrayVariableOutputs = array();
        $arrayVariableOutputs[] = $varOutputProduksi;
        $arrayVariableOutputs[] = $varOutputa;
        
        $fuzzy->setVariableInputs($arrayVariableInputs);
        $fuzzy->setVariableOutputs($arrayVariableOutputs);
        
//        print_r($fuzzy);
        // permintaan
        
        $rule1 = new ARRule();
        $rule1->setInputs(array(
                'permintaan' => array('turun' => 4000),
                'persediaan' => array('banyak' => 300)
            ));
        $rule1->setConclusions(array(
                'produksi' => array('berkurang'),
                'a' => array('bertambah')
            ));
        $rule1->setOrder(1);
        $rule1->setInputConnection(ARRule::$CONNECTION_AND);
        
        
        $rule2 = new ARRule();
        $rule2->setInputs(array(
                'permintaan' => array('turun' => 4000),
                'persediaan' => array('sedikit' => 300)
            ));
        $rule2->setConclusions(array(
                'produksi' => array('berkurang')
            ));
        $rule2->setOrder(2);
        $rule2->setInputConnection(ARRule::$CONNECTION_AND);
        
        $rule3 = new ARRule();
        $rule3->setInputs(array(
                'permintaan' => array('naik' => 4000),
                'persediaan' => array('banyak' => 300)
            ));
        $rule3->setConclusions(array(
                'produksi' => array('bertambah')
            ));
        $rule3->setOrder(3);
        $rule3->setInputConnection(ARRule::$CONNECTION_AND);
        
        
        $rule4 = new ARRule();
        $rule4->setInputs(array(
                'permintaan' => array('naik' => 4000),
                'persediaan' => array('sedikit' => 300)
            ));
        $rule4->setConclusions(array(
                'produksi' => array('bertambah')
            ));
        $rule4->setOrder(4);
        $rule4->setInputConnection(ARRule::$CONNECTION_AND);
        
        $arrayRule = array();
        $arrayRule[] = $rule1;
        $arrayRule[] = $rule2;
        $arrayRule[] = $rule3;
        $arrayRule[] = $rule4;
        
        $fuzzy->setRules($arrayRule);
        
        print_r($fuzzy->aggregationWeightAverage());
        
        //print_r($fuzzy);
        
        //echo $fuzzy->getMembershipFunction('permintaan', 'turun', 4000);
    }
    
    public function actionTestJQuery()
    {
        $this->render('js');
    }
    
    public function actionTestXmlWrite()
    {
        
        $w = new XMLWriter();
        $w->openUri('php://output');
        $w->startDocument('1.0', 'UTF-8');
        $w->setIndent(8);
        
        $w->startElement('chart');
                $w->writeAttribute('id', '1');
                $w->writeElement("aquos", "hai");
                $w->startElement('kuga');
                $w->endElement();
        $w->endElement();
        $w->endDocument();
        
        $w->flush();
        
        die();
    }
    
    public function actionWriteXml()
    {
        $w = new XMLWriter();
        $w->openUri('php://output');
        $w->startDocument('1.0', 'UTF-8');
        $w->setIndent(4);
        
        $w->startElement('argFuzzyDocument');
            
            $w->writeElement("andMethod", "0");
            $w->writeElement("orMethod", "0");
            $w->writeElement("implication", "0");
            $w->writeElement("aggregation", "0");
            
            // inputs
            $w->startElement("varInput");
                $w->startElement("varFuzzy");
                    $w->writeElement("name", "0");
                    
                    $w->startElement("mf");
                        $w->writeElement("name", "0");
                        $w->writeElement("type", "0");
                        $w->writeElement("value", "0");
                    $w->endElement();
                    
                    $w->startElement("mf");
                        $w->writeElement("name", "0");
                        $w->writeElement("type", "0");
                        $w->writeElement("value", "0");
                    $w->endElement();
                    
                    $w->startElement("mf");
                        $w->writeElement("name", "0");
                        $w->writeElement("type", "0");
                        $w->writeElement("value", "0");
                    $w->endElement();
                    
                $w->endElement();
                
                $w->startElement("varFuzzy");
                    $w->writeElement("name", "0");
                    
                    $w->startElement("mf");
                        $w->writeElement("name", "0");
                        $w->writeElement("type", "0");
                        $w->writeElement("value", "0");
                    $w->endElement();
                    
                    $w->startElement("mf");
                        $w->writeElement("name", "0");
                        $w->writeElement("type", "0");
                        $w->writeElement("value", "0");
                    $w->endElement();
                    
                    $w->startElement("mf");
                        $w->writeElement("name", "0");
                        $w->writeElement("type", "0");
                        $w->writeElement("value", "0");
                    $w->endElement();
                    
                $w->endElement();
            $w->endElement();
            
            // outputs
            $w->startElement("varOutput");
                $w->startElement("varFuzzy");
                    $w->writeElement("name", "0");
                    
                    $w->startElement("mf");
                        $w->writeElement("name", "0");
                        $w->writeElement("type", "0");
                        $w->writeElement("value", "0");
                    $w->endElement();
                    
                    $w->startElement("mf");
                        $w->writeElement("name", "0");
                        $w->writeElement("type", "0");
                        $w->writeElement("value", "0");
                    $w->endElement();
                    
                    $w->startElement("mf");
                        $w->writeElement("name", "0");
                        $w->writeElement("type", "0");
                        $w->writeElement("value", "0");
                    $w->endElement();
                    
                $w->endElement();
                
                $w->startElement("varFuzzy");
                    $w->writeElement("name", "0");
                    
                    $w->startElement("mf");
                        $w->writeElement("name", "0");
                        $w->writeElement("type", "0");
                        $w->writeElement("value", "0");
                    $w->endElement();
                    
                    $w->startElement("mf");
                        $w->writeElement("name", "0");
                        $w->writeElement("type", "0");
                        $w->writeElement("value", "0");
                    $w->endElement();
                    
                    $w->startElement("mf");
                        $w->writeElement("name", "0");
                        $w->writeElement("type", "0");
                        $w->writeElement("value", "0");
                    $w->endElement();
                    
                $w->endElement();
            $w->endElement();
            
            // rules
            $w->startElement("rules");
                $w->startElement("rule");
                    $w->startElement("inputs");
                    
                        $w->startElement("input");
                            $w->writeElement("name", "0");
                            $w->writeElement("mf", "0");
                            $w->writeElement("value", "0");
                        $w->endElement();

                        $w->startElement("input");
                            $w->writeElement("name", "0");
                            $w->writeElement("mf", "0");
                            $w->writeElement("value", "0");
                        $w->endElement();
                        
                    $w->endElement();
                    
                    $w->startElement("conclusions");
                    
                        $w->startElement("conclusion");
                            $w->writeElement("name", "0");
                            $w->writeElement("mf", "0");
                        $w->endElement();

                        $w->startElement("conclusion");
                            $w->writeElement("name", "0");
                            $w->writeElement("mf", "0");
                        $w->endElement();
                    $w->endElement();
                $w->endElement();
            $w->endElement();
            
        $w->endElement();
        $w->endDocument();
        $w->flush();
        
        die();
    }
    
    public function actionTestFis()
    {
        $fis = Fis::model()->find('status=:active', array(':active' => Fis::$STATUS_ACTIVE));
        
        echo count($fis->variableInputs);
        
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
    public function actionHitungTsukamotoDb()
    {
        
        $userInput = array(116 => 320022, 115 => 235885);
        $modelFis = Fis::model()->find('id=:id', array(':id' => 6));
        
//        $userInput = array(97 => 4000, 96 => 300);
//        $modelFis = Fis::model()->find('id=:id', array(':id' => 1));
        
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
        
        print_r($fuzzy->aggregationWeightAverage());
        
        //print_r($fuzzy);
        
    }
    
    public function actionASDF()
    {
        // persediaan sedikit
        // 225886  225886 264202
        $tri = new ARShapeTrimf();
        $tri->setName('naik');
        $tri->setA(225886);
        $tri->setB(225886);
        $tri->setC(264202);
        echo  "Persediaan sedikit [256500] : " .  $tri->getMembershipFunction(256500);
        echo "<br/>";
        
        
        // permintaan  turun
        // 224260 224260 350023 
        $tri = new ARShapeTrimf();
        $tri->setName('naik');
        $tri->setA(224260);
        $tri->setB(224260);
        $tri->setC(350023);
        echo  "Permintaan turun [335500] : " .  $tri->getMembershipFunction(335500);
        echo "<br/>";
        echo "<br/>";
        
        
        // persediaan banyak
        // 225886  264202 264202
        $tri = new ARShapeTrimf();
        $tri->setName('naik');
        $tri->setA(225886);
        $tri->setB(264202);
        $tri->setC(264202);
        echo  "Persediaan banyak [256500] : " .  $tri->getMembershipFunction(256500);
        echo "<br/>";
        
        // permintaan  turun
        // 224260 224260 350023 
        $tri = new ARShapeTrimf();
        $tri->setName('naik');
        $tri->setA(224260);
        $tri->setB(224260);
        $tri->setC(350023);
        echo  "Permintaan turun [335500] : " .  $tri->getMembershipFunction(335500);
        echo "<br/>";
        echo "<br/>";
        
        
        // persediaan sedikit
        // 225886  225886 264202
        $tri = new ARShapeTrimf();
        $tri->setName('naik');
        $tri->setA(225886);
        $tri->setB(225886);
        $tri->setC(264202);
        echo  "Persediaan sedikit [256500] : " .  $tri->getMembershipFunction(256500);
        echo "<br/>";
        
        
        // permintaan  naik
        // 224260 224260 350023 
        $tri = new ARShapeTrimf();
        $tri->setName('naik');
        $tri->setA(224260);
        $tri->setB(350023);
        $tri->setC(350023);
        echo  "Permintaan naik [335500] : " .  $tri->getMembershipFunction(335500);
        echo "<br/>";
        echo "<br/>";
        
        
        // persediaan banyak
        // 225886  264202 264202
        $tri = new ARShapeTrimf();
        $tri->setName('naik');
        $tri->setA(225886);
        $tri->setB(264202);
        $tri->setC(264202);
        echo  "Persediaan banyak [256500] : " .  $tri->getMembershipFunction(256500);
        echo "<br/>";
        
        // permintaan  naik
        // 224260 224260 350023 
        $tri = new ARShapeTrimf();
        $tri->setName('naik');
        $tri->setA(224260);
        $tri->setB(350023);
        $tri->setC(350023);
        echo  "Permintaan naik [335500] : " .  $tri->getMembershipFunction(335500);
        echo "<br/>";
        echo "<br/>";
        echo "<br/>";
        
        // produksi berkurang
        // 224260 224260 350023 
        $tri = new ARShapeTrimf();
        $tri->setName('naik');
        $tri->setA(224260);
        $tri->setB(350023);
        $tri->setC(350023);
        echo  "Produksi berkurang  : " .  $tri->getCrispValue(0.11547911547912, true);
        echo "<br/>";
         
        // produksi  berkurang
        // 224260 224260 350023 
        $tri = new ARShapeTrimf();
        $tri->setName('naik');
        $tri->setA(224260);
        $tri->setB(350023);
        $tri->setC(350023);
        echo  "Produksi berkurang  : " .  $tri->getCrispValue(0.11547911547912, true);
        echo "<br/>";
        
        // produksi bertambah
        // 224260 224260 350023 
        $tri = new ARShapeTrimf();
        $tri->setName('naik');
        $tri->setA(224260);
        $tri->setB(224260);
        $tri->setC(350023);
        echo  "Produksi bertambah  : " .  $tri->getCrispValue(0.20101263179873, true);
        echo "<br/>";
        
        // produksi bertambah
        // 224260 224260 350023 
        $tri = new ARShapeTrimf();
        $tri->setName('naik');
        $tri->setA(224260);
        $tri->setB(224260);
        $tri->setC(350023);
        echo  "Produksi bertambah  : " .  $tri->getCrispValue(0.79898736820127, true);
        
        die();
    }
}