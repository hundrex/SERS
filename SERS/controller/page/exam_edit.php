<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once '../../model/class/Exam.php';
require_once '../../model/DAL/ExamDAL.php';
require_once '../../model/class/Assignment.php';
require_once '../../model/DAL/AssignmentDAL.php';
require_once '../../model/class/Module.php';
require_once '../../model/DAL/ModuleDAL.php';

$validExamId = filter_input(INPUT_GET, 'exam_id', FILTER_SANITIZE_STRING);
$validExamId = (int) $validExamId;
$exam = ExamDAL::findById($validExamId);

$validModuleId = filter_input(INPUT_GET, 'module_id', FILTER_SANITIZE_STRING);
$validModuleId = (int)$validModuleId;

$validLabel = filter_input(INPUT_GET, 'exam_label', FILTER_SANITIZE_STRING);
$exam->setLabel($validLabel);

$validDesc = filter_input(INPUT_GET, 'exam_desc', FILTER_SANITIZE_STRING);
$exam->setDescription($validDesc);

ExamDAL::insertOnDuplicate($exam,$validModuleId);

echo '<META HTTP-EQUIV="Refresh" Content="0; URL=../../?page=module&modification=success">';
