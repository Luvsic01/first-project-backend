<?php

/*
EXERCICE 4
------------------------
- ajouter un champ (dans phpMyAdmin) nommé "usr_token" qui sera une chaine de 32 caractères
- ajouter une page "mot de passe oublié" (public+view) dans le projet TOTO (+lien sur page signin)
- créer le formulaire avec email
- lorsque le formulaire est soumis en POST :
	* récupérer les données
	* vérifier qu'elles soient valides
	* faire une requête pour récupérer le user avec cet email
		** si aucun résultat, affiché un message d'erreur
		** sinon :
			$ récupérer l'id du user
			$ remplir par un md5() aléatoire le champ "token" de ce user
			$ générer le lien suivant : http://projet-toto.dev/reset_password.php?token=#TOKEN# (où #TOKEN# est le md5() généré pour ce user

- ajouter une page "reset_password.php" (public+view) dans le projet TOTO (aucun lien)
- tester si le token est présent dans l'URL (GET)
- si non, => erreur
- si oui :
	* récupérer le token et récupérer l'ID du user correspondant au token
	* afficher le formulaire avec password et confirmation de password
	* une fois le formulaire soumis :
		** récupérer les données
		** valider les données (taille du password et 2 passwords égaux)
		** changer le password dans le table user (ne pas oublier le hash)
		** vider le champ token dans la table pour le user
		** rediriger sur la page de signin

EXERCICE-extra
------------------------
- lorsque le nouveau mot de passe est soumis, connecter aussitôt le user
- lors du signup, connecter aussitôt le user
*/