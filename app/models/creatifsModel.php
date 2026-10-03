<?php

namespace App\Models\CreatifsModel;

use \PDO;

// Je récupère tous les créa'tifs (pour la liste déroulante du formulaire)
function findAll(PDO $connexion): array
{
    $sql = "SELECT *
            FROM creatifs
            ORDER BY pseudo;";

    $rs = $connexion->query($sql);

    return $rs->fetchAll(PDO::FETCH_ASSOC);
}
