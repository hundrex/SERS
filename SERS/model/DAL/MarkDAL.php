<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once('BaseSingleton.php');
require_once('../model/class/Mark.php');
class MarkDAL extends Mark
{
    /**
     * Retourne l'objet correspondant à l'id donné.
     * 
     * @param int $id Identifiant de l'objet à trouver
     * @return Mark
     */
    public static function findById($id)
    {
        $data = BaseSingleton::select('SELECT id, bareme_id, maxi, mini, grade '
                        . 'FROM mark '
                        . 'WHERE id = ?', array('i', $id));
        
        $mark = new Mark();
        
        $mark->hydrate($data);
        
        return $mark;
    }
    
    /**
     * Retourne toutes les marks enregistrées.
     * 
     * @return array[Mark] Tous les objets dans un tableau.
     */
    public static function findAll()
    {
        $mesMarks = array();
        
        $data = BaseSingleton::select('SELECT id, bareme_id, maxi, mini, grade '
                        . 'FROM mark ');
        
        foreach($data as $row)
        {
            $mark = new Mark();
            $mark->hydrate($row);
            $mesMarks[] = $mark;
        }
        
        return $mesMarks;
    }
    
    /**
     * Insère ou met à jour la mark donné en paramètre.
     * @param mark
     * @return int
     * L'id de l'objet inséré en base. False si ça a planté.
     */
    public static function insertOnDuplicate($mark)
    {
        $sql = 'INSERT INTO mark '
            + '(bareme_id, maxi, mini, grade '
            + 'VALUES(?,?,?,?) '
            + 'ON DUPLICATE KEY '
            + 'UPDATE bareme_id = VALUES(bareme_id),'
                + 'maxi = VALUES(maxi),'
                + 'mini = VALUES(mini),'
                + 'grade = VALUES(grade)';
        
        $params = array('iiis', array(
            $mark->getBareme()->getId(), //int
            $mark->getMaxi(), //int
            $mark->getMini(), //int
            $mark->getGrade(), //string
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
        $deleted = BaseSingleton::delete('DELETE FROM mark WHERE id = ?', 
                array('i', $id));
        
        return $deleted;
    }
}