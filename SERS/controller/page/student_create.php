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

//Création de l'user à insèrer
$student = new User();

//Vérifie ce qui est renvoyer par le POST de /view/phtml/user_create.php
//et set de l'objet user u fur et à mesure
$validLastName = filter_input(INPUT_POST, 'lastName', FILTER_SANITIZE_STRING);
$student->setNom($validLastName);

$validFisrtName = filter_input(INPUT_POST, 'firstName', FILTER_SANITIZE_STRING);
$student->setPrenom($validFisrtName);

$myregex = "~^[0-9]{4}/[0-9]{1,2}/[0-9]{1,2}$~";
$validBirthDate = filter_input(INPUT_POST, 'birthDate', FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => $myregex)));
$student->setDateNaissance($validBirthDate);

$validAddress = filter_input(INPUT_POST, 'address', FILTER_SANITIZE_STRING);
$student->setAdresse($validAddress);

$validEmail = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING);
$student->setMail($validEmail);

$student->setType(4); //place l'user type à 4 (correspond à l'id de student)

//Gestion des module
 //$args permet de definir ce que l'on attend come valeur dans le tableau de module renvoyer par student_create.php
echo "<pre>";
echo $_POST['module'];
echo "</pre>";

$args = array(
    'product_id'   => FILTER_SANITIZE_NUMBER_INT,
);
$unModule = filter_input_array(INPUT_POST, $args);
if (empty($unModule))
{
    echo("You didn't select any module.");
}
else
{
    $N = count($unModule);

    echo("You selected $N module(s): ");
    for ($i = 0; $i < $N; $i++)
    {
        echo($unModule[$i] . " ");
    }
}
//$student->setModuleListe($listMod); 

/*
//Insertion du student dans la table user
$validInsertion = UserDAL::insertOnDuplicate($student);
if ($validInsertion != null)
{
    echo "Insertion OK";
}
else
{
    echo "ECHEC insertion, good luck";
}
*/