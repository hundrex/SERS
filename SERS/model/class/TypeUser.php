<?php

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

    public function TypeFichier($id = -1, $label = "label par defaut", $code = 0000, 
            $description = "description par defaut", 
            $dateCreation = "0000-00-00", $affiche = 1)
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
    public function setId($id)
    {
        if (is_int($id))
        {
            $this->id = $id;
        }
    }

    public function getId()
    {
        return $this->id;
    }

    public function setCode($code)
    {
        if (is_int($code))
        {
            $this->code = $code;
        }
    }

    public function getCode()
    {
        return $this->code;
    }

    public function setDateCreation($dateCreation)
    {
        if (is_string($dateCreation))
        {
            $this->dateCreation = $dateCreation;
        }
    }

    public function getDateCreation()
    {
        return $this->dateCreation;
    }

    public function setLabel($label)
    {
        if (is_string($label))
        {
            $this->label = $label;
        }
    }

    public function getLabel()
    {
        return $this->label;
    }

    public function setDescription($description)
    {
        if (is_string($description))
        {
            $this->description = $description;
        }
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setAffiche($affiche)
    {
        if (is_bool($affiche))
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
        $this->dateCreation = $dataSet['date_creation'];
        $this->description = $dataSet['description'];
        $this->code = $dataSet['code'];
    }

}
