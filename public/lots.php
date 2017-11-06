<?php
// Require du fichier de config
require_once __DIR__.'/../inc/config.php';

// Si une demande d'export
if(!empty($_POST['export'])){
    exportStudent(); // je fait l'export
}

// Initialisation du infoform
$infoForm = "";
// on récupère les sessions
$arraySession = sessionName();

// Je regarde si un fichier a été envoyé
if (!empty($_FILES)) {
    // On recupère le session id
    $sesId = $_POST['sesId'] ?? '';
    // On le clean
    $sesId = cleanVar($sesId, 'int');
    // On récupere le fichier
    $fileForm = isset($_FILES['file']) ? $_FILES['file'] : array();
    // on initialise la varible de validation du formulaire
    $formOk = true;

    //////////////////////////////
	// Validation de la session //
    //////////////////////////////
    if(!array_key_exists($sesId, $arraySession)){
        $infoForm .='Veuillez renseigner une Session<br>';
        $formOk = false;
    }
    //////////////////////////
	// Validation avec MIME //
    //////////////////////////
    $allowMime = array("text/comma-separated-values", "text/csv", "application/csv", "application/excel", "application/vnd.ms-excel", "application/vnd.msexcel", "text/anytext", "text/plain");
	if(!in_array($fileForm['type'], $allowMime)){ // Seul type MIME autorisé => csv
        $infoForm .= 'Fichier incorrect<br>';
        $formOk = false;
        echo '1 '.$infoForm;
    }
    ///////////////////////////////
	// Validation avec extension //
    ///////////////////////////////
    $allowExtensions = array('txt', 'csv'); // Extension autorisées
    $dotPosition = strrpos($fileForm['name'], '.');
    $extension = substr($fileForm['name'], $dotPosition+1);
    if(!in_array($extension, $allowExtensions)){
        $infoForm .= "Extension incorrecte<br>";
        $formOk = false;
    }
    /////////////////////////////
	// Validation de la taille //
    /////////////////////////////
    $allowSize = 100000; // taille en octets
    if(filesize($fileForm['tmp_name']) > $allowSize){
        $infoForm .= "Taille de fichier invalide (100ko max)<br>";
        $formOk = false;
    }
    /////////////////////////////////
    // Si le formulaire est valide //
    //     (aucune erreur)         //
    /////////////////////////////////
    if($formOk){
        // On définit un nom aléatoire
        $newFileName = md5(uniqid().'mon-upload') . '.' . $extension ;

        // J'upload le fichier
        $upload = move_uploaded_file( $fileForm['tmp_name'], __DIR__ . '/../upload/' . $newFileName );

        // Si j'ai réussi a upload le fichier
        if($upload){
            // J'ouvrir le fichier en lecture (fopen())
            $fileOpen = fopen("../upload/{$newFileName}", "r");
            if (!$fileOpen) {
                // si j'ai une erreur de d'ouverture
                echo "erreur ouverture du fichier";
            }else{
                // J'initilise les variables pour l'infoform
                $ligneInserted = 0;
                $studentUpdated = 0;

                // Je parcour la ligne d'entete pour pas la traiter
                fgets($fileOpen);
                // parcourir chaque ligne du fichier (fgets())
                while(($ligne = fgets($fileOpen)) !== false){
                    // 	convertir la string de la ligne en tableau (explode sur , ou ;)
                    $studentTab = explode(';', $ligne);
                    // Je récupere l'id de la ville pour l'insérer
                    $idCity = cityToId(trim($studentTab[5]));

                    // Je vérifie si l'utilisateur existe
                    $idStudent = studentExist($studentTab[2]); // si oui je recupere son id
                    if ($idStudent === 0){ // si il existe pas je l'insert
                        insertUpdateStudent($studentTab[0], $studentTab[1], $studentTab[4], $studentTab[2], $studentTab[3], $sesId, $idCity);
                        $ligneInserted++;
                    }else{ // Sinon je le met a jour
                        insertUpdateStudent($studentTab[0], $studentTab[1], $studentTab[4], $studentTab[2], $studentTab[3], $sesId, $idCity, $idStudent);
                        $studentUpdated++;
                    }
                }
                $infoForm = "
                    <div class='container green lighten-2 white-text' style='margin-top: 15px;padding: 5px'>
                        {$ligneInserted} étudiant(s) inséré(s)<br>
                        {$studentUpdated} étudiant(s) mis à jour
                    </div>
                    ";
            }
            // * fermer le fichier (fclose())
            fclose($fileOpen);
        }else{
            'error :( <br>';
        }
    }else{
        $infoForm = "<div class='container red lighten-2 white-text' style='margin-top: 15px;padding: 5px'>{$infoForm}</div>";
    }



}

// fin fichier
require_once __DIR__.'/../view/header.php';
require_once __DIR__.'/../view/lots.php';
require_once __DIR__.'/../view/footer.php';