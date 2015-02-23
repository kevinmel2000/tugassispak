<?php

class ARShapeLinearmf extends ARShape
{
    private $a;
    private $b;
    private $linearType;
            
    public function __construct()
    {
        $this->shapeType = ARVariableShapeType::$VARIABLE_LINEAR_MF;
        $this->linearType = ARVariableShapeType::$VARIABLE_LINEAR_UP_MF;
    }
    
    public function getA() {
        return $this->a;
    }

    public function setA($a) {
        $this->a = $a;
    }

    public function getB() {
        return $this->b;
    }

    public function setB($b) {
        $this->b = $b;
    }
    
    public function getLinearType() {
        return $this->linearType;
    }

    public function setLinearType($linearType) {
        $this->linearType = $linearType;
    }

    public function getMembershipFunction($value) 
    {
        if($this->linearType == ARVariableShapeType::$VARIABLE_LINEAR_UP_MF)
        {
            return $this->getMembershipFunctionUpType($value);
        }
        else
        {
            return $this->getMembershipFunctionDownType($value);
        }
    }
    
    private function getMembershipFunctionUpType($value)
    {
        return ($value - $this->a) / (double) (($this->b - $this->a) + 0.00000000000000000000000000001);
    }
    
    private function getMembershipFunctionDownType($value)
    {
        return ($this->b - $value) / (double) (($this->b - $this->a) + 0.00000000000000000000000000001);
    }
    
    public function getCrispValue($membershipFunction)
    {
        if($this->linearType == ARVariableShapeType::$VARIABLE_LINEAR_UP_MF)
        {
            return $this->getCrispValueUpType($membershipFunction);
        }
        else
        {
            return $this->getCrispValueDownType($membershipFunction);
        }
    }
    
    private function getCrispValueUpType($membershipFunction)
    {
        return ($membershipFunction * ($this->b - $this->a)) + $this->a ;
    }
    
    private function getCrispValueDownType($membershipFunction)
    {
        return $this->b - ($membershipFunction * ($this->b - $this->a));
    }
}

?>
