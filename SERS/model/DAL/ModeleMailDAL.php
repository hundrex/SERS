<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once('BaseSingleton.php');
require_once('../model/class/ModeleMail.php');
class ModeleMailDAL extends ModeleMail
{
    /**
     * Retourne l'objet correspondant à l'id donné.
     * 
     * @param int $id Identifiant de l'objet à trouver
     * @return ModeleMail
     */
    public static function findById($id)
    {
        $data = BaseSingleton::select('SELECT id, label, description, contenu'
                        . 'FROM modele_mail '
                        . 'WHERE id = ?', array('i', $id));
        
        $modeleMail = new ModeleMail();
        
        $modeleMail->hydrate($data);
        
        return $modeleMail;
    }
    
    /**
     * Retourne toutes les modeleMails enregistrées.
     * 
     * @return array[ModeleMail] Tous les objets dans un tableau.
     */
    public static function findAll()
    {
        $mesModeleMails = array();
        
        $data = BaseSingleton::select('SELECT id, label, description, contenu'
                        . 'FROM modele_mail ');
        
        foreach($data as $row)
        {
            $modeleMail = new ModeleMail();
            $modeleMail->hydrate($row);
            $mesModeleMails[] = $modeleMail;
        }
        
        return $mesModeleMails;
    }
    
    /**
     * Insère ou met à jour la modeleMail donné en paramètre.
     * @param modeleMail
     * @return int
     * L'id de l'objet inséré en base. False si ça a planté.
     */
    public static function insertOnDuplicate($modeleMail)
    {
        $sql = 'INSERT INTO modele_mail '
            + '(label, description, contenu) '
            + 'VALUES(?,?,?) '
            + 'ON DUPLICATE KEY '
            + 'UPDATE label = VALUES(label),'
                + 'description = VALUES(description),'
                + 'contenu = VALUES(contenu) ';
        
        $params = array('sss', array(
            $modeleMail->getLabel(), //string
            $modeleMail->getDescription(), //string
            $modeleMail->getContenu() //string
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
        $deleted = BaseSingleton::delete('DELETE FROM modele_mail WHERE id = ?', 
                array('i', $id));
        
        return $deleted;
    }
}