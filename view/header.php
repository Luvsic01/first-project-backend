<html >
<head>
    <title>Document</title>

    <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/css/materialize.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="css/styles.css">
</head>

<body>
<nav class="nav-extended teal">
    <div class="nav-wrapper container ">
        <a href="index.php" class="brand-logo"><img id="logo" src="./img/logoColor.png" alt=""></a>
        <a href="#" data-activates="mobile-demo" class="button-collapse"><i class="material-icons">menu</i></a>
        <ul id="nav-mobile" class="right hide-on-med-and-down">
            <li><a href="index.php">Home</a></li>
            <li><a href="index.php">Toutes les sessions</a></li>
            <li><a href="list.php">Toutes les étudiants</a></li>
            <li><a href="add.php">Ajout d'un étudiant</a></li>
            <li><a href="lots.php">Ajout/Export par lots</a></li>
        </ul>
        <ul class="side-nav" id="mobile-demo">
            <li><a href="index.php">Home</a></li>
            <li><a href="index.php">Toutes les sessions</a></li>
            <li><a href="list.php">Toutes les étudiants</a></li>
            <li><a href="add.php">Ajout d'un étudiant</a></li>
            <li><a href="lots.php">Ajout/Export par lots</a></li>
        </ul>
    </div>
    <div class="nav-wrapper container" style="height: 1rem; margin-bottom: 10px;">
        <div class="row">
            <form class="teal lighten-2" method="get" action="list.php" style="border-radius: 5px;">
                <div class="input-field">
                    <input name="search" id="search" type="search" required style="border-radius: 5px;">
                    <label class="label-icon" for="search"><i class="material-icons">search</i></label>
                    <i class="material-icons">close</i>
                </div>
            </form>
        </div>
    </div>
</nav>