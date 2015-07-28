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
    private $bareme;

    /*
     * @var array(User)
     */
    private $eleves = null;

    /*
     * @var Assignment
     */
    private $assignment;

    ///////////////////
    // CONSTRUCTEURS //
    ///////////////////

    public function Module(
    $id = -1, $label = "label default", $description = "description default", $dateCreation = "0000-00-00",
    $number = 0000, $affiche = 1, $bareme = null
    )
    {
        $this->id = $id;
        $this->label = $label;
        $this->dateCreation = $dateCreation;
        $this->description = $description;
        $this->affiche = $affiche;
        $this->number = $number;
        if (is_null($bareme))
        {
            $bareme = BaremeDAL::findDefaultBareme();
        }
        else
        {
            $this->bareme = $bareme;
        }
        $this->assignment = new Assignment();
    }

    /////////////////////
    //     METHODS     //
    /////////////////////

    public function inscrireEleve($eleve)
    {
        if (is_int($eleve))
        {
            if (!array_key_exists($eleve, $this->eleves))
            {
                $this->eleves[$eleve] = UserDAL::findById($eleve);
            }
        }
        else if (is_a($eleve, "User"))
        {
            if (!array_key_exists($eleve->getId(), $this->eleves))
            {
                $this->eleves[$eleve->getId()] = $eleve;
            }
        }
    }

    public function desinscrireEleve($eleve)
    {
        if (is_int($eleve))
        {
            if (array_key_exists($eleve, $this->eleves))
            {
                unset($this->eleves[$eleve]);
            }
        }
        else if (is_a($eleve, "User"))
        {
            if (array_key_exists($eleve->getId(), $this->eleves))
            {
                unset($this->eleves[$eleve->getId()]);
            }
        }
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

    public function setBareme($bareme)
    {
        if (is_int($bareme))
        {
            $this->bareme = BaremeDAL::findById($bareme);
        }
        else if (is_a($bareme, "Bareme"))
        {
            $this->bareme = $bareme;
        }
    }

    public function getBareme()
    {
        $bareme = null;

        if (is_int($this->bareme))
        {
            $bareme = BaremeDAL::findById($this->bareme);
            $this->bareme = $bareme;
        }
        else if (is_a($this->bareme, "Bareme"))
        {
            $bareme = $this->bareme;
        }
        return $bareme;
    }

    public function getEleves()
    {
        return $this->eleves;
    }
    
//    public function setAssignment($assignment)
//    {
//        if (is_int($assignment))
//        {
//            $this->assignment = BaremeDAL::findById($assignment);
//        }
//        else if (is_a($assignment, "Bareme"))
//        {
//            $this->assignment = $assignment;
//        }
//    }
//
//    public function getAssignment()
//    {
//        $assignment = null;
//
//        if (is_int($this->assignment))
//        {
//            $assignment = BaremeDAL::findById($this->assignment);
//            $this->assignment = $assignment;
//        }
//        else if (is_a($this->assignment, "Bareme"))
//        {
//            $assignment = $this->assignment;
//        }
//        return $assignment;
//    }

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
        $this->bareme = $dataSet['bareme_id'];
        $this->assignment = $dataSet['bareme_id'];
    }

}
