<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of TypeUser
 *
 * @author Alexis
 */
class TypeUser {
    
    ///////////////
    // ATTRIBUTS //
    ///////////////
    
    /*
     * @var int
     */
    private $id;
    
    /*
     * @var String
     */
    private $label;
    
    /*
     * @var int
     */
    private $code;
    
    /*
     * @var String
     */
    private $description;
    
    /*
     * @var Date
     */
    private $dateCreation;    
    
    /*
     * @var bool
     */
    private $affiche;
    
    ///////////////////
    // CONSTRUCTEURS //
    ///////////////////
           
    public function TypeFichier($id=-1, $label=null,$code=null,
            $description=null,$dateCreation=null,
            $affiche=null)
    {
        $this->id = $id;
        $this->label = $label;
        $this->code = $code;
        $this->dateCreation = $dateCreation;
        $this->description = $description;
        $this->affiche = $affiche;
    }
    
    /////////////////////
    // GETTERS&SETTERS //
    /////////////////////
    
    //GetterSetter id
    public function setId($id)
    {
        if(is_int($id))
        {
            $this->id = $id;
        }
    }
    
    public function getId()
    {
        return $this->id;
    }
    
    //GetterSetter code
    public function setCode($code)
    {
        if(is_int($code))
        {
            $this->code = $code;
        }
    }
    
    public function getCode()
    {
        return $this->code;
    }
    
    //GetterSetter dateCreation
    public function setDateCreation($dateCreation)
    {
        if(is_a($dateCreation, "Date"))
        {
            $this->dateCreation = $dateCreation;
        }
    }
    
    public function getDateCreation()
    {
        return $this->dateCreation;
    }   

    //GetterSetter label
    public function setLabel($label)
    {
        if(is_string($label))
        {
            $this->label = $label;
        }
    }
    
    public function getLabel()
    {
        return $this->label;
    }

    //GetterSetter description
    public function setDescription($description)
    {
        if(is_string($description))
        {
            $this->description = $description;
        }
    }
    
    public function getDescription()
    {
        return $this->description;
    }  

     //GetterSetter affiche
    public function setAffiche($affiche)
    {
        if(is_bool($affiche))
        {
            $this->affiche = $affiche;
        }
    }
    
    public function getAffiche()
    {
        return $this->affiche;
    }
  
    
    //////////////
    // METHODES //
    //////////////
    
    protected function hydrate($dataSet)
    {
        $this->id = $dataSet['id'];
        $this->label = $dataSet['label'];
        $this->affiche = $dataSet['affiche'];
        $this->dateCreation = $dataSet['dateCreation'];
        $this->description = $dataSet['description'];
        $this->code = $dataSet['code'];
    }
}
