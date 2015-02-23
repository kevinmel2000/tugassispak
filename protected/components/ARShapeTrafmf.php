<?php

class ARShapeTrafmf extends ARShape
{
    private $a;
    private $b;
    private $c;
    private $d;
            
    public function __construct()
    {
        $this->shapeType = ARVariableShapeType::$VARIABLE_TRAF_MF;
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
    
    public function getD() {
        return $this->d;
    }

    public function setD($d) {
        $this->d = $d;
    }
    
    public function getMembershipFunction($value) 
    {
        if($value < $this->a)
        {
            return 0;
        }
        elseif($value >= $this->a && $value <= $this->b)
        {
            return ($value - $this->a) / (double) (($this->b - $this->a) + 0.00000000000000000000000000001);
        }
        elseif($value >= $this->b && $value <= $this->c)
        {
            return 1;
        }
        elseif($value >= $this->c && $value <= $this->d)
        {
            return ($this->d - $value) / (double) (($this->d - $this->c) + 0.00000000000000000000000000001);
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
        
        if($this->b == $this->c && $this->c  == $this->d)
        {
            // naik
            $linear->setA($this->a);
            $linear->setB($this->b);
            
            $linear->setLinearType(ARVariableShapeType::$VARIABLE_LINEAR_UP_MF);
            
            return $linear->getCrispValue($membershipFunction);
        }
        else if($this->a == $this->b && $this->b == $this->c)
        {
            // turun
            $linear->setA($this->c);
            $linear->setB($this->d);
            
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
        // lebih dari d
        if($membershipFunction == 0)
        {
            return 0;
        }
        // antara b dan c
        elseif($membershipFunction == 1)
        {
            // belum jelas
            return 0;
        }
        elseif($membershipFunction > 0 && $membershipFunction < 1)
        {
            $result = array();
            
            // antara c dan d
            $result[] =  $this->d - ($membershipFunction * ($this->d - $this->c));
            
            // antara a dan b
            $result[] =  ($membershipFunction * ($this->b - $this->a)) + $this->a ;
            
            return $result;
        }
    }
}

?>
