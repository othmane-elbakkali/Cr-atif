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

// Je supprime un projet 
function deleteOneById(PDO $connexion, int $id): int
{
    $sql = "DELETE FROM projets
            WHERE id = :id;";

    $rs = $connexion->prepare($sql);
    $rs->bindValue(':id', $id, PDO::PARAM_INT);

    return intval($rs->execute());
}


// J'ajoute un projet et je renvoie son id
// $data : les champs du formulaire (titre, resume, texte, creatif)
// $image : le nom du fichier image enregistré (ou null)
function insertOne(PDO $connexion, array $data, ?string $image): int
{
    $sql = "INSERT INTO projets (titre, resume, texte, dateCreation, image, creatif)
            VALUES (:titre, :resume, :texte, NOW(), :image, :creatif);";

    $rs = $connexion->prepare($sql);
    $rs->bindValue(':titre', $data['titre'], PDO::PARAM_STR);
    $rs->bindValue(':resume', $data['resume'], PDO::PARAM_STR);
    $rs->bindValue(':texte', $data['texte'], PDO::PARAM_STR);
    $rs->bindValue(':image', $image, PDO::PARAM_STR);
    $rs->bindValue(':creatif', $data['creatif'], PDO::PARAM_INT);
    $rs->execute();

    // l'id du projet qui vient d'être ajouté
    return intval($connexion->lastInsertId());
}


// Je modifie un projet (la date de création ne change pas)
// $data : les champs du formulaire (titre, resume, texte, creatif)
// $image : le nom du fichier image (le nouveau, ou l'ancien si on n'en a pas envoyé)
function updateOneById(PDO $connexion, int $id, array $data, ?string $image): int
{
    $sql = "UPDATE projets
            SET titre   = :titre,
                resume  = :resume,
                texte   = :texte,
                image   = :image,
                creatif = :creatif
            WHERE id = :id;";

    $rs = $connexion->prepare($sql);
    $rs->bindValue(':titre', $data['titre'], PDO::PARAM_STR);
    $rs->bindValue(':resume', $data['resume'], PDO::PARAM_STR);
    $rs->bindValue(':texte', $data['texte'], PDO::PARAM_STR);
    $rs->bindValue(':image', $image, PDO::PARAM_STR);
    $rs->bindValue(':creatif', $data['creatif'], PDO::PARAM_INT);
    $rs->bindValue(':id', $id, PDO::PARAM_INT);

    return intval($rs->execute());
}
