<?php

/*
 * Copyright (C) 2015 Alexis
 *
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation; either version 2
 * of the License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 59 Temple Place - Suite 330, Boston, MA  02111-1307, USA.
 */

require_once '../../model/class/User.php';
require_once '../../model/DAL/UserDAL.php';

//Création de l'user à insèrer
$user = new User();

//Vérifie ce qui est renvoyer par le POST de /view/phtml/user_create.php
//et set de l'objet user u fur et à mesure
$validLastName = filter_input(INPUT_POST, 'lastName', FILTER_SANITIZE_STRING);
$user->setNom($validLastName);

$validFisrtName = filter_input(INPUT_POST, 'firstName', FILTER_SANITIZE_STRING);
$user->setPrenom($validFisrtName);

$myregex = "~^[0-9]{1,2}/[0-9]{1,2}/[0-9]{4}$~";
$validBirthDate = filter_input(INPUT_POST, 'birthDate', FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>$myregex)));
$user->setDateNaissance($validBirthDate);

$validAddress = filter_input(INPUT_POST, 'address', FILTER_SANITIZE_STRING);
$user->setAdresse($validAddress);

$validEmail = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING);
$user->setMail($validEmail);

$validUserTypeId = filter_input(INPUT_POST, 'userType', FILTER_SANITIZE_NUMBER_INT);
var_dump($validUserTypeId);
$user->setType($validUserTypeId);

//Insertion de l'user dans la table
$validInsertion = UserDAL::insertOnDuplicate($user);
if ($validInsertion != null)
{
    echo "Insertion OK";
}
else
{
    echo "ECHEC insertion, good luck";
}
