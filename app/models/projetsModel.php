<?php

namespace App\Models\ProjetsModel;

use \PDO;

// Je récupère les 10 projets les plus récents (avec le pseudo de leur créa'tif)
// alias car projets et creatifs ont tous les deux une colonne id et image
function findAll(PDO $connexion, int $limit = 10): array
{
    $sql = "SELECT *, p.id AS projet_id, p.image AS projet_image
            FROM projets p
            JOIN creatifs c ON p.creatif = c.id
            ORDER BY dateCreation DESC
            LIMIT :limit;";

    $rs = $connexion->prepare($sql);
    $rs->bindValue(':limit', $limit, PDO::PARAM_INT);
    $rs->execute();

    return $rs->fetchAll(PDO::FETCH_ASSOC);
}

// Je récupère un projet et son créa'tif
// alias car projets et creatifs ont tous les deux une colonne id et image
function findOneById(PDO $connexion, int $id): array
{
    $sql = "SELECT *, p.id AS projet_id, p.image AS projet_image
            FROM projets p
            JOIN creatifs c ON p.creatif = c.id
            WHERE p.id = :id";

    $rs = $connexion->prepare($sql);
    $rs->bindValue(':id', $id, PDO::PARAM_INT);
    $rs->execute();

    return $rs->fetch(PDO::FETCH_ASSOC);
}

// Je supprime un projet (ses tags doivent avoir été supprimés avant)
function deleteOneById(PDO $connexion, int $id): int
{
    $sql = "DELETE FROM projets
            WHERE id = :id;";

    $rs = $connexion->prepare($sql);
    $rs->bindValue(':id', $id, PDO::PARAM_INT);

    return intval($rs->execute());
}
