<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/SERS/SERS/model/DAL/UserDAL.php';

$moduleId = filter_input(INPUT_GET, 'module_id', FILTER_SANITIZE_NUMBER_INT);

$module    = ModuleDAL::findById($moduleId);
$users     = UserDAL::findAllStudent();
$userData  = array();
$usersData = array();

foreach ($users as $user)
{
    $userData["id"]       = $user->getId();
    $userData["lastName"] = $user->getNom();
    $userData["firtName"] = $user->getPrenom();
    $inscrit              = false;
    if ($module->isInscrit($user))
    {
        $inscrit = true;
    }
    $userData["inscrit"] = $inscrit;

    $usersData[] = $userData;
}

$usersJson = json_encode($usersData);
echo $usersJson;
