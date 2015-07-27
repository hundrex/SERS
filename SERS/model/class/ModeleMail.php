<?php

/**
 * Description of ModeleMail
 *
 * @author Alexis
 */
class ModeleMail {

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
    private $contenu;

    ///////////////////
    // CONSTRUCTEURS //
    ///////////////////

    public function Mark($id = -1, $label = null, $description = null, $contenu = null)
    {
        $this->id = $id;
        $this->description = $description;
        $this->contenu = $contenu;
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

    public function setContenu($contenu)
    {
        if (is_string($contenu))
        {
            $this->contenu = $contenu;
        }
    }

    public function getContenu()
    {
        return $this->contenu;
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
        $this->contenu = $dataSet['contenu'];
    }

}
