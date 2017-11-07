
<?php
// Require du fichier de config
require_once __DIR__.'/../inc/config.php';

// Variables de valideations
$usrExist = false;
$pwdOk = false;
$infoForm = '';

// Si $_POST n'est pas vide le formulaire de connection a été soumis
if (!empty($_POST)) {
    // Filtrage des variables
    $email = $_POST['email'] ?? '';
    $email = strtolower( cleanVar($email, 'string') );
    $pwd = $_POST['password'] ?? '';
    $pwd = cleanVar($pwd, 'string');

    /////////////////////////////////////////
    // Utilisateur existant et mdp Valide ?
    /////////////////////////////////////////
    $usrExist = usrEmailExist($email);
    if( $usrExist ){
        $pwdOk = checkPassword($email,$pwd);
    }// Fin de vérification si utilisateur existe et mdp valide

    /////////////////////////////////////////
    // Si usr Valide création de la session
    /////////////////////////////////////////
    if ($usrExist && $pwdOk){
        $id = getIdUsr($email);
        createSession($id, $email);
        header("Location: index.php");
        $infoForm = "login OK";
    }else{
        $infoForm = 'Utilisateur ou mot de passe invalide';
    }


}// Fin si $_post n'est pas vide

// Titre de la page
$titlePage = "Login";
// fin fichier
require_once __DIR__.'/../view/header.php';
require_once __DIR__.'/../view/login.php';
require_once __DIR__.'/../view/footer.php';