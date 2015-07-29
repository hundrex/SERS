<?php

/**
 * Description of Exam
 *
 * @author Alexis
 */

require_once($_SERVER['DOCUMENT_ROOT'] . '/SERS/SERS/model/class/Travail.php');

class Exam extends Travail {

    public function getModule()
    {
        return ModuleDAL::findByExam($this);
    }

}
