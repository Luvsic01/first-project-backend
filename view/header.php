<?php
session_start();
if (isset($_SESSION['ip'])){
    if ( $_SESSION['ip'] != $_SERVER["REMOTE_ADDR"] ){
        header("Location: index.php");
    }
}
?>
<html >
<head>
    <title><?= $titlePage ?></title>
    <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/css/materialize.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="css/styles.css">
</head>

<body>
<nav class="nav-extended teal lighten-2">
    <div class="teal">
        <div class="nav-wrapper container ">
            <a href="index.php" class="brand-logo"><img id="logo" src="./img/logo.png" alt=""></a>
            <a href="#" data-activates="mobile-demo" class="button-collapse"><i class="material-icons">menu</i></a>
            <ul id="nav-mobile" class="right hide-on-med-and-down">
                <li><a href="index.php">Home</a></li>
                <li><a href="index.php">Toutes les sessions</a></li>
                <li><a href="list.php">Touts les étudiants</a></li>
                <li><a href="add.php">Ajout d'un étudiant</a></li>
                <?php if (isset($_SESSION['id'])) : ?>
                    <li style="font-style: italic;"><a href="deconnexion.php"><?= $_SESSION['email'] ?> déconnexion</a></li>
                <?php else: ?>
                    <li><a href="signup.php">SignUp</a></li>
                    <li><a href="login.php">LogIn</a></li>
                <?php endif; ?>
            </ul>
            <ul class="side-nav" id="mobile-demo">
                <li><a href="index.php">Home</a></li>
                <li><a href="index.php">Toutes les sessions</a></li>
                <li><a href="list.php">Touts les étudiants</a></li>
                <li><a href="add.php">Ajout d'un étudiant</a></li>
                <li><a href="lots.php">Ajout/Export</a></li>
                <li><a href="signup.php">SignUp</a></li>
                <li><a href="login.php">LogIn</a></li>
            </ul>
        </div>
    </div>
    <div class="teal lighten-2">
        <div class="nav-wrapper" style="height: 1rem; margin: 2px;">
            <form class="container teal lighten-2" method="get" action="list.php" style="border-radius: 5px;">
                <div class="input-field">
                    <input name="search" id="search" type="search" required style="border-radius: 5px;">
                    <label class="label-icon" for="search"><i class="material-icons">search</i></label>
                    <i class="material-icons">close</i>
                </div>
            </form>
        </div>
    </div>
</nav>