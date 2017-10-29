<?php
$requestSqlAllStudents = "
        SELECT stu_id, stu_firstname, stu_lastname, stu_email, stu_birthdate, cit_name, session_ses_id
        FROM student
        INNER JOIN city ON city.cit_id = student.city_cit_id
";

function studentFilter($filtre, $data){
    global $pdo, $requestSqlAllStudents;
    $requestSql = $requestSqlAllStudents;
    if ($filtre === "search"){
        $requestSql .= "
            WHERE stu_firstname = :data
            OR stu_lastname = :data
            OR stu_email = :data
            OR cit_name = :data
        ";
    }elseif ($filtre === "session"){
        $requestSql .= "
            WHERE session_ses_id = :data
        ";
    }
    $pdoStatementFilter = $pdo->prepare($requestSql);
    $pdoStatementFilter->bindValue(':data', $data, PDO::PARAM_STR);
    if ($pdoStatementFilter->execute() === false){
        print_r($pdoStatementFilter->errorInfo());
        exit();
    }
    return $pdoStatementFilter->fetchAll(PDO::FETCH_ASSOC);
}

function counAllStudent(){
    global $pdo, $requestSqlAllStudents;
    $pdoStatementAllStudent = $pdo->prepare($requestSqlAllStudents);
    $pdoStatementAllStudent->execute();
    return $pdoStatementAllStudent->rowCount();
}

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

function ageUser($dob){
    list($jour, $mois, $annee) = explode ('-', $dob);
    $TSN = strtotime($annee."/".$mois."/".$jour);
    $TS = strtotime(date("Y/m/d"));
    $age = ($TS-$TSN)/(365*3600*24);
    return round($age);
}

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
