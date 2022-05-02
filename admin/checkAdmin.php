<?php

session_start();

if(!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'ROLE_ADMIN')
{
    // Redirection vers le formulaire de connexion
    header('Location: ../login.php');
}
// Connexion à la BDD
require_once '../connexion.php';

// Chargement des dépendances Composer
require_once '../vendor/autoload.php';