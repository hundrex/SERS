<?php

require_once('BaseSingleton.php');
require_once('./model/class/Fichier.php');

class FichierDAL extends Fichier {

    /**
     * Retourne l'objet correspondant à l'id donné.
     * 
     * @param int $id Identifiant de l'objet à trouver
     * @return Fichier
     */
    public static function findById($id)
    {
        $data = BaseSingleton::select('SELECT id, type_fichier_id, nom, date_creation, affiche '
                        . 'FROM fichier '
                        . 'WHERE id = ?', array('i', &$id));
        $fichier = new Fichier();
        $fichier->hydrate($data[0]);
        return $fichier;
    }

    public static function findDefaultAvatar()
    {
        return self::findById(1);
    }

    /**
     * Retourne toutes les fichiers enregistrées.
     * 
     * @return array[Fichier] Tous les objets dans un tableau.
     */
    public static function findAll()
    {
        $mesFichiers = array();
        $data = BaseSingleton::select('SELECT id, type_fichier_id, nom, date_creation, affiche '
                        . 'FROM fichier ');
        foreach ($data as $row)
        {
            $fichier = new Fichier();
            $fichier->hydrate($row);
            $mesFichiers[] = $fichier;
        }
        return $mesFichiers;
    }

    /**
     * Insère ou met à jour la fichier donné en paramètre.
     * @param fichier
     * @return int
     * L'id de l'objet inséré en base. False si ça a planté.
     */
    public static function insertOnDuplicate($fichier)
    {
        $sql = 'INSERT INTO fichier (type_fichier_id, nom, date_creation, affiche) '
                . 'VALUES(?,?,DATE_FORMAT(NOW(),"%Y/%m/%d"),?) '
                . 'ON DUPLICATE KEY UPDATE '
                . 'UPDATE type_fichier_id = VALUES(type_fichier_id), '
                . 'nom = VALUES(nom), '
                . 'affiche = VALUES(affiche)';

        $typeFichierId = $fichier->getTypeFichier()->getId(); //int
        $nom = $fichier->getNom(); //string
        $affiche = $fichier->getAffiche(); //bool

        $params = array('isb',
                &$typeFichierId, //int
                &$nom, //string
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
        $deleted = BaseSingleton::delete('DELETE FROM fichier WHERE id = ?', array('i', &$id));
        return $deleted;
    }

}
