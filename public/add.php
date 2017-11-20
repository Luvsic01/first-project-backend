<?php

// Require du fichier de config
require_once __DIR__.'/../inc/config.php';

//On regarde si il sagit d'une modification
$id = $_GET['id'] ?? '';

if (is_numeric($id) && empty($_POST)){ //Si modification on initialise les valeur avec ce de la bdd
    $resultStudent = getStudent($id);
    $lastname = $resultStudent['stu_lastname'];
    $firstname = $resultStudent['stu_firstname'];
    $email = $resultStudent['stu_email'];
    $birthDate = $resultStudent['stu_birthdate'];
    $cityId = $resultStudent['cit_id'];
    $friendliness = $resultStudent['stu_friendliness'];
    $sesId = $resultStudent['ses_number'];
}else{
    $lastname = '';
    $firstname = '';
    $email = '';
    $birthDate = '';
    $cityId = '';
    $friendliness = '';
    $sesId = '';
}

// on recupère les nom de villes et leurs id
$arrayCity = cityName();
// on récupère les sessions
$arraySession = sessionName();

// Titre de la page
if (!empty($id)) {
    $titlePage = "Modifier un étudiant";
}
else {
    $titlePage = "Ajouter un étudiant";
}

// fin fichier
require_once __DIR__.'/../view/header.php';

if (isset($_SESSION['role'])){
    if ($_SESSION['role'] === 'admin'){
        require_once __DIR__.'/../view/add.php';
    }else{
        require_once __DIR__.'/../view/403.php';
    }
}else{
    header("Location: login.php");
}

require_once __DIR__.'/../view/footer.php';