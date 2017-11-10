<?php
// Require du fichier de config
require_once __DIR__.'/../inc/config.php';

// Variables de valideations
$usrExist = false;
$infoForm = '';

// Si $_POST n'est pas vide le formulaire de connection a été soumis
if (!empty($_POST)) {
    // Filtrage des variables
    $email = $_POST['emailRecovery'] ?? '';
    $email = strtolower( cleanVar($email, 'string') );

    /////////////////////////////////////////
    // Utilisateur existant et mdp Valide ?
    /////////////////////////////////////////
    $usrExist = usrEmailExist($email);
    var_dump($usrExist);
    if( $usrExist ){
        $token = md5(mt_rand() . $email);
        echo "http://projet-toto.dev/forgetpwd.php?reset=".$token;
        //todo envoyer email de recovery
        $infoForm = "Un email à été envoyer à {$email}";
    }// Fin de vérification si utilisateur existe et mdp valide
    else{
        $infoForm = "email invalide";
    }

}// Fin si $_post n'est pas vide

// Titre de la page
$titlePage = "Mot de passe oublié";
// fin fichier
require_once __DIR__.'/../view/header.php';
require_once __DIR__.'/../view/forgetpwd.php';
require_once __DIR__.'/../view/footer.php';