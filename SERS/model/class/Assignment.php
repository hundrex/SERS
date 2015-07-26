<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Assignment
 *
 * @author Alexis
 */
class Assignment {
    ///////////////
    // ATTRIBUTS //
    ///////////////
    
    /*
     * @var int
     */
    private $id;
    
    /*
     * @var string
     */
    private $label;
   
    /*
     * @var date
     */
    private $dateCreation;
     
    
    /*
     * @var date
     */
    private $datePassage;
     
    
    /*
     * @var string
     */
    private $description;
    
    /*
     * @var int
     */
    private $annee;

    /*
     * @var bool
     */
    private $affiche;
    
    /*
     * @var Module
     */
    private $extModule;
    
    
    ///////////////////
    // CONSTRUCTEURS //
    ///////////////////
           
    public function Assignment($id=-1, $label=null,$number=null,
            $description=null,$dateCreation=null,$datePassage=null,
            $annee=null, $affiche=null, $extModule=null)
    {
        $this->id = $id;
        $this->label = $label;
        $this->dateCreation = $dateCreation;
        $this->datePassage = $datePassage;
        $this->description = $description;
        $this->affiche = $affiche;
        $this->number = $number;
        $this->annee = $annee;
        $this->extModule = $extModule;
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
    
    //GetterSetter number
    public function setNumber($number)
    {
        if(is_int($number))
        {
            $this->number = $number;
        }
    }
    
    public function getNumber()
    {
        return $this->number;
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
    
    
    //GetterSetter datePassage
    public function setDatePassage($datePassage)
    {
        if(is_a($datePassage, "Date"))
        {
            $this->datePassage = $datePassage;
        }
    }
    
    public function getDatePassage()
    {
        return $this->datePassage;
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

    //GetterSetter module
    public function setModule($module)
    {
        if(is_int($module))
        {
            $this->extModule = ModuleDAL::findById($module);
        }
        else if(is_a($module, "Module"))
        {
            $this->extModule = $module;
        }
    }
    
    public function getModule()
    {
        $module = null;
        
        if(is_int($this->extModule))
        {
            $module = ModuleDAL::findById($this->extModule);
            $this->extModule = $module;
        }
        else if(is_a($this->extModule, "Module"))
        {
            $module = $this->extModule;
        }
        return $module;
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
        $this->datePassage = $dataSet['datePassage'];
        $this->description = $dataSet['description'];
        $this->annee = $dataSet['annee'];
        $this->extModule = $dataSet['Module'];
    }
}
