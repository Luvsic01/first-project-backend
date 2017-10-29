<?php

// Require du fichier de config
require_once __DIR__.'/../inc/config.php';

// on recupère les nom de villes et leurs id
$requestSqlCity = "SELECT cit_id, cit_name FROM city ORDER BY cit_name";
$pdoStatementCity = $pdo->prepare($requestSqlCity);
$arrayCityResult = $pdoStatementCity->execute();
if ($arrayCityResult === false){
    print_r($pdo->errorInfo()); // Si erreur on imprime l'erreur
}else{
    $arrayCityResult = $pdoStatementCity->fetchAll(PDO::FETCH_ASSOC);
    foreach ($arrayCityResult as $city){
        $arrayCity [$city['cit_id']] = $city['cit_name'];
    }
} // fin de recupération des villes

// on récupère les sessions
$requestSqlSession = "SELECT ses_id, ses_number, tra_name  FROM session
INNER JOIN training ON training.tra_id = session.training_tra_id
ORDER BY tra_name, ses_number";
$pdoStatementSession = $pdo->prepare($requestSqlSession);
$arraySessionResult = $pdoStatementSession->execute();
if ($arraySessionResult === false){
    print_r($pdo->errorInfo());
}else{
    $arraySessionResult = $pdoStatementSession->fetchAll(PDO::FETCH_ASSOC);
    foreach ($arraySessionResult as $session){
        $arraySession[$session['ses_id']] = array($session['tra_name'], $session['ses_number']);
    }
}// fin de récupération des sessions

// Initialisations (pour éviter notices dans <inputs>)
$firstname = '';
$lastname = '';
$email = '';
$birthDate = '';
$cityId = '';
$friendliness = '';
$sesId = '';
// Variable de valmidation
$inform = '';
$displayForm = true;
$formOk = false;

// Si $_POST n'est pas vide le formulaire a été soumis
if (!empty($_POST)) {
    $formOk = true;

    // Je récupère les données soumis
    $lastname = $_POST['lastname'] ?? '';
    $firstname = $_POST['firstname'] ?? '';
    $email = $_POST['email'] ?? '';
    $birthDate = $_POST['birthDate'] ?? '';
    $cityId = $_POST['city'] ?? '';
    $friendliness = $_POST['friendliness'] ?? '';
    $sesId = $_POST['sesId'] ?? '';
    var_dump($birthDate);
    // je traite les données avan de les utiliser
    $lastname = strtoupper(trim(strip_tags($lastname)));
    $firstname = ucfirst(trim(strip_tags($firstname)));
    $email = strtolower(trim(strip_tags($email)));
    $birthDate = strtolower(trim(strip_tags($birthDate)));
    $cityId = trim(intval($cityId));
    $friendliness = trim(intval($friendliness));
    $sesId = trim(intval($sesId));

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
        print_r($birthDate);
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



    // Si aucune erreur on envoi le formulaire
    if ($formOk) {
        //ajout dans db
        $requestSqlAdd = "
            INSERT INTO student (stu_lastname, stu_firstname, stu_birthdate, stu_email, stu_friendliness, session_ses_id, city_cit_id) 
            VALUES  (:lastname, :firstname, :birthdate, :email, :friendliness, :sesid, :citid)
        ";
        $pdoStatementAdd = $pdo->prepare($requestSqlAdd);
        $pdoStatementAdd->bindValue(':lastname', $lastname, PDO::PARAM_STR);
        $pdoStatementAdd->bindValue(':firstname', $firstname, PDO::PARAM_STR);
        $pdoStatementAdd->bindValue(':birthdate', $birthDate, PDO::PARAM_STR);
        $pdoStatementAdd->bindValue(':email', $email, PDO::PARAM_STR);
        $pdoStatementAdd->bindValue(':friendliness', $friendliness, PDO::PARAM_INT);
        $pdoStatementAdd->bindValue(':sesid', $sesId, PDO::PARAM_INT);
        $pdoStatementAdd->bindValue(':citid', $cityId, PDO::PARAM_INT);
        //On l'éxécute et recupere le nombre de lignes insérées
        $affectedRows = $pdoStatementAdd->execute();
        // On vérifie si il y a une erreur
        if ($affectedRows === false){
            $inform = "<div class='container red lighten-2 white-text' style='margin-top: 15px;padding: 5px'>{$pdo->errorInfo()}</div>";
            print_r($pdo->errorInfo()); // Si erreur on imprime l'erreur
        }else{
            $host  = $_SERVER['HTTP_HOST'];
            $uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
            $extra = "student.php?id={$pdo->lastInsertId()}";
            header("Location: http://$host$uri/$extra");
            exit;
            //$inform = "<div class='container green lighten-2 white-text' style='margin-top: 15px;padding: 5px'>Etudiant ajouté avec succès</div>";
        }
    }else{
        $inform = "<div class='container red lighten-2 white-text' style='margin-top: 15px;padding: 5px'>{$inform}</div>";
    } // fin d'envoi du formulaire
}// fin Si $_POST n'est pas vide


// fin fichier
require_once __DIR__.'/../view/header.php';
require_once __DIR__.'/../view/add.php';
require_once __DIR__.'/../view/footer.php';
// récupération nom de la ville
