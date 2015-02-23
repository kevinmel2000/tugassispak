<?php

class ARRule 
{
    protected $order;
    protected $inputs;
    protected $outputs;
    protected $inputConnection;
    protected $conclusions;
    
    public static $CONNECTION_AND = 'AND';
    public static $CONNECTION_OR = 'OR';
    public static $NONE = 'NONE';
    
    public function getOrder() {
        return $this->order;
    }

    public function setOrder($order) {
        $this->order = $order;
    }

    public function getInputs() {
        return $this->inputs;
    }

    public function setInputs($inputs) {
        $this->inputs = $inputs;
    }

    public function getOutputs() {
        return $this->outputs;
    }

    public function setOutputs($outputs) {
        $this->outputs = $outputs;
    }

    public function getInputConnection() {
        return $this->inputConnection;
    }

    public function setInputConnection($inputConnection) {
        $this->inputConnection = $inputConnection;
    }

    public function getConclusions() {
        return $this->conclusions;
    }

    public function setConclusions($conclusions) {
        $this->conclusions = $conclusions;
    }
}

?>
