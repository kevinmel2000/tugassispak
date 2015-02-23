<?php

abstract class ARShape 
{
    protected $name;
    protected $shapeType;
    
    public function getName() {
        return $this->name;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function getShapeType() {
        return $this->shapeType;
    }

    public function setShapeType($shapeType) {
        $this->shapeType = $shapeType;
    }
    
    public abstract function getMembershipFunction($value);
    public abstract function getCrispValue($membershipFunction);
}

?>
