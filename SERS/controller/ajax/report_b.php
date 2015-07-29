<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/SERS/SERS/model/class/Serie.php';

$categories = array();
$categories[] = 'test1';
$categories[] = 'test2';
$categories[] = 'test3';

$data = array();

$databaseData = array();
$databaseData[] = array(100,55);
$databaseData[] = array(80,77);
$databaseData[] = array(100,84);
$databaseData[] = array(40,54);
$databaseData[] = array(100,55);
$databaseData[] = array(80,77);
$databaseData[] = array(100,84);
$databaseData[] = array(40,54);

$assignmentData = array();
$assignmentReturn = array();
$examData = array();
$examReturn = array();
$finalData = array();
$finalReturn = array();

foreach ($databaseData as $row) {
    $assignMark = $row[0];
    $assignmentData["y"] = $assignMark;
    if ($assignMark >= 60) {
        $color = '#72AE00';
    }
    else {
        $color = '#FF5454';
    }
    $assignmentData["color"] = $color;
    $assignmentReturn[] = $assignmentData;
    
    $examMark = $row[1];
    $examData["y"] = $examMark;
    if ($examMark >= 60) {
        $color = '#72AE00';
    }
    else {
        $color = '#FF5454';
    }
    $examData["color"] = $color;
    $examReturn[] = $examData;
    
    $finalMark = ($assignMark + $examMark)/2;
    $finalData["y"] = $finalMark;
    if ($finalMark >= 60) {
        $color = 'green';
    }
    else {
        $color = 'red';
    }
    $finalData["color"] = $color;
    $finalReturn[] = $finalData;
}

$exam = new Serie('Exam', $examReturn);
$assignment = new Serie('Assignment', $assignmentReturn);
$final = new Serie('Final', $finalReturn);

$data[] = $final;
$data[] = $assignment;
$data[] = $exam;

$bigdata = array($categories, $data);
$data_json = json_encode($bigdata);
echo $data_json;