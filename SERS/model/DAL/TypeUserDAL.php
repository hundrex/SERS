<?php

require_once('BaseSingleton.php');
require_once('F:/htdocs/webdev-405-G1/SERS/SERS/model/class/TypeUser.php');

class TypeUserDAL extends TypeUser {

    /**
     * Retourne l'objet correspondant à l'id donné.
     * 
     * @param int $id Identifiant de l'objet à trouver
     * @return TypeUser
     */
    public static function findById($id)
    {
        $data = BaseSingleton::select('SELECT id, label, code, '
                        . ' description, date_creation, affiche '
                        . 'FROM type_user '
                        . 'WHERE id = ?', array('i', &$id));

        $typeUser = new TypeUser();
        $typeUser->hydrate($data[0]);
        return $typeUser;
    }

    /**
     * Retourne toutes les typeUsers enregistrées.
     * 
     * @return array[TypeUser] Tous les objets dans un tableau.
     */
    public static function findAll()
    {
        $mesTypeUsers = array();
        $data = BaseSingleton::select('SELECT id, label, code, '
                        . ' description, date_creation, affiche '
                        . 'FROM type_user ');
        foreach ($data as $row)
        {
            $typeUser = new TypeUser();
            $typeUser->hydrate($row);
            $mesTypeUsers[] = $typeUser;
        }
        return $mesTypeUsers;
    }

    /**
     * Insère ou met à jour la typeUser donné en paramètre.
     * @param typeUser
     * @return int
     * L'id de l'objet inséré en base. False si ça a planté.
     */
    public static function insertOnDuplicate($typeUser)
    {
        $sql = 'INSERT INTO type_user (label, code, description, date_creation, affiche) '
                . 'VALUES(?,?,?,DATE_FORMAT(NOW(),"%Y/%m/%d"),?) '
                . 'ON DUPLICATE KEY UPDATE '
                . 'UPDATE label = VALUES(label), '
                . 'code = VALUES(code), '
                . 'description = VALUES(description), '
                . 'affiche = VALUES(affiche) ';

        $label = $typeUser->getLabel(); //string
        $code = $typeUser->getCode(); //int
        $description = $typeUser->getDescription(); //string
        $affiche = $typeUser->getAffiche(); //bool

        $params = array('sisb',
                &$label, //string
                &$code, //int
                &$description, //string
                &$affiche //bool
        );
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
        $deleted = BaseSingleton::delete('DELETE FROM type_user WHERE id = ?', array('i', &$id));
        return $deleted;
    }

}
