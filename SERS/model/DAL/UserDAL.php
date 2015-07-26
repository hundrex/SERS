<?php

require_once('BaseSingleton.php');
require_once('../model/class/User.php');

class UserDAL extends User {

    /**
     * Retourne l'objet correspondant à l'id donné.
     * 
     * @param int $id Identifiant de l'objet à trouver
     * @return User
     */
    public static function findById($id)
    {
        $data = BaseSingleton::select('SELECT prenom, nom, mail, adresse, date_naissance, '
                        . 'date_creation, pseudo, password, affiche, fichier_id, '
                        . 'FROM user '
                        . 'WHERE id = ?', array('i', $id));

        $user = new User();
        $user->hydrate($data);
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
        $data = BaseSingleton::select('SELECT prenom, nom, mail, adresse, date_naissance, '
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
        $sql = 'INSERT INTO user ' + '(prenom, nom, mail, adresse, date_naissance, ' + 'date_creation, pseudo, password, affiche, fichier_id, type_user_id) ' + 'VALUES(?,?,?,?,?, ?,?,?,?,?, ?) ' + 'ON DUPLICATE KEY ' + 'UPDATE prenom = VALUES(prenom), ' + 'nom = VALUES(nom), ' + 'mail = VALUES(mail), ' + 'adresse = VALUES(adresse), ' + 'date_naissance = VALUES(date_naissance), ' + 'date_creation = VALUES(date_creation), ' + 'pseudo = VALUES(pseudo), ' + 'fichier_id = VALUES(fichier_id), ' + 'type_user_id = VALUES(type_user_id)';

        $params = array('ssssddssbii', array(
                $user->getPrenom(), //string
                $user->getNom(), //string
                $user->getMail(), //string
                $user->getAdresse(), //string
                $user->getDateNaissance(), //date
                $user->getDateCreation(), //date
                $user->getPseudo(), //string
                $user->getPassword(), //string
                $user->getAffiche(), //bool
                $user->getFichier()->getId(), //int
                $user->getTypeUser()->getId() //int
        ));
        $idInsert = BaseSingleton::insertOrEdit($sql, $params);
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
        $deleted = BaseSingleton::delete('DELETE FROM user WHERE id = ?', array('i', $id));
        return $deleted;
    }

}
