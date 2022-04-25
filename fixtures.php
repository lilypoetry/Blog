<?php

/**
 * fixtures.php
 * Insertion de fausses données en BDD
 */

// Chargement de l'autoloader de Composer
require_once 'vendor/autoload.php';

// Connexion à la BDD
require_once 'connexion.php';

// Création de l'instance de Faker
$faker = Faker\Factory::create('fr_FR');

// Désactive la vérification des clés étrangères
$db->query('SET FOREIGN_KEY_CHECKS = 0');

// Vide la table "categories"
$db->query('TRUNCATE categories');

// active la vérification des clés étrangères
$db->query('SET FOREIGN_KEY_CHECKS = 1');

/**
 * Insertion des données dans la table "categories"
 */
for ($i = 0; $i < 10; $i++) {
    $query = $db->prepare('INSERT INTO categories (name) VALUES (:name)');
    $query->bindValue(':name', $faker->colorName);
    $query->execute();
}

/**
 * Insertion des données dans la table "users"
 */
// ...

/**
 * Insertion des données dans la table "posts"
 */
// ...
