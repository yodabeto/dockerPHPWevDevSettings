<?php

function isInvalidNumeric($data, &$validationFailed, &$feedbackResult, &$feedbackMessage){
    if(is_numeric($data)){
        $feedbackResult ='valid';
        $feedbackMessage='';
    }else{
        $feedbackResult ='invalid';
        $feedbackMessage='Utiliza solo numeros para este campo';
        $validationFailed = TRUE;
    }
}

function isInvalidStrWord($data, $length, &$validationFailed, &$feedbackResult, &$feedbackMessage){
    if((strlen($data) <= $length) && ctype_graph($data)){
        $feedbackResult ='valid';
        $feedbackMessage='';
    }else{
        $feedbackResult ='invalid';
        $feedbackMessage='Utiliza menos de '.$length.' caracteres sin espacios en blanco';
        $validationFailed = TRUE;
    }
}

function isInvalidStr($data, $length, &$validationFailed, &$feedbackResult, &$feedbackMessage){
    if(strlen($data) <= $length){
        $feedbackResult ='valid';
        $feedbackMessage='';
    }else{
        $feedbackResult ='invalid';
        $feedbackMessage='Utiliza menos de '.$length.' caracteres';
        $validationFailed = TRUE;
    }
}

function isInvalidYear($data, &$validationFailed, &$feedbackResult, &$feedbackMessage){
    if((is_numeric($data)) && ($data>1900) && ($data<2024)){
        $feedbackResult ='valid';
        $feedbackMessage='';
    }else{
        $feedbackResult ='invalid';
        $feedbackMessage='Utiliza solamente años dentro del rango 1900-2024';
        $validationFailed = TRUE;
    }
}



