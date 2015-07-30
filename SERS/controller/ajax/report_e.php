<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/SERS/SERS/model/class/Serie.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/SERS/SERS/model/DAL/ModuleDAL.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/SERS/SERS/model/DAL/UserDAL.php';

$moduleId = filter_input(INPUT_GET, 'module_id', FILTER_SANITIZE_NUMBER_INT);
$module = ModuleDAL::findById($moduleId);
$students = UserDAL::findAllByModule($module);

$data = array();
$bigdata = array();

foreach ($students as $student)
{
    $nomSerie = new Serie("nom");
    $prenomSerie = new Serie("prenom");
    $passSerie = new Serie("pass");
    $userSerie = new Serie("user");
    $nomSerie->data = $student->getNom();
    $prenomSerie->data = $student->getPrenom();

    $pass = $student->getSuccessModule($moduleId);
    if ($pass === 1)
    {
        $studentPass = 'Pass';
    }
    else if ($pass === 0)
    {
        $studentPass = 'Fail';
    }
    else
    {
        $studentPass = 'Not marked';
    }
    $passSerie->data = $studentPass;




    $userSerie->data = array($nomSerie, $prenomSerie, $passSerie);
    $data[] = $userSerie;
}
$bigdata = array(array("module_label", $module->getLabel()), $data);
$data_json = json_encode($bigdata);
echo $data_json;
