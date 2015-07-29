<?php

require_once('BaseSingleton.php');
require_once('./model/class/Module.php');

class ModuleDAL extends Module {

    /**
     * Retourne l'objet correspondant à l'id donné.
     *
     * @param int $id Identifiant de l'objet à trouver
     * @return Module
     */
    public static function findById($id)
    {
        $data = BaseSingleton::select('SELECT module.id as id, module.bareme_id as bareme_id, module.label as label, module.description as description, '
                        . 'module.date_creation as date_creation, module.number as number, module.affiche as affiche, assignment.id as assignment_id, exam.id as exam_id '
                        . 'FROM module, assignment, exam '
                        . 'WHERE module.id = assignment.module_id AND module.id = exam.module_id AND '
                . 'module.id = ?', array('i', &$id));
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
        echo "ModuleDAL.assignmentId: ".$assignmentId; //var_dump debug liaison assign<->module
        $data = BaseSingleton::select('SELECT '
                        . 'module.id as id, module.bareme_id as bareme_id, '
                        . 'module.label as label, module.description as description, '
                        . 'module.date_creation as date_creation, module.number as number, '
                        . 'module.affiche as affiche '
                        . 'FROM module, assignment '
                        . 'WHERE assignment.module_id = module.id '
                        . 'AND assignment.id = ?', array('i', &$assignmentId));
        $module = new Module();
        $module->hydrate($data);
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
                        . 'WHERE exam.module_id = module.id '
                        . 'AND exam.id = ?', array('i', &$examId));
        $module = new Module();
        $module->hydrate($data[0]);
        return $module;
    }

    /**
     * Retourne le ou les modules correspondant à l'élève donné.
     *
     * @param User $eleve L'élève pour lequel on cherche les modules.
     * @return array(Module)
     */
    public static function findAllByEleve($eleve)
    {
        $eleveId = $eleve->getId();
        $mesModules = array();
        $data = BaseSingleton::select('SELECT '
                        . 'module.id as id, module.bareme_id as bareme_id, '
                        . 'module.label as label, module.description as description, '
                        . 'module.date_creation as date_creation, module.number as number, '
                        . 'module.affiche as affiche '
                        . 'FROM module, user_inscrire_module, user '
                        . 'WHERE user.id = user_inscrire_module.user_id '
                        . 'AND user_inscrire_module.module_id = module.id '
                        . 'AND user.id = ?', array('i', &$eleveId));
        foreach ($data as $row)
        {
            $module = new Module();
            $module->hydrate($row);
            $mesModules[] = $module;
        }
        return $mesModules;
    }

    /**
     * Retourne tous les modules enregistrés.
     *
     * @return array[Module] Tous les objets dans un tableau.
     */
    public static function findAll()
    {
        $mesModules = array();
        $data = BaseSingleton::select('SELECT module.id as id, module.bareme_id as bareme_id, module.label as label, module.description as description, '
                        . 'module.date_creation as date_creation, module.number as number, module.affiche as affiche, assignment.id as assignment_id, exam.id as exam_id '
                        . 'FROM module, assignment, exam '
                        . 'WHERE module.id = assignment.module_id AND module.id = exam.module_id');
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

        $params = array('issib',
                &$baremId, //int
                &$label, //string
                &$descripion, //string
                &$number, //int
                &$affiche //bool
        );
        $idInsert = BaseSingleton::insertOrEdit($sql, $params);
        $eleves = $module->getEleves();
        foreach ($eleves as $eleveId => $eleve)
        {
            self::saveInscriptionEleve($idInsert, $eleveId);
        }
        AssignmentDAL::insertOnDuplicate($module->getAssignment());
        ExamDAL::insertOnDuplicate($module->getExam());
        $module->setId($idInsert);
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

    /**
     * Méthode enregistrant l'insription de l'élève au module
     * 
     * @param int $moduleId L'id du module
     * @param int $eleveId L'id de l'élève
     */
    private function saveInscriptionEleve($moduleId, $eleveId)
    {
        if (!self::checkInscriptionEleve($moduleId, $eleveId))
        {
            $sql = 'INSERT INTO user_inscrire_module '
                    . '(user_id, module_id) '
                    . 'VALUES(?,?)';
            $params = array('ii',
                    &$moduleId,
                    &$eleveId
            );
            BaseSingleton::insertOrEdit($sql, $params);
        }
    }

    /**
     * Méthode vérifiant que l'élève est déjà inscrit au module
     * 
     * @param int $moduleId L'id du module
     * @param int $eleveId L'id de l'élève
     */
    private function checkInscriptionEleve($moduleId, $eleveId)
    {
        $estInscrit = false;
        $data = BaseSingleton::select(
                        'SELECT user_id, module_id '
                        . 'FROM user_inscrire_module '
                        . 'WHERE user_id = ? '
                        . 'AND module_id = ?', $params = array('ii', &$moduleId, &$eleveId)
        );
        if (!empty($data))
        {
            $estInscrit = true;
        }
        return $estInscrit;
    }

}
