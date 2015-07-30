<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$validAssignId = filter_input(INPUT_POST, 'assign_id', FILTER_SANITIZE_STRING);
$validAssignId = (int) $validAssignId;
$assignment = AssignmentDAL::findById($validAssignId);

$validLabel = filter_input(INPUT_POST, 'assign_label', FILTER_SANITIZE_STRING);
$assignment->setLabel($validLabel);

$validDesc= filter_input(INPUT_POST, 'assign_desc', FILTER_SANITIZE_STRING);
$assignment->setDescription($validDesc);

AssignmentDAL::insertOnDuplicate($assignment);

echo '<META HTTP-EQUIV="Refresh" Content="0; URL=../../?page=module&modification=success">';