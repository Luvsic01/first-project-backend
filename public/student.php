<?php

// Require du fichier de config
require_once __DIR__.'/../inc/config.php';

// Titre de la page
$titlePage = "Détails de ";
// fin fichier
require_once __DIR__.'/../view/header.php';

if (isset($_SESSION['role'])){
    if ($_SESSION['role'] === 'admin' || $_SESSION['role'] === 'user'){
        require_once __DIR__.'/../view/student.php';
    }else{
        header("Location: login.php");
    }
}else{
    header("Location: login.php");
}

require_once __DIR__.'/../view/footer.php';