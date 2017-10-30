<?php
// Require du fichier de config
require_once __DIR__.'/../inc/config.php';

// Parametre de recherche
$id = $_GET['id'] ?? '';
$id = cleanVar($id, "int");
// Affichage d'une session
$page = $_GET['page'] ?? '';
$page = cleanVar($page, "int");

// On supprime l'étudiant
deleteStudent($id);

// redirection après suppresion
$redirection = empty($page) ? "list.php" : "list.php?page={$page}";
header("Location: $redirection");
exit;