<?php

function ageUser($dob){
    list($jour, $mois, $annee) = explode ('-', $dob);
    $TSN = strtotime($annee."/".$mois."/".$jour);
    $TS = strtotime(date("Y/m/d"));
    $age = ($TS-$TSN)/(365*3600*24);
    return round($age);
}

function calculationOffsetPagination($page, $limit){
    $offset = ($page-1) * $limit;
    if ($offset < 0){
        $offset = 0;
    }
    return $offset;
}