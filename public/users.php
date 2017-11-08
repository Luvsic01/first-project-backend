<?php

// Require du fichier de config
require_once __DIR__.'/../inc/config.php';

if (!empty($_POST)) {
    $id = $_POST['id'] ?? '';
    cleanVar($id, 'int');
    $role = $_POST['role'] ?? '';
    $role = cleanVar($role, 'string');
    updateRole($id, $role);
    $contentEmail = "<h1>Changement de rôle</h1><p>Vous êtes maintenant '{$role} sur WebForce3 Gestion'</p>";
    $mailOk = sendEmail(getEmailUser($id),"Changement de rôle",$contentEmail,"Vous êtes désormé $role");
}

// On récupère les User dans la bdd pour l'affichage
$allUsers = allUsers();

// Titre de la page
$titlePage = "Gestion des utilisateurs";
// fin fichier
require_once __DIR__.'/../view/header.php';

if (isset($_SESSION['role'])){
    if ($_SESSION['role'] === 'admin'){
        require_once __DIR__.'/../view/users.php';
    }else{
        require_once __DIR__.'/../view/403.php';
    }
}else{
    header("Location: login.php");
}

require_once __DIR__.'/../view/footer.php';