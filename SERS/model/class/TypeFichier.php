<?php

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

    public function Mark($id = -1, $label = "label par defaut", $description = "description par defaut", $chemin = "/")
    {
        $this->id = $id;
        $this->description = $description;
        $this->chemin = $chemin;
        $this->label = $label;
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

    public function setChemin($chemin)
    {
        if (is_string($chemin))
        {
            $this->chemin = $chemin;
        }
    }

    public function getChemin()
    {
        return $this->chemin;
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
