<?php

/*
 * Description of User
 * 
 * @author Alexis
 */

require_once($_SERVER['DOCUMENT_ROOT'] . '/SERS/SERS/model/DAL/TypeUserDAL.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/SERS/SERS/model/DAL/ModuleDAL.php');

class User {

    const TYPE_USER_STUDENT = 3;

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
    protected $prenom;

    /*
     * @var string
     */
    protected $nom;

    /*
     * @var string
     */
    protected $mail;

    /*
     * @var string
     */
    protected $adresse;

    /*
     * @var date
     */
    protected $dateNaissance;

    /*
     * @var date
     */
    protected $dateCreation;


    /*
     * @var string
     */
    protected $pseudo;

    /*
     * @var string
     */
    protected $password;

    /*
     * @var bool
     */
    protected $affiche;

    /*
     * @var Fichier
     */
    protected $avatar;

    /*
     * @var TypeUser
     */
    protected $type;

    ///////////////////
    // CONSTRUCTEURS //
    ///////////////////

    public function User(
    $id = -1, $adresse = "rue par defaut", $prenom = "prenomDefaut", $mail = "mail@defaut", $nom = "nomDefaut", $dateNaissance = "0000-00-00", $dateCreation = "0000-00-00", $affiche = 1, $password = "Change!_3", $pseudo = "prenomDefaut.nomDefaut", $typeUser = 4, $fichier = null
    )
    {
        $this->id = $id;
        $this->adresse = $adresse;
        $this->affiche = $affiche;
        $this->dateCreation = $dateCreation;
        $this->dateNaissance = $dateNaissance;
        $this->avatar = $fichier;
        $this->type = $typeUser;
        $this->mail = $mail;
        $this->nom = $nom;
        $this->password = $password;
        $this->prenom = $prenom;
        $this->pseudo = $pseudo;
    }

    /**
     * Fonction permettant de savoir si l'utilisateur est un étudiant.
     * 
     * @return boolean true si c'est un étudiant, false sinon
     */
    public function isStudent()
    {
        return $this->getType()->getCode() === self::TYPE_USER_STUDENT;
    }

    /**
     * Retourne la moyenne d'un student de l'ensemble de ses assignment
     * @return int
     */
    public function getMoyenneAssignment()
    {
        if ($this->isStudent()) //si le code de l'user correspond a celui d'un student
        {
            return UserDAL::moyenneAssignment($this->id);
        }
        else
        {
            echo "User.getMoyenneAssignment: Vous demandez la moyenne d'un User qui n'est pas un student";
        }
    }

    /**
     * Retourne la moyenne d'un student de l'ensemble de ses exam
     * @return int
     */
    public function getMoyenneExam()
    {
        if ($this->isStudent()) //si le code de l'user correspond a celui d'un student
        {
            return UserDAL::moyenneExam($this->id);
        }
        else
        {
            echo "User.getMoyenneExam: Vous demandez la moyenne d'un User qui n'est pas un student";
        }
    }

    /**
     * Retourne la moyenne final d'un student
     * @return int 
     */
    public function getMoyenneFinal()
    {
        if ($this->isStudent())
        {
            $moyExam = $this->getMoyenneExam();
            $moyAssign = $this->getMoyenneAssignment();
            $moyFinal = ($moyAssign + $moyExam) / 2;
            return $moyFinal;
        }
        else
        {
            echo "User.getMoyenneFinal: Vous demandez la moyenne d'un User qui n'est pas un student";
        }
    }

    /**
     * Methode retourne la note d'un assignment d'un eleve, dans un module donnée
     * @param type $moduleId
     * @return type
     */
    public function getNoteStudentAssignment($moduleId)
    {
        $noteStdAssign;
        if ($this->isStudent())
        {
            $studentId = $this->getId();
            $noteStdAssign = $this->getNoteStudentAssignment($studentId, $moduleId);
            return $noteStdAssign;
        }
    }

    /**
     *  Methode retourne la note d'un exam d'un eleve, dans un module donnée
     * @param type $moduleId
     * @return type
     */
    public function getNoteStudentExam($moduleId)
    {
        $noteStdExam;
        if ($this->isStudent())
        {
            $studentId = $this->getId();
            $noteStdExam = $this->getNoteStudentExam($studentId, $moduleId);
            return $noteStdExam;
        }
    }

    /**
     * Methode retournant la moyenne d'un étudiant donnée dans un module donnée
     * (note Exam + note Assignment) / 2
     * @param int $moduleId
     * @return int $noteStdFinal
     */
    public function getNoteStudentFinal($moduleId)
    {
        $noteStdFinal;
        if ($this->isStudent())
        {
            $noteAssign = $this->getNoteStudentAssignment($moduleId);
            $noteExam = $this->getNoteStudentExam($moduleId);
            $noteStdFinal = ($noteAssign + $noteExam) / 2;
            return $noteStdFinal;
        }
    }

    /////////////////////
    // GETTERS&SETTERS //
    /////////////////////

    public function setId($id)
    {
        if (is_string($id))
        {
            $this->id = (int) $id;
        }
        else if (is_int($id))
        {
            $this->id = $id;
        }
    }

    public function getId()
    {
        return $this->id;
    }

    public function setPrenom($prenom)
    {
        if (is_string($prenom))
        {
            $this->prenom = $prenom;
        }
    }

    public function getPrenom()
    {
        return $this->prenom;
    }

    public function setNom($nom)
    {
        if (is_string($nom))
        {
            $this->nom = $nom;
        }
    }

    public function getNom()
    {
        return $this->nom;
    }

    public function setMail($mail)
    {
        if (is_string($mail))
        {
            $this->mail = $mail;
        }
    }

    public function getMail()
    {
        return $this->mail;
    }

    public function setAdresse($adresse)
    {
        if (is_string($adresse))
        {
            $this->adresse = $adresse;
        }
    }

    public function getAdresse()
    {
        return $this->adresse;
    }

    public function setDateNaissance($dateNaissance)
    {
        if (is_string($dateNaissance))
        {
            $this->dateNaissance = $dateNaissance;
        }
    }

    public function getDateNaissance()
    {
        return $this->dateNaissance;
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

    public function setPseudo($pseudo)
    {
        if (is_string($pseudo))
        {
            $this->pseudo = $pseudo;
        }
    }

    public function getPseudo()
    {
        return $this->pseudo;
    }

    public function setPassword($password)
    {
        if (is_string($password))
        {
            $this->password = $password;
        }
    }

    public function getPassword()
    {
        return $this->password;
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

    public function setAvatar($fichier)
    {
        if (is_int($fichier))
        {
            $this->avatar = FichierDAL::findById($fichier);
        }
        else if (is_a($fichier, "Fichier"))
        {
            $this->avatar = $fichier;
        }
    }

    public function getAvatar()
    {
        $fichier = null;

        if (is_int($this->avatar))
        {
            $fichier = FichierDAL::findById($this->avatar);
            $this->avatar = $fichier;
        }
        else if (is_a($this->avatar, "Fichier"))
        {
            $fichier = $this->avatar;
        }
        return $fichier;
    }

    // **************************************************************
    // *** Getters et setters particuliers (chargement paresseux) ***
    // **************************************************************

    public function setType($typeUser)
    {
        if (is_string($typeUser))
        {
            $typeUser = (int) $typeUser;
            $this->type = TypeUserDAL::findById($typeUser);
        }
        else if (is_int($typeUser))
        {
            $this->type = TypeUserDAL::findById($typeUser);
        }
        else if (is_a($typeUser, "TypeUser"))
        {
            $this->type = $typeUser;
        }
    }

    public function getType()
    {
        $typeUser = null;
        if (is_int($this->type))
        {
            $typeUser = TypeUserDAL::findById($this->type);
            $this->type = $typeUser;
        }
        else if (is_a($this->type, "TypeUser"))
        {
            $typeUser = $this->type;
        }
        return $typeUser;
    }

    public function getModule()
    {
        $mesModules = array();
        if (is_int($this->type)) //si type est bien un int (id de typeUser)
        {
            if (TypeUserDAL::findById($this->type)->getCode() == self::TYPE_USER_STUDENT) //si le code de typUser == celui du type de student
            {
                $mesModules = ModuleDAL::findAllByEleve($this); //retourne un array des module auquel l'éléve est inscrit
            }
            else
            {
                echo "User.php_getModule(int): methode appeler sur un User qui n'est pas de type Student</br>";
            }
        }
        else if (is_a($this->type, "TypeUser"))
        {
            if ($this->type->getCode() == self::TYPE_USER_STUDENT)
            {
                $mesModules = ModuleDAL::findAllByEleve($this);
            }
            else
            {
                echo "User.php_getModule(typeUser): methode appeler sur un User qui n'est pas de type Student";
            }
        }
        else
        {
            echo "User.php_getModule: methode appeler avec un User de type qui n'est ni un TypeUser ni un Int...";
        }
        return $mesModules;
    }

    //////////////
    // METHODES //
    //////////////

    protected function hydrate($dataSet)
    {
        $this->id = $dataSet['id'];
        $this->adresse = $dataSet['adresse'];
        $this->affiche = $dataSet['affiche'];
        $this->dateCreation = $dataSet['date_creation'];
        $this->dateNaissance = $dataSet['date_naissance'];
        $this->avatar = $dataSet['fichier_id'];
        $this->type = $dataSet['type_user_id'];
        $this->mail = $dataSet['mail'];
        $this->nom = $dataSet['nom'];
        $this->password = $dataSet['password'];
        $this->prenom = $dataSet['prenom'];
        $this->pseudo = $dataSet['pseudo'];
    }

}
