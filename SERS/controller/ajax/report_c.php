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
$databaseData[] = array(40,90);
$databaseData[] = array(50,80);
$databaseData[] = array(60,70);
$databaseData[] = array(70,60);
$databaseData[] = array(80,50);

$passAssignmentData = array();
$failAssignmentData = array();
$passExamData = array();
$failExamData = array();
$passFinalData = array();
$failFinalData = array();
foreach ($databaseData as $row) {
    $passAssign = $row[0];
    $passAssignmentData[] = $passAssign;
    $failAssignmentData[] = 100 - $passAssign;
    
    $passExam = $row[1];
    $passExamData[] = $passExam;
    $failExamData[] = 100 - $passExam;
    
    $passFinal = ($passAssign + $passExam)/2;
    $passFinalData[] = $passFinal;
    $failFinalData[] = 100 - $passFinal;
}

$passAssignement    = new SerieStack('Assignment pass rate', $passAssignmentData, 'Assignment', '#72AE00');
$failAssignement    = new SerieStack('Assignment fail rate', $failAssignmentData, 'Assignment', '#FF5454');
$passExam           = new SerieStack('Exam pass rate', $passExamData, 'Exam', '#72AE00');
$failExam           = new SerieStack('Exam fail rate', $failExamData, 'Exam', '#FF5454');
$passFinal          = new SerieStack('Final pass rate', $passFinalData, 'Final', 'green');
$failFinal          = new SerieStack('Final fail rate', $failFinalData, 'Final', 'red');

$data[] = $failFinal;
$data[] = $passFinal;
$data[] = $failAssignement;
$data[] = $passAssignement;
$data[] = $failExam;
$data[] = $passExam;



$bigdata = array($categories, $data);


$data_json = json_encode($bigdata);

echo $data_json;