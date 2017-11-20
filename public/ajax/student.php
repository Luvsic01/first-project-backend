<?php

require_once '../../inc/config.php';

$idStudent = $_POST['id'] ?? '';
if (is_numeric($idStudent) === true){
    // Recupère les données de l'utilisateur avec son id
    $resultStudent = getStudent($idStudent);
}
?>

<?php if(is_numeric($idStudent)) : ?>
    <?php echo json_encode($resultStudent) ?>

<?php endif; ?>