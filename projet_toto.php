<?php

/* -- Conseils --
-----------------
- prendre son temps
- décomposer le travail en petites tâches (écrirela requête, puis faire la boucle, ou récupérer les données avant de les insérer en DB).
- ne pas hésiter à s'entraider
- ne pas rester bloqué + de 5 minutes => me poser une question :)
*/

/* -- Part 1 = Organisation --
------------------------------
- créer l'arborescence suivante :
	inc/
		config.php
		db.php
		functions.php
	view/
		header.php
		footer.php
		home.php
		list.php
		student.php
		add.php
	public/
		css/
		img/
		js/
		index.php
		list.php
		student.php
		add.php
		edit.php

- inc/config.php :
	* créer un tableau $config avec en valeurs les données nécessaires à la connexion à la DB (host, username, password, database)
	* inclure les fichiers db.php et functions.php

- inc/db.php :
	* écrire le code de connexion à la base de données (PDO + dsn)
 en se basant sur les valeurs du tableau $config

- inclure le fichier de config dans chaque fichier "public"

- view/header.php :
	* mettre en place un menu en haut de page (bootstrap est pas mal ^^)
 avec les liens suivants :
		** Home => index.php
		** Toutes les sessions => index.php
		** Toutes les étudiants => list.php
		** Ajout d'un étudiant => add.php

- view/footer.php :
	* mettre un footer avec un copyright et l'année courante => © 2017 |
 * Tous droits réservés

- public/index.php
	* en fin de script, inclure les vues "header", "home" & "footer"
*/

/* -- Part 2 = Page liste --
----------------------------

- public/list.php :
	* en fin de script, inclure les vues "header" & "footer"
	* récupérer toutes les informations sur tous les étudiants en DB
	* inclure la vue correspondant à la page "list"
	* afficher les informations (id, nom, prénom, email et date de naissance) sous forme de tableau (<table>). Attention, l'affichage se fait dans la vue (view)

*/

/* -- Part 3 = Page student --
----------------------------

- public/list.php :
	* pour chaque ligne du tableau (<table>), ajouer un bouton (lien) qui envoie sur la page student

- public/student.php :
	* récupérer toutes les informations pour l'étudiant spécifié
	* inclure la vue correspondant à la page "student"
	* afficher les informations (id, nom, prénom, email, date de naissance, age, ville, sympathie, numéro et nom de session). Attention, l'affichage se fait dans la vue (view) et je ne veux pas de tableau (<table>)

*/

/* -- Part 4 = Page add/ajout --
--------------------------------

- public/add.php :
	* inclure la vue correspondant à la page "add"
	* dans la vue, écrire le formulaire HTML permettant de saisir les données suivantes sur un student :
		nom, prénom
	* après soumissions du formulaire :
		** récupérer les données envoyées en POST par le formulaire
		** traiter et valider les données
		** si toutes les données sont valides, ajouter en DB puis rediriger sur la page "student" de l'étudiant ajouté
	* récupérer toutes les villes de la DB (ou utiliser l'array)
	* récupérer toutes les sessions de la DB
	* si tout fonctionne, ajouter les champs suivants (et leur traitement, validation, etc.) :
		date de naissance, email, sympathie, session (menu déroulant <select>) et ville (menu déroulant <select>)

*/

/* -- Part 5 = Pagination --
----------------------------

- demander le cours sur cette partie
- view/list.php :
	* ajouter des boutons suivants et précédents

- public/list.php :
	* limiter les résultats de la requête à 5 étudiants
	* mettre en place un système de pagination en passant le numéro de page dans l'URL : list.php?page=2

*/

/* -- Part 6 = recherche --
-----------------------------

- view/header.php :
	* dans la barre de menu, ajouter un formulaire permettant d'effectuer une recherche
		Ce formulaire renvoie sur list.php avec le mot recherchée en GET

- public/list.php :
	* récupérer le paramètre GET contenant le mot recherché
	* si l'ID est fourni :
		** modifier la requête pour filtrer sur le mot recherché dans les champs textuels suivants :
			nom/prénom/email/ville de l'étudiant
		** afficher "x résultat(s) pour le mot XX" avant le tableau (<table>) des étudiants

*/

/* -- Part 7 = Home --
----------------------

- public/index.php :
	* récupérer toutes données sur les sessions en DB (nom de la session, numéro, dates et lieu)
	* inclure la vue correspondant à la page "home"
	* afficher toutes les sessions, regroupées par lieu :
		Fit4Coding Esch-Belval
		Session 1	01/01/2015	31/12/2015
		Session 2	01/01/2016	31/12/2016
		Session 3	01/01/2017	31/12/2017

		Numericall Piennes
		Session 1	01/04/2015	31/08/2015
		Session 2	01/05/2016	31/08/2016

*/

/* -- Part 8 = Liste pour 1 session --
--------------------------------------

- public/index.php :
	* mettre un lien sur les noms, dates et lieux dans sessions. Ce lien renvoit sur list.php pour afficher les étudiants de cette session uniquement (filtre)

- public/list.php :
	* récupérer le paramètre GET contenant l'ID de la session demandée
	* si l'ID est fourni :
		** modifier la requête pour filtrer sur l'ID de session
		** afficher "Etudiants pour la session n°X à XXX" avant le tableau (<table>) des étudiants

*/

/* -- Option 1 = home --
------------------------

- public/index.php :
	* récupérer la statistique suivante (agrégation) :
		le nombre d'étudiants par ville
	* dans la vue, afficher les villes et leur nombres d'étudiants, sous forme de tableau (<table>)

*/

/* -- Option 2 = Suppression étudiant --
----------------------------------------

- public/list.php :
	* dans la vue, ajouter un bouton "Supprimer" (lien) pour chaque étudiant
	* supprimer l'étudiant dont l'ID est passé en GET, dans la DB

*/

/* -- Option 3 = Modification --
--------------------------------

- public/student.php :
	* dans la vue, ajouter un bouton "Modifier" (lien) qui renvoi sur edit.php
	* si besoin, créer une vue pour "edit"
	* pré-remplir le formulaire de modification avec les données de l'étudiant
	* gérer la soumission du formulaire comme pour add.php (récupération, traitement, validation, update)

*/

/* -- Option 4 = Organiser son code --
--------------------------------------

- inc/functions.php :
	* écrire une fonction pour chaque requête SQL. Ces fonctions retourneront le tableau de résultats (fetchAll ou tableau formaté selon besoin)

- public/*.php :
	* il ne doit plus y avoir de requêtes. Il faut toutes les déplacer dans une fonction dans inc/functions.php
	* ne pas oublier d'appeler la fonction créée, puis de récupérer son résultat

*/

/* -- Extra 1 = Add/Edit --
-------------------------

- public/add.php & public/edit.php :
	* comme les 2 fichiers sont similaires, faire en sorte d'ajouter et modifier dans un seul et unique fichier

*/

/* -- Extra 2 = Filtres --
------------------------

- view/list.php :
	* ajouter un formulaire (en GET) permettant de filtrer les étudiants par "session", par "training", par date, par statut (session terminée, active ou future)

- public/list.php :
	* récupérer les données du formulaire de "filtre"
	* modifier la requête pour prendre en compte ces filtres

*/

/* -- Extra 3 = Nombre de résultats par page paramétrable --
------------------------------------------------------------

- view/list.php :
	* ajouter un formulaire (en GET) permettant de définir un nombre de résultats par page (<select>)

- public/list.php :
	* récupérer cette donnée en GET
	* modifier le calcul de l'offset, et la requête pour prendre en compte ce changement

*/

/* -- Extra 4 = Export --
-------------------------

- public/list.php :
	* dans la vue, ajouter un formulaire en POST avec un bouton "Exporter en CSV" (sur la même page)
	* si formulaire export sousmis :
		** exécuter la même requête (filtres) et récupérer les données
		** créer un fichier export.csv (regarder le format CSV) dans le répertoire tmp (à créer), avec les données nom, prénom, email, date de naissance et ville
		** renvoyer au navigateur le contenu du fichier csv, avec le bon header HTTP, pour l'internaute télécharge le fichier
		** supprimer le fichier csv
	
*/

/* -- Extra 5 = CRUDs --
------------------------
	
- public/index.php :
	* dans la liste des sessions, ajouter un bouton renvoyant sur la page de modification d'une session

- public/session_add.php :
	* comme pour "student", mettre en place l'interface permettant d'ajouter/modifier une session

- public/index.php :
	* dans la liste des sessions, ajouter un lien sur le nom du "training" renvoyant sur la page de modification d'un "training"

- public/training_add.php :
	* comme pour "session_add", mettre en place l'interface permettant d'ajouter/modifier une session
	
*/
