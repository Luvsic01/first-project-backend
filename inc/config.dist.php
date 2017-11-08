<?php
// Le session
require_once  __DIR__."/session.php";

// Données de configuration de la database
$config = array(
    'DB_HOST' => '',
    'DB_USER' => '',
    'DB_PASSWORD' => '',
    'DB_DATABASE' => '',
    'EMAIL'=>'',
    'EMAIL_PWD'=> ''
);

// Inclusions de fichiers
require_once __DIR__.'/db.php';
require_once __DIR__.'/functions.php';

//inclusion de composer
require_once __DIR__.'/../vendor/autoload.php';
// SocialNetworks
//Create a Page instance with the url information
$socialLinksPage = new SocialLinks\Page([
    'url' => 'http://projet-toto.dev',
    'title' => 'Projet TOTO',
    'text' => 'Extended page description',
    'image' => '',
    'icon' => '',
    'twitterUser' => '@twitterUser'
]);
