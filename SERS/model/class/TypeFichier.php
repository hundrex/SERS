<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of TypeFichier
 *
 * @author Alexis
 */
class TypeFichier {
    
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
     * @var String
     */
    private $description;
    
    /*
     * @var String
     */
    private $chemin;
    
    
    ///////////////////
    // CONSTRUCTEURS //
    ///////////////////
           
    public function Mark($id=-1, $label=null, $description=null, $chemin=null)
    {
        $this->id = $id;
        $this->description = $description;
        $this->chemin = $chemin;
        $this->label = $label;
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
    
    //GetterSetter chemin
    public function setChemin($chemin)
    {
        if(is_string($chemin))
        {
            $this->chemin = $chemin;
        }
    }
    
    public function getChemin()
    {
        return $this->chemin;
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
    
    //////////////
    // METHODES //
    //////////////
    
    protected function hydrate($dataSet)
    {
        $this->id = $dataSet['id'];
        $this->label = $dataSet['label'];
        $this->description = $dataSet['description'];
        $this->chemin = $dataSet['chemin'];
    }
}
