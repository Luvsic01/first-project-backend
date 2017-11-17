<?php
/*
// EXERCICE 3 - Projet TOTO
On va modifier la page student.php (pas le code pour l'instant) pour charger les données en Ajax
- dans view/student.php, supprimer le code HTML d'affichage (garder une copie), et ne mettre que :
<div id="studentContent"></div>
- créer un répertoire ajax (dans public), et y créer un fichier student.php
- exécuter une requête ajax vers ce fichier en POST
	* ajax/student.php récupère l'id du student passé en POST
	* puis renverra le code HTML avec les informations sur le student (le code HTML précédemment supprimé)
	* en JS, on va insérer ce code HTML (réponse de l'Ajax) dans la div (id="studentContent")

// EXERCICE++
- créer un fichier "ajax/add.php"
- intercepter la soumission du formulaire d'ajout de student (add.php)
- exécuter une requête ajax avec les données du formulaire en POST
- la page ne se rechargeant pas, récupérer un code de retour permettant de savoir si l'ajout a fonctionné ou s'il y a une erreur, et laquelle
	(code de retour = affichage fait par ajax/add.php)
	
// EXERCICE-extra "Modal" affichant les données des students
- Description :
	page "liste des étudiants", lorsque l'internaute clique sur "Détails" :
	* il ne doit plus être redirigé sur student.php, mais rester sur la même page
	* un modal s'affiche à l'écran (https://v4-alpha.getbootstrap.com/components/modal/)
	* dans ce modal, on pourra lire les informations sur l'étudiant
- Technique :
	* faire un appel Ajax sur un fichier "ajax/student_details.php"
	* l'id de l'étudiant sera passé en POST
	* ajax/student_details.php :
		** récupérer l'ID de l'étudiant fourni
		** faire une requête SQL pour avoir les infos sur l'étudiant
		** afficher sous forme HTML ces informations
	* récupérer le code HTML de l'ajax, et le mettre dans le modal
- Amélioration :
	* ajax/student_details.php : ne plus renvoyer du code HTML mais un JSON
	* ainsi, parcourir le JSON récupéré pour générer en JS le code HTML

*/