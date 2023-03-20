<?php

if (! function_exists('removeMaskCpf')) {
    function removeMaskCpf($cpf) {
        return preg_replace("/[^\d]+/", "", $cpf);
    }
}

if (! function_exists('removeMaskCnpj')) {
    function removeMaskCnpj($cnpj) {
        return preg_replace("/[^\d]+/", "", $cnpj);
    }
}

function mask($mask,$str){

    $str = str_replace(" ","",$str);

    for($i=0;$i<strlen($str);$i++){
        $mask[strpos($mask,"#")] = $str[$i];
    }

    return $mask;

}

function dataBanco($data){
    $dataBanco = str_replace("/", "-", $data);
    return date('Y-m-d', strtotime($dataBanco));
}

if(! function_exists('toMoney')){
    function toMoney($value){
        $val = str_replace(',','.',str_replace('.','',$value));
        return $val;
    }
}