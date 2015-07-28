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
    private $destinataire;

    /*
     * @var ModelMail
     */
    private $modele;

    ///////////////////
    // CONSTRUCTEURS //
    ///////////////////

    public function Mail($id = -1, $modele = 1, 
            $destinataire = null, $dateEnvoi = "0000-00-00", 
            $contenu = "corp mail defaut")
    {
        $this->id = $id;
        $this->dateEnvoi = $dateEnvoi;
        $this->contenu = $contenu;
        $this->destinataire = $destinataire;
        $this->modele = $modele;
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
        if (is_string($dateEnvoi))
        {
            $this->dateEnvoi = $dateEnvoi;
        }
    }

    public function getDateEnvoi()
    {
        return $this->dateEnvoi;
    }

    public function setDestinataire($user)
    {
        if (is_int($user))
        {
            $this->destinataire = UserDAL::findById($user);
        }
        else if (is_a($user, "User"))
        {
            $this->destinataire = $user;
        }
    }

    public function getDestinataire()
    {
        $user = null;

        if (is_int($this->destinataire))
        {
            $user = UserDAL::findById($this->destinataire);
            $this->destinataire = $user;
        }
        else if (is_a($this->destinataire, "User"))
        {
            $user = $this->destinataire;
        }
        return $user;
    }

    public function setModelMail($modelMail)
    {
        if (is_int($modelMail))
        {
            $this->modele = UserDAL::findById($modelMail);
        }
        else if (is_a($modelMail, "ModelMail"))
        {
            $this->modele = $modelMail;
        }
    }

    public function getModelMail()
    {
        $modelMail = null;

        if (is_int($this->modele))
        {
            $modelMail = UserDAL::findById($this->modele);
            $this->modele = $modelMail;
        }
        else if (is_a($this->modele, "ModelMail"))
        {
            $modelMail = $this->modele;
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
        $this->dateEnvoi = $dataSet['date_envoi'];
        $this->contenu = $dataSet['contenu'];
        $this->modele = $dataSet['modele_mail_id'];
        $this->destinataire = $dataSet['user_id'];
    }

}
