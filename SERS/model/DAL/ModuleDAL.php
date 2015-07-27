<?php

require_once('BaseSingleton.php');
require_once('../model/class/Module.php');

class ModuleDAL extends Module {

    /**
     * Retourne l'objet correspondant à l'id donné.
     *
     * @param int $id Identifiant de l'objet à trouver
     * @return Module
     */
    public static function findById($id)
    {
        $data = BaseSingleton::select('SELECT id, bareme_id, label, description, '
                        . 'date_creation, number, affiche '
                        . 'FROM module '
                        . 'WHERE id = ?', array('i', &$id));
        $module = new Module();
        $module->hydrate($data[0]);
        return $module;
    }

    /**
     * Retourne le module correspondant à l'assignment donné.
     *
     * @param Assignment $assignment L'assignment pour lequel on cherche le module.
     * @return Module
     */
    public static function findByAssignment($assignment)
    {
        $assignmentId = $assignment->getId();
        $data = BaseSingleton::select('SELECT '
                        . 'module.id as id, module.bareme_id as bareme_id, '
                        . 'module.label as label, module.description as description, '
                        . 'module.date_creation as date_creation, module.number as number, '
                        . 'module.affiche as affiche '
                        . 'FROM module, assignment '
                        . 'WHERE assignment.module_id = module.id'
                        . 'AND assignment.id = ?', array('i', &$assignmentId));
        $module = new Module();
        $module->hydrate($data[0]);
        return $module;
    }

    /**
     * Retourne le module correspondant à l'exam donné.
     *
     * @param Exam $exam L'exam pour lequel on cherche le module.
     * @return Module
     */
    public static function findByExam($exam)
    {
        $examId = $exam->getId();
        $data = BaseSingleton::select('SELECT '
                        . 'module.id as id, module.bareme_id as bareme_id, '
                        . 'module.label as label, module.description as description, '
                        . 'module.date_creation as date_creation, module.number as number, '
                        . 'module.affiche as affiche '
                        . 'FROM module, exam '
                        . 'WHERE exam.module_id = module.id'
                        . 'AND exam.id = ?', array('i', &$examId));
        $module = new Module();
        $module->hydrate($data[0]);
        return $module;
    }

    /**
     * Retourne tous les modules enregistrés.
     *
     * @return array[Module] Tous les objets dans un tableau.
     */
    public static function findAll()
    {
        $mesModules = array();
        $data = BaseSingleton::select('SELECT id, bareme_id, label, description, '
                        . 'date_creation, number, affiche '
                        . 'FROM module ');
        foreach ($data as $row)
        {
            $module = new Module();
            $module->hydrate($row);
            $mesModules[] = $module;
        }
        return $mesModules;
    }

    /**
     * Insère ou met à jour le module donné en paramètre.
     * @param module
     * @return int
     * L'id de l'objet inséré en base. False si ça a planté.
     */
    public static function insertOnDuplicate($module)
    {
        $sql = 'INSERT INTO module ' . '(bareme_id, label, description, '
                . 'date_creation, number, affiche) '
                . 'VALUES(?,?,?,DATE_FORMAT(NOW(),"%Y/%m/%d"),?, ?) '
                . 'ON DUPLICATE KEY '
                . 'UPDATE bareme_id = VALUES(bareme_id), '
                . 'label = VALUES(label), '
                . 'description = VALUES(description), '
                . 'number = VALUES(number), '
                . 'affiche = VALUES(affiche)';

        $baremId = $module->getBareme()->getId(); //int
        $label = $module->getLabel(); //string
        $descripion = $module->getDescription(); //string
        $number = $module->getNumber(); //int
        $affiche = $module->getAffiche(); //bool

        $params = array('issib', array(
                &$baremId, //int
                &$label, //string
                &$descripion, //string
                &$number, //int
                &$affiche //bool
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
        $deleted = BaseSingleton::delete('DELETE FROM module WHERE id = ?', array('i', &$id));
        return $deleted;
    }

}
