<?php

use Sabberworm\CSS\Value\Value;

$hoje = date('Y-m-d');

function formatDateB($value)
{
    if (($value != "") and ($value != "0000-00-00")) {
        $value = date("d/m/Y", strtotime($value));
        return $value;
    }
}

function real_format($value)
{
    if ($value != "") {
        $value  = number_format($value, 2, ",", ".");
        return "R$ " . $value;
    }
}