<?php

// Require du fichier de config
require_once __DIR__.'/../inc/config.php';

$nbResultByPage = $_GET['nbPage'] ?? 5;
$nbResultByPage = intval($nbResultByPage);

// Pour select session
$arraySession = sessionName();

// Parametre de recherche
$search = $_GET['search'] ?? '';
$search = cleanVar($search, "string");
// Affichage d'une session
$session = $_GET['session'] ?? '';
$session = cleanVar($session, "string");
// affichage d'une page
$page = $_GET['page'] ?? 1;
$page = cleanVar(intval($page), "int");


if (!empty($search)) {// si le get recherche n'est pas vide on execute search
    $arrayResultStudent = studentFilter('search', $search);
    $countResulatSearch = count($arrayResultStudent);
}
elseif (!empty($session)){// si le get session n'est pas vide on execute le session
    $arrayResultStudent = studentFilter('session', $session);
    $countNbStudentSession = count($arrayResultStudent);
}
elseif (!empty($sesFilter)){

}
else { // sinon on execute l'affichage normal des etudiant avec la pagination
    $numberStudent = countAllStudent();// Récupérer le nombre d'étudiant
    $pagination = calculationPagination($page, $nbResultByPage, $numberStudent); // Calcul des parametres de pagination
    $arrayResultStudent = studentPagination($pagination["limit"], $pagination["offset"]);
}

// fin fichier
require_once __DIR__.'/../view/header.php';
require_once __DIR__.'/../view/list.php';
require_once __DIR__.'/../view/footer.php';