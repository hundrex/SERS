<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/SERS/SERS/model/class/Serie.php';

$categories = array();
$categories[] = 'test1';
$categories[] = 'test2';
$categories[] = 'test3';

$data = array();
$finalMarks = array();
$finalMarks[] = array('y' => 77.5, 'color' => 'green');
$finalMarks[] = array('y' => 78.5, 'color' => 'green');
$finalMarks[] = array('y' => 92, 'color' => 'green');
$finalMarks[] = array('y' => 47, 'color' => 'red');
$finalMarks[] = array('y' => 77.5, 'color' => 'green');
$finalMarks[] = array('y' => 78.5, 'color' => 'green');
$finalMarks[] = array('y' => 92, 'color' => 'green');
$finalMarks[] = array('y' => 47, 'color' => 'red');
$final = new Serie('Final', $finalMarks);

$assignmentMarks = array();
$assignmentMarks[] = array('y' => 100, 'color' => '#72AE00');
$assignmentMarks[] = array('y' => 80, 'color' => '#72AE00');
$assignmentMarks[] = array('y' => 100, 'color' => '#72AE00');
$assignmentMarks[] = array('y' => 40, 'color' => '#FF5454');
$assignmentMarks[] = array('y' => 100, 'color' => '#72AE00');
$assignmentMarks[] = array('y' => 80, 'color' => '#72AE00');
$assignmentMarks[] = array('y' => 100, 'color' => '#72AE00');
$assignmentMarks[] = array('y' => 40, 'color' => '#FF5454');
$assign = new Serie('Assignment', $assignmentMarks);

$examMarks = array();
$examMarks[] = array('y' => 55, 'color' => '#FF5454');
$examMarks[] = array('y' => 77, 'color' => '#72AE00');
$examMarks[] = array('y' => 84, 'color' => '#72AE00');
$examMarks[] = array('y' => 54, 'color' => '#FF5454');
$examMarks[] = array('y' => 55, 'color' => '#FF5454');
$examMarks[] = array('y' => 77, 'color' => '#72AE00');
$examMarks[] = array('y' => 84, 'color' => '#72AE00');
$examMarks[] = array('y' => 54, 'color' => '#FF5454');
$exam = new Serie('Exam', $examMarks);

$data[] = $final;
$data[] = $assign;
$data[] = $exam;

$bigdata = array($categories, $data);


$data_json = json_encode($bigdata);

echo $data_json;