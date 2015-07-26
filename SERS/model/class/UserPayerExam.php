<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of UserPayerExam
 *
 * @author Alexis
 */
class UserPayerExam {
    
    ///////////////
    // ATTRIBUTS //
    ///////////////
    
    /*
     * @var Date
     */
    private $date;  
    
    /*
     * @var Fichier
     */
    private $extFichier;
    
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
           
    public function UserPayerExam($date=null,
            $extExam=null,$extFichier=null,
            $extUser=null)
    {
        $this->date = $date;
        $this->extFichier = $extFichier;
        $this->extExam = $extExam;
        $this->extUser = $extUser;
    }
    
    /////////////////////
    // GETTERS&SETTERS //
    /////////////////////
    
    //GetterSetter extDate
    public function setDate($date)
    {
        if(is_a($date, "Date"))
        {
            $this->extDate = $date;
        }
    }
    
    public function getDate()
    {
        return $this->extDate;
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

    //GetterSetter extFichier
    public function setFichier($fichier)
    {
        if(is_int($fichier))
        {
            $this->extFichier = FichierDAL::findById($fichier);
        }
        else if(is_a($fichier, "Fichier"))
        {
            $this->extFichier = $fichier;
        }
    }
    
    public function getFichier()
    {
        $fichier = null;
        
        if(is_int($this->extFichier))
        {
            $fichier = FichierDAL::findById($this->extFichier);
            $this->extFichier = $fichier;
        }
        else if(is_a($this->extFichier, "Fichier"))
        {
            $fichier = $this->extFichier;
        }
        return $fichier;
    }
    

    //////////////
    // METHODES //
    //////////////
    
    protected function hydrate($dataSet)
    {
        $this->extFichier = $dataSet['Fichier'];
        $this->date = $dataSet['date'];
        $this->extExam = $dataSet['Exam'];
        $this->extUser = $dataSet['User'];
    }
}
