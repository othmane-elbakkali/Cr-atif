<?php

namespace App\Controllers\ProjetsController;

use \PDO;

// Page d'accueil : liste des projets
function indexAction(PDO $connexion): void
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
function showAction(PDO $connexion, int $id): void
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
function deleteAction(PDO $connexion, int $id): void
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

// Formulaire d'ajout d'un projet
function addFormAction(PDO $connexion): void
{
    // je demande les créa'tifs et les tags aux modèles (pour remplir le formulaire)
    include_once '../app/models/creatifsModel.php';
    $creatifs = \App\Models\CreatifsModel\findAll($connexion);

    include_once '../app/models/tagsModel.php';
    $tags = \App\Models\TagsModel\findAll($connexion);

    // le formulaire est partagé avec la modification :
    // pour un ajout, le projet est vide et aucun tag n'est coché
    $projet = [
        'titre'        => '',
        'resume'       => '',
        'texte'        => '',
        'creatif'      => 0,
        'projet_image' => null
    ];
    $projetTags = [];

    // titre du formulaire et adresse où il envoie ses données
    $titreForm = "Ajouter un projet";
    $action    = "projects/add/insert.html";

    // je remplis les zones dynamiques du template
    // et je masque le bandeau sur cette page
    global $content, $title, $afficherHeader;
    $title          = "- Ajouter un projet";
    $afficherHeader = false;

    // je charge la vue 'form' dans $content
    ob_start();
    include '../app/views/projet/form.php';
    $content = ob_get_clean();
}

// Ajout d'un projet (données du formulaire), puis retour à l'accueil
// $data  : les champs texte du formulaire ($_POST)
// $files : les fichiers envoyés ($_FILES), ici l'image
function insertAction(PDO $connexion, array $data, array $files): void
{
    // 1. l'image : je l'enregistre dans public/images (voir core/helpers.php)
    $image = \Core\Helpers\uploadImage($files['image'] ?? []);

    // 2. je demande au modèle d'ajouter le projet (il me renvoie l'id du nouveau projet)
    include_once '../app/models/projetsModel.php';
    $id = \App\Models\ProjetsModel\insertOne($connexion, $data, $image);

    // 3. j'ajoute ses tags (les cases cochées, s'il y en a)
    include_once '../app/models/tagsModel.php';
    \App\Models\TagsModel\insertAllByProjetId($connexion, $id, $data['tags'] ?? []);

    // 4. je retourne à l'accueil
    header('Location: ' . PUBLIC_BASE_URL);
    exit;
}

// Formulaire de modification d'un projet (pré-rempli avec ses données)
function editFormAction(PDO $connexion, int $id): void
{
    // je demande le projet à modifier au modèle
    include_once '../app/models/projetsModel.php';
    $projet = \App\Models\ProjetsModel\findOneById($connexion, $id);

    // je demande les créa'tifs et les tags aux modèles (pour remplir le formulaire)
    include_once '../app/models/creatifsModel.php';
    $creatifs = \App\Models\CreatifsModel\findAll($connexion);

    include_once '../app/models/tagsModel.php';
    $tags = \App\Models\TagsModel\findAll($connexion);

    // je garde seulement les id des tags du projet (pour cocher les bonnes cases)
    $projetTags = array_column(\App\Models\TagsModel\findAllByProjetId($connexion, $id), 'id');

    // titre du formulaire et adresse où il envoie ses données
    $titreForm = "Modifier le projet";
    $action    = "projects/" . $id . "/" . \Core\Helpers\slugify($projet['titre']) . "/edit/update.html";

    // je remplis les zones dynamiques du template
    // et je masque le bandeau sur cette page
    global $content, $title, $afficherHeader;
    $title          = "- Modifier " . $projet['titre'];
    $afficherHeader = false;

    // je charge la vue 'form' dans $content (la même que pour l'ajout)
    ob_start();
    include '../app/views/projet/form.php';
    $content = ob_get_clean();
}

// Modification d'un projet (données du formulaire), puis retour à l'accueil
// $data  : les champs texte du formulaire ($_POST)
// $files : les fichiers envoyés ($_FILES), ici l'image
function updateAction(PDO $connexion, int $id, array $data, array $files): void
{
    // 1. je demande le projet actuel au modèle (pour garder son image si on n'en envoie pas de nouvelle)
    include_once '../app/models/projetsModel.php';
    $projet = \App\Models\ProjetsModel\findOneById($connexion, $id);

    // 2. l'image : la nouvelle s'il y en a une, sinon l'ancienne
    $image = \Core\Helpers\uploadImage($files['image'] ?? []) ?? $projet['projet_image'];

    // 3. je demande au modèle de modifier le projet
    \App\Models\ProjetsModel\updateOneById($connexion, $id, $data, $image);

    // 4. je remplace ses tags : je retire les anciens, puis j'ajoute les cases cochées
    include_once '../app/models/tagsModel.php';
    \App\Models\TagsModel\deleteAllByProjetId($connexion, $id);
    \App\Models\TagsModel\insertAllByProjetId($connexion, $id, $data['tags'] ?? []);

    // 5. je retourne à l'accueil
    header('Location: ' . PUBLIC_BASE_URL);
    exit;
}
