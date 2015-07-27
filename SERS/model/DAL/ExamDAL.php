<?php

require_once('BaseSingleton.php');
require_once('../model/class/Exam.php');

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
                        . 'date_creation, annee, date_passage, affiche, prixRattrapage '
                        . 'FROM exam '
                        . 'WHERE id = ?', array('i', $id));
        $exam = new Exam();
        $exam->hydrate($data);
        return $exam;
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
    public static function insertOnDuplicate($exam)
    {
        $sql = 'INSERT INTO exam ' + '(module_id, label, description, ' + 'date_creation, annee, date_passage, affiche, prixRattrapage) ' + 'VALUES(?,?,?,?,?, ?,?,?) ' + 'ON DUPLICATE KEY ' + 'UPDATE module_id = VALUES(module_id), ' + 'label = VALUES(label), ' + 'description = VALUES(description), ' + 'date_creation = VALUES(date_creation), ' + 'annee = VALUES(annee), ' + 'date_passage = VALUES(date_passage), ' + 'affiche = VALUES(affiche),' + 'prixRattrapage = VALUES(prixRattrapage) ';
        $params = array('issdidbi', array(
                $exam->getModule()->getId(), //int
                $exam->getLabel(), //string
                $exam->getDescription(), //string
                $exam->getDateCreation(), //date
                $exam->getAnnee(), //int
                $exam->getDatePassage(), //date
                $exam->getAffiche(), //bool
                $exam->getPrixRattrapage() //int
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
        $deleted = BaseSingleton::delete('DELETE FROM exam WHERE id = ?', array('i', $id));
        return $deleted;
    }

}
