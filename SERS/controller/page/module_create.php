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

//Création du module
$newModule = new Module();

//Vérifie ce qui est renvoyer par le POST de /view/phtml/module_create.php
//et set de l'objet newModule au fur et à mesure
$validLabel
$validNumber
        $validDescription
        $validAssignment