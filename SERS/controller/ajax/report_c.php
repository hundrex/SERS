<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/SERS/SERS/model/class/SerieStack.php';

//$categories = array();
//$categories[] = 'Web Development';
//$categories[] = 'Module2';
//$categories[] = 'Module3';
//$categories[] = 'Module4';
//$categories[] = 'Module5';
//$categories[] = 'Module6';
//
//$data = array();
//$passAssignmentPercent = array();
//$passAssignmentPercent[] = array('name'=> 'AssignmentPassPercent', 'data' => [40,50,60,70,80], 'stack' => 'Assignment', 'color' => 'green');
//$passAssignement = new Serie('AssignmentPassPercent', $passAssignmentPercent);
//
//$failAssignmentPercent = array();
//$failAssignmentPercent[] = array('name'=> 'AssignmentFailPercent', 'data' => [60,50,40,30,20], 'stack' => 'Assignment', 'color' => 'red');
//$failAssignment = new Serie('Fail', $failAssignmentPercent);
//
//$passExamPercent = array();
//$passExamPercent[] = array('name'=> 'ExamPassPercent', 'data' => [40,50,60,70,80], 'stack' => 'Exam', 'color' => 'green');
//$passExam = new Serie('ExamPassPercent', $passExamPercent);
//
//$failExamPercent = array();
//$failExamPercent[] = array('name'=> 'ExamFailPercent', 'data' => [60,50,40,30,20], 'stack' => 'Exam', 'color' => 'red');
//$failExam = new Serie('ExamFailPercent', $failExamPercent);
//
//
//$data[] = $passAssignement;
//$data[] = $failAssignment;
//$data[] = $passExam;
//$data[] = $failExam;

$data = array();
$passAssignmentData = array(40, 20);
$passAssignement = new SerieStack('AssignmentPassPercent', $passAssignmentData, 'Assignment', 'green');

$failAssignmentData = array(60, 80);
$failAssignement = new SerieStack('AssignmentFailPercent', $failAssignmentData, 'Assignment', 'red');


$passExamtData = array(60, 80);
$passExam = new SerieStack('ExamPassPercent', $passExamtData, 'Exam', 'green');

$failExamtData = array(40, 20);
$failExam = new SerieStack('ExamFailPercent', $failExamtData, 'Exam', 'red');

$data[] = $passAssignement;
$data[] = $failAssignement;
$data[] = $passExam;
$data[] = $failExam;

//$bigdata = array($categories, $data);


$data_json = json_encode($data);

echo $data_json;
//echo '***********************';
//echo "[{name: 'AssignPass',data: [40,20],stack: 'Assignement',color: 'green'}, {name: 'AssignFail',data: [60,80],stack: 'Assignement',color: 'red'}, {name: 'ExamPass',data: [60,80],stack: 'Exam',color: 'green'}, {name: 'ExamFail',data: [40,20],stack: 'Exam',color: 'red'}]";