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

//Création du module à update
$module = new Module();
$validModuleId = filter_input(INPUT_POST, 'module', FILTER_SANITIZE_STRING);
$module = ModuleDAL::findById($validModuleId); //recupre le module associé à l'id renvoyer par module_inscription

//Supprime toute les lignes dans la table user_inscrit_module, où l'id de ce module apparait
//permet de raz les liaison entre ce module et les user afin de rebartir avec un nouveau lot de student
ModuleDAL::razListeStudentInscrit($validModuleId);

//Gestion des student selectionner
$mesStudent = $_POST['student'];
if (empty($mesStudent))
{
    echo("You didn't select any students.");
}
$N = count($mesStudent);
$student = new User();
$studentId = 0;
for ($i = 0; $i < $N; $i++)
{
    $studentId = (int) $mesStudent[$i]; //recup l'id du student select, le cast en int et le stock  
    ModuleDAL::inscritStudentModule($studentId, $validModuleId);
}