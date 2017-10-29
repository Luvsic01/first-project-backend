<?php

// Require du fichier de config
require_once __DIR__.'/../inc/config.php';

// Je recupere les lieu de formation
$requestPlace = "
    SELECT tra_name 
    FROM training
    ORDER BY tra_name
";
$pdoStatementPlace = $pdo->prepare($requestPlace);
if ($pdoStatementPlace->execute() === false){
    print_r($pdoStatementPlace->errorInfo());
    exit();
}
$resultPlace = $pdoStatementPlace->fetchAll(PDO::FETCH_ASSOC);

// Je recupere les session pour chaque lieu de formation
$requestSession = "
    SELECT ses_id, ses_start_date, ses_end_date, ses_number, loc_name
    FROM session
    INNER JOIN training ON training.tra_id = session.training_tra_id
    INNER JOIN location on location.loc_id = session.location_loc_id
    WHERE tra_name = :place
    ORDER BY ses_number
";
foreach ($resultPlace as $place){
    $pdoStatementSession = $pdo->prepare($requestSession);
    $pdoStatementSession->bindValue(':place', $place['tra_name'], PDO::PARAM_STR);
    if ($pdoStatementSession->execute() === false){
        $pdoStatementSession->errorInfo();
        exit();
    }
    $arraySession = $pdoStatementSession->fetchAll(PDO::FETCH_ASSOC);
    $arrayFormation [$place['tra_name']] = $arraySession;
}

// a la fin de index.php
require_once __DIR__.'/../view/header.php';
require_once __DIR__.'/../view/home.php';
require_once __DIR__.'/../view/footer.php';