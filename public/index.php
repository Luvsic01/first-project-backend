<?php

// Require du fichier de config
require_once __DIR__.'/../inc/config.php';

// Je recupere les lieu de formation
$resultPlace = placeTraining();

// Je recupere les session pour chaque lieu de formation
foreach ($resultPlace as $place){
    $arrayFormation[$place['tra_name']] = sessionByPlace($place);
}

// Je recupere les stats
//le nombre d'étudiants par ville
$arrayStatCity = statCity();

// a la fin de index.php
require_once __DIR__.'/../view/header.php';
require_once __DIR__.'/../view/home.php';
require_once __DIR__.'/../view/footer.php';