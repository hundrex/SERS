<?php

require_once('BaseSingleton.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/SERS/SERS/model/class/Module.php');

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
                        . 'module.id = ? '
                        . 'GROUP BY module.id', array('i', &$id));
        $module = new Module();
//        var_dump($data);
        $module->hydrate($data[0]);
        $eleves = UserDAL::findAllByModule($module);
        $module->setEleves($eleves);
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
        echo "ModuleDAL.assignmentId: " . $assignmentId; //var_dump debug liaison assign<->module
        $data = BaseSingleton::select('SELECT '
                        . 'module.id as id, module.bareme_id as bareme_id, '
                        . 'module.label as label, module.description as description, '
                        . 'module.date_creation as date_creation, module.number as number, '
                        . 'module.affiche as affiche, assignment.id as assignment_id, exam.id as exam_id '
                        . 'FROM module, assignment, exam '
                        . 'WHERE assignment.module_id = module.id AND module.id = exam.module_id '
                        . 'AND assignment.id = ? '
                        . 'GROUP BY module.id', array('i', &$assignmentId));
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
                        . 'module.affiche as affiche, assignment.id as assignment_id, exam.id as exam_id '
                        . 'FROM module, exam, assignment '
                        . 'WHERE exam.module_id = module.id AND assignment.module_id = module.id '
                        . 'AND exam.id = ? '
                        . 'GROUP BY module.id', array('i', &$examId));
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
                        . 'module.affiche as affiche, assignment.id as assignment_id, exam.id as exam_id '
                        . 'FROM module, user_inscrire_module, user, exam, assignment '
                        . 'WHERE user.id = user_inscrire_module.user_id '
                        . 'AND user_inscrire_module.module_id = module.id '
                        . 'AND module.id = assignment.module_id AND module.id = exam.module_id '
                        . 'AND user.id = ? '
                        . 'GROUP BY module.id', array('i', &$eleveId));
        foreach ($data as $row)
        {
            $module = new Module();
            $module->hydrate($row);
            $mesModules[] = $module;
        }
        return $mesModules;
    }

    /**
     * Retourne tous les exam avec rattrapage à .
     *
     * @return Exam Tous les objets dans un tableau.
     */
    public static function findAllRattrapageExam($moduleId)
    {
        $data = BaseSingleton::select('SELECT exam.id, exam.module_id, '
                        . 'exam.label, '
                        . 'exam.description, exam.date_creation, '
                        . 'exam.date_passage, exam.affiche, '
                        . 'exam.prixRattrapage, exam.rattrapage '
                        . 'FROM module, assignment, exam '
                        . 'WHERE module.id = exam.module_id AND module.id = exam.module_id '
                        . ' AND exam.rattrapage = 1'
                        . ' AND module.id = ? '
                        . 'GROUP BY module.id', array('i', &$moduleId));
        $rattrapageExam = new Exam();
        if (sizeof($data) <= 0)
        {
            return false;
        }
        else
        {
            $rattrapageExam->hydrate($data[0]);
        }
        return $rattrapageExam;
    }

    /**
     * Retourne tous les assign avec rattrapage à .
     *
     * @return Assignment Tous les objets dans un tableau.
     */
    public static function findAllRattrapageAssign($moduleId)
    {
        $data = BaseSingleton::select('SELECT assignment.id, assignment.module_id, '
                        . 'assignment.label, '
                        . 'assignment.description, assignment.date_creation, '
                        . 'assignment.date_passage, assignment.affiche, '
                        . 'assignment.prixRattrapage, assignment.rattrapage '
                        . 'FROM module, assignment, exam '
                        . 'WHERE module.id = assignment.module_id AND module.id = exam.module_id '
                        . ' AND assignment.rattrapage = 1'
                        . ' AND module.id = ? '
                        . 'GROUP BY module.id', array('i', &$moduleId));
        $rattrapageAssign = new Assignment();
        if (sizeof($data) <= 0)
        {
            return false;
        }
        else
        {
            $rattrapageAssign->hydrate($data[0]);
        }
        return $rattrapageAssign;
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
                        . 'WHERE module.id = assignment.module_id AND module.id = exam.module_id '
                        . 'GROUP BY module.id');
        foreach ($data as $row)
        {
            $module = new Module();
            $module->hydrate($row);
            $module->setRetryAssignment(self::findAllRattrapageAssign($module->getId()));
            $module->setRetryExam(self::findAllRattrapageExam($module->getId()));
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
        //AssignmentDAL::insertOnDuplicate($module->getAssignment(), $idInsert);
        //ExamDAL::insertOnDuplicate($module->getExam(), $idInsert);
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

    /**
     * Methode permettant de retourne rla moyenne des assignment lié a un module
     * 
     * @param int $moduleId id du module dont on veut la moyenne des assignment
     * @return int 
     */
    public function moyenneAssignment($moduleId)
    {
        $moyenneAssign = 0;

        $sql = 'SELECT AVG(user_participe_assignment.note) as MoyenneAssign '
                . ' FROM user_participe_assignment, assignment, module '
                . ' WHERE module.id = ? '
                . 'AND user_participe_assignment.assignment_id = assignment.id '
                . 'AND assignment.module_id = module.id';
        $param = array('i', &$moduleId);
        $data = BaseSingleton::select($sql, $param);

        $moyenneAssign = $data[0]["MoyenneAssign"];

        return (int) $moyenneAssign;
    }

    /**
     * Methode permettant de retourne rla moyenne des exams lié a un module
     * 
     * @param int $moduleId id du module dont on veut la moyenne des exams
     * @return int 
     */
    public function moyenneExam($moduleId)
    {
        $moyenneExam = 0;

        $sql = 'SELECT AVG(user_participe_exam.note) as MoyenneExam '
                . ' FROM user_participe_exam, exam, module '
                . ' WHERE module.id = ? '
                . 'AND user_participe_exam.exam_id = exam.id '
                . 'AND exam.module_id = module.id';
        $param = array('i', &$moduleId);
        $data = BaseSingleton::select($sql, $param);

        $moyenneExam = $data[0]["MoyenneExam"];

        return (int) $moyenneExam;
    }
}
