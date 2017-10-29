<?php

// Require du fichier de config
require_once __DIR__.'/../inc/config.php';

// Parametre de recherche
$search = $_GET['search'] ?? '';
// Affichage d'une session
$session = $_GET['session'] ?? '';
// affichage d'une page
$page = $_GET['page'] ?? 1;

// Requete de base récupérer toutes les informations sur tous les étudiants en DB
$requestSqlAllStudent = "
    SELECT stu_id, stu_firstname, stu_lastname, stu_email, stu_birthdate, cit_name, session_ses_id
    FROM student
    INNER JOIN city ON city.cit_id = student.city_cit_id
";
// filtre de search
$filtreSearch = "
    WHERE stu_firstname = :search
    OR stu_lastname = :search
    OR stu_email = :search
    OR cit_name = :search
";
// filtre session
$filtreSession = "
    WHERE session_ses_id = :session
";
// filtre de pagination
$filtrePagination = " LIMIT :limit  OFFSET :offset";

if (!empty($search)) { // si le get recherche n'est pas vide on execute search
    // Fin récupération nombre d'étudiant
    $pdoStatementSearch = $pdo->prepare($requestSqlAllStudent . " " . $filtreSearch);
    $pdoStatementSearch->bindValue(':search', $search, PDO::PARAM_STR);
    if ($pdoStatementSearch->execute() === false) {
        print_r($pdoStatementSearch->errorInfo());
        exit;
    }
    $countResulatSearch = $pdoStatementSearch->rowCount();
    $arrayResultStudent = $pdoStatementSearch->fetchAll(PDO::FETCH_ASSOC);
    // Fin requete avec limit et offset pour pagination simple
}elseif (!empty($session)){ // si le get session n'est pas vide on execute le session
    $pdoStatementSession = $pdo->prepare($requestSqlAllStudent . " " . $filtreSession);
    $pdoStatementSession->bindValue(':session', $session, PDO::FETCH_ASSOC);
    if ($pdoStatementSession->execute() === false){
        print_r($pdoStatementSession->errorInfo());
        exit;
    }
    $countNbStudentSession = $pdoStatementSession->rowCount();
    $arrayResultStudent = $pdoStatementSession->fetchAll(PDO::FETCH_ASSOC);
}else { // sinon on execute l'affichage normal des etudiant avec la pagination
    // Récupération de la page et des parametres de pagination
    $numberPage = 1;
    $limit = 5;
    $offset = calculationOffsetPagination($page, $limit);
    // Fin de la récupération de la page et des parametres de pagination

    // Récupérer le nombre d'étudiant
    $pdoStatementAllStudent = $pdo->prepare($requestSqlAllStudent);
    $pdoStatementAllStudent->execute();
    $numberStudent = $pdoStatementAllStudent->rowCount();
    $numberPage = $numberStudent / $limit;
    $numberPage = round($numberPage);
    // Fin récupération nombre d'étudiant

    // Requete avec limit et offset pour pagination simple
    $pdoStatementStudentPagination = $pdo->prepare($requestSqlAllStudent . " " . $filtrePagination);
    $pdoStatementStudentPagination->bindValue(':limit', $limit, PDO::PARAM_INT);
    $pdoStatementStudentPagination->bindValue(':offset', $offset, PDO::PARAM_INT);
    if ($pdoStatementStudentPagination->execute() === false) {
        print_r($pdoStatementStudentPagination->errorInfo());
        exit;
    }
    $arrayResultStudent = $pdoStatementStudentPagination->fetchAll(PDO::FETCH_ASSOC);
    // Fin requete avec limit et offset pour pagination simple
}


// fin fichier
require_once __DIR__.'/../view/header.php';
require_once __DIR__.'/../view/list.php';
require_once __DIR__.'/../view/footer.php';