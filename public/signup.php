<?php
// Require du fichier de config
require_once __DIR__.'/../inc/config.php';

// Variables de valideations
$infoForm = '';
$formInscriptOk = true;

// Si $_POST n'est pas vide le formulaire a été soumis
if (!empty($_POST)) {
    ///////////////////////
    // validation email
    ///////////////////////
    $email = $_POST['email'] ?? '';
    $email = strtolower( cleanVar($email, 'string') );
    if( !filter_var($email, FILTER_VALIDATE_EMAIL) ){
        $infoForm .='Veuillez renseigner un Email correct<br>';
        $formInscriptOk = false;
    }elseif (usrEmailExist($email)){
        $infoForm .= 'Email déjà utilisé<br>';
        $formInscriptOk = false;
    }

    //////////////////////////////
    // Validation du password
    //////////////////////////////
    $pwd = $_POST['password'] ?? '';
    $pwd = cleanVar($pwd, 'string');
    $pwdCheck = $_POST['passwordConfimation'] ?? '';
    $pwdCheck = cleanVar($pwdCheck, 'string');
    if (empty($pwd) || empty($pwdCheck)){
        $infoForm .= 'Veuillez renseigner tout les champs<br>';
        $formInscriptOk = false;
    }elseif ($pwd !== $pwdCheck){
        $infoForm .= 'Mot de passe différent<br>';
        $formInscriptOk = false;
    }else{
        //Vérification du nombre de carractère
        if (strlen($pwd) < 8){
            $infoForm .= 'Mot de passe trop court<br>';
            $formInscriptOk = false;
        }
        //Vérification de la compléxité (minuscule, majuscule, chiffre)
        $regex = "/^(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9])/";
        if (preg_match($regex, $pwd) === 0){
            $infoForm .= 'Le mot de passe ne réspecte pas les règles de compléxités<br>';
            $formInscriptOk = false;
        }

    }

    /////////////////////////////
    // Si le formulaire est OK
    /////////////////////////////
    if ($formInscriptOk){
        // Option de hash du password
        $options = [ 'cost' => 12];
        $signupOk = signup($email, password_hash($pwd, PASSWORD_BCRYPT, $options));
        if ($signupOk){
            createSession($email);
            header("Location: index.php");
        }else{
            $infoForm .= "Problème lors de l'inscription";
            $formInscriptOk = false;
        }
    }
}// Fin si $_post n'est pas vide

// Titre de la page
$titlePage = "Inscription";
// fin fichier
require_once __DIR__.'/../view/header.php';
require_once __DIR__.'/../view/signup.php';
require_once __DIR__.'/../view/footer.php';