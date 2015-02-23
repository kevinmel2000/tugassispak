<?php

class ARShapeTrimf extends ARShape
{
    private $a;
    private $b;
    private $c;
            
    public function __construct()
    {
        $this->shapeType = ARVariableShapeType::$VARIABLE_TRI_MF;
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

    public function getC() {
        return $this->c;
    }

    public function setC($c) {
        $this->c = $c;
    }
    
    public function getMembershipFunction($value) 
    {
        if($value < $this->a)
        {
            return 0;
        }
        else if($value >= $this->a && $value <= $this->b)
        {
            return ($value - $this->a) / (double) (($this->b - $this->a) + 0.00000000000000000000000000001);
        }
        else if($value > $this->b && $value <= $this->c)
        {
            return ($this->c - $value) / (double) (($this->c - $this->b) + 0.00000000000000000000000000001);
        }
        else
        {
            return 0;
        }
    }
    
    public function getCrispValue($membershipFunction, $isMonoatomic = false)
    {
        if($isMonoatomic == true)
        {
            return $this->getCrispValueMonoatomic($membershipFunction);
        }
        else
        {
            return $this->getCrispValuePolyatomic($membershipFunction);
        }
    }
    
    private function getCrispValueMonoatomic($membershipFunction)
    {
        $linear = new ARShapeLinearmf();
        
        if($this->b == $this->c)
        {
            // naik
            $linear->setA($this->a);
            $linear->setB($this->b);
            
            $linear->setLinearType(ARVariableShapeType::$VARIABLE_LINEAR_UP_MF);
            
            return $linear->getCrispValue($membershipFunction);
        }
        else if($this->a == $this->b)
        {
            // turun
            $linear->setA($this->b);
            $linear->setB($this->c);
            
            $linear->setLinearType(ARVariableShapeType::$VARIABLE_LINEAR_DOWN_MF);
            
            return $linear->getCrispValue($membershipFunction);
        }
        else
        {
            return false;
        }
    }
    
    private function getCrispValuePolyatomic($membershipFunction)
    {
        // kurang dari a
        // lebih dari c
        if($membershipFunction == 0)
        {
            return 0;
        }
        elseif($membershipFunction > 0 && $membershipFunction < 1)
        {
            $result = array();
            
            // antara b dan c
            $result[] =  $this->c - ($membershipFunction * ($this->c - $this->b));
            
            // antara a dan b
            $result[] = ($membershipFunction * ($this->b - $this->a)) + $this->a ;
            
            return $result;
        }
    }
}

?>
