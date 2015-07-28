<?php

require_once('BaseSingleton.php');
require_once('./model/class/User.php');
require_once('./model/DAL/FichierDAL.php');

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
                        . 'FROM User ');

        foreach ($data as $row)
        {
            $user = new User();
            $user->hydrate($row);
            $mesUsers[] = $user;
        }
        return $mesUsers;
    }

    /**
     * Insère ou met à jour l'utilisateur donné en paramètre.
     * @param user
     * @return int L'id de l'objet inséré en base. False si ça a planté.
     */
    public static function insertOnDuplicate($user)
    {
        $sql = 'INSERT INTO user ' . '(prenom, nom, mail, adresse, date_naissance, '
                . 'pseudo, password, affiche, fichier_id, type_user_id, date_creation) '
                . 'VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, DATE_FORMAT(NOW(),"%Y/%m/%d")) '
                . 'ON DUPLICATE KEY '
                . 'UPDATE prenom = VALUES(prenom), '
                . 'nom = VALUES(nom), '
                . 'mail = VALUES(mail), '
                . 'adresse = VALUES(adresse), '
                . 'date_naissance = DATE_FORMAT(VALUES(date_naissance),"%Y/%m/%d"), '
                . 'pseudo = VALUES(pseudo), '
                . 'fichier_id = VALUES(fichier_id), '
                . 'type_user_id = VALUES(type_user_id)';
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

        //lalalala
        $prenom = $user->getPrenom(); //string
        $nom = $user->getNom(); //string
        $mail = $user->getMail(); //string
        $adresse = $user->getAdresse(); //string
        $dateNaissance = $user->getDateNaissance(); //string
        $affiche = $user->getAffiche(); //bool
        $avatarId = $avatar->getId(); //int
        $typeId = $user->getType()->getId(); //int

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

}
