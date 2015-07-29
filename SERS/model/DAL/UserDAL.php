<?php

require_once('BaseSingleton.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/SERS/SERS/model/class/User.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/SERS/SERS/model/DAL/FichierDAL.php');

class UserDAL extends User {

    /**
     * Retourne l'objet correspondant à l'id donné.
     * 
     * @param int $id Identifiant de l'objet à trouver
     * @return User
     */
    public static function findById($id)
    {
        $data = BaseSingleton::select('SELECT id, prenom, nom, mail, adresse, date_naissance, '
                        . 'date_creation, pseudo, password, affiche, fichier_id, '
                        . 'FROM user '
                        . 'WHERE id = ?', array('i', &$id));

        $user = new User();
        $user->hydrate($data[0]);
        return $user;
    }

    /**
     * Retourne l'ensemble des student 
     * 
     * @param int $id Identifiant de l'objet à trouver
     * @return User
     */
    public static function findAllStudent()
    {
        $codeStudent = self::TYPE_USER_STUDENT; //recupère une constante ce trouvant dans user, contenant le code (type_user) correspondant au student
        $mesUsers = array();
        $data = BaseSingleton::select('SELECT user.id, user.fichier_id, '
                        . 'user.type_user_id, user.prenom, user.nom, user.mail, '
                        . 'user.adresse, user.date_naissance, user.date_creation, '
                        . 'user.pseudo, user.password, user.affiche '
                        . 'FROM user, type_user '
                        . 'WHERE user.type_user_id = type_user.id '
                        . 'AND type_user.code = ? ', array('i', &$codeStudent));
        foreach ($data as $row)
        {
            $user = new User();
            $user->hydrate($row);
            $mesUsers[] = $user;
        }
        return $mesUsers;
    }

    /**
     * Retourne tous les user enregistré.
     * 
     * @return array[User] Tous les objets dans un tableau.
     */
    public static function findAll()
    {
        $mesUsers = array();
        $data = BaseSingleton::select('SELECT id, prenom, nom, mail, adresse, date_naissance, '
                        . 'date_creation, pseudo, password, affiche, fichier_id, '
                        . 'type_user_id '
                        . 'FROM user ');

        foreach ($data as $row)
        {
            $user = new User();
            $user->hydrate($row);
            $mesUsers[] = $user;
        }
        return $mesUsers;
    }
    
    /**
     * Retourne le ou les élèves inscrits à un module
     *
     * @param Module $module Le module pour lequel on cherche les élèves.
     * @return array(Module)
     */
    public static function findAllByModule($module)
    {
        $moduleId = $module->getId();
        $mesEleves = array();
        $data = BaseSingleton::select('SELECT user.id, user.fichier_id, '
                        . 'user.type_user_id, user.prenom, user.nom, user.mail, '
                        . 'user.adresse, user.date_naissance, user.date_creation, '
                        . 'user.pseudo, user.password, user.affiche '
                        . 'FROM user_inscrire_module, user '
                        . 'WHERE user.id = user_inscrire_module.user_id '
                        . 'AND user_inscrire_module.module_id = ? ', array('i', &$moduleId));
        foreach ($data as $row)
        {
            $eleve = new User();
            $eleve->hydrate($row);
            $mesEleves[] = $eleve;
        }
        return $mesEleves;
    }

    /**
     * Insère ou met à jour l'utilisateur donné en paramètre.
     * @param user
     * @return int L'id de l'objet inséré en base. False si ça a planté.
     */
    public static function insertOnDuplicate($user)
    {
        $avatar = null;
        if ($user->getAvatar() !== null)
        {
            $avatar = $user->getAvatar();
        }
        else
        {
            $avatar = FichierDAL::findDefaultAvatar();
        }
        //Password
        $passWord = $user->getPassword();
        //Pseudo
        $pseudo = $user->getPrenom() . "." . $user->getNom();
        $prenom = $user->getPrenom(); //string
        $nom = $user->getNom(); //string
        $mail = $user->getMail(); //string
        $adresse = $user->getAdresse(); //string
        $dateNaissance = $user->getDateNaissance(); //string
        $affiche = $user->getAffiche(); //bool
        $avatarId = $avatar->getId(); //int
        $typeId = $user->getType()->getId(); //int
        $userId = $user->getId();
        if ($userId < 0)
        {
            $sql = 'INSERT INTO user ' . '(prenom, nom, mail, adresse, date_naissance, '
                    . 'pseudo, password, affiche, fichier_id, type_user_id, date_creation) '
                    . 'VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, DATE_FORMAT(NOW(),"%Y/%m/%d")) ';
            $params = array('sssssssbii',
                &$prenom,
                &$nom,
                &$mail,
                &$adresse,
                &$dateNaissance,
                &$pseudo, //string
                &$passWord, //string
                &$affiche,
                &$avatarId,
                &$typeId,
            );
        }
        else
        {
            $sql = 'UPDATE user '
                    . 'SET prenom = ?,'
                    . ' nom = ?,'
                    . ' mail = ?,'
                    . ' adresse = ?,'
                    . ' date_naissance = ?, '
                    . 'pseudo = ?,'
                    . ' password = ?,'
                    . ' affiche = ?,'
                    . ' fichier_id = ?,'
                    . ' type_user_id = ?,'
                    . ' date_creation = ?'
                    . ' WHERE id = ?';
            $params = array('sssssssbiii',
                &$prenom,
                &$nom,
                &$mail,
                &$adresse,
                &$dateNaissance,
                &$pseudo, //string
                &$passWord, //string
                &$affiche,
                &$avatarId,
                &$typeId,
                &$userId
            );
        }
        $idInsert = BaseSingleton::insertOrEdit($sql, $params);
        $user->setId($idInsert);
        return $idInsert;
    }

    /**
     * Delete the row corresponding to the given id.
     * 
     * @param int $id
     * @return bool True if the row has been deleted. False if not.
     */
    public static function delete($id)
    {
        $deleted = BaseSingleton::delete('DELETE FROM user WHERE id = ?', array('i', &$id));
        return $deleted;
    }

    /**
     * Methode qui retourne la moyenne de l'ensemble des assignment d'un student 
     * @param int $studentId
     * @return int Moyenne de l'etudiant dont l'id es ten param dans l'ensemble des assignment où il a été noté.
     */
    public static function moyenneAssignment($studentId)
    {
        $moyenneAssignmentEleve = 0;
        $sql = 'SELECT AVG(user_participe_assignment.note) as MoyAssignStud'
                . 'FROM user_participe_assignment, assignment, user '
                . 'WHERE user.id = ? '
                . 'AND user_participe_assignment.user_id = user.id '
                . 'AND user_participe_assignment.assignment_id = assignment.id ';
        $param = array('i', &$studentId);
        $data = BaseSingleton::select($sql, $param);

        $moyenneAssignmentEleve = $data[0]["MoyAssignStud"];
        return (int) $moyenneAssignmentEleve;
    }

    /**
     * Methode qui retourne la moyenne de l'ensemble des exam d'un student 
     * @param int $studentId
     * @return int Moyenne de l'etudiant dont l'id est en param dans l'ensemble des exam où il a été noté.
     */
    public static function moyenneExam($studentId)
    {
        $moyenneExamEleve = 0;
        $sql = 'SELECT AVG(user_participe_exam.note) as MoyExamStud'
                . 'FROM user_participe_exam, exam, user '
                . 'WHERE user.id = ? '
                . 'AND user_participe_exam.user_id = user.id '
                . 'AND user_participe_exam.exam_id = exam.id ';
        $param = array('i', &$studentId);
        $data = BaseSingleton::select($sql, $param);

        $moyenneExamEleve = $data[0]["MoyExamStud"];
        return (int) $moyenneExamEleve;
    }

    /**
     * Méthode permettant de requêter la note d'un assignment pour un eleve donnée dans un modele
     * @param int $studentId
     * @param int $moduleId
     * @return int
     */
    public static function noteAssign($studentId, $moduleId)
    {
        $noteAssign = 0;
        $sql = 'SELECT AVG(user_participe_assignment.note) as noteAssign
            FROM user_participe_assignment, assignment, user, module
            WHERE user.id = ? AND module.id = ?
                AND user_participe_assignment.user_id = user.id
                AND user_participe_assignment.assignment_id = assignment.id
                AND assignment.module_id = module.id';
        $param = array('ii', &$studentId, &$moduleId);
        $data = BaseSingleton::select($sql, $param);
        $noteAssign = $data[0]["noteAssign"];
        return (int) $noteAssign;
    }

    /**
     * Méthode permettant de requêter la note d'un exam pour un eleve donnée dans un modele
     * @param int $studentId
     * @param int $moduleId
     * @return int
     */
    public static function noteExam($studentId, $moduleId)
    {
        $noteExam = 0;
        $sql = 'SELECT AVG(user_participe_exam.note) as noteExam
            FROM user_participe_exam, exam, user, module
            WHERE user.id = ? AND module.id = ?
                AND user_participe_exam.user_id = user.id
                AND user_participe_exam.exam_id = exam.id
                AND exam.module_id = module.id';
        $param = array('ii', &$studentId, &$moduleId);
        $data = BaseSingleton::select($sql, $param);
        $noteExam = $data[0]["noteExam"];
        return (int) $noteExam;
    }
    
}
