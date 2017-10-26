<?php

// Require du fichier de config
require_once __DIR__.'/../inc/config.php';

$idStudent = $_GET['id'];

$requestSqlStudent = "
    SELECT stu_id, stu_firstname, stu_lastname, stu_email, stu_email, cit_name, stu_friendliness, ses_number, tra_name
    FROM student
    INNER JOIN city ON city.cit_id = student.city_cit_id
    INNER JOIN session ON session.ses_id = student.session_ses_id
    INNER JOIN training on training.tra_id = session.training_tra_id
    WHERE stu_id = :studentId
";

$pdoStatementStudent = $pdo->prepare($requestSqlStudent);
$pdoStatementStudent->bindValue(':studentId',$idStudent,PDO::PARAM_INT);
if ( $pdoStatementStudent->execute() === false ) {
    print_r($pdoStatementStudent->errorInfo());
    exit;
}
$resultStudent = $pdoStatementStudent->fetch(PDO::FETCH_ASSOC);

print_r($resultStudent);

$birthdate = '0';

// fin fichier
require_once __DIR__.'/../view/header.php';
require_once __DIR__.'/../view/student.php';
require_once __DIR__.'/../view/footer.php';