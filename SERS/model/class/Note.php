<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Note
 *
 * @author Alexis
 */
class Note {
    
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
     * @var Travail
     */
    private $extTravail;
    
    /*
     * @var User
     */
    private $Eleve;
    
    /*
     * @var User
     */
    private $Enseignant;
  
    ///////////////////
    // CONSTRUCTEURS //
    ///////////////////
           
    public function Note($note=-1, $dateRemise=null,
            $extTravail=null,
            $Eleve=null, $Enseignant=null)
    {
        $this->dateRemise = $dateRemise;
        $this->note = $note;
        $this->extTravail = $extTravail;
        $this->Eleve = $Eleve;
        $this->Enseignant = $Enseignant;
    }
    
    /////////////////////
    // GETTERS&SETTERS //
    /////////////////////
    
    //GetterSetter note
    public function setNote($note)
    {
        if(is_int($note) && $note<=100 && $note>=0)
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

    //GetterSetter Eleve
    public function setEleve($extEleve)
    {
        if(is_int($extEleve))
        {
            $this->Eleve = UserDAL::findById($extEleve);
        }
        else if(is_a($extEleve, "User"))
        {
            $this->Eleve = $extEleve;
        }
    }
    
    public function getEleve()
    {
        $extEleve = null;
        
        if(is_int($this->Eleve))
        {
            $extEleve = UserDAL::findById($this->Eleve);
            $this->Eleve = $extEleve;
        }
        else if(is_a($this->Eleve, "User"))
        {
            $extEleve = $this->Eleve;
        }
        return $extEleve;
    }
    
        //GetterSetter Enseignant
    public function setEnseignant($extEnseignant)
    {
        if(is_int($extEnseignant))
        {
            $this->Enseignant = UserDAL::findById($extEnseignant); 
        }
        else if(is_a($extEnseignant, "User"))
        {
            $this->Enseignant = $extEnseignant;
        }
    }
    
    public function getEnseignant()
    {
        $extEnseignant = null;
        
        if(is_int($this->Enseignant))
        {
            $extEnseignant = UserDAL::findById($this->Enseignant);
            $this->Enseignant = $extEnseignant;
        }
        else if(is_a($this->Enseignant, "User"))
        {
            $extEnseignant = $this->Enseignant;
        }
        return $extEnseignant;
    }
    
   //GetterSetter extTravail
    public function setTravail($travail)
    {
        if(is_int($travail))
        {
            $this->extTravail = TravailDAL::findById($travail); //rustine car travailDAL n'existe pas
        }
        else if(is_a($travail, "Travail"))
        {
            $this->extTravail = $travail;
        }
    }
    
    public function getTravail()
    {
        $travail = null;
        
        if(is_int($this->extTravail))
        {
            $travail = TravailDAL::findById($this->extTravail); //rustine car travailDAL n'existe pas
            $this->extTravail = $travail;
        }
        else if(is_a($this->extTravail, "Travail"))
        {
            $travail = $this->extTravail;
        }
        return $travail;
    }

    //////////////
    // METHODES //
    //////////////
    
    protected function hydrate($dataSet)
    {
        $this->note = $dataSet['note'];
        $this->dateRemise = $dataSet['dateRemise'];
        $this->extTravail = $dataSet['extTravail'];
        //$this->Eleve = $dataSet['Eleve'];
        //$this->Enseignant = $dataSet['Enseignant'];
    }
}
