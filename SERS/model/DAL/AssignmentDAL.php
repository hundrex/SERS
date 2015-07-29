<?php

require_once('BaseSingleton.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/SERS/SERS/model/class/Assignment.php');

class AssignmentDAL extends Assignment {

    /**
     * Retourne l'objet correspondant à l'id donné.
     * 
     * @param int $id Identifiant de l'objet à trouver
     * @return Assignment
     */
    public static function findById($id)
    {
        $data = BaseSingleton::select('SELECT id, module_id, label, description, '
                        . 'date_creation, date_passage, affiche, prixRattrapage, 1 as note, rattrapage ' //to do: verifier la rustine
                        . 'FROM assignment '
                        . 'WHERE id = ?', array('i', &$id));
        $assignment = new Assignment();
        $assignment->hydrate($data[0]);
        return $assignment;
    }

    /**
     * Retourne le nombre d'assignment liéer à un module
     *
     * @param int $id Identifiant du module où compter le nb Assign
     * @return int
     */
    public static function findNbAssign($moduleId)
    {
        $nbAssign = 0;
        $data = BaseSingleton::select('SELECT count(*) '
                        . 'FROM assignment '
                        . 'WHERE module_id = ?', array('i', &$moduleId));

        $nbAssign = $data[0];
        return $nbAssign[0];
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
                        . 'date_creation, date_passage, affiche, prixRattrapage, rattrapage '
                        . 'FROM assignment ');
        foreach ($data as $row)
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
    public static function insertOnDuplicate($assignment, $moduleId = null)
    {
        if (is_null($moduleId))
        {
            $moduleId = $assignment->getModule()->getId(); //int
        }
        $label = $assignment->getLabel(); //string
        $description = $assignment->getDescription(); //string
        $datePassage = $assignment->getDatePassage(); //date
        $affiche = $assignment->getAffiche(); //bool
        $prixRattrapage = $assignment->getPrixRattrapage(); //int

        $assignId = $assignment->getId();
        if ($assignId < 0) //s'il y a pas d'id transmis avec l'asignment
        { //on insert un nouvel assignment
            $sql = 'INSERT INTO assignment '
                    . '(module_id, label, description, '
                    . 'date_creation, date_passage, affiche, prixRattrapage) '
                    . 'VALUES(?,?,?,DATE_FORMAT(NOW(),"%Y/%m/%d"), ?,?,?) ';
            $params = array('isssbi',
                &$moduleId, //int
                &$label, //string
                &$description, //string
                &$datePassage, //date
                &$affiche, //bool
                &$prixRattrapage //int
            );
        }
        else //s'il y a un id avec l'assignment (id>0)
        { //on l'update
            $sql = 'UPDATE assignment '
                    . ' SET module_id = ? '
                    . 'label = ? '
                    . 'description = ? '
                    . 'date_passage = ? '
                    . 'affiche = ? '
                    . 'prixRattrapage = ?'
                    . ' WHERE id=?';
            $params = array('isssbii',
                &$moduleId, //int
                &$label, //string
                &$description, //string
                &$datePassage, //date
                &$affiche, //bool
                &$prixRattrapage, //int
                &$assignId
            );
        }
        $idInsert = BaseSingleton::insertOrEdit($sql, $params);
        $assignment->setId($idInsert);
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
        $deleted = BaseSingleton::delete('DELETE FROM assignment WHERE id = ?', array('i', &$id));
        return $deleted;
    }

}
