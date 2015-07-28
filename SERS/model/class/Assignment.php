<?php

/**
 * Description of Assignment
 *
 * @author Alexis
 */

require_once('F:/htdocs/webdev-405-G1/SERS/SERS/model/class/Travail.php');

class Assignment extends Travail {

    public function getModule()
    {
        return ModuleDAL::findByAssignment($this);
    }

}
