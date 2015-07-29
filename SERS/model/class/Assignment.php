<?php

/**
 * Description of Assignment
 *
 * @author Alexis
 */

require_once('./model/class/Travail.php');

class Assignment extends Travail {

    public function getModule()
    {
        echo "Assignment.assignmentId: ".$this->getId()."</pre>"; //var_dump debug liaison assign<->module
        return ModuleDAL::findByAssignment($this);
    }

}
