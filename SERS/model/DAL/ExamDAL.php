<?php

require_once('BaseSingleton.php');
require_once('./model/class/Exam.php');

class ExamDAL extends Exam {

    /**
     * Retourne l'objet correspondant à l'id donné.
     * 
     * @param int $id Identifiant de l'objet à trouver
     * @return Exam
     */
    public static function findById($id)
    {
        $data = BaseSingleton::select('SELECT id, module_id, label, description, '
                        . 'date_creation, annee, date_passage, affiche, prixRattrapage, 1 as note ' //to do: verifier la rustine
                        . 'FROM exam '
                        . 'WHERE id = ?', array('i', &$id));
        $exam = new Exam();
        $exam->hydrate($data[0]);
        return $exam;
    }

    /**
     * Retourne le nombre d'exam liéer à un module
     *
     * @param int $id Identifiant du module où compter le nb Exam
     * @return int
     */
    public static function findNbExam($moduleId)
    {
        $nbExam = 0;
        $data = BaseSingleton::select('SELECT count(*) '
                        . 'FROM exam '
                        . 'WHERE module_id = ?', array('i', &$moduleId));

        $nbExam = $data[0];
        return $nbExam[0];
    }

    /**
     * Retourne tous les exam enregistrés.
     * 
     * @return array[Exam] Tous les objets dans un tableau.
     */
    public static function findAll()
    {
        $mesExams = array();
        $data = BaseSingleton::select('SELECT id, module_id, label, description, '
                        . 'date_creation, annee, date_passage, affiche, prixRattrapage '
                        . 'FROM exam ');
        foreach ($data as $row)
        {
            $exam = new Exam();
            $exam->hydrate($row);
            $mesExams[] = $exam;
        }
        return $mesExams;
    }

    /**
     * Insère ou met à jour l'exam donné en paramètre.
     * @param exam
     * @return int 
     * L'id de l'objet inséré en base. False si ça a planté.
     */
    public static function insertOnDuplicate($exam, $moduleId = null)
    {
        $sql = 'INSERT INTO exam ' . '(module_id, label, description, '
                . 'date_creation, annee, date_passage, affiche, prixRattrapage) '
                . 'VALUES(?,?,?,DATE_FORMAT(NOW(),"%Y/%m/%d"),?, ?,?,?) '
                . 'ON DUPLICATE KEY '
                . 'UPDATE module_id = VALUES(module_id), '
                . 'label = VALUES(label), '
                . 'description = VALUES(description), '
                . 'annee = VALUES(annee), '
                . 'date_passage = DATE_FORMAT(VALUES(date_passage),"%Y/%m/%d"), '
                . 'affiche = VALUES(affiche),'
                . 'prixRattrapage = VALUES(prixRattrapage) ';
        if (is_null($moduleId))
        {
            $moduleId = $exam->getModule()->getId(); //int
        }
        $label = $exam->getLabel(); //string
        $description = $exam->getDescription(); //string
        $annee = $exam->getAnnee(); //int
        $datePassage = $exam->getDatePassage(); //date
        $affiche = $exam->getAffiche(); //bool
        $prixRattrapage = $exam->getPrixRattrapage(); //int        

        $params = array('issisbi',
            &$moduleId, //int
            &$label, //string
            &$description, //string
            &$annee, //int
            &$datePassage, //date
            &$affiche, //bool
            &$prixRattrapage //int
        );
        $idInsert = BaseSingleton::insertOrEdit($sql, $params);
        $exam->setId($idInsert);
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
        $deleted = BaseSingleton::delete('DELETE FROM exam WHERE id = ?', array('i', &$id));
        return $deleted;
    }

}
