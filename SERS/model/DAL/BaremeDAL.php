<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once('BaseSingleton.php');
require_once('../model/class/Bareme.php');

class BaremeDAL extends Bareme {

    /**
     * Retourne l'objet correspondant à l'id donné.
     * 
     * @param int $id Identifiant de l'objet à trouver
     * @return Bareme
     */
    public static function findById($id)
    {
        $data = BaseSingleton::select('SELECT id, label '
                        . 'FROM bareme '
                        . 'WHERE id = ?', array('i', &$id));

        $bareme = new Bareme();

        $bareme->hydrate($data[0]);

        return $bareme;
    }

    /**
     * Retourne tous les bareme enregistrés.
     * 
     * @return array[Bareme] Tous les objets dans un tableau.
     */
    public static function findAll()
    {
        $mesBaremes = array();

        $data = BaseSingleton::select('SELECT id, label '
                        . 'FROM bareme ');

        foreach ($data as $row)
        {
            $bareme = new Bareme();
            $bareme->hydrate($row);
            $mesBaremes[] = $bareme;
        }

        return $mesBaremes;
    }

    /**
     * Insère ou met à jour le module donné en paramètre.
     * @param bareme
     * @return int 
     * L'id de l'objet inséré en base. False si ça a planté.
     */
    public static function insertOnDuplicate($bareme)
    {
        $sql = 'INSERT INTO bareme ' 
                . '(label ' 
                . 'VALUES(?) ' 
                . 'ON DUPLICATE KEY ' 
                . 'UPDATE label = VALUES(label)';

        $label = $bareme->getLabel();
        
        $params = array('s',
            &$label, //string
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
        $deleted = BaseSingleton::delete('DELETE FROM bareme WHERE id = ?', array('i', &$id));

        return $deleted;
    }

}
