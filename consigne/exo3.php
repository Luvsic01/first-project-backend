<?php
/*
// EXERCICE 3 - Projet TOTO
On va modifier la page list.php
- on ne va plus faire de lien vers student.php, mais afficher un "popup" dans la page list.php, lorsqu'on clique sur "Détails"
- créer un répertoire ajax (dans public), et
y créer un fichier student.php
- dans la vue "list", ajouter la div suivante (et corriger si besoin)
*/
//<div id="popupStudent" style="display:none;position:absolute;z-index:1000;left:50%;top:10%;margin-left:-200px;width:400px;border:1px solid black;padding:10px;background: white;"></div>
/*
- exécuter une requête ajax vers ce fichier en POST
	* ajax/student.php récupère l'id du student
    passé en POST
	* puis renverra le code HTML avec
    les informations sur le student (le code HTML
    qu'on avait sur student.php)
	* en JS, on va insérer ce code HTML
    (réponse de l'Ajax) dans la div
    (id="popupStudent") puis "afficher cette div"

// EXERCICE++
- ajouter un bouton "close" dans la div qui va "cacher" la div
- créer un fichier "ajax/add.php"
- intercepter la soumission du formulaire d'ajout de student (add.php)
- exécuter une requête ajax avec les données du formulaire en POST
- la page ne se rechargeant pas, récupérer un code de retour permettant de savoir si l'ajout a fonctionné ou s'il y a une erreur, et laquelle
	(code de retour = affichage fait par ajax/add.php)

// EXERCICE-extra "Modal" affichant les données des students
- au lieu d'une div "absolute" dans "list", utiliser un modal (bootstrap)
- Amélioration :
	* ajax/student.php : ne plus renvoyer du code HTML mais un JSON
	* ainsi, parcourir le JSON récupéré pour générer en JS le code HTML

*/
