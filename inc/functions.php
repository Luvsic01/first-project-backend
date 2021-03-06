<?php
///////////////////////
/// Fonction normal ///
///////////////////////

// Fonction de calcul de l'age utilisateur en fonction de sa date de naissance
function ageUser($dob){
    list($jour, $mois, $annee) = explode ('-', $dob);
    $dob = strtotime($annee."/".$mois."/".$jour);
    $today = strtotime(date("Y/m/d"));
    $age = ($today-$dob)/(365*3600*24);
    return round($age);
}

// Fonction pour calculer les parametres de pagination
function calculationPagination($page, $limit, $numberStudent){
    $offset = ((($page-1) * $limit) < 0) ? 0 : ($page-1) * $limit;
    $arrayPagination = array(
        "page"=>$page,
        "numberPage"=>round($numberStudent / $limit),
        "limit"=>$limit,
        "offset"=>$offset
    );
    return $arrayPagination;
}

// Fonction nettoyage variable
function cleanVar($var, $type){
    if ($type === "string"){
        $var = trim(strip_tags($var));
    }
    elseif ($type === "int"){
        $var = trim(intval($var));
    }
    return $var;
}


/////////////////////////////////
/// Fonction avec requête SQL ///
/////////////////////////////////

// Requete de base
$requestSqlAllStudents = "
        SELECT stu_id, stu_firstname, stu_lastname, stu_email, stu_birthdate, cit_name, session_ses_id, stu_friendliness
        FROM student
        INNER JOIN city ON city.cit_id = student.city_cit_id
";

// Fonction avec filtres posibble sur search et session
function studentFilter($filtre, $data){
    // On initialise la requete
    global $pdo, $requestSqlAllStudents;
    $requestSql = $requestSqlAllStudents;
    // on applique le filtre voulu
    if ($filtre === "search"){
        $data = "%".$data."%";
    }
    $requestSql .= ($filtre === "search") ? " WHERE stu_firstname LIKE :data OR stu_lastname LIKE :data OR stu_email LIKE :data OR cit_name LIKE :data" : "";
    $requestSql .= ($filtre === "session") ? " WHERE session_ses_id = :data" : "";
    // On éxécute la requete
    $pdoStatementFilter = $pdo->prepare($requestSql);
    $pdoStatementFilter->bindValue(':data', $data, PDO::PARAM_STR);
    if ($pdoStatementFilter->execute() === false){
        print_r($pdoStatementFilter->errorInfo());
        exit();
    }
    return $pdoStatementFilter->fetchAll(PDO::FETCH_ASSOC); // On retourne le résultat
}

// Fonction pour avoir le nombre d'étudiant global
function countAllStudent(){
    global $pdo, $requestSqlAllStudents;
    $pdoStatementAllStudent = $pdo->prepare($requestSqlAllStudents);
    $pdoStatementAllStudent->execute();
    return $pdoStatementAllStudent->rowCount();
}

// Fonction pour afficher tout les étudiant paginé
function studentPagination($limit, $offset){
    global $pdo, $requestSqlAllStudents;
    $requestStudentPagination = $requestSqlAllStudents . " " . " LIMIT :limit  OFFSET :offset";
    $pdoStatementStudentPagination = $pdo->prepare($requestStudentPagination);
    $pdoStatementStudentPagination->bindValue(':limit', $limit, PDO::PARAM_INT);
    $pdoStatementStudentPagination->bindValue(':offset', $offset, PDO::PARAM_INT);
    if ($pdoStatementStudentPagination->execute() === false) {
        print_r($pdoStatementStudentPagination->errorInfo());
        exit;
    }
    return $pdoStatementStudentPagination->fetchAll(PDO::FETCH_ASSOC);
}

// Recupération des villes
function cityName(){
    global $pdo;
    $requestSqlCity = "SELECT cit_id, cit_name FROM city ORDER BY cit_name";
    $pdoStatementCity = $pdo->prepare($requestSqlCity);
    $arrayCityResult = $pdoStatementCity->execute();
    if ($arrayCityResult === false){
        print_r($pdo->errorInfo()); // Si erreur on imprime l'erreur
    }else{ // Mise en forme dans un array
        $arrayCityResult = $pdoStatementCity->fetchAll(PDO::FETCH_ASSOC);
        foreach ($arrayCityResult as $city){
            $arrayCity [$city['cit_id']] = $city['cit_name'];
        }
    }
    return $arrayCity;
}

// récupération des sessions
function sessionName(){
    global $pdo;
    $requestSqlSession = "
        SELECT ses_id, ses_number, tra_name  FROM session
        INNER JOIN training ON training.tra_id = session.training_tra_id
        ORDER BY tra_name, ses_number
    ";
    $pdoStatementSession = $pdo->prepare($requestSqlSession);
    $arraySessionResult = $pdoStatementSession->execute();
    if ($arraySessionResult === false){
        print_r($pdo->errorInfo());
    }else{
        $arraySessionResult = $pdoStatementSession->fetchAll(PDO::FETCH_ASSOC);
        // Mise en forme des résultat
        foreach ($arraySessionResult as $session){
            $arraySession[$session['ses_id']] = array($session['tra_name'], $session['ses_number']);
        }
    }
    return $arraySession;
}

// Je recupere les lieu de formation
function placeTraining(){
    global $pdo;
    $requestPlace = "SELECT tra_name FROM training ORDER BY tra_name";
    $pdoStatementPlace = $pdo->prepare($requestPlace);
    if ($pdoStatementPlace->execute() === false){
        print_r($pdoStatementPlace->errorInfo());
        exit();
    }
    return $pdoStatementPlace->fetchAll(PDO::FETCH_ASSOC);
}

// Je recupere les session pour un lieu de formation
function sessionByPlace($place){
    global $pdo;
    $requestSession = "
        SELECT ses_id, ses_start_date, ses_end_date, ses_number, loc_name
        FROM session
        INNER JOIN training ON training.tra_id = session.training_tra_id
        INNER JOIN location on location.loc_id = session.location_loc_id
        WHERE tra_name = :place
        ORDER BY ses_number
    ";
    $pdoStatementSession = $pdo->prepare($requestSession);
    $pdoStatementSession->bindValue(':place', $place['tra_name'], PDO::PARAM_STR);
    if ($pdoStatementSession->execute() === false){
        $pdoStatementSession->errorInfo();
        exit();
    }
    return $pdoStatementSession->fetchAll(PDO::FETCH_ASSOC);
}

// Stat par ville
function statCity(){
    global $pdo;
    $requestSqlStat = "
        SELECT COUNT(stu_id) AS nbStudent,  cit_name
        FROM student
        INNER JOIN city ON city.cit_id = student.city_cit_id
        GROUP BY cit_name
        ORDER BY nbStudent DESC
    ";
    $pdoSatementStat = $pdo->prepare($requestSqlStat);
    if ($pdoSatementStat->execute() === false){
        $pdoSatementStat->errorInfo();
        exit;
    }
    return $pdoSatementStat->fetchAll(PDO::FETCH_ASSOC);
}

// Get student by id
function getStudent($id){
    global $pdo;
    $requestSqlStudent = "
        SELECT stu_id, stu_firstname, stu_lastname, stu_email, stu_birthdate, cit_name, stu_friendliness, ses_number, tra_name, cit_id
        FROM student
        INNER JOIN city ON city.cit_id = student.city_cit_id
        INNER JOIN session ON session.ses_id = student.session_ses_id
        INNER JOIN training on training.tra_id = session.training_tra_id
        WHERE stu_id = :studentId
    ";
    $pdoStatementStudent = $pdo->prepare($requestSqlStudent);
    $pdoStatementStudent->bindValue(':studentId',$id,PDO::PARAM_INT);
    if ( $pdoStatementStudent->execute() === false ) {
        print_r($pdoStatementStudent->errorInfo());
        exit;
    }
    return $pdoStatementStudent->fetch(PDO::FETCH_ASSOC);
}

// ajoute ou met a jour un student
function insertUpdateStudent($lastname , $firstname , $birthdate , $email , $friendliness , $sesid , $citid, $id = 0){
    global $pdo;
    $requestSqlAdd = "
            INSERT INTO student (stu_lastname, stu_firstname, stu_birthdate, stu_email, stu_friendliness, session_ses_id, city_cit_id) 
            VALUES  (:lastname, :firstname, :birthdate, :email, :friendliness, :sesid, :citid)
    ";
    $requestSqlUpdate = "
            UPDATE student
            SET stu_lastname = :lastname , stu_firstname = :firstname , stu_birthdate = :birthdate , stu_email = :email , stu_friendliness = :friendliness , session_ses_id = :sesid , city_cit_id = :citid
            WHERE stu_id = :id
    ";
    $requestSql = $id == 0 ? $requestSqlAdd : $requestSqlUpdate;

    $pdoStatement = $pdo->prepare($requestSql);
    $pdoStatement->bindValue(':lastname', $lastname, PDO::PARAM_STR);
    $pdoStatement->bindValue(':firstname', $firstname, PDO::PARAM_STR);
    $pdoStatement->bindValue(':birthdate', $birthdate, PDO::PARAM_STR);
    $pdoStatement->bindValue(':email', $email, PDO::PARAM_STR);
    $pdoStatement->bindValue(':friendliness', $friendliness, PDO::PARAM_INT);
    $pdoStatement->bindValue(':sesid', $sesid, PDO::PARAM_INT);
    $pdoStatement->bindValue(':citid', $citid, PDO::PARAM_INT);
    if ($id != 0){
        $pdoStatement->bindValue(':id', $id, PDO::PARAM_INT);
    }

    if ($pdoStatement->execute() === false){
        print_r($pdo->errorInfo()); // Si erreur on imprime l'erreur
    }
}

function deleteStudent($id){
    global $pdo;
    $requestSqlDeleteStudent = "DELETE student FROM student WHERE stu_id = :id";
    $pdoStatementDeleteStudent = $pdo->prepare($requestSqlDeleteStudent);
    $pdoStatementDeleteStudent->bindValue(':id', $id, PDO::PARAM_INT);
    if ($pdoStatementDeleteStudent->execute() === false){
        $pdoStatementDeleteStudent->errorInfo();
        exit();
    }
}

function cityToId($city){
    // on recupère les nom de villes et leurs id
    $arrayCity = cityName();
    $arrayCity = array_flip($arrayCity);
    if(array_key_exists($city, $arrayCity)){
        return $arrayCity[$city];
    }
    else{
        return 0;
    }
}

function exportStudent(){
    global $pdo, $requestSqlAllStudents;
    $pdoStatement = $pdo->prepare($requestSqlAllStudents);
    if ($pdoStatement->execute() === false){
        $pdoStatement->errorInfo();
        exit();
    }
    $allStudent = $pdoStatement->fetchAll(PDO::FETCH_ASSOC);
    $today = date("Ymd");
    $fileNameToday = "./csv/export-{$today}.csv";
    // Je vérifie si il existe
    if (file_exists($fileNameToday)){
        // Je le suprime;
        unlink($fileNameToday);
    }
    $handle = fopen($fileNameToday, "w");
    foreach($allStudent as $student){
        //Name;Firstname;email;Friendliness;Birthdate;City
        fwrite($handle,"{$student['stu_lastname']};{$student['stu_firstname']};{$student['stu_email']};{$student['stu_friendliness']};{$student['stu_birthdate']};{$student['cit_name']}");
        fwrite($handle, PHP_EOL);
    }
    fclose($handle);
    header("Location: $fileNameToday");
}

function studentExist($email){
    global $pdo;
    $requestSqlEmail = "
        SELECT stu_id
        FROM student
        WHERE stu_email = :email
    ";
    $pdoStatement = $pdo->prepare($requestSqlEmail);
    $pdoStatement->bindValue(':email', $email, PDO::PARAM_STR);
    if ($pdoStatement->execute() === false){
        print_r($pdoStatement->errorInfo()); // Si erreur on imprime l'erreur
        exit;
    }
    if ($pdoStatement->rowCount() !== 0){
        $result = $pdoStatement->fetch(PDO::FETCH_ASSOC);
        return $result['stu_id'];
    }else {
        return 0;
    }
}

//Fonction check email inscription
function usrEmailExist($email){
    global $pdo;
    $requestSql = "SELECT usr_id FROM users WHERE usr_email = :email";
    $pdoStatement = $pdo->prepare($requestSql);
    $pdoStatement->bindValue('email', $email, PDO::PARAM_STR);
    if ($pdoStatement->execute() === false){
        print_r($pdoStatement->errorInfo());
        exit();
    }
    if ($pdoStatement->rowCount() > 0){
        return true;
    }else {
        return false;
    }
}

//Fonction d'enregistrement d'un user
function signup($email, $password){
    global $pdo;
    $requestSignup = "
      INSERT INTO users (usr_email, usr_password, usr_role)
      VALUES (:email, :password, 'user')
    ";
    $pdoStatementSignup = $pdo->prepare($requestSignup);
    $pdoStatementSignup->bindValue(":email", $email, PDO::PARAM_STR);
    $pdoStatementSignup->bindValue(":password", $password, PDO::PARAM_STR);
    if ($pdoStatementSignup->execute() === false){
        print_r($pdoStatementSignup->errorInfo());
        return false;
    }else{
        return true;
    }
}

//Fonction de vérification du password
function checkPassword($email, $password){
    global $pdo;
    $requestHash = "SELECT usr_password FROM users WHERE usr_email = :email";
    $pdoStatementCheckPwd = $pdo->prepare($requestHash);
    $pdoStatementCheckPwd->bindValue(":email", $email, PDO::PARAM_STR);
    if ($pdoStatementCheckPwd->execute() === false){
        print_r($pdoStatementCheckPwd->errorInfo());
        exit();
    }
    $result = $pdoStatementCheckPwd->fetch(PDO::FETCH_ASSOC);
    $hash = $result['usr_password'];
    if (password_verify($password, $hash)) {
        return true;
    } else {
        return false;
    }
}

// Fonction pour récupérer l'id
function getIdUsr($email){
    global $pdo;
    $requestIdUsr = "SELECT usr_id FROM users WHERE usr_email = :email";
    $pdoStatement = $pdo->prepare($requestIdUsr);
    $pdoStatement->bindValue('email', $email, PDO::PARAM_STR);
    if ($pdoStatement->execute() === false){
        print_r($pdoStatement->errorInfo());
        exit();
    }
    $result = $pdoStatement->fetch(PDO::FETCH_ASSOC);
    return $result['usr_id'];
}

// Fonction pour récupérer le role
function getrole($email){
    global $pdo;
    $requestRole = "SELECT usr_role FROM users WHERE usr_email = :email";
    $pdoStatement = $pdo->prepare($requestRole);
    $pdoStatement->bindValue('email', $email, PDO::PARAM_STR);
    if ($pdoStatement->execute() === false){
        print_r($pdoStatement->errorInfo());
        exit();
    }
    $result = $pdoStatement->fetch(PDO::FETCH_ASSOC);
    return $result['usr_role'];
}

// Fonction pour avoir l'email
function getEmailUser($id){
    global $pdo;
    $requestEmail = "SELECT usr_email FROM users WHERE usr_id = :id";
    $pdoStatement = $pdo->prepare($requestEmail);
    $pdoStatement->bindValue('id', $id, PDO::PARAM_INT);
    if ($pdoStatement->execute() === false){
        print_r($pdoStatement->errorInfo());
        exit();
    }
    $result = $pdoStatement->fetch(PDO::FETCH_ASSOC);
    return $result['usr_email'];
}

// Fonction de création de la session
function createSession($email){
    session_start();
    $_SESSION['id'] = getIdUsr($email);
    $_SESSION['ip'] = $_SERVER["REMOTE_ADDR"];
    $_SESSION['email'] = $email;
    $_SESSION['role'] = getRole($email);
}

// List de tout les user
function allUsers(){
    global $pdo;
    $requestAllUsers = "SELECT * FROM users";
    $pdoStatementUsers = $pdo->prepare($requestAllUsers);
    if ($pdoStatementUsers->execute() === false){
        print_r($pdoStatementUsers->errorInfo());
        exit;
    }
    return $pdoStatementUsers->fetchAll(PDO::FETCH_ASSOC);
}

// Update role de l'utilisateur
function updateRole($id,$newRole){
    global $pdo;
    $requestUpdateRole = "UPDATE users SET usr_role=:role WHERE usr_id=:id";
    $pdoStatementRole = $pdo->prepare($requestUpdateRole);
    $pdoStatementRole->bindValue(":role", $newRole, PDO::PARAM_STR);
    $pdoStatementRole->bindValue(":id",$id,PDO::PARAM_INT);
    if ($pdoStatementRole->execute() === false){
        print_r($pdoStatementRole->errorInfo());
        exit;
    }
}

// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
function sendEmail($to, $subject, $htmlContent, $texContent=''){
    global $config;
    $mail = new PHPMailer(true);                              // Passing `true` enables exceptions
    try {
        //Server settings
        $mail->isSMTP();                                      // Set mailer to use SMTP
        $mail->Host = 'smtp.gmail.com';                       // Specify main and backup SMTP servers
        $mail->SMTPAuth = true;                               // Enable SMTP authentication
        $mail->Username = $config['EMAIL'];                 // SMTP username
        $mail->Password = $config['EMAIL_PWD'];                           // SMTP password
        $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
        $mail->Port = 587;                                    // TCP port to connect to

        $mail->SMTPOptions = array(
            'ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
            )
        );

        //Recipients
        $mail->setFrom('chiburi91@gmail.com', "Admin");
        $mail->addAddress($to, '');     // Add a recipient

        //Content
        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->Subject = $subject;
        $mail->Body = $htmlContent;
        $mail->AltBody = $texContent;

        $mail->send();
        return true;
    } catch (Exception $e) {
        echo 'Message could not be sent.';
        echo 'Mailer Error: ' . $mail->ErrorInfo;
        return false;
    }
}

function saveTokenReset($email, $token){
    global $pdo;
    $requestToken = "UPDATE users
        SET usr_token = :token
        WHERE usr_email = :email
    ";
    $pdoStatement = $pdo->prepare($requestToken);
    $pdoStatement->bindValue('token', $token, PDO::PARAM_STR);
    $pdoStatement->bindValue('email', $email, PDO::PARAM_STR);
    if ($pdoStatement->execute() === false){
        print_r($pdoStatement->errorInfo());
        return false;
    }
    return true;
}

function resetPwd($password, $token){
    global $pdo;
    $requestPwd = "
        UPDATE users 
        SET usr_password = :password, usr_token = ''
        WHERE usr_token = :token
    ";
    $pdoStatementPwd = $pdo->prepare($requestPwd);
    $options = [ 'cost' => 12];
    $pdoStatementPwd->bindValue(":password", password_hash($password, PASSWORD_BCRYPT, $options), PDO::PARAM_STR);
    $pdoStatementPwd->bindValue(":token",$token,PDO::PARAM_INT);
    if ($pdoStatementPwd->execute() === false){
        print_r($pdoStatementPwd->errorInfo());
        exit;
    }
}
function tokenValid($token){
    global $pdo;
    $tokenValid = false;
    $requestToken = "
        SELECT usr_updated 
        FROM users
        WHERE usr_token = :token
    ";
    $pdoStatement = $pdo->prepare($requestToken);
    $pdoStatement->bindValue(":token",$token,PDO::PARAM_INT);
    if ($pdoStatement->execute() === false){
        print_r($pdoStatement->errorInfo());
        exit;
    }else{
        $updated = $pdoStatement->fetch(PDO::FETCH_ASSOC);
        if ($updated != false){
            $updatedTimestamp = strtotime($updated['usr_updated']);
            $timestamp15min = strtotime("-15 minutes");
            if ($timestamp15min < $updatedTimestamp){
                $tokenValid = true;
            }
        }
    }
    return $tokenValid;
}