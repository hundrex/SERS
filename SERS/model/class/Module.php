<?php

/**
 * Description of Module
 *
 * @author Alexis
 */
class Module {

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
     * @var string
     */
    private $description;

    /*
     * @var int
     */
    private $number;

    /*
     * @var bool
     */
    private $affiche;

    /*
     * @var Bareme
     */
    private $extBareme;

    ///////////////////
    // CONSTRUCTEURS //
    ///////////////////

    public function Module($id = -1, $label = null, $description = null, $dateCreation = null, $number = null, $affiche = null, $extBareme = null)
    {
        $this->id = $id;
        $this->label = $label;
        $this->dateCreation = $dateCreation;
        $this->description = $description;
        $this->affiche = $affiche;
        $this->number = $number;
        $this->extBareme = $extBareme;
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

    public function setNumber($number)
    {
        if (is_int($number))
        {
            $this->number = $number;
        }
    }

    public function getNumber()
    {
        return $this->number;
    }

    public function setDateCreation($dateCreation)
    {
        if (is_a($dateCreation, "Date"))
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

    public function setBareme($bareme)
    {
        if (is_int($bareme))
        {
            $this->extBareme = BaremeDAL::findById($bareme);
        }
        else if (is_a($bareme, "Bareme"))
        {
            $this->extBareme = $bareme;
        }
    }

    public function getBareme()
    {
        $bareme = null;

        if (is_int($this->extBareme))
        {
            $bareme = BaremeDAL::findById($this->extBareme);
            $this->extBareme = $bareme;
        }
        else if (is_a($this->extBareme, "Bareme"))
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
        $this->label = $dataSet['label'];
        $this->affiche = $dataSet['affiche'];
        $this->dateCreation = $dataSet['dateCreation'];
        $this->description = $dataSet['description'];
        $this->number = $dataSet['number'];
        $this->extBareme = $dataSet['Bareme'];
    }

}
