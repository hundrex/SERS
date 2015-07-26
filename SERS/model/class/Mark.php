<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Mark
 *
 * @author Alexis
 */
class Mark {
    ///////////////
    // ATTRIBUTS //
    ///////////////
    
    /*
     * @var int
     */
    private $id;
    
    /*
     * @var int
     */
    private $mini;
    
    /*
     * @var int
     */
    private $maxi;
    
    /*
     * @var string
     */
    private $grade;
   
    /*
     * @var string
     */
    private $extBareme;
   
    ///////////////////
    // CONSTRUCTEURS //
    ///////////////////
           
    public function Mark($id=-1, $mini=null, $maxi=null, $extBareme=null, $grade=null)
    {
        $this->id = $id;
        $this->maxi = $maxi;
        $this->mini = $mini;
        $this->extBareme = $extBareme;
        $this->grade = $grade;
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
    
    //GetterSetter mini
    public function setMini($mini)
    {
        if(is_int($mini))
        {
            $this->mini = $mini;
        }
    }
    
    public function getMini()
    {
        return $this->mini;
    }

    //GetterSetter maxi
    public function setMaxi($maxi)
    {
        if(is_int($maxi))
        {
            $this->maxi = $maxi;
        }
    }
    
    public function getMaxi()
    {
        return $this->maxi;
    }
    
    //GetterSetter grade
    public function setGrade($grade)
    {
        if(is_string($grade))
        {
            $this->grade = $grade;
        }
    }
    
    public function getGrade()
    {
        return $this->grade;
    }
    
    
    //GetterSetter bareme
    public function setBareme($bareme)
    {
        if(is_int($bareme))
        {
            $this->extBareme = BaremeDAL::findById($bareme);
        }
        else if(is_a($bareme, "Bareme"))
        {
            $this->extBareme = $bareme;
        }
    }
    
    public function getBareme()
    {
        $bareme = null;
        
        if(is_int($this->extBareme))
        {
            $bareme = BaremeDAL::findById($this->extBareme);
            $this->extBareme = $bareme;
        }
        else if(is_a($this->extBareme, "Bareme"))
        {
            $bareme = $this->extBareme;
        }
        return $bareme;
    }
    
    //////////////
    // METHODES //
    //////////////
    
    protected function hydrate($dataSet)
    {
        $this->id = $dataSet['id'];
        $this->mini = $dataSet['mini'];
        $this->maxi = $dataSet['maxi'];
        $this->grade = $dataSet['grade'];
        $this->extBareme = $dataSet['Bareme'];
    }
}
