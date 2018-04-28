<?php
require 'connection.php';
require 'FiliaisClass.php';

$FiliaisClass = new FiliaisClass();

if (isset($_POST['funct']) && !empty(($_POST['funct']))) {

    $function = $_POST['funct'];
    switch ($function) {
        
        case 'getFiliais': $FiliaisClass->getFiliais($conn);
            break;
        case 'checkPlanUserAndGetFil' : $FiliaisClass->checkPlanUserAndGetFil($conn);
            break;
        case 'insertFil': $FiliaisClass->insertFil($conn);
            break;
        case 'checkQtdFil':$FiliaisClass->checkQtdFil($conn);
            break;
       

        //case 'createPlanPayUser' : createPlanPayUser($conn); break;
    }
}



