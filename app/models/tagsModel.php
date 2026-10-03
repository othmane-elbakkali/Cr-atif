<?php

namespace App\Models\TagsModel;

use \PDO;

// Je récupère les tags d'un projet (via la table de liaison projets_has_tags)
function findAllByProjetId(PDO $connexion, int $id): array
{
    $sql = "SELECT t.id, t.nom
            FROM tags t
            JOIN projets_has_tags pt ON pt.tag = t.id
            WHERE pt.projet = :id
            ORDER BY t.nom;";

    $rs = $connexion->prepare($sql);
    $rs->bindValue(':id', $id, PDO::PARAM_INT);
    $rs->execute();

    return $rs->fetchAll(PDO::FETCH_ASSOC);
}

// Je supprime tous les tags d'un projet (dans la table de liaison projets_has_tags)
function deleteAllByProjetId(PDO $connexion, int $id): int
{
    $sql = "DELETE FROM projets_has_tags
            WHERE projet = :id;";

    $rs = $connexion->prepare($sql);
    $rs->bindValue(':id', $id, PDO::PARAM_INT);

    return intval($rs->execute());
}


// Je récupère tous les tags (pour les cases à cocher du formulaire)
function findAll(PDO $connexion): array
{
    $sql = "SELECT *
            FROM tags
            ORDER BY nom;";

    $rs = $connexion->query($sql);

    return $rs->fetchAll(PDO::FETCH_ASSOC);
}


// J'associe des tags à un projet : une ligne par tag dans projets_has_tags
// $tagIds : les id des tags cochés, ex: [1, 4, 7]
function insertAllByProjetId(PDO $connexion, int $projetId, array $tagIds): void
{
    $sql = "INSERT INTO projets_has_tags (projet, tag)
            VALUES (:projet, :tag);";

    $rs = $connexion->prepare($sql);

    foreach ($tagIds as $tagId):
        $rs->bindValue(':projet', $projetId, PDO::PARAM_INT);
        $rs->bindValue(':tag', $tagId, PDO::PARAM_INT);
        $rs->execute();
    endforeach;
}
