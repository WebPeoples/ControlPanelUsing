<?php

require 'connection.php';
require 'SeusDadosClass.php';


$SeusDadosClass = new SeusDadosClass();


if (isset($_POST['funct']) && !empty(($_POST['funct']))) {
    $function = $_POST['funct'];
    switch ($function) {
        
        case 'getMyData': $SeusDadosClass->getMyData($conn);
            break;
        case 'getMyDataFil': $SeusDadosClass->getMyDataFil($conn);
            break;
        case 'sendMyData' : $SeusDadosClass->sendMyData($conn);
            break;
        case 'sendMyDataFil' : $SeusDadosClass->sendMyDataFill($conn);
            break;
        case 'getEnderecoForInput' : $SeusDadosClass->getEnderecoForInput($conn);
            break;
        case 'salvarEndereco':$SeusDadosClass->salvarEndereco($conn);
            break;
    }
}

