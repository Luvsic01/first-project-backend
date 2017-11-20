<?php
// Require du fichier de config
require_once '../../inc/config.php';

// Filtrage des variables
$email = $_POST['emailRecovery'] ?? '';
$email = strtolower( cleanVar($email, 'string') );

/////////////////////////////////////////
// Utilisateur existant et mdp Valide ?
/////////////////////////////////////////
$usrExist = usrEmailExist($email);
if( $usrExist ){
    $token = md5(mt_rand() . $email);
    //echo "http://projet-toto.dev/forgetpwd.php?reset=".$token;
    saveTokenReset($email, $token);
    sendEmail($email, "Reset Password", "Pour reinitialiser votre mot de passe merci de suivre ce lien : <br>http://projet-toto.dev/forgetpwd.php?reset={$token}", $texContent='');
    $infoForm = "Un email à été envoyer à {$email}";
}// Fin de vérification si utilisateur existe et mdp valide
else{
    $infoForm = "email invalide";
}

echo "<div class='container green lighten-2 white-text' style='margin-top: 15px;padding: 5px'>{$infoForm}</div>";