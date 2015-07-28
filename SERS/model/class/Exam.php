<?php

/**
 * Description of Exam
 *
 * @author Alexis
 */

require_once('F:/htdocs/webdev-405-G1/SERS/SERS/model/class/Travail.php');

class Exam extends Travail {

    public function getModule()
    {
        return ModuleDAL::findByExam($this);
    }

}
