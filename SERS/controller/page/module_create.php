<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once '../../model/class/Exam.php';
require_once '../../model/DAL/ExamDAL.php';
require_once '../../model/class/Assignment.php';
require_once '../../model/DAL/AssignmentDAL.php';
require_once '../../model/class/Module.php';
require_once '../../model/DAL/ModuleDAL.php';

//===Création du module====
$newModule = new Module();
$newAssignment = new Assignment();
$newExam = new Exam();

//regex opur les date format YYYY/MM/DD
$myregex = "~^[0-9]{4}/[0-9]{1,2}/[0-9]{1,2}$~";

//***********CREATION ASSIGNMENT**********
//création de l'assignement (qu'il faudra liée au module créer plutot),
//set les champs s'ils ont été remplis.
$validAssignmentLabel = filter_input(INPUT_POST, 'assignmentLabel', FILTER_SANITIZE_STRING); //supprime les caractère pas gentil, 
if ($validAssignmentLabel != null) //verifie que le champs a bien était remplis
{
    $newAssignment->setLabel($validAssignmentLabel); //s'il a été rempli, alors set le label
}
$validAssignmentDescription = filter_input(INPUT_POST, 'assignmentDescription', FILTER_SANITIZE_STRING);
if ($validAssignmentDescription != null)
{
    $newAssignment->setDescription($validAssignmentDescription);
}
$validAssignmentDatePassage = filter_input(INPUT_POST, 'assignmentDate', FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => $myregex)));
if ($validAssignmentDatePassage != null)
{
    $newAssignment->setDatePassage($validAssignmentDatePassage);
}
$validAssignmentPrixRetry = filter_input(INPUT_POST, 'assignmentRetryPrice', FILTER_SANITIZE_NUMBER_INT);
if ($validAssignmentPrixRetry != null)
{
    $newAssignment->setPrixRattrapage($validAssignmentPrixRetry);
}
$newAssignment->setAffiche(1);
//insertion du module dans la table
$validInsertAssignment = AssignmentDAL::insertOnDuplicate($newAssignment);
if ($validInsertAssignment != null)
{
    echo "Insertion Assignment OK (id:" . $newAssignment->getId() . ", label:" . $newAssignment->getLabel() . ")";
}
else
{
    echo "ECHEC insertion assignment, good luck";
}

//********CREATION EXAM**********
//création de l'exam (qu'il faudra liée au module créer plutot)
$validExamLabel = filter_input(INPUT_POST, 'examLabel', FILTER_SANITIZE_STRING);
if ($validExamLabel != null)
{
    $newExam->setLabel($validExamLabel);
}
$validExamDescription = filter_input(INPUT_POST, 'examDescription', FILTER_SANITIZE_STRING);
if ($validExamDescription != null)
{
    $newExam->setDescription($validExamDescription);
}
$validExamDatePassage = filter_input(INPUT_POST, 'examDate', FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => $myregex)));
if ($validExamDatePassage != null)
{
    $newExam->setDatePassage($validExamDatePassage);
}
$validExamPrixRetry = filter_input(INPUT_POST, 'examRetryPrice', FILTER_SANITIZE_NUMBER_INT);
if ($validExamPrixRetry != null)
{
    $newExam->setPrixRattrapage($validExamPrixRetry);
}
$newExam->setAffiche(1);
//insertion de l'exam dans la table
$validInsertExam = ExamDAL::insertOnDuplicate($newExam);
if ($validInsertExam != null)
{
    echo "Insertion Exam OK (id:" . $newExam->getId() . ", label:" . $newExam->getLabel() . ")";
}
else
{
    echo "ECHEC insertion exam, good luck";
}

//********CREATION MODULE *******
//Vérifie ce qui est renvoyer par le POST de /view/phtml/module_create.php
//et set de l'objet newModule au fur et à mesure
$validModuleLabel = filter_input(INPUT_POST, 'label', FILTER_SANITIZE_STRING);
$newModule->setLabel($validModuleLabel);
$validModuleNumber = filter_input(INPUT_POST, 'moduleNumber', FILTER_SANITIZE_NUMBER_INT);
$newModule->setNumber($validModuleNumber);
$validModuleDescription = filter_input(INPUT_POST, 'descriptionModule', FILTER_SANITIZE_STRING);
$newModule->setDescription($validModuleDescription);
$newModule->setBareme(1); //barème par defaut
$newModule->setAffiche(1); //visible
$newModule->setAssignment($newAssignment); //lors de la creation du module dans la table, l'attribut moduleId de l'assignemnt va etre modifier a la valeur de ce module.
$newModule->setExam($newExam); //lie l'exam à ce module
//insertion du module dans la table
$validInsertModule = ModuleDAL::insertOnDuplicate($newModule);
if ($validInsertModule != null)
{
    $moduleId = $newModule->getId();
    echo "Insertion Module OK (id:" . $moduleId . ")";
}
else
{
    echo "ECHEC insertion module, good luck";
}
