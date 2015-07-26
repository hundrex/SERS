<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of UserParticipeExam
 *
 * @author Alexis
 */
class UserParticipeExam {
    
    ///////////////
    // ATTRIBUTS //
    ///////////////
    
    /*
     * @var int
     */
    private $note;
    
    /*
     * @var Date
     */
    private $dateRemise;    
    
    /*
     * @var Exam
     */
    private $extExam;
    
    /*
     * @var User
     */
    private $extUser;
    
    
 ///////////////////
    // CONSTRUCTEURS //
    ///////////////////
           
    public function TypeFichier($note=-1, $dateRemise=null,
            $extExam=null,
            $extUser=null)
    {
        $this->dateRemise = $dateRemise;
        $this->note = $note;
        $this->extExam = $extExam;
        $this->extUser = $extUser;
    }
    
    /////////////////////
    // GETTERS&SETTERS //
    /////////////////////
    
    //GetterSetter note
    public function setNote($note)
    {
        if(is_int($note))
        {
            $this->note = $note;
        }
    }
    
    public function getNote()
    {
        return $this->note;
    }
    
    //GetterSetter extDateRemise
    public function setDateRemise($dateRemise)
    {
        if(is_a($dateRemise, "Date"))
        {
            $this->extDateRemise = $dateRemise;
        }
    }
    
    public function getDateRemise()
    {
        return $this->extDateRemise;
    }   

    //GetterSetter extUser
    public function setUser($user)
    {
        if(is_int($user))
        {
            $this->extUser = UserDAL::findById($user);
        }
        else if(is_a($user, "User"))
        {
            $this->extUser = $user;
        }
    }
    
    public function getUser()
    {
        $user = null;
        
        if(is_int($this->extUser))
        {
            $user = UserDAL::findById($this->extUser);
            $this->extUser = $user;
        }
        else if(is_a($this->extUser, "User"))
        {
            $user = $this->extUser;
        }
        return $user;
    }
    
   //GetterSetter extExam
    public function setExam($exam)
    {
        if(is_int($exam))
        {
            $this->extExam = ExamDAL::findById($exam);
        }
        else if(is_a($exam, "Exam"))
        {
            $this->extExam = $exam;
        }
    }
    
    public function getExam()
    {
        $exam = null;
        
        if(is_int($this->extExam))
        {
            $exam = ExamDAL::findById($this->extExam);
            $this->extExam = $exam;
        }
        else if(is_a($this->extExam, "Exam"))
        {
            $exam = $this->extExam;
        }
        return $exam;
    }

    //////////////
    // METHODES //
    //////////////
    
    protected function hydrate($dataSet)
    {
        $this->note = $dataSet['note'];
        $this->dateRemise = $dataSet['dateRemise'];
        $this->extExam = $dataSet['Exam'];
        $this->extUser = $dataSet['User'];
    }
}
