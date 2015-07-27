<?php

/**
 * Description of Travail
 *
 * @author Alexis
 */
class Travail {

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
    protected $annee;

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

    ///////////////////
    // CONSTRUCTEURS //
    ///////////////////

    public function Travail($id = -1, $label = null, $number = null, $description = null, $dateCreation = null, $datePassage = null, $annee = null, $affiche = null, $extModule = null, $prixRattrapage = null)
    {
        $this->id = $id;
        $this->label = $label;
        $this->dateCreation = $dateCreation;
        $this->datePassage = $datePassage;
        $this->description = $description;
        $this->affiche = $affiche;
        $this->number = $number;
        $this->annee = $annee;
        $this->prixRattrapage = $prixRattrapage;
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
        if (is_a($dateCreation, "Date"))
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
        if (is_a($datePassage, "Date"))
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
        $this->dateCreation = $dataSet['dateCreation'];
        $this->datePassage = $dataSet['datePassage'];
        $this->description = $dataSet['description'];
        $this->annee = $dataSet['annee'];
        $this->note = $dataSet['note'];
    }

}
