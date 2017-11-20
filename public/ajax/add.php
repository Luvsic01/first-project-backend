<?php
// Require du fichier de config
require_once '../../inc/config.php';

// On récupère les donnée post
$lastname = $_POST['lastname'] ?? '';
$firstname = $_POST['firstname'] ?? '';
$email = $_POST['email'] ?? '';
$birthDate = $_POST['birthDate'] ?? '';
$cityId = $_POST['city'] ?? '';
$friendliness = $_POST['friendliness'] ?? '';
$sesId = $_POST['sesId'] ?? '';
$id = $_POST['id'] ?? '';

// Initialisation des variable de valmidation
$inform = '';
$formOk = true;

// on recupère les nom de villes et leurs id
$arrayCity = cityName();
// on récupère les sessions
$arraySession = sessionName();

// Récupération des données saisie + clean par type de champ
$lastname = strtoupper( cleanVar($lastname, 'string') );
$firstname = ucfirst( cleanVar($firstname, 'string') );
$email = strtolower( cleanVar($email, 'string') );
$birthDate = strtolower( cleanVar($birthDate, 'string') );
$cityId = cleanVar($cityId, 'int');
$friendliness = cleanVar($friendliness, 'int');
$sesId = cleanVar($sesId, 'int');

// Validation des données
// lastname
if ( empty($lastname) ){
    $inform .= "Veuillez renseigner un nom<br>";
    $formOk = false;
} elseif (strlen($lastname) < 2){
    $inform .= "Veuillez renseigner un nom d'au moins 2 caractères<br>";
    $formOk = false;
}
// firstname
if ( empty($firstname) ){
    $inform .= "Veuillez renseigner un prenom<br>";
    $formOk = false;
} elseif (strlen($firstname) < 2){
    $inform .= "Veuillez renseigner un prenom d'au moins 2 caractères<br>";
    $formOk = false;
}
// validation email
if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
    $inform .='Veuillez renseigner un Email correct<br>';
    $formOk = false;
}
// validation dob
if ($birthDate === ""){
    $inform .='Veuillez renseigner une Date de Naissance<br>';
    $formOk = false;
}else{
    $birthDate = date("Y-m-d",strtotime($birthDate));
}
// validation ville
if(!array_key_exists($cityId, $arrayCity)){
    $inform .='Veuillez renseigner une Ville<br>';
    $formOk = false;
}
// validation sympathie
if($friendliness < 1 || $friendliness > 5){
    $inform .='Veuillez renseigner une Sympathie<br>';
    $formOk = false;
}
// validation session
if(!array_key_exists($sesId, $arraySession)){
    $inform .='Veuillez renseigner une Session<br>';
    $formOk = false;
}

// Si aucune erreur on envoi le formulaire en fonction du type de demande Modification ou ajout
if ($formOk) {
    if (!empty($id)){
        insertUpdateStudent($lastname , $firstname , $birthDate , $email , $friendliness , $sesId , $cityId, $id);
        echo "<div class='container green lighten-2 white-text' style='margin-top: 15px;padding: 5px'>Etudiant mis à jour</div>";
    }
    else{
        insertUpdateStudent($lastname , $firstname , $birthDate , $email , $friendliness , $sesId , $cityId);
        echo "<div class='container green lighten-2 white-text' style='margin-top: 15px;padding: 5px'>Etudiant ajouté</div>";
    }
}
else{ // On affiche se qui ne va pas
    echo  "<div class='container red lighten-2 white-text' style='margin-top: 15px;padding: 5px'>{$inform}</div>";
} // fin d'envoi du formulaire