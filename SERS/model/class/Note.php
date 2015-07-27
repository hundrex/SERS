<?php

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
     * @var User
     */
    private $eleve;

    /*
     * @var User
     */
    private $enseignant;

    ///////////////////
    // CONSTRUCTEURS //
    ///////////////////

    public function Note($note = -1, $dateRemise = null,
            $Eleve = null, $Enseignant = null)
    {
        $this->dateRemise = $dateRemise;
        $this->note = $note;
        $this->eleve = $Eleve;
        $this->enseignant = $Enseignant;
    }

    /////////////////////
    // GETTERS&SETTERS //
    /////////////////////

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

    public function setDateRemise($dateRemise)
    {
        if(is_a($dateRemise, "Date"))
        {
            $this->dateRemise = $dateRemise;
        }
    }

    public function getDateRemise()
    {
        return $this->dateRemise;
    }

    // **************************************************************
    // *** Getters et setters particuliers (chargement paresseux) ***
    // **************************************************************

    public function setEleve($extEleve)
    {
        if(is_int($extEleve))
        {
            $this->eleve = UserDAL::findById($extEleve);
        }
        else if(is_a($extEleve, "User"))
        {
            $this->eleve = $extEleve;
        }
    }

    public function getEleve()
    {
        $extEleve = null;

        if(is_int($this->eleve))
        {
            $extEleve = UserDAL::findById($this->eleve);
            $this->eleve = $extEleve;
        }
        else if(is_a($this->eleve, "User"))
        {
            $extEleve = $this->eleve;
        }
        return $extEleve;
    }

    public function setEnseignant($enseignant)
    {
        if(is_int($enseignant))
        {
            $this->enseignant = UserDAL::findById($enseignant);
        }
        else if(is_a($enseignant, "User"))
        {
            $this->enseignant = $enseignant;
        }
    }

    public function getEnseignant()
    {
        $enseignant = null;

        if(is_int($this->enseignant))
        {
            $enseignant = UserDAL::findById($this->enseignant->getId());
            $this->enseignant = $enseignant;
        }
        else if(is_a($this->enseignant, "User"))
        {
            $enseignant = $this->enseignant;
        }
        return $enseignant;
    }
    
    //////////////
    // METHODES //
    //////////////

    protected function hydrate($dataSet)
    {
        $this->note = $dataSet['note'];
        $this->dateRemise = $dataSet['dateRemise'];
        //$this->eleve = $dataSet['Eleve'];
        //$this->enseignant = $dataSet['Enseignant'];
    }
}
