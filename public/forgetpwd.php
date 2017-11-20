<?php
// Require du fichier de config
require_once __DIR__.'/../inc/config.php';

$resetValide = false;

if (!empty($_GET['reset'])){
    $token = $_GET['reset'] ?? '';
    $resetValide = tokenValid($token);;
}

// Titre de la page
$titlePage = "Mot de passe oublié";
// fin fichier
require_once __DIR__.'/../view/header.php';
require_once __DIR__.'/../view/forgetpwd.php';
require_once __DIR__.'/../view/footer.php';