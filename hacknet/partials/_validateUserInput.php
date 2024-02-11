<?php
function validateUserInput($inputString){
    $resultString = htmlspecialchars($inputString, ENT_QUOTES, 'UTF-8');
    return $resultString;
}
?>