<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of UserPayerAssignment
 *
 * @author Alexis
 */
class UserPayerAssignment {
    
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
     * @var Assignment
     */
    private $extAssignment;
    
    /*
     * @var User
     */
    private $extUser;
    
    
 ///////////////////
    // CONSTRUCTEURS //
    ///////////////////
           
    public function UserPayerAssignment($date=null,
            $extAssignment=null,$extFichier=null,
            $extUser=null)
    {
        $this->date = $date;
        $this->extFichier = $extFichier;
        $this->extAssignment = $extAssignment;
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
    
   //GetterSetter extAssignment
    public function setAssigment($assignment)
    {
        if(is_int($assignment))
        {
            $this->extAssignment = AssignmentDAL::findById($assignment);
        }
        else if(is_a($assignment, "Assignment"))
        {
            $this->extAssignment = $assignment;
        }
    }
    
    public function getAssignment()
    {
        $assignment = null;
        
        if(is_int($this->extAssignment))
        {
            $assignment = AssignmentDAL::findById($this->extAssignment);
            $this->extAssignment = $assignment;
        }
        else if(is_a($this->extAssignment, "Assignment"))
        {
            $assignment = $this->extAssignment;
        }
        return $assignment;
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
        $this->extAssignment = $dataSet['Assignment'];
        $this->extUser = $dataSet['User'];
    }
}
