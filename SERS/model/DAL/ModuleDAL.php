<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once('BaseSingleton.php');
require_once('../model/class/Module.php');
class ModuleDAL extends Module
{
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
                        . 'WHERE id = ?', array('i', $id));
        
        $module = new Module();
        
        $module->hydrate($data);
        
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
        
        foreach($data as $row)
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
        $sql = 'INSERT INTO module '
            + '(bareme_id, label, description, '
            + 'date_creation, number, affiche) '
            + 'VALUES(?,?,?,?,?, ?) '
            + 'ON DUPLICATE KEY '
            + 'UPDATE bareme_id = VALUES(bareme_id), '
            + 'label = VALUES(label), '
            + 'description = VALUES(description), '
            + 'date_creation = VALUES(date_creation), '
            + 'number = VALUES(number), '
            + 'affiche = VALUES(affiche)';
        
        $params = array('issdib', array(
            $module->getBareme()->getId(), //int
            $module->getLabel(), //string
            $module->getDescription(), //string
            $module->getDateCreation(), //date
            $module->getNumber(), //int
            $module->getAffiche() //bool
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
        $deleted = BaseSingleton::delete('DELETE FROM module WHERE id = ?', 
                array('i', $id));
        
        return $deleted;
    }
}