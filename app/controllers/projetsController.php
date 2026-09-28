<?php

namespace App\Controllers\ProjetsController;

use \PDO;

function homeAction(PDO $connexion)

{

    // je vais demander des données aux modéles 

    include_once '../app/models/projetsModel.php';
    $projets = \App\Models\ProjetsModel\findAll($connexion);

    // je charge la vue 'index' dans $content

    global $content;

    ob_start();
    include '../app/views/projets/index.php';
    $content = ob_get_clean();
}

function showAction(PDO $connexion, int $id)

{

    // je vais demander des données aux modéles 

    include_once '../app/models/projetsModel.php';
    $projet = \App\Models\ProjetsModel\findOnById($connexion, $id);

    // je charge la vue 'show' dans $content

    global $content;

    ob_start();
    include '../app/views/projets/show.php';
    $content = ob_get_clean();
}
