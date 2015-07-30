<?php

/**
 * Description of Assignment
 *
 * @author Alexis
 */

require_once($_SERVER['DOCUMENT_ROOT'] . '/SERS/SERS/model/class/Travail.php');

class Assignment extends Travail {

    public function getModule()
    {
        return ModuleDAL::findByAssignment($this);
    }

}
