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
