<?php

namespace App\Models\ProjetsModel;

use \PDO;

// Je récupère les 10 projets les plus récents
function findAll(PDO $connexion, int $limit = 10)
{
    $sql = "SELECT *, p.image AS projet_image
            FROM projets p
            JOIN creatifs c ON p.creatif = c.id
            ORDER BY dateCreation DESC
            LIMIT :limit;";

    $rs = $connexion->prepare($sql);
    $rs->bindValue(':limit', $limit, PDO::PARAM_INT);
    $rs->execute();

    return $rs->fetchAll(PDO::FETCH_ASSOC);
}
function findOnById(PDO $connexion, int $id): array
{

    $sql = "SELECT *
        FROM projets p
        JOIN creatifs c ON p.creatif = c.id
        WHERE p.id = :id";

    $rs = $connexion->prepare($sql);
    $rs->bindValue(':id', $id, PDO::PARAM_INT);
    $rs->execute();

    return $rs->fetch(PDO::FETCH_ASSOC);
}
