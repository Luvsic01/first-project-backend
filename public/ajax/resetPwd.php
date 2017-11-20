<?php
// Require du fichier de config
require_once '../../inc/config.php';

$infoForm = '';
$passwordOk = true;

$token = $_POST['token'] ?? '';

//////////////////////////////
// Validation du password
//////////////////////////////
$pwd = $_POST['password'] ?? '';
$pwd = cleanVar($pwd, 'string');

$pwdCheck = $_POST['passwordConfirm'] ?? '';
$pwdCheck = cleanVar($pwdCheck, 'string');

if (empty($pwd) || empty($pwdCheck)){
    $infoForm .= 'Veuillez renseigner tout les champs<br>';
    $passwordOk = false;
}elseif ($pwd !== $pwdCheck){
    $infoForm .= 'Mot de passe différent<br>';
    $passwordOk = false;
}else{
    //Vérification du nombre de carractère
    if (strlen($pwd) < 8){
        $infoForm .= 'Mot de passe trop court<br>';
        $passwordOk = false;
    }
    //Vérification de la compléxité (minuscule, majuscule, chiffre)
    $regex = "/^(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9])/";
    if (preg_match($regex, $pwd) === 0){
        $infoForm .= 'Le mot de passe ne réspecte pas les règles de compléxités<br>';
        $passwordOk = false;
    }

}

if ($passwordOk){
    resetPwd($pwd,$token);
    echo "<div class='container green lighten-2 white-text' style='margin-top: 15px;padding: 5px'>Mot de passe modifié</div>";
}else{
    echo "<div class='container red lighten-2 white-text' style='margin-top: 15px;padding: 5px'>{$infoForm}</div>";
}
