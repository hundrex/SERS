<?php

/**
 * Description of Mail
 *
 * @author Alexis
 */
class Mail {

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
    private $contenu;

    /*
     * @var date
     */
    private $dateEnvoi;

    /*
     * @var User
     */
    private $extUser;

    /*
     * @var ModelMail
     */
    private $extModelMail;

    ///////////////////
    // CONSTRUCTEURS //
    ///////////////////

    public function Mail($id = -1, $extModeleMail = null, $extUser = null, $dateEnvoi = null, $contenu = null)
    {
        $this->id = $id;
        $this->dateEnvoi = $dateEnvoi;
        $this->contenu = $contenu;
        $this->extUser = $extUser;
        $this->extModelMail = $extModeleMail;
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

    public function setDateEnvoi($dateEnvoi)
    {
        if (is_a($dateEnvoi, "Date"))
        {
            $this->dateEnvoi = $dateEnvoi;
        }
    }

    public function getDateEnvoi()
    {
        return $this->dateEnvoi;
    }

    public function setUser($user)
    {
        if (is_int($user))
        {
            $this->extUser = UserDAL::findById($user);
        }
        else if (is_a($user, "User"))
        {
            $this->extUser = $user;
        }
    }

    public function getUser()
    {
        $user = null;

        if (is_int($this->extUser))
        {
            $user = UserDAL::findById($this->extUser);
            $this->extUser = $user;
        }
        else if (is_a($this->extUser, "User"))
        {
            $user = $this->extUser;
        }
        return $user;
    }

    public function setModelMail($modelMail)
    {
        if (is_int($modelMail))
        {
            $this->extModelMail = UserDAL::findById($modelMail);
        }
        else if (is_a($modelMail, "ModelMail"))
        {
            $this->extModelMail = $modelMail;
        }
    }

    public function getModelMail()
    {
        $modelMail = null;

        if (is_int($this->extModelMail))
        {
            $modelMail = UserDAL::findById($this->extModelMail);
            $this->extModelMail = $modelMail;
        }
        else if (is_a($this->extModelMail, "ModelMail"))
        {
            $modelMail = $this->extModelMail;
        }
        return $modelMail;
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

    //////////////
    // METHODES //
    //////////////

    protected function hydrate($dataSet)
    {
        $this->id = $dataSet['id'];
        $this->dateEnvoi = $dataSet['dateEnvoi'];
        $this->contenu = $dataSet['contenu'];
        $this->extModelMail = $dataSet['ModeleMail'];
        $this->extUser = $dataSet['User'];
    }

}
