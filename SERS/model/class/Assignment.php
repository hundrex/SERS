<?php

/**
 * Description of Assignment
 *
 * @author Alexis
 */
class Assignment extends Travail {

    public function getModule()
    {
        return ModuleDAL::findByAssignment($this);
    }

}
