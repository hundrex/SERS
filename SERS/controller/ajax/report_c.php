<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/SERS/SERS/model/class/SerieStack.php';

$categories = array();
$categories[] = 'Web Development';
$categories[] = 'Web Design';
$categories[] = 'Content Management System';
$categories[] = 'Legal Ethical Social and Professional Issues';
$categories[] = 'Web Development Framework ';

$data = array();

$databaseData = array();
$databaseData[] = 40;
$databaseData[] = 50;
$databaseData[] = 60;
$databaseData[] = 70;
$databaseData[] = 80;


$passFinalData = array();
$failFinalData = array();
foreach ($databaseData as $passFinalDatabaseData) {
    $passFinal = $passFinalDatabaseData;
    $passFinalData[] = $passFinal;
    $failFinalData[] = 100 - $passFinal;
}

$passFinal          = new SerieStack('Final pass rate', $passFinalData, 'Final', 'green');
$failFinal          = new SerieStack('Final fail rate', $failFinalData, 'Final', 'red');

$data[] = $failFinal;
$data[] = $passFinal;

$bigdata = array($categories, $data);
$data_json = json_encode($bigdata);
echo $data_json;