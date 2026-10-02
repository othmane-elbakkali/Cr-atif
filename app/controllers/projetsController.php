<?php

namespace App\Controllers\ProjetsController;

use \PDO;

// Page d'accueil : liste des projets
function indexAction(PDO $connexion)
{
    // je demande les projets au modèle
    include_once '../app/models/projetsModel.php';
    $projets = \App\Models\ProjetsModel\findAll($connexion);

    // je remplis les zones dynamiques du template
    global $content, $title;
    $title = "- Les projets";

    // je charge la vue 'index' dans $content
    ob_start();
    include '../app/views/projet/index.php';
    $content = ob_get_clean();
}

// Détail d'un projet
function showAction(PDO $connexion, int $id)
{
    // je demande le projet au modèle
    include_once '../app/models/projetsModel.php';
    $projet = \App\Models\ProjetsModel\findOneById($connexion, $id);

    // je demande les tags de ce projet au modèle des tags
    include_once '../app/models/tagsModel.php';
    $tags = \App\Models\TagsModel\findAllByProjetId($connexion, $id);

    // je remplis les zones dynamiques du template
    // et je masque le bandeau sur cette page
    global $content, $title, $afficherHeader;
    $title          = "- " . $projet['titre'];
    $afficherHeader = false;

    // je charge la vue 'show' dans $content
    ob_start();
    include '../app/views/projet/show.php';
    $content = ob_get_clean();
}

// Suppression d'un projet, puis retour à l'accueil
function deleteAction(PDO $connexion, int $id)
{
    // je demande aux modèles de supprimer :
    // 1. d'abord les tags du projet (à cause de la clé étrangère de projets_has_tags)
    include_once '../app/models/tagsModel.php';
    \App\Models\TagsModel\deleteAllByProjetId($connexion, $id);

    // 2. puis le projet lui-même (1 si ça a marché, 0 sinon)
    include_once '../app/models/projetsModel.php';
    $response = \App\Models\ProjetsModel\deleteOneById($connexion, $id);

    // je retourne à l'accueil
    header('Location: ' . PUBLIC_BASE_URL);
    exit;
}
