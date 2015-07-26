<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once('BaseSingleton.php');
require_once('../model/class/Assignment.php');
class AssignmentDAL extends Assignment
{
    /**
     * Retourne l'objet correspondant à l'id donné.
     * 
     * @param int $id Identifiant de l'objet à trouver
     * @return Assignment
     */
    public static function findById($id)
    {
        $data = BaseSingleton::select('SELECT id, module_id, label, description, '
                        . 'date_creation, annee, date_passage, affiche, prixRattrapage '
                        . 'FROM assignment '
                        . 'WHERE id = ?', array('i', $id));
        
        $assignment = new Assignment();
        
        $assignment->hydrate($data);
        
        return $assignment;
    }
    
    /**
     * Retourne tous les assignment enregistrés.
     * 
     * @return array[Assignment] Tous les objets dans un tableau.
     */
    public static function findAll()
    {
        $mesAssignments = array();
        
        $data = BaseSingleton::select('SELECT id, module_id, label, description, '
                        . 'date_creation, annee, date_passage, affiche, prixRattrapage '
                        . 'FROM assignment ');
        
        foreach($data as $row)
        {
            $assignment = new Assignment();
            $assignment->hydrate($row);
            $mesAssignments[] = $assignment;
        }
        
        return $mesAssignments;
    }
    
    /**
     * Insère ou met à jour l'assignment donné en paramètre.
     * @param assignment
     * @return int 
     * L'id de l'objet inséré en base. False si ça a planté.
     */
    public static function insertOnDuplicate($assignment)
    {
        $sql = 'INSERT INTO assignment '
            + '(module_id, label, description, '
            + 'date_creation, annee, date_passage, affiche, prixRattrapage) '
            + 'VALUES(?,?,?,?,?, ?,?,?) '
            + 'ON DUPLICATE KEY '
            + 'UPDATE module_id = VALUES(module_id), '
            + 'label = VALUES(label), '
            + 'description = VALUES(description), '
            + 'date_creation = VALUES(date_creation), '
            + 'annee = VALUES(annee), '
            + 'date_passage = VALUES(date_passage), '
            + 'affiche = VALUES(affiche),'
            + 'prixRattrapage = VALUES(prixRattrapage) ';
        
        $params = array('issdib', array(
            $assignment->getModule()->getId(), //int
            $assignment->getLabel(), //string
            $assignment->getDescription(), //string
            $assignment->getDateCreation(), //date
            $assignment->getAnnee(), //int
            $assignment->getDatePassage(), //date
            $assignment->getAffiche(), //bool
            $assignment->getPrixRattrapage() //int
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
        $deleted = BaseSingleton::delete('DELETE FROM assignment WHERE id = ?', 
                array('i', $id));
        
        return $deleted;
    }
}