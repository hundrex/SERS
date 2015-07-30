<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$validExamId = filter_input(INPUT_POST, 'exam_id', FILTER_SANITIZE_STRING);
$validExamId = (int) $validExamId;
$exam = ExamDAL::findById($validExamId);

$validLabel = filter_input(INPUT_POST, 'exam_label', FILTER_SANITIZE_STRING);
$exam->setLabel($validLabel);

$validDesc = filter_input(INPUT_POST, 'exam_desc', FILTER_SANITIZE_STRING);
$exam->setDescription($validDesc);

ExamDAL::insertOnDuplicate($exam);

echo '<META HTTP-EQUIV="Refresh" Content="0; URL=../../?page=module&modification=success">';
