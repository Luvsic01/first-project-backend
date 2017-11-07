<?php

/*
EXERCICE 1
------------------------
- ajouter une page de sign up (public+view) dans le projet TOTO (+lien navbar)
- créer le formulaire avec email, mot de passe et confirmation de mot de passe
- créer manuellement, dans la database du projet TOTO, une table user, similaire à celle en photo
- lorsque le formulaire est soumis en POST :
	* récupérer les données
	* vérifier qu'elles soient valides
	* vérifier que les 2 mots de passes sont égaux
	* une fois ok, on peut alors ajouter l'utilisateur dans la table user (PREPARE() !!)
		** penser à crypter le mot de passe (md5(), md5()+salt, sha1(), sha1()+salt ou password_hash())
		** si l'insertion s'est bien déroulée, afficher un message de succès
- modifier le POST d'inscription pour vérifier la validité de l'adresse email
- modifier le POST d'inscription pour qu'un user soit unique (basé sur email)
- ajouter la contrainte d'unicité de l'email dans la table user
- mettre la vérification d'un user dans une fonction

EXERCICE++
------------------------
- lorsque le formulaire est soumis, et avant d'ajouter, vérifier que l'email n'existe pas déjà dans la table
- ajouter une contrainte d'unicité sur le champ email dans la table user
- écrire la fonction permettant de vérifier si un email existe déjà dans la table user (et l'utiliser)
- lorsque le formulaire est soumis, et avant d'ajouter, vérifier que le password soit assez complexe : taille >= 8

EXERCICE-extra
------------------------
- - lorsque le formulaire est soumis, et avant d'ajouter, vérifier que le password soit complexe :
	taille >= 8, au moins un chiffre et une majuscule (utiliser une expression régulière)
*/