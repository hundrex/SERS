<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/SERS/SERS/model/class/Serie.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/SERS/SERS/model/DAL/ModuleDAL.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/SERS/SERS/model/DAL/UserDAL.php';

$studentId = filter_input(INPUT_GET, 'student_id', FILTER_SANITIZE_NUMBER_INT);
$student   = UserDAL::findById($studentId);
$modules   = ModuleDAL::findAllByEleve($student);

$categories   = array();
$data         = array();
$databaseData = array();

foreach ($modules as $module)
{
    $categories[]    = $module->getLabel();
    $assignmentMarks = $student->getNoteStudentAssignment($module->getId());
    $examMarks       = $student->getNoteStudentExam($module->getId());

    if ($assignmentMarks === -1)
    {
        $assignmentMarks = null;
    }
    if ($examMarks === -1)
    {
        $examMarks = null;
    }

    $databaseData[] = array($assignmentMarks, $examMarks);
}

$assignmentData   = array();
$assignmentReturn = array();
$examData         = array();
$examReturn       = array();
$finalData        = array();
$finalReturn      = array();

foreach ($databaseData as $row)
{
    $assignMark          = $row[0];
    $assignmentData["y"] = $assignMark;
    if ($assignMark >= 60)
    {
        $color = '#72AE00';
    }
    else
    {
        $color = '#FF5454';
    }
    $assignmentData["color"] = $color;
    $assignmentReturn[]      = $assignmentData;

    $examMark      = $row[1];
    $examData["y"] = $examMark;
    if ($examMark >= 60)
    {
        $color = '#72AE00';
    }
    else
    {
        $color = '#FF5454';
    }
    $examData["color"] = $color;
    $examReturn[]      = $examData;

    $finalMark      = ($assignMark + $examMark) / 2;
    $finalData["y"] = $finalMark;
    if ($finalMark >= 60)
    {
        $color = 'green';
    }
    else
    {
        $color = 'red';
    }
    $finalData["color"] = $color;
    $finalReturn[]      = $finalData;
}

$exam       = new Serie('Exam', $examReturn);
$assignment = new Serie('Assignment', $assignmentReturn);
$final      = new Serie('Final', $finalReturn);

$data[] = $final;
$data[] = $assignment;
$data[] = $exam;


$bigdata   = array($categories, $data);
$data_json = json_encode($bigdata);
echo $data_json;
