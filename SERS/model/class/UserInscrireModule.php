<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of UserPayerExam
 *
 * @author Alexis
 */
class UserInscrireModule {
    
    ///////////////
    // ATTRIBUTS //
    ///////////////

    
    /*
     * @var Module
     */
    private $extModule;
    
    /*
     * @var User
     */
    private $extUser;
    
    
 ///////////////////
    // CONSTRUCTEURS //
    ///////////////////
           
    public function UserInscrireModule($extModule=null,
            $extUser=null)
    {

        $this->extModule = $extModule;
        $this->extUser = $extUser;
    }
    
    /////////////////////
    // GETTERS&SETTERS //
    /////////////////////

    //GetterSetter extUser
    public function setUser($user)
    {
        if(is_int($user))
        {
            $this->extUser = UserDAL::findById($user);
        }
        else if(is_a($user, "User"))
        {
            $this->extUser = $user;
        }
    }
    
    public function getUser()
    {
        $user = null;
        
        if(is_int($this->extUser))
        {
            $user = UserDAL::findById($this->extUser);
            $this->extUser = $user;
        }
        else if(is_a($this->extUser, "User"))
        {
            $user = $this->extUser;
        }
        return $user;
    }
    
    //GetterSetter module
    public function setModule($module)
    {
        if(is_int($module))
        {
            $this->extModule = ModuleDAL::findById($module);
        }
        else if(is_a($module, "Module"))
        {
            $this->extModule = $module;
        }
    }
    
    public function getModule()
    {
        $module = null;
        
        if(is_int($this->extModule))
        {
            $module = ModuleDAL::findById($this->extModule);
            $this->extModule = $module;
        }
        else if(is_a($this->extModule, "Module"))
        {
            $module = $this->extModule;
        }
        return $module;
    }

    //////////////
    // METHODES //
    //////////////
    
    protected function hydrate($dataSet)
    {
        $this->extModule = $dataSet['Module'];
        $this->extUser = $dataSet['User'];
    }
}
