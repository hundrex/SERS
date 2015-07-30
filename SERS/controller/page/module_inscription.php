<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once '../../model/class/User.php';
require_once '../../model/DAL/UserDAL.php';
require_once '../../model/class/Module.php';
require_once '../../model/DAL/ModuleDAL.php';

//Création de l'module à update
$module = new Module();
        
$validModuleId = filter_input(INPUT_POST, 'module', FILTER_SANITIZE_STRING);
echo $validModuleId;
$module = ModuleDAL::findById($validModuleId); //recupre le module associé à l'id renvoyer par module_inscription
echo "id:".$module->getId()."</br>";
echo "label".$module->getLabel()."</br>";
