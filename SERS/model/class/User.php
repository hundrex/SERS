<?php

/*
 * Description of User
 * 
 * @author Alexis
 */

class User {
    
    ///////////////
    // ATTRIBUTS //
    ///////////////
    
    /*
     * @var int
     */
    private $id;
    
    /*
     * @var string
     */
    private $prenom;
    
    /*
     * @var string
     */
    private $nom;
    
    /*
     * @var string
     */
    private $mail;
    
    /*
     * @var string
     */    
    private $adresse;

    /*
     * @var date
     */
    private $date_naissance;

    /*
     * @var date
     */
    private $date_creation;
    
    
    /*
     * @var string
     */
    private $pseudo;
    
    /*
     * @var string
     */
    private $password;

    /*
     * @var bool
     */
    private $affiche;
    
    
    ///////////////////
    // CONSTRUCTEURS //
    ///////////////////
           
    public function classeBidon($id=-1, $nom='', $dateDeNaissance=null, $solde=0, $vivant=false)
    {
        $this->id               = $id;
        $this->nom              = $nom;
        $this->dateDeNaissance  = $dateDeNaissance;
        $this->solde            = $solde;
        $this->vivant           = $vivant;        
    }
    
    /////////////////////
    // GETTERS&SETTERS //
    /////////////////////
    
    public function setId($id)
    {
        if(is_int($id))
        {
            $this->id = $id;
        }
    }
    
    public function getId()
    {
        return $this->id;
    }
}
