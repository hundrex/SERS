<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of UserParticipeAssignment
 *
 * @author Alexis
 */
class UserParticipeAssignment {
    
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
           
    public function TypeFichier($note=-1, $dateRemise=null,
            $extAssignment=null,
            $extUser=null)
    {
        $this->dateRemise = $dateRemise;
        $this->note = $note;
        $this->extAssignment = $extAssignment;
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
    
   //GetterSetter extAssignment
    public function setAssignment($assignment)
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

    //////////////
    // METHODES //
    //////////////
    
    protected function hydrate($dataSet)
    {
        $this->note = $dataSet['note'];
        $this->dateRemise = $dataSet['dateRemise'];
        $this->extAssignment = $dataSet['Assignment'];
        $this->extUser = $dataSet['User'];
    }
}
