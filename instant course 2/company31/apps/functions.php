<?php 

define('BASE_URL','http://localhost/instant course 2/company31/');

function URL($var = null){
    return BASE_URL . $var;
}

function Path($var = null){
    $location = BASE_URL . $var;
    echo "
    <script>
        window.location.replace('$location')
    </script>
    ";
}

function filterString($input_value){
    $input_value = trim($input_value);
    $input_value = strip_tags($input_value);
    $input_value = htmlspecialchars($input_value);
    $input_value = stripslashes($input_value);
    return $input_value;    
}

function stringValidation($input_value,$min){
    $empty = empty($input_value);
    $length = strlen($input_value) < $min;
    if($empty || $length){
        return true;
    }else{
        return false;
    }
}

function imageValidation($imageName,$imageSize,$limitSize){
    $size = ($imageSize/1024) / 1024;
    $isBigger = $size > $limitSize;
    $empty = empty($imageName);
    if($isBigger || $empty){
        return true;
    }
    else{
        return false;
    }
}
?>