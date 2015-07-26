<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once('BaseSingleton.php');
require_once('../model/class/Mail.php');
class MailDAL extends Mail
{
    /**
     * Retourne l'objet correspondant à l'id donné.
     * 
     * @param int $id Identifiant de l'objet à trouver
     * @return Mail
     */
    public static function findById($id)
    {
        $data = BaseSingleton::select('SELECT id, modele_mail_id, user_id, '
                        . ' contenu, date_envoi '
                        . 'FROM mail '
                        . 'WHERE id = ?', array('i', $id));
        
        $mail = new Mail();
        
        $mail->hydrate($data);
        
        return $mail;
    }
    
    /**
     * Retourne toutes les mails enregistrées.
     * 
     * @return array[Mail] Tous les objets dans un tableau.
     */
    public static function findAll()
    {
        $mesMails = array();
        
        $data = BaseSingleton::select('SELECT id, modele_mail_id, user_id, '
                        . ' contenu, date_envoi '
                        . 'FROM mail ');
        
        foreach($data as $row)
        {
            $mail = new Mail();
            $mail->hydrate($row);
            $mesMails[] = $mail;
        }
        
        return $mesMails;
    }
    
    /**
     * Insère ou met à jour la mail donné en paramètre.
     * @param mail
     * @return int
     * L'id de l'objet inséré en base. False si ça a planté.
     */
    public static function insertOnDuplicate($mail)
    {
        $sql = 'INSERT INTO mail '
            + '(modele_mail_id, user_id,contenu, date_envoi) '
            + 'VALUES(?,?,?,?) '
            + 'ON DUPLICATE KEY '
            + 'UPDATE modele_mail_id = VALUES(modele_mail_id),'
                + 'user_id = VALUES(user_id),'
                + 'contenu = VALUES(contenu),'
                + 'date_envoi = VALUES(date_envoi) ';
        
        $params = array('iisd', array(
            $mail->getModeleMail()->getId(), //int
            $mail->getUser()->getId(), //int
            $mail->getContenu(), //string
            $mail->getDateEnvoi(), //date
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
        $deleted = BaseSingleton::delete('DELETE FROM mail WHERE id = ?', 
                array('i', $id));
        
        return $deleted;
    }
}