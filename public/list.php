<?php

// Require du fichier de config
require_once __DIR__.'/../inc/config.php';

$page = $_GET['page'] ?? 1;
$limit = 5;
$offset = ($page-1) * $limit;
if ($offset < 0){
    $offset = 0;
}

// récupérer toutes les informations sur tous les étudiants en DB
// (id, nom, prénom, email et date de naissance)
$reuestSqlAllStudent = "
  SELECT stu_id, stu_firstname, stu_lastname, stu_email, stu_birthdate
  FROM student 
  LIMIT :limit
  OFFSET :offset
";

$pdoStatementAllStudent = $pdo->prepare("SELECT stu_id, stu_firstname, stu_lastname, stu_email, stu_birthdate
  FROM student");
$pdoStatementAllStudent->execute();
$resultRows = $pdoStatementAllStudent->rowCount();
$numberPage = $resultRows / $limit;
$numberPage = round($numberPage);
$pdoStatementAllStudent = $pdo->prepare($reuestSqlAllStudent);
$pdoStatementAllStudent->bindValue(':limit', $limit, PDO::PARAM_INT);
$pdoStatementAllStudent->bindValue(':offset', $offset, PDO::PARAM_INT);
if( $pdoStatementAllStudent->execute() === false ){
    print_r($pdoStatementAllStudent->errorInfo());
    exit;
}
$arrayResultStudent = $pdoStatementAllStudent->fetchAll(PDO::FETCH_ASSOC);

//afficher les informations (id, nom, prénom, email et date de naissance) sous forme de tableau (<table>).
// Attention, l'affichage se fait dans la vue (view)

// fin fichier
require_once __DIR__.'/../view/header.php';
require_once __DIR__.'/../view/list.php';
require_once __DIR__.'/../view/footer.php';