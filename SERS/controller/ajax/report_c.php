<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/SERS/SERS/model/class/SerieStack.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/SERS/SERS/model/DAL/UserDAL.php';

$enseignantId = (int) $_COOKIE['user_id']; //recupe l'id de l'enseignant logguer
$enseignant = UserDAL::findById($enseignantId); //recup l'objet User liier a cette enseignant
$mesModules = ModuleDAL::findAllByEnseignant($enseignant); //recupère les module de l'enseignant


$categories = array();
$data = array();
$databaseData = array();
foreach ($mesModules as $module)
{
    if ($module->getPourcentageHaveModule() >= 0)
    {
        $categories[] = $module->getLabel();
        $databaseData[] = $module->getPourcentageHaveModule() * 100.0;
    }
}

$passFinalData = array();
$failFinalData = array();
foreach ($databaseData as $passFinalDatabaseData)
{
    $passFinal = $passFinalDatabaseData;
    $passFinalData[] = $passFinal;
    $failFinalData[] = 100 - $passFinal;
}

$passFinal = new SerieStack('Final pass rate', $passFinalData, 'Final', 'green');
$failFinal = new SerieStack('Final fail rate', $failFinalData, 'Final', 'red');

$data[] = $failFinal;
$data[] = $passFinal;

$bigdata = array($categories, $data);
$data_json = json_encode($bigdata);
echo $data_json;
