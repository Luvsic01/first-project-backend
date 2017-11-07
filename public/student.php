<?php

// Require du fichier de config
require_once __DIR__.'/../inc/config.php';

$idStudent = $_GET['id'] ?? '';
if (is_numeric($idStudent) === true){
    // Recupère les données de l'utilisateur avec son id
    $resultStudent = getStudent($idStudent);
}

// Titre de la page
$titlePage = "Détails de ";
// fin fichier
require_once __DIR__.'/../view/header.php';
require_once __DIR__.'/../view/student.php';
require_once __DIR__.'/../view/footer.php';