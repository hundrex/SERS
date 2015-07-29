<?php

class Serie {

    public $name;
    public $data = array();

    public function Serie($name = null, $data = array())
    {
        $this->name = $name;
        $this->data = $data;
    }

}
