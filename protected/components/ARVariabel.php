<?php

abstract class ARVariabel 
{
    protected $name;
    protected $type;
    protected $shapes;
    
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

    public function getShapes() {
        return $this->shapes;
    }

    public function setShapes($shapes) {
        $this->shapes = $shapes;
    }
}

?>
