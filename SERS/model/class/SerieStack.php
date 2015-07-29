<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/SERS/SERS/model/class/Serie.php';

class SerieStack extends Serie{
    public $stack;
    public $color;
    
    public function SerieStack($name = null, $data = array(), $stack = null, $color = null)
    {
        $this->name = $name;
        $this->data = $data;
        $this->stack = $stack;
        $this->color = $color;
    }
}
