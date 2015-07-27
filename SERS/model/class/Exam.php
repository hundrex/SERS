<?php

/**
 * Description of Exam
 *
 * @author Alexis
 */
class Exam extends Travail {

    public function getModule()
    {
        return ModuleDAL::findByExam($this);
    }

}
