<?php

/**
 * Description of Travail
 *
 * @author Alexis
 */
abstract class Travail {

    ///////////////
    // ATTRIBUTS //
    ///////////////

    /*
     * @var int
     */
    protected $id;

    /*
     * @var string
     */
    protected $label;

    /*
     * @var date
     */
    protected $dateCreation;

    /*
     * @var date
     */
    protected $datePassage;

    /*
     * @var string
     */
    protected $description;

    /*
     * @var int
     */
    protected $prixRattrapage;

    /*
     * @var bool
     */
    protected $affiche;
    
    /*
     * @var Note
     */
    protected $note;
    
    /*
     * @var bool
     */
    protected $rattrapage;

    ///////////////////
    // CONSTRUCTEURS //
    ///////////////////

    public function Travail($id = -1, $label = "default label", $number = 0000, 
            $description = "description default", $dateCreation = "0000-00-00", 
            $datePassage = "0000-00-00", $affiche = 1, 
            $prixRattrapage = 0, $rattrapage = 0)
    {
        $this->id = $id;
        $this->label = $label;
        $this->dateCreation = $dateCreation;
        $this->datePassage = $datePassage;
        $this->description = $description;
        $this->affiche = $affiche;
        $this->number = $number;
        $this->prixRattrapage = $prixRattrapage;
        $this->rattrapage = $rattrapage;
    }

    /**
     * Méthode permettant de retrouver le module correspondant au travail en question.
     * Doit être redéfinie dans les classes filles.
     */
    public abstract function getModule();

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

    public function setPrixRattrapage($prixRattrapage)
    {
        if (is_int($prixRattrapage))
        {
            $this->prixRattrapage = $prixRattrapage;
        }
    }

    public function getPrixRattrapage()
    {
        return $this->prixRattrapage;
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
        if (is_string($dateCreation))
        {
            $this->dateCreation = $dateCreation;
        }
    }

    public function getDateCreation()
    {
        return $this->dateCreation;
    }

    public function setDatePassage($datePassage)
    {
        if (is_string($datePassage))
        {
            $this->datePassage = $datePassage;
        }
    }

    public function getDatePassage()
    {
        return $this->datePassage;
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
    
        public function setRattrapage($retry)
    {
        if (is_bool($retry))
        {
            $this->rattrapage = $retry;
        }
    }

    public function getRattrapage()
    {
        return $this->rattrapage;
    }
    
    public function setNote($note)
    {
        if (is_a($note, "Note"))
        {
            $this->note = $note;
        }
    }

    public function getNote()
    {
        return $this->note;
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
        $this->datePassage = $dataSet['date_passage'];
        $this->description = $dataSet['description'];
        $this->note = $dataSet['note'];
        $this->rattrapage = $dataSet['rattrapage'];
    }

}
