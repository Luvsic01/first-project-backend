<?php

$str = 'C:\xampp\htdocs\php10\upload\\';

/* EXERCICE 1
------------------------
- dans le projet TOTO, ajouter une page (public+view) avec un formulaire pour envoyer un fichier csv
- lorsque les données sont envoyées :
	* vérifier que le fichier soit bien un fichier csv
	* copier/uploader le fichier dans un sous-répertoire csv
	* ouvrir le fichier en lecture (fopen())
	* parcourir chaque ligne du fichier (fgets()) et :
		** convertir la string de la ligne en tableau (explode() sur , ou ;)
		** insérer un étudiant à partir des informations lues (dans la session 1, ville Luxembourg)
	* fermer le fichier (fclose())
- dans le projet TOTO, dans la même page, ajouter un autre formulaire qui permet de générer un fichier csv (export) de students (prendre le même format que celui fourni)
	* le fichier se nomme 'export-20171106.csv'
	* ouvrir le fichier csv (fopen())
	* ecrire ligne par ligne dans le fichier csv (fwrite() + PHP_EOL)
	* fermer le fichier
	
EXERCICE++
------------------------
- n'autoriser que des fichiers de 100 Ko maxmimum
- si le fichier d'export existe déjà, supprimer le fichier avant de le recréer

EXERCICE-extra
------------------------
- uploader le fichier "-extra.csv" (attention, il y a une ligne d'entête maintenant)
- dans le formulaire créé, ajouter un dropdown (<select>) contenant la liste des sessions
- lors de l'ajout d'un étudiant :
	* lier cet étudiant à la session sélectionnée dans le formulaire
	* rechercher l'ID de la ville correspondant à la colonne city dans le CSV-extra
	* avant d'insérer, vérifier que l'étudiant n'existe pas déjà (se baser sur l'email)
	* si l'étudiant existe déjà, alors mettre à jour

EXERCICE-extra-2
------------------------
- à partir du fichier csv "countries-20140629", insérer la totalité des pays dans la table country (pas d'upload à faire, juste lire le fichier)
	
*/