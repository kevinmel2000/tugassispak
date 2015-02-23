<?php

abstract class ARFis
{
    public static $BILANGAN_KECIL = 0.00000000000000000000000000001;
    
    protected $name;
    protected $type;
    protected $andMethodType;
    protected $orMethodType;
    protected $defuzzificationType;
    protected $variableInputs;
    protected $variableOutputs;
    protected $rules;

    
    public function getName() {
        return $this->name;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function getType() {
        return $this->type;
    }

    public function setType($type) {
        $this->type = $type;
    }

    public function getRules() {
        return $this->rules;
    }

    public function setRules($rules) {
        $this->rules = $rules;
    }

    public function getAndMethodType() {
        return $this->andMethodType;
    }

    public function setAndMethodType($andMethodType) {
        $this->andMethodType = $andMethodType;
    }

    public function getOrMethodType() {
        return $this->orMethodType;
    }

    public function setOrMethodType($orMethodType) {
        $this->orMethodType = $orMethodType;
    }

    public function getDefuzzificationType() {
        return $this->defuzzificationType;
    }

    public function setDefuzzificationType($defuzzificationType) {
        $this->defuzzificationType = $defuzzificationType;
    }

    public function getVariableInputs() {
        return $this->variableInputs;
    }

    public function setVariableInputs($variableInputs) {
        $this->variableInputs = $variableInputs;
    }

    public function getVariableOutputs() {
        return $this->variableOutputs;
    }

    public function setVariableOutputs($variableOutputs) {
        $this->variableOutputs = $variableOutputs;
    }

    
//    public abstract function andMethodMin();
//    public abstract function andMethodProd();
//    
//    public abstract function orMethodMax();
//    public abstract function orMethodProbor();
//    
//    public abstract function implicationMin();
//    public abstract function implicationProd();
//    
//    public abstract function aggregationMax();
//    public abstract function aggregationSum();
//    public abstract function aggregationProbor();
}

?>
