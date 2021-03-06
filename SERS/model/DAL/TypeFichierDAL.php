<?php

require_once('BaseSingleton.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/SERS/SERS/model/class/TypeFichier.php');

class TypeFichierDAL extends TypeFichier {

    /**
     * Retourne l'objet correspondant à l'id donné.
     * 
     * @param int $id Identifiant de l'objet à trouver
     * @return TypeFichier
     */
    public static function findById($id)
    {
        $data = BaseSingleton::select('SELECT id, label, description, chemin '
                        . 'FROM type_fichier '
                        . 'WHERE id = ?', array('i', &$id));
        $typeFichier = new TypeFichier();
        $typeFichier->hydrate($data[0]);
        return $typeFichier;
    }

    /**
     * Retourne toutes les typeFichiers enregistrées.
     * 
     * @return array[TypeFichier] Tous les objets dans un tableau.
     */
    public static function findAll()
    {
        $mesTypeFichiers = array();
        $data = BaseSingleton::select('SELECT id, label, description, chemin '
                        . 'FROM type_fichier ');
        foreach ($data as $row)
        {
            $typeFichier = new TypeFichier();
            $typeFichier->hydrate($row);
            $mesTypeFichiers[] = $typeFichier;
        }
        return $mesTypeFichiers;
    }

    /**
     * Insère ou met à jour la typeFichier donné en paramètre.
     * @param typeFichier
     * @return int
     * L'id de l'objet inséré en base. False si ça a planté.
     */
    public static function insertOnDuplicate($typeFichier)
    {
        $sql = 'INSERT INTO type_fichier ' . 
                '(label, description, chemin) ' . 
                'VALUES(?,?,?) ' . 
                'ON DUPLICATE KEY ' . 
                'UPDATE label = VALUES(label),' . 
                'description = VALUES(description),' . 
                'chemin = VALUES(chemin) ';

        $label = $typeFichier->getLabel(); //string
        $description = $typeFichier->getDescription(); //string
        $chemin = $typeFichier->getChemin(); //string

        $params = array('sss',
            $label, //string
            $description, //string
            $chemin //string
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
        $deleted = BaseSingleton::delete('DELETE FROM type_fichier WHERE id = ?', array('i', &$id));
        return $deleted;
    }

}
