<?php

use Sabberworm\CSS\Value\Value;

$hoje = date('Y-m-d');

function formatDateB($value){
    $value = date("d/m/Y",strtotime($value));
    return $value;
}

function real_format($valor) {
    $valor  = number_format($valor,2,",",".");
    return "R$ " . $valor;
}
